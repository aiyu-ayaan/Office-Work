
// DESCRIPTION: Banner 
const navTabs = document.getElementById("navTabs");
tabs.forEach((tab, index) => {
    const li = document.createElement("li");
    li.textContent = tab;
    li.onclick = () => selectTab(li);

    if (index === 0) {
        li.classList.add("active", "small-size");  // Initially active tab
    } else {
        li.classList.add("smaller-size");
    }

    navTabs.appendChild(li);
});

const mobileTabs = document.getElementById("mobileTabs");
tabs.forEach((tab, index) => {
    const div = document.createElement("div");
    div.textContent = tab;
    div.onclick = () => selectTab(div);

    if (index === 0) {
        div.classList.add("item", "active", "small-size");  // Initially active tab
    } else {
        div.classList.add("item", "smaller-size");
    }

    mobileTabs.appendChild(div);
});

function selectTab(selectedTab) {
    // Convert selectedTab to a jQuery object
    const $selectedTab = jQuery(selectedTab);

    // Remove 'active', 'small-size' from all tabs, add 'smaller-size' to all
    jQuery("#mobileTabs .item, #navTabs li").removeClass("active small-size").addClass("smaller-size").css("width", "");

    // Add 'active' and 'small-size' to the selected tab, remove 'smaller-size'
    $selectedTab.addClass("active small-size").removeClass("smaller-size");

    // Find the index of the selected tab
    let navIndex = jQuery("#navTabs li").index(selectedTab);
    let mobileIndex = jQuery("#mobileTabs .item").index(selectedTab);

    // Ensure the corresponding tab gets activated
    if (navIndex !== -1) {
        jQuery("#mobileTabs .item").eq(navIndex).addClass("active small-size").removeClass("smaller-size");
    } else if (mobileIndex !== -1) {
        jQuery("#navTabs li").eq(mobileIndex).addClass("active small-size").removeClass("smaller-size");
    }

    // ✅ If the 3rd tab (index 2) is active in navTabs, set width to 20%
    if (navIndex === 2) {
        $selectedTab.css("width", "20%");
    }

    // Move the Owl Carousel to the correct position
    if (mobileIndex !== -1) {
        jQuery("#mobileTabs").trigger("to.owl.carousel", [mobileIndex, 500, true]);

        // Reset carousel transform if 1st tab selected
        if (mobileIndex === 0) {
            setTimeout(() => {
                jQuery("#mobileTabs .owl-stage").css("transform", "translate3d(0px, 0px, 0px)");
            }, 550);
        }
    }
}

jQuery(document).ready(function () {
    jQuery(".owl-stage").css("transform", "translate3d(0, 0, 0)");
    var owl = jQuery("#mobileTabs").owlCarousel({
        loop: false,
        margin: 10,
        center: true,
        dots: true,
        nav: false,
        autoplay: false,
        smartSpeed: 500,
        responsive: {
            0: { items: 1.5, stagePadding: 24 },
            768: { items: 2.5, stagePadding: 40 },
            1281: { items: 4 },
        },
        onInitialized: function (event) {
            jQuery(".owl-stage").css("transform", "");
            jQuery(".owl-dots").insertAfter(jQuery(".right-section iframe"));
            attachDotClickHandler();
        },
        onChanged: function (event) {
            let currentIndex = event.item.index;
            activateTabByIndex(currentIndex);
        }
    });

    // Prevent scrolling when clicking on carousel items or dots
    jQuery("#mobileTabs").on("translated.owl.carousel", function (event) {
        var activeTab = jQuery("#mobileTabs .owl-item.active .item").first();

        if (activeTab.length) {
            // Remove or modify scrollIntoView to prevent auto-scrolling
            activeTab[0].scrollIntoView({
                behavior: "instant", // No smooth scrolling
                block: "nearest", // Prevent full centering
                inline: "nearest",
            });
        }
    });

    // Stop scrolling when clicking on carousel items or dots
    jQuery("#mobileTabs .item, .owl-dots button").on("click", function (event) {
        //    event.stopPropagation(); // Prevents triggering the scrollIntoView effect
    });
});


