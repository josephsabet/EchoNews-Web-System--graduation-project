# 📰 EchoNews — Editorial News Platform

> A premium, bilingual editorial news management system built with PHP (MVC architecture), MySQL, and vanilla CSS.

---

## 🌟 Overview

**EchoNews** is a full-stack web application designed for publishing and managing verified news content. It features a beautiful public-facing editorial website alongside a powerful administrative backend — all built with a clean **Model-View-Controller (MVC)** pattern in raw PHP, without any heavy framework.

The platform supports **Arabic and English** seamlessly, with a real-time translation engine and RTL/LTR layout switching.

---

## ✨ Key Features

### 🗞️ Public Site
- **Bento-Box Homepage Grid** — Premium responsive editorial layout with hover animations
- **Featured Article Hero** — First news card spans full-width with a magazine-style layout
- **Popular News Slider** — Auto-scrolling horizontal carousel of trending stories
- **Single Post View** — Two-column editorial layout with read-time estimation and a related news sidebar
- **Category Browsing** — Filter and browse posts by category
- **Author Search** — Find all articles published by a specific journalist
- **Full-Text Search** — Search news by keyword

### 🌍 Bilingual Support (AR / EN)
- One-click toggle between **English (LTR)** and **Arabic (RTL)**
- Static UI strings translated via a built-in localization system (`__()` helper)
- Dynamic database content (titles, article bodies) translated via **Google Translate API**
- File-based **translation cache** (`translation_cache.json`) for high performance — avoids redundant API calls
- All buttons, arrows, and animations are **mathematically mirrored** for RTL layouts

### 🌙 Dark / Light Mode
- System-wide theme toggle stored in `localStorage`
- Powered by CSS custom properties (`--bg-light`, `--text-main`, `--primary-blue`, etc.)
- Applies consistently across both the public site and the admin dashboard

### 🔐 Authentication System
- **Journalist Application Flow** — Users register and await admin approval
- **Pending Approval Queue** — Admins review and accept/reject journalist applications
- **Role-based access control** — `admin` vs `author` roles with protected routes
- **Session-based authentication** with `auth_check.php` guards on all admin pages
- Clean full-screen login/signup pages with no distracting navigation

### 🛠️ Admin Dashboard
- **Sidebar layout** — Fixed dark sidebar with icon-only collapse on mobile
- **Manage News** — Create, edit, and delete news posts with cover image uploads
- **Categories Manager** — Add, edit, and remove categories inline
- **Authors Manager** — View all journalists, upgrade to admin, or remove access
- **Pending Authors** — Review and approve/reject journalist applications
- All admin forms use the unified **admin-form** design system

---

## 🏗️ Architecture

The project follows a clean **MVC (Model-View-Controller)** pattern:

```
news/
├── controllers/          # Business logic layer
│   ├── AuthController.php      # Login, signup, logout
│   ├── AuthorController.php    # Author & pending author management
│   ├── CategoryController.php  # Category CRUD
│   ├── HomeController.php      # Homepage data fetching
│   ├── PageController.php      # Single post & category pages
│   └── PostController.php      # News post CRUD (admin)
│
├── models/               # Database abstraction layer
│   ├── Post.php                # News post queries
│   ├── Author.php              # User/author queries
│   └── Category.php            # Category queries
│
├── core/                 # Framework core
│   ├── Database.php            # Singleton MySQLi connection
│   ├── autoloader.php          # PSR-4 style class autoloader
│   ├── lang.php                # Localization + Google Translate API
│   └── translation_cache.json  # Translation cache file
│
├── views/                # Presentation layer
│   ├── layouts/                # Shared page wrappers
│   │   ├── header.php          # Public site header + navbar
│   │   ├── footer.php          # Public site footer
│   │   ├── admin_header.php    # Admin sidebar layout (open)
│   │   ├── admin_footer.php    # Admin layout (close)
│   │   ├── auth_header.php     # Standalone auth page wrapper
│   │   └── auth_footer.php     # Auth page close tag
│   ├── auth/                   # Login & Signup forms
│   ├── home/                   # Homepage view
│   ├── pages/                  # Single post, category, search views
│   ├── posts/                  # Dashboard, create, edit news
│   ├── authors/                # Authors & pending authors views
│   └── categories/             # Category management views
│
├── css/                  # Stylesheets
│   ├── global.css              # Design system: variables, typography, auth forms, responsive
│   ├── index.css               # Bento homepage grid & slider
│   ├── post.css                # Editorial single post layout
│   ├── dashBoard.css           # Admin sidebar layout & tables
│   └── ...                     # Legacy per-page stylesheets
│
├── pages/                # Front-controller entry points (public)
├── dashboard/            # Front-controller entry points (admin)
├── functions/            # Utility scripts (delete, approve, logout, etc.)
└── uploads/              # User-uploaded cover images
```

