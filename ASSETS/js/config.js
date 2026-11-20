/**
 * CALYST CHRISTIAN SCHOOL - CONFIGURATION FILE
 * Update these settings across your project
 */

// Site Configuration
const SITE_CONFIG = {
  // Basic Information
  site: {
    name: "Calyst Christian School",
    shortName: "Calyst",
    url: "https://calystchristianschool.com",
    domain: "calystchristianschool.com",
    year: new Date().getFullYear(),
    description: "Excellence in Christian Education"
  },

  // Branding (single source of truth for logo and school name)
  brand: {
    displayName: "Calyst Christian School",
    motto: "HOFU YA BWANA",
    logoPath: "./ASSETS/images/calyst budge final.png",
    logoNoBgPath: "./ASSETS/images/calyst budge better no bg.png",
    logoAlt: "Calyst Christian School Logo"
  },

  // Contact Information
  contact: {
    phone: ["+256 774-744-394", "+256 752-482-066"],
    email: "mugalureagan18@gmail.com",
    address: "P.O.BOX 124666 Kampala Uganda"
  },

  // Social Media
  social: {
    facebook: {
      url: "https://www.facebook.com/profile.php?id=100090556566888",
      handle: "calystchristianschool"
    },
    instagram: {
      url: "https://www.instagram.com/calystchristianschool",
      handle: "calystchristianschool"
    },
    youtube: {
      url: "https://youtube.com/@calystchristianschools",
      handle: "calystchristianschools"
    }
  },

  // Colors (Match calyst.css)
  colors: {
    primary: "#1e3a8a",
    secondary: "#3b82f6",
    accent: "#f59e0b",
    success: "#22c55e",
    warning: "#f59e0b",
    danger: "#ef4444",
    light: "#f9fafb",
    dark: "#374151",
    white: "#ffffff"
  },

  // Navigation
  navigation: [
    { label: "Home", url: "./home.php" },
    {
      label: "School",
      url: "./about.php",
      children: [
        { label: "About", url: "./about.php" },
        { label: "Staff", url: "./staff.php" },
        { label: "Fees", url: "./fees.php" },
        { label: "Gallery", url: "./gallery.php" }
      ]
    },
    { label: "Programs", url: "./programs.php" },
    { label: "News & Events", url: "./news-events.php" },
    { label: "Contact", url: "./contact_us.php" },
    {
      label: "Admissions",
      url: "./admissions.php",
      itemClass: "nav-admissions",
      linkClass: "btn-admissions"
    }
  ],

  // Pages
  pages: {
    home: "./home.php",
    about: "./about.php",
    gallery: "./gallery.php",
    galleryAcademics: "./gallery_academics.php",
    programs: "./programs.php",
    admissions: "./admissions.php",
    contact: "./contact_us.php",
    notFound: "./404.php"
  },

  // Analytics & Tracking
  tracking: {
    googleAnalyticsId: "G-XXXXXXXXXX", // Add your Google Analytics ID
    googleTagManagerId: "GTM-XXXXXXX", // Add your GTM ID
    facebookPixelId: "", // Add your Facebook Pixel ID
    hotjarId: "" // Add your Hotjar ID
  },

  // SEO
  seo: {
    keywords: ["Christian school", "education", "Uganda", "academics", "enrollment"],
    author: "Calyst Christian School",
    language: "en-US",
    robots: "index, follow",
    googleSiteVerification: "", // Add verification code
    bingSiteVerification: "" // Add verification code
  },

  // Features
  features: {
    darkMode: true,
    newsletter: false,
    contactForm: true,
    galleryFiltering: true,
    lazyLoading: true,
    analytics: false, // Enable when analytics ID is added
    PWA: true
  },

  // Notification Messages
  messages: {
    success: {
      contactForm: "Thank you. Your message has been received by the school office.",
      enrollment: "Your enrollment request has been received."
    },
    error: {
      contactForm: "There was an error sending your message. Please try again.",
      network: "Network error. Please check your internet connection."
    },
    info: {
      loading: "Loading...",
      processing: "Processing your request..."
    }
  },

  // Validation Rules
  validation: {
    email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
    phone: /^[\d\s+()-]{10,}$/,
    nameMinLength: 2,
    messageMinLength: 10
  },

  // Local Storage Keys
  localStorage: {
    userPreferences: "calyst_user_prefs",
    darkMode: "calyst_dark_mode",
    lastVisit: "calyst_last_visit"
  },

  // Performance
  performance: {
    lazyLoadingThreshold: 300,
    debounceDelay: 300,
    throttleDelay: 300,
    animationDuration: 300
  },

  // Environments
  environments: {
    development: "http://localhost:8000",
    staging: "https://staging.calystchristianschool.com",
    production: "https://calystchristianschool.com"
  },

  // Version Info
  version: {
    major: 1,
    minor: 0,
    patch: 0,
    lastUpdated: "2026-01-12"
  }
};

// Helper function to get current environment
function getCurrentEnvironment() {
  const hostname = globalThis.location.hostname;
  if (hostname === "localhost") return "development";
  if (hostname.includes("staging")) return "staging";
  return "production";
}

// Export for use in other files
if (typeof module !== "undefined" && module.exports) {
  module.exports = SITE_CONFIG;
}

// Make config available globally
globalThis.CALYST_CONFIG = SITE_CONFIG;

console.log(`🎓 Calyst Christian School v${SITE_CONFIG.version.major}.${SITE_CONFIG.version.minor}.${SITE_CONFIG.version.patch}`);
console.log(`Environment: ${getCurrentEnvironment()}`);

