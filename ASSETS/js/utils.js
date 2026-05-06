// ============================================
// CALYST CHRISTIAN SCHOOL - UTILITIES
// ============================================

// Utility object for common functions
const CalystUtils = {
  
  // DATE UTILITIES
  // ============================================
  formatDate: function(date) {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(date).toLocaleDateString('en-US', options);
  },

  // TIME UTILITIES
  // ============================================
  getTimeAgo: function(date) {
    const now = new Date();
    const posted = new Date(date);
    const secondsAgo = Math.floor((now - posted) / 1000);

    let interval = secondsAgo / 31536000;
    if (interval > 1) return Math.floor(interval) + " years ago";
    
    interval = secondsAgo / 2592000;
    if (interval > 1) return Math.floor(interval) + " months ago";
    
    interval = secondsAgo / 86400;
    if (interval > 1) return Math.floor(interval) + " days ago";
    
    interval = secondsAgo / 3600;
    if (interval > 1) return Math.floor(interval) + " hours ago";
    
    interval = secondsAgo / 60;
    if (interval > 1) return Math.floor(interval) + " minutes ago";
    
    return Math.floor(secondsAgo) + " seconds ago";
  },

  // VALIDATION UTILITIES
  // ============================================
  isValidEmail: function(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  },

  isValidPhone: function(phone) {
    const phoneRegex = /^[\d\s\-\+\(\)]{10,}$/;
    return phoneRegex.test(phone);
  },

  isValidName: function(name) {
    return name.trim().length >= 2;
  },

  // STRING UTILITIES
  // ============================================
  capitalize: function(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
  },

  truncateText: function(text, maxLength = 100) {
    if (text.length <= maxLength) return text;
    return text.substring(0, maxLength).trim() + "...";
  },

  slugify: function(str) {
    return str
      .toLowerCase()
      .trim()
      .replace(/[^\w\s-]/g, "")
      .replace(/[\s_-]+/g, "-")
      .replace(/^-+|-+$/g, "");
  },

  // DOM UTILITIES
  // ============================================
  addClass: function(element, className) {
    if (element) element.classList.add(className);
  },

  removeClass: function(element, className) {
    if (element) element.classList.remove(className);
  },

  toggleClass: function(element, className) {
    if (element) element.classList.toggle(className);
  },

  hasClass: function(element, className) {
    return element ? element.classList.contains(className) : false;
  },

  // DEBOUNCE FUNCTION
  // ============================================
  debounce: function(func, delay = 300) {
    let timeoutId;
    return function(...args) {
      clearTimeout(timeoutId);
      timeoutId = setTimeout(() => func.apply(this, args), delay);
    };
  },

  // THROTTLE FUNCTION
  // ============================================
  throttle: function(func, delay = 300) {
    let lastCall = 0;
    return function(...args) {
      const now = Date.now();
      if (now - lastCall >= delay) {
        lastCall = now;
        func.apply(this, args);
      }
    };
  },

  // LOCAL STORAGE UTILITIES
  // ============================================
  setStorage: function(key, value) {
    try {
      localStorage.setItem(key, JSON.stringify(value));
    } catch (e) {
      console.warn("localStorage is not available:", e);
    }
  },

  getStorage: function(key) {
    try {
      const item = localStorage.getItem(key);
      return item ? JSON.parse(item) : null;
    } catch (e) {
      console.warn("Error reading from localStorage:", e);
      return null;
    }
  },

  removeStorage: function(key) {
    try {
      localStorage.removeItem(key);
    } catch (e) {
      console.warn("Error removing from localStorage:", e);
    }
  },

  // ANIMATION UTILITIES
  // ============================================
  fadeIn: function(element, duration = 500) {
    if (!element) return;
    element.style.opacity = "0";
    element.style.transition = `opacity ${duration}ms ease-in`;
    setTimeout(() => (element.style.opacity = "1"), 10);
  },

  fadeOut: function(element, duration = 500) {
    if (!element) return;
    element.style.transition = `opacity ${duration}ms ease-out`;
    element.style.opacity = "0";
  },

  slideDown: function(element, duration = 500) {
    if (!element) return;
    element.style.maxHeight = "0";
    element.style.overflow = "hidden";
    element.style.transition = `max-height ${duration}ms ease-in`;
    setTimeout(() => {
      element.style.maxHeight = element.scrollHeight + "px";
    }, 10);
  },

  slideUp: function(element, duration = 500) {
    if (!element) return;
    element.style.transition = `max-height ${duration}ms ease-out`;
    element.style.maxHeight = "0";
    element.style.overflow = "hidden";
  },

  // API UTILITIES
  // ============================================
  fetchData: async function(url, options = {}) {
    try {
      const response = await fetch(url, {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
          ...options.headers
        },
        ...options
      });

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      return await response.json();
    } catch (error) {
      console.error('Fetch error:', error);
      throw error;
    }
  },

  postData: async function(url, data = {}) {
    try {
      const response = await fetch(url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(data)
      });

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      return await response.json();
    } catch (error) {
      console.error('Post error:', error);
      throw error;
    }
  },

  // COLOR UTILITIES
  // ============================================
  hexToRgb: function(hex) {
    const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
      r: parseInt(result[1], 16),
      g: parseInt(result[2], 16),
      b: parseInt(result[3], 16)
    } : null;
  },

  rgbToHex: function(r, g, b) {
    return "#" + ((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1);
  },

  // CLIPBOARD UTILITIES
  // ============================================
  copyToClipboard: async function(text) {
    try {
      await navigator.clipboard.writeText(text);
      return true;
    } catch (err) {
      console.error('Failed to copy:', err);
      return false;
    }
  },

  // DEVICE DETECTION
  // ============================================
  isMobile: function() {
    return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
  },

  isTablet: function() {
    return /iPad|Android|Kindle|Nexus/i.test(navigator.userAgent) && !/iPhone|IEMobile/i.test(navigator.userAgent);
  },

  isDesktop: function() {
    return !this.isMobile() && !this.isTablet();
  },

  // SCROLL UTILITIES
  // ============================================
  getScrollPosition: function() {
    return {
      x: window.scrollX || window.pageXOffset,
      y: window.scrollY || window.pageYOffset
    };
  },

  isElementInViewport: function(element) {
    if (!element) return false;
    const rect = element.getBoundingClientRect();
    return (
      rect.top >= 0 &&
      rect.left >= 0 &&
      rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
      rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
  },

  scrollToElement: function(element, options = {}) {
    if (!element) return;
    element.scrollIntoView({
      behavior: options.behavior || 'smooth',
      block: options.block || 'start',
      inline: options.inline || 'nearest'
    });
  },

  // IMAGE UTILITIES
  // ============================================
  preloadImage: function(url) {
    const img = new Image();
    img.src = url;
    return img;
  },

  getImageDimensions: function(url) {
    return new Promise((resolve, reject) => {
      const img = new Image();
      img.onload = () => resolve({ width: img.width, height: img.height });
      img.onerror = reject;
      img.src = url;
    });
  },

  // ARRAY UTILITIES
  // ============================================
  shuffle: function(array) {
    const arr = [...array];
    for (let i = arr.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [arr[i], arr[j]] = [arr[j], arr[i]];
    }
    return arr;
  },

  unique: function(array) {
    return [...new Set(array)];
  },

  // KEYBOARD EVENT UTILITIES
  // ============================================
  onKeyPress: function(key, callback) {
    document.addEventListener('keydown', (e) => {
      if (e.key === key || e.code === key) {
        callback(e);
      }
    });
  },

  // LOGGER
  // ============================================
  log: function(message, type = 'log') {
    const timestamp = new Date().toLocaleTimeString();
    console[type](`[${timestamp}] ${message}`);
  }
};

// Export for use in other scripts
if (typeof module !== 'undefined' && module.exports) {
  module.exports = CalystUtils;
}

console.log("✨ Calyst Utilities loaded successfully!");
