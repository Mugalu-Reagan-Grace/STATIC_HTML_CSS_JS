// ============================================
// CALYST CHRISTIAN SCHOOL - MAIN JAVASCRIPT
// ============================================

// UTILITY: Debounce function for performance
function debounce(func, wait) {
  let timeout;
  return function executedFunction(...args) {
    const later = () => {
      clearTimeout(timeout);
      func(...args);
    };
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
  };
}

// 0A. DYNAMIC BRANDING (LOGO + NAME)
// ============================================
function applyDynamicBranding() {
  const config = globalThis.CALYST_CONFIG;
  if (!config?.brand) return;

  const brand = config.brand;

  // Update logo images used in shared headers/forms.
  document.querySelectorAll(".logo-icon img, .letterhead-logo img").forEach((img) => {
    const isNavbarLogo = img.closest(".logo-icon") !== null;
    const logoPath = isNavbarLogo ? brand.logoNoBgPath || brand.logoPath : brand.logoPath;
    if (logoPath) img.setAttribute("src", logoPath);
    if (brand.logoAlt) img.setAttribute("alt", brand.logoAlt);
  });

  // Update school name in header branding blocks.
  document.querySelectorAll(".logo-text").forEach((el) => {
    if (brand.displayName) el.textContent = brand.displayName;
  });

  // Update motto in all motto elements.
  document.querySelectorAll(".logo-motto, .school-motto").forEach((el) => {
    if (brand.motto) el.textContent = brand.motto;
  });
}

function upsertMeta(attrName, attrValue, content) {
  if (!attrValue || !content) return;
  let meta = document.querySelector(`meta[${attrName}="${attrValue}"]`);
  if (!meta) {
    meta = document.createElement("meta");
    meta.setAttribute(attrName, attrValue);
    document.head.appendChild(meta);
  }
  meta.setAttribute("content", content);
}

function applyDynamicSiteIdentity() {
  const config = globalThis.CALYST_CONFIG;
  if (!config) return;

  const brandName = config.brand?.displayName || config.site?.name;
  const brandMotto = config.brand?.motto;

  // Footer school title
  const footerTitle = document.querySelector("footer .footer-content > .footer-column h3");
  if (footerTitle && brandName) {
    footerTitle.textContent = brandName;
  }

  // Footer intro line (only if it already references the school/motto)
  const footerIntro = footerTitle?.parentElement?.querySelector("p");
  if (footerIntro && brandMotto && /HOFU YA BWANA|Christian School|Christ-centered/i.test(footerIntro.textContent)) {
    const foundedYear = config.school?.founded || "1995";
    footerIntro.textContent = `Providing Christ-centered education since ${foundedYear}. ${brandMotto} - a commitment to academic excellence, character development, and faith.`;
  }

  // Selected dynamic metadata
  const authorName = config.seo?.author || config.site?.name;
  const themeColor = config.colors?.primary;
  const siteName = config.site?.name;

  upsertMeta("name", "author", authorName);
  upsertMeta("name", "theme-color", themeColor);
  upsertMeta("property", "og:site_name", siteName);

  if (config.brand?.logoPath) {
    const logoUrl = new URL(config.brand.logoPath, globalThis.location.href).href;
    upsertMeta("property", "og:image", logoUrl);
    upsertMeta("name", "twitter:image", logoUrl);
  }
}

const DEFAULT_NAVIGATION = [
  { label: "Home", url: "./home.php" },
  {
    label: "About",
    url: "./about.php",
    children: [
      { label: "Staff", url: "./staff.php" },
      { label: "Fees", url: "./fees.php" },
    ],
  },
  { label: "Gallery", url: "./gallery.php" },
  { label: "Programs", url: "./programs.php" },
  { label: "Contact", url: "./contact_us.php" },
  { label: "News & Events", url: "./news-events.php" },
  {
    label: "Admissions",
    url: "./admissions.php",
    itemClass: "nav-admissions",
    linkClass: "btn-admissions",
  },
];

function normalizePathname(url) {
  if (!url || typeof url !== "string") return "";
  const cleaned = url.split("?")[0].split("#")[0];
  const segments = cleaned.split("/").filter(Boolean);
  return (segments.at(-1) || "").toLowerCase();
}

function getCurrentPageName() {
  const path = (globalThis.location?.pathname || "").split("/");
  return (path.at(-1) || "home.php").toLowerCase();
}

