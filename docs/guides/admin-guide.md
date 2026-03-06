# Admin Guide

This guide explains how administrators manage the platform.

---

## Admin Login

Admins use the same login page as users.

Login URL:

/login

If the account has admin privileges, it will redirect to:

/admin/dashboard

---

## Admin Dashboard

The admin dashboard provides an overview of:

- Products
- Orders
- Messages
- Content

---

## Product Management

Admins can manage digital products.

### Create Product

Steps:

1. Open **Admin → Products**
2. Click **Create Product**
3. Fill in:

- Title
- Description
- Price
- Preview image
- Delivery type

---

## Delivery Types

Products support two delivery methods.

### File Delivery

Admin uploads file.

Storage location:

storage/app/public/templates

Users can download file after payment.

---

### External Link Delivery

Admin provides external URL such as:

- GitHub
- Google Drive
- Figma
- Documentation site

Users can access the link after payment.

---

## Product Ordering

Admins can manually reorder products. 

Options:

- Move to top
- Move up
- Move down
- Move to bottom

---

## Order Management

Admins can view all orders.

Steps:

1. Open **Admin → Orders**
2. View order details
3. Check payment status
4. Inspect Midtrans response

Order status updates automatically through **Midtrans callback**.

---

## Articles & Events

Admins can publish marketing content.

Steps:

1. Open **Admin → Articles**
2. Create new content

---

## User Messages

Admins can manage user inquiries.

Steps:

1. Open **Admin → Messages**
2. Read messages
3. Reply to users
