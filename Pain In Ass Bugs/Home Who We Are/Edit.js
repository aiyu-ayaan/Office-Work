// banner

const owl = jQuery(".hero-carousel.owl-carousel");
jQuery(document).ready(function () {
    owl.owlCarousel({
        loop: true,
        items: 1,
        autoplay: true,
        smartSpeed: 500,
        autoplayTimeout: 5200,
        nav: true,
        dots: true,
        animateOut: "fadeOut",
        animateIn: "fadeIn",
        responsive: {
            0: {
                mouseDrag: true,
                touchDrag: true,
            },
            1025: {
                mouseDrag: false,
                touchDrag: false,
            },
        },
    });
});
owl.on("translate.owl.carousel", function (event) {
    const currentIndex = event.item.index;
    const currentSlide = jQuery(".owl-item").eq(currentIndex);
    const video = currentSlide.find("video");

    if (video.length) {
        video.get(0).pause();
        video.get(0).currentTime = 0;
        video.attr("src", "");
    }
});

owl.on("translated.owl.carousel", function (event) {
    const currentIndex = event.item.index;
    const currentSlide = jQuery(".owl-item").eq(currentIndex);
    const video = currentSlide.find("video");

    if (video.length && !video.attr("src") && video.data("src")) {
        video.attr("src", video.data("src")).get(0).load();
        video
            .get(0)
            .play()
            .catch((e) => console.log("Video play error: ", e));
    }
});

let autoplayTimeout;
// Pause autoplay on swipe
owl.on("dragged.owl.carousel", function () {
    owl.trigger("stop.owl.autoplay");
    clearTimeout(autoplayTimeout);
    autoplayTimeout = setTimeout(() => {
        owl.trigger("play.owl.autoplay", [5200]);
    }, 100);
});
// our services
//   function startVerticalScroll(carousel) {
//     const items = Array.from(carousel.children);
//     const rowHeight = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--row-height'));

//     // Duplicate items for seamless loop
//     items.forEach(item => {
//         const clone = item.cloneNode(true);
//         carousel.appendChild(clone);
//     });

//     let pos = 0;

//     function animate() {
//         pos += 0.3; // speed
//         if (pos >= items.length * rowHeight) pos = 0; // reset for seamless loop
//         carousel.style.transform = `translateY(-${pos}px)`;

//         // Highlight center item
//         const centerIndex = Math.floor((pos + rowHeight) / rowHeight) % items.length;
//         Array.from(carousel.children).forEach((item, idx) => {
//             if (idx % items.length === centerIndex) {
//                 item.style.color = '#fff';
// 	            item.style.fontWeight = "bold";
// 				item.style.transform = 'scale(1.1)';
//             } else {
//                 item.style.color = '#2D79A6';
// 				item.style.fontWeight = "normal";
// 				item.style.transform = 'scale(1)';

//             }
//         });

//         requestAnimationFrame(animate);
//     }

//     animate();
// }
// Store animation references for cleanup
const subServicecarouselAnimations = new WeakMap();

function startVerticalScroll(carousel) {
    // Cancel previous animation frame and remove clones if present
    if (subServicecarouselAnimations.has(carousel)) {
        cancelAnimationFrame(subServicecarouselAnimations.get(carousel).frameId);
        // Remove previous clones (keep only original items)
        const originalLength =
            subServicecarouselAnimations.get(carousel).originalLength;
        while (carousel.children.length > originalLength) {
            carousel.removeChild(carousel.lastChild);
        }
    }

    // Clone only if not already cloned
    const items = Array.from(carousel.children);
    const originalLength = items.length;
    items.forEach((item) => {
        const clone = item.cloneNode(true);
        carousel.appendChild(clone);
    });

    const rowHeight = parseInt(
        getComputedStyle(document.documentElement).getPropertyValue("--row-height")
    );
    let pos = 0;
    function animate() {
        pos += 0.3;
        if (pos >= originalLength * rowHeight) pos = 0;
        carousel.style.transform = `translateY(-${pos}px)`;
        // Highlight center
        const centerIndex =
            Math.floor((pos + rowHeight) / rowHeight) % originalLength;
        Array.from(carousel.children).forEach((item, idx) => {
            if (idx % originalLength === centerIndex) {
                item.style.color = "#fff";
                item.style.fontWeight = "bold";
                item.style.transform = "scale(1.1)";
            } else {
                item.style.color = "#2D79A6";
                item.style.fontWeight = "normal";
                item.style.transform = "scale(1)";
            }
        });
        const frameId = requestAnimationFrame(animate);
        subServicecarouselAnimations.set(carousel, { frameId, originalLength });
    }
    animate();
}

// counter
document.addEventListener("DOMContentLoaded", () => {
    const section = document.querySelector(".counters-container");
    const gradients = document.querySelectorAll(".gradients");

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    gradients.forEach((g) => g.classList.add("active"));
                    observer.unobserve(section); // run only once
                }
            });
        },
        { threshold: 0.3 }
    );

    observer.observe(section);
});

