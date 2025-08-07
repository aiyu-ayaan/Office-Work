/* DESCRIPTION:OUR Commitments */

document.addEventListener("DOMContentLoaded", function () {
    let isTabletPortrait = false; // Flag to track current layout state

    function adjustLayout() {
        const brandPillars = document.querySelector(".brand-pillars");
        const cardContainers = Array.from(
            document.querySelectorAll(".card-container")
        );

        // Check if the screen size is for tablet portrait mode (768px to 1024px)
        const isCurrentTabletPortrait = window.matchMedia(
            "(min-width: 768px) and (max-width: 1024px) and (orientation: portrait)"
        ).matches;

        if (isCurrentTabletPortrait && !isTabletPortrait) {
            // Switch to tablet portrait layout
            const leftColumn = document.createElement("div");
            leftColumn.classList.add("column", "left-column");

            const rightColumn = document.createElement("div");
            rightColumn.classList.add("column", "right-column");

            cardContainers.forEach((card, index) => {
                if (index % 2 === 0) {
                    // Even index (0-based) -> Left column
                    leftColumn.appendChild(card);
                } else {
                    // Odd index -> Right column
                    rightColumn.appendChild(card);
                }
            });

            // Append columns to the brand-pillars container
            brandPillars.innerHTML = "";
            brandPillars.appendChild(leftColumn);
            brandPillars.appendChild(rightColumn);

            isTabletPortrait = true; // Update the flag
        } else if (!isCurrentTabletPortrait && isTabletPortrait) {
            // Revert to the original layout with odd-even logic
            const leftColumnCards = Array.from(
                document.querySelectorAll(".left-column .card-container")
            );
            const rightColumnCards = Array.from(
                document.querySelectorAll(".right-column .card-container")
            );

            // Merge cards back in the original odd-even order
            const mergedCards = [];
            const maxLength = Math.max(
                leftColumnCards.length,
                rightColumnCards.length
            );
            for (let i = 0; i < maxLength; i++) {
                if (leftColumnCards[i]) mergedCards.push(leftColumnCards[i]);
                if (rightColumnCards[i]) mergedCards.push(rightColumnCards[i]);
            }

            brandPillars.innerHTML = "";
            mergedCards.forEach((card) => {
                brandPillars.appendChild(card); // Restore original order
            });

            isTabletPortrait = false; // Update the flag
        }
    }

    adjustLayout();

    // Add resize event listener with debounce
    let resizeTimeout;
    window.addEventListener("resize", () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(adjustLayout, 200); // Debounce to improve performance
    });

    document
        .querySelectorAll(".brand-pillars .card-container")
        .forEach((container) => {
            const circle = container.querySelector(".circle");
            const card = container.querySelector(".card");
            const heading = container.querySelector("h3");
            const description = container.querySelector("p");
            const svgPath = container.querySelector("svg path");

            const bgImage = container.getAttribute("data-circle-image");
            const color = container.getAttribute("data-color");
            const headingText = container.getAttribute("data-heading");
            const descriptionText = container.getAttribute("data-description");

            if (color) {
                circle.style.backgroundColor = color;
            }
            if (bgImage) {
                circle.style.backgroundImage = `url(${bgImage})`;
            }
            if (color) {
                card.style.borderColor = color;
            }
            if (headingText) {
                heading.textContent = headingText;
            }
            if (descriptionText) {
                description.textContent = descriptionText;
            }
            if (svgPath) {
                svgPath.setAttribute("fill", color);
            }

            container.addEventListener("click", (event) => {
                const isCardOrImage =
                    event.target.closest(".brand-pillars .card") ||
                    event.target.closest(".brand-pillars .circle");

                if (isCardOrImage) {
                    const isAlreadyActive = container.classList.contains("active");

                    // Remove active class from all cards
                    document.querySelectorAll(".brand-pillars .card-container").forEach((otherContainer) => {
                        otherContainer.classList.remove("active");
                    });

                    // Only add active if it wasn't already active (i.e., collapse if clicked again)
                    if (!isAlreadyActive) {
                        container.classList.add("active");
                    }
                }
            });

        });
});

