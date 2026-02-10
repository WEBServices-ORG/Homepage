# Deployment Architecture

## Overview

This document describes the deployment architecture for the WEBServices website.

```
┌─────────────────────────────────────────────────────────────────┐
│                     WEBServices Website                          │
│                    Deployment Architecture                       │
└─────────────────────────────────────────────────────────────────┘

┌──────────────────┐
│  Developer       │
│  Makes Changes   │
│  to index.html   │
└────────┬─────────┘
         │
         ▼
┌──────────────────┐
│  Create Branch   │
│  & Pull Request  │
└────────┬─────────┘
         │
         ▼
┌──────────────────┐
│  Code Review     │
│  & Approval      │
└────────┬─────────┘
         │
         ▼
┌──────────────────────────────────────────────────────────────┐
│  Merge to Main Branch                                        │
│  ✓ Repository: WEBServices-ORG/Website                       │
│  ✓ Branch: main                                              │
└────────┬─────────────────────────────────────────────────────┘
         │
         │ (automatic trigger)
         ▼
┌──────────────────────────────────────────────────────────────┐
│  GitHub Actions Workflow: deploy.yml                         │
│  ┌────────────────────────────────────────────────────────┐  │
│  │  1. Checkout Code        (actions/checkout@v4)         │  │
│  │  2. Setup Pages          (actions/configure-pages@v4)  │  │
│  │  3. Upload Artifact      (actions/upload-pages@v3)     │  │
│  │  4. Deploy to Pages      (actions/deploy-pages@v4)     │  │
│  └────────────────────────────────────────────────────────┘  │
└────────┬─────────────────────────────────────────────────────┘
         │
         ▼
┌──────────────────────────────────────────────────────────────┐
│  GitHub Pages                                                │
│  ┌────────────────────────────────────────────────────────┐  │
│  │  Environment: github-pages                             │  │
│  │  Serves: index.html + CNAME                            │  │
│  │  SSL: Automatic HTTPS                                  │  │
│  └────────────────────────────────────────────────────────┘  │
└────────┬─────────────────────────────────────────────────────┘
         │
         ▼
┌──────────────────────────────────────────────────────────────┐
│  Custom Domain (DNS)                                         │
│  ┌────────────────────────────────────────────────────────┐  │
│  │  A Records:                                            │  │
│  │    webservicesdev.com → GitHub Pages IPs              │  │
│  │  CNAME Record:                                         │  │
│  │    www.webservicesdev.com → GitHub Pages              │  │
│  └────────────────────────────────────────────────────────┘  │
└────────┬─────────────────────────────────────────────────────┘
         │
         ▼
┌──────────────────────────────────────────────────────────────┐
│  End Users                                                   │
│  ┌────────────────────────────────────────────────────────┐  │
│  │  https://webservicesdev.com                            │  │
│  │  https://www.webservicesdev.com                        │  │
│  │  ✓ Dark mode interface                                 │  │
│  │  ✓ Purple accent (#4f46e5)                             │  │
│  │  ✓ Google Tag Manager tracking                         │  │
│  └────────────────────────────────────────────────────────┘  │
└──────────────────────────────────────────────────────────────┘
```

## Components

### 1. Source Repository
- **Location**: `github.com/WEBServices-ORG/Website`
- **Main Branch**: `main`
- **Key Files**:
  - `index.html` - Website content
  - `CNAME` - Custom domain configuration
  - `.github/workflows/deploy.yml` - Deployment workflow

### 2. GitHub Actions
- **Trigger**: Push to `main` branch or manual dispatch
- **Workflow File**: `.github/workflows/deploy.yml`
- **Actions Used**:
  - `actions/checkout@v4` - Clone repository
  - `actions/configure-pages@v4` - Configure Pages environment
  - `actions/upload-pages-artifact@v3` - Package site files
  - `actions/deploy-pages@v4` - Deploy to GitHub Pages
- **Permissions**:
  - Read repository contents
  - Write to GitHub Pages
  - Use ID token for authentication

### 3. GitHub Pages
- **Environment**: `github-pages`
- **Source**: GitHub Actions artifacts
- **Features**:
  - Automatic HTTPS via Let's Encrypt
  - Custom domain support
  - CDN distribution
  - Version history

### 4. DNS Configuration
- **Provider**: (To be configured by domain owner)
- **Records**:
  - A records pointing to GitHub Pages IPs (4 records)
  - CNAME record for www subdomain
- **Propagation**: Up to 48 hours

### 5. Website Delivery
- **URLs**:
  - Primary: https://webservicesdev.com
  - Alias: https://www.webservicesdev.com
- **Protocol**: HTTPS only (enforced)
- **CDN**: GitHub's global CDN
- **Analytics**: Google Tag Manager (GTM-5D7NJDQP)

## Deployment Flow

### Automated Deployment (Standard)
1. Developer pushes code to feature branch
2. Opens pull request to `main`
3. Code review and approval
4. Merge to `main` branch
5. GitHub Actions automatically triggers
6. Workflow deploys to GitHub Pages
7. Website updates live within 1-2 minutes

### Manual Deployment
1. Navigate to Actions tab in GitHub
2. Select "Deploy to GitHub Pages" workflow
3. Click "Run workflow"
4. Select `main` branch
5. Confirm deployment
6. Monitor workflow progress
7. Verify deployment success

## Security

### HTTPS
- Automatic SSL/TLS certificates via Let's Encrypt
- HTTP automatically redirects to HTTPS
- Certificate auto-renewal

### Authentication
- GitHub Actions uses OIDC (OpenID Connect) tokens
- No long-lived credentials stored
- Permissions scope limited to Pages deployment

### Content Security
- All external links use `rel="noopener noreferrer"`
- No user-generated content
- Static site (no backend)
- Google Tag Manager for analytics only

## Monitoring

### Deployment Status
- Monitor in GitHub Actions tab
- Email notifications for failures (configurable)
- Status badges available

### Website Health
- DNS resolution checks
- HTTPS certificate validity
- Page load performance
- Google Tag Manager functionality

### Metrics
- Google Tag Manager (GTM-5D7NJDQP)
- GitHub Pages insights
- Traffic analytics via GTM

## Rollback Procedure

If deployment fails or introduces issues:

1. **Immediate Rollback**:
   ```bash
   # Revert the commit
   git revert <commit-hash>
   git push origin main
   ```

2. **Redeploy Previous Version**:
   - Go to Actions tab
   - Find successful previous deployment
   - Re-run workflow

3. **Manual Fix**:
   - Create hotfix branch
   - Make corrections
   - Fast-track PR review
   - Merge and auto-deploy

## Maintenance

### Regular Tasks
- Monitor deployment success rate
- Check HTTPS certificate validity
- Verify DNS records remain correct
- Test website functionality
- Review analytics data

### Updates
- Keep GitHub Actions versions current
- Update dependencies if any are added
- Review and update documentation
- Test on new browsers/devices

---

© 2026 WEBServices. All rights reserved.
