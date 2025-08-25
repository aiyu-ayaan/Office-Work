// banner
document.addEventListener("DOMContentLoaded", () => {
    const nav = document.querySelector(".service-scroll-menu");
    const heroBanner = document.querySelector(".service-banner-sub-menu-together");
    const dropdownToggle = document.querySelector(".service-menu-dropdown-toggle");
    const dropdownContainer = document.querySelector(".service-menu-dropdown-container");
    const menuItems = document.querySelectorAll(".service-scroll-list li");
    const navHeight = nav.getBoundingClientRect().height;
    let isScrolling = false;
    // Close dropdown when clicking outside
    document.addEventListener("click", (event) => {
        if (window.matchMedia("(max-width:1024px)").matches) {
            if (
                dropdownContainer.classList.contains("open") &&
                !dropdownToggle.contains(event.target) &&
                !dropdownContainer.contains(event.target)
            ) {
                dropdownContainer.classList.remove("open");
            }
        }
    });

    nav.querySelectorAll(".submenu a").forEach(function (anchor, index) {
        anchor.addEventListener("click", function (event) {
            event.preventDefault();
            if (isScrolling) return; // Ignore if already scrolling
            isScrolling = true;
            const targetId = this.getAttribute("href");
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                const header = document.querySelector("nav.service-scroll-menu"); // Adjust selector
                const headerHeight = header ? header.offsetHeight : 0;
                // const targetPosition = targetElement.getBoundingClientRect().top + window.scrollY ; 
                const targetOffset = targetElement.getBoundingClientRect().top + window.scrollY;
                // const atTop = window.scrollY < 5; 
                // const targetPosition = atTop ? targetOffset - headerHeight : targetOffset;
                const targetPosition = targetOffset - headerHeight;
                smoothScrollTo(targetPosition, 800, () => {
                    isScrolling = false; // Allow new scrolls after animation
                });
            }
        });
    });

    function smoothScrollTo(targetPosition, duration, callback) {
        let startPosition = window.scrollY;
        let distance = targetPosition - startPosition;
        let startTime = null;

        function animation(currentTime) {
            if (startTime === null) startTime = currentTime;
            let elapsedTime = currentTime - startTime;
            let progress = Math.min(elapsedTime / duration, 1);
            let ease = easeInOutQuad(progress);

            window.scrollTo(0, startPosition + distance * ease);

            if (progress < 1) {
                requestAnimationFrame(animation);
            } else if (callback) {
                callback();
            }
        }

        requestAnimationFrame(animation);
    }

    function easeInOutQuad(t) {
        return t < 0.5 ? 2 * t * t : 1 - Math.pow(-2 * t + 2, 2) / 2;
    }

    window.addEventListener("scroll", () => {
        const navTop = nav.getBoundingClientRect().y;
        const heroBannerBottom = heroBanner.getBoundingClientRect().bottom;

        if (navTop < 0) {
            nav.classList.add('sticky-service-menu');
            nav.classList.remove('non-sticky-service-menu');
        } else if (heroBannerBottom >= navHeight) {
            nav.classList.add('non-sticky-service-menu');
            nav.classList.remove('sticky-service-menu');
        }
    });

    const updateDropdownState = () => {
        if (window.matchMedia("(max-width:1024px)").matches) {
            dropdownContainer.classList.remove("open");
        } else {
            dropdownContainer.classList.add("open");
        }
    };

    updateDropdownState();
    window.addEventListener("resize", updateDropdownState);

    dropdownToggle.addEventListener("click", () => {
        if (window.matchMedia("(max-width:1024px)").matches) {
            dropdownContainer.classList.toggle("open");
        }
    });

    menuItems.forEach(item => {
        item.addEventListener("click", () => {
            if (window.matchMedia("(max-width:1024px)").matches) {
                dropdownContainer.classList.remove("open");
            }
        });
    });
});
// expertise
// revolutionise
function scrollContainer(direction) {
    const container = document.getElementById('keywords-scroll-container');
    const item = container.querySelector('.item');
    const itemWidth = item.clientWidth; // Width of a single item

    const gapPercentage = parseFloat(getComputedStyle(container).gap); // Gap in percentage
    const containerWidth = container.clientWidth; // Width of the container
    const gapWidth = (gapPercentage / 100) * containerWidth; // Convert percentage to pixels

    let scrollAmount;

    if (direction === 1) {  // Clicking the "Next" button
        // If we're at the start of the container, apply the special formula
        if (container.scrollLeft === 0) {
            scrollAmount = itemWidth + gapWidth - 50;
        } else {
            scrollAmount = itemWidth + gapWidth;
        }
    } else if (direction === -1) {  // Clicking the "Prev" button
        // If we're at the end of the container (no items to the right), apply the special formula
        if (container.scrollLeft + container.clientWidth >= container.scrollWidth) {
            scrollAmount = itemWidth + gapWidth - 50;
        } else {
            scrollAmount = itemWidth + gapWidth;
        }
    }

    container.scrollBy({
        left: direction * scrollAmount,
        behavior: 'smooth'
    });

    setTimeout(checkScroll, 300); // Check visibility of buttons after scrolling
}
// To control visibility of navigation buttons based on scroll position
function checkScroll() {
    const container = document.getElementById('keywords-scroll-container');
    const prevButton = document.querySelector('.nav-button.prev');
    const nextButton = document.querySelector('.nav-button.next');

    if (container.scrollLeft <= 0) {
        prevButton.style.display = 'none';
    } else {
        prevButton.style.display = 'block';
    }

    if (container.scrollLeft + container.clientWidth >= container.scrollWidth - 1) {
        nextButton.style.display = 'none';
    } else {
        nextButton.style.display = 'block';
    }
}
document.addEventListener('DOMContentLoaded', function () {
    checkScroll();
    window.addEventListener('resize', checkScroll);

    const section = document.querySelector('.revolutionise-your-business-section');
    const items = document.querySelectorAll('.keywords-carousel-wrapper li');
    let delay = 0; // Initial delay in seconds

    // Intersection Observer to trigger animation when section enters viewport for tablet landscape and desktop
    const observer = new IntersectionObserver((entries) => {
        if (entries[0].isIntersecting) {
            // Start animation when section is visible
            items.forEach((item, index) => {
                item.style.animation = `fade-in 1.5s ${delay}s forwards cubic-bezier(0.11, 0, 0.5, 0)`;
                delay += 0.1; // Increase delay by 0.2 seconds for each item
            });
            observer.unobserve(section); // Stop observing once animation starts
        }
    }, { threshold: 0.1 }); // Trigger when 10% of the section is visible

    observer.observe(section); // Start observing the section
});

