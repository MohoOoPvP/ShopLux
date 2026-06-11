# 🛍️ ShopLux — E-Commerce Platform

> **Mohamad Aswad | 20232022845 | Software Engineering**

![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Blade](https://img.shields.io/badge/Blade-Templates-FF2D20?style=for-the-badge)
![SQLite](https://img.shields.io/badge/SQLite-Database-003B57?style=for-the-badge&logo=sqlite&logoColor=white)

---

## 📌 About The Project

ShopLux is a fully functional e-commerce web application built with Laravel 11. It includes a complete customer-facing storefront and a separate admin panel with role-based access control.

---

## ✅ Features

### 🛒 Customer Side
- Homepage with hero section, featured products & categories
- Product listing with search, filters & sorting
- Product detail page with related products
- Shopping cart (session-based)
- Checkout & order placement
- Customer order history

### ⚙️ Admin Panel
- Dashboard with live stats (orders, revenue, users, products)
- Category management — full CRUD
- Subcategory management — full CRUD
- Product management — full CRUD with image upload
- User management with role assignment (Admin / Customer)
- Order management with status updates

---

## 🔑 Login Credentials

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@shoplux.com | password |
| Customer | customer@shoplux.com | password |

---

## 🗃️ Database Tables

| Table | Description |
|-------|-------------|
| users | All accounts with role column |
| categories | Main product categories |
| subcategories | Sub-groups linked to categories |
| products | All shop products |
| orders | Customer orders |
| order_items | Items inside each order |

---

## 🛠️ Built With

- **Laravel 11** — PHP Framework
- **Blade** — Templating Engine
- **SQLite / MySQL** — Database
- **Eloquent ORM** — Database queries
- **Custom CSS** — No Bootstrap, fully custom design
- **Font Awesome** — Icons

---

## 🚀 How To Run

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

Visit: **http://localhost:8000**

---

## 📁 Project Structure

```
app/
  Http/Controllers/
    Auth/AuthController.php
    Admin/DashboardController.php
    Admin/CategoryController.php
    Admin/SubcategoryController.php
    Admin/ProductController.php
    Admin/UserController.php
    Admin/OrderController.php
    Shop/ShopController.php
  Middleware/AdminMiddleware.php
  Models/User, Category, Subcategory, Product, Order, OrderItem
database/migrations/
resources/views/
  layouts/, auth/, admin/, shop/
routes/web.php
```

---

## 👨‍💻 Developer

**Mohamad Aswad**
Student ID: 20232022845
Software Engineering — Advanced Web Programming
