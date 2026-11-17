# Admin Dashboard Update

The existing admin dashboard has been redesigned for Campus Notes while retaining the existing routes and To-Do workflow.

## Dashboard overview
- Member totals, pending and approved account counts, and Student / Teacher / Staff breakdown.
- Academic resource totals, pending / approved counts, and combined download count.
- Blog totals, pending approvals, and published post counts.
- New contact-message count.
- Recent pending member applications, academic resources, and community blog submissions.
- Recent member registrations and permission-aware quick links.
- Existing admin To-Do list (add, edit, delete) retained.

## Permission behavior
Dashboard cards, review queues, and quick links are displayed only when the signed-in admin has the corresponding permission. The same dashboard data provider is used for both `/home` and the existing admin dashboard route.

## Files updated
- `app/Services/AdminDashboardData.php` (new)
- `app/Http/Controllers/TodoController.php`
- `app/Http/Controllers/HomeController.php`
- `resources/views/backend/dashboard.blade.php`

No database migration is required for this dashboard update.
