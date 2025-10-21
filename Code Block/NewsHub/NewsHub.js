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



//  DESCRIPTION:banner up and coming



//  DESCRIPTION:banner Awards and Recognition



//  DESCRIPTION:banner Social
//  DESCRIPTION:banner Spacers