About

WEBServices is a software engineering initiative focused on building clear, reliable, and maintainable software.
The work emphasizes pragmatic design, explicit trade-offs, and long-term sustainability, with projects ranging from open-source research tools to commercial software solutions. Open-source projects are developed with a research-first mindset and are intended for experimentation, learning, and general-purpose use.

Company Profile

Name: WEBServices
 Field: Software Development

Website: https://webservicesdev.com 
Email: contact@webservicesdev.com 
Support: support@webservicesdev.com 
GitHub: https://github.com/WEBServices-ORG 

Based in Israel. 

© 2026 WEBServices. All rights reserved.

## Deployment

This website is deployed to GitHub Pages at https://webservicesdev.com (and www.webservicesdev.com).

### Automated Deployment

The website automatically deploys when changes are pushed to the `main` branch via GitHub Actions workflow.

### Manual Deployment

To manually trigger a deployment:
1. Go to the Actions tab in the GitHub repository
2. Select "Deploy to GitHub Pages" workflow
3. Click "Run workflow" button
4. Select the `main` branch
5. Click "Run workflow"

### Setup Requirements

For GitHub Pages deployment to work:
1. Repository Settings → Pages → Source: "GitHub Actions"
2. CNAME file must contain: `www.webservicesdev.com`
3. DNS records must point to GitHub Pages servers
4. Workflow permissions must allow Pages deployment

### Local Development

To test the website locally:
```bash
python3 -m http.server 8000
# Then open http://localhost:8000 in your browser
```