function buildNavItemMarkup(item, currentPageName) {
  if (!item?.label || !item?.url) return "";

  const itemClasses = [];
  if (item.itemClass) itemClasses.push(item.itemClass);

  const children = Array.isArray(item.children) ? item.children : [];
  const isCurrent = normalizePathname(item.url) === currentPageName;
  const hasActiveChild = children.some(
    (child) => normalizePathname(child.url) === currentPageName,
  );
  const hasChildren = children.length > 0;

  if (hasChildren) itemClasses.push("dropdown");

  const linkClasses = [];
  if (item.linkClass) linkClasses.push(item.linkClass);
  if (isCurrent || hasActiveChild) linkClasses.push("active");

  const ariaCurrent = isCurrent ? ' aria-current="page"' : "";
  const classAttr = itemClasses.length
    ? ` class="${itemClasses.join(" ")}"`
    : "";
  const linkClassAttr = linkClasses.length
    ? ` class="${linkClasses.join(" ")}"`
    : "";

  if (!hasChildren) {
    return `<li${classAttr}><a href="${item.url}"${linkClassAttr}${ariaCurrent}>${item.label}</a></li>`;
  }

  const childMarkup = children
    .filter((child) => child?.label && child?.url)
    .map((child) => {
      const childIsCurrent = normalizePathname(child.url) === currentPageName;
      const childAriaCurrent = childIsCurrent ? ' aria-current="page"' : "";
      const childClass = childIsCurrent ? ' class="active"' : "";
      return `<li><a href="${child.url}"${childClass}${childAriaCurrent}>${child.label}</a></li>`;
    })
    .join("");

  return `<li${classAttr}><a href="${item.url}"${linkClassAttr}${ariaCurrent}>${item.label}</a><ul class="dropdown-menu">${childMarkup}</ul></li>`;
}

function applyDynamicNavbar() {
  const config = globalThis.CALYST_CONFIG;
  const navigationItems = Array.isArray(config?.navigation)
    ? config.navigation
    : DEFAULT_NAVIGATION;

  if (!navigationItems.length) return;

  const currentPageName = getCurrentPageName();
  const hasSidebar = Boolean(document.querySelector(".sidebar"));

  const desktopMarkup = navigationItems
    .map((item) => buildNavItemMarkup(item, currentPageName))
    .join("");

  const mobileMarkup = [
    '<li class="close-sidebar"><button type="button" class="sidebar-close" aria-label="Close menu"><i class="fa-solid fa-x" aria-hidden="true"></i></button></li>',
    ...navigationItems.map((item) => buildNavItemMarkup(item, currentPageName)),
  ].join("");

  document.querySelectorAll(".navbar .nav-links").forEach((navList) => {
    const menuToggleMarkup = hasSidebar
      ? '<li class="open-sidebar"><button type="button" class="menu-toggle" aria-label="Open main menu" aria-controls="mobile-sidebar" aria-expanded="false"><i class="fa-solid fa-bars" aria-hidden="true"></i><span class="menu-toggle-label">Menu</span></button></li>'
      : "";
    navList.innerHTML = `${desktopMarkup}${menuToggleMarkup}`;
  });

  document.querySelectorAll(".sidebar .nav-links").forEach((sidebarList) => {
    sidebarList.innerHTML = mobileMarkup;
  });
}

document.addEventListener("DOMContentLoaded", () => {
  applyDynamicNavbar();
  applyDynamicBranding();
  applyDynamicSiteIdentity();
});

// 0. SLIDESHOW FUNCTIONALITY
// ============================================
let slideIndex = 1;
let slideshowTimer;

function changeSlide(n) {
  slideIndex += n;
  showSlide(slideIndex);
  resetSlideshowTimer();
}

function currentSlide(n) {
  slideIndex = n;
  showSlide(slideIndex);
  resetSlideshowTimer();
}

function showSlide(n) {
  const slides = document.getElementsByClassName("slide");
  const indicators = document.getElementsByClassName("indicator");

  if (n > slides.length) {
    slideIndex = 1;
  }
  if (n < 1) {
    slideIndex = slides.length;
  }

  for (const slide of slides) {
    slide.classList.remove("active");
  }
  for (const indicator of indicators) {
    indicator.classList.remove("active");
  }

  if (slides[slideIndex - 1]) {
    slides[slideIndex - 1].classList.add("active");
  }
  if (indicators[slideIndex - 1]) {
    indicators[slideIndex - 1].classList.add("active");
  }
}

