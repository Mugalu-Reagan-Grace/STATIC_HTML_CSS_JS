# Calyst Christian School Admin Portal

The admin portal provides a responsive dashboard and a content-management system for the public website.

## Setup

1. Start Apache and MySQL/MariaDB in XAMPP.
2. Import `admin/database_setup.sql` into phpMyAdmin. For existing databases, also import any required migrations such as `admin/password_resets.sql` and `admin/account_invites.sql`.
3. Configure the project `.env` file with database settings (`DB_HOST`, `DB_PORT`, `DB_USER`, `DB_PASS`, `DB_NAME`), the public base URL (`APP_URL`), and SMTP settings for recovery emails.
4. Ensure the admin account email in the database is an inbox you can access.
5. Open `/admin/login.php`. On a fresh database only, the seeded account is `admin` / `admin123`; change it immediately. On an existing installation, use **Forgot your password?** to set a new password from the email link.

Password reset links expire after 30 minutes. If an email does not arrive, verify the SMTP settings and request another link.

## Admin sections

| Section | What it manages |
|---|---|
| Dashboard | Content totals, recent updates, inbox summary, and quick actions |
| School settings | Public school identity, contact details, and social links |
| Pages | Page copy and search metadata by page key |
| News & events | Announcements, event dates, descriptions, publication status, and images |
| Staff | Staff profiles, bios, photos, display order, and visibility |
| Gallery | School photos, categories, display order, and visibility |
| Testimonials | Parent/community quotes and publication status |
| Fees | Per-class tuition, activity and transport fees, and notes |
| Messages | Contact inbox, status tracking, email reply links, and deletion |
| CMS accounts | Administrator-only invitations, email verification, and pending invitation management |
| Account profile | Admin identity, recovery email, and password changes |

Management forms support create, edit, search, and delete workflows. Changes to published content are reflected on their corresponding public pages. Page keys map to public filenames such as `about`, `fees`, `gallery`, `news-events`, and `home`.

An existing administrator can invite a content editor or another administrator from **CMS accounts**. The account stays inactive until its recipient verifies the email invitation and chooses a password. Invitation links expire after 48 hours; there is no public sign-up, and content editors cannot manage accounts.

## Image uploads

Uploads accept JPG, PNG, or WebP images up to 5 MB and store generated filenames under `uploads/cms`. The upload directory disables PHP execution and directory listing. Existing site images under `ASSETS/images/` can also be referenced by their project-relative path.

## Database notes

- `admin/database_setup.sql` creates the CMS tables and the initial admin account for a new installation.
- `admin/password_resets.sql` adds the one-time password-reset token table to an existing installation.
- `admin/account_invites.sql` adds the one-time CMS invitation table to an existing installation.
- Keep database exports and uploaded images in backups.

For local development, set `APP_URL` to the configured virtual host (for example, `http://calyst.nsoft`). Use the HTTPS website URL in production.
