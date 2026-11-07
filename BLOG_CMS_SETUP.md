# Campus Notes Blog CMS & SEO setup

The blog CMS is built into the existing Laravel application. It provides a public blog index and article pages, plus authenticated post/category management in the Stisla admin panel.

## First-time setup

1. Copy `.env.example` to `.env`, then configure `APP_URL`, database credentials and `APP_TIMEZONE` (default: `Asia/Dhaka`).
2. Generate the application key with `php artisan key:generate`.
3. Create the configured MySQL database and run `php artisan migrate` to create the blog tables.
4. Run `php artisan db:seed` on a fresh installation so the existing Spatie blog permissions are seeded and the default administrator is created. Do not re-run the admin seeder on a live database without checking its duplicate-user behavior.
5. Run `php artisan storage:link` so uploaded featured and in-content images can be served from `/storage`.
6. Sign in with an account that has the existing `blog-list`, `blog-create`, `blog-edit` and `blog-delete` permissions. The project's existing Super Admin role receives all permissions during a fresh seed.

## Admin routes

- `/admin/blog/posts` — post list, search and status/category filters
- `/admin/blog/posts/create` — create a post
- `/admin/blog/categories` — category management

## Public routes

- `/blog` — public blog listing and search
- `/blog/{slug}` — single article
- `/blog/category/{slug}` — category archive
- `/sitemap.xml` — generated XML sitemap
- `/robots.txt` — robots rules with the active sitemap URL
- `/blog/feed.xml` — RSS feed

## Included SEO controls

Focus keyphrase and synonyms, SEO title and meta description with live length counters, SERP preview, keyphrase/content checks, readability checks, canonical URL, index/follow directives, Open Graph and X/Twitter metadata, schema type, cornerstone content, image ALT text, category metadata, XML sitemap, RSS feed, old-slug 301 redirects and Article/BlogPosting JSON-LD.

SEO scoring is a built-in Yoast SEO-style writing assistant. It is not the official Yoast SEO plugin and its language/readability checks are heuristic suggestions, not a guarantee of search ranking.