function autoSlide() {
  slideIndex += 1;
  showSlide(slideIndex);
}

function resetSlideshowTimer() {
  clearInterval(slideshowTimer);
  slideshowTimer = setInterval(autoSlide, 5000); // Auto-advance every 5 seconds
}

function pauseSlideshow() {
  clearInterval(slideshowTimer);
}

function resumeSlideshow() {
  resetSlideshowTimer();
}

// Initialize slideshow with visibility optimization
document.addEventListener("DOMContentLoaded", function () {
  const slideshowContainer = document.querySelector(".slideshow-container");

  if (slideshowContainer) {
    showSlide(slideIndex);
    resetSlideshowTimer();

    // Pause slideshow when not visible (performance optimization)
    if ("IntersectionObserver" in globalThis) {
      const observer = new IntersectionObserver(
        (entries) => {
          entries.forEach((entry) => {
            if (entry.isIntersecting) {
              resumeSlideshow();
            } else {
              pauseSlideshow();
            }
          });
        },
        { threshold: 0.5 },
      );
      observer.observe(slideshowContainer);
    }

    // Pause on hover for better UX
    slideshowContainer.addEventListener("mouseenter", pauseSlideshow);
    slideshowContainer.addEventListener("mouseleave", resumeSlideshow);
  }
});

// 1. MOBILE MENU TOGGLE
// ============================================
function showSidebar() {
  const sidebar = document.querySelector(".sidebar");
  const toggle = document.querySelector(".menu-toggle");
  if (sidebar) {
    sidebar.classList.add("active");
    sidebar.setAttribute("aria-hidden", "false");
    document.body.style.overflow = "hidden"; // Prevent scrolling
  }

  if (toggle) {
    toggle.setAttribute("aria-expanded", "true");
  }
}

function hideSidebar() {
  const sidebar = document.querySelector(".sidebar");
  const toggle = document.querySelector(".menu-toggle");
  if (sidebar) {
    sidebar.classList.remove("active");
    sidebar.setAttribute("aria-hidden", "true");
    document.body.style.overflow = "auto"; // Re-enable scrolling
  }

  if (toggle) {
    toggle.setAttribute("aria-expanded", "false");
  }
}

function handleToggleKey(event, action) {
  if (event.key === "Enter" || event.key === " ") {
    event.preventDefault();
    action();
  }
}

// Wire up sidebar interactions
document.addEventListener("DOMContentLoaded", function () {
  const navLinks = document.querySelectorAll(".sidebar a");
  const openToggle = document.querySelector(".menu-toggle");
  const closeToggle = document.querySelector(".sidebar-close");

  navLinks.forEach((link) => {
    link.addEventListener("click", hideSidebar);
  });

  if (openToggle) {
    openToggle.addEventListener("click", showSidebar);
    openToggle.addEventListener("keydown", (event) =>
      handleToggleKey(event, showSidebar),
    );
  }

  if (closeToggle) {
    closeToggle.addEventListener("click", hideSidebar);
    closeToggle.addEventListener("keydown", (event) =>
      handleToggleKey(event, hideSidebar),
    );
  }

  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape") {
      hideSidebar();
    }
  });

  // Mobile Dropdown Toggle
  const dropdowns = document.querySelectorAll(".sidebar .dropdown > a");
  dropdowns.forEach((dropdownToggle) => {
    dropdownToggle.addEventListener("click", function (e) {
      // Only prevent default on mobile, allow normal navigation on desktop
      if (window.innerWidth <= 767) {
        e.preventDefault();
        const parentDropdown = this.parentElement;
        parentDropdown.classList.toggle("active");
      }
    });
  });
});

// 2. SMOOTH SCROLL BEHAVIOR
// ============================================
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute("href"));
    target?.scrollIntoView({
      behavior: "smooth",
      block: "start",
    });
  });
});

// 3. ACTIVE NAV LINK HIGHLIGHTING
// ============================================
function updateActiveNavLink() {
  const currentPage =
    (globalThis.location?.pathname || "").split("/").pop() || "home.php";
  const navLinks = document.querySelectorAll(".nav-links a");

  navLinks.forEach((link) => {
    link.classList.remove("active");
    const href = link.getAttribute("href").split("/").pop();
    if (href === currentPage) {
      link.classList.add("active");
    }
  });
}