// featured insights
// our clients testimonial
// jQuery(document).ready(function () {
//   const testimonial_owl = jQuery(".testimonial-carousel .owl-carousel");
// function setEqualHeight() {
//   let maxHeight = 0;
//   testimonial_owl.find(".owl-item").each(function () {
//     let thisHeight = jQuery(this).outerHeight(true); // include padding/margin
//     if (thisHeight > maxHeight) {
//       maxHeight = thisHeight;
//     }
//   });
// console.log("maxHeight",maxHeight);
//   if (maxHeight > 0) {
//     testimonial_owl.find(".owl-item").css("height", maxHeight + "px");
//   }
// }
jQuery(document).ready(function () {
    const testimonial_owl = jQuery(".testimonial-carousel .owl-carousel");

    function setEqualHeight() {
        let maxHeight = 0;
        testimonial_owl.find(".owl-item").each(function () {
            let thisHeight = jQuery(this).outerHeight(true); // include padding/margin
            if (thisHeight > maxHeight) {
                maxHeight = thisHeight;
            }
        });

        console.log("maxHeight", maxHeight);

        if (maxHeight > 0) {
            testimonial_owl.find(".owl-item").css("height", maxHeight + "px");
        }
    }

    // Call once on load
    setEqualHeight();

    // Recalculate on window resize (debounced)
    let resizeTimer;
    jQuery(window).on("resize", function () {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function () {
            // Remove any previous fixed heights before recalculating
            testimonial_owl.find(".owl-item").css("height", "");
            setEqualHeight();
        }, 200);
    });


    // run after carousel initializes
    testimonial_owl.on("initialized.owl.carousel resized.owl.carousel refreshed.owl.carousel", function () {
        setTimeout(setEqualHeight, 100); // wait for layout/images
    });


    function initializeCarousel() {
        jQuery(testimonial_owl).owlCarousel({
            loop: true,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            smartSpeed: 800,
            dots: true,
            autoplayHoverPause: false,
            nav: true,
            center: true,
            mouseDrag: false,
            touchDrag: true,
            responsive: {
                0: {
                    items: 1.49,
                    margin: 30,
                },
                768: {
                    items: window.matchMedia("(orientation: portrait)").matches
                        ? 1.6
                        : 3,

                    stagePadding: window.matchMedia("(orientation: portrait)").matches
                        ? 0
                        : 0,
                },
                1024: {
                    items: 3,
                    //                     margin: 40,
                },
            },
            onTranslated: function () {
                const centerItem = jQuery(
                    ".testimonial-carousel .owl-carousel .owl-stage .owl-item.center"
                );
                jQuery(".testimonial-carousel .owl-carousel .item").removeClass(
                    "center"
                );
                centerItem.find(".item").addClass("center");
            },
            onTranslate: function () {
                const centerItem = jQuery(
                    ".testimonial-carousel .owl-carousel .owl-stage .owl-item.center"
                );
                jQuery(".testimonial-carousel .owl-carousel .item").removeClass(
                    "center"
                );
                centerItem.find(".item").addClass("center");
            },
        });
    }
    function updateResponsiveSettings() {
        const isPortrait = window.matchMedia("(orientation: portrait)").matches;

        const newResponsive = {
            0: {
                items: 1.49,
                margin: 30,
            },
            768: {
                items: isPortrait ? 1.6 : 3,

                stagePadding: isPortrait ? 0 : 0,
            },

            1025: {
                items: 3,
                //                 margin: 40,
            },
        };

        jQuery(testimonial_owl).trigger("refresh.owl.carousel");
        jQuery(testimonial_owl).data("owl.carousel").options.responsive =
            newResponsive;
    }
    initializeCarousel();
    testimonial_owl.on("initialized.owl.carousel", function () { });
    let resizeTimeout;
    jQuery(window).on("resize", function () {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(updateResponsiveSettings, 300);
    });
    testimonial_owl.on("changed.owl.carousel", function (event) {
        jQuery(".testimonial-carousel .owl-item").removeClass("center");
        jQuery(".testimonial-carousel .owl-item")
            .eq(event.item.index)
            .addClass("center");
    });

    let testimonial_autoplayTimeout;
    testimonial_owl.on("dragged.owl.carousel", function () {
        testimonial_owl.trigger("stop.owl.autoplay");
        clearTimeout(testimonial_autoplayTimeout);
        testimonial_autoplayTimeout = setTimeout(() => {
            testimonial_owl.trigger("play.owl.autoplay", [5000]);
        }, 100);
    });
});

// who we are
const who_we_are = document.querySelector(".who-we-are-section");
const video_play_svg =
    '<g id="Play Button Electric Blue"><path id="Path 3597" d="M120 60C120 71.8668 116.481 83.4672 109.888 93.3341C103.295 103.201 93.9247 110.891 82.9612 115.433C71.9977 119.974 59.9338 121.162 48.2949 118.847C36.6561 116.532 25.9651 110.818 17.574 102.427C9.18277 94.0357 3.46825 83.3448 1.15303 71.706C-1.16219 60.0672 0.0258704 48.0032 4.56698 37.0396C9.10809 26.0761 16.7983 16.7053 26.6651 10.1123C36.5319 3.51928 48.1322 0.000187218 59.9991 0C75.912 0.000251046 91.1731 6.32174 102.425 17.5739C113.677 28.826 119.999 44.0871 119.999 60" fill="#00CCFF"></path><path class="play" id="Path 3598" d="M82.1802 60.1L49.0002 42V77.866L82.1802 60.1Z" stroke="#1A2C47" stroke-width="2" stroke-miterlimit="10"></path></g>';
const video_pause_svg =
    '<path d="M120 60C120 71.8668 116.481 83.4672 109.888 93.3341C103.295 103.201 93.9247 110.891 82.9612 115.433C71.9977 119.974 59.9338 121.162 48.2949 118.847C36.6561 116.532 25.9651 110.818 17.574 102.427C9.18277 94.0357 3.46825 83.3448 1.15303 71.706C-1.16219 60.0672 0.0258704 48.0032 4.56698 37.0396C9.10809 26.0761 16.7983 16.7053 26.6651 10.1123C36.5319 3.51928 48.1322 0.000187218 59.9991 0C75.912 0.000251046 91.1731 6.32174 102.425 17.5739C113.677 28.826 119.999 44.0871 119.999 60" fill="#00CCFF"></path><path class="pause" d="M44 42L44 78" stroke="#1A2C47" stroke-width="4" stroke-linecap="round"></path><path class="pause" d="M76 42L76 78" stroke="#1A2C47" stroke-width="4" stroke-linecap="round"></path>';
