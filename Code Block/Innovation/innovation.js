// DESCRIPTION:Banner
jQuery(document).ready(function ($) {
    $(".innovation-banner .owl-carousel").owlCarousel({
        items: 1,
        loop: true,
        margin: 10,
        nav: true,
        dots: true,
        autoplay: true,
        autoplayTimeout: 5000,
        lazyLoad: true,
    });
});


// DESCRIPTION:Our innovation section
document.addEventListener("DOMContentLoaded", function () {

    let resizeTimeout;
    let isCarouselInitialized = false;
    initCarouselIfNeeded();
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            initCarouselIfNeeded();
        }, 150);
    });

    const mainCard = document.querySelector(".innovation-section .main-card");
    const mainTitle = document.querySelector(".innovation-section .main-card-title");
    const mainContent = document.querySelector(".innovation-section .main-card-content");

    document.querySelectorAll(".innovation-section .card").forEach(card => {
        const title = card.dataset.title;
        const desc = card.dataset.desc;
        const bg = card.dataset.bg;
        if (!card.dataset.originalTitle) {
            card.dataset.originalTitle = title;
            card.dataset.originalDesc = desc;
            card.dataset.originalBg = bg;
        }
        card.style.backgroundImage = `url(${bg})`;
        card.querySelector('.card-title').textContent = title;
        card.querySelector('.card-description').innerHTML = desc;
        card.querySelector('.card-description').style.display = 'none';
        let isClickLocked = false;
        card.addEventListener("click", () => {
            if (isClickLocked) return; // prevent rapid double clicks

            isClickLocked = true;
            setTimeout(() => isClickLocked = false, 500); // adjust duration as needed

            const mainBg = mainCard.style.backgroundImage;
            const mainTitleText = mainTitle.textContent;
            const mainDescText = mainContent.innerHTML;
            const cardBg = card.dataset.bg;
            const cardTitle = card.dataset.title;
            const cardDesc = card.dataset.desc;

            card.classList.add("clicked");
            setTimeout(() => {
                card.classList.remove("clicked");
                card.classList.add("clicked-back");
                setTimeout(() => {
                    card.classList.remove("clicked-back");
                }, 300);
            }, 200);

            if (!isMobileOrTabletPortrait()) {
                mainCard.classList.remove("fade-in");
                mainCard.classList.add("fade-out");

                setTimeout(() => {
                    mainCard.style.backgroundImage = `url(${cardBg})`;
                    mainTitle.textContent = cardTitle;
                    mainContent.innerHTML = cardDesc;
                    mainCard.classList.remove("fade-out");
                    mainCard.classList.add("fade-in");
                }, 200);
                card.dataset.bg = mainBg.replace(/^url\(["']?/, '').replace(/["']?\)$/, '');
                card.dataset.title = mainTitleText;
                card.dataset.desc = mainDescText;
                card.style.backgroundImage = mainBg;
                card.querySelector('.card-title').textContent = mainTitleText;
                card.querySelector('.card-description').innerHTML = mainDescText;
            }
        });
    });
    const cards = Array.from(document.querySelectorAll(".innovation-section .card"));
    const lastCard = cards.at(-1);
    if (lastCard) {
        mainCard.style.backgroundImage = `url(${lastCard.dataset.bg})`;
        mainTitle.textContent = lastCard.dataset.title;
        mainContent.innerHTML = lastCard.dataset.desc;
    }
    function initCarouselIfNeeded() {
        let carousel = jQuery('.small-cards');
        if (isMobileOrTabletPortrait() && !isCarouselInitialized) {
            isCarouselInitialized = true;
            carousel.addClass("owl-carousel").owlCarousel({
                center: true,
                loop: true,
                nav: true,
                autoplay: false,
                dots: true,
                responsive: {
                    0: {
                        items: 1.43,
                        margin: 20,
                    },
                    768: {
                        items: 2.25,
                        margin: 24,
                    }
                }
            });

            carousel.on('click', '.owl-item', function (event) {
                const clickedItem = event.currentTarget;
                const owlItems = carousel.find('.owl-item').toArray();
                const centerItem = carousel.find('.owl-item.center')[0];

                const clickedIndex = owlItems.indexOf(clickedItem);
                const centerIndex = owlItems.indexOf(centerItem);

                if (clickedIndex > centerIndex) {
                    carousel.trigger('next.owl.carousel');
                } else if (clickedIndex < centerIndex) {
                    carousel.trigger('prev.owl.carousel');
                }
            });
            carousel.on('changed.owl.carousel', function (event) {
                setTimeout(() => {
                    const centerCard = document.querySelector('.innovation-section .owl-item.center .card');
                    if (centerCard) {
                        const title = centerCard.dataset.title;
                        const desc = centerCard.dataset.desc;
                        const bg = centerCard.dataset.bg;

                        mainCard.classList.remove("fade-in");
                        mainCard.classList.add("fade-out");

                        setTimeout(() => {
                            mainCard.style.backgroundImage = `url(${bg})`;
                            mainTitle.textContent = title;
                            mainContent.innerHTML = desc;

                            mainCard.classList.remove("fade-out");
                            mainCard.classList.add("fade-in");
                        }, 200);
                    }
                }, 50);
            });

            setTimeout(() => {

                const centerCard = document.querySelector('.innovation-section .owl-item.center .card');
                if (centerCard) {
                    const title = centerCard.dataset.title;
                    const desc = centerCard.dataset.desc;
                    const bg = centerCard.dataset.bg;

                    mainCard.style.backgroundImage = `url(${bg})`;
                    mainTitle.textContent = title;
                    mainContent.innerHTML = desc;
                }
            }, 100);
        }
        else if (!isMobileOrTabletPortrait() && isCarouselInitialized) {
            isCarouselInitialized = false;
            carousel.removeClass("owl-carousel owl-loaded").trigger("destroy.owl.carousel");
            const extraDiv = document.querySelector(".innovation-section .carousel-controls");
            if (extraDiv) {
                extraDiv.remove();
            }
        }
    }
    function isMobileOrTabletPortrait() {
        return window.innerWidth <= 767 || window.matchMedia(
            "(min-width: 768px) and (max-width: 1024px) and (orientation: portrait)"
        ).matches;
    }
});


// DESCRIPTION:Why Partner with Adrosonic

const leftColumn = document.querySelector(
    ".why-partner-with-adrosonic .left-column"
);
const rightColumn = document.querySelector(
    ".why-partner-with-adrosonic .right-column"
);
const container = document.querySelector(
    ".why-partner-with-adrosonic .container"
);
const allCards = Array.from(
    document.querySelectorAll(".why-partner-with-adrosonic .card")
);

// let currentMode = window.innerWidth <= 767.5 ? "mobile" : "desktop";
let currentMode = null;

// Store original card positions
const leftCards = [];
const rightCards = [];

allCards.forEach((card, index) => {
    const headingText = card.getAttribute("data-heading");
    const descriptionText = card.getAttribute("data-description");
    const number = index + 1;

    card.innerHTML = `
          <div class="card-content">
            <div class="circle-wrapper">
              <div class="outer-circle">
                <div class="inner-circle small-size">${number}</div>
              </div>
            </div>
            <div class="heading small-size">${headingText}</div>
            <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 28 23" fill="none">
              <path d="M12.2952 21.2209C13.0757 22.4932 14.9243 22.4932 15.7048 21.2209L26.854 3.04578C27.6715 1.71316 26.7126 0 25.1492 0H2.85075C1.28738 0 0.328482 1.71316 1.14596 3.04578L12.2952 21.2209Z" fill="#00CCFF"/>
            </svg>
          </div>
          <div class="description smaller-size">${descriptionText}</div>
        `;

    card.addEventListener("click", () => {
        allCards.forEach((c) => {
            if (c !== card) c.classList.remove("expanded");
        });
        card.classList.toggle("expanded");
    });

    if (index % 2 === 0) {
        leftCards.push(card);
        leftColumn.appendChild(card);
    } else {
        rightCards.push(card);
        rightColumn.appendChild(card);
    }
});

function updateCardLayout() {
    const isMobile = window.innerWidth <= 767.5;
    const newMode = isMobile ? "mobile" : "desktop";

    if (newMode === currentMode) return; // No need to update

    currentMode = newMode;
    container.innerHTML = ""; // Clear everything

    if (isMobile) {
        // Interleave cards
        const maxLength = Math.max(leftCards.length, rightCards.length);
        for (let i = 0; i < maxLength; i++) {
            if (leftCards[i]) container.appendChild(leftCards[i]);
            if (rightCards[i]) container.appendChild(rightCards[i]);
        }
    } else {
        // Restore two-column layout
        container.appendChild(leftColumn);
        container.appendChild(rightColumn);

        leftColumn.innerHTML = "";
        rightColumn.innerHTML = "";

        leftCards.forEach((card) => leftColumn.appendChild(card));
        rightCards.forEach((card) => rightColumn.appendChild(card));
    }
}

window.addEventListener("resize", updateCardLayout);
window.addEventListener("DOMContentLoaded", updateCardLayout);
// Expand the first card by default
allCards[0].classList.add("expanded");



// DESCRIPTION:How we do it
jQuery(document).ready(function () {
    var currentActiveItemId = 0;
    var how_we_do_it_owl = jQuery(".how-we-do-it-container .owl-carousel");
    var numItems = 0;
    function initializeHowWeDoItCarousel() {
        how_we_do_it_owl.owlCarousel({
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
                    items: window.matchMedia("(orientation: portrait)").matches
                        ? 2.19
                        : 4,
                    margin: 40,
                    stagePadding: 40,
                    nav: false,
                    dots:
                        window.matchMedia("(orientation: portrait)").matches ||
                        numItems >= 4,
                    loop: window.matchMedia("(orientation: portrait)").matches
                        ? true
                        : false,
                    dotsEach: 1,
                },
                800: {
                    items: window.matchMedia("(orientation: portrait)").matches
                        ? 2.19
                        : 4,
                    margin: 40,
                    stagePadding: 24,
                    nav: false,
                    dots:
                        window.matchMedia("(orientation: portrait)").matches ||
                        numItems >= 4,
                    dotsEach: 1,
                    loop: window.matchMedia("(orientation: portrait)").matches
                        ? true
                        : false,
                },
                834: {
                    items: window.matchMedia("(orientation: portrait)").matches
                        ? 2.19
                        : 4,
                    margin: 40,
                    stagePadding: 40,
                    nav: false,
                    dots:
                        window.matchMedia("(orientation: portrait)").matches ||
                        numItems >= 4,
                    dotsEach: 1,
                    loop: window.matchMedia("(orientation: portrait)").matches
                        ? true
                        : false,
                },
                1025: {
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
            },
        });
        updateActiveItem();
    }

    function updateActiveItem() {
        numItems = jQuery(
            ".how-we-do-it-container .owl-carousel .owl-item:not(.cloned)"
        ).length;
        jQuery(".how-we-do-it-container .owl-carousel .owl-item .item")
            .removeClass("current small-size font-bold")
            .addClass("smaller-size");
        var newActiveItem = jQuery(
            ".how-we-do-it-container .owl-carousel .owl-item.active"
        )
            .first()
            .find(".item");
        newActiveItem
            .addClass("current small-size font-bold")
            .removeClass("smaller-size");
        let newItemId = newActiveItem.attr("data-id");
        if (newItemId !== currentActiveItemId) {
            currentActiveItemId = newItemId;
            updateContent(newActiveItem);
        }
    }

    function updateContent(activeItem) {
        let imageSrc = activeItem.attr("data-img-path");

        //   if (imageSrc) {
        //     jQuery(".content-image").attr("src", imageSrc);
        //   }
        //   // Reset scroll position of content-box
        //   jQuery(".how-we-do-it-container .content-box").scrollLeft(0);

        if (imageSrc) {
            const img = jQuery(".content-image");
            img.off("load").on("load", function () {
                // Reset scroll after image has loaded
                jQuery(".how-we-do-it-container .content-box").scrollLeft(0);
            });

            img.attr("src", imageSrc);
        }
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
                dots:
                    window.matchMedia("(orientation: portrait)").matches ||
                    numItems >= 4,
                dotsEach: 1,
                loop: window.matchMedia("(orientation: portrait)").matches
                    ? true
                    : false,
            },
            800: {
                items: window.matchMedia("(orientation: portrait)").matches
                    ? 2.19
                    : 4,
                margin: 40,
                stagePadding: 24,
                nav: false,
                dots:
                    window.matchMedia("(orientation: portrait)").matches ||
                    numItems >= 4,
                dotsEach: 1,
                loop: window.matchMedia("(orientation: portrait)").matches
                    ? true
                    : false,
            },
            834: {
                items: window.matchMedia("(orientation: portrait)").matches
                    ? 2.19
                    : 4,
                margin: 40,
                stagePadding: 40,
                nav: false,
                dots:
                    window.matchMedia("(orientation: portrait)").matches ||
                    numItems >= 4,
                dotsEach: 1,
                loop: window.matchMedia("(orientation: portrait)").matches
                    ? true
                    : false,
            },
            1025: {
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

        jQuery(how_we_do_it_owl).trigger("refresh.owl.carousel");
        jQuery(how_we_do_it_owl).data("owl.carousel").options.responsive =
            newResponsive;
    }

    initializeHowWeDoItCarousel();

    jQuery(".how-we-do-it-container .owl-carousel .item").on(
        "click",
        function () {
            if (jQuery(this).hasClass("current")) return;
            jQuery(".how-we-do-it-container .owl-carousel .item")
                .removeClass("current small-size font-bold")
                .addClass("smaller-size");
            jQuery(this)
                .addClass("current small-size font-bold")
                .removeClass("smaller-size");

            let newItemId = jQuery(this).attr("data-id");
            if (newItemId !== currentActiveItemId) {
                currentActiveItemId = newItemId;
                updateContent(jQuery(this));
            }
            var dataId = parseInt(jQuery(this).attr("data-id"), 10); // convert to number
            jQuery(".how-we-do-it-container .owl-dots .owl-dot").removeClass(
                "active"
            );
            jQuery(".how-we-do-it-container .owl-dots .owl-dot")
                .eq(dataId)
                .addClass("active");
            var $carousel = jQuery(".how-we-do-it-container .owl-carousel");
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


        }
    );

    how_we_do_it_owl.on("changed.owl.carousel", function () {
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
        var how_we_do_it_carousel_controls = document.querySelector(
            ".how-we-do-it-container .owl-carousel .carousel-controls"
        );
        let playPauseBtn =
            how_we_do_it_carousel_controls.querySelector("#playPauseBtn");
        if (playPauseBtn) {
            playPauseBtn.remove();
        }
        moveNavButtons();
    }, 100);
    function moveNavButtons() {
        const contentBox = document.querySelector(
            ".how-we-do-it-container .content-box"
        );
        const owlNav = document.querySelector(
            ".how-we-do-it-container .carousel-controls"
        );

        if (window.innerWidth < 1025) {
            contentBox.after(owlNav);
        } else {
            setTimeout(function () {
                const carouselWrapper = document.querySelector(
                    ".how-we-do-it-container .owl-carousel"
                );
                carouselWrapper.appendChild(owlNav);
            }, 100);
        }
    }
});


