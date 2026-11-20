# Admin Dashboard - Quick Reference

## Sections

| Section | Page | Purpose |
|---|---|---|
| Dashboard | `dashboard.php` | Content totals, recent updates, inbox, quick actions |
| School settings | `edit-school.php` | Public school information, contact details, social links |
| Pages | `edit-pages.php` | Page copy and search metadata |
| News & events | `manage-news.php` | Announcements, event dates, publish status, images |
| Staff | `manage-staff.php` | Staff profiles, photos, display order, visibility |
| Gallery | `manage-gallery.php` | Photos, categories, display order, visibility |
| Testimonials | `manage-testimonials.php` | Community quotes and publication status |
| Fees | `manage-fees.php` | Class fees and additional notes |
| Messages | `contact-submissions.php` | Contact form inbox and follow-up status |
| CMS accounts | `accounts.php` | Administrator-only account invitations and pending invites |
| Account profile | `profile.php` | Admin identity, recovery email, password |

Management forms support adding, editing, searching, and deleting records. Published content is displayed on the matching public website page.

## First-time setup

1. Import `admin/database_setup.sql` using phpMyAdmin. For an existing database, import `admin/password_resets.sql` and `admin/account_invites.sql` if those tables are missing.
2. Set database, SMTP, and `APP_URL` values in the project `.env` file. For the local virtual host, use `http://calyst.nsoft`; use HTTPS in production.
3. Ensure the admin account email points to an inbox you can access.
4. Open `http://calyst.nsoft/admin/login.php`. On a fresh database only, the seeded credentials are `admin` / `admin123`; change the initial password immediately. For an existing installation, use **Forgot your password?** and follow the emailed link.

Reset links expire after 30 minutes. Check SMTP configuration if the email does not arrive.

Administrators can open **CMS accounts** to invite editors or other administrators. Invitations are sent by email, expire after 48 hours, and activate only after the recipient opens the link and sets a password. There is no public self-sign-up; content editors cannot invite or revoke accounts.

## Images

Upload JPG, PNG, or WebP files up to 5 MB. Images are stored under `uploads/cms` with generated filenames. Existing project images can be referenced with paths under `ASSETS/images/`.

## Common checks

| Problem | Check |
|---|---|
| Database connection fails | Make sure MySQL is running and `.env` has the correct `DB_HOST`, `DB_PORT`, `DB_USER`, `DB_PASS`, and `DB_NAME`. |
| Password reset email is missing | Confirm the admin recovery email and SMTP settings, then request a new link. |
| Image is missing | Check the stored image path and confirm the file exists under `ASSETS/images/` or `uploads/cms/`. |
| Admin session expires | Sessions expire after one hour of inactivity; sign in again. |

For detailed setup and database notes, see [README.md](./README.md).
