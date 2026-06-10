# Overhill Junior School - Deployment Checklist & Configuration Guide

This document outlines the steps required to move the Overhill Junior School website from a local/development environment to a production server.

## 1. File Configuration

The following files **must** be updated with production-specific values before uploading.

### `/config/config.php`
- **Database Connection:** Update `DB_HOST`, `DB_NAME`, `DB_USER`, and `DB_PASS`.
- **Environment Variables:** It is highly recommended to use environment variables (`OJS_DB_HOST`, etc.) on production instead of hardcoding credentials.
- **Upload URL:** If your site is hosted in a subdirectory, update `UPLOAD_URL` (e.g., `/school/uploads`).

### `/api/csrf.php`
- Ensure this file is correctly issuing tokens from the production session. (Already implemented, but verify session cookies work on your domain).

---

## 2. Database Initialization

1.  **Create Database:** Create a new MySQL database (e.g., `overhill_school`) with `utf8mb4_general_ci` collation.
2.  **Import Schema:** Run the SQL commands found in `/config/schema.sql` to create the necessary tables.
3.  **Create Admin User:** Run the `/install.php` script from your browser (e.g., `https://yourdomain.com/install.php`) to create the initial administrator account.
4.  **Security Note:** **DELETE** `install.php` immediately after creating your admin account.

---

## 3. Server Requirements & Permissions

### Requirements
- **PHP 8.0+** with `pdo_mysql` and `gd` (for image processing) extensions.
- **MySQL 5.7+** or **MariaDB 10.3+**.

### Directory Permissions
The following directories must be writable by the web server (usually user `www-data` or `apache`):
- `/uploads/` (and its subdirectories `/uploads/images` and `/uploads/documents`)
- Ensure recursive write permissions: `chmod -R 755 uploads/`

---

## 4. Security Checklist

- [ ] **HTTPS:** Enable SSL/TLS. The site is configured with `samesite=Lax` and `httponly` cookies which perform best over HTTPS.
- [ ] **Delete Installer:** Remove `install.php` after setup.
- [ ] **Disable Errors:** In production, ensure `display_errors` is set to `Off` in your `php.ini`.
- [ ] **API Access:** All API endpoints are protected by `X-CSRF-Token` for POST requests. Verify this is working by attempting a form submission.
- [ ] **Folder Listing:** Ensure `Options -Indexes` is set in your `.htaccess` or server config to prevent directory snooping.

---

## 5. Deployment Steps

1.  Upload all files to the server root (or your desired subdirectory).
2.  Configure `/config/config.php`.
3.  Import the database schema.
4.  Visit `yourdomain.com/install.php` to setup the Admin.
5.  Log in at `yourdomain.com/admin/login.php` to begin populating content (News, Events, Slider, etc.).
6.  Verify that images and assets load correctly on the frontend.

---
*Prepared by Jules, Software Engineer.*
