# Calyst Christian School Website

PHP website for Calyst Christian School, including the public pages, admissions form, and admin dashboard.

## Requirements

- PHP 8.0 or later with MySQLi enabled
- MySQL or MariaDB
- Composer
- Internet access for the Font Awesome stylesheet loaded from cdnjs

## Local setup (XAMPP)

1. Put the project folder under `C:\xampp\htdocs`.
2. Copy `.env.example` to `.env` and set your database and SMTP values. `.env` is loaded automatically after Composer dependencies are installed; keep real credentials out of Git.
3. From the project folder, run `composer install`.
4. Start Apache and MySQL. Create the database by importing `admin/database_setup.sql` in phpMyAdmin.
5. Import `admin/admissions_table.sql` and `admin/password_resets.sql` as well to enable admissions submissions and admin password recovery.
6. Open `http://localhost/calyst_2/`.

The database defaults match a typical XAMPP setup (`root`, blank password, MySQL port `3307`). Change `.env` if your local server uses different settings. Set `APP_URL` to the URL used to open the site; the local vhost default is `http://calyst.nsoft`.

## Photos and icons

The original school photos are not included. Missing images display `ASSETS/images/photo-placeholder.svg` until the original image paths are restored or the `src` values in the pages are updated. The `ASSETS/images/ccs pics/` directory is no longer ignored by Git, so new photos added there can be committed and deployed.

Font Awesome icons are provided by the Font Awesome 6.7.2 stylesheet on cdnjs. The site needs an internet connection to display those icons.

## Admin

See [admin/README.md](./admin/README.md) for dashboard details and database setup notes. Change any demo admin credentials before deploying publicly.
