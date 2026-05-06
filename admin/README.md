# Admin Dashboard Setup & Installation Guide
## Calyst Christian School Website

This guide will walk you through setting up the complete admin dashboard system for managing school website content.

---

## 📋 Prerequisites

- **XAMPP** (Version 8.2.12+) with Apache and MySQL
- **MySQL** running on port `3307` or `3306`
- Optional environment overrides: `DB_HOST`, `DB_PORT`, `DB_USER`, `DB_PASS`, `DB_NAME`
- **phpMyAdmin** accessible at `http://localhost/phpmyadmin`
- **PHP** 8.0 or higher

---

## 🚀 Quick Start (5 Steps)

### Step 1: Create the Database

1. Open phpMyAdmin: `http://localhost/phpmyadmin`
2. Go to the **"SQL"** tab (usually at the top)
3. Copy the entire content of `admin/database_setup.sql`
4. Paste it into the SQL editor
5. Click **"Go"** or **Execute**

**Expected Result**: 
- Database `calyst_school` will be created
- 9 tables will be populated
- Default admin account created

### Step 2: Access the Admin Panel

1. Navigate to: `http://localhost/admin/login.php`
2. Log in with demo credentials:
   - **Username**: `admin`
   - **Password**: `admin123`

### Step 3: Test Dashboard Features

1. Once logged in, you'll see the **Dashboard** with:
   - Statistics cards (News count, Staff members, Gallery images, Messages)
   - Quick access management cards
   - Sidebar navigation with 9 content management sections

### Step 4: Update School Settings

1. Click **"School Info"** in the sidebar
2. Update your school information:
   - School name, motto, phone numbers
   - Email address and physical address
   - Social media URLs (Facebook, Instagram, YouTube)
3. Click **"Save Settings"**

### Step 5: Add News & Events

1. Click **"News & Events"** in the sidebar
2. Fill in the form:
   - **Title**: Event/news headline
   - **Category**: Choose "News" or "Event"
   - **Description**: Full content
   - **Date & Time** (optional): When the event occurs
   - **Publish**: Check to make it visible on website
3. Click **"Save News/Event"**
4. View all created items below the form

---

## 📁 File Structure

```
admin/
├── login.php              # Authentication page (entry point)
├── config.php             # Database config & security functions
├── dashboard.php          # Main control center
├── logout.php             # Session termination
├── edit-school.php        # ✅ Fully implemented
├── manage-news.php        # ✅ Fully implemented
├── edit-pages.php         # 🔄 Coming Soon
├── manage-staff.php       # 🔄 Coming Soon
├── manage-gallery.php     # 🔄 Coming Soon
├── manage-testimonials.php # 🔄 Coming Soon
├── manage-fees.php        # 🔄 Coming Soon
├── contact-submissions.php # 🔄 Coming Soon
├── profile.php            # 🔄 Coming Soon
├── placeholder.php        # Temporary "coming soon" template
├── database_setup.sql     # Database schema & initial data
└── README.md              # This file
```

---

## 🔧 System Architecture

### Database Tables (9 Tables)

| Table | Purpose | Columns |
|-------|---------|---------|
| `admins` | User accounts | id, username, password_hash, full_name, role, is_active, created_at, last_login |
| `school_settings` | School info (key-value store) | id, setting_key, setting_value, updated_at |
| `pages_content` | Static pages (About, Programs, etc.) | id, page_slug, page_title, page_content, meta_*, updated_by, created_at, updated_at |
| `news_events` | News articles and events | id, title, description, event_date, event_time, category, featured_image, is_published, created_by, created_at, updated_at |
| `staff` | Teacher and staff profiles | id, full_name, title, email, phone, bio, photo_url, display_order, is_active, created_at, updated_at |
| `gallery` | Photo gallery images | id, title, description, image_url, category, display_order, is_active, created_at, updated_at |
| `testimonials` | Student/parent testimonials | id, author_name, author_title, testimonial_text, is_published, created_at, updated_at |
| `fees` | Fee structure by class | id, class_name, tuition_amount, activity_fee, transport_fee, other_fees, is_active, created_at, updated_at |
| `contact_submissions` | Contact form submissions | id, name, email, phone, subject, message, status, created_at |

### Security Features

✅ **Password Hashing**: Uses PHP's `password_verify()` and `password_hash()`
✅ **Session Management**: 1-hour timeout with activity tracking
✅ **SQL Injection Prevention**: MySQLi prepared statements
✅ **XSS Prevention**: `htmlspecialchars()` sanitization
✅ **Admin Redirect**: Unauthorized access redirects to login

### PHP Functions (in `config.php`)

```php
isAdminLoggedIn()           // Check if user is authenticated
redirectIfNotAdmin()        // Redirect unauthorized users
sanitizeInput()             // XSS prevention
escapeSql()                 // SQL injection prevention
```

