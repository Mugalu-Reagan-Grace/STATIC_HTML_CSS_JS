# Admin Dashboard - Quick Reference Guide

## 🎯 Quick Links

| Icon | Section | File | Status |
|------|---------|------|--------|
| 📊 | Dashboard | `dashboard.php` | ✅ Ready |
| ⚙️ | School Info | `edit-school.php` | ✅ Ready |
| 📄 | Pages | `edit-pages.php` | 🔄 Coming |
| 📰 | News & Events | `manage-news.php` | ✅ Ready |
| 👥 | Staff | `manage-staff.php` | 🔄 Coming |
| 📸 | Gallery | `manage-gallery.php` | 🔄 Coming |
| 💬 | Testimonials | `manage-testimonials.php` | 🔄 Coming |
| 💰 | Fees | `manage-fees.php` | 🔄 Coming |
| ✉️ | Messages | `contact-submissions.php` | 🔄 Coming |
| 👤 | Profile | `profile.php` | 🔄 Coming |

---

## 🚀 Getting Started in 3 Steps

### Step 1: Import Database
```
1. Open http://localhost/phpmyadmin
2. Click "SQL" tab
3. Copy contents of admin/database_setup.sql
4. Paste and click Execute
```

### Step 2: Login
```
URL: http://localhost/admin/login.php
Username: admin
Password: admin123
```

### Step 3: Start Managing
```
Welcome screen shows:
- Statistics cards (news count, staff, gallery, messages)
- Quick access management cards
- Full sidebar navigation
```

---

## 📋 What Each Section Does

### School Info
- **What**: Update basic school information
- **Fields**: Name, motto, phone, email, address, social media
- **Who**: Anyone with admin access
- **Location**: `edit-school.php`

### News & Events
- **What**: Create and manage news articles and event announcements
- **Fields**: Title, description, category, date, time, publish status
- **Who**: Admin or editor
- **Location**: `manage-news.php`

### Dashboard
- **What**: Central hub showing all statistics and management options
- **Shows**: Count of news, staff, gallery images, new messages
- **Who**: Admin only
- **Location**: `dashboard.php`

---

## 🔐 Security Notes

✅ Passwords are hashed with `password_hash()`
✅ Sessions timeout after 1 hour of inactivity
✅ All database queries use prepared statements
✅ All user input is sanitized
✅ Admin pages redirect unauthorized users to login

**Change Default Password**: Go to Profile after login (when implemented)

---

## 🎨 Database Schema Overview

```
admins (5 active admins can be created)
├── id (primary key)
├── username (unique)
├── password_hash
├── full_name
├── role (admin or editor)
├── is_active (yes/no)
├── created_at
└── last_login

school_settings (key-value pairs)
├── id
├── setting_key (unique)
├── setting_value
└── updated_at

news_events (unlimited articles/events)
├── id
├── title
├── description
├── event_date
├── event_time
├── category (news/event)
├── featured_image
├── is_published
├── created_by (FK: admins.id)
├── created_at
└── updated_at

[And 6 more tables: pages_content, staff, gallery, testimonials, fees, contact_submissions]
```

---

## 💻 File Locations

All admin files are in the `/admin/` folder:

```
admin/
├── login.php              ← Start here
├── dashboard.php          ← Main hub
├── config.php             ← Database (don't edit)
├── database_setup.sql     ← Run once in phpMyAdmin
├── edit-school.php        ← Edit school info
├── manage-news.php        ← Add/edit news
├── edit-pages.php         ← Coming soon
├── manage-staff.php       ← Coming soon
├── manage-gallery.php     ← Coming soon
├── manage-testimonials.php ← Coming soon
├── manage-fees.php        ← Coming soon
├── contact-submissions.php ← Coming soon
├── profile.php            ← Coming soon
├── placeholder.php        ← Temporary coming soon page
├── logout.php             ← Logout
└── README.md              ← Full documentation
```

---

## ⚡ Pro Tips

1. **Bookmark the Admin Panel**: Save `http://localhost/admin/dashboard.php` to your favorites
2. **Session Timeout**: Activity resets the 1-hour timer (no need to stay active)
3. **Publish Control**: Use "Publish" checkbox to draft content before making it visible
4. **Event Details**: Only set date/time if it's an event (news items don't need it)
5. **Social Media**: Links save as full URLs (e.g., https://facebook.com/yourpage)

---

## 🐛 Common Issues & Solutions

| Issue | Solution |
|-------|----------|
| Can't login | Clear browser cache, verify username/password |
| Page not found | Make sure you're accessing `/admin/` subdirectory |
| Settings not saving | Check browser console for errors, verify database connection |
| Images not uploading | Feature coming soon - use external image URLs for now |

---

## 📊 Statistics Dashboard

The main dashboard shows you at a glance:

- **News & Events**: Total number of published news/events
- **Staff Members**: Active staff profiles
- **Gallery Images**: Active images in gallery
- **New Messages**: Unread contact form submissions

Click any card to go to that management section.

---

## 🔄 Workflow Example: Adding a News Item

1. Click **"News & Events"** from dashboard or sidebar
2. Fill in the form:
   - Title: "Back to School 2024"
   - Category: Select "news"
   - Description: "School reopens on January 15th..."
   - Date: Leave blank (news items don't require dates)
   - Check "Publish this news/event"
3. Click **"Save News/Event"**
4. Verify it appears in "Recent News & Events" section below

---

**Ready to manage your school website?** Start at `http://localhost/admin/login.php`