// Update active link on page load and scroll
globalThis.addEventListener("load", updateActiveNavLink);
globalThis.addEventListener("hashchange", updateActiveNavLink);

// 4. TAB SWITCHING FOR EVENTS/NEWS
// ============================================
document.addEventListener("DOMContentLoaded", function () {
  const tabs = document.querySelectorAll(".tab");
  const eventLists = document.querySelectorAll(".event-list");

  if (tabs.length > 0) {
    tabs.forEach((tab, index) => {
      tab.addEventListener("click", function () {
        // Remove active class from all tabs
        tabs.forEach((t) => t.classList.remove("active"));
        // Add active class to clicked tab
        this.classList.add("active");

        // Hide all event lists
        eventLists.forEach((list) => {
          list.style.display = "none";
        });

        // Show corresponding event list
        if (eventLists[index]) {
          eventLists[index].style.display = "block";
        }
      });
    });
  }
});

// 4B. INTERACTIVE GALLERY CONTROLS
// ============================================
document.addEventListener("DOMContentLoaded", function () {
  const gallery = document.querySelector(".interactive-gallery");
  const grid = gallery?.querySelector(".interactive-grid");
  const arrows = gallery?.querySelectorAll(".gallery-arrow") || [];

  if (!grid || arrows.length === 0) {
    return;
  }

  arrows.forEach((arrow) => {
    arrow.addEventListener("click", () => {
      const direction = arrow.dataset.direction;
      const scrollAmount = grid.clientWidth * 0.8;
      grid.scrollBy({
        left: direction === "next" ? scrollAmount : -scrollAmount,
        behavior: "smooth",
      });
    });
  });
});

// 5. GALLERY FILTERING AND SEARCH
// ============================================
document.addEventListener("DOMContentLoaded", function () {
  const categoryBtns = document.querySelectorAll(".category-btn");
  const photoCards = document.querySelectorAll(".photo-card");
  const searchInput = document.querySelector(".search-box input");

  // Category filtering
  categoryBtns.forEach((btn) => {
    btn.addEventListener("click", function () {
      categoryBtns.forEach((b) => b.classList.remove("active"));
      this.classList.add("active");

      const category = this.textContent.trim().toLowerCase();

      photoCards.forEach((card) => {
        if (category === "all photos") {
          card.style.display = "block";
        } else {
          const cardCategory = card.dataset.category || "";
          if (cardCategory.includes(category)) {
            card.style.display = "block";
          } else {
            card.style.display = "none";
          }
        }
      });
    });
  });

  // Search functionality
  if (searchInput) {
    searchInput.addEventListener("input", function () {
      const searchTerm = this.value.toLowerCase();

      photoCards.forEach((card) => {
        const titleText =
          card.querySelector(".photo-title")?.textContent.toLowerCase() || "";

        if (titleText.includes(searchTerm) || searchTerm === "") {
          card.style.display = "block";
        } else {
          card.style.display = "none";
        }
      });
    });
  }
});

// 6. CONTACT FORM SUBMISSION
// ============================================
document.addEventListener("DOMContentLoaded", function () {
  const contactForm = document.querySelector(".contact-form form");

  if (contactForm) {
    contactForm.addEventListener("submit", function (e) {
      e.preventDefault();

      const name = this.querySelector('input[type="text"]').value.trim();
      const email = this.querySelector('input[type="email"]').value.trim();
      const phone = this.querySelector('input[type="tel"]').value.trim();
      const message = this.querySelector("textarea").value.trim();

      // Basic validation
      if (!name || !email || !message) {
        showNotification("Please fill in all required fields", "error");
        return;
      }

      // Email validation
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        showNotification("Please enter a valid email address", "error");
        return;
      }

      // Prepare form data
      const formData = new FormData();
      formData.append("name", name);
      formData.append("email", email);
      formData.append("phone", phone);
      formData.append("message", message);

      // Send to email (using mailto as fallback)
      const mailtoLink = `mailto:mugalureagan18@gmail.com?subject=Message from ${encodeURIComponent(
        name,
      )}&body=${encodeURIComponent(
        `Name: ${name}\nEmail: ${email}\nPhone: ${phone}\n\nMessage:\n${message}`,
      )}`;

      globalThis.location.href = mailtoLink;
      showNotification(
        "Thank you! Your message will be sent to our email.",
        "success",
      );

      // Reset form
      this.reset();
    });
  }
});

