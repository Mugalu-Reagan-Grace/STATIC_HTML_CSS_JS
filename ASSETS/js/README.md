# Calyst Christian School - JavaScript Documentation

## Overview
This project includes a comprehensive JavaScript suite with three main files:
1. **main.js** - Core functionality and interactive features
2. **utils.js** - Utility functions and helpers
3. **image-fallback.js** - Replaces unavailable image files with the temporary school-photo placeholder.
4. CSS is maintained separately in `ASSETS/css/`:
   - `calyst.css` - Main site styles
   - `animations.css` - Animation and dark-mode styles

## JavaScript Files

### ASSETS/js/main.js
Main JavaScript file with all interactive features for the website.

#### Features Included:

**1. Mobile Menu Toggle**
- `showSidebar()` - Opens mobile navigation menu
- `hideSidebar()` - Closes mobile navigation menu
- Auto-closes when navigation links are clicked

**2. Smooth Scroll Behavior**
- Smooth scrolling for all anchor links
- Works for navigation and section links

**3. Active Navigation Link Highlighting**
- Highlights current page in navigation
- Updates dynamically based on page URL

**4. Tab Switching (Events/News)**
- Click tabs to switch between "Upcoming Events" and "News"
- Only one tab active at a time
- Shows/hides corresponding content

**5. Gallery Filtering & Search**
- Filter photos by category (All, Events, Sports, Academics, Arts)
- Real-time search functionality
- Filters photos by title

**6. Contact Form Submission**
- Email validation
- Required field validation
- Fallback to mailto when submitted
- Success notification on submission

**7. Newsletter Subscription**
- Email validation
- Success notification
- Form reset after submission

**8. Notification System**
- `showNotification(message, type)` - Displays toast notifications
- Types: success, error, info
- Auto-dismisses after 4 seconds
- Slide-in animation

**9. Scroll-to-Top Button**
- Auto-creates floating button
- Shows after scrolling 300px down
- Smooth scroll to top
- Hover effects

**10. Lazy Loading for Images**
- Uses IntersectionObserver for performance
- Fallback for older browsers
- Images load when visible

**11. Lightbox/Gallery Viewer**
- Click photos to open full-size lightbox
- Close with X button, background click, or Escape key
- Shows image title as caption
- Responsive sizing

**12. Animations on Scroll**
- Fade-in animations for cards and testimonials
- Uses IntersectionObserver for performance
- One-time trigger per element

**13. Form Input Validation**
- Real-time validation feedback
- Email format validation
- Phone number validation
- Visual indicators (green/red borders)

**14. Counter Animation for Stats**
- Animates numbers in "By the Numbers" section
- Counts up from 0 to final value
- Triggers when section comes into view
- Only runs once

**15. Keyboard Navigation**
- Escape key closes sidebar
- Enter/Space activates buttons
- Tab navigation support

**16. Page Load Animation**
- Fade-in effect on page load

**17. Print Functionality**
- `printPage()` - Prints current page

**18. Social Share Functionality**
- `shareContent(platform)` - Share on social media
- Supported: Facebook, Twitter, WhatsApp

**19. Dark Mode Toggle (Optional)**
- `toggleDarkMode()` - Switches dark mode on/off
- Saves preference to localStorage
- Dark mode styles in animations.css

**20. Local Storage Preferences**
- Saves user dark mode preference
- Auto-saves form data
- Loads saved form data on page load

---

### ASSETS/js/utils.js
Utility library with helper functions for common tasks.

#### Available Utilities:

**Date & Time Functions:**
- `CalystUtils.formatDate(date)` - Format date to readable string
- `CalystUtils.getTimeAgo(date)` - Get relative time (e.g., "2 hours ago")

**Validation Functions:**
- `CalystUtils.isValidEmail(email)` - Email validation
- `CalystUtils.isValidPhone(phone)` - Phone validation
- `CalystUtils.isValidName(name)` - Name validation

**String Functions:**
- `CalystUtils.capitalize(str)` - Capitalize first letter
- `CalystUtils.truncateText(text, maxLength)` - Truncate with ellipsis
- `CalystUtils.slugify(str)` - Convert to URL-friendly slug

**DOM Functions:**
- `CalystUtils.addClass(element, className)` - Add class
- `CalystUtils.removeClass(element, className)` - Remove class
- `CalystUtils.toggleClass(element, className)` - Toggle class
- `CalystUtils.hasClass(element, className)` - Check class

**Performance Functions:**
- `CalystUtils.debounce(func, delay)` - Debounce function (300ms default)
- `CalystUtils.throttle(func, delay)` - Throttle function (300ms default)

**Storage Functions:**
- `CalystUtils.setStorage(key, value)` - Save to localStorage
- `CalystUtils.getStorage(key)` - Retrieve from localStorage
- `CalystUtils.removeStorage(key)` - Delete from localStorage