// DESCRIPTION:offerings
jQuery(document).ready(function () {
    var currentActiveItemId = 0;
    var our_offerings_owl = jQuery(".our-offerings-container .owl-carousel");
    var numItems = 0;
    function initializeOfferingsCarousel() {
        our_offerings_owl.owlCarousel({
            loop: false,
            nav: true,
            dots: false,
            items: 4,
            responsive: {
                0: {
                    items: 1.5,
                    margin: 32,
                    stagePadding: 24,
                    nav: false,
                    dots: true,
                    loop: true,
                    dotsEach: 1,
                },
                768: {
                    items: window.matchMedia("(orientation: portrait)").matches ? 2.19 : 4,
                    margin: 40,
                    stagePadding: 40,
                    nav: false,
                    dots: window.matchMedia("(orientation: portrait)").matches || numItems >= 4,
                    loop: window.matchMedia("(orientation: portrait)").matches ? true : false,
                    dotsEach: 1,
                },
                800: {
                    items: window.matchMedia("(orientation: portrait)").matches ? 2.19 : 4,
                    margin: 40,
                    stagePadding: 24,
                    nav: false,
                    dots: window.matchMedia("(orientation: portrait)").matches || numItems >= 4,
                    dotsEach: 1,
                    loop: window.matchMedia("(orientation: portrait)").matches ? true : false,
                },
                834: {
                    items: window.matchMedia("(orientation: portrait)").matches ? 2.19 : 4,
                    margin: 40,
                    stagePadding: 40,
                    nav: false,
                    dots: window.matchMedia("(orientation: portrait)").matches || numItems >= 4,
                    dotsEach: 1,
                    loop: window.matchMedia("(orientation: portrait)").matches ? true : false,
                },
                1025: {
                    mouseDrag: false,
                    touchDrag: false,
                    margin: 76,
                    stagePadding: 40,
                },
                1600: {
                    margin: 100,
                    stagePadding: 55.38,
                },
                1650: {
                    margin: 192,
                    stagePadding: 64,
                },
            }
        });
        updateActiveItem();
    }

    function updateActiveItem() {
        numItems = jQuery(".our-offerings-container .owl-carousel .owl-item:not(.cloned)").length;
        jQuery(".our-offerings-container .owl-carousel .owl-item .item").removeClass("current small-size font-bold").addClass("smaller-size");
        var newActiveItem = jQuery(".our-offerings-container .owl-carousel .owl-item.active").first().find(".item");
        newActiveItem.addClass("current small-size font-bold").removeClass("smaller-size");
        let newItemId = newActiveItem.attr("data-id");
        if (newItemId !== currentActiveItemId) {
            currentActiveItemId = newItemId;
            updateContent(newActiveItem);
        }
    }

    function updateContent(activeItem) {
        let heading = activeItem.attr("data-heading");
        let text = activeItem.attr("data-text");
        let ctaText = activeItem.attr("data-cta-text");
        let link = activeItem.attr("data-link");
        let rightHeading1 = activeItem.attr("data-right-heading1");
        let rightDesc1 = activeItem.attr("data-right-desc1");
        let rightHeading2 = activeItem.attr("data-right-heading2");
        let rightDesc2 = activeItem.attr("data-right-desc2");
        let portraitOnlyParagraph = activeItem.attr("data-portrait-only-paragraph");

        jQuery("#content-heading").text(heading);
        jQuery("#content-text").text(text);
        jQuery("#content-link").attr("href", link);
        jQuery("#content-link").find("span").text(ctaText);
        jQuery(".our-offerings-container .content-box .service-btn-solid").text(ctaText);
        jQuery(".our-offerings-container .content-box .no-text-decor").attr("href", link);
        jQuery("#right-heading1").text(rightHeading1);
        jQuery("#right-desc1").text(rightDesc1);
        jQuery("#right-heading2").text(rightHeading2);
        jQuery("#right-desc2").text(rightDesc2);
        jQuery('#portrait-only-paragraph').text(portraitOnlyParagraph);

        jQuery(".our-offerings-container .content-box").removeClass("fade-up");
        setTimeout(function () {
            jQuery(".our-offerings-container .content-box").addClass("fade-up");
        }, 300);
    }

    function updateResponsiveSettings() {
        const isPortrait = window.matchMedia("(orientation: portrait)").matches;

        const newResponsive = {
            0: {
                items: 1.5,
                margin: 32,
                stagePadding: 24,
                nav: false,
                loop: true,
                dots: true,
                dotsEach: 1,
            },
            768: {
                items: isPortrait ? 2.19 : 4,
                margin: 40,
                stagePadding: 40,
                nav: false,
                dots: window.matchMedia("(orientation: portrait)").matches || numItems >= 4,
                dotsEach: 1,
                loop: window.matchMedia("(orientation: portrait)").matches ? true : false,
            },
            800: {
                items: window.matchMedia("(orientation: portrait)").matches ? 2.19 : 4,
                margin: 40,
                stagePadding: 24,
                nav: false,
                dots: window.matchMedia("(orientation: portrait)").matches || numItems >= 4,
                dotsEach: 1,
                loop: window.matchMedia("(orientation: portrait)").matches ? true : false,
            },
            834: {
                items: window.matchMedia("(orientation: portrait)").matches ? 2.19 : 4,
                margin: 40,
                stagePadding: 40,
                nav: false,
                dots: window.matchMedia("(orientation: portrait)").matches || numItems >= 4,
                dotsEach: 1,
                loop: window.matchMedia("(orientation: portrait)").matches ? true : false,
            },
            1025: {
                mouseDrag: false,
                touchDrag: false,
                margin: 76,
                stagePadding: 40,
            },
            1600: {
                margin: 100,
                stagePadding: 55.38,
            },
            1650: {
                margin: 192,
                stagePadding: 64,
            },
        };

        jQuery(our_offerings_owl).trigger("refresh.owl.carousel");
        jQuery(our_offerings_owl).data("owl.carousel").options.responsive = newResponsive;
    }

    initializeOfferingsCarousel();

    jQuery(".our-offerings-container .owl-carousel .item").on("click", function () {
        if (jQuery(this).hasClass("current")) return;
        jQuery(".our-offerings-container .owl-carousel .item").removeClass("current small-size font-bold").addClass("smaller-size");
        jQuery(this).addClass("current small-size font-bold").removeClass("smaller-size");

        let newItemId = jQuery(this).attr("data-id");
        if (newItemId !== currentActiveItemId) {
            currentActiveItemId = newItemId;
            updateContent(jQuery(this));
        }
        var dataId = parseInt(jQuery(this).attr("data-id"), 10); // convert to number
        jQuery(".our-offerings-container .owl-dots .owl-dot").removeClass("active");
        jQuery(".our-offerings-container .owl-dots .owl-dot").eq(dataId).addClass("active");

        var $carousel = jQuery(".our-offerings-container .owl-carousel");
        var $clickedItem = jQuery(this);
        var $nonClonedItems = $carousel.find(".owl-item:not(.cloned) .item");
        var index = $nonClonedItems.index($clickedItem);

        if (index === -1) {
            // Handle cloned first item clicked (appears at the end due to loop)
            var clonedIndex = $carousel.find(".owl-item .item").index($clickedItem);

            // If it's the cloned version of the first slide
            if ($clickedItem.attr("data-id") === "0" || clonedIndex >= $nonClonedItems.length) {
                $carousel.trigger("to.owl.carousel", [0, 300, true]);
            }
        } else {
            // Regular case
            $carousel.trigger("to.owl.carousel", [index, 300, true]);
        }


    });

    our_offerings_owl.on("changed.owl.carousel", function () {
        setTimeout(updateActiveItem, 100);
    });

    let resizeTimeout;
    jQuery(window).on("resize", function () {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(updateResponsiveSettings, 300);
    });
});
document.addEventListener("DOMContentLoaded", function () {
    window.addEventListener("resize", moveNavButtons);
    setTimeout(function () {
        var our_offerings_carousel_controls = document.querySelector('.our-offerings-container .owl-carousel .carousel-controls');
        let playPauseBtn = our_offerings_carousel_controls.querySelector("#playPauseBtn");
        if (playPauseBtn) {
            playPauseBtn.remove();
        }
        moveNavButtons();
    }, 100);
    function moveNavButtons() {
        const contentBox = document.querySelector(".our-offerings-container .content-box");
        const owlNav = document.querySelector(".our-offerings-container .carousel-controls");

        if (window.innerWidth < 1025) {
            contentBox.after(owlNav);
        }
        else {
            setTimeout(function () {
                const carouselWrapper = document.querySelector(".our-offerings-container .owl-carousel");
                carouselWrapper.appendChild(owlNav);
            }, 100)
        }
    }
});