jQuery(document).ready(function () {
    // Check if the page was loaded using the back button
    if (performance.getEntriesByType("navigation")[0]?.type === "back_forward") {
        window.location.reload(); // Reload the page to reset form
    }

    // Prevent back button navigation
    history.pushState(null, "", location.href);
    window.onpopstate = function () {
        history.pushState(null, "", location.href);
    };
});
function activateTabByIndex(index) {
    const $tabs = jQuery("#mobileTabs .item");
    const $navTabs = jQuery("#navTabs li");

    // Remove active from all tabs
    $tabs.removeClass("active small-size").addClass("smaller-size");
    $navTabs.removeClass("active small-size").addClass("smaller-size");

    // Activate current index tab
    $tabs.eq(index).addClass("active small-size").removeClass("smaller-size");
    $navTabs.eq(index).addClass("active small-size").removeClass("smaller-size");

    if (index === 0) {
        setTimeout(() => {
            jQuery("#mobileTabs .owl-stage").css("transform", "translate3d(0px, 0px, 0px)");
        }, 550);
    }
}
function attachDotClickHandler() {
    jQuery(".owl-dot").each(function (index) {
        jQuery(this).off("click").on("click", function (e) {
            e.preventDefault();
            jQuery("#mobileTabs").trigger("to.owl.carousel", [index, 500]);
            activateTabByIndex(index); // Sync tab activation
        });
    });
}

window.addEventListener('pageshow', function (event) {
    if (event.persisted) {
        // Page was restored from bfcache (e.g., after hitting back button)
        // Force a full reload so iframe reinitializes
        window.location.reload();
    }
});

// DESCRIPTION:Worldwide offices Section