---

## 🎨 Design System

All colors and theme values are managed through **CSS custom properties**:

| Variable | Light Mode | Dark Mode |
|---|---|---|
| `--primary-blue` | `#4F46E5` | `#6366F1` |
| `--dark-blue` | `#4338CA` | `#818CF8` |
| `--bg-light` | `#F8FAFC` | `#0F172A` |
| `--bg-white` | `#FFFFFF` | `#1E293B` |
| `--text-main` | `#334155` | `#F1F5F9` |
| `--text-muted` | `#94A3B8` | `#94A3B8` |
| `--border-color` | `#E2E8F0` | `#334155` |

**Typography:** `Merriweather` (serif, headings) + `Inter` (sans-serif, body)

---

## ⚙️ Tech Stack

| Layer | Technology |
|---|---|
| **Backend** | PHP 8+ (raw MVC, no framework) |
| **Database** | MySQL via MySQLi (Singleton pattern) |
| **Frontend** | Vanilla HTML5, CSS3 (Custom Properties, Grid, Flexbox) |
| **Fonts** | Google Fonts — Inter & Merriweather |
| **Translation** | Google Translate Unofficial API + File Cache |
| **Server** | Apache via XAMPP |

---

## 🚀 Getting Started

### Prerequisites
- [XAMPP](https://www.apachefriends.org/) with **PHP 8+** and **MySQL**
- Apache running on port `80`
- MySQL running on port `3307` (or update `core/Database.php`)

### Installation

**1. Clone the repository**
```bash
git clone https://github.com/your-username/echonews.git
cd xampp/htdocs/news
```

**2. Create the database**

Import the SQL schema into MySQL (via phpMyAdmin or CLI):
```sql
CREATE DATABASE news CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```
Then import your schema tables (`posts`, `users`, `categories`).

**3. Configure the database connection**

Edit `core/Database.php` and set your credentials:
```php
private $host   = "127.0.0.1";
private $user   = "root";
private $pass   = "";
private $dbname = "news";
private $port   = 3307;
```

**4. Set permissions**

Ensure the `uploads/` and `core/translation_cache.json` are writable:
```bash
chmod 775 uploads/
chmod 664 core/translation_cache.json
```

**5. Visit the site**
```
http://localhost/news/pages/index.php
```

---

## 👤 User Roles

| Role | Permissions |
|---|---|
| **Visitor** | Browse news, search, read articles |
| **Author** | All of the above + create/edit/delete own news posts |
| **Admin** | All of the above + manage authors, approve journalists, manage categories |

---

## 📁 Key Pages

| URL | Description |
|---|---|
| `/pages/index.php` | Homepage — Bento grid + slider |
| `/pages/post.php?id=X` | Single news article view |
| `/pages/category.php?category=X` | Category filtered news |
| `/pages/search.php?q=X` | Search results |
| `/pages/login.php` | Journalist login |
| `/pages/signup.php` | Apply as journalist |
| `/dashboard/dashBoard.php` | Admin — Manage news posts |
| `/dashboard/insert.php` | Admin — Create news post |
| `/dashboard/admincategories.php` | Admin — Manage categories |
| `/dashboard/authors.php` | Admin — Manage authors |
| `/dashboard/pendingauthors.php` | Admin — Approve pending journalists |

---

## 📸 Screenshots

> *(Add screenshots of your homepage, single post, and admin dashboard here)*

---

## 🔮 Roadmap

- [ ] Rich Text Editor (TinyMCE / Quill) for news body
- [ ] Pagination for news listings
- [ ] Comments system
- [ ] Email notifications for journalist approvals
- [ ] REST API for mobile app integration
- [ ] Full MVC Front-Controller routing (`index.php?route=...`)

---

## 📄 License

This project is for educational and personal use. All rights reserved © 2025 EchoNews.

---

*Built with yousef sami using PHP, MySQL, and vanilla CSS — no heavy frameworks needed.*
