# CampusNotes — Student Dashboard & Membership Update

This update extends the existing Laravel 10 CampusNotes project and preserves the existing public website, Blog CMS, SEO routes, Stisla admin panel, academic resource browsing, and resource moderation features.

## Student panel

The Student Panel uses the existing CampusNotes navy/blue visual language and provides a left sidebar with these sections:

- Dashboard: overview, six statistics cards, monthly upload activity, contribution summary, quick actions, recent uploads, unread-notification shortcut.
- My Profile: separate View Profile and Edit Profile pages, Student ID information, and a Digital Student ID Card.
- Upload Resource: Add New Resource and Upload History.
- My Resources: All, Published, Pending, Rejected, Draft.
- My Bookmarks: saved resources with Notes, Previous Questions, and Assignments filters.
- My Downloads: download history and recent downloads.
- My Reviews: submitted ratings and comments.
- Community: discussions, My Questions, and My Replies. Students can create a question and reply to a discussion.
- Points & Rewards: points history, achievements, leaderboard.
- Notifications: All and Unread lists; mark one or all as read.
- Account Settings: change email/password and manage profile/leaderboard visibility.
- Help & Support: FAQ link and support form that sends a message to the existing admin Contact Inbox.
- Logout.

## Student registration and approval lifecycle

Registration now collects institution, department, batch, and semester. After registration:

- `account_status` is set to `pending`.
- A unique CampusNotes Student ID is generated in the format `CN-YYYY-00001`.
- A unique application reference is generated in the format `APP-YYYY-00001`.
- The user is redirected to the Application Status page and can see their application number, Student ID, submission date, and verification status.

An admin can review applications from **Admin → User Management → Student Applications**. Supported states are:

- `pending`
- `approved`
- `rejected`
- `suspended`
- `inactive`
- `verification_required`

Only `approved` accounts receive full Student Panel access and the membership card. Rejected users can see the rejection reason and contact Support. Verification-required users can submit updated student details. Suspended/inactive accounts remain restricted and can contact Support.

## Digital Student ID Card

The card displays CampusNotes branding, student name, department, institution, Student ID, batch, semester, member-since year, and a Verified marker. It is a CampusNotes membership card only; it is not an official university ID. The Download / Print PDF button opens the browser print dialog, where the user can choose **Save as PDF**.

## Points and notifications

- A resource approval awards 40 points (once per resource).
- Each recorded resource download awards 1 point to the resource contributor. Existing approved resources and their historical download totals are backfilled into the point history during migration.
- Authenticated student downloads are saved in `student_downloads`.
- Resource approval/rejection, application status changes, and community replies create student notifications.

## New database migration

`database/migrations/2026_11_08_000003_add_student_dashboard_membership_features.php`

It adds student profile/application fields to `users` and creates:

- `student_downloads`
- `student_point_transactions`
- `student_notifications`
- `student_discussions`
- `student_discussion_replies`

## Deploy / upgrade

Back up your database and project files first. Upload/replace the updated project, then run:

```bash
php artisan migrate --force
php artisan db:seed --force
php artisan storage:link
php artisan optimize:clear
```

`db:seed` ensures the sample academic departments exist for the registration form. On an established production database, review your existing seeder configuration before running it; make sure the existing admin account and roles are retained. After deployment, open **Admin → Student Applications** and approve existing legitimate student accounts as appropriate.

## Validation performed

- Laravel route registry loads and reports 113 named routes after the profile-edit route addition.
- All Blade templates compile using Laravel's Blade compiler.
- PHP syntax checks pass for application, migration, and route PHP files.
- Static Blade `route()` references resolve to registered route names.

A live database migration / sign-in / browser interaction test could not be completed in this container because PHP has no PDO database driver installed. Run the migration against your actual hosting database and smoke-test registration, admin approval, student login, uploads, downloads, and ID-card printing there.