// DESCRIPTION:our clients section
const service_our_clients_owl = jQuery(
    ".service-our-clients-section .owl-carousel"
);
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
        margin: 20,
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
    const left_desc = document.querySelectorAll(
        ".service-our-clients-section .left-box .left-desc,.service-our-clients-section .left-box .author-line"
    );
    left_desc.forEach((item) => {
        if (window.matchMedia("(orientation:portrait)").matches) {
            item.classList.add("small-size");
            item.classList.remove("smaller-size");
        } else {
            item.classList.remove("small-size");
            item.classList.add("smaller-size");
        }
    });
}

window.addEventListener("load", updateClassForPortraitView);
window.addEventListener("resize", updateClassForPortraitView);


// DESCRIPTION:Innovation section
const owl = jQuery(".focus-carousel-container.owl-carousel");

jQuery(document).ready(function () {
    owl.owlCarousel({
        loop: true,
        items: 1,
        autoplay: false,
        /* smartSpeed: 800,
              autoplayTimeout: 5000, */
        nav: true,
        dots: true,
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

    // Pause Vimeo videos on slide change
    owl.on("changed.owl.carousel", function () {
        jQuery(
            '.our-innovation-focus .owl-carousel iframe[src*="vimeo.com"]'
        ).each(function () {
            try {
                const player = new Vimeo.Player(this);
                player.pause().catch(() => { });
            } catch (e) {
                console.warn("Vimeo player error:", e);
            }
        });
    });

    // Pause carousel autoplay when video plays, resume on pause/end, and reset video on end
    jQuery('.our-innovation-focus .owl-carousel iframe[src*="vimeo.com"]').each(
        function () {
            const iframe = this;
            const originalSrc = iframe.src;

            try {
                const player = new Vimeo.Player(iframe);

                //   player.on("play", function () {
                //     owl.trigger("stop.owl.autoplay");
                //   });

                //   player.on("pause", function () {
                //     owl.trigger("play.owl.autoplay");
                //   });

                player.on("ended", function () {
                    // Resume carousel autoplay
                    // owl.trigger("play.owl.autoplay");
                    // Reset video to thumbnail by reloading iframe
                    iframe.src = originalSrc;
                });
            } catch (e) {
                console.warn("Vimeo player setup error:", e);
            }
        }
    );



});

document.addEventListener("DOMContentLoaded", function () {
    const section = document.querySelector(".our-innovation-focus .video-container");
    const iframe = section.querySelector("iframe[src*='vimeo.com']");

    if (!iframe || !window.IntersectionObserver) return;

    const player = new Vimeo.Player(iframe);

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    player.play().catch((e) => console.warn("Play error:", e));
                } else {
                    player.pause().catch((e) => console.warn("Pause error:", e));
                }
            });
        },
        {
            threshold: 0.5, // Play when at least 50% of the section is visible
        }
    );

    observer.observe(section);
});