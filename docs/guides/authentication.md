# Authentication Guide

This document explains how authentication and role-based access control work in the platform.

---

## Registration

New users can create an account through the registration page.

Registration URL:

/register

The registration form requires:

- Name
- Email
- Password
- Password confirmation

After successful registration, users can log in using their credentials.

---

## Login System

Both **users and administrators use the same login page**.

Login URL:

/login

The login form requires:

- Email
- Password

---

## Authentication Flow

1. User enters credentials
2. System validates account
3. Session is created
4. System checks the user role
5. User is redirected accordingly

---

## Role Based Access

| Role | Redirect |
|-----|---------|
| Admin | /admin |
| User | / |

Regular users are redirected to the homepage.

The platform does not include a dedicated user dashboard.  
Users interact with the system through pages such as:

- Products
- Cart
- Orders
- Profile

---

## Route Protection

Admin routes are protected using middleware.

Example admin routes:

/admin/products  
/admin/orders  
/admin/messages  

Regular users cannot access admin routes.

---

## Logout

Users can logout through the navigation menu.

Logout will:

- Destroy session
- Redirect to home page
