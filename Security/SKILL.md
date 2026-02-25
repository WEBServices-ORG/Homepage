---
name: WordPress Security Audit
description: This skill should be used when the user asks to audit, harden, or review the security posture of a WordPress site they own or are explicitly authorized to assess. Focus on defensive checks, misconfiguration discovery, patch guidance, and remediation planning.
---

# WordPress Security Audit

## Purpose

Perform a defensive security assessment of WordPress installations with explicit authorization. The goal is to identify misconfigurations, outdated components, and risky settings, then provide prioritized remediation guidance.

This skill does not include exploitation, credential attacks, or bypass techniques.

## Authorization and Safety Gate

Before any assessment, confirm and document:
- The tester has written authorization.
- Target scope (domains, environments, dates).
- Allowed test intensity (passive or standard active checks).
- Explicitly out-of-scope actions (credential stuffing, brute-force, exploit attempts, data exfiltration).

If authorization is missing or unclear, stop and request clarification.

## Prerequisites

### Required Tools
- WPScan (defensive usage only)
- WP-CLI (for owned/self-hosted environments)
- cURL
- Nmap (safe service discovery only)

### Required Access
- Target URL (production/staging)
- Optional WordPress admin access for verification
- Optional server/hosting access for hardening changes

## Deliverables

1. Security posture summary (high/medium/low risk areas)
2. Findings table with severity and evidence
3. Remediation plan with owners and target dates
4. Re-test checklist and pass/fail closure criteria

## Workflow

### Phase 1: Scope and Baseline

Collect baseline information:

```bash
# Service discovery (safe)
nmap -Pn -p 80,443 target.com

# Basic HTTP metadata
curl -I https://target.com
curl -s https://target.com | head -n 80
```

Validate:
- HTTPS is enabled and certificates are valid.
- Site responds with expected domain and redirects correctly.
- No accidental staging/debug banners on public pages.

### Phase 2: WordPress Exposure Review

Check common endpoints and exposure level:

```bash
curl -I https://target.com/wp-login.php
curl -I https://target.com/wp-admin/
curl -I https://target.com/xmlrpc.php
curl -I https://target.com/wp-json/
```

Assess:
- Whether `xmlrpc.php` is intentionally enabled.
- Whether REST API exposure matches business requirements.
- Whether login endpoints are protected (rate limiting/WAF/challenge).

### Phase 3: Version and Component Hygiene

Run non-destructive scans and inventory collection:

```bash
# Passive/default defensive scan
wpscan --url https://target.com --detection-mode passive

# Vulnerable components focus (no credential attacks)
wpscan --url https://target.com -e vp,vt --detection-mode passive
```

If self-hosted access exists:

```bash
wp core version
wp plugin list --format=table
wp theme list --format=table
```

Assess:
- WordPress core currency.
- Plugin/theme update status.
- Unsupported/abandoned components.

### Phase 4: Configuration and Hardening Checks

Verify key controls:
- `DISALLOW_FILE_EDIT` set to true in production.
- Debug disabled in production (`WP_DEBUG`, `WP_DEBUG_DISPLAY`).
- Correct file permissions for WordPress directories/files.
- Directory listing disabled.
- Security headers present (`X-Content-Type-Options`, `Referrer-Policy`, HSTS where appropriate).
- Principle of least privilege for admin accounts.
- 2FA enabled for privileged accounts.
- Regular backups with restore testing.

Example checks:

```bash
# Header quick check
curl -I https://target.com

# Directory listing spot-check
curl -s https://target.com/wp-content/uploads/ | head -n 40
```

### Phase 5: Authentication and Access Controls

Review only defensive posture (no brute force):
- Login lockout/rate limit controls are active.
- Strong password policy and MFA enforcement exist.
- Admin usernames are non-default and limited.
- Dormant privileged accounts are removed.

### Phase 6: Data Protection and Privacy

Check:
- Sensitive files are not publicly exposed (backups, old exports, debug logs).
- Public uploads policy is controlled.
- PII handling aligns with policy and legal obligations.
- Error messages do not leak stack traces or secrets.

### Phase 7: Reporting and Remediation Plan

Produce a findings report with:
- ID, title, severity, evidence, impact, remediation, owner, due date.
- Priority order: critical internet-facing issues first.
- Clear retest steps per finding.

## Severity Model

- Critical: immediate compromise risk or active exploit path.
- High: significant security weakness with realistic abuse path.
- Medium: meaningful weakness requiring planned remediation.
- Low: hardening/defense-in-depth gap.
- Informational: context, no direct risk.

## Findings Template

Use this format for each finding:

```text
ID:
Title:
Severity:
Asset:
Evidence:
Risk:
Remediation:
Owner:
Target Date:
Retest Steps:
Status:
```

## Acceptance Criteria for Closure

A security review is considered complete when:
- All Critical/High findings are remediated or formally risk-accepted.
- Remediation evidence is attached.
- Re-test confirms fixes are effective.
- Remaining Medium/Low items have scheduled owners and dates.

## Constraints

- No exploitation instructions.
- No credential attacks.
- No denial-of-service style testing.
- No actions outside explicit authorization scope.

## Quick Start (Defensive)

```bash
wpscan --url https://target.com --detection-mode passive
wpscan --url https://target.com -e vp,vt --detection-mode passive
curl -I https://target.com
curl -I https://target.com/xmlrpc.php
curl -I https://target.com/wp-json/
```
