#!/bin/bash

# DNS Configuration Helper
# This script helps verify DNS configuration for GitHub Pages deployment

echo "╔════════════════════════════════════════════════════════════════╗"
echo "║         DNS Configuration Helper for WEBServices              ║"
echo "║              webservicesdev.com                                ║"
echo "╚════════════════════════════════════════════════════════════════╝"
echo ""

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Expected values
EXPECTED_IPS=("185.199.108.153" "185.199.109.153" "185.199.110.153" "185.199.111.153")
EXPECTED_CNAME="webservices-org.github.io"
DOMAIN="webservicesdev.com"
WWW_DOMAIN="www.webservicesdev.com"

echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "Required DNS Records:"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""
echo "A Records (for apex domain $DOMAIN):"
for ip in "${EXPECTED_IPS[@]}"; do
    echo "  Type: A    Host: @    Value: $ip"
done
echo ""
echo "CNAME Record (for www subdomain):"
echo "  Type: CNAME    Host: www    Value: WEBServices-ORG.github.io"
echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""

# Check if dig is available
if ! command -v dig &> /dev/null; then
    echo -e "${YELLOW}⚠ Warning: 'dig' command not found. Install it to verify DNS.${NC}"
    echo ""
    echo "Install dig:"
    echo "  - Ubuntu/Debian: sudo apt-get install dnsutils"
    echo "  - macOS: brew install bind"
    echo "  - Windows: Use nslookup instead"
    echo ""
    exit 1
fi

# Function to check A records
check_a_records() {
    echo "Checking A records for $DOMAIN..."
    echo ""
    
    local ips=$(dig +short "$DOMAIN" @8.8.8.8 A)
    
    if [ -z "$ips" ]; then
        echo -e "${RED}✗ No A records found for $DOMAIN${NC}"
        echo "  Please add the A records listed above to your DNS provider"
        return 1
    fi
    
    local found_count=0
    for expected_ip in "${EXPECTED_IPS[@]}"; do
        if echo "$ips" | grep -q "$expected_ip"; then
            echo -e "${GREEN}✓ Found: $expected_ip${NC}"
            ((found_count++))
        else
            echo -e "${RED}✗ Missing: $expected_ip${NC}"
        fi
    done
    
    if [ $found_count -eq 4 ]; then
        echo -e "${GREEN}✓ All 4 A records configured correctly${NC}"
        return 0
    else
        echo -e "${YELLOW}⚠ Found $found_count/4 required A records${NC}"
        return 1
    fi
}

# Function to check CNAME record
check_cname_record() {
    echo ""
    echo "Checking CNAME record for $WWW_DOMAIN..."
    echo ""
    
    local cname=$(dig +short "$WWW_DOMAIN" @8.8.8.8 CNAME | sed 's/\.$//')
    
    if [ -z "$cname" ]; then
        echo -e "${RED}✗ No CNAME record found for $WWW_DOMAIN${NC}"
        echo "  Please add CNAME record: www → WEBServices-ORG.github.io"
        return 1
    fi
    
    local cname_lower=$(echo "$cname" | tr '[:upper:]' '[:lower:]')
    
    if [ "$cname_lower" = "$EXPECTED_CNAME" ]; then
        echo -e "${GREEN}✓ CNAME record correct: $cname${NC}"
        return 0
    else
        echo -e "${YELLOW}⚠ CNAME record found but incorrect${NC}"
        echo "  Current: $cname"
        echo "  Expected: $EXPECTED_CNAME"
        return 1
    fi
}

# Function to check overall status
check_overall_status() {
    echo ""
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
    echo "Overall DNS Status:"
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
    
    if [ $1 -eq 0 ] && [ $2 -eq 0 ]; then
        echo -e "${GREEN}✓ DNS is configured correctly!${NC}"
        echo ""
        echo "Next steps:"
        echo "1. Wait for DNS propagation (up to 48 hours, usually faster)"
        echo "2. Configure GitHub Pages settings"
        echo "3. Deploy the website"
        echo ""
        echo "Test URLs:"
        echo "  - https://$DOMAIN"
        echo "  - https://$WWW_DOMAIN"
        return 0
    else
        echo -e "${YELLOW}⚠ DNS configuration incomplete or incorrect${NC}"
        echo ""
        echo "Please:"
        echo "1. Add/fix the missing DNS records listed above"
        echo "2. Wait 5-10 minutes for changes to propagate"
        echo "3. Run this script again to verify"
        echo ""
        echo "Need help? See MANUAL_DEPLOYMENT_STEPS.md"
        return 1
    fi
}

# Run checks
check_a_records
a_status=$?

check_cname_record
cname_status=$?

check_overall_status $a_status $cname_status
final_status=$?

echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""

exit $final_status