document.addEventListener("DOMContentLoaded", () => {
    const videos = who_we_are.querySelectorAll(".who-we-are-video");
    console.log("click", who_we_are);
    videos.forEach((video) => {
        const playPauseButton = video.parentNode.querySelector(".play-icon");
        playPauseButton.addEventListener("click", () => {
            event.stopPropagation();
            if (video.paused) {
                video.play();
                playPauseButton.innerHTML = video_pause_svg;
            } else {
                video.pause();
                playPauseButton.innerHTML = video_play_svg;
            }
        });
    });
});
function setTargetSection(num) {
    sessionStorage.setItem("scrollTarget", num);
}
document.addEventListener("DOMContentLoaded", function () {
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("visible");
                    observer.unobserve(entry.target); // animate only once
                }
            });
        },
        {
            threshold: 0.1,
        }
    );

    document.querySelectorAll(".fade-in-on-scroll").forEach((el) => {
        observer.observe(el);
    });
});


// Enhanced mobile animation and interaction handling
document.addEventListener("DOMContentLoaded", () => {
    const isTouchDevice = 'ontouchstart' in window || navigator.maxTouchPoints > 0;

    // Enhanced intersection observer for mobile
    const observerOptions = {
        threshold: window.innerWidth <= 768 ? 0.15 : 0.1,
        rootMargin: window.innerWidth <= 768 ? '0px 0px -50px 0px' : '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                // Add staggered animation for mobile
                const delay = window.innerWidth <= 768 ?
                    Array.from(entry.target.parentNode.children).indexOf(entry.target) * 100 : 0;

                setTimeout(() => {
                    entry.target.classList.add("visible");
                }, delay);

                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe all fade-in elements
    document.querySelectorAll(".fade-in-on-scroll").forEach((el) => {
        observer.observe(el);
    });

    // Touch-friendly hover replacement
    if (isTouchDevice) {
        document.querySelectorAll('.hover-zoom').forEach(item => {
            let touchTimer;

            item.addEventListener('touchstart', (e) => {
                touchTimer = setTimeout(() => {
                    item.classList.add('active');
                }, 100);
            }, { passive: true });

            item.addEventListener('touchend', (e) => {
                clearTimeout(touchTimer);
                setTimeout(() => {
                    item.classList.remove('active');
                }, 200);
            }, { passive: true });

            item.addEventListener('touchmove', (e) => {
                clearTimeout(touchTimer);
                item.classList.remove('active');
            }, { passive: true });
        });
    }
});

// Enhanced carousel initialization with better mobile animations
function initWhoWeAreCarousel() {
    const isMobileOrPortraitTablet =
        window.innerWidth <= 767 ||
        (window.innerWidth <= 1024 &&
            window.matchMedia("(orientation: portrait)").matches);

    const $desktopGrid = document.querySelector(".who-we-are-section .desktop-grid");
    const $mobileCarousel = document.querySelector(".owl-carousel-mobile");

    if (isMobileOrPortraitTablet && !$mobileCarousel.classList.contains("owl-loaded")) {
        const items = $desktopGrid.querySelectorAll(".item");
        $mobileCarousel.innerHTML = "";

        items.forEach((item, index) => {
            const clone = item.cloneNode(true);
            clone.classList.add('fade-in-on-scroll');
            clone.style.animationDelay = `${index * 0.1}s`;

            clone.querySelectorAll(".smaller-size.italic-text").forEach((el) => {
                el.classList.remove("smaller-size");
                el.classList.add("small-size");
            });
            $mobileCarousel.appendChild(clone);
        });

        $mobileCarousel.style.display = "block";
        $desktopGrid.style.display = "none";

        // Initialize carousel
        const owl = jQuery(".owl-carousel-mobile")
            .addClass("owl-carousel")
            .owlCarousel({
                loop: true,
                autoplay: false,
                autoplayTimeout: 4000,
                autoplayHoverPause: false,
                smartSpeed: 600,
                dots: true,
                nav: true,
                center: true,
                mouseDrag: false,
                touchDrag: true,
                responsive: {
                    0: {
                        items: 1.47,
                        margin: 32,
                    },
                    768: {
                        items: window.matchMedia("(orientation: portrait)").matches ? 1.89 : 3,
                        margin: window.matchMedia("(orientation: portrait)").matches ? 57.3 : 50,
                        stagePadding: window.matchMedia("(orientation: portrait)").matches ? 0 : 40,
                    },
                },
            });

        // CRITICAL FIX: Force refresh on Safari iOS
        setTimeout(function () {
            owl.trigger('refresh.owl.carousel');
        }, 100);

        // CRITICAL FIX: Force recalculation on iOS after images load
        if (/iPhone|iPad|iPod/.test(navigator.userAgent)) {
            setTimeout(function () {
                owl.trigger('refresh.owl.carousel');
            }, 500);
        }
    }
}


document.addEventListener("DOMContentLoaded", () => {
    initWhoWeAreCarousel();
    window.addEventListener("resize", () => {
        clearTimeout(window.carouselResizeTimeout);
        window.carouselResizeTimeout = setTimeout(initWhoWeAreCarousel, 200);
    });
});

// Innovation section JS
document.addEventListener("DOMContentLoaded", function () {
    // State
    let resizeTimeout;
    let isCarouselInitialized = false;
    let currentMode = getMode(); // 'desktop' | 'mobilePortrait'

    // Elements
    const mainCard = document.querySelector(".innovation-section .main-card");
    const mainTitle = document.querySelector(
        ".innovation-section .main-card-title"
    );
    const mainContent = document.querySelector(
        ".innovation-section .main-card-content"
    );
    const cardsDesktop = document.querySelectorAll(
        ".innovation-section .desktop-screen .card-section .item"
    );
    const cardsSmall = document.querySelectorAll(
        ".innovation-section .small-screen .small-cards .card"
    );

    // Init on load
    hydrateCardsFromDataset(); // set bg/title/desc into DOM nodes
    applyBreakpointMode(true); // run initial mode setup

    // Resize handling with debounce
    window.addEventListener("resize", () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            const newMode = getMode();
            if (newMode !== currentMode) {
                currentMode = newMode;
                applyBreakpointMode(false); // re-apply mode (teardown + init)
            } else {
                // Same mode: still ensure carousel layout adjustments are fine
                if (currentMode === "mobilePortrait") ensureCarouselInitialized();
            }
        }, 150);
    });

    // ------------------------
    // Core functions
    // ------------------------

    function getMode() {
        const isMobileOrTabletPortrait =
            window.innerWidth <= 767 ||
            window.matchMedia(
                "(min-width: 768px) and (max-width: 1024px) and (orientation: portrait)"
            ).matches;
        return isMobileOrTabletPortrait ? "mobilePortrait" : "desktop";
    }

    function applyBreakpointMode(firstLoad) {
        if (currentMode === "desktop") {
            teardownCarouselIfExists(); // remove owl and clones
            resetMobileInlineHiding(); // remove display:none set on mobile items
            setDesktopActiveDefault(); // set last desktop card active
            showDesktopDescriptions(); // desktop overlay logic controls visibility
            // Ensure desktop-only containers are displayed according to CSS
        } else {
            // mobile & tablet portrait
            clearDesktopActiveClasses(); // remove lingering 'active' from desktop items
            ensureCarouselInitialized(); // init owl and wire events
            hideCarouselDescriptions(); // ensure only titles show in carousel items
            setMainFromCenterCard(); // set main card from center item
        }

        // Optional: force reflow to clear any browser caching of layout
        if (!firstLoad) {
            forceSectionReflow();
        }
    }
    document.querySelectorAll(".innovation-section .card").forEach((card) => {
        let isClickLocked = false;
        card.addEventListener("click", () => {
            if (isClickLocked) return; // prevent rapid double clicks

            isClickLocked = true;
            setTimeout(() => (isClickLocked = false), 500); // adjust duration as needed

            const mainBg = mainCard.style.backgroundImage;
            const mainTitleText = mainTitle.textContent;
            const mainDescText = mainContent.innerHTML;
            const cardBg = card.dataset.bg;
            const cardTitle = card.dataset.title;
            const cardDesc = card.dataset.desc;

            card.classList.add("clicked");
            mainCard.classList.add("clicked");
            setTimeout(() => {
                card.classList.remove("clicked");
                mainCard.classList.remove("clicked");

                card.classList.add("clicked-back");
                mainCard.classList.add("clicked-back");
                setTimeout(() => {
                    card.classList.remove("clicked-back");
                    mainCard.classList.remove("clicked-back");
                }, 300);
            }, 200);
        });
    });
    function hydrateCardsFromDataset() {
        document.querySelectorAll(".innovation-section .card").forEach((card) => {
            const title = card.dataset.title || "";
            const desc = card.dataset.desc || "";
            const bg = card.dataset.bg || "";

            // Preserve original values in dataset (once)
            if (!card.dataset.originalTitle) {
                card.dataset.originalTitle = title;
                card.dataset.originalDesc = desc;
                card.dataset.originalBg = bg;
            }

            // Apply background and text
            if (bg) card.style.backgroundImage = `url(${bg})`;
            const titleEl = card.querySelector(".card-title");
            const descEl = card.querySelector(".card-description");
            if (titleEl) titleEl.textContent = title;
            if (descEl) descEl.innerHTML = desc;
        });
    }

    // ------------------------
    // Desktop behaviors
    // ------------------------

    function setDesktopActiveDefault() {
        const allDesktop = Array.from(cardsDesktop);
        if (allDesktop.length) {
            clearDesktopActiveClasses();
            allDesktop[allDesktop.length - 1].classList.add("active");
        }
        // Hover to activate
        attachDesktopHover();
    }

    function attachDesktopHover() {
        const allCards = [...cardsDesktop, ...cardsSmall];
        // Remove previous listeners by cloning nodes (simple way)
        allCards.forEach((card) => {
            const cloned = card.cloneNode(true);
            card.parentNode.replaceChild(cloned, card);
        });
        const freshDesktopCards = document.querySelectorAll(
            ".innovation-section .desktop-screen .card-section .item"
        );
        const freshAllCards = [...freshDesktopCards];

        freshAllCards.forEach((card) => {
            card.addEventListener("mouseenter", () => {
                if (currentMode === "desktop") {
                    clearDesktopActiveClasses();
                    card.classList.add("active");
                }
            });
        });
    }

    function clearDesktopActiveClasses() {
        document
            .querySelectorAll(".innovation-section .card.active")
            .forEach((c) => c.classList.remove("active"));
    }

    function showDesktopDescriptions() {
        // Desktop overlay logic decides when to show/hide; ensure no mobile inline styles remain
        document
            .querySelectorAll(".small-screen .small-cards .card .card-description")
            .forEach((el) => {
                el.style.removeProperty("display");
            });
    }

    // ------------------------
    // Mobile/Tablet portrait behaviors
    // ------------------------

    function ensureCarouselInitialized() {
        const carousel = jQuery(".innovation-section .small-cards");
        if (!isCarouselInitialized) {
            isCarouselInitialized = true;

            carousel.addClass("owl-carousel").owlCarousel({
                center: true,
                loop: true,
                nav: true,
                autoplay: false,
                dots: true,
                responsive: {
                    0: { items: 1.43, margin: 20 },
                    768: { items: 2.25, margin: 24 },
                },
            });

            // Apply custom dot colors after carousel initialization
            setTimeout(() => {
                const carouselElement = carousel[0];
                if (carouselElement) {
                    applyInnovationDotColors(carouselElement);
                }
            }, 300);

            // Click to navigate left/right
            carousel.on("click", ".owl-item", function (event) {
                const clickedItem = event.currentTarget;
                const owlItems = carousel.find(".owl-item").toArray();
                const centerItem = carousel.find(".owl-item.center")[0];
                const clickedIndex = owlItems.indexOf(clickedItem);
                const centerIndex = owlItems.indexOf(centerItem);
                if (clickedIndex > centerIndex) {
                    carousel.trigger("next.owl.carousel");
                } else if (clickedIndex < centerIndex) {
                    carousel.trigger("prev.owl.carousel");
                }
            });

            // Update main card when carousel changes
            carousel.on("changed.owl.carousel", function () {
                setTimeout(setMainFromCenterCard, 50);

                // Reapply dot colors after carousel changes
                setTimeout(() => {
                    const carouselElement = carousel[0];
                    if (carouselElement) {
                        applyInnovationDotColors(carouselElement);
                    }
                }, 100);
            });

            // Initial sync
            setTimeout(setMainFromCenterCard, 100);
        }
    }
    // Function to apply custom dot colors to innovation carousel
    function applyInnovationDotColors(carouselElement) {
        console.log('Applying innovation carousel dot colors');

        // Try using global CarouselUtils first
        if (window.CarouselUtils && window.CarouselUtils.applyCustomDotColor) {
            const success = window.CarouselUtils.applyCustomDotColor(carouselElement, '#00ccff', {
                mobileOnly: false // Always apply since this carousel only exists in mobile
            });

            if (success) {
                console.log('Applied innovation dot colors via CarouselUtils');
                return;
            }
        }

        // Fallback: Apply colors manually
        console.log('Applying innovation dot colors manually');

        function applyColors() {
            const dots = carouselElement.querySelectorAll('.owl-dot');

            dots.forEach(dot => {
                // Remove any existing styles first
                dot.style.removeProperty('background');
                dot.style.removeProperty('background-color');
                dot.style.removeProperty('border');
                dot.style.removeProperty('border-color');

                // Apply new styles with high specificity
                if (dot.classList.contains('active')) {
                    dot.style.setProperty('background-color', '#00ccff', 'important');
                    dot.style.setProperty('border', '2px solid #00ccff', 'important');
                } else {
                    dot.style.setProperty('background-color', 'transparent', 'important');
                    dot.style.setProperty('border', '2px solid rgba(0, 204, 255, 0.4)', 'important');
                }

                // Base styling to ensure consistency
                dot.style.setProperty('width', '12px', 'important');
                dot.style.setProperty('height', '12px', 'important');
                dot.style.setProperty('border-radius', '50%', 'important');
                dot.style.setProperty('margin', '0 4px', 'important');
                dot.style.setProperty('cursor', 'pointer', 'important');
                dot.style.setProperty('outline', 'none', 'important');
                dot.style.setProperty('box-shadow', 'none', 'important');
                dot.style.setProperty('-webkit-appearance', 'none', 'important');
                dot.style.setProperty('appearance', 'none', 'important');
            });
        }

        // Retry mechanism for dot application
        let attempts = 0;
        const maxAttempts = 15;

        function tryApplyColors() {
            const dots = carouselElement.querySelectorAll('.owl-dot');

            if (dots.length > 0) {
                applyColors();

                // Set up event listeners for carousel changes
                const $carousel = jQuery(carouselElement);
                $carousel.on('changed.owl.carousel.innovationManual translated.owl.carousel.innovationManual', applyColors);

                // Handle dot clicks with immediate reapplication
                carouselElement.addEventListener('click', function (e) {
                    if (e.target.closest('.owl-dot')) {
                        applyColors();
                        setTimeout(applyColors, 1);
                        setTimeout(applyColors, 10);
                        setTimeout(applyColors, 50);
                        setTimeout(applyColors, 100);
                    }
                });

                console.log('Innovation dot colors applied successfully to', dots.length, 'dots');
            } else if (attempts < maxAttempts) {
                attempts++;
                setTimeout(tryApplyColors, 200);
            } else {
                console.warn('Failed to apply innovation dot colors after', maxAttempts, 'attempts');
            }
        }

        tryApplyColors();
    }



    function teardownCarouselIfExists() {
        const carousel = jQuery(".innovation-section .small-cards");
        if (isCarouselInitialized) {
            isCarouselInitialized = false;

            // Clean up carousel color utilities
            const carouselElement = carousel[0];
            if (carouselElement) {
                // Remove CarouselUtils colors if they exist
                if (window.CarouselUtils && window.CarouselUtils.removeCustomDotColor) {
                    window.CarouselUtils.removeCustomDotColor(carouselElement);
                }

                // Remove manual event listeners
                const $carousel = jQuery(carouselElement);
                $carousel.off('changed.owl.carousel.innovationManual');
                $carousel.off('translated.owl.carousel.innovationManual');

                // Remove dot styles
                const dots = carouselElement.querySelectorAll('.owl-dot');
                dots.forEach(dot => {
                    dot.style.removeProperty('background-color');
                    dot.style.removeProperty('border');
                    dot.style.removeProperty('width');
                    dot.style.removeProperty('height');
                    dot.style.removeProperty('border-radius');
                    dot.style.removeProperty('margin');
                });
            }

            try {
                carousel.trigger("destroy.owl.carousel");
            } catch (e) {
                /* ignore if already destroyed */
            }
            carousel.removeClass("owl-carousel owl-loaded");

            // Remove owl-generated markup if any remains
            const stageOuter = document.querySelector(".innovation-section .small-cards .owl-stage-outer");
            if (stageOuter) {
                const parent = stageOuter.parentNode;
                const items = stageOuter.querySelectorAll(".owl-item .card");
                // Rebuild plain structure with cards only
                const frag = document.createDocumentFragment();
                items.forEach((it) => {
                    // Use original card nodes (not clones) if present
                    const card = it.querySelector(".card");
                    if (card) frag.appendChild(card);
                });
                parent.innerHTML = "";
                parent.appendChild(frag);
            }

            const extraDiv = document.querySelector(".innovation-section .carousel-controls");
            if (extraDiv) extraDiv.remove();
        }
    }


    function hideCarouselDescriptions() {
        // Hide desc inside small-cards items (carousel slides)
        document
            .querySelectorAll(".innovation-section .small-screen .small-cards .card .card-description")
            .forEach((el) => {
                el.style.display = "none";
            });
    }

    function resetMobileInlineHiding() {
        // Remove inline display:none added for mobile so desktop CSS can manage visibility
        document
            .querySelectorAll(".innovation-section .small-screen .small-cards .card .card-description")
            .forEach((el) => {
                el.style.removeProperty("display");
            });
    }

    function setMainFromCenterCard() {
        const centerCard = document.querySelector(
            ".innovation-section .owl-item.center .card"
        );
        // Fallback if owl not yet ready: use first small card
        const sourceCard =
            centerCard ||
            document.querySelector(
                ".innovation-section .small-screen .small-cards .card"
            );
        if (sourceCard && mainCard && mainTitle && mainContent) {
            const bg = sourceCard.dataset.bg || "";
            const title = sourceCard.dataset.title || "";
            const desc = sourceCard.dataset.desc || "";
            if (bg) mainCard.style.backgroundImage = `url(${bg})`;
            mainTitle.textContent = title;
            mainContent.innerHTML = desc;
        }
    }

    // ------------------------
    // Utilities
    // ------------------------

    function forceSectionReflow() {
        const section = document.querySelector(".innovation-section");
        if (!section) return;
        section.classList.add("reflow-flag");
        // Trigger reflow
        void section.offsetHeight;
        section.classList.remove("reflow-flag");
    }
});

