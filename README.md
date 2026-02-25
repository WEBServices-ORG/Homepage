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
├── index.html          # Static landing page (for GitHub Pages)
├── wp-theme/           # WordPress theme version
│   ├── style.css       # Theme stylesheet with header
│   ├── functions.php   # Theme functions
│   ├── index.php       # Main template
│   ├── header.php      # Header template
│   ├── footer.php      # Footer template
│   └── README.md       # Theme documentation
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
        └── wpcom.yml   # WordPress theme packaging workflow
```

## Deployment

This repository supports two deployment methods:

### 1. Static Site (GitHub Pages)

The `index.html` file can be served as-is on GitHub Pages or any static hosting provider.

**Automated deploy (recommended):**
- The workflow `.github/workflows/pages.yml` deploys to GitHub Pages on every push to `main`.
- In GitHub repository settings, enable **Pages** and set source to **GitHub Actions**.

**Local testing:**
```bash
python3 -m http.server 8000
```

### 2. WordPress Theme (WordPress.com or Self-Hosted)

The `wp-theme` directory contains a complete WordPress theme.

**WordPress.com Deployment:**

1. Go to your WordPress.com site dashboard (requires Business or eCommerce plan)
2. Navigate to **Tools → GitHub Deployments**
3. Connect this GitHub repository
4. Select the `main` branch
5. Configure deployment to sync the `wp-theme` directory
6. Changes pushed to the main branch will automatically deploy

**Manual Installation:**

1. Download the theme package from the [latest workflow run](../../actions)
2. Go to **WordPress Admin → Appearance → Themes → Add New**
3. Click **Upload Theme** and select the `webservices-theme.zip` file
4. Activate the WEBServices theme

**Self-Hosted WordPress:**

Copy the `wp-theme` directory to your WordPress installation:
```bash
cp -r wp-theme /path/to/wordpress/wp-content/themes/webservices
```

Then activate it from the WordPress admin dashboard.

### GitHub Actions Workflow

The repository includes a GitHub Actions workflow (`.github/workflows/wpcom.yml`) that automatically packages the WordPress theme when changes are pushed to the `main` branch. The packaged theme is available as a workflow artifact.

### 3. Ko-fi Webhook API (Render)

The project includes a small webhook listener at `webhooks/kofi-listener.mjs`.

**Render deployment via Blueprint:**

1. Ensure this repository is connected to Render.
2. Create a new Blueprint in Render and select this repository.
3. Render will detect `render.yaml` and provision `webservices-kofi-webhook`.
4. In Render environment variables, set:
   - `KOFI_VERIFICATION_TOKEN` (required)
5. Deploy and copy the service URL, then configure Ko-fi Webhook URL to:
   - `https://<your-render-service>.onrender.com/`

**Health check endpoint:**
- `GET /health` returns `200`.

## Security

For information about security policies, deploy keys, and best practices, see [SECURITY.md](SECURITY.md).

## Contact

- Email: contact@webservicesdev.com
- Support: support@webservicesdev.com
- GitHub: https://github.com/WEBServices-ORG
- Website: https://webservicesdev.com
