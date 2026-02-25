# Ko-fi Webhook Listener

This folder contains a minimal Ko-fi webhook endpoint for a static-site setup.

## What it does

- Accepts `POST` requests with `application/x-www-form-urlencoded`
- Reads the `data` field and parses it as JSON
- Verifies `verification_token` against `KOFI_VERIFICATION_TOKEN`
- Returns `200` for valid payloads
- Deduplicates retries by `message_id` in memory for 24h
- Logs event summaries while respecting `is_public`

## Local run

```bash
cd /Users/admin/Developer/labs/homepage
export KOFI_VERIFICATION_TOKEN='replace-with-your-token'
export PORT=8787
node webhooks/kofi-listener.mjs
```

Health check:

```bash
curl -i http://localhost:8787/health
```

## Test with sample payload

```bash
curl -i -X POST http://localhost:8787 \
  -H 'Content-Type: application/x-www-form-urlencoded' \
  --data-urlencode 'data={"verification_token":"replace-with-your-token","message_id":"msg_123","type":"Donation","is_public":true,"from_name":"Test","amount":"5.00","currency":"USD","message":"Thanks!"}'
```

## Ko-fi setup

1. Deploy this listener to an HTTPS endpoint.
2. Set Ko-fi `Webhook URL` to your deployed endpoint.
3. Set server env var `KOFI_VERIFICATION_TOKEN` to the same token shown in Ko-fi.
4. In Ko-fi, click **Update** and send a test payment event.

## Security notes

- Regenerate your Ko-fi verification token if it was ever exposed.
- Keep `KOFI_VERIFICATION_TOKEN` in environment variables, never in source code.
- If you expose payments publicly, honor `is_public=false` and hide message details.
