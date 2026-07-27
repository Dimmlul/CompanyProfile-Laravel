# User Guide

How to browse, buy, and manage digital products as a customer on this platform.

**In this guide:** [Create an account](#create-an-account) · [Browse products](#browse-products) · [Add to cart or buy now](#add-to-cart-or-buy-now) · [Checkout & payment](#checkout--payment) · [Track your order](#track-your-order) · [Download your purchase](#download-your-purchase) · [Message the admin](#message-the-admin) · [Manage your profile](#manage-your-profile)

---

## Create an account

1. Open the site and click **Register**
2. Fill in your **name**, **email**, and a **password** (8+ characters)
3. Submit — you're redirected to the login page
4. Log in at `/login` with the same email and password

See the [Authentication Guide](authentication.md) for the full login/session details.

> Tip: use the sun/moon icon in the navbar anytime to switch between light and dark mode — your choice is remembered on your next visit.

---

## Browse products

The **Products** page lists everything available. Each listing shows:

- Title and short description
- Price
- Preview image

Click any product to see its full detail page — pricing, delivery type ("instant file download" or "access via link"), and full description.

---

## Add to cart or buy now

On a product's detail page you have two options:

| Button | What it does |
|---|---|
| **Add to Cart** | Adds the product to your cart so you can keep browsing and buy multiple items together |
| **Buy Now** | Adds it to your cart *and* jumps straight to checkout — the fast path if you already know what you want |

From the **Cart** page, you can:

- Adjust quantity
- Remove an item
- Proceed to checkout when ready

---

## Checkout & payment

1. From the cart, click **Proceed to Secure Payment**
2. Review your order summary and confirm your email
3. This creates an order (status: `pending`) and opens the **Midtrans Snap** payment popup
4. Choose a payment method and complete the payment

Available methods depend on what's enabled on the store's Midtrans account, but typically include:

- Bank transfer / virtual account (BCA, Mandiri, BNI, BRI, ...)
- QRIS
- E-wallets (GoPay, ShopeePay, ...)
- Credit/debit card

Once Midtrans confirms the payment, your order status updates automatically — you don't need to refresh or do anything else.

---

## Track your order

Order statuses you might see under **Orders**:

| Status | Meaning |
|---|---|
| `pending` | Waiting for payment |
| `paid` | Payment confirmed — download unlocked |
| `expired` | The payment window closed before you paid |
| `failed` | The payment attempt didn't go through |

Open any order to see its items, total, and current status.

---

## Download your purchase

Once an order shows **paid**:

1. Go to **Orders**
2. Open the order detail
3. Click the download button (for file-delivery products) or the access link (for link-delivery products, e.g. a Figma/Drive/GitHub URL)

Downloads only unlock after payment is confirmed — there's no way to access them from a pending or unpaid order.

---

## Message the admin

Have a question about a product or an order? Use the built-in messaging system:

1. Open **Messages**
2. Write your message and send it
3. The admin team replies from their side, and you'll see the reply in the same thread

---

## Manage your profile

From the **Profile** page you can update:

- Name
- Email
- Password (leave blank to keep your current one)
