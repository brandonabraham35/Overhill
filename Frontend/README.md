# Overhill Junior School — Website

A complete **frontend-only** website built with **HTML5 + CSS3** (Flexbox & CSS Grid)
and a small amount of vanilla JavaScript for the slider and menus.
No frameworks (no React/Vue/Angular/Bootstrap/Tailwind).

## Motto
> Knowledge Is Power

## How to view
Open `index.html` in any web browser. No build step or server required.

## File structure
```
overhill-junior-school/
├── index.html                 Home page (hero slider, cards, news, CTA)
├── why-overhill.html          Section landing  (+ 8 sub-pages)
├── facilities.html            Section landing  (+ 11 sub-pages)
├── parents.html               Section landing  (+ 7 sub-pages)
├── students.html              Section landing  (+ 6 sub-pages)
├── special-programmes.html    Section landing  (+ 7 sub-pages)
├── news-events.html           Section landing  (+ 4 sub-pages)
├── contact.html               Contact + form + map placeholder
├── admin-login.html           Admin login UI (auth placeholders only)
├── admin-dashboard.html       Admin dashboard (sidebar, cards, tables, forms, stats)
├── css/
│   ├── style.css              Main site styles + full responsive design
│   └── admin.css              Admin panel styles
├── js/
│   └── main.js                Slider, sticky nav, mobile menu, dropdowns
└── images/                    Logo, hero & section images
```
50+ public HTML pages plus the two admin pages.

## Content Management
No school content is hardcoded into editable areas. Pages use CMS-ready
placeholders such as `{{school_name}}`, `{{mission}}`, `{{vision}}`,
`{{history}}`, `{{headteacher_message}}`, `{{staff_list}}`, `{{news_articles}}`,
`{{events}}`, `{{gallery_images}}`. A backend can populate these later.

## Admin area
- `admin-login.html` — login UI only. **No usernames/passwords are hardcoded.**
  Authentication, session and database logic are left as commented placeholders.
- `admin-dashboard.html` — manage News, Events, Gallery, Downloads, Staff,
  Admissions, Notices, Hero Slides and FAQs. Designed for future backend
  integration. Only one administrator account is intended once connected.

## Real data included (from the requirements document)
School name, motto, vision, mission, core values, founding history,
telephone numbers, email, address and establishment year.

## Notes
- Google Maps and the contact form are visual placeholders ready for wiring.
- Replace images in `/images/` with official school photography when available.