// all spacers
// vimeo popup
jQuery(document).ready(function ($) {
    // Open the modal and load the Vimeo video when a play-video-button is clicked
    $(".play-video-button").on("click", function (e) {
        e.preventDefault(); // Prevent default button behavior

        // Get the Vimeo URL from the button
        var vimeoUrl = $(this).attr("data-vimeo-url"); // Get the Vimeo URL from the data attribute

        // Check if the vimeoUrl is valid (optional validation)
        if (vimeoUrl && vimeoUrl.trim() !== "") {
            // Ensure autoplay is enabled by adding autoplay=1 to the URL
            var autoplayUrl =
                vimeoUrl + (vimeoUrl.includes("?") ? "&" : "?") + "autoplay=1";

            // Add the Vimeo video iframe to the modal container
            $("#vimeo-video-container").html(
                '<iframe src="' +
                autoplayUrl +
                '" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>'
            );

            // Show the modal and set it to display flex
            $("#vimeo-video-modal").css("display", "flex");
        } else {
            console.log("Vimeo URL not available.");
        }
    });

    // Close the modal when the close button is clicked
    $("#close-modal").on("click", function () {
        // Hide the modal and remove the iframe
        $("#vimeo-video-modal").fadeOut();
        $("#vimeo-video-container").html("");
    });

    // Close the modal if the user clicks outside the modal content
    $("#vimeo-video-modal").on("click", function (e) {
        if (e.target == this) {
            $("#vimeo-video-modal").fadeOut();
            $("#vimeo-video-container").html("");
        }
    });
});

