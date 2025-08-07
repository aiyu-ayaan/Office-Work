//  DESCRIPTION:banner section + submenu
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
            if (dropdownContainer.classList.contains("open") && !dropdownToggle.contains(event.target) && !dropdownContainer.contains(event.target)) {
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
            }

            else if (callback) {
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

            nav.parentElement.style.paddingTop = `$ {
                        nav.offsetHeight
                    }

                    px`;
        }

        else if (heroBannerBottom >= navHeight) {
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
            }

            else {
                nav.style.background = "linear-gradient(0deg, #1B4466 0%, #1B4466 100%)";
            }
        }

        else {
            if (nav.classList.contains("sticky-service-menu")) {
                nav.style.background = "#1B476A";
            }

            else {
                nav.style.background = "rgb(0,0,0,0)";
            }
        }
    }

    const updateDropdownState = () => {
        if (window.matchMedia("(max-width:1024px)").matches) {
            dropdownContainer.classList.remove("open");
        }

        else {
            dropdownContainer.classList.add("open");
        }

        updateJumpBarColor();
    }

        ;

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

// DESCRIPTION:life at adrosonic section

document.addEventListener('DOMContentLoaded', function () {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target); // animate only once
            }
        });
    }, {
        threshold: 0.1
    });

    document.querySelectorAll('.fade-in-on-scroll').forEach(el => {
        observer.observe(el);
    });
});
function initWhoWeAreCarousel() {
    const isMobileOrPortraitTablet = window.innerWidth <= 767 ||
        (window.innerWidth <= 1024 && window.matchMedia("(orientation: portrait)").matches);

    const $desktopGrid = document.querySelector('.who-we-are .desktop-grid');
    const $mobileCarousel = document.querySelector('.owl-carousel-mobile');

    if (isMobileOrPortraitTablet && !$mobileCarousel.classList.contains('owl-loaded')) {
        // Clone all .item elements from all columns
        const items = $desktopGrid.querySelectorAll('.item');
        $mobileCarousel.innerHTML = ''; // clear
        items.forEach(item => {
            const clone = item.cloneNode(true);
            clone.querySelectorAll('.smaller-size.italic-text').forEach(el => {
                el.classList.remove('smaller-size');
                el.classList.add('small-size');
            });
            $mobileCarousel.appendChild(clone);
        });

        $mobileCarousel.style.display = 'block';
        $desktopGrid.style.display = 'none';

        // Initialize Owl Carousel
        jQuery('.owl-carousel-mobile').addClass('owl-carousel').owlCarousel({
            loop: true,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            smartSpeed: 800,
            dots: true,
            autoplayHoverPause: true,
            nav: true,
            center: true,
            mouseDrag: false,
            touchDrag: true,
            responsive: {
                0: {
                    items: 1.47,
                    margin: 32
                },
                768: {
                    items: window.matchMedia("(orientation: portrait)").matches ? 1.89 : 3,
                    margin: window.matchMedia("(orientation: portrait)").matches ? 57.3 : 50,
                    stagePadding: window.matchMedia("(orientation: portrait)").matches ? 0 : 40
                },


            }
        });
    } else if (!isMobileOrPortraitTablet && $mobileCarousel.classList.contains('owl-loaded')) {
        // Destroy carousel and restore grid
        jQuery('.owl-carousel-mobile').trigger('destroy.owl.carousel').removeClass('owl-loaded owl-carousel');
        $mobileCarousel.innerHTML = '';
        $mobileCarousel.style.display = 'none';
        $desktopGrid.style.display = 'flex';
    }
}

// Initial setup
document.addEventListener('DOMContentLoaded', () => {
    initWhoWeAreCarousel();
    window.addEventListener('resize', () => {
        clearTimeout(window.carouselResizeTimeout);
        window.carouselResizeTimeout = setTimeout(initWhoWeAreCarousel, 200);
    });
});


// DESCRIPTION:Stay Connected section
jQuery(document).ready(function ($) {
    const isLargeScreen = window.innerWidth >= 1024;
    const $careersCarousel = $('.careers-page-carousel');

    $careersCarousel.owlCarousel({
        loop: !isLargeScreen,
        autoplay: !isLargeScreen,
        mouseDrag: true,
        touchDrag: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: window.innerWidth < 1025,
        nav: !isLargeScreen,
        smartSpeed: 800,
        dots: !isLargeScreen,
        dotsEach: true,
        margin: 32,
        stagePadding: 0,
        center: !isLargeScreen,
        responsive: {
            1025: {
                items: 3
            },
            768: {
                items: window.matchMedia("(orientation: portrait)").matches ? 2.165 : 3,
                loop: window.matchMedia("(orientation: portrait)").matches ? true : false,
                center: window.matchMedia("(orientation: portrait)").matches ? true : false,
                autoplay: window.matchMedia("(orientation: portrait)").matches ? true : false,
                dots: window.matchMedia("(orientation: portrait)").matches ? true : false,
            },
            0: {
                items: 1.42,
                loop: true,
                center: true,
                autoplay: true,
                dots: true,
                margin: 24,
            }
        }
    });
    if (!isLargeScreen) {
        let autoplayTimeout;
        $careersCarousel.on("dragged.owl.carousel", function () {
            $careersCarousel.trigger("stop.owl.autoplay");
            clearTimeout(autoplayTimeout);
            autoplayTimeout = setTimeout(() => {
                $careersCarousel.trigger("play.owl.autoplay", [5000]);
            }, 100);
        });
    }
    if (isLargeScreen) {
        $careersCarousel.closest('.careers-page-carousel-wrapper')
            .addClass('career-carousel-static');
        console.log('Static carousel applied');
    }

    function updateCareerCarouselResponsive($carousel) {
        const newResponsive = {
            0: {
                items: 1.42,
                loop: true,
                center: true,
                autoplay: true,
                dots: true,
                margin: 24,
            },
            768: {
                items: window.matchMedia("(orientation: portrait)").matches ? 2.165 : 3,
                loop: window.matchMedia("(orientation: portrait)").matches ? true : false,
                center: window.matchMedia("(orientation: portrait)").matches ? true : false,
                autoplay: window.matchMedia("(orientation: portrait)").matches ? true : false,
                dots: window.matchMedia("(orientation: portrait)").matches ? true : false,
            },
            1025: {
                items: 3
            }
        };

        // Use the `trigger` method to update responsive settings
        jQuery($careersCarousel).trigger("refresh.owl.carousel");
        jQuery($careersCarousel).data("owl.carousel").options.responsive = newResponsive;
    }


    let resizeTimeout;
    jQuery(window).on("resize  orientationchange", function () {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(updateCareerCarouselResponsive, 300); // Debounced resizing
    });

});