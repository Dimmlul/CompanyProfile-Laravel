# Authentication Guide

How login, registration, and role-based access work in this platform.

**In this guide:** [Registration](#registration) · [Login](#login) · [What happens after login](#what-happens-after-login) · [Admin vs. User access](#admin-vs-user-access) · [Session & security](#session--security) · [Logout](#logout)

---

## Registration

New visitors create an account at:

```
/register
```

The form asks for:

| Field | Notes |
|---|---|
| Name | Any display name |
| Email | Must be unique — one account per email |
| Password | Minimum **8 characters** |
| Password confirmation | Must match the password field |

Every new registration is created with the regular **`user`** role automatically — there's no self-service way to become an admin (see [Admin vs. User access](#admin-vs-user-access)).

> To limit abuse, registration is rate-limited to 5 attempts per minute per IP address.

Once registered, log in with the same email and password.

---

## Login

Both regular users and admins share the **same login page** — the system figures out where to send you after checking your credentials:

```
/login
```

Required fields: **email** and **password**.

> Login is rate-limited to 8 attempts per minute per IP address, to slow down brute-force guessing.

---

## What happens after login

```
1. You submit your email + password
2. The system verifies them against the database
3. A session is created for your browser
4. The system checks your account's role
5. You're redirected based on that role
```

| Role | Redirected to | What that means |
|---|---|---|
| `admin` | `/admin/dashboard` | Full access to the admin panel |
| `user` | `/` (homepage) | Normal shopping/browsing experience |

There's no separate "user dashboard" — regular users manage their account through dedicated pages instead: **Products, Cart, Orders, Messages, Profile.**

---

## Admin vs. User access

Access is enforced in two directions, not just one:

- **Admin routes are locked to admins.** Every `/admin/*` route (products, orders, messages, users, etc.) requires both an authenticated session *and* the `admin` role. A regular user hitting one of these URLs directly gets blocked, not just hidden from the menu.
- **Admin accounts can't shop.** This is the flip side, and easy to miss: admin accounts are intentionally blocked from adding items to cart or going through checkout. Admins manage the store — they don't buy from it. If you're logged in as an admin and want to test the buying flow, log in with a regular user account instead.

---

## Session & security

A few things worth knowing about how sessions are kept safe, without needing to touch any code:

- **CSRF protection** is on for every form (login, register, cart, checkout, admin forms) except the Midtrans payment webhook, which is verified a different way (a cryptographic signature check instead of a CSRF token, since Midtrans's server — not your browser — calls that endpoint).
- **Passwords are hashed**, never stored or logged in plain text.
- **Session cookies** are marked `HttpOnly` always, and `Secure` whenever the site is served over HTTPS (i.e. not on plain local `http://localhost`).

---

## Logout

Available from the account menu in the navbar (public site) or the header (admin panel). Logging out:

1. Destroys the current session
2. Redirects you to the homepage