// DESCRIPTION:OUR People
jQuery(document).ready(function () {
    var owl = jQuery(".about-our-people .owl-carousel");
    var progressCircle = jQuery(".circle-progress");
    var pause = false;
    var playPauseBtn = null; // Initially null
    var totalSlides = 0;

    owl.owlCarousel({
        loop: true,
        margin: 20,
        nav: true,
        dots: true,
        autoplay: true,
        autoplayTimeout: 5000,
        smartSpeed: 1000,
        items: 1,
        pullDrag: false,
        mouseDrag: false,
        touchDrag: false,
        animateIn: "fadeIn",
        animateOut: "fadeOut",
        responsive: {
            0: {
                autoplayHoverPause: true,
            },
            768: {
                autoplayHoverPause: false,
            }
        },
        onInitialized: function (event) {
            totalSlides = jQuery(".about-our-people .owl-item:not(.cloned)").length;
            progressCircle.css({ "stroke-dashoffset": 364.42 });
            updateProgress(0, totalSlides);
            waitForButton();

        },
        onTranslate: function (event) {
            var currentIndex = event.page.index || 0;
            if (typeof totalSlides === "undefined") {
                totalSlides = jQuery(".about-our-people .owl-item:not(.cloned)").length;
            }
            updateProgress(currentIndex, totalSlides);
        }
    });
    // owl.on("touchstart", function (event) {
    //     jQuery(this).trigger("next.owl.carousel");
    // });
    let touchStartX = 0, touchEndX = 0;

    owl.on("touchstart", function (event) {
        touchStartX = event.originalEvent.touches[0].clientX;
        owl.trigger("stop.owl.autoplay"); // Stop autoplay when user starts swiping
    });

    owl.on("touchmove", function (event) {
        touchEndX = event.originalEvent.touches[0].clientX;
    });

    owl.on("touchend", function () {
        let swipeDistance = touchStartX - touchEndX;

        if (Math.abs(swipeDistance) > 50) { // Detect swipe direction
            if (swipeDistance > 0) {
                owl.trigger("next.owl.carousel"); // Swipe left → next slide
            } else {
                owl.trigger("prev.owl.carousel"); // Swipe right → previous slide
            }
        }

        if (!pause) {
            owl.trigger("play.owl.autoplay", [5000]);
        } else {
            owl.trigger("stop.owl.autoplay");
        }
    });

    function waitForButton() {
        var btnCheck = setInterval(function () {
            playPauseBtn = jQuery("#playPauseBtn");
            if (playPauseBtn.length) {
                clearInterval(btnCheck); // Stop checking once button exists
                bindPlayPauseEvent();
            }
        }, 50);
    }

    function bindPlayPauseEvent() {
        playPauseBtn.on("click", function () {
            pause = !pause;
            console.log("btn clicked", pause);
            if (!pause) {
                owl.trigger("play.owl.autoplay", [5000]);
            } else {
                owl.trigger("stop.owl.autoplay");
            }
        });
    }

    jQuery(".owl-prev, .owl-next").on("click", function () {
        owl.trigger("stop.owl.autoplay");
        if (!pause) {
            owl.trigger("play.owl.autoplay", [5000]);
        } else {
            owl.trigger("stop.owl.autoplay");
        }
    });

    function updateProgress(slideIndex, totalSlides) {
        var maxOffset = 364.42;
        var segmentOffset = maxOffset / totalSlides;
        var newOffset = maxOffset - segmentOffset * (slideIndex + 1);
        var prevIndex = progressCircle.data("prevIndex");

        // console.log(`Slide ${slideIndex + 1}/${totalSlides} - Stroke Dashoffset: ${newOffset}`);

        if (slideIndex === 0 && prevIndex === totalSlides - 1) {
            progressCircle.css({ transition: "none", "stroke-dashoffset": maxOffset });
            progressCircle[0].offsetHeight; // Force reflow
            setTimeout(() => {
                progressCircle.css({ transition: "stroke-dashoffset 3s linear", "stroke-dashoffset": newOffset });
            }, 10);
        } else if (slideIndex === totalSlides - 1) {
            setTimeout(() => {
                progressCircle.css({ transition: "stroke-dashoffset 3s linear", "stroke-dashoffset": 0 });
            }, 10);
        } else {
            progressCircle.css({ transition: "stroke-dashoffset 3s linear", "stroke-dashoffset": newOffset });
        }

        progressCircle.data("prevIndex", slideIndex);
    }
});

/* DESCRIPTION:OUR Approach */
document.addEventListener('DOMContentLoaded', function () {
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
                    lastPopup.style.display = 'block';
                }
            }
        }
    }

    // Run on load
    checkScreenSize();

    // Listen for screen size changes
    window.matchMedia("(min-width: 1024px)").addEventListener("change", checkScreenSize);
    window.matchMedia("(min-width: 768px) and (max-width: 1024px) and (orientation: landscape)").addEventListener("change", checkScreenSize);
    document.querySelectorAll('.linkbtn').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            document.querySelectorAll('.linkbtn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            const popupId = this.getAttribute('data-popup');
            document.querySelectorAll('.popup').forEach(p => p.style.display = 'none');
            const popup = document.getElementById(popupId);
            if (popup) {
                popup.style.display = 'block';
            }
        });
    });
    document.querySelectorAll('.icon-box').forEach(iconBox => {
        iconBox.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            const container = this.closest('.poly-box');
            if (!container) return;
            const targetLink = container.querySelector('.linkbtn');
            if (targetLink) {
                targetLink.click();
            }
        });
    });
    document.querySelectorAll('.popup .close').forEach(closeBtn => {
        closeBtn.addEventListener('click', function () {
            closeApproachPopup();
        });
    });
    document.addEventListener('click', function (event) {
        const approachSection = document.querySelector('.approach-section');

        if (approachSection) {
            const rect = approachSection.getBoundingClientRect();
            if (rect.top < window.innerHeight) {
                if (rect.bottom > 0) {
                    const openPopup = document.querySelector('.popup[style*="display: block"]');
                    if (openPopup) {
                        if (!openPopup.contains(event.target)) {
                            if (!event.target.closest('.linkbtn, .icon-box, #cookieConsent, #cookie-banner-again')) {
                                closeApproachPopup();
                            }
                        }
                    }
                }
            }
        }
    });


    function closeApproachPopup() {
        document.querySelectorAll('.popup').forEach(p => p.style.display = 'none');
        document.querySelectorAll('.linkbtn').forEach(b => b.classList.remove('active'));
    }

});