// 7. NEWSLETTER SUBSCRIPTION
// ============================================
document.addEventListener("DOMContentLoaded", function () {
  const newsletterForm = document.querySelector(".newsletter form");

  if (newsletterForm) {
    newsletterForm.addEventListener("submit", function (e) {
      e.preventDefault();

      const emailInput = this.querySelector('input[type="email"]');
      const email = emailInput.value.trim();

      // Email validation
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        showNotification("Please enter a valid email address", "error");
        return;
      }

      // Simulate subscription
      showNotification(
        "Thank you for subscribing! Check your email for updates.",
        "success",
      );
      this.reset();
    });
  }
});

// 8. NOTIFICATION SYSTEM
// ============================================
function showNotification(message, type = "success") {
  // Create notification element
  const notification = document.createElement("div");
  notification.className = `notification notification-${type}`;
  notification.textContent = message;

  // Style the notification
  Object.assign(notification.style, {
    position: "fixed",
    top: "20px",
    right: "20px",
    padding: "15px 20px",
    borderRadius: "5px",
    fontSize: "14px",
    fontWeight: "500",
    zIndex: "9999",
    animation: "slideIn 0.3s ease-in-out",
  });

  // Set color based on type
  if (type === "success") {
    notification.style.backgroundColor = "#22c55e";
    notification.style.color = "white";
  } else if (type === "error") {
    notification.style.backgroundColor = "#ef4444";
    notification.style.color = "white";
  } else {
    notification.style.backgroundColor = "#3b82f6";
    notification.style.color = "white";
  }

  document.body.appendChild(notification);

  // Auto-remove after 4 seconds
  setTimeout(() => {
    notification.style.animation = "slideOut 0.3s ease-in-out";
    setTimeout(() => notification.remove(), 300);
  }, 4000);
}

// 9. SCROLL-TO-TOP BUTTON
// ============================================
document.addEventListener("DOMContentLoaded", function () {
  // Create scroll-to-top button
  const scrollTopBtn = document.createElement("button");
  scrollTopBtn.innerHTML = '<i class="fas fa-arrow-up"></i>';
  scrollTopBtn.className = "scroll-to-top";
  scrollTopBtn.setAttribute("aria-label", "Scroll to top");
  document.body.appendChild(scrollTopBtn);

  // Style the button
  Object.assign(scrollTopBtn.style, {
    position: "fixed",
    bottom: "30px",
    right: "30px",
    width: "50px",
    height: "50px",
    backgroundColor: "#1e3a8a",
    color: "white",
    border: "none",
    borderRadius: "50%",
    cursor: "pointer",
    fontSize: "20px",
    display: "none",
    zIndex: "99",
    transition: "all 0.3s ease",
  });

  // Debounced scroll handler for better performance
  const handleScroll = debounce(() => {
    if (globalThis.scrollY > 300) {
      scrollTopBtn.style.display = "flex";
      scrollTopBtn.style.alignItems = "center";
      scrollTopBtn.style.justifyContent = "center";
    } else {
      scrollTopBtn.style.display = "none";
    }
  }, 100);

  globalThis.addEventListener("scroll", handleScroll);

  // Scroll to top on click
  scrollTopBtn.addEventListener("click", function () {
    globalThis.scrollTo({
      top: 0,
      behavior: "smooth",
    });
  });

  // Hover effect
  scrollTopBtn.addEventListener("mouseenter", function () {
    this.style.transform = "scale(1.1)";
    this.style.backgroundColor = "#3b82f6";
  });

  scrollTopBtn.addEventListener("mouseleave", function () {
    this.style.transform = "scale(1)";
    this.style.backgroundColor = "#1e3a8a";
  });
});

// 10. LAZY LOADING FOR IMAGES
// ============================================
document.addEventListener("DOMContentLoaded", function () {
  const images = document.querySelectorAll("img[data-src]");

  if ("IntersectionObserver" in globalThis) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const img = entry.target;
          const dataSrc = img.dataset.src;
          if (dataSrc) {
            img.src = dataSrc;
            delete img.dataset.src;
          }
          img.classList.add("loaded");
          observer.unobserve(img);
        }
      });
    });

    images.forEach((img) => imageObserver.observe(img));
  } else {
    // Fallback for older browsers
    images.forEach((img) => {
      const dataSrc = img.dataset.src;
      if (dataSrc) {
        img.src = dataSrc;
        delete img.dataset.src;
      }
    });
  }
});