// Highlights Section

//   jQuery(document).ready(function ($) {
//     const mainCard = document.querySelector(".latest-news-section .main-card");
//     const mainTitle = document.querySelector(".latest-news-section .main-card-title");
//     const mainContent = document.querySelector(".latest-news-section .main-card-content");
//     const mainCta = document.querySelector(".latest-news-section .main-card-cta");
//     const mainCtaText = document.querySelector(".latest-news-section .main-card-cta span");


//     document.querySelectorAll(".latest-news-section .card").forEach(card => {
//       const title = card.dataset.title;
//       const desc = card.dataset.desc;
//       const bg = card.dataset.bg;
//       const cta = card.dataset.cta;
//       const ctaText = card.dataset.ctaText;
//       if (!card.dataset.originalTitle) {
//         card.dataset.originalTitle = title;
//         card.dataset.originalDesc = desc;
//         card.dataset.originalBg = bg;
//         card.dataset.originalCta = cta;
//         card.dataset.originalCtaText = ctaText;
//       }
//       card.style.backgroundImage = `url(${bg})`;
//       card.querySelector('.card-title').textContent = title;
//       card.querySelector('.card-description').innerHTML = desc;

//       const cardCta = card.querySelector('.card-cta');
//       if (cardCta) {
//         cardCta.href = cta;
//         const span = cardCta.querySelector('span');
//         if (span) span.textContent = ctaText;
//       }


