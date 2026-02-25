# Security Policy

## Overview

This document outlines security best practices and policies for the WEBServices Homepage repository. We prioritize security in all aspects of repository management and deployment.

## Deploy Keys vs GitHub Apps

### GitHub's Recommendation

**GitHub recommends using GitHub Apps instead of deploy keys** for the following reasons:

1. **Fine-grained access control**: GitHub Apps provide repository-specific permissions
2. **Enhanced security**: Better authentication mechanisms and audit trails
3. **Scalability**: Single app can access multiple repositories with different permissions
4. **Revocability**: Easier to manage and revoke access

### Deploy Keys

Deploy keys use SSH keys to grant read-only or write access to a single repository. While they can be useful for simple deployments, they have several limitations:

#### Limitations of Deploy Keys:
- **No passphrase protection**: Deploy keys are not protected by a passphrase, making them vulnerable if your server is compromised
- **Single repository access**: Each deploy key only works with one repository
- **Limited permissions**: Can only provide read or write access, no fine-grained control
- **Manual key management**: Requires manual generation, distribution, and rotation
- **Security risk**: If a server with a deploy key is compromised, the key may be exposed

#### When Deploy Keys Might Be Used:
- Simple read-only deployments
- Legacy systems that cannot use GitHub Apps
- Single-repository automation tasks

**Note**: This repository currently has **no deploy keys** configured, which aligns with GitHub's security best practices.

### GitHub Apps (Recommended)

GitHub Apps provide a modern, secure alternative to deploy keys:

#### Benefits of GitHub Apps:
- **Fine-grained permissions**: Request only the permissions needed (e.g., read contents, write actions)
- **Multiple repositories**: A single app can access multiple repositories
- **Organization-level**: Can be installed at the organization level
- **OAuth tokens**: Uses short-lived tokens instead of long-lived SSH keys
- **Better audit trails**: All actions are logged with the app identity
- **Webhooks**: Built-in webhook support for event-driven automation
- **Rate limits**: Separate rate limits from user accounts

#### Creating a GitHub App:

1. Go to your organization settings or user settings
2. Navigate to "Developer settings" → "GitHub Apps" → "New GitHub App"
3. Configure the app:
   - Set app name and description
   - Configure webhook URL (if needed)
   - Set permissions (repository contents, actions, etc.)
   - Select repositories the app can access
4. Generate a private key for authentication
5. Install the app on your repositories

## Current Deployment Method

This repository uses **GitHub Actions** for deployment, which is the recommended approach:

- Deployment workflow: `.github/workflows/wpcom.yml`
- Triggered on: Push to `main` branch
- Uses: GitHub's native authentication via `GITHUB_TOKEN`
- No external keys required

### Why GitHub Actions is Secure:

- **Automatic token generation**: `GITHUB_TOKEN` is automatically created for each workflow run
- **Scoped permissions**: Tokens are scoped to the specific workflow and repository
- **Short-lived**: Tokens expire when the workflow completes
- **No manual key management**: No need to generate, store, or rotate keys
- **Built-in secrets management**: Secrets are encrypted and masked in logs

## Security Best Practices

### Repository Access

1. **Use GitHub Apps** for external integrations instead of deploy keys
2. **Enable branch protection** on the `main` branch
3. **Require pull request reviews** before merging
4. **Enable status checks** to prevent merging broken code
5. **Regularly review access**: Audit collaborators and teams with repository access

### Secrets Management

1. **Never commit secrets** to the repository
2. **Use GitHub Secrets** for sensitive data in workflows
3. **Rotate secrets regularly** (every 90 days minimum)
4. **Use environment-specific secrets** for different deployment stages
5. **Review secret access logs** regularly

### Code Security

1. **Enable Dependabot alerts** for dependency vulnerabilities
2. **Enable code scanning** for security vulnerabilities
3. **Review dependencies** before adding new packages
4. **Keep dependencies updated** to patch security issues
5. **Use minimal dependencies** to reduce attack surface

### Deployment Security

1. **Use GitHub Actions** instead of external CI/CD with deploy keys
2. **Limit workflow permissions** to minimum required
3. **Review workflow runs** for suspicious activity
4. **Enable required reviews** for workflow file changes
5. **Use environment protection rules** for production deployments

## Reporting Security Vulnerabilities

If you discover a security vulnerability in this repository, please report it responsibly:

1. **Do not** open a public GitHub issue
2. **Do not** disclose the vulnerability publicly
3. **Email**: security@webservicesdev.com
4. **Include**:
   - Description of the vulnerability
   - Steps to reproduce
   - Potential impact
   - Suggested fix (if available)

We will respond within 48 hours and work with you to address the issue.

## Security Contact

- **Email**: security@webservicesdev.com
- **General Contact**: contact@webservicesdev.com
- **Support**: support@webservicesdev.com

## Additional Resources

- [GitHub Apps Documentation](https://docs.github.com/en/apps)
- [GitHub Actions Security Best Practices](https://docs.github.com/en/actions/security-guides/security-hardening-for-github-actions)
- [Managing Deploy Keys](https://docs.github.com/en/authentication/connecting-to-github-with-ssh/managing-deploy-keys)
- [About GitHub Apps](https://docs.github.com/en/apps/creating-github-apps)
