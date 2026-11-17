CampusNotes – Fixes Applied
==========================

1. User Management
   - General Users List now shows approved users (and admin/super-admin accounts).
   - Users created from the Admin Add User form are created as approved accounts.

2. User Approval
   - Pending/unapproved applications remain in the separate Student Applications approval queue and are excluded from the general Users List.

3. Role Creation
   - Role permissions are resolved to Permission models before syncing, avoiding the post-save permission sync error.
   - Role update now validates unique names and supports roles with no selected permissions.

4. Resource Moderation
   - Replaced browser confirm prompts on the resource moderation page with a branded confirmation dialog.

5. Resource Review
   - The resource owner cannot review their own resource (UI and server-side protection).

6. Profile Pictures
   - Avatar URL normalization supports current and legacy avatar path formats.
   - Contributor and community cards now display uploaded profile pictures.

7. Resource Download
   - Download endpoint now returns a standard BinaryFileResponse from the public storage path.

8. Bookmark Indicator
   - Resource cards show a saved indicator and filled bookmark state for resources already bookmarked by the signed-in user.

9. Community Blog Submission
   - Any signed-in user can submit a blog post at /blog/submit.
   - The submission form includes a required featured image upload (JPG/PNG/WebP, up to 5 MB), image alt text, summary and a Summernote rich-text editor.
   - Submitted rich text is sanitized on the server before it is saved.
   - New submissions are stored as pending and are not publicly visible.
   - Admin Blog Posts list shows the author and includes Pending Review and Approve/Reject actions.
   - Approval publishes the post; rejection returns it to drafts.

10. Admin User Resources
   - The Admin sidebar now contains a clearly labelled User Resources option.
   - Admins can search by resource, subject or contributor, filter by status, open/download uploaded files and approve/reject/delete submissions according to their permissions.

Validation
----------
PHP syntax checks passed for the changed controllers. The project dependencies are not installed in this runtime, so Laravel route/database/browser integration tests could not be run here. Please test the workflows in your local Laragon environment and run the usual Laravel cache/storage setup commands if needed.

Security note
-------------
The packaged archive excludes the original .env file and .git history. Keep your existing .env file separately and copy it into the extracted project; .env.example is included.

11. Dynamic Academic Options
   - Added an Admin > Academic Settings page to manage Departments, Semesters and Resource Categories.
   - Admins with `resources-approve` permission can add, rename, reorder and activate/deactivate options.
   - Student registration, application verification, profile editing, resource upload, resource browsing and bookmark filters now use the active options from the database instead of hard-coded dropdown values.
   - Changing a semester number updates existing user and resource records. Renaming a resource category updates existing resource records. Options already in use should be deactivated rather than removed.
   - A migration creates the semester and resource-category option tables and seeds the existing 1–20 semester choices and five standard resource categories.

12. Academic Resource Approval Confirmation
   - Reworked the custom confirmation overlay for Approve, Reject and Delete actions.
   - The OK, continue button now submits the selected form through the browser's native form submit method, avoiding the previous confirmation-handler loop and browser dialog fallback issue.

Additional validation
--------------------
PHP syntax checks passed for all 81 PHP files under `app`, `routes` and `database/migrations`. The confirmation JavaScript passed `node --check`. Laravel integration/database/browser tests were not run because the project dependencies (`vendor/`) are not installed in this runtime.

Upgrade steps
-------------
After replacing the project files and restoring your existing `.env`, run:

```bash
php artisan migrate
php artisan optimize:clear
php artisan storage:link
```

The new Admin page is available from the sidebar as **Academic Settings**. The logged-in admin role needs both `resources-list` (view the settings page) and `resources-approve` (add/update options).
