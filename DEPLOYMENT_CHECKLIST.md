# Deployment Checklist

Use this checklist to ensure all deployment steps are completed correctly.

## Pre-Deployment Checklist

- [ ] **Code Ready**
  - [ ] `index.html` is complete and tested
  - [ ] `CNAME` file contains correct domain
  - [ ] All links are working
  - [ ] Mobile responsive design verified
  - [ ] Browser compatibility tested

- [ ] **GitHub Repository**
  - [ ] Deployment workflow exists (`.github/workflows/deploy.yml`)
  - [ ] All changes committed and pushed
  - [ ] Branch is ready to merge to `main`

- [ ] **DNS Configuration**
  - [ ] A records point to GitHub Pages IPs
  - [ ] CNAME record for www subdomain configured
  - [ ] DNS propagation verified

## Deployment Checklist

- [ ] **GitHub Pages Settings**
  - [ ] Navigate to Settings → Pages
  - [ ] Source set to "GitHub Actions"
  - [ ] Custom domain set to `www.webservicesdev.com`
  - [ ] DNS check shows green checkmark
  - [ ] "Enforce HTTPS" is enabled

- [ ] **Merge to Main**
  - [ ] Pull request reviewed
  - [ ] CI checks passed
  - [ ] Merged to `main` branch

- [ ] **Monitor Deployment**
  - [ ] Actions workflow triggered
  - [ ] Workflow completed successfully
  - [ ] No errors in workflow logs

## Post-Deployment Verification

- [ ] **Website Access**
  - [ ] https://webservicesdev.com loads
  - [ ] https://www.webservicesdev.com loads
  - [ ] HTTP redirects to HTTPS
  - [ ] Both URLs show same content

- [ ] **Content Verification**
  - [ ] Header displays "WEBServices"
  - [ ] GitHub icon link works
  - [ ] Hero text is visible
  - [ ] Product cards display correctly
  - [ ] Support icons visible
  - [ ] Footer information complete
  - [ ] All email links work (mailto:)

- [ ] **Functionality Tests**
  - [ ] All external links open correctly
  - [ ] Links open in new tabs (target="_blank")
  - [ ] Hover effects work on product cards
  - [ ] Ko-fi widget loads (check browser console)
  - [ ] Google Tag Manager loads (GTM-5D7NJDQP)

- [ ] **Design Verification**
  - [ ] Dark mode theme applied
  - [ ] Purple accent color (#4f46e5) visible
  - [ ] Typography renders correctly
  - [ ] Layout is centered and aligned

- [ ] **Mobile Testing**
  - [ ] Responsive on mobile devices
  - [ ] Text is readable
  - [ ] Buttons/links are tappable
  - [ ] No horizontal scrolling

- [ ] **Browser Testing**
  - [ ] Chrome/Chromium
  - [ ] Firefox
  - [ ] Safari
  - [ ] Edge

- [ ] **Performance**
  - [ ] Page loads quickly (< 2 seconds)
  - [ ] No console errors
  - [ ] No 404 errors for resources
  - [ ] Images load correctly

- [ ] **Analytics**
  - [ ] Google Tag Manager script present
  - [ ] GTM container ID correct (GTM-5D7NJDQP)
  - [ ] No errors in browser console related to GTM

## Troubleshooting Reference

If any item fails, refer to `DEPLOYMENT.md` for detailed troubleshooting steps.

### Quick Fixes

**Website not loading?**
→ Check DNS records, wait for propagation (up to 48h)

**404 error?**
→ Verify GitHub Pages source is "GitHub Actions", check workflow logs

**HTTPS not working?**
→ Wait 24h for certificate provisioning, verify custom domain in settings

**Workflow failed?**
→ Check Actions permissions, verify YAML syntax, review error logs

---

## Sign-Off

- [ ] All checklist items completed
- [ ] Website verified and working
- [ ] Deployment successful

**Deployed by**: _________________  
**Date**: _________________  
**Version/Commit**: _________________

---

© 2026 WEBServices. All rights reserved.