// 11. MODAL/LIGHTBOX FOR GALLERY IMAGES
// ============================================
document.addEventListener("DOMContentLoaded", function () {
  const photoCards = document.querySelectorAll(".photo-card");

  photoCards.forEach((card) => {
    card.addEventListener("click", function () {
      const img = this.querySelector(".photo-img");
      const title = this.querySelector(".photo-title");

      if (img) {
        openLightbox(img.src, title ? title.textContent : "");
      }
    });
  });

  // Make gallery images clickable with cursor
  photoCards.forEach((card) => {
    card.style.cursor = "pointer";
  });
});

function openLightbox(imageSrc, imageTitle) {
  // Create lightbox elements
  const lightbox = document.createElement("div");
  lightbox.className = "lightbox";

  const lightboxContent = document.createElement("div");
  lightboxContent.className = "lightbox-content";

  const closeBtn = document.createElement("button");
  closeBtn.innerHTML = "&times;";
  closeBtn.className = "lightbox-close";
  closeBtn.setAttribute("aria-label", "Close lightbox");

  const img = document.createElement("img");
  img.src = imageSrc;
  img.alt = imageTitle;

  const caption = document.createElement("p");
  caption.className = "lightbox-caption";
  caption.textContent = imageTitle;

  // Assemble lightbox
  lightboxContent.appendChild(closeBtn);
  lightboxContent.appendChild(img);
  lightboxContent.appendChild(caption);
  lightbox.appendChild(lightboxContent);

  // Style lightbox
  Object.assign(lightbox.style, {
    position: "fixed",
    top: "0",
    left: "0",
    width: "100%",
    height: "100%",
    backgroundColor: "rgba(0, 0, 0, 0.9)",
    display: "flex",
    justifyContent: "center",
    alignItems: "center",
    zIndex: "10000",
  });

  Object.assign(lightboxContent.style, {
    position: "relative",
    maxWidth: "90vw",
    maxHeight: "90vh",
  });

  Object.assign(img.style, {
    maxWidth: "100%",
    maxHeight: "80vh",
    objectFit: "contain",
  });

  Object.assign(closeBtn.style, {
    position: "absolute",
    top: "20px",
    right: "30px",
    fontSize: "40px",
    color: "white",
    background: "none",
    border: "none",
    cursor: "pointer",
    zIndex: "10001",
  });

  Object.assign(caption.style, {
    color: "white",
    textAlign: "center",
    marginTop: "10px",
    fontSize: "18px",
  });

  document.body.appendChild(lightbox);

  // Close on button click
  closeBtn.addEventListener("click", () => lightbox.remove());

  // Close on background click
  lightbox.addEventListener("click", (e) => {
    if (e.target === lightbox) {
      lightbox.remove();
    }
  });

  // Close on Escape key
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
      lightbox.remove();
    }
  });
}

// 12. ANIMATIONS ON SCROLL
// ============================================
function observeAnimations() {
  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("fade-in");
        observer.unobserve(entry.target);
      }
    });
  });

  const elements = document.querySelectorAll(
    ".highlight-card, .stat-item, .testimonial-card",
  );
  elements.forEach((el) => observer.observe(el));
}

// Call animation observer on load
globalThis.addEventListener("load", observeAnimations);

// 13. FORM INPUT VALIDATION
// ============================================
document.addEventListener("DOMContentLoaded", function () {
  const inputs = document.querySelectorAll("input, textarea");

  inputs.forEach((input) => {
    input.addEventListener("blur", function () {
      validateInput(this);
    });

    input.addEventListener("focus", function () {
      this.style.borderColor = "#3b82f6";
    });
  });
});

function validateInput(input) {
  let isValid = true;
  const value = input.value.trim();

  if (input.hasAttribute("required") && !value) {
    isValid = false;
  }

  if (input.type === "email" && value) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    isValid = emailRegex.test(value);
  }

  if (input.type === "tel" && value) {
    const phoneRegex = /^[\d\s+()-]+$/;
    isValid = phoneRegex.test(value);
  }

  // Visual feedback
  if (isValid) {
    input.style.borderColor = "#22c55e";
  } else {
    input.style.borderColor = "#ef4444";
  }
}

