# WEBServices Website

Official company website for WEBServices, a software development initiative focused on building clear, reliable, and maintainable software.

## Purpose

This is a static landing page that showcases WEBServices' open-source projects and provides contact information. The site is designed to be lightweight, fast, and hosted on GitHub Pages or any static hosting provider.

## Requirements

- A modern web browser (Chrome, Firefox, Safari, Edge)
- Optional: Git for version control

## Running Locally

1. Clone the repository:
   ```bash
   git clone https://github.com/webservices-org/website.git
   cd website
   ```

2. Serve the site locally using Python:
   ```bash
   python3 -m http.server 8000
   ```

3. Open your browser and navigate to:
   ```
   http://localhost:8000
   ```

## Directory Structure

```
website/
├── index.html          # Main landing page (HTML/CSS, no JS required)
├── Website.md          # Design specification document
├── README.md           # Project overview
├── SECURITY.md         # Security policy and best practices
├── License.md          # License information
├── LICENSE             # MIT license file
├── CNAME               # Domain configuration (webservicesdev.com)
├── Security/           # Security policies
│   └── SKILL.md
└── .github/
    └── workflows/
        └── wpcom.yml   # CI/CD workflow for publishing
```

## Deployment

The repository includes a GitHub Actions workflow (`.github/workflows/wpcom.yml`) that automatically publishes the site to WordPress.com when changes are pushed to the `main` branch.

## Security

For information about security policies, deploy keys, and best practices, see [SECURITY.md](SECURITY.md).

## Contact

- Email: contact@webservicesdev.com
- Support: support@webservicesdev.com
- GitHub: https://github.com/WEBServices-ORG
- Website: https://webservicesdev.com