jQuery(document).ready(function () {
    var worldwide_offices_owl = jQuery(
        ".worldwide-offices-section .owl-carousel"
    );
    function initializeOfferingsCarousel() {
        worldwide_offices_owl.owlCarousel({
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
                435: {
                    margin: 32,
                    stagePadding: window.matchMedia("(orientation: portrait)").matches
                        ? 30
                        : 24,
                    items: 1.5,
                    nav: false,
                    dots: true,
                    loop: true,
                    dotsEach: 1,
                },
                500: {
                    margin: 31,
                    stagePadding: window.matchMedia("(orientation: portrait)").matches
                        ? 31
                        : 24,
                    items: 1.5,
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
                    dots: true,
                    loop: true,
                    dotsEach: 1,
                },
                770: {
                    margin: window.matchMedia("(orientation: portrait)").matches
                        ? 40
                        : 30,
                    stagePadding: window.matchMedia("(orientation: portrait)").matches
                        ? 40
                        : 30,
                    items: window.matchMedia("(orientation: portrait)").matches
                        ? 2.19
                        : 4,
                    nav: false,
                    dots: true,
                    dotsEach: 1,
                    loop: true,
                },
                1010: {
                    margin: window.matchMedia("(orientation: portrait)").matches
                        ? 40
                        : 60,
                    stagePadding: window.matchMedia("(orientation: portrait)").matches
                        ? 40
                        : 40,
                    items: window.matchMedia("(orientation: portrait)").matches
                        ? 2.19
                        : 4,
                    nav: false,
                    dots: true,
                    dotsEach: 1,
                    loop: true,
                },
                1025: {
                    margin: 76,
                    stagePadding: 40,
                },
                1300: {
                    margin: 150,
                    stagePadding: 45,
                },
                1440: {
                    margin: 180,
                    stagePadding: 55,
                },
                1650: {
                    margin: 192,
                    stagePadding: 64,
                },
            },
        });
        updateActiveItem();
        detectUserContinentAndSetActive();
    }

    function updateActiveItem() {
        jQuery(".worldwide-offices-section .owl-carousel .owl-item .item")
            .removeClass("current small-size font-bold")
            .addClass("smaller-size");
        var newActiveItem = jQuery(
            ".worldwide-offices-section .owl-carousel .owl-item.active"
        )
            .first()
            .find(".item");
        newActiveItem
            .addClass("current small-size font-bold")
            .removeClass("smaller-size");
        updateContent(newActiveItem);
    }

    function updateContent(activeItem) {
        const region = activeItem.data("region");
        const officeListContainer = jQuery(
            ".worldwide-offices-section .content-box .office-list"
        );

        // Clear existing office cards
        officeListContainer.empty();

        // Get the region-specific office data
        const offices = officeData[region];

        if (offices) {
            offices.forEach(function (office) {
                const officeCard = `
                <div class="office-card">
              <div style="background: linear-gradient(0deg, rgba(67, 102, 143, 0.14) 6.25%, rgba(5, 9, 14, 0.52) 74.78%), url(data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 5'%3E%3C/svg%3E) lightgray no-repeat; background-size: cover; background-position: center;" class="office-image manual-lazy-load"  data-src="${office.officePhoto}">
                <div class="office-city medium-size font-bold">${office.officeCity}</div>
                </div>
                  <div class="office-details">
                    <h3 class="office-country smallest-size">${office.officeCountry}</h3>
                    <p class="office-address smaller-size">${office.officeAddress}</p>
                    <p class="office-phone smaller-size">${office.officePhone}</p>
                  </div>
                </div>
              `;
                officeListContainer.append(officeCard);
            });
        }
        jQuery(".worldwide-offices-section .content-box").removeClass("fade-up");
        jQuery(".worldwide-offices-section .content-box").addClass("fade-up");
    }
    // Function to detect user's continent and apply the "current" class


    function detectUserContinentAndSetActive() {
        try {
            const userContinent = window.geoData?.continent || 'Europe';
            const region = determineRegion(userContinent);
            const defaultRegion = "uk_europe";
            const targetRegion = region || defaultRegion;

            jQuery(".worldwide-offices-section .owl-carousel .item")
                .removeClass("current small-size font-bold")
                .addClass("smaller-size");

            const regionItem = jQuery(
                `.worldwide-offices-section .owl-carousel .item[data-region="${targetRegion}"]`
            );

            regionItem
                .addClass("current small-size font-bold")
                .removeClass("smaller-size");

            updateContent(regionItem);
        } catch (error) {
            console.error("Error detecting user location:", error);

            const fallbackItem = jQuery(
                ".worldwide-offices-section .owl-carousel .item[data-region='uk_europe']"
            );
            fallbackItem
                .addClass("current small-size font-bold")
                .removeClass("smaller-size");

            updateContent(fallbackItem);
        }
    }

    // Helper function to fallback
    function setDefaultRegion() {
        const defaultRegionItem = jQuery(
            ".worldwide-offices-section .owl-carousel .item[data-region='uk_europe']"
        );
        defaultRegionItem
            .addClass("current small-size font-bold")
            .removeClass("smaller-size");

        updateContent(defaultRegionItem);
    }


    // Function to map the continent to a region
    function determineRegion(continent) {
        const continentMapping = {
            Asia: "asia",
            Europe: "uk_europe",
            "North America": "north_america",
            "South America": "latin_america",
        };

        return continentMapping[continent] || "uk_europe";
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
            435: {
                margin: 32,
                stagePadding: isPortrait ? 30 : 24,
                items: 1.5,
                nav: false,
                dots: true,
                loop: true,
                dotsEach: 1,
            },
            500: {
                margin: 32,
                stagePadding: isPortrait ? 31 : 24,
                items: 1.5,
                nav: false,
                dots: true,
                loop: true,
                dotsEach: 1,
            },
            768: {
                items: isPortrait ? 2.19 : 4,
                margin: 40,
                stagePadding: 40,
                nav: false,
                dots: true,
                dotsEach: 1,
                loop: true,
            },
            770: {
                margin: isPortrait ? 40 : 30,
                stagePadding: isPortrait ? 40 : 30,
                items: isPortrait ? 2.19 : 4,
                nav: false,
                dots: true,
                dotsEach: 1,
                loop: true,
            },
            1010: {
                margin: isPortrait ? 40 : 60,
                stagePadding: isPortrait ? 40 : 40,
                items: isPortrait ? 2.19 : 4,
                nav: false,
                dots: true,
                dotsEach: 1,
                loop: true,
            },
            1025: {
                margin: 76,
                stagePadding: 40,
            },
            1300: {
                margin: 150,
                stagePadding: 45,
            },
            1440: {
                margin: 180,
                stagePadding: 55,
            },
            1650: {
                margin: 192,
                stagePadding: 64,
            },
        };

        jQuery(worldwide_offices_owl).trigger("refresh.owl.carousel");
        jQuery(worldwide_offices_owl).data("owl.carousel").options.responsive =
            newResponsive;
    }

    initializeOfferingsCarousel();

    jQuery(".worldwide-offices-section .owl-carousel .item").on(
        "click",
        function () {
            if (jQuery(this).hasClass("current")) return;
            jQuery(".worldwide-offices-section .owl-carousel .item")
                .removeClass("current small-size font-bold")
                .addClass("smaller-size");
            jQuery(this)
                .addClass("current small-size font-bold")
                .removeClass("smaller-size");

            updateContent(jQuery(this));

            var $carousel = jQuery(".worldwide-offices-section .owl-carousel");
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

    worldwide_offices_owl.on("changed.owl.carousel", function () {
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
        var worldwide_offices_carousel_controls = document.querySelector(
            ".worldwide-offices-section .owl-carousel .carousel-controls"
        );
        let playPauseBtn =
            worldwide_offices_carousel_controls.querySelector("#playPauseBtn");
        if (playPauseBtn) {
            playPauseBtn.remove();
        }
        moveNavButtons();
    }, 100);
    function moveNavButtons() {
        const contentBox = document.querySelector(
            ".worldwide-offices-section .content-box"
        );
        const owlNav = document.querySelector(
            ".worldwide-offices-section .carousel-controls"
        );

        if (window.innerWidth < 1025) {
            contentBox.after(owlNav);
        } else {
            setTimeout(function () {
                const carouselWrapper = document.querySelector(
                    ".worldwide-offices-section .owl-carousel"
                );
                carouselWrapper.appendChild(owlNav);
            }, 100);
        }
    }
});