// END:strategic partner
// strategic partner
window.addEventListener("DOMContentLoaded", () => {
    const slideTrack = document.querySelector(".strategic-partners .slide-track");
    if (!slideTrack) return;
    const slides = slideTrack.querySelectorAll(".slide");

    if (!slideTrack || slides.length === 0) return;

    // Count only unique slides 
    const uniqueSlideCount = slides.length / 2;
    console.log("Unique Slide Count:", uniqueSlideCount);
    // Apply as CSS variable on the root or container
    document.documentElement.style.setProperty('--strategic-partner-logo-count', uniqueSlideCount);
});
// adrosonic benefits
document.addEventListener("DOMContentLoaded", function () {
    const benefitsData = {};

    wpDataService.left_images.forEach((image, index) => {
        benefitsData[`benefit-${index + 1}`] = {
            overlayText: wpDataService.left_image_overlay_texts[index] || "",
            // imageSrc: image.guid.replace(/\\/g, ""), // Ensuring proper URL format
            imageSrc: image,
        };
    });

    // Function to update the left box with the content dynamically (For Desktop sand Tablet Landscape)
    function updateBenefitsLeftBox(category) {
        const data = benefitsData[category];
        const leftBoxContent = document.querySelector(
            ".adro-benefits .left-box .content"
        );
        leftBoxContent.innerHTML = `
                <img class="leftBoxImage manual-lazy-load" data-src="${data.imageSrc}" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 7 5'%3E%3C/svg%3E" alt="Image" />
                <div class="medium-size leftBoxDescription">${data.overlayText}</div>
            `;
    }

    // Function to initialize or reset carousel on resize
    function initLeftBoxCarousel() {
        const isPortrait = window.matchMedia(
            "(max-width: 1024px) and (orientation: portrait)"
        ).matches;
        const isBelow767 = window.matchMedia("(max-width: 767.5px)").matches;
        let carouselContainer = jQuery(".adro-benefits .content");

        if (isPortrait || isBelow767) {
            // Populating carousel items dynamically
            let carouselItems = "";
            Object.keys(benefitsData).forEach((category) => {
                const data = benefitsData[category];
                carouselItems += `
                        <div class="carousel-item">
                            <img data-src="${data.imageSrc
                    }" class="manual-lazy-load leftBoxImage" alt="Image" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 7 5'%3E%3C/svg%3E" />
                            <div class="medium-size leftBoxDescription">${data.overlayText
                    }</div>
                           <div class="benefit small-size">${getbyAttribute(
                        category
                    )}</div> 
                        </div>
                    `;
            });

            carouselContainer.addClass("owl-carousel").owlCarousel("destroy"); // Reset carousel before adding new items
            carouselContainer.html(carouselItems);

            // Initialize the carousel
            carouselContainer.owlCarousel({
                items: 1,
                loop: true,
                margin: 16,
                nav: true,
                dots: true,
                mouseDrag: false,
                touchDrag: true,
                autoplay: true,
                autoplayHoverpause: true,
                autoplayTimeout: 5000,
                smartSpeed: 800,
                responsive: {
                    768: {
                        items: 1,
                    },
                },
            });
        } else {
            // Destroy carousel and revert to original layout for Tablet Landscape and Desktop
            carouselContainer
                .removeClass("owl-carousel owl-loaded")
                .trigger("destroy.owl.carousel");
            // Reset to original layout
            const firstItem = document.querySelector(
                ".adro-benefits .benefits-menu .li-item"
            );
            activateRightBoxMenuItem(firstItem);
            updateBenefitsLeftBox(firstItem.getAttribute("data-category"));
        }
    }

    function activateRightBoxMenuItem(element) {
        document
            .querySelectorAll(".adro-benefits .benefits-menu .li-item")
            .forEach((item) => {
                item.classList.remove("active");
                item.classList.remove("medium-size");
                item.classList.add("small-size");
            });
        element.classList.add("active");
        element.classList.add("medium-size");
        element.classList.remove("small-size");
    }

    function getbyAttribute(category) {
        const element = document.querySelector(`li[data-category="${category}"]`);
        return element ? element.innerHTML : ""; // Returns the content of the li if found
    }
    function adjustMenuOverflow() {
        const benefitsMenu = document.querySelector(
            ".adro-benefits .benefits-menu"
        );
        const listItems = benefitsMenu.querySelectorAll("li").length;

        if (listItems > 4) {
            benefitsMenu.style.overflowY = "auto";
        } else {
            benefitsMenu.style.overflowY = "hidden";
        }
    }

    // Add event listeners to menu items
    document
        .querySelectorAll(".adro-benefits .benefits-menu .li-item")
        .forEach((item) => {
            item.addEventListener("mouseenter", function () {
                const category = this.getAttribute("data-category");
                activateRightBoxMenuItem(this);
                updateBenefitsLeftBox(category);
            });
        });

    // Initial load: Set the first menu item as active and load its content
    const firstItem = document.querySelector(
        ".adro-benefits .benefits-menu .li-item"
    );
    activateRightBoxMenuItem(firstItem);
    updateBenefitsLeftBox(firstItem.getAttribute("data-category"));

    // Reinitialize carousel on window resize
    jQuery(window).resize(() => initLeftBoxCarousel());

    // Initialize the carousel on load for mobile/portrait screens
    initLeftBoxCarousel();

    //Checks if menu items are more than 4 and display a scrollbar
    adjustMenuOverflow();
});
//our approach
document.addEventListener('DOMContentLoaded', function () {

    function closeApproachPopup() {
        //         document.querySelectorAll('.popup').forEach(p => p.style.display = 'none');
        document.querySelectorAll('.popup').forEach(p => p.classList.remove('active'));
        document.querySelectorAll('.linkbtn').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.poly-box .poly').forEach(p => p.classList.remove('active'));
    }

    function checkScreenSize() {
        const isDesktop = window.matchMedia("(min-width: 1024px)").matches;
        const isTabletLandscape = window.matchMedia("(min-width: 768px) and (max-width: 1024px) and (orientation: landscape)").matches;

        if (isDesktop || isTabletLandscape) {
            const linkButtons = document.querySelectorAll('.linkbtn');
            if (linkButtons.length > 0) {
                const lastBtn = linkButtons[linkButtons.length - 1];
                const popupId = lastBtn.getAttribute('data-popup');
                const lastPopup = document.getElementById(popupId);

                if (lastBtn && lastPopup) {
                    lastBtn.classList.add('active');
                    const lastTrapezium = lastBtn.closest('.poly-box').querySelector('.poly');
                    if (lastTrapezium) lastTrapezium.classList.add('active');
                    //                     lastPopup.style.display = 'block';
                    lastPopup.classList.add('active');
                }
            }
        }
    }

    checkScreenSize();

    window.matchMedia("(min-width: 1024px)").addEventListener("change", checkScreenSize);
    window.matchMedia("(min-width: 768px) and (max-width: 1024px) and (orientation: landscape)").addEventListener("change", checkScreenSize);

    document.querySelectorAll('.linkbtn').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            document.querySelectorAll('.linkbtn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.poly-box .poly').forEach(p => p.classList.remove('active'));

            this.classList.add('active');

            const container = this.closest('.poly-box');
            if (container) {
                const trapezium = container.querySelector('.poly');
                if (trapezium) trapezium.classList.add('active');
            }

            const popupId = this.getAttribute('data-popup');
            //             document.querySelectorAll('.popup').forEach(p => p.style.display = 'none');
            document.querySelectorAll('.popup').forEach(p => p.classList.remove('active'));
            const popup = document.getElementById(popupId);
            //             if (popup) popup.style.display = 'block';
            if (popup) popup.classList.add('active');
        });
    });

    document.querySelectorAll('.icon-box').forEach(iconBox => {
        iconBox.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            const container = this.closest('.poly-box');
            if (!container) return;
            const targetLink = container.querySelector('.linkbtn');
            if (targetLink) targetLink.click();
        });
    });

    document.querySelectorAll('.popup .close').forEach(closeBtn => {
        closeBtn.addEventListener('click', function () {
            closeApproachPopup();
        });
    });

    document.addEventListener('click', function (event) {
        const approachSection = document.querySelector('.approach-section');
        if (!approachSection) return;

        const rect = approachSection.getBoundingClientRect();
        if (rect.top < window.innerHeight && rect.bottom > 0) {
            //             const openPopup = document.querySelector('.popup[style*="display: block"]');
            const openPopup = document.querySelector('.popup.active');
            if (openPopup) {
                if (!openPopup.contains(event.target) &&
                    !event.target.closest('.linkbtn, .icon-box, #cookieConsent, #cookie-banner-again')) {
                    closeApproachPopup();
                }
            }
        }
    });

});

