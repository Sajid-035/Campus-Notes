# CampusNotes — Student, Teacher & Staff Registration

This update preserves the existing Student Dashboard/Profile and all of its features. It extends registration to three member types: Student, Teacher and Staff.

## Registration fields

All member types enter their name, email, account type, institution, institutional ID card number, department and password. Students additionally enter Batch and Semester. Teacher and Staff accounts do not need Student Batch/Semester.

Institutional ID card numbers are required and unique within the institution entered on the registration form. The existing generated CampusNotes ID (`CN-YYYY-00001`) remains separate and is preserved for existing features.

## Login and access

After login, every non-admin member uses the same existing member dashboard routes, pages and features. The existing account approval lifecycle remains in place: accounts are pending until an admin approves them. Admins continue to approve/reject accounts from User Management → Member Applications.

Existing records are migrated as `student` by default to avoid disrupting current accounts. Their institutional ID card number remains blank until supplied by the user/admin workflow; new registrations must provide it.

## Upgrade

Back up the database and files, deploy the updated project, then run:

```bash
php artisan migrate --force
php artisan optimize:clear
```

No existing dashboard options, resources, bookmarks, download history, reviews, community, points, notifications, settings or support routes are removed.

## Validation

PHP syntax checks were run for changed PHP files. Full browser/database integration testing still needs to be run against the deployment database.
