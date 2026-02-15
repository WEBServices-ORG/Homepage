# AGENTS.md

workspace/website is a static HTML landing page for WEBServices.

## Build / Lint / Test

This is a static HTML site with no build process.

Serve locally:

- `python3 -m http.server 8000`

Then open http://localhost:8000 in your browser.

## Repo Map

- `index.html`: Main landing page.
- `Security/`: Security policy documents.
- `License.md`, `Website.md`: Legal and site info.
- `CNAME`: Custom domain configuration.

## Code Style Guidelines

HTML/CSS:

- Use semantic HTML5 elements.
- Keep CSS inline or in a single `<style>` block for simplicity.
- Use responsive design with media queries.
- Prefer vanilla JS; avoid frameworks.

## Security

- Never commit secrets or API keys.
- Review user inputs if using any forms.

## Cursor / Copilot Rules

- Cursor rules: none found.
- Copilot rules: none found.