// industries
jQuery(document).ready(function () {
    const service_specific_industries_owl = jQuery(
        ".service-specific-industries .owl-carousel"
    );

    service_specific_industries_owl.owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        mouseDrag: false,
        touchDrag: true,
        autoplayTimeout: 7000,
        autoplayHoverPause: window.innerWidth < 1024, // Dynamically set autoplayHoverPause
        nav: true,
        smartSpeed: 3500,
        dots: true,
        margin: 0,
    });

    // Listen for resize event to dynamically update autoplayHoverPause
    jQuery(window).on("resize", function () {
        let autoplayHoverPauseSetting = window.innerWidth < 1024;

        // Update autoplayHoverPause
        service_specific_industries_owl.trigger("stop.owl.autoplay"); // Stop autoplay
        service_specific_industries_owl.data(
            "owl.carousel"
        ).options.autoplayHoverPause = autoplayHoverPauseSetting;
        service_specific_industries_owl.trigger("play.owl.autoplay", [5000]); // Restart autoplay
    });

    let service_specific_industries_autoplayTimeout;

    // Pause autoplay on swipe
    service_specific_industries_owl.on("dragged.owl.carousel", function () {
        service_specific_industries_owl.trigger("stop.owl.autoplay");
        clearTimeout(service_specific_industries_autoplayTimeout);
        service_specific_industries_autoplayTimeout = setTimeout(() => {
            service_specific_industries_owl.trigger("play.owl.autoplay", [5000]);
        }, 100);
    });

    jQuery(".service-specific-industries .service-button-cta").on(
        "mouseenter",
        function () {
            service_specific_industries_owl.trigger("stop.owl.autoplay");
        }
    );

    // Resume autoplay when not hovering over "Explore more" button
    jQuery(".service-specific-industries .service-button-cta").on(
        "mouseleave",
        function () {
            service_specific_industries_owl.trigger("play.owl.autoplay", [3000]);
        }
    );
});
// business impact
document.addEventListener("DOMContentLoaded", function () {
    const circles = document.querySelectorAll(".svg-circle-wrapper"); // Get all circle wrappers

    let observedCircles = 0; // how many circles have entered the viewport

    const observer = new IntersectionObserver(
        (entries, observer) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    observedCircles++;

                    const circle = entry.target;
                    const percentage = circle.getAttribute("data-percentage"); // Get the percentage for this circle
                    const circleFg = circle.querySelector(".circle-fg");
                    const percentageValue = circle.querySelector(".percentage-value");

                    // Ensure both the elements exist before proceeding
                    if (circleFg && percentageValue) {
                        const offset = 728 - (percentage / 100) * 728; // Circumference of circle is 728

                        circleFg.style.transition = "stroke-dashoffset 5s ease";
                        circleFg.style.strokeDashoffset = offset;

                        // Update the percentage text in the center of the circle
                        percentageValue.textContent = `${percentage}%`;
                    }

                    // If both circles are in view, stop observing and trigger animation for both
                    if (observedCircles === circles.length) {
                        observer.disconnect(); // Disconnect the observer once both circles have entered the viewport
                    }
                }
            });
        },
        { threshold: 0.5 }
    ); // Trigger when at least 50% of each circle is in the viewport

    // Start observing both circles
    circles.forEach((circle) => {
        observer.observe(circle);
    });
});
// testimonials
const service_our_clients_owl = jQuery(".service-our-clients-section .owl-carousel");
jQuery(document).ready(function () {

    service_our_clients_owl.owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        mouseDrag: false,
        touchDrag: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        nav: true,
        smartSpeed: 800,
        dots: true,
        margin: 20
    });
});
let service_our_clients_autoplayTimeout;
// Pause autoplay on swipe
service_our_clients_owl.on("dragged.owl.carousel", function () {
    service_our_clients_owl.trigger("stop.owl.autoplay");
    clearTimeout(service_our_clients_autoplayTimeout);
    service_our_clients_autoplayTimeout = setTimeout(() => {
        owl.trigger("play.owl.autoplay", [5000]);
    }, 100);
});
function updateClassForPortraitView() {
    const left_desc = document.querySelectorAll(".service-our-clients-section .left-box .left-desc,.service-our-clients-section .left-box .author-line");
    left_desc.forEach(item => {
        if (window.matchMedia("(orientation:portrait)").matches) {
            item.classList.add("small-size");
            item.classList.remove("smaller-size");
        } else {
            item.classList.remove("small-size");
            item.classList.add("smaller-size");
        }
    })

}

window.addEventListener("load", updateClassForPortraitView);
window.addEventListener("resize", updateClassForPortraitView);
// QnA
document.addEventListener("DOMContentLoaded", function () {
    const faqContainer = document.querySelector(".faq-container");
    const faqs = document.querySelectorAll(".faq");
    faqs.forEach((faq) => {
        faq.addEventListener("click", function () {
            faqs.forEach((item) => {
                if (item !== faq) {
                    item.classList.remove("open");
                    item.querySelector('.faq-question').classList.add('small-size')
                    item.querySelector('.faq-question').classList.remove('medium-size')
                }
            });
            faq.classList.toggle("open");
            faq.querySelector('.faq-question').classList.toggle('small-size')
            faq.querySelector('.faq-question').classList.toggle('medium-size')
        });
    });
});