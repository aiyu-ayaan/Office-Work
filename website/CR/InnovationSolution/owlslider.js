

function updateRightBox(category) {
    let posts = wpData[category] || [];
    let postContainer = jQuery(".insights-container #postContainer");
    postContainer.empty();

    let rightBox = jQuery('.insights-container .right-box');
    rightBox.html('');

    let content = jQuery('<div class="content" id="postContainer"></div>');

    posts.forEach((post, index) => {
        let isVideoVisible = index === 0;
        let item = jQuery(`
      <div class="post-item item ${index === 0 ? 'full-width' : 'half-width'}">
        <a class="only-portrait-anchor" href="${post.url}">
          <div class="background">
            <video class="post-video" autoplay muted loop playsinline poster="${post.featured_image}">
              <source src="${post.video_url}" type="video/mp4">
            </video>
            <img class="post-image" src="${post.featured_image}" alt="${post.title}">
          </div>
        </a>    
        <div class="text-container">
          <a class="only-portrait-anchor" href="${post.url}"><h3 class="post-title font-bold small-size">${post.title}</h3></a>
          <button class="service-btn-solid custom-button bg-color-ia ">${post.cta_text}</button>
        </div>
      </div>
  `);

        item.find(".service-btn-solid").on("click", function () {
            window.location.href = post.url;
        });
        content.append(item);
    });
    rightBox.append(content);
    rightBox.append('<button onclick="window.location.href=\'/insights/\'" class="service-btn-solid custom-button bg-color-ia">Explore All</button>');


    jQuery('.post-video').on('loadeddata', function () {
        jQuery(this).siblings('.post-image').hide();
    }).on('error', function () {
        jQuery(this).hide();
    });
}

function initCarousel() {
    const isPortrait = window.matchMedia("(max-width: 1024.9px) and (orientation: portrait)").matches;
    const isBelow767 = window.matchMedia("(max-width: 767.5px)").matches;
    let postContainer = jQuery(".insights-container #postContainer");

    if (isPortrait || isBelow767) {
        postContainer.addClass("owl-carousel").owlCarousel({
            items: 1.45,
            loop: true,
            dotsEach: 1,
            margin: 16,
            nav: true,
            dots: true,
            responsive: {
                768: {
                    items: 2.34,
                }

            }
        });
    } else {
        postContainer.removeClass("owl-carousel owl-loaded").trigger("destroy.owl.carousel");
    }
}
jQuery(document).ready(function () {
    let activeCategory = null;
    jQuery(".insights-container .menu li").on("mouseenter", function () {
        const width = window.innerWidth;
        const isPortrait = window.matchMedia("(orientation: portrait)").matches;

        if (
            (width > 1024) || // Desktop
            (width >= 768 && width <= 1024 && !isPortrait) // Tablet landscape
        ) {
            jQuery(".insights-container .menu li").removeClass("active medium-size").addClass("small-size");
            jQuery(this).addClass("active medium-size").removeClass("small-size");

            activeCategory = jQuery(this).data("category");
            updateRightBox(activeCategory);
            initCarousel();
        }
    });

    jQuery(".insights-container .right-content").on("mouseenter", function () {
        if (activeCategory) {
            updateRightBox(activeCategory);
            initCarousel();
        }
    });

    jQuery(window).resize(() => initCarousel());

    updateRightBox("use-case");
    initCarousel();
});
let hasUserScrolled = false;
document.addEventListener("DOMContentLoaded", function () {
    const menu = document.querySelector(".insights-container .menu");
    const items = menu.querySelectorAll("li");
    const prevButton = document.querySelector(".insights-container .nav-button.prev");
    const nextButton = document.querySelector(".insights-container .nav-button.next");

    let activeIndex = 0;

    function updateActiveItem(index) {
        // Clamp the index to stay within bounds
        activeIndex = Math.max(0, Math.min(index, items.length - 1));

        // Remove active class from all items
        items.forEach(item => item.classList.remove("active"));

        // Add active class to the current item
        items[activeIndex].classList.add("active");

        // Scroll the active item into view
        if (hasUserScrolled) {
            items[activeIndex].scrollIntoView({
                behavior: "smooth",
                inline: "start",
                block: "nearest"
            });
        }
        activeCategory = items[activeIndex].getAttribute("data-category"); // or use dataset
        updateRightBox(activeCategory);
        initCarousel();
        updateButtons();
    }

    function updateButtons() {
        prevButton.style.display = activeIndex === 0 ? "none" : "block";
        nextButton.style.display = activeIndex === items.length - 1 ? "none" : "block";
    }

    prevButton.addEventListener("click", function () {
        hasUserScrolled = true;
        updateActiveItem(activeIndex - 1);
    });

    nextButton.addEventListener("click", function () {
        hasUserScrolled = true;
        updateActiveItem(activeIndex + 1);
    });

    // Initial setup
    updateActiveItem(activeIndex);
});





// Viewport animation trigger
// Viewport animation trigger - Maintains animation on viewport entry
function initViewportAnimations() {
    // Create intersection observer that doesn't interfere with scroll
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Use requestAnimationFrame to prevent scroll blocking
                requestAnimationFrame(() => {
                    // Add animation class when element enters viewport
                    entry.target.classList.add('animate-in');
                });
                // Keep observing in case element goes out and comes back into view
                // Remove this line if you want one-time animation only:
                // observer.unobserve(entry.target);
            } else {
                // Optional: Remove animation class when element leaves viewport
                // Uncomment if you want animation to replay each time:
                // entry.target.classList.remove('animate-in');
            }
        });
    }, {
        // Trigger when 20% of the element is visible
        threshold: 0.2,
        // Reduced root margin to be less aggressive
        rootMargin: '20px 0px -20px 0px'
    });

    // Find all elements you want to animate (not just .insights-container)
    const animateElements = document.querySelectorAll('.insights-container, .post-item, .menu li');
    animateElements.forEach(element => {
        observer.observe(element);
    });

    // Return observer for cleanup if needed
    return observer;
}

// Initialize with scroll-friendly approach
function initViewportAnimationsWithCleanup() {
    let observer = null;

    const init = () => {
        // Clean up existing observer if any
        if (observer) {
            observer.disconnect();
        }
        observer = initViewportAnimations();
    };

    // Use passive event listeners to not interfere with scroll
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init, { passive: true });
    } else {
        // DOM already loaded - use minimal delay to prevent blocking
        requestAnimationFrame(init);
    }

    // Return cleanup function
    return () => {
        if (observer) {
            observer.disconnect();
        }
    };
}

// Call the initialization
const cleanupAnimations = initViewportAnimationsWithCleanup();

// Optional: If you need to stop animations later
// cleanupAnimations();