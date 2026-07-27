# Company Profile & Digital Product Platform

<p>
  <img src="https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 12">
  <img src="https://img.shields.io/badge/PHP-8.4-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.4">
  <img src="https://img.shields.io/badge/Tailwind_CSS-v4-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white" alt="Tailwind CSS v4">
  <img src="https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpinedotjs&logoColor=white" alt="Alpine.js">
  <img src="https://img.shields.io/badge/MySQL-8-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL 8">
  <img src="https://img.shields.io/badge/Docker-Compose-2496ED?style=for-the-badge&logo=docker&logoColor=white" alt="Docker Compose">
  <img src="https://img.shields.io/badge/Vite-7-646CFF?style=for-the-badge&logo=vite&logoColor=white" alt="Vite">
  <img src="https://img.shields.io/badge/ngrok-Tunnel-1F1E37?style=for-the-badge&logo=ngrok&logoColor=white" alt="ngrok">
  <img src="https://img.shields.io/badge/Leaflet-Maps-199900?style=for-the-badge&logo=leaflet&logoColor=white" alt="Leaflet">
  <img src="https://img.shields.io/badge/Midtrans-Snap-0361F0?style=for-the-badge" alt="Midtrans Snap">
  <img src="https://img.shields.io/badge/EmailJS-Contact-FF6C37?style=for-the-badge" alt="EmailJS">
</p>


A **full-featured Company Profile & Digital Product Platform** built with **Laravel 12**.

This platform combines a **company profile website** with a **digital product marketplace**, allowing businesses to showcase their services and sell downloadable digital products within a single system.

The application includes:

* Public company profile website
* Digital product marketplace
* Secure checkout with Midtrans payment
* Automatic digital product delivery
* Admin management panel
* User account area
* Contact system powered by EmailJS (no SMTP required)

---

# Screenshots

## Landing Page
<p align="center">
  <img src="docs/images/LandingPage.png" width="900">
</p>

## Purchase Flow

| Product | Cart | Checkout |
|--------|------|----------|
| <img src="docs/images/Products.png" width="300"> | <img src="docs/images/Cart.png" width="300"> | <img src="docs/images/Checkout.png" width="300"> |

<p align="center">
User purchase flow: <b>Product > Cart > Checkout</b>
</p>

## Admin Dashboard
<p align="center">
  <img src="docs/images/AdminDashboard.png" width="900">
</p>

<p align="center">
  <a href="docs/SHOWCASE.md"><b>See more screenshots ></b></a> — every page, public site through admin panel
</p>

---

# Table of Contents