//       let isClickLocked = false;
//       card.addEventListener("click", () => {
//         if (isClickLocked) return; // prevent rapid double clicks

//         isClickLocked = true;
//         setTimeout(() => isClickLocked = false, 500); // adjust duration as needed

//         const mainBg = mainCard.style.backgroundImage;
//         const mainTitleText = mainTitle.textContent;
//         const mainDescText = mainContent.innerHTML;
//         const cardBg = card.dataset.bg;
//         const cardTitle = card.dataset.title;
//         const cardDesc = card.dataset.desc;

//         card.classList.add("clicked");
//         mainCard.classList.add("clicked");
//         setTimeout(() => {
//           card.classList.remove("clicked");
//           mainCard.classList.remove("clicked");

//           card.classList.add("clicked-back");
//           mainCard.classList.add("clicked-back");
//           setTimeout(() => {
//             card.classList.remove("clicked-back");
//             mainCard.classList.remove("clicked-back");
//           }, 300);
//         }, 200);


//       });
//     });
//     const cards = Array.from(document.querySelectorAll(".latest-news-section .card"));
//     const lastCard = cards.at(-1);
//     if (lastCard) {
//       mainCard.style.backgroundImage = `url(${lastCard.dataset.bg})`;
//       mainTitle.textContent = lastCard.dataset.title;
//       mainContent.innerHTML = lastCard.dataset.desc;
//     }
//     let latest_news_carousel = jQuery('.latest-news-section .small-cards');


