//  DESCRIPTION:banner Banner

const owl = jQuery('.hero-carousel.owl-carousel');
jQuery(document).ready(function () {
    owl.owlCarousel({
        loop: true,
        items: 1,
        autoplay: true,
        smartSpeed: 500,
        autoplayTimeout: 5200,
        nav: true,
        dots: true,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        responsive: {
            0: {
                mouseDrag: true,
                touchDrag: true,
            },
            1025: {
                mouseDrag: false,
                touchDrag: false,

            }
        },
    });
});
owl.on('translate.owl.carousel', function (event) {
    const currentIndex = event.item.index;
    const currentSlide = jQuery('.owl-item').eq(currentIndex);
    const video = currentSlide.find('video');

    if (video.length) {

        video.get(0).pause();
        video.get(0).currentTime = 0;
        video.attr('src', '');
    }
});

owl.on('translated.owl.carousel', function (event) {
    const currentIndex = event.item.index;
    const currentSlide = jQuery('.owl-item').eq(currentIndex);
    const video = currentSlide.find('video');

    if (video.length && !video.attr('src') && video.data('src')) {
        video.attr('src', video.data('src')).get(0).load();
        video.get(0).play().catch((e) => console.log('Video play error: ', e));
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

const sendMail = (e) => {
    e.preventDefault();
    const postTitle = "";
    const postUrl = "";
    const subject = encodeURIComponent("ADROSONIC | Press Release Collaboration");
    const body = "";
    const mailtoLink = `mailto:?subject=${subject}&body=${body}`;
    window.location.href = mailtoLink;
}

//  DESCRIPTION:banner Latest News

jQuery(document).ready(function ($) {


    const mainCard = document.querySelector(".latest-news-section .main-card");
    const mainTitle = document.querySelector(".latest-news-section .main-card-title");
    const mainContent = document.querySelector(".latest-news-section .main-card-content");
    const mainCta = document.querySelector(".latest-news-section .main-card-cta");
    const mainCtaText = document.querySelector(".latest-news-section .main-card-cta span");


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
        // card.querySelector('.card-cta').href = cta;
        // card.querySelector('.card-cta span').textContent = ctaText;


        const cardCta = card.querySelector('.card-cta');
        if (cardCta) {
            cardCta.href = cta;
            const span = cardCta.querySelector('span');
            if (span) span.textContent = ctaText;
        }


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
    const cards = Array.from(document.querySelectorAll(".latest-news-section .card"));
    const lastCard = cards.at(-1);
    if (lastCard) {
        mainCard.style.backgroundImage = `url(${lastCard.dataset.bg})`;
        mainTitle.textContent = lastCard.dataset.title;
        mainContent.innerHTML = lastCard.dataset.desc;
    }
    let latest_news_carousel = jQuery('.latest-news-section .small-cards');


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

        latest_news_carousel.data("owl.carousel").options.responsive =
            newResponsive;
        latest_news_carousel.trigger("refresh.owl.carousel");

    }

    let resizeTimeout;
    jQuery(window).on("resize  orientationchange", function () {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(updateLatestNewsCarouselResponsive, 300); // Debounced resizing
    });


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
    latest_news_carousel.on('changed.owl.carousel', function (event) {



        setTimeout(() => {
            const centerCard = document.querySelector('.latest-news-section .owl-item.center .card');
            if (centerCard) {
                const title = centerCard.dataset.title;
                const desc = centerCard.dataset.desc;
                const bg = centerCard.dataset.bg;
                const cta = centerCard.dataset.cta;
                const ctaText = centerCard.dataset.ctaText;

                mainCard.classList.remove("fade-in");
                mainCard.classList.add("fade-out");

                setTimeout(() => {
                    mainCard.style.backgroundImage = `url(${bg})`;
                    mainTitle.textContent = title;
                    mainContent.innerHTML = desc;
                    // if (cta) mainCta.href = cta;
                    // if (ctaText) mainCtaText.textContent = ctaText;
                    if (cta && ctaText) {
                        mainCta.href = cta;
                        mainCtaText.textContent = ctaText;
                        mainCta.style.display = "inline-block"; // show if valid
                    } else {
                        mainCta.style.display = "none"; // hide if missing
                    }


                    mainCard.classList.remove("fade-out");
                    mainCard.classList.add("fade-in");
                }, 200);
            }
        }, 50);
    });



    setTimeout(() => {
        const centerCard = document.querySelector('.latest-news-section .owl-item.center .card');
        if (centerCard) {
            const title = centerCard.dataset.title;
            const desc = centerCard.dataset.desc;
            const bg = centerCard.dataset.bg;
            const cta = centerCard.dataset.cta;
            const ctaText = centerCard.dataset.ctaText;

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

//  DESCRIPTION:banner all press release
//  DESCRIPTION:banner events and highlights

jQuery(document).ready(function ($) {
    const mainCard = document.querySelector(
        ".events-and-highlights-section .main-card"
    );
    const mainTitle = document.querySelector(
        ".events-and-highlights-section .main-card-title"
    );
    const mainContent = document.querySelector(
        ".events-and-highlights-section .main-card-content"
    );
    const mainCta = document.querySelector(
        ".events-and-highlights-section .main-card-cta"
    );
    const mainCtaText = document.querySelector(
        ".events-and-highlights-section .main-card-cta span"
    );

    document
        .querySelectorAll(".events-and-highlights-section .card")
        .forEach((card) => {
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
            card.querySelector(".card-title").textContent = title;
            card.querySelector(".card-description").innerHTML = desc;

            const cardCta = card.querySelector(".card-cta");
            if (cardCta) {
                cardCta.href = cta;
                const span = cardCta.querySelector("span");
                if (span) span.textContent = ctaText;
            }

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
    const cards = Array.from(
        document.querySelectorAll(".events-and-highlights-section .card")
    );
    const lastCard = cards.at(-1);
    if (lastCard) {
        mainCard.style.backgroundImage = `url(${lastCard.dataset.bg})`;
        mainTitle.textContent = lastCard.dataset.title;
        mainContent.innerHTML = lastCard.dataset.desc;
    }
    let eventsCarousel = jQuery(".events-and-highlights-section .small-cards");

    eventsCarousel.owlCarousel({
        center: true,
        loop: true,
        nav: true,
        autoplay: true,
        dots: true,
        autoplayTimeout: 5000,
        smartSpeed: 800,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1.43,
                margin: 20,
            },
            768: {
                items: window.matchMedia(
                    "(min-width: 768px) and (max-width: 1024px) and (orientation: portrait)"
                ).matches ?
                    2.25 : 2.7,
                margin: window.matchMedia(
                    "(min-width: 768px) and (max-width: 1024px) and (orientation: portrait)"
                ).matches ?
                    24 : 8,
            },
            1025: {
                items: 3.15,
                margin: 8,
            },
        },
    });

    function updateEventsCarouselResponsive() {
        const newResponsive = {
            0: {
                items: 1.43,
                margin: 20,
            },
            768: {
                items: window.matchMedia(
                    "(min-width: 768px) and (max-width: 1024px) and (orientation: portrait)"
                ).matches ?
                    2.25 : 2.7,
                margin: window.matchMedia(
                    "(min-width: 768px) and (max-width: 1024px) and (orientation: portrait)"
                ).matches ?
                    24 : 8,
            },
            1025: {
                items: 3.15,
                margin: 8,
            },
        };

        eventsCarousel.data("owl.carousel").options.responsive = newResponsive;
        eventsCarousel.trigger("refresh.owl.carousel");
    }

    let resizeTimeout;
    jQuery(window).on("resize  orientationchange", function () {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(updateEventsCarouselResponsive, 300); // Debounced resizing
    });

    eventsCarousel.on("click", ".owl-item", function (event) {
        const clickedItem = event.currentTarget;
        const owlItems = eventsCarousel.find(".owl-item").toArray();
        const centerItem = eventsCarousel.find(".owl-item.center")[0];

        const clickedIndex = owlItems.indexOf(clickedItem);
        const centerIndex = owlItems.indexOf(centerItem);

        if (clickedIndex > centerIndex) {
            eventsCarousel.trigger("next.owl.carousel");
        } else if (clickedIndex < centerIndex) {
            eventsCarousel.trigger("prev.owl.carousel");
        }
    });
    eventsCarousel.on("changed.owl.carousel", function (event) {
        setTimeout(() => {
            const centerCard = document.querySelector(
                ".events-and-highlights-section .owl-item.center .card"
            );
            if (centerCard) {
                const title = centerCard.dataset.title;
                const desc = centerCard.dataset.desc;
                const bg = centerCard.dataset.bg;
                const cta = centerCard.dataset.cta;
                const ctaText = centerCard.dataset.ctaText;

                mainCard.classList.remove("fade-in");
                mainCard.classList.add("fade-out");

                setTimeout(() => {
                    mainCard.style.backgroundImage = `url(${bg})`;
                    mainTitle.textContent = title;
                    mainContent.innerHTML = desc;
                    if (cta && ctaText) {
                        mainCta.href = cta;
                        mainCtaText.textContent = ctaText;
                        mainCta.style.display = "inline-block"; // show if valid
                    } else {
                        mainCta.style.display = "none"; // hide if missing
                    }

                    mainCard.classList.remove("fade-out");
                    mainCard.classList.add("fade-in");
                }, 200);
            }
        }, 50);
    });

    setTimeout(() => {
        const centerCard = document.querySelector(
            ".events-and-highlights-section .owl-item.center .card"
        );
        if (centerCard) {
            const title = centerCard.dataset.title;
            const desc = centerCard.dataset.desc;
            const bg = centerCard.dataset.bg;
            const cta = centerCard.dataset.cta;
            const ctaText = centerCard.dataset.ctaText;

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

//  DESCRIPTION:banner up and coming

jQuery(window).ready(function () {
    const owl = jQuery(".featured-insights .owl-carousel");
    function initializeCarousel() {

        owl.owlCarousel({
            onInitialized: updateDots,
            onChanged: updateDots,
            loop: true,
            autoplay: true,
            autoplayTimeout: 5000,
            smartSpeed: 800,
            dots: true,
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

                1024: {
                    items: 3,
                    margin: 40,
                    stagePadding: 40
                },
                1440: {
                    items: 3,
                    margin: 86,
                    stagePadding: 64
                }
            }
        });
    }
    // Function to update responsiveness dynamically
    function updateResponsiveSettings() {
        const isPortrait = window.matchMedia("(orientation: portrait)").matches;

        const newResponsive = {
            0: {
                items: 1.47,
                margin: 32
            },
            768: {
                items: isPortrait ? 1.89 : 3,
                margin: isPortrait ? 57.3 : 50,
                stagePadding: isPortrait ? 0 : 40
            },

            1024: {
                items: 3,
                margin: 40,
                stagePadding: 40
            },
            1440: {
                items: 3,
                margin: 86,
                stagePadding: 64
            }
        };

        // Use the `trigger` method to update responsive settings
        jQuery(owl).trigger("refresh.owl.carousel");
        jQuery(owl).data("owl.carousel").options.responsive = newResponsive;
    }
    // Initialize the carousel on page load
    initializeCarousel();

    // Pause only on center item hover
    function handleActiveHover() {
        owl.find(".owl-item.active .insights-featured").off("mouseenter mouseleave");
        owl.find(".owl-item.active .insights-featured").each(function () {
            jQuery(this).on("mouseenter", function () {
                owl.trigger("stop.owl.autoplay");
            }).on("mouseleave", function () {
                const playPauseBtn = jQuery(".carousel-controls #playPauseBtn svg");
                if (!playPauseBtn.hasClass("ic-pause")) {
                    owl.trigger("play.owl.autoplay", [5000]);
                }
            });
        });
    }

    // Call after initialization
    owl.on("initialized.owl.carousel changed.owl.carousel refreshed.owl.carousel", function () {
        handleActiveHover();
    });

    // Initial setup
    handleActiveHover();

    let resizeTimeout;
    jQuery(window).on("resize", function () {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(updateResponsiveSettings, 300);
    });

    // Pause autoplay on swipe and resume after a delay
    let autoplayTimeout;
    owl.on("dragged.owl.carousel", function () {
        owl.trigger("stop.owl.autoplay");
        clearTimeout(autoplayTimeout);
        autoplayTimeout = setTimeout(() => {
            owl.trigger("play.owl.autoplay", [5000]);
        }, 100);
    });
    function updateDots(event) {
        const totalItems = event.item.count;
        const dotsContainer = jQuery(".featured-insights .owl-carousel .owl-dots");
        const navContainer = jQuery(".featured-insights .owl-carousel .owl-nav");
        if (totalItems <= 3) {
            dotsContainer.removeClass('disabled');
            navContainer.removeClass('disabled');
        }
    }
});

//  DESCRIPTION:banner Awards and Recognition

jQuery(document).ready(function ($) {
    const items = document.querySelectorAll(".newshub-page-item");
    const shownav = window.innerWidth <= 1024 || items.length > 4;
    const itemsCountisMoreThanFour = items.length > 4;
    const isSmallScreen = window.innerWidth < 1024;
    const $newshubCarousel = $(".newshub-page-carousel");

    $newshubCarousel.owlCarousel({
        loop: isSmallScreen,
        autoplay: false,
        mouseDrag: false,
        touchDrag: true,
        nav: shownav,
        smartSpeed: 800,
        dotsEach: true,
        margin: 32,
        stagePadding: 0,
        center: false,
        responsive: {
            1025: {
                items: 4,
                nav: shownav,
                dots: false,
            },
            768: {
                items: window.matchMedia("(orientation: portrait)").matches ?
                    2.165 : 4,
                loop: window.matchMedia("(orientation: portrait)").matches ? true : itemsCountisMoreThanFour,
                center: window.matchMedia("(orientation: portrait)").matches ? true : false,
                autoplay: false,
                dots: true,
            },
            0: {
                items: 1.42,
                loop: true,
                center: true,
                autoplay: false,
                dots: true,
                margin: 24,
            },
        },
    });

    function updateNewshubCarouselResponsive($carousel) {
        const newResponsive = {
            0: {
                items: 1.42,
                loop: true,
                center: true,
                autoplay: false,
                dots: true,
                margin: 24,
            },
            768: {
                items: window.matchMedia("(orientation: portrait)").matches ?
                    2.165 : 4,
                loop: window.matchMedia("(orientation: portrait)").matches ? true : itemsCountisMoreThanFour,
                center: window.matchMedia("(orientation: portrait)").matches ? true : false,
                autoplay: false,
                dots: true,
            },
            1025: {
                items: 4,
                nav: shownav,
                dots: false,
            },
        };

        jQuery($newshubCarousel).data("owl.carousel").options.responsive =
            newResponsive;
        jQuery($newshubCarousel).trigger("refresh.owl.carousel");

    }

    let resizeTimeout;
    jQuery(window).on("resize  orientationchange", function () {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(updateNewshubCarouselResponsive, 300); // Debounced resizing
    });
});

//  DESCRIPTION:banner Social
//  DESCRIPTION:banner Spacers