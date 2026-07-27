# Admin Guide

How to manage content, products, orders, and users from the admin panel.

**In this guide:** [Getting in](#getting-in) · [Dashboard](#dashboard) · [Company Profile](#company-profile) · [Products](#products) · [Articles & Events](#articles--events) · [Gallery](#gallery) · [Clients](#clients) · [Orders](#orders) · [Messages](#messages) · [Users](#users)

---

## Getting in

Admins log in through the same page as everyone else:

```
/login
```

An account with the `admin` role is redirected straight to:

```
/admin/dashboard
```

Every admin route is protected by both authentication and a role check — a regular user account can't reach any `/admin/*` page, even by typing the URL directly. See the [Authentication Guide](authentication.md) for details.

> Heads up: admin accounts are intentionally blocked from using the shop (cart/checkout). Admins manage the store, they don't buy from it.

---

## Dashboard

Landing page after login. At a glance, it shows:

- Live counts for Articles, Products, Events, Gallery, and Clients (with published/active ratios)
- Quick-add shortcuts for each content type
- A recent orders table

---

## Company Profile

**Admin > Company Profile** — this is the single record that feeds the public site's homepage, footer, and About page: company name, logo, about/vision/mission text, address (with map coordinates for the Leaflet map), phone, WhatsApp, Instagram, fax, and email.

There's only ever one company profile record — saving here always updates the same entry rather than creating a new one. If a field that the homepage depends on (like the logo or company name) is still empty, the page shows a reminder banner listing what's missing.

---

## Products

**Admin > Products** — manage everything customers can buy.

### Create or edit a product

Fill in:

| Field | Notes |
|---|---|
| Name, description, content | Content supports longer, formatted detail text |
| Price | In Rupiah |
| Preview image | JPG/PNG/WebP only (SVG is blocked for security) |
| Delivery type | `File` or `Link` — see below |
| Active | Whether it's visible to customers |

### Delivery types

**File delivery** — upload the actual deliverable (e.g. a `.zip`). It's stored on a private disk and only becomes downloadable to a customer after their payment is confirmed — the file isn't publicly reachable by URL.

**Link delivery** — instead of uploading a file, provide an external URL (GitHub repo, Google Drive folder, Figma file, docs site, etc.). The link is revealed to the customer only after payment.

A product always needs *something* to deliver — the form won't let you save a "file" product with no file, or a "link" product with no URL.

### Reordering

Products display in a custom order on the public site. From the edit screen you can move a product **to top**, **up**, **down**, or **to bottom**.

### Deleting

If a product has ever been part of an order, it can't be deleted (that would corrupt someone's purchase history) — set it to **Inactive** instead. Products with no order history can be deleted normally.

---

## Articles & Events

**Admin > Articles** and **Admin > Events** work the same way: create, edit, publish/unpublish, and delete marketing content. Both use slug-based URLs (generated from the title) for their public pages.

Events additionally support a location with map coordinates, shown on the event's public page via the same Leaflet map used for the company address.

---

## Gallery

**Admin > Gallery** — the portfolio/photo grid shown on the public Gallery page (and used as the About page's hero photo — see [Company Profile](#company-profile)). Each item has a title, caption, category, image, and active status, plus the same top/up/down/bottom reordering as products.

---

## Clients

**Admin > Clients** — the "trusted by" logos shown on the homepage. Each entry has a company name, logo, website link, short description, active status, and display order.

---

## Orders

**Admin > Orders** — read-only view into every transaction. For each order you can see:

- Items purchased, quantities, and total
- Payment status (`pending`, `paid`, `expired`, `failed`)
- The raw Midtrans response for that transaction

Status updates automatically the moment Midtrans confirms a payment — nothing to do manually here. Midtrans calls back to the app on `/midtrans/callback`, and that callback is verified with a cryptographic signature check before anything gets updated, so it can't be spoofed.

---

## Messages

**Admin > Inbox** — every conversation from customers (both logged-in users and guest visitors using the site's chat widget) lands here in one place. Open a thread to read it and reply; the customer sees your reply on their side. Unread conversations are flagged with a badge in the sidebar.

---

## Users

**Admin > Users** — manage accounts and roles.

You can create a user directly (name, email, password, role) or edit an existing one. A few safety rails are built in:

- You can't demote the **last remaining admin** to a regular user — the system always keeps at least one admin account.
- You can't delete your own account, or the last remaining admin account.

Use this sparingly — most day-to-day admin work doesn't require creating new admin accounts.