---

## 🔐 Default Admin Credentials

> ⚠️ **IMPORTANT**: Change these immediately after first login!

- **Username**: `admin`
- **Password**: `admin123`

**To change password**: Go to Profile section (coming soon)

---

## 📝 Implemented Pages

### ✅ Edit School Info (`edit-school.php`)
- Update school name, motto, phone, email, address
- Manage social media links
- All changes saved to `school_settings` table

**Features**:
- Form validation
- Success/error messages
- Key-value setting system

### ✅ Manage News & Events (`manage-news.php`)
- Create new news articles or events
- Set dates and times for events
- Publish/unpublish content
- Delete items
- View recent items

**Features**:
- Category selection (News/Event)
- WYSIWYG-ready description field
- Event scheduling
- Auto-display of recent items

---

## 🔄 Under Development (Coming Soon)

### Edit Pages (`edit-pages.php`)
- Edit about, programs, testimonials pages
- WYSIWYG editor for rich text
- SEO meta fields

### Manage Staff (`manage-staff.php`)
- Add/edit teacher and staff profiles
- Photo uploads
- Bio/description fields
- Display order management

### Manage Gallery (`manage-gallery.php`)
- Upload academic and event photos
- Image organization by category
- Drag-to-reorder functionality

### Manage Testimonials (`manage-testimonials.php`)
- Add student/parent testimonials
- Approval workflow
- Featured testimonials

### Manage Fees (`manage-fees.php`)
- Fee structure by class/program
- Tuition, activity, transport, other fees
- Academic year management

### Contact Submissions (`contact-submissions.php`)
- View contact form submissions inbox
- Mark as read/replied/archived
- Response tracking

---

## 🖥️ Accessing the Admin Panel

| Page | URL |
|------|-----|
| Login | `http://localhost/admin/login.php` |
| Dashboard | `http://localhost/admin/dashboard.php` |
| School Info | `http://localhost/admin/edit-school.php` |
| News & Events | `http://localhost/admin/manage-news.php` |

---

## 🐛 Troubleshooting

### Issue: "Cannot connect to database"
- ✅ Verify MySQL is running on port `3307` or `3306`
- ✅ Check `config.php` connection parameters or set `DB_PORT`
- ✅ Ensure `calyst_school` database exists

### Issue: "Session expired, please login again"
- ✅ Session timeout is set to 1 hour
- ✅ Clear browser cookies and login again

### Issue: "404 Error - Page not found"
- ✅ Verify file paths in sidebar links
- ✅ Check that all PHP files exist in `/admin/` directory

### Issue: "Password verification failed"
- ✅ Default password is `admin123` (not `admin@123` or similar)
- ✅ Verify caps lock is off

---

## 🔄 Next Steps

1. **Database Import**: Execute `admin/database_setup.sql` in phpMyAdmin
2. **Test Login**: Access `admin/login.php` with demo credentials
3. **Update Settings**: Go to "School Info" and update your school details
4. **Add Content**: Use "News & Events" to create your first article
5. **Customize**: Implement remaining management pages as needed

---

## 📞 Admin Features Summary

| Feature | Status | Location |
|---------|--------|----------|
| Authentication | ✅ Complete | `login.php` |
| Dashboard | ✅ Complete | `dashboard.php` |
| School Settings | ✅ Complete | `edit-school.php` |
| News & Events | ✅ Complete | `manage-news.php` |
| Pages Editor | 🔄 Coming | `edit-pages.php` |
| Staff Management | 🔄 Coming | `manage-staff.php` |
| Gallery Upload | 🔄 Coming | `manage-gallery.php` |
| Testimonials | 🔄 Coming | `manage-testimonials.php` |
| Fee Management | 🔄 Coming | `manage-fees.php` |
| Contact Inbox | 🔄 Coming | `contact-submissions.php` |
| Admin Profile | 🔄 Coming | `profile.php` |
| Logout | ✅ Complete | `logout.php` |

---

## 💡 Tips & Best Practices

1. **Regular Backups**: Export your database regularly via phpMyAdmin
2. **Change Default Password**: Go to Profile (when implemented) and change admin password
3. **Content Dates**: Always set event dates for future events
4. **Featured Images**: Prepare image URLs or implement upload feature
5. **SEO**: Update meta descriptions for better search visibility

---

## 📚 Resources

- [MySQL Documentation](https://dev.mysql.com/doc/)
- [PHP Official Documentation](https://www.php.net/docs.php)
- [MySQLi Prepared Statements](https://www.php.net/manual/en/mysqli.quickstart.prepared-statements.php)
- [XAMPP Setup Guide](https://www.apachefriends.org/faq.html)

---

## ✉️ Support

For issues or feature requests, contact the development team.

**Last Updated**: 2024
**Version**: 1.0