* [Project Overview](#project-overview)
* [Main Features](#main-features)
* [Application Areas](#application-areas)
* [Menu and Feature Explanation](#menu-and-feature-explanation)
* [Project Structure](#project-structure)
* [Installation Guide](#installation-guide)
* [Frontend Build](#frontend-build)
* [Ngrok Setup](#ngrok-setup)
* [Midtrans Payment Setup](#midtrans-payment-setup)
* [EmailJS Setup](#emailjs-setup)
* [User Flow](#user-flow)
* [Admin Flow](#admin-flow)
* [Security Notes](#security-notes)
* [Documentation Guides](#documentation-guides)

---

# Project Overview

This application combines a **marketing website** and a **transactional digital product platform** into a unified system.

It allows businesses to:

* Present their company profile professionally
* Publish articles and events
* Sell digital products
* Automatically deliver digital downloads after payment
* Manage products and orders through an admin panel

The system follows **Laravel best practices**, using **clean Blade architecture**, modular controllers, and a scalable project structure.

---

# Main Features

| Area           | Features                                    |
| -------------- | ------------------------------------------- |
| Public Website | Company profile, articles, events, products |
| User Area      | Cart, orders, downloads, profile            |
| Admin Panel    | Product management, content management      |
| Payment        | Midtrans Snap integration                   |
| Delivery       | File download or external link              |
| Contact        | EmailJS contact form                        |

---

# Application Areas

The platform consists of **three main areas**.

## Public Website

Accessible without login.

Visitors can:

* View company profile
* Read articles
* Browse events
* Explore digital products
* Contact the company

---

## User Area (Authenticated)

Users access their account after login.

Login page:

```
/login
```

Available features include:

* Cart management
* Checkout
* Order history
* Digital product downloads
* Profile management
* Messaging with admin

Note:

The platform **does not include a traditional dashboard page**.
Users interact with their account through dedicated pages such as **Orders, Cart, and Profile**.

---

## Admin Panel

Admin access:

```
/admin
```

Administrators can manage:

* Products
* Articles
* Events
* Orders
* User messages

Admin routes are protected using authentication and role-based middleware.

---

# Menu and Feature Explanation

## Public Website

Menus available for visitors:

* Home
* About / Vision & Mission
* Articles
* Events
* Products
* Contact

### Contact Form

The contact form uses **EmailJS**, meaning:

* No backend SMTP server required
* Messages are sent from frontend
* Works for both guests and authenticated users

---

## User Area

### Cart

Users can:

* Add products
* Remove products
* Update quantity

---

### Checkout

Checkout creates an order and opens the **Midtrans Snap payment popup**.

---

### Orders

Users can:

* View order history
* Inspect order details
* Download purchased digital products

Downloads are only available after payment confirmation.

---

### Profile

Users can update personal information such as:

* Name
* Email
* Password

---

### Messages

Users can send inquiries to administrators via the messaging system.

---

# Order and Payment System

### Payment Flow

1. User adds product to cart
2. User proceeds to checkout
3. Order is created with status `pending`
4. Midtrans Snap payment popup appears
5. User completes payment
6. Midtrans sends callback to the server
7. Order status updates automatically

---

### Order Status

| Status  | Description         |
| ------- | ------------------- |
| pending | Waiting for payment |
| paid    | Payment successful  |
| expired | Payment timeout     |
| failed  | Payment failed      |

---

# Digital Product Delivery

Products support **two delivery modes**.

## File Delivery

Admin uploads a digital file (ZIP or asset).

Stored in:

```
storage/app/public/templates
```

Users can download the file only after successful payment.

---

## External Link Delivery

Admin provides a URL such as:

* GitHub repository
* Google Drive
* Figma project
* Documentation link

The link becomes visible after payment.

---

# Admin Panel

Admin panel is accessible via:

```
/admin/dashboard
```

---

## Product Management

Admins can:

* Create products
* Edit products
* Delete products
* Upload preview images
* Set price and status
* Choose delivery type

Products can also be manually reordered.

---

## Articles and Events

Admins can publish marketing content including:

* Blog articles
* Event announcements

Routes use **slug-based URLs**.

---

## Order Monitoring

Admins can view and monitor all transactions.

Information available includes:

* Order details
* Payment status
* Midtrans response

---

## Messages

Admins can view and reply to user messages.

---

# Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/
│   │   ├── Client/
│   │   ├── User/
│   │   └── Auth/
│   └── Middleware/

Models/
├── User.php
├── Product.php
├── Order.php
├── OrderItem.php
├── Cart.php
├── Message.php
├── Article.php
├── Event.php
└── CompanyProfile.php

resources/
├── views/
│   ├── layouts/
│   ├── pages/
│   │   ├── admin/
│   │   ├── client/
│   │   └── user/
│   └── components/

routes/
└── web.php

docs/
├── images/
└── guides/
```

---

# Installation Guide

The project runs entirely through **Docker Compose** (PHP-FPM app container, Nginx, MySQL) — no local PHP/MySQL install needed.

Clone repository:

```bash
git clone https://github.com/Dimmlul/CompanyProfile-Laravel
cd CompanyProfile-Laravel
```

Setup environment:

```bash
cp .env.example .env
```

Build and start the containers:

```bash
docker compose up -d --build
```

Run the rest of the setup **inside the app container** — never on the host, since the host and container PHP versions differ and running Composer/Artisan on the host can corrupt `bootstrap/cache`:

```bash
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate --seed
docker compose exec app php artisan storage:link
docker compose exec app npm run build
```

That last step is required, not optional — the site will 500 on every page (`Vite manifest not found`) until the frontend assets are built at least once. See [Frontend Build](#frontend-build) below for the day-to-day dev workflow (`npm run dev` with hot reload) once you're past initial setup.

The app is now available at **http://localhost:8000**.

The seeder creates two accounts you can log in with right away:

| Role | Email | Password |
|---|---|---|
| Admin | `admin@gmail.com` | `admin123` |
| User | `user@gmail.com` | `user123` |

> Any future `composer` / `artisan` / `npm` command should be run the same way, prefixed with `docker compose exec app`.

---

# Frontend Build

From inside the container:

```bash
docker compose exec app npm install
docker compose exec app npm run dev    # development (Vite HMR, port 5173)
docker compose exec app npm run build  # production build
```

---

# Ngrok Setup

The app defaults to plain local access (`http://localhost:8000`). To share it publicly via ngrok:

```bash
ngrok http 8000
```

Then switch the app into ngrok mode with the included helper script, which auto-detects the tunnel URL and updates `.env` + clears caches for you:

```bash
./env-mode.sh ngrok
```

Switch back to local mode anytime with:

```bash
./env-mode.sh local
```

---

# Midtrans Payment Setup

Environment variables:

```
MIDTRANS_SERVER_KEY=xxxx
MIDTRANS_CLIENT_KEY=xxxx
MIDTRANS_IS_PRODUCTION=false
```

Callback URL:

```
/midtrans/callback
```

---

# EmailJS Setup

Create account:

https://www.emailjs.com

Create:

* Email Service
* Email Template
* Public Key

Environment variables:

```
EMAILJS_PUBLIC_KEY=xxxx
EMAILJS_SERVICE_ID=xxxx
EMAILJS_TEMPLATE_ID=xxxx
```

---

# User Flow

1. User registers or logs in
2. Browse products
3. Add to cart
4. Checkout
5. Complete payment
6. Order status updated
7. Download product

---

# Admin Flow

1. Login via `/login`
2. System detects admin role
3. Redirect to `/admin`
4. Manage products
5. Monitor orders
6. Reply to user messages

---

# Security Notes

Security measures implemented include:

* CSRF protection (Midtrans webhook is the only signed exception)
* Baseline security headers (`X-Frame-Options`, `X-Content-Type-Options`, `Referrer-Policy`, `Permissions-Policy`)
* Authenticated routes with role-based admin access
* Image upload validation restricted to safe raster formats (SVG excluded, prevents stored-XSS via embedded scripts)
* Midtrans callback signature verification (`hash_equals`) plus amount-tampering checks
* Order ownership validation and protected, payment-gated digital downloads (private disk)
* Session cookies scoped `Secure` + `HttpOnly` when served over HTTPS
* Minimum 8-character password policy

---

# Documentation Guides

Additional documentation available in the **docs folder**:

- [Screenshot Showcase](docs/SHOWCASE.md) — every page, public site through admin panel
- [Authentication Guide](docs/guides/authentication.md)
- [User Guide](docs/guides/user-guide.md)
- [Admin Guide](docs/guides/admin-guide.md)