//     latest_news_carousel.owlCarousel({
//       center: true,
//       loop: true,
//       nav: true,
//       autoplay: true,
//       autoplayTimeout: 5000,
//       smartSpeed: 800,
//       autoplayHoverPause: true,
//       responsive: {
//         0: {
//           items: 1.43,
//           margin: 20,
//           dots: true,
//         },
//         768: {
//           items: window.matchMedia("(min-width: 768px) and (max-width: 1024px) and (orientation: portrait)").matches ? 2.25 : 3.6,
//           margin: window.matchMedia("(min-width: 768px) and (max-width: 1024px) and (orientation: portrait)").matches ? 24 : 8,
//           dots: true,
//         },
//         1025: {
//           items: 4.65,
//           margin: 8,
//           dots: false,
//         }
//       }
//     });

//     function updateLatestNewsCarouselResponsive() {
//       const newResponsive = {
//         0: {
//           items: 1.43,
//           margin: 20,
//           dots: true,
//         },
//         768: {
//           items: window.matchMedia("(min-width: 768px) and (max-width: 1024px) and (orientation: portrait)").matches ? 2.25 : 3.6,
//           margin: window.matchMedia("(min-width: 768px) and (max-width: 1024px) and (orientation: portrait)").matches ? 24 : 8,
//           dots: true,

//         },
//         1025: {
//           items: 4.65,
//           margin: 8,
//           dots: false,
//         }
//       };

//       latest_news_carousel.data("owl.carousel").options.responsive =
//         newResponsive;
//       latest_news_carousel.trigger("refresh.owl.carousel");

//     }

//     let resizeTimeout;
//     jQuery(window).on("resize  orientationchange", function () {
//       clearTimeout(resizeTimeout);
//       resizeTimeout = setTimeout(updateLatestNewsCarouselResponsive, 300); // Debounced resizing
//     });


//     latest_news_carousel.on('click', '.owl-item', function (event) {
//       const clickedItem = event.currentTarget;
//       const owlItems = latest_news_carousel.find('.owl-item').toArray();
//       const centerItem = latest_news_carousel.find('.owl-item.center')[0];

//       const clickedIndex = owlItems.indexOf(clickedItem);
//       const centerIndex = owlItems.indexOf(centerItem);

//       if (clickedIndex > centerIndex) {
//         latest_news_carousel.trigger('next.owl.carousel');
//       } else if (clickedIndex < centerIndex) {
//         latest_news_carousel.trigger('prev.owl.carousel');
//       }
//     });
//     latest_news_carousel.on('changed.owl.carousel', function (event) {



//       setTimeout(() => {
//         const centerCard = document.querySelector('.latest-news-section .owl-item.center .card');
//         if (centerCard) {
//           const title = centerCard.dataset.title;
//           const desc = centerCard.dataset.desc;
//           const bg = centerCard.dataset.bg;
//           const cta = centerCard.dataset.cta;
//           const ctaText = centerCard.dataset.ctaText;

//           mainCard.classList.remove("fade-in");
//           mainCard.classList.add("fade-out");

//           setTimeout(() => {
//             mainCard.style.backgroundImage = `url(${bg})`;
//             mainTitle.textContent = title;
//             mainContent.innerHTML = desc;
//             // if (cta) mainCta.href = cta;
//             // if (ctaText) mainCtaText.textContent = ctaText;
//             if (cta && ctaText) {
//               mainCta.href = cta;
//               mainCtaText.textContent = ctaText;
//               mainCta.style.display = "inline-block"; // show if valid
//             } else {
//               mainCta.style.display = "none"; // hide if missing
//             }


//             mainCard.classList.remove("fade-out");
//             mainCard.classList.add("fade-in");
//           }, 200);
//         }
//       }, 50);
//     });



//     setTimeout(() => {
//       const centerCard = document.querySelector('.latest-news-section .owl-item.center .card');
//       if (centerCard) {
//         const title = centerCard.dataset.title;
//         const desc = centerCard.dataset.desc;
//         const bg = centerCard.dataset.bg;
//         const cta = centerCard.dataset.cta;
//         const ctaText = centerCard.dataset.ctaText;

//         mainCard.style.backgroundImage = `url(${bg})`;
//         mainTitle.textContent = title;
//         mainContent.innerHTML = desc;
//         if (cta && ctaText) {
//           mainCta.href = cta;
//           mainCtaText.textContent = ctaText;
//           mainCta.style.display = "inline-block";
//         } else {
//           mainCta.style.display = "none";
//         }


//       }
//     }, 100);

