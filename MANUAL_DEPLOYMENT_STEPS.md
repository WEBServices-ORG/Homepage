# MANUAL DEPLOYMENT INSTRUCTIONS

## ⚠️ Important: These Steps Require Manual Action

The deployment infrastructure is ready, but the following steps require **manual actions in GitHub's web interface** that cannot be automated by an AI agent.

---

## 🎯 Step-by-Step Instructions

### STEP 1: Merge the Pull Request ✅

**Action Required:** Merge PR to `main` branch

1. **Open your browser** and navigate to:
   ```
   https://github.com/WEBServices-ORG/Website/pulls
   ```

2. **Find the Pull Request** named something like:
   - "Create production-ready website based on Website.md specifications"
   - Or containing branch: `copilot/read-website-documentation`

3. **Review the PR:**
   - Check the "Files changed" tab
   - Verify the following files are included:
     - ✅ `index.html` (website)
     - ✅ `CNAME` (domain config)
     - ✅ `.github/workflows/deploy.yml` (deployment workflow)
     - ✅ `DEPLOYMENT.md` and related docs

4. **Merge the PR:**
   - Click the green **"Merge pull request"** button
   - Click **"Confirm merge"**
   - ✅ The PR is now merged to `main`

---

### STEP 2: Configure GitHub Pages Settings ⚙️

**Action Required:** Enable GitHub Actions deployment

1. **Navigate to repository settings:**
   ```
   https://github.com/WEBServices-ORG/Website/settings/pages
   ```

2. **Configure Build and Deployment:**
   - Find the **"Source"** dropdown
   - Select: **"GitHub Actions"** (NOT "Deploy from a branch")
   - This enables the workflow you just merged

3. **Configure Custom Domain:**
   - Find the **"Custom domain"** text field
   - Enter: `www.webservicesdev.com`
   - Click **"Save"**
   - ⏳ Wait for the DNS check (this may show "DNS check is pending...")
   - ✅ Wait for green checkmark (may take 1-5 minutes)

4. **Enable HTTPS:**
   - Check the box for **"Enforce HTTPS"**
   - This will be grayed out until DNS is verified

**Screenshot hint:** You should see:
```
Source: GitHub Actions ✓
Custom domain: www.webservicesdev.com ✓
Enforce HTTPS: ☑ Enabled
```

---

### STEP 3: Configure DNS Records 🌐

**Action Required:** Add DNS records at your domain registrar

You need to configure DNS records wherever you manage `webservicesdev.com` (e.g., GoDaddy, Namecheap, Cloudflare, Route53, etc.)

#### A. Add A Records (for apex domain)

Add **4 separate A records** for `webservicesdev.com`:

| Type | Host/Name | Points To / Value | TTL |
|------|-----------|-------------------|-----|
| A    | @ (or blank) | `185.199.108.153` | 3600 (or Auto) |
| A    | @ (or blank) | `185.199.109.153` | 3600 (or Auto) |
| A    | @ (or blank) | `185.199.110.153` | 3600 (or Auto) |
| A    | @ (or blank) | `185.199.111.153` | 3600 (or Auto) |

#### B. Add CNAME Record (for www subdomain)

Add **1 CNAME record**:

| Type  | Host/Name | Points To / Value | TTL |
|-------|-----------|-------------------|-----|
| CNAME | www       | `WEBServices-ORG.github.io` | 3600 (or Auto) |

**Important Notes:**
- DNS propagation can take **up to 48 hours** (usually much faster)
- You may need to remove any existing conflicting A or CNAME records
- Each DNS provider has a slightly different interface

#### C. Verify DNS Configuration

After adding records, verify they're working:

```bash
# Check A records
dig webservicesdev.com +noall +answer

# Check CNAME record
dig www.webservicesdev.com +noall +answer
```

Or use online tools like:
- https://dnschecker.org/
- https://www.whatsmydns.net/

---

### STEP 4: Monitor Deployment 📊

**Action Required:** Watch the deployment in progress

1. **Navigate to Actions tab:**
   ```
   https://github.com/WEBServices-ORG/Website/actions
   ```

2. **Find the deployment workflow:**
   - Look for "Deploy to GitHub Pages" workflow
   - It should have started automatically after merging to `main`
   - If not, click "Run workflow" button and select `main` branch

3. **Monitor progress:**
   - Click on the running workflow
   - Watch each step complete (Checkout → Setup Pages → Upload → Deploy)
   - ⏳ Wait for all steps to complete (usually 1-2 minutes)
   - ✅ Green checkmark = Success!