// 14. COUNTER ANIMATION FOR STATS
// ============================================
document.addEventListener("DOMContentLoaded", function () {
  const stats = document.querySelectorAll(".stat-item h3");
  let hasRun = false;

  if (stats.length > 0) {
    const debouncedScroll = debounce(() => {
      const statsSection = document.querySelector(".stats");
      if (!statsSection || hasRun) {
        return;
      }

      const rect = statsSection.getBoundingClientRect();
      if (rect.top < globalThis.innerHeight) {
        animateCounters();
        hasRun = true;
      }
    }, 100);

    globalThis.addEventListener("scroll", debouncedScroll);
  }
});

function animateCounters() {
  const stats = document.querySelectorAll(".stat-item h3");

  stats.forEach((stat) => {
    const text = stat.textContent;
    const isPercentage = text.includes("%");
    const isRatio = text.includes(":");
    const isFounded = text === "1995";

    if (isFounded || isRatio || isPercentage) {
      // Don't animate text-based stats
      return;
    }

    const number = Number.parseInt(text.replaceAll(/\D/g, ""));
    if (Number.isNaN(number)) return;

    let current = 0;
    const increment = Math.ceil(number / 30);
    const interval = setInterval(() => {
      current += increment;
      if (current >= number) {
        stat.textContent = number + "+";
        clearInterval(interval);
      } else {
        stat.textContent = current + "+";
      }
    }, 50);
  });
}

// 15. KEYBOARD NAVIGATION
// ============================================
document.addEventListener("DOMContentLoaded", function () {
  // Tab navigation for menus
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
      hideSidebar();
    }
  });

  // Add keyboard support to buttons
  const buttons = document.querySelectorAll("button");
  buttons.forEach((btn) => {
    btn.addEventListener("keydown", (e) => {
      if (e.key === "Enter" || e.key === " ") {
        btn.click();
      }
    });
  });
});

// 16. PAGE LOAD ANIMATION
// ============================================
globalThis.addEventListener("load", function () {
  document.body.style.opacity = "0";
  setTimeout(() => {
    document.body.style.transition = "opacity 0.5s ease-in";
    document.body.style.opacity = "1";
  }, 100);
});

// 17. PRINT FUNCTIONALITY
// ============================================
function printPage() {
  globalThis.print();
}

// 18. SHARE FUNCTIONALITY
// ============================================
function shareContent(platform) {
  const pageUrl = encodeURIComponent(globalThis.location.href);
  const pageTitle = encodeURIComponent(document.title);
  let shareUrl;

  switch (platform) {
    case "facebook":
      shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${pageUrl}`;
      break;
    case "twitter":
      shareUrl = `https://twitter.com/intent/tweet?url=${pageUrl}&text=${pageTitle}`;
      break;
    case "whatsapp":
      shareUrl = `https://wa.me/?text=${pageTitle}%20${pageUrl}`;
      break;
    default:
      return;
  }

  globalThis.open(shareUrl, "_blank", "width=600,height=400");
}

// 19. DARK MODE TOGGLE (Optional)
// ============================================
function toggleDarkMode() {
  const isDarkMode = localStorage.getItem("darkMode") === "true";
  if (isDarkMode) {
    document.body.classList.remove("dark-mode");
    localStorage.setItem("darkMode", "false");
  } else {
    document.body.classList.add("dark-mode");
    localStorage.setItem("darkMode", "true");
  }
}

// 20. LOCAL STORAGE FOR USER PREFERENCES
// ============================================
document.addEventListener("DOMContentLoaded", function () {
  // Check if user prefers dark mode
  if (localStorage.getItem("darkMode") === "true") {
    document.body.classList.add("dark-mode");
  }

  // Save form data to local storage
  const formInputs = document.querySelectorAll(
    ".contact-form input, .contact-form textarea",
  );
  formInputs.forEach((input) => {
    input.addEventListener("change", function () {
      localStorage.setItem(`form_${this.name}`, this.value);
    });

    // Load saved data
    const savedValue = localStorage.getItem(`form_${input.name}`);
    if (savedValue) {
      input.value = savedValue;
    }
  });
});

console.log("✨ Calyst Christian School - JavaScript loaded successfully!");

