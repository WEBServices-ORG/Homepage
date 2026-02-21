# WordPress Deployment Guide

This guide explains how to deploy the WEBServices website as a WordPress theme.

## Overview

The repository now includes a complete WordPress theme in the `wp-theme/` directory that can be deployed to:
- WordPress.com (via GitHub Deployments)
- Self-hosted WordPress installations
- Any WordPress-compatible hosting

## Prerequisites

### For WordPress.com Deployment
- WordPress.com Business or eCommerce plan (required for GitHub Deployments)
- GitHub account with access to this repository
- Admin access to your WordPress.com site

### For Self-Hosted WordPress
- WordPress 5.0 or higher
- PHP 7.4 or higher
- FTP/SFTP or direct server access

## Deployment Methods

### Option 1: WordPress.com with GitHub Deployments (Recommended)

This method automatically deploys changes from GitHub to your WordPress.com site.

#### Setup Steps:

1. **Configure WordPress.com GitHub Integration**
   - Log in to your WordPress.com dashboard
   - Go to **Tools → GitHub Deployments**
   - Click **Connect GitHub account**
   - Authorize WordPress.com to access your GitHub account

2. **Connect This Repository**
   - Select **WEBServices-ORG/Homepage** from your repository list
   - Choose the **main** branch for deployment
   - Set the deployment directory to **wp-theme**

3. **Configure Deployment Settings**
   - Enable automatic deployments on push
   - Set up deployment notifications (optional)

4. **Activate the Theme**
   - Go to **Appearance → Themes** in your WordPress.com dashboard
   - Find the "WEBServices" theme
   - Click **Activate**

#### Ongoing Updates:

Once configured, any push to the `main` branch will automatically:
1. Trigger the GitHub Actions workflow
2. Sync changes to WordPress.com
3. Update the active theme

### Option 2: Manual Upload (WordPress.com or Self-Hosted)

#### For WordPress.com:

1. **Download the Theme Package**
   - Go to [GitHub Actions](../../actions)
   - Click on the latest successful workflow run
   - Download the `webservices-theme.zip` artifact

2. **Upload to WordPress.com**
   - Log in to your WordPress.com dashboard
   - Go to **Appearance → Themes → Add New**
   - Click **Upload Theme**
   - Select the `webservices-theme.zip` file
   - Click **Install Now**

3. **Activate the Theme**
   - Once installed, click **Activate**

#### For Self-Hosted WordPress:

**Method A: Via WordPress Admin Panel**
1. Download `webservices-theme.zip` from GitHub Actions
2. Go to **WordPress Admin → Appearance → Themes → Add New**
3. Click **Upload Theme**
4. Select the zip file
5. Click **Install Now** then **Activate**

**Method B: Via FTP/SFTP**
1. Download or clone this repository
2. Connect to your server via FTP/SFTP
3. Upload the `wp-theme/` directory to `/wp-content/themes/`
4. Rename it to `webservices` (optional)
5. Go to **Appearance → Themes** and activate

**Method C: Via Command Line (SSH)**
```bash
# From your local machine
cd /path/to/Homepage
scp -r wp-theme/ user@yourserver:/path/to/wordpress/wp-content/themes/webservices

# Then activate via WordPress admin or WP-CLI
wp theme activate webservices
```

### Option 3: Direct Copy for Self-Hosted

If you have direct server access:

```bash
# Clone the repository
git clone https://github.com/WEBServices-ORG/Homepage.git
cd Homepage

# Copy theme to WordPress installation
cp -r wp-theme /var/www/html/wp-content/themes/webservices

# Set proper permissions
chmod -R 755 /var/www/html/wp-content/themes/webservices
chown -R www-data:www-data /var/www/html/wp-content/themes/webservices
```

Then activate via WordPress admin dashboard.

## Theme Customization

After activation, customize the theme:

1. Go to **Appearance → Customize**
2. Navigate to **Hero Section**
3. Modify:
   - **Tagline**: Main hero text
   - **Domain Display**: Domain name to show

Additional customization options:
- **Site Identity**: Change site title and tagline
- **Custom Logo**: Upload your logo (optional)

## GitHub Actions Workflow

The `.github/workflows/wpcom.yml` workflow automatically:
1. Packages the theme into a zip file
2. Creates an artifact for download
3. Displays deployment instructions

The workflow runs on:
- Every push to the `main` branch
- Manual trigger via workflow_dispatch

## Verification

After deployment, verify the theme:

1. **Check Theme Activation**
   - Go to **Appearance → Themes**
   - Ensure "WEBServices" is the active theme

2. **Visit Your Site**
   - Open your website in a browser
   - Verify the dark theme is displaying correctly
   - Check responsiveness on mobile devices

3. **Test Customizer Changes**
   - Make a change in the Customizer
   - Save and verify it appears on the live site

## Troubleshooting

### Theme Not Appearing in WordPress
- Ensure all required files are present (style.css, index.php, functions.php)
- Check that style.css has the proper theme header
- Verify file permissions (should be readable by web server)

### GitHub Deployments Not Working (WordPress.com)
- Confirm you have a Business or eCommerce plan
- Check that the repository is connected correctly
- Verify the branch name is set to `main`
- Review deployment logs in WordPress.com dashboard

### Style Not Loading
- Clear WordPress cache (if using a caching plugin)
- Hard refresh your browser (Ctrl+F5 or Cmd+Shift+R)
- Check browser console for errors

## Support

For issues or questions:
- **Repository Issues**: [GitHub Issues](../../issues)
- **Email**: contact@webservicesdev.com
- **WordPress.com Support**: https://wordpress.com/support/

## Additional Resources

- [WordPress Theme Handbook](https://developer.wordpress.org/themes/)
- [WordPress.com GitHub Deployments](https://wordpress.com/support/github-deployments/)
- [WordPress Theme Development](https://developer.wordpress.org/themes/getting-started/)

## License

This theme is released under the MIT License. See [LICENSE](../LICENSE) for details.
