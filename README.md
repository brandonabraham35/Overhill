# Overhill Junior School — PHP/MySQL Backend

Full backend for the existing static frontend. Stack: PHP 8+, MySQL, PDO, vanilla JS.

## Install (local: XAMPP/MAMP/LAMP)
1. Copy this folder into your web root (e.g. `htdocs/overhill`).
2. Create a MySQL DB and edit `config/config.php` (DB_HOST, DB_NAME, DB_USER, DB_PASS).
3. Open `http://localhost/overhill/install.php`:
   - Step 1: create tables (runs `config/schema.sql`).
   - Step 2: create your administrator account (password is hashed with `password_hash`).
4. **Delete `install.php`** after setup.
5. Admin panel: `admin/login.php`. Public site: `index.html`.

## Structure
- `config/` — `config.php`, `database.php` (PDO), `schema.sql`
- `includes/` — `functions.php` (security/uploads), `auth.php` (sessions, CSRF, timeout)
- `api/` — JSON endpoints (contact, admissions, news, events, staff, leadership, gallery, downloads, faqs, hero, announcements, csrf)
- `admin/` — login/logout, dashboard, CRUD for all modules, gallery & settings
- `uploads/images`, `uploads/documents` — uploaded files
- `js/api.js` — AJAX form submission + dynamic content loaders

## Security
PDO prepared statements, CSRF tokens, output escaping (XSS), secure session cookies + idle timeout, file type/size/MIME validation.

## Connecting more pages
Dynamic loaders activate on containers with these IDs: `newsList`,`newsSearch`,
`eventsList`,`staffList`,`faqList`,`downloadsList`. Any `<form data-api="api/...php">`
auto-submits via AJAX. Add these to the relevant HTML pages to surface content.
