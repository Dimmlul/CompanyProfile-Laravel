# 🚀 Company Profile & Digital Product Platform (Laravel)

A **full-featured Company Profile & Digital Product Platform** built with **Laravel 12**, designed for businesses that sell **digital services, templates, or downloadable products**, complete with:

- Public company profile website  
- Digital product marketplace  
- Secure checkout & Midtrans payment  
- Automatic digital delivery (file / external link)  
- Admin dashboard  
- User dashboard  
- Contact system using EmailJS (no SMTP)

This project is suitable for:

- Software houses  
- Digital agencies  
- SaaS landing pages  
- Digital product sellers  
- Internal company profile + admin system  

---

## 📑 Table of Contents

1. [Project Overview](#-project-overview)
2. [Why Ngrok Is Required](#-why-ngrok-is-required)
3. [Main Features Overview](#-main-features-overview)
4. [Menu & Feature Explanation](#-menu--feature-explanation)
   - [Public Website](#-public-website-client-side)
   - [User Area](#-user-area-authenticated)
   - [Order & Payment](#-order--payment-system)
   - [Digital Product Delivery](#-digital-product-delivery)
   - [Admin Panel](#-admin-panel)
5. [Tech Stack](#-tech-stack)
6. [Project Structure](#-project-structure-very-detailed)
7. [Installation Guide](#-installation-guide)
8. [Frontend Build (Vite)](#-frontend-build-vite)
9. [Ngrok Setup](#-ngrok-setup)
10. [Midtrans Payment Setup](#-midtrans-payment-setup)
11. [EmailJS Contact Setup](#-emailjs-contact-setup)
12. [User Flow](#-user-flow)
13. [Admin Flow](#-admin-flow)
14. [Security Notes](#-security-notes)

---

## 📌 Project Overview

This application combines a **marketing website** and a **transactional digital product system** into one unified platform.

### Core Goals

- Showcase company profile professionally  
- Sell digital products or services  
- Automate payment confirmation  
- Automatically unlock downloads after payment  
- Clearly separate concerns between **Admin**, **User**, and **Public**

The system follows **Laravel best practices**, **clean Blade architecture**, and a **scalable folder structure**.

---

## 🌍 Why Ngrok Is Required

### ❓ Why not localhost only?

Some third-party services **cannot access `localhost`**, including:

| Service            | Reason                                  |
|--------------------|------------------------------------------|
| Midtrans Callback  | Needs a public URL to send payment status |
| EmailJS            | Requires a public origin                 |
| Webhooks           | Cannot reach local machine               |

---

### ✅ What Ngrok Solves

Ngrok exposes your local Laravel server to the internet:

- Local: <http://localhost:8000>  
- Public: <https://xxxx.ngrok-free.dev>

This allows:

- Midtrans to send **server-to-server callbacks**
- EmailJS to work correctly
- Full end-to-end payment testing locally

> **Ngrok is mandatory for local Midtrans testing.**

---

## ✨ Main Features Overview

| Area     | Features                                      |
|----------|-----------------------------------------------|
| Public   | Company profile, products, articles, contact  |
| User     | Orders, downloads, profile                    |
| Admin    | Product, content, orders, messages            |
| Payment  | Midtrans Snap                                 |
| Delivery | File download or external link                |
| Contact  | EmailJS (no SMTP)                             |

---

## 📂 Menu & Feature Explanation

## 🌐 Public Website (Client Side)

Accessible **without login**.

### Menus

- **Home** – Landing page with company overview  
- **About / Vision & Mission** – Company identity & direction  
- **Articles** – Blog / news content  
- **Events** – Company or marketing events  
- **Products** – Digital products or services catalog  
- **Contact** – Contact form powered by EmailJS  

### Contact Form

- No SMTP or backend email server  
- Uses EmailJS (frontend only)  
- Works for guest & authenticated users  

---

## 👤 User Area (Authenticated)

Accessible after login.

### Menus

#### Cart
- Add / remove products  
- Update quantity  

#### Checkout
- Create order  
- Redirect to Midtrans Snap  

#### Orders
- Order history  
- Order detail  
- Download file / open external link after payment  

#### Profile
- Update user information  

#### Messages
- Contact admin  
- Reply to admin messages  

---

## 🛒 Order & Payment System

### Flow

1. User adds product to cart  
2. Checkout generates an order  
3. Midtrans Snap opens  
4. Payment completed  
5. Midtrans sends callback  
6. Order status updated automatically  

### Payment Status

- `pending`  
- `paid`  
- `expired`  
- `failed`  

---

## 📦 Digital Product Delivery

Each product supports **two delivery modes**.

### 📁 File Delivery

- Admin uploads ZIP / asset file  
- Stored in `storage/app/public/templates`  
- Download unlocked **only after payment**

### 🔗 External Link Delivery

- Admin provides URL (GitHub, Google Drive, Figma, etc.)  
- Link visible after payment  
- Optional fallback link (e.g. <https://github.com/>)

---

## 🛠 Admin Panel

Accessible via `/admin`.

### Menus & Features

#### Products
- Create / edit / delete products  
- Upload preview image  
- Set price & active status  
- Choose delivery type (file / link)  
- Manual ordering (top / up / down / bottom)  

#### Articles & Events
- Content management  
- Slug-based routing  

#### Orders
- View all orders  
- Monitor payment status  
- Inspect Midtrans response  

#### Messages
- Inbox from users  
- Mark as read  
- Reply messages  

---

## 🧱 Tech Stack

| Layer      | Technology              |
|------------|-------------------------|
| Backend    | Laravel 12              |
| Frontend   | Blade + Tailwind CSS v4 |
| Database   | MySQL                   |
| Payment    | Midtrans Snap           |
| Contact    | EmailJS                 |
| Build Tool | Vite                    |
| Tunnel     | Ngrok                   |
| Storage    | Laravel Filesystem      |

---

## 🗂 Project Structure (Very Detailed)

```text
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/        # Admin panel logic
│   │   ├── Client/       # Public website logic
│   │   ├── User/         # User dashboard logic
│   │   └── Auth/         # Authentication logic
│   └── Middleware/       # Request filters & guards
│
├── Models/
│   ├── User.php
│   ├── Product.php
│   ├── Order.php
│   ├── OrderItem.php
│   ├── Cart.php
│   ├── Message.php
│   ├── Article.php
│   ├── Event.php
│   └── CompanyProfile.php
│
resources/
├── views/
│   ├── layouts/          # Base layouts (app, admin)
│   ├── pages/
│   │   ├── admin/        # Admin pages
│   │   ├── client/       # Public pages
│   │   └── user/         # User pages
│   └── components/       # Reusable Blade components
│
routes/
├── web.php               # All web routes
│
database/
├── migrations/           # Database schema
├── seeders/              # Demo / initial data
│
storage/
├── app/public/
│   ├── products/         # Product images
│   └── templates/        # Downloadable digital files
````

---

## ⚙ Installation Guide

### 1️⃣ Clone Repository

```bash
git clone https://github.com/Dimmlul/CompanyProfile-Laravel
cd CompanyProfile-Laravel
```

### 2️⃣ Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env`:

```env
APP_NAME="Company Profile"
APP_ENV=local
APP_URL=http://localhost

DB_DATABASE=companyprofile
DB_USERNAME=root
DB_PASSWORD=
```

---

### 3️⃣ Install Dependencies

```bash
composer install
npm install
```

---

### 4️⃣ Database

```bash
php artisan migrate
php artisan db:seed
```

---

### 5️⃣ Storage

```bash
php artisan storage:link
```

---

## 🎨 Frontend Build (Vite)

Development mode:

```bash
npm run dev
```

Production / Ngrok:

```bash
npm run build
```

**Why `npm run build` with Ngrok?**

* Ensures optimized assets
* Prevents asset mismatch on public URLs
* Recommended for production-like testing

---

## 🌍 Ngrok Setup

Download Ngrok:
[https://ngrok.com/download](https://ngrok.com/download)

Run:

```bash
ngrok http 8000
```

Update `.env`:

```env
APP_URL=https://xxxx.ngrok-free.dev
```

---

## 💳 Midtrans Payment Setup

```env
MIDTRANS_SERVER_KEY=SB-Mid-server-xxxx
MIDTRANS_CLIENT_KEY=SB-Mid-client-xxxx
MIDTRANS_IS_PRODUCTION=false
```

Callback URL (Midtrans Dashboard):

[https://your-ngrok-url.ngrok-free.dev/midtrans/callback](https://your-ngrok-url.ngrok-free.dev/midtrans/callback)

---

## ✉ EmailJS Contact Setup

1. Create account: [https://www.emailjs.com](https://www.emailjs.com)
2. Create:

   * Email Service
   * Email Template
   * Public Key

`.env`:

```env
EMAILJS_PUBLIC_KEY=xxxx
EMAILJS_SERVICE_ID=xxxx
EMAILJS_TEMPLATE_ID=xxxx
```

---

## 🔄 User Flow

1. User registers / logs in
2. Browse products
3. Add to cart
4. Checkout & pay
5. Midtrans callback updates order
6. Download / link unlocked
7. Contact admin if needed

---

## 🛠 Admin Flow

1. Login at `/admin`
2. Manage products & content
3. Upload file or set external link
4. Monitor orders
5. Reply user messages

---

## 🔐 Security Notes

* Order access restricted by `user_id`
* Downloads available only after payment
* CSRF protection enabled
* Admin routes protected by authentication

---
