# Laravel Artisan Cheatsheet

Panduan ringkas & lengkap perintah `php artisan` beserta fungsi utamanya.

---

## 🔑 Setup & Security
- php artisan key:generate  
  → Generate `APP_KEY` (WAJIB setelah install Laravel / clone project)

- php artisan config:clear  
  → Hapus cache konfigurasi

- php artisan config:cache  
  → Cache config (untuk production)

- php artisan route:clear  
  → Hapus cache route

- php artisan view:clear  
  → Hapus cache blade

- php artisan optimize:clear  
  → Clear semua cache (config, route, view)

---

## 🚀 Server & Debug
- php artisan serve  
  → Menjalankan server Laravel

- php artisan serve --port=8080  
  → Menjalankan server di port tertentu

- php artisan tinker  
  → Console interaktif (cek model, query, dll)

- php artisan route:list  
  → Melihat semua route

---

## 🗄️ Database & Migration
- php artisan migrate  
  → Jalankan semua migration

- php artisan migrate:fresh  
  → Drop semua tabel & migrate ulang

- php artisan migrate:fresh --seed  
  → Migrate ulang + seeder

- php artisan migrate:rollback  
  → Rollback 1 batch migration

- php artisan migrate:rollback --step=3  
  → Rollback 3 migration terakhir

- php artisan migrate:status  
  → Melihat status migration

---

## 🧩 Model, Controller & Resource
- php artisan make:model Product  
  → Membuat model

- php artisan make:model Product -m  
  → Model + migration

- php artisan make:model Product -mc  
  → Model + migration + controller

- php artisan make:model Product -mcr  
  → Model + migration + controller resource

- php artisan make:controller ProductController  
  → Controller biasa

- php artisan make:controller ProductController --resource  
  → Controller resource (index, create, store, dll)

---

## 🧱 Migration & Seeder
- php artisan make:migration create_products_table  
  → Membuat file migration

- php artisan make:seeder ProductSeeder  
  → Membuat seeder

- php artisan db:seed  
  → Menjalankan semua seeder

- php artisan db:seed --class=ProductSeeder  
  → Jalankan seeder tertentu

---

## 🧬 Factory & Faker
- php artisan make:factory ProductFactory  
  → Membuat factory

- php artisan make:factory ProductFactory --model=Product  
  → Factory langsung ke model

---

## 🧠 Component & Blade
- php artisan make:component Alert  
  → Component class + view

- php artisan make:component Alert --view  
  → Hanya file blade component

- php artisan make:component Alert --inline  
  → Component tanpa file blade

---

## 🧰 Middleware & Request
- php artisan make:middleware AuthAdmin  
  → Membuat middleware

- php artisan make:request StoreProductRequest  
  → Form request validation

---

## 🔐 Auth & Breeze
- php artisan breeze:install  
  → Install auth (login, register)

- php artisan migrate  
  → Jalankan migration auth

---

## 📦 Queue, Job & Event
- php artisan make:job SendEmailJob  
  → Membuat job

- php artisan make:event OrderCreated  
  → Membuat event

- php artisan make:listener SendEmailNotification  
  → Membuat listener

---

## 📁 Storage & Link
- php artisan storage:link  
  → Menghubungkan storage ke public

---

## 🧪 Testing
- php artisan make:test UserTest  
  → Test feature

- php artisan make:test UserTest --unit  
  → Test unit

- php artisan test  
  → Menjalankan semua test

---

## 🧹 Maintenance
- php artisan down  
  → Maintenance mode

- php artisan down --secret=admin  
  → Maintenance dengan secret URL

- php artisan up  
  → Keluar dari maintenance

---

## 📌 Tips Penting
- Gunakan `-m` saat buat model → hemat waktu
- Gunakan `optimize:clear` jika perubahan tidak muncul
- Jangan ganti `APP_KEY` di production
