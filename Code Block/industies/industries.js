// DESCRIPTION:banner section + submenu
document.addEventListener("DOMContentLoaded", () => {
    const nav = document.querySelector(".service-scroll-menu");
    const heroBanner = document.querySelector(".service-banner-sub-menu-together");
    const dropdownToggle = document.querySelector(".service-menu-dropdown-toggle");
    const dropdownContainer = document.querySelector(".service-menu-dropdown-container");
    const menuItems = document.querySelectorAll(".service-scroll-list li");
    const navHeight = nav.getBoundingClientRect().height;
    let isScrolling = false;
    document.addEventListener("click", (event) => {
        if (window.matchMedia("(max-width:1024px)").matches) {
            if (
                dropdownContainer.classList.contains("open") &&
                !dropdownToggle.contains(event.target) &&
                !dropdownContainer.contains(event.target)
            ) {
                dropdownContainer.classList.remove("open");
            }
            updateJumpBarColor();
        }
    });

    nav.querySelectorAll(".submenu a").forEach(function (anchor) {
        anchor.addEventListener("click", function (event) {
            event.preventDefault();
            if (isScrolling) return;
            isScrolling = true;
            const targetId = this.getAttribute("href");
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                const targetPosition = targetElement.getBoundingClientRect().top + window.scrollY - nav.offsetHeight;

                smoothScrollTo(targetPosition, 800, () => {
                    isScrolling = false;
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
            nav.parentElement.style.paddingTop = `${nav.offsetHeight}px`;
        } else if (heroBannerBottom >= navHeight) {
            nav.classList.add('non-sticky-service-menu');
            nav.classList.remove('sticky-service-menu');
            nav.parentElement.style.paddingTop = "0";
        }
        updateJumpBarColor();
    });
    const updateJumpBarColor = () => {
        if (window.innerWidth <= 1024) {
            if (dropdownContainer.classList.contains("open") || nav.classList.contains("sticky-service-menu")) {
                nav.style.background = "var(--adro-blue)";
            } else {
                nav.style.background = "linear-gradient(0deg, #1B4466 0%, #1B4466 100%)";
            }
        } else {
            if (nav.classList.contains("sticky-service-menu")) {
                nav.style.background = "#1B476A";
            } else {
                nav.style.background = "rgb(0,0,0,0)";
            }
        }
    }
    const updateDropdownState = () => {
        if (window.matchMedia("(max-width:1024px)").matches) {
            dropdownContainer.classList.remove("open");
        } else {
            dropdownContainer.classList.add("open");
        }
        updateJumpBarColor();
    };

    updateDropdownState();
    window.addEventListener("resize", updateDropdownState);

    dropdownToggle.addEventListener("click", () => {
        if (window.matchMedia("(max-width:1024px)").matches) {
            dropdownContainer.classList.toggle("open");
            updateJumpBarColor();
        }
    });

    menuItems.forEach(item => {
        item.addEventListener("click", () => {
            if (window.matchMedia("(max-width:1024px)").matches) {
                dropdownContainer.classList.remove("open");
            }
            updateJumpBarColor();
        });
    });
});
// DESCRIPTION:Our Capabilities
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
              <img class="leftBoxImage" src="${data.imageSrc}" alt="Image" />
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
                          <img src="${data.imageSrc
                    }" class="leftBoxImage" alt="Image" />
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

// DESCRIPTION:Business Impact
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

// DESCRIPTION:Our Offerings
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

    jQuery(".our-offerings-container .owl-carousel").on("click", ".item", function () {
        if (jQuery(this).hasClass("current")) return;

        jQuery(".our-offerings-container .owl-carousel .item")
            .removeClass("current small-size font-bold")
            .addClass("smaller-size");

        jQuery(this).addClass("current small-size font-bold").removeClass("smaller-size");

        let newItemId = jQuery(this).attr("data-id");
        if (newItemId !== currentActiveItemId) {
            currentActiveItemId = newItemId;
            updateContent(jQuery(this));
        }

        var dataId = parseInt(jQuery(this).attr("data-id"), 10);
        jQuery(".our-offerings-container .owl-dots .owl-dot").removeClass("active");
        jQuery(".our-offerings-container .owl-dots .owl-dot").eq(dataId).addClass("active");

        var $carousel = jQuery(".our-offerings-container .owl-carousel");
        var $clickedItem = jQuery(this);
        var $nonClonedItems = $carousel.find(".owl-item:not(.cloned) .item");
        var index = $nonClonedItems.index($clickedItem);

        if (index === -1) {
            var clonedIndex = $carousel.find(".owl-item .item").index($clickedItem);
            if ($clickedItem.attr("data-id") === "0" || clonedIndex >= $nonClonedItems.length) {
                $carousel.trigger("to.owl.carousel", [0, 300, true]);
            }
        } else {
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

// DESCRIPTION:our clients testimonial
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
