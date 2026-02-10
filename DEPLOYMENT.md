# Deployment Guide

## Overview

This guide explains how to deploy the WEBServices website to GitHub Pages at webservicesdev.com.

## Prerequisites

1. GitHub repository access with admin permissions
2. Custom domain (webservicesdev.com) with DNS access
3. GitHub Actions enabled in repository

## Deployment Steps

### Step 1: Configure GitHub Pages

1. Navigate to repository settings: `https://github.com/WEBServices-ORG/Website/settings/pages`
2. Under "Build and deployment":
   - **Source**: Select "GitHub Actions"
3. Under "Custom domain":
   - Enter: `www.webservicesdev.com`
   - Click "Save"
   - Wait for DNS check to complete

### Step 2: Configure DNS Records

Configure the following DNS records for your domain:

#### A Records (for apex domain)
Point `webservicesdev.com` to GitHub Pages IPs:
```
185.199.108.153
185.199.109.153
185.199.110.153
185.199.111.153
```

#### CNAME Record (for www subdomain)
```
www.webservicesdev.com → WEBServices-ORG.github.io
```

#### Verification
Use `dig` or `nslookup` to verify:
```bash
dig webservicesdev.com +noall +answer
dig www.webservicesdev.com +noall +answer
```

### Step 3: Merge PR to Main Branch

1. Review the pull request
2. Ensure all checks pass
3. Merge to `main` branch
4. This will automatically trigger the deployment workflow

### Step 4: Monitor Deployment

1. Go to Actions tab: `https://github.com/WEBServices-ORG/Website/actions`
2. Select the latest "Deploy to GitHub Pages" workflow run
3. Monitor the deployment progress
4. Wait for successful completion (green checkmark)

### Step 5: Verify Website

Once deployment completes:

1. Visit https://webservicesdev.com
2. Visit https://www.webservicesdev.com
3. Verify:
   - ✅ Website loads correctly
   - ✅ Dark mode theme is applied
   - ✅ All sections are visible (Header, Hero, Products, Support, Footer)
   - ✅ Links work correctly
   - ✅ Mobile responsiveness
   - ✅ HTTPS is enforced
   - ✅ Google Tag Manager loads (check browser console/network tab)

## Manual Deployment

To manually trigger deployment after initial setup:

1. Go to Actions tab in GitHub
2. Select "Deploy to GitHub Pages" workflow
3. Click "Run workflow" button
4. Select `main` branch
5. Click "Run workflow"

## Troubleshooting

### DNS Issues
- **Problem**: "Domain does not resolve to GitHub Pages"
- **Solution**: Wait 24-48 hours for DNS propagation, verify DNS records are correct

### Workflow Fails
- **Problem**: Workflow fails with permission error
- **Solution**: Check repository Settings → Actions → General → Workflow permissions
  - Enable "Read and write permissions"
  - Enable "Allow GitHub Actions to create and approve pull requests"

### 404 Errors
- **Problem**: Website shows 404 error
- **Solution**: 
  - Ensure `index.html` exists in repository root
  - Verify workflow uploaded artifact correctly
  - Check GitHub Pages settings show correct source

### HTTPS Certificate Issues
- **Problem**: "Certificate invalid" or "Not Secure" warning
- **Solution**: 
  - Wait for GitHub to provision SSL certificate (can take up to 24 hours)
  - Ensure custom domain is properly configured in settings
  - Try disabling and re-enabling HTTPS in Pages settings

## Workflow Details

The deployment workflow (`.github/workflows/deploy.yml`):

- **Trigger**: Automatic on push to `main` branch, or manual via workflow_dispatch
- **Permissions**: Read contents, write to Pages, use ID token
- **Steps**:
  1. Checkout repository code
  2. Setup GitHub Pages configuration
  3. Upload entire repository as Pages artifact
  4. Deploy artifact to GitHub Pages

## File Structure

```
/
├── index.html          # Main website file
├── CNAME              # Custom domain configuration
├── README.md          # Repository documentation
├── Website.md         # Website specifications
├── .github/
│   └── workflows/
│       └── deploy.yml # Deployment workflow
└── ...
```

## Post-Deployment

After successful deployment:

1. Test website functionality thoroughly
2. Check Google Analytics is tracking (GTM-5D7NJDQP)
3. Test all external links
4. Verify mobile responsiveness
5. Check browser console for any errors
6. Test on multiple browsers (Chrome, Firefox, Safari, Edge)

## Updates and Maintenance

To update the website:

1. Create a new branch from `main`
2. Make changes to `index.html` or other files
3. Test locally using `python3 -m http.server 8000`
4. Create pull request to `main` branch
5. Review and merge PR
6. Deployment will automatically trigger

## Support

For deployment issues:
- **Email**: support@webservicesdev.com
- **GitHub Issues**: https://github.com/WEBServices-ORG/Website/issues

---

© 2026 WEBServices. All rights reserved.
