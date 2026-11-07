# Campus Notes

Campus Notes is a Laravel application with a responsive public website and an authenticated workspace.

## Public website pages

- `/` — Home
- `/features` — Features
- `/how-it-works` — How it works
- `/about` — About
- `/contact` — Contact / getting started
- `/login` and `/register` — Laravel authentication pages

The public website uses reusable Blade layout and partials in `resources/views/frontend`, with its own CSS and JavaScript in `public/frontend`.

## Local setup

1. Make a copy of `.env.example` and name it `.env`.
2. Update the database credentials in `.env` for your local MySQL setup. The example database name is `campus_notes`.
3. Generate an application key:

   ```bash
   php artisan key:generate
   ```

4. Create the configured database, then run migrations:

   ```bash
   php artisan migrate
   ```

5. Start the development server:

   ```bash
   php artisan serve
   ```

Open the local URL shown by Laravel Artisan. Use the **Login** and **Get started** links in the public navbar to access the existing authentication flow.

## Frontend structure

```text
resources/views/frontend/
├── layouts/app.blade.php
├── partials/
│   ├── navbar.blade.php
│   └── footer.blade.php
└── pages/
    ├── home.blade.php
    ├── features.blade.php
    ├── how-it-works.blade.php
    ├── about.blade.php
    └── contact.blade.php

public/frontend/
├── css/app.css
└── js/app.js
```

The navigation collapses into an accessible mobile menu on smaller screens. Existing backend/dashboard views and Laravel authentication routes are retained.

## Notes

- The original local `.env` and Git history are not included in this delivery. Configure your own `.env` from `.env.example`.
- Existing Composer dependencies were retained as supplied; no dependency upgrades were made as part of the frontend integration.

## Blog CMS & SEO

The project includes a responsive public blog, article detail pages and a Stisla admin CMS with categories, tags, scheduled publishing, media uploads and Yoast SEO-style content analysis. Setup, routes and SEO controls are documented in [BLOG_CMS_SETUP.md](BLOG_CMS_SETUP.md). Run `php artisan storage:link` after configuring the database so blog images are publicly accessible.
