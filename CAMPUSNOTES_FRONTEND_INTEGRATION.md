# CampusNotes frontend template integration

## What was added

The original `campusnotes.html` was a standalone JavaScript mock-up. Its visual system has been adapted into the Laravel frontend while preserving the navy/blue palette, resource cards, department grid, hero search, PDF viewer pattern, dashboard statistics, responsive breakpoints and dark-mode concept.

The frontend now uses Laravel Blade, named routes, controllers and database-backed resource records instead of the original hard-coded JavaScript resource array.

## Public menu and individual views

| Menu / page | URL | Route name | Blade view |
|---|---|---|---|
| Home | `/` | `frontend.home` | `frontend/pages/home.blade.php` |
| Browse | `/resources` | `resources.index` | `frontend/resources/browse.blade.php` |
| Resource details | `/resources/{slug}` | `resources.show` | `frontend/resources/show.blade.php` |
| Departments | `/departments` | `departments.index` | `frontend/pages/departments.blade.php` |
| Department details | `/departments/{slug}` | `departments.show` | `frontend/resources/department.blade.php` |
| Previous Questions | `/questions` | `questions.index` | `frontend/resources/questions.blade.php` |
| Assignments | `/assignments` | `assignments.index` | `frontend/resources/assignments.blade.php` |
| Community | `/community` | `frontend.community` | `frontend/pages/community.blade.php` |
| Contributors | `/contributors` | `frontend.contributors` | `frontend/pages/contributors.blade.php` |
| Blog | `/blog` | `blog.index` | existing `frontend/blog/index.blade.php` |
| Blog details | `/blog/{slug}` | `blog.show` | existing `frontend/blog/show.blade.php` |
| Features | `/features` | `frontend.features` | `frontend/pages/features.blade.php` |
| How it works | `/how-it-works` | `frontend.how-it-works` | `frontend/pages/how-it-works.blade.php` |
| About | `/about` | `frontend.about` | `frontend/pages/about.blade.php` |
| FAQ | `/faq` | `frontend.faq` | `frontend/pages/faq.blade.php` |
| Contact | `/contact` | `frontend.contact` | `frontend/pages/contact.blade.php` |
| Upload | `/resources/upload` | `resources.upload` | `frontend/resources/upload.blade.php` |
| Student dashboard | `/student/dashboard` | `student.dashboard` | `frontend/student/dashboard.blade.php` |
| Bookmarks | `/student/bookmarks` | `student.bookmarks` | `frontend/student/bookmarks.blade.php` |
| Login / Register | `/login`, `/register` | Laravel auth routes | `auth/login.blade.php`, `auth/register.blade.php` |

Shared frontend files:

- `resources/views/frontend/layouts/app.blade.php`
- `resources/views/frontend/partials/navbar.blade.php`
- `resources/views/frontend/partials/footer.blade.php`
- `resources/views/frontend/partials/resource-card.blade.php`
- `public/frontend/css/campusnotes-template.css`
- `public/frontend/js/campusnotes.js`

## Functional additions

- Search by resource title, subject, course code and description.
- Filters for department, semester, category and verified resources.
- Latest, oldest, most-downloaded and highest-rated sorting.
- Grid/list view and responsive mobile filters.
- Individual department, question and assignment pages.
- Student document upload (PDF, DOC, DOCX, PPT, PPTX; maximum 25 MB).
- Uploaded files enter `pending` status and are not published before approval.
- Admin resource moderation: approve, reject and delete.
- Approved PDF browser preview, page navigation and zoom controls.
- Download counter, bookmarks and one review per user per resource.
- Student dashboard with upload status, downloads, saved items and six-month upload activity.
- Contact form messages saved in the database and available in a permission-gated Admin Contact Inbox.
- FAQ, community and contributor pages.
- Original Blog CMS, categories, RSS, sitemap, robots and SEO writing controls retained; sitemap now includes academic resources and departments.
- Dark mode and mobile navigation.

## Database additions

Migrations:

- `database/migrations/2026_11_08_000001_create_academic_resource_tables.php`
- `database/migrations/2026_11_08_000002_add_avatar_to_users_table.php`

Tables:

- `academic_departments`
- `academic_resources`
- `resource_bookmarks`
- `resource_reviews`
- `contact_messages`
- `users.avatar` nullable profile-image column added safely by a follow-up migration

Models:

- `AcademicDepartment`
- `AcademicResource`
- `ResourceReview`

Seed file: `database/seeders/CampusDemoSeeder.php` creates eight departments and twelve sample resource listings. Sample entries are explicitly metadata-only examples; no fake PDF file, review score or download count is generated for them.

## Setup

1. Back up the current database and project before deployment.
2. Confirm `.env` has the correct database connection and `APP_URL`.
3. Run the migration: `php artisan migrate --force`.
4. Run the seeders on an existing installation to add the new moderation permissions and sample academic data: `php artisan db:seed --force`. The admin seeder now uses `firstOrCreate` to avoid duplicating the default admin account and role.
5. Create the public storage link: `php artisan storage:link`.
6. Ensure `storage/` and `bootstrap/cache/` are writable by the PHP process.
7. Set `APP_DEBUG=false` on a production website and use a strong administrator password.

On a fresh development database, `php artisan migrate --seed` runs the migrations and the default seeders together.

## Important notes

- The HTML template's old hard-coded numbers and resource list have not been presented as real statistics. The home page now reads totals from the database.
- Seeded sample resource listings do not include downloadable documents. Real uploads become downloadable after a student uploads a file and an administrator approves it.
- PDF preview depends on the public storage symlink. Office document formats are downloadable, but the browser does not render them as PDFs.
- The resource moderation and contact inbox menus are permission-gated by `resources-*` and `contact-messages-*` permissions. Profile and settings links use the restored `profile.show`, `settings.index` and `profile.update` routes; Laravel email-verification routes are enabled too. Run the seeders so the Super Admin role receives these permissions.
- Email notifications for moderation, external file preview conversion and a full resource report/appeal workflow are not included in this frontend integration.
