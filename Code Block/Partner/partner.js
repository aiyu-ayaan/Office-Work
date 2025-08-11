// DESCRIPTION:content section
document.addEventListener("DOMContentLoaded", function () {
    const desktopItemsPerPage = 8;
    const mobileItemsPerPage = 4;
    let currentPageDesktop = 0;
    const currentPageMobile = {};

    const isMobileView = () => {
        const width = window.innerWidth;
        const isPortrait = window.matchMedia("(orientation: portrait)").matches;
        return width <= 767 || (width <= 1024 && isPortrait);
    };

    const tabButtons = document.querySelectorAll(".tab-btn");
    const allSections = document.querySelectorAll(".category-section");
    const popupModal = document.getElementById("popup-modal");
    const popupImg = document.getElementById("popup-img");
    const popupDescription = document.getElementById("popup-description");
    const closePopup = document.getElementById("close-popup");

    let activeCategory = tabButtons[0]?.dataset.category;

    tabButtons.forEach(btn => {
        const cat = btn.dataset.category;
        currentPageMobile[cat] = 0;

        btn.addEventListener("click", () => {
            tabButtons.forEach(b => b.classList.remove("active"));
            btn.classList.add("active");
            activeCategory = cat;
            currentPageDesktop = 0;
            renderGrid();
        });
    });

    function renderGrid() {
        const mobile = isMobileView();

        allSections.forEach(section => {
            const cat = section.dataset.category;
            const cards = section.querySelectorAll(".card");
            const dots = section.querySelector(".mobile-dots");

            if (mobile) {
                section.style.display = "block";
                const currentPage = currentPageMobile[cat];
                const itemsPerPage = mobileItemsPerPage;
                const totalPages = Math.ceil(cards.length / itemsPerPage);

                cards.forEach((card, index) => {
                    card.style.display =
                        index >= currentPage * itemsPerPage && index < (currentPage + 1) * itemsPerPage
                            ? "block"
                            : "none";
                });

                dots.innerHTML = "";
                for (let i = 0; i < totalPages; i++) {
                    const dot = document.createElement("div");
                    dot.className = "dot" + (i === currentPage ? " active" : "");
                    dot.addEventListener("click", () => {
                        currentPageMobile[cat] = i;
                        renderGrid();
                    });
                    dots.appendChild(dot);
                }

                dots.style.display = totalPages > 1 ? "flex" : "none";
                attachSwipeEvents(section.querySelector(".grid"), cat);
            } else {
                section.style.display = section.dataset.category === activeCategory ? "block" : "none";

                if (section.dataset.category === activeCategory) {
                    const itemsPerPage = desktopItemsPerPage;
                    const currentPage = currentPageDesktop;
                    const totalPages = Math.ceil(cards.length / itemsPerPage);

                    cards.forEach((card, index) => {
                        card.style.display =
                            index >= currentPage * itemsPerPage && index < (currentPage + 1) * itemsPerPage
                                ? "block"
                                : "none";
                    });

                    const desktopNav = document.getElementById("desktop-nav");
                    desktopNav.style.display = totalPages > 1 ? "flex" : "none";
                }
            }
        });
    }

    function attachSwipeEvents(wrapper, category) {
        if (wrapper.dataset.swipeAttached === "true") return;

        let startX = 0;
        let endX = 0;

        wrapper.addEventListener("touchstart", e => {
            startX = e.touches[0].clientX;
        });

        wrapper.addEventListener("touchend", e => {
            endX = e.changedTouches[0].clientX;
            const diffX = endX - startX;

            if (Math.abs(diffX) < 50) return;

            const cards = wrapper.querySelectorAll(".card");
            const maxPages = Math.ceil(cards.length / mobileItemsPerPage);
            let currentPage = currentPageMobile[category];

            if (diffX < 0 && currentPage < maxPages - 1) {
                currentPageMobile[category]++;
                renderGrid();
            } else if (diffX > 0 && currentPage > 0) {
                currentPageMobile[category]--;
                renderGrid();
            }
        });

        wrapper.dataset.swipeAttached = "true";
    }
    let scrollPosition = 0;
    function openModal({ img, description }) {
        popupImg.src = img;
        popupDescription.innerHTML = description;
        popupModal.classList.add("active");
        scrollPosition = window.scrollY;
        document.body.style.position = "fixed";
        document.body.style.top = `-${scrollPosition}px`;
        document.body.style.width = "100%";
        popupModal.querySelector(".popup-body .scrollable-text").scrollTop = 0;
    }

    function closeModal() {
        popupModal.classList.remove("active");
        document.body.style.position = "";
        document.body.style.top = "";
        window.scrollTo(0, scrollPosition);
    }

    closePopup.addEventListener("click", closeModal);
    popupModal.addEventListener("click", e => {
        if (e.target === popupModal) closeModal();
    });

    document.addEventListener("click", e => {
        if (e.target.closest(".see-more")) {
            const card = e.target.closest(".card");
            openModal({
                img: card.querySelector("img").src,
                description: card.querySelector(".partner-description").innerHTML
            });
        }
    });
    document.getElementById("prev-btn").addEventListener("click", () => {
        if (currentPageDesktop > 0) {
            currentPageDesktop--;
            renderGrid();
            scrollToTop();
        }
    });
    document.getElementById("next-btn").addEventListener("click", () => {
        const cards = document.querySelectorAll(`.category-section[data-category="${activeCategory}"] .card`);
        const totalItems = cards.length;
        const maxPages = Math.ceil(totalItems / desktopItemsPerPage);
        if (currentPageDesktop < maxPages - 1) {
            currentPageDesktop++;
            renderGrid();
            scrollToTop();
        }
    });
    function scrollToTop() {
        const target = document.querySelector('.partners-section');
        window.scrollTo({ top: target.offsetTop, behavior: 'smooth' });
    }
    renderGrid();
    window.addEventListener("resize", renderGrid);
});


// DESCRIPTION:circle image section


// DESCRIPTION:background gradient


// DESCRIPTION:spacers css