import { createServer } from "node:http";
import { timingSafeEqual } from "node:crypto";

const port = Number(process.env.PORT || 8787);
const kofiVerificationToken = process.env.KOFI_VERIFICATION_TOKEN || "";
const maxBodyBytes = 256 * 1024;
const dedupeTtlMs = 24 * 60 * 60 * 1000;

if (!kofiVerificationToken) {
  console.error("Missing KOFI_VERIFICATION_TOKEN environment variable.");
  process.exit(1);
}

const seenMessageIds = new Map();
setInterval(() => {
  const now = Date.now();
  for (const [messageId, expiresAt] of seenMessageIds.entries()) {
    if (expiresAt <= now) {
      seenMessageIds.delete(messageId);
    }
  }
}, 60 * 1000).unref();

function secureTokenMatch(expected, received) {
  const a = Buffer.from(expected, "utf8");
  const b = Buffer.from(received || "", "utf8");
  if (a.length !== b.length) {
    return false;
  }
  return timingSafeEqual(a, b);
}

function json(res, statusCode, payload) {
  res.writeHead(statusCode, { "Content-Type": "application/json; charset=utf-8" });
  res.end(JSON.stringify(payload));
}

function parseKoFiPayload(rawBody) {
  const bodyParams = new URLSearchParams(rawBody);
  const dataField = bodyParams.get("data");
  if (!dataField) {
    throw new Error("Missing 'data' field in form payload.");
  }
  return JSON.parse(dataField);
}

function logEventSummary(payload) {
  const summary = {
    message_id: payload.message_id || null,
    type: payload.type || null,
    amount: payload.amount || null,
    currency: payload.currency || null,
    from_name: payload.is_public ? payload.from_name || null : null,
    is_public: Boolean(payload.is_public),
    is_subscription_payment: Boolean(payload.is_subscription_payment),
    is_first_subscription_payment: Boolean(payload.is_first_subscription_payment),
    tier_name: payload.tier_name || null,
    has_shop_items: Array.isArray(payload.shop_items) && payload.shop_items.length > 0
  };

  // Never log private donor messages if is_public is false.
  if (payload.is_public) {
    summary.message = payload.message || null;
  }

  console.log("[kofi-webhook] event", summary);
}

const server = createServer((req, res) => {
  if (req.method === "GET" && req.url === "/health") {
    return json(res, 200, { ok: true });
  }

  if (req.method !== "POST") {
    return json(res, 405, { error: "Method not allowed" });
  }

  const contentType = req.headers["content-type"] || "";
  if (!contentType.includes("application/x-www-form-urlencoded")) {
    return json(res, 415, { error: "Unsupported content type" });
  }

  let receivedBytes = 0;
  const chunks = [];

  req.on("data", (chunk) => {
    receivedBytes += chunk.length;
    if (receivedBytes > maxBodyBytes) {
      req.destroy();
      return;
    }
    chunks.push(chunk);
  });

  req.on("end", () => {
    try {
      if (receivedBytes > maxBodyBytes) {
        return json(res, 413, { error: "Payload too large" });
      }

      const rawBody = Buffer.concat(chunks).toString("utf8");
      const payload = parseKoFiPayload(rawBody);

      if (!secureTokenMatch(kofiVerificationToken, payload.verification_token || "")) {
        return json(res, 401, { error: "Invalid verification token" });
      }

      const messageId = payload.message_id || null;
      if (messageId && seenMessageIds.has(messageId)) {
        return json(res, 200, { ok: true, duplicate: true });
      }
      if (messageId) {
        seenMessageIds.set(messageId, Date.now() + dedupeTtlMs);
      }

      logEventSummary(payload);
      return json(res, 200, { ok: true });
    } catch (error) {
      console.error("[kofi-webhook] parse error", error);
      return json(res, 400, { error: "Invalid payload" });
    }
  });

  req.on("error", (error) => {
    console.error("[kofi-webhook] request error", error);
    return json(res, 500, { error: "Server error" });
  });
});

server.listen(port, "0.0.0.0", () => {
  console.log(`[kofi-webhook] listening on http://0.0.0.0:${port}`);
});
