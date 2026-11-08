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

## CampusNotes academic resource frontend

The public frontend now follows the supplied `campusnotes.html` navy/blue academic resource-hub direction. It includes dedicated routes and Blade files for Browse, Departments, Previous Questions, Assignments, Community, Contributors, Resource Details, Upload, Student Dashboard, Bookmarks and FAQ. Features, How it works, About, Contact and the existing Blog are also linked from the navigation/footer. See [CAMPUSNOTES_FRONTEND_INTEGRATION.md](CAMPUSNOTES_FRONTEND_INTEGRATION.md) for the complete route/view map and feature inventory.

### Database-backed academic features

Run the new migrations and seeders before using the resource library:

```bash
php artisan migrate --force
php artisan db:seed --force
php artisan storage:link
```

The seeders add departments and clearly-labelled metadata-only sample resources. Uploaded documents are stored on the public disk, enter the pending moderation queue, and are published only after an administrator approves them. The admin sidebar includes Resource Moderation and Contact Inbox items, protected by the new Spatie permissions.

### New frontend structure

```text
resources/views/frontend/
├── layouts/app.blade.php
├── partials/
│   ├── navbar.blade.php
│   ├── footer.blade.php
│   └── resource-card.blade.php
├── pages/
│   ├── home.blade.php
│   ├── departments.blade.php
│   ├── community.blade.php
│   ├── contributors.blade.php
│   ├── faq.blade.php
│   ├── features.blade.php
│   ├── how-it-works.blade.php
│   ├── about.blade.php
│   └── contact.blade.php
├── resources/
│   ├── browse.blade.php
│   ├── department.blade.php
│   ├── questions.blade.php
│   ├── assignments.blade.php
│   ├── show.blade.php
│   └── upload.blade.php
└── student/
    ├── dashboard.blade.php
    └── bookmarks.blade.php
```