4. **Check the deployment URL:**
   - After successful deployment, you'll see a URL in the workflow output
   - It should be something like: `https://webservicesdev.com`

---

### STEP 5: Verify Website is Live ✨

**Action Required:** Test the deployed website

1. **Visit the website:**
   - https://webservicesdev.com
   - https://www.webservicesdev.com
   - Both should work and show the same content

2. **Check HTTPS:**
   - Verify the padlock icon 🔒 in browser address bar
   - HTTP should redirect to HTTPS automatically

3. **Test functionality:**
   - [ ] Header displays "WEBServices"
   - [ ] GitHub icon link works
   - [ ] Hero text: "Open-source & paid developer tools. Built lean."
   - [ ] Product card displays with purple border
   - [ ] Support icons are visible
   - [ ] Footer has contact emails, legal links, avatar
   - [ ] All links open correctly
   - [ ] Mobile responsive (test on phone or resize browser)

4. **Check analytics:**
   - Open browser developer console (F12)
   - Go to Network tab
   - Look for requests to `googletagmanager.com`
   - ✅ GTM should be loading (GTM-5D7NJDQP)

5. **Use the checklist:**
   - Follow `DEPLOYMENT_CHECKLIST.md` for comprehensive verification
   - Sign off when complete

---

## 🚨 Troubleshooting

### Problem: DNS check fails in GitHub Pages settings

**Solution:**
- Verify DNS records are configured correctly
- Wait longer (DNS propagation can take up to 48 hours)
- Try removing and re-adding the custom domain
- Clear DNS cache: `ipconfig /flushdns` (Windows) or `sudo dscacheutil -flushcache` (Mac)

### Problem: Workflow doesn't trigger after merge

**Solution:**
- Manually trigger it: Actions → Deploy to GitHub Pages → Run workflow → Select `main`
- Check that workflow file is in `main` branch: `.github/workflows/deploy.yml`
- Verify GitHub Actions are enabled: Settings → Actions → General

### Problem: Website shows 404 error

**Solution:**
- Verify deployment completed successfully (green checkmark in Actions)
- Check that `index.html` exists in `main` branch
- Wait a few minutes for CDN to update
- Clear browser cache (Ctrl+Shift+R or Cmd+Shift+R)

### Problem: HTTPS not working

**Solution:**
- Wait 24 hours for GitHub to provision SSL certificate
- Verify custom domain is saved in Pages settings
- Try disabling and re-enabling "Enforce HTTPS"

### Problem: Custom domain doesn't work

**Solution:**
- Verify CNAME file contains `www.webservicesdev.com`
- Check DNS records are correct (use dnschecker.org)
- Wait for DNS propagation (up to 48 hours)
- Verify no typos in domain name

---

## ✅ Completion Checklist

After following all steps, verify:

- [ ] PR merged to `main` branch
- [ ] GitHub Pages configured (Source: GitHub Actions)
- [ ] Custom domain configured (www.webservicesdev.com)
- [ ] DNS records added (4 A records + 1 CNAME)
- [ ] Workflow completed successfully (green checkmark)
- [ ] Website loads at https://webservicesdev.com
- [ ] Website loads at https://www.webservicesdev.com
- [ ] HTTPS enforced (padlock icon visible)
- [ ] All content displays correctly
- [ ] Mobile responsive works
- [ ] Google Tag Manager loads
- [ ] DEPLOYMENT_CHECKLIST.md completed

---

## 📞 Need Help?

If you encounter issues:

1. **Check the documentation:**
   - `DEPLOYMENT.md` - Comprehensive guide
   - `DEPLOYMENT_CHECKLIST.md` - Verification steps
   - `DEPLOYMENT_ARCHITECTURE.md` - Technical details

2. **Contact support:**
   - Email: support@webservicesdev.com
   - GitHub Issues: https://github.com/WEBServices-ORG/Website/issues

3. **Verify prerequisites:**
   - Admin access to GitHub repository
   - Access to DNS settings for webservicesdev.com
   - GitHub Actions enabled in repository

---

## 🎉 Success!

Once all steps are complete, your website will be:

✅ **Live** at https://webservicesdev.com  
✅ **Secure** with HTTPS  
✅ **Automated** - future updates deploy automatically  
✅ **Fast** - served via GitHub's global CDN  
✅ **Tracked** - Google Tag Manager analytics active  

**Congratulations on deploying your website! 🚀**

---

© 2026 WEBServices. All rights reserved.