//   });
// Highlights Section
jQuery(document).ready(function ($) {
    const mainCard = document.querySelector(".latest-news-section .main-card");
    const mainTitle = document.querySelector(".latest-news-section .main-card-title");
    const mainContent = document.querySelector(".latest-news-section .main-card-content");
    const mainCta = document.querySelector(".latest-news-section .main-card-cta");
    const mainCtaText = document.querySelector(".latest-news-section .main-card-cta span");

    // STEP 1: set up each card's data (keep this)
    document.querySelectorAll(".latest-news-section .card").forEach(card => {
        const title = card.dataset.title;
        const desc = card.dataset.desc;
        const bg = card.dataset.bg;
        const cta = card.dataset.cta;
        const ctaText = card.dataset.ctaText;

        if (!card.dataset.originalTitle) {
            card.dataset.originalTitle = title;
            card.dataset.originalDesc = desc;
            card.dataset.originalBg = bg;
            card.dataset.originalCta = cta;
            card.dataset.originalCtaText = ctaText;
        }

        card.style.backgroundImage = `url(${bg})`;
        card.querySelector('.card-title').textContent = title;
        card.querySelector('.card-description').innerHTML = desc;

        const cardCta = card.querySelector('.card-cta');
        if (cardCta) {
            cardCta.href = cta;
            const span = cardCta.querySelector('span');
            if (span) span.textContent = ctaText;
        }
    });

    // STEP 2: initialize the carousel
    const latest_news_carousel = jQuery('.latest-news-section .small-cards');

    latest_news_carousel.owlCarousel({
        center: true,
        loop: true,
        nav: true,
        autoplay: true,
        autoplayTimeout: 5000,
        smartSpeed: 800,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1.43,
                margin: 20,
                dots: true,
            },
            768: {
                items: window.matchMedia("(min-width: 768px) and (max-width: 1024px) and (orientation: portrait)").matches ? 2.25 : 3.6,
                margin: window.matchMedia("(min-width: 768px) and (max-width: 1024px) and (orientation: portrait)").matches ? 24 : 8,
                dots: true,
            },
            1025: {
                items: 4.65,
                margin: 8,
                dots: false,
            }
        }
    });

    // ✅ STEP 3: delegated click handler (now after carousel init)
    latest_news_carousel.on("click", ".card", function () {
        const card = this;
        if (card.classList.contains("clicked")) return;

        card.classList.add("clicked");
        mainCard.classList.add("clicked");

        setTimeout(() => {
            card.classList.remove("clicked");
            mainCard.classList.remove("clicked");

            card.classList.add("clicked-back");
            mainCard.classList.add("clicked-back");

            setTimeout(() => {
                card.classList.remove("clicked-back");
                mainCard.classList.remove("clicked-back");
            }, 300);
        }, 200);
    });

    // STEP 4: set main card defaults
    const cards = Array.from(document.querySelectorAll(".latest-news-section .card"));
    const lastCard = cards.at(-1);
    if (lastCard) {
        mainCard.style.backgroundImage = `url(${lastCard.dataset.bg})`;
        mainTitle.textContent = lastCard.dataset.title;
        mainContent.innerHTML = lastCard.dataset.desc;
    }

    // STEP 5: responsive update logic
    function updateLatestNewsCarouselResponsive() {
        const newResponsive = {
            0: {
                items: 1.43,
                margin: 20,
                dots: true,
            },
            768: {
                items: window.matchMedia("(min-width: 768px) and (max-width: 1024px) and (orientation: portrait)").matches ? 2.25 : 3.6,
                margin: window.matchMedia("(min-width: 768px) and (max-width: 1024px) and (orientation: portrait)").matches ? 24 : 8,
                dots: true,
            },
            1025: {
                items: 4.65,
                margin: 8,
                dots: false,
            }
        };
        latest_news_carousel.data("owl.carousel").options.responsive = newResponsive;
        latest_news_carousel.trigger("refresh.owl.carousel");
    }

    let resizeTimeout;
    jQuery(window).on("resize orientationchange", function () {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(updateLatestNewsCarouselResponsive, 300);
    });

    // STEP 6: carousel click navigation
    latest_news_carousel.on('click', '.owl-item', function (event) {
        const clickedItem = event.currentTarget;
        const owlItems = latest_news_carousel.find('.owl-item').toArray();
        const centerItem = latest_news_carousel.find('.owl-item.center')[0];

        const clickedIndex = owlItems.indexOf(clickedItem);
        const centerIndex = owlItems.indexOf(centerItem);

        if (clickedIndex > centerIndex) {
            latest_news_carousel.trigger('next.owl.carousel');
        } else if (clickedIndex < centerIndex) {
            latest_news_carousel.trigger('prev.owl.carousel');
        }
    });

    // STEP 7: main card update on slide change
    latest_news_carousel.on('changed.owl.carousel', function () {
        setTimeout(() => {
            const centerCard = document.querySelector('.latest-news-section .owl-item.center .card');
            if (centerCard) {
                const { title, desc, bg, cta, ctaText } = centerCard.dataset;

                mainCard.classList.remove("fade-in");
                mainCard.classList.add("fade-out");

                setTimeout(() => {
                    mainCard.style.backgroundImage = `url(${bg})`;
                    mainTitle.textContent = title;
                    mainContent.innerHTML = desc;
                    if (cta && ctaText) {
                        mainCta.href = cta;
                        mainCtaText.textContent = ctaText;
                        mainCta.style.display = "inline-block";
                    } else {
                        mainCta.style.display = "none";
                    }
                    mainCard.classList.remove("fade-out");
                    mainCard.classList.add("fade-in");
                }, 200);
            }
        }, 50);
    });

    // STEP 8: set main card on first load
    setTimeout(() => {
        const centerCard = document.querySelector('.latest-news-section .owl-item.center .card');
        if (centerCard) {
            const { title, desc, bg, cta, ctaText } = centerCard.dataset;
            mainCard.style.backgroundImage = `url(${bg})`;
            mainTitle.textContent = title;
            mainContent.innerHTML = desc;
            if (cta && ctaText) {
                mainCta.href = cta;
                mainCtaText.textContent = ctaText;
                mainCta.style.display = "inline-block";
            } else {
                mainCta.style.display = "none";
            }
        }
    }, 100);
});