**Animation Functions:**
- `CalystUtils.fadeIn(element, duration)` - Fade in animation
- `CalystUtils.fadeOut(element, duration)` - Fade out animation
- `CalystUtils.slideDown(element, duration)` - Slide down animation
- `CalystUtils.slideUp(element, duration)` - Slide up animation

**API Functions:**
- `CalystUtils.fetchData(url, options)` - GET request helper
- `CalystUtils.postData(url, data)` - POST request helper

**Color Functions:**
- `CalystUtils.hexToRgb(hex)` - Convert hex to RGB
- `CalystUtils.rgbToHex(r, g, b)` - Convert RGB to hex

**Clipboard Functions:**
- `CalystUtils.copyToClipboard(text)` - Copy text to clipboard

**Device Detection:**
- `CalystUtils.isMobile()` - Check if mobile device
- `CalystUtils.isTablet()` - Check if tablet device
- `CalystUtils.isDesktop()` - Check if desktop device

**Scroll Functions:**
- `CalystUtils.getScrollPosition()` - Get current scroll position
- `CalystUtils.isElementInViewport(element)` - Check if visible
- `CalystUtils.scrollToElement(element, options)` - Scroll to element

**Image Functions:**
- `CalystUtils.preloadImage(url)` - Preload image
- `CalystUtils.getImageDimensions(url)` - Get image dimensions

**Array Functions:**
- `CalystUtils.shuffle(array)` - Shuffle array
- `CalystUtils.unique(array)` - Remove duplicates

**Keyboard Functions:**
- `CalystUtils.onKeyPress(key, callback)` - Listen for key press

**Logging:**
- `CalystUtils.log(message, type)` - Timestamped logging

---

### ASSETS/css/animations.css
CSS file for animations and JavaScript-related styling.

#### Animation Keyframes:
- `slideIn` - Slide in from right animation
- `slideOut` - Slide out to right animation
- `fadeIn` - Fade in animation
- `spin` - Loading spinner animation
- `loading` - Skeleton loader animation

#### Component Classes:

**Notifications:**
- `.notification` - Toast notification styling
- Slide-in/out animation

**Scroll Button:**
- `.scroll-to-top` - Floating scroll to top button
- Hover and active states

**Lightbox:**
- `.lightbox` - Full-screen overlay
- `.lightbox-content` - Centered content
- `.lightbox-close` - Close button
- `.lightbox-caption` - Image caption

**Tabs:**
- `.tabs` - Tab container
- `.tab` - Individual tab
- `.tab.active` - Active tab state

**Forms:**
- `.valid` - Valid input state (green border)
- `.invalid` - Invalid input state (red border)

**States & Utilities:**
- `.loading` - Disabled/loading state
- `.skeleton` - Skeleton loader effect
- `.hidden` - Display: none
- `.invisible` - Visibility: hidden
- `.tooltip` - Tooltip styling
- `.badge` - Badge component

**Dark Mode:**
- `body.dark-mode` - Dark mode styles

**Responsive:**
- Mobile-first design
- Tablet adjustments
- Print media styles

---

## Installation

1. All scripts are already linked in your HTML files
2. No additional installation required
3. Scripts run automatically on page load

## Browser Compatibility

- Chrome/Edge 90+
- Firefox 88+
- Safari 14+
- Mobile browsers (iOS Safari, Chrome Mobile)

## Notes

- All scripts are vanilla JavaScript (no jQuery required)
- Uses modern ES6+ features
- Graceful degradation for older browsers
- Accessibility features included (ARIA labels, keyboard support)
- Mobile-responsive design
- Performance optimized (debounce, throttle, lazy loading)

## Usage Examples

```javascript
// Use utility functions
CalystUtils.log("Hello World", "log");
const email = CalystUtils.isValidEmail("test@example.com");
CalystUtils.setStorage("userPref", { theme: "dark" });

// Show notifications
showNotification("Welcome!", "success");
showNotification("Error occurred", "error");

// Smooth scroll to element
const element = document.getElementById("about");
CalystUtils.scrollToElement(element);

// Copy to clipboard
CalystUtils.copyToClipboard("Check out our school!");

// Debounced search
const searchHandler = CalystUtils.debounce(function(query) {
  // perform search
}, 300);
```

## Customization

To customize:
1. Edit color variables in `ASSETS/css/calyst.css` (--primary-blue, --secondary-blue, etc.)
2. Modify animation durations in `ASSETS/css/animations.css`
3. Update form validation rules in `main.js`
4. Add new utility functions to `utils.js`

## Performance

- Lazy loading for images
- Debounced/throttled events
- IntersectionObserver for efficiency
- Minimal DOM manipulation
- CSS animations (GPU accelerated)

## Accessibility

- ARIA labels on all interactive elements
- Keyboard navigation support
- Focus indicators
- Reduced motion support
- Semantic HTML
- Color contrast compliance

---

**Version:** 1.0.0  
**Last Updated:** 2024  
**License:** All Rights Reserved - Calyst Christian School
