// DESCRIPTION:Banner


// DESCRIPTION:meet our leaders
document.addEventListener("DOMContentLoaded", function () {
    let category = "";
    const selector_buttons = document.querySelectorAll(".meet-our-leaders .button-container button");
    const firstButton = selector_buttons[0];
    if (firstButton) {
        category = firstButton.textContent.trim();
        firstButton.classList.add("active");
    }
    const popupModal = document.querySelector(".meet-our-leaders #popup-modal");
    const popupImg = document.querySelector(".meet-our-leaders #popup-img");
    const popupName = document.querySelector(".meet-our-leaders #popup-name");
    const popupDesignation = document.querySelector(".meet-our-leaders #popup-designation");
    const popupDescription = document.querySelector(".meet-our-leaders #popup-description");
    const popupAuthor = document.querySelector(".meet-our-leaders #popup-author");
    const popupLinkedIn = document.querySelector(".meet-our-leaders #popup-linkedin");
    const closePopup = document.querySelector(".meet-our-leaders #close-popup");

    const itemsPerPageDesktop = 8;
    const itemsPerPageMobile = 4;
    let currentPage = 0;
    let currentPageMobile = {};

    selector_buttons.forEach(button => {
        let categoryName = button.textContent.trim();
        currentPageMobile[categoryName] = 0;
    });


    function renderGrid(selectedCategory = null) {
        const width = window.innerWidth;
        const isPortrait = window.matchMedia("(orientation: portrait)").matches;
        let isMobile = false;
        if (width <= 767) {
            isMobile = true;
        } else if (width <= 1024) {
            if (isPortrait) {
                isMobile = true;
            }
        }


        if (isMobile) {
            const gridContainer = document.querySelector(".meet-our-leaders #grid-container");
            gridContainer.innerHTML = "";
            gridContainer.className = "";
            // Show all categories one below the other in mobile view
            selector_buttons.forEach(button => {
                // Create grid container
                const grid = document.createElement("div");
                grid.className = "grid";
                // category = button.getAttribute("data-category");
                category = button.textContent.trim();
                grid.setAttribute("data-category", category);
                const heading = document.createElement("h2");
                heading.classList.add("medium-size", "font-bold", "leader-category-header");
                heading.textContent = category;
                gridContainer.appendChild(heading);
                const itemsPerPage = itemsPerPageMobile;

                const mobileDotsContainer = document.createElement("div");
                mobileDotsContainer.className = "mobile-dots";
                mobileDotsContainer.setAttribute("data-category", category);
                const start = currentPageMobile[category] * itemsPerPage;
                const paginatedItems = leadersData[category].slice(start, start + itemsPerPage);
                paginatedItems.forEach(item => {
                    const card = document.createElement("div");
                    card.className = "card";
                    card.setAttribute("data-leader-note", `${item.leaderNote}`);
                    card.innerHTML = `
                        <div class="leader-hover-box">
                    <div class="leader-img">
                        <img class="manual-lazy-load" data-src="${item.img}" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3C/svg%3E" alt="${item.name}">
                        <a class="see-more font-bold underline-on-hover service-button-cta"><span class="see-more-text">See More</span></a>
                    </div>
                    <h3 class="leader-name small-size font-bold">${item.name}</h3>
                    <p class="leader-designation smaller-size font-bold">${item.designation}</p>
                    </div>
                    <p class="leader-description smallest-size">${item.description}</p>
                    <div class="cta">
                        <a href="${item.linkedin}" target="_blank" class="leader-linkedin smallest-size font-bold">${item.linkedinText}
                            <img src="/wp-content/uploads/2025/03/Vector.svg" class="linkedin">
                        </a>
                    </div>`;
                    grid.appendChild(card);
                });

                // Append category wrapper to main container
                gridContainer.appendChild(grid);

                // Add pagination dots in mobile view
                const totalPages = Math.ceil(leadersData[category].length / itemsPerPage);

                for (let i = 0; i < totalPages; i++) {
                    const dot = document.createElement("div");
                    dot.className = "dot";
                    if (i === currentPageMobile[category]) dot.classList.add("active");
                    mobileDotsContainer.appendChild(dot);
                }
                gridContainer.appendChild(mobileDotsContainer);
                if (totalPages <= 1) {
                    mobileDotsContainer.style.visibility = "hidden";
                    mobileDotsContainer.style.height = "0";
                }
                else {
                    mobileDotsContainer.style.visibility = "visible";
                    mobileDotsContainer.style.height = "";
                }


                // Attach swipe event to each grid
                attachSwipeEvents(grid, category);
                updateOnDotsClick(grid, category);
            });

            if (firstButton) {
                category = firstButton.textContent.trim();
                firstButton.classList.add("active");
            }
        }
        else {
            const gridContainer = document.querySelector(".meet-our-leaders #grid-container");

            gridContainer.innerHTML = "";
            gridContainer.className = "grid";

            const itemsPerPage = itemsPerPageDesktop;
            const start = currentPage * itemsPerPage;
            const paginatedItems = leadersData[category].slice(start, start + itemsPerPage);
            paginatedItems.forEach(item => {
                const card = document.createElement("div");
                card.className = "card";
                card.setAttribute("data-leader-note", `${item.leaderNote}`);
                card.innerHTML = `
                    <div class="leader-hover-box">
                    <div class="leader-img"><img class="manual-lazy-load" data-src="${item.img}" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3C/svg%3E" alt="${item.name}">
                        <a class="see-more font-bold underline-on-hover service-button-cta"><span class="see-more-text">See More</span></a>
                    </div>
                    <h3 class="leader-name small-size font-bold">${item.name}</h3>
                    <p class="leader-designation smaller-size font-bold">${item.designation}</p>
                    </div>
                    <p class="leader-description smallest-size">${item.description}</p>
                    <div class="cta">
                        <a href="${item.linkedin}" target="_blank" class="leader-linkedin smallest-size font-bold">${item.linkedinText}
                            <img src="/wp-content/uploads/2025/03/Vector.svg" class="linkedin">
                        </a>
                    </div>
                `;
                gridContainer.appendChild(card);
            });
            const totalPages = Math.ceil(leadersData[category].length / itemsPerPage);
            const desktopPaginationContainer = document.querySelector(".meet-our-leaders .pagination");
            if (totalPages <= 1) {
                desktopPaginationContainer.style.visibility = "hidden";

            }
            else {
                desktopPaginationContainer.style.visibility = "visible";

            }
        }
    }

    function attachSwipeEvents(grid, category) {
        let touchStartX = 0;

        grid.addEventListener("touchstart", (e) => {
            touchStartX = e.touches[0].clientX;
        });

        grid.addEventListener("touchend", (e) => {
            let touchEndX = e.changedTouches[0].clientX;
            const width = window.innerWidth;
            const isPortrait = window.matchMedia("(orientation: portrait)").matches;
            let isMobile = false;
            if (width <= 767) {
                isMobile = true;
            } else if (width <= 1024) {
                if (isPortrait) {
                    isMobile = true;
                }
            }

            if (isMobile) {
                let totalItems = leadersData[category].length;
                let itemsPerPage = itemsPerPageMobile;
                let maxPages = Math.ceil(totalItems / itemsPerPage);

                if (touchStartX - touchEndX > 50 && currentPageMobile[category] < maxPages - 1) {
                    currentPageMobile[category]++;
                    updateGridContent(grid, category, currentPageMobile[category]);
                } else if (touchEndX - touchStartX > 50 && currentPageMobile[category] > 0) {
                    currentPageMobile[category]--;
                    updateGridContent(grid, category, currentPageMobile[category]);
                }
            }
            updateDots(category, currentPageMobile[category])
        });
    }
    function updateGridContent(grid, category, page) {
        grid.innerHTML = "";

        const start = page * itemsPerPageMobile;

        const paginatedItems = leadersData[category].slice(start, start + itemsPerPageMobile);

        paginatedItems.forEach(item => {
            const card = document.createElement("div");
            card.className = "card";
            card.setAttribute("data-leader-note", `${item.leaderNote}`);
            card.innerHTML = `
                <div class="leader-hover-box">
            <div class="leader-img">
                <img class="manual-lazy-load" data-src="${item.img}" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3C/svg%3E" alt="${item.name}">
                <a class="see-more underline-on-hover service-button-cta"><span class="see-more-text">See More</span></a>
            </div>
            <h3 class="leader-name small-size font-bold">${item.name}</h3>
            <p class="leader-designation smaller-size font-bold">${item.designation}</p>
            </div>
            <p class="leader-description smallest-size">${item.description}</p>
            <div class="cta">
                <a href="${item.linkedin}" target="_blank" class="leader-linkedin smallest-size font-bold">${item.linkedinText}
                    <img src="/wp-content/uploads/2025/03/Vector.svg" class="linkedin">
                </a>
            </div>
        `;
            grid.appendChild(card);
        });
        updateDots(category, page);
    }

    function updateDots(category, page) {
        const mobileDotsContainer = document.querySelector(`.meet-our-leaders .mobile-dots[data-category="${category}"]`);
        if (!mobileDotsContainer) return;

        mobileDotsContainer.querySelectorAll(".dot").forEach((dot, index) => {
            if (index === page) {
                dot.classList.add("active");
            } else {
                dot.classList.remove("active");
            }
        });
    }
    function updateOnDotsClick(grid, category) {
        const mobileDotsContainer = document.querySelector(`.meet-our-leaders .mobile-dots[data-category="${category}"]`);
        if (!mobileDotsContainer) return;

        const dots = mobileDotsContainer.querySelectorAll(".dot");

        dots.forEach((dot, index) => {
            dot.addEventListener("click", () => {
                if (currentPageMobile[category] !== index) {
                    currentPageMobile[category] = index;
                    updateGridContent(grid, category, index);
                    updateDots(category, index);
                }
            });
        });
    }
    let scrollPosition = 0;
    function openModal(item) {

        if (!item) return;
        popupImg.src = item.img;
        popupName.textContent = item.name;
        popupDesignation.textContent = item.designation;
        popupDescription.innerHTML = item.description;
        popupAuthor.textContent = item.leaderNote;
        popupLinkedIn.href = item.linkedin;
        popupLinkedIn.innerHTML = item.linkedinText;

        popupModal.classList.add("active");
        // Save the current scroll position
        scrollPosition = window.scrollY;

        // Disable scrolling and keep the body in place
        document.body.style.position = "fixed";
        document.body.style.top = `-${scrollPosition}px`;
        document.body.style.width = "100%";

        popupModal.querySelector(".popup-body .scrollable-text").scrollTop = 0;
    }

    function closeModal() {
        popupModal.classList.remove("active");
        // Re-enable scrolling and restore the previous scroll position
        document.body.style.position = "";
        document.body.style.top = "";
        window.scrollTo(0, scrollPosition);
    }


    selector_buttons.forEach(button => {
        button.addEventListener("click", (event) => {
            selector_buttons.forEach(b => b.classList.remove("active"));
            event.target.classList.add("active");
            category = event.target.textContent.trim();
            currentPage = 0;
            renderGrid(category);
        })
    })
    closePopup.addEventListener("click", closeModal);

    popupModal.addEventListener("click", (e) => {
        if (e.target === popupModal) {
            closeModal();
        }
    });

    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("see-more") || e.target.classList.contains("see-more-text")) {
            e.preventDefault();
            const card = e.target.closest(".card");
            const img = card.querySelector(".leader-img img").src;
            const name = card.querySelector(".leader-name").textContent;
            const designation = card.querySelector(".leader-designation").textContent;
            const description = card.querySelector(".leader-description").innerHTML;
            const leaderNote = card.getAttribute("data-leader-note");
            const linkedinText = card.querySelector(".leader-linkedin");

            openModal({
                img: img,
                name: name,
                designation: designation,
                description: description,
                leaderNote: leaderNote,
                linkedin: linkedinText.href,
                linkedinText: linkedinText.innerHTML
            });
        }
    });

    document.querySelector(".meet-our-leaders #prev-btn").addEventListener("click", () => {
        if (currentPage > 0) {
            currentPage--;
            renderGrid(category);
        }
    });

    document.querySelector(".meet-our-leaders #next-btn").addEventListener("click", () => {
        const isMobile = window.innerWidth < 768;
        const itemsPerPage = isMobile ? itemsPerPageMobile : itemsPerPageDesktop;

        if ((currentPage + 1) * itemsPerPage < leadersData[category].length) {
            currentPage++;
            renderGrid(category);
        }
    });

    // Add smooth scroll to the top of the page when pagination buttons are clicked
    const leaders_pagination_buttons = document.querySelectorAll(".meet-our-leaders .pagination button")

    leaders_pagination_buttons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector('.meet-our-leaders');
            window.scrollTo({
                top: target.offsetTop,
                behavior: 'smooth'
            });
        });
    });

    // Initial Render
    renderGrid(category);
    window.addEventListener("resize", () => {
        renderGrid(category);
    });

});

// DESCRIPTION:What we believe in


// DESCRIPTION:Our Difference is Our People


// DESCRIPTION:How our people
document.addEventListener("DOMContentLoaded", function () {
    const benefitsData = {};

    wpDataService.left_images.forEach((image, index) => {
        benefitsData[`benefit-${index + 1}`] = {
            overlayText: wpDataService.left_image_overlay_texts[index] || "",
            //  imageSrc: image.guid.replace(/\\/g, ""), 
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
                autoplay: false,
                autoplayHoverpause: true,
                autoplayTimeout: 5000,
                smartSpeed: 0,
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
