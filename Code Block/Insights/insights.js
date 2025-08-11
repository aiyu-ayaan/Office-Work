// DESCRIPTION:banner-section

const insight_carousel = jQuery(".owl-carousel.insights-container");

jQuery(document).ready(function () {
    // console.log("hello",insight_carousel)
    insight_carousel.owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        dots: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        responsive: {
            0: { items: 1 },
            768: { items: 1 },
            1025: { items: 1 }
        }
    });
});

// DESCRIPTION:filter-section

jQuery(document).ready(function () {
    jQuery('.dropdown-btn').click(function (e) {
        e.stopPropagation();
        let dropdown = jQuery(this).next('.dropdown-content');
        let icon = jQuery(this).find('.dropdown-icon'); // Select the SVG icon

        // Close other dropdowns and reset icons
        jQuery('.dropdown-content').not(dropdown).slideUp();
        jQuery('.dropdown-btn .dropdown-icon').not(icon).removeClass('rotate');

        // Toggle dropdown and rotate icon
        dropdown.slideToggle();
        icon.toggleClass('rotate');
    });

    // Prevent dropdown from closing when clicking inside it
    jQuery('.dropdown-content').click(function (e) {
        e.stopPropagation();
    });

    // Close dropdown when clicking outside
    jQuery(document).click(function () {
        jQuery('.dropdown-content').slideUp();
        jQuery('.dropdown-btn .dropdown-icon').removeClass('rotate'); // Reset icon when dropdown closes
    });
});


// Open Modal & Change SVG Color
let scrollPosition = 0;

function openFilterModal() {
    const modal = document.getElementById("filterModal");
    const filterBtn = document.querySelector(".filter-btn");

    // Save the current scroll position
    scrollPosition = window.scrollY;

    // Disable scrolling and keep the body in place
    document.body.style.position = "fixed";
    document.body.style.top = `-${scrollPosition}px`;
    document.body.style.width = "100%";

    // Show the modal
    modal.style.display = "flex";
    modal.style.position = "fixed";
    modal.style.left = "50%";
    modal.style.transform = "translateX(-50%)";
}



// Function to close modal and re-enable scrolling
function closeFilterModal() {
    const modal = document.getElementById("filterModal");

    // Hide the modal
    modal.style.display = "none";

    // Re-enable scrolling and restore the previous scroll position
    document.body.style.position = "";
    document.body.style.top = "";
    window.scrollTo(0, scrollPosition);

    jQuery('.filter-content').slideUp(); // Collapse all dropdown contents
    jQuery('.dropdown-icon').removeClass('rotate');
}

jQuery(document).ready(function () {
    jQuery(".filter-option").click(function (event) {
        // Prevent closing if clicking inside a checkbox
        if (jQuery(event.target).is("input")) {
            return;
        }

        var content = jQuery(this).find(".filter-content");
        var icon = jQuery(this).find("svg");

        // Close all other filter contents except the one clicked
        jQuery(".filter-content").not(content).slideUp().removeClass("active");
        jQuery(".filter-option svg").not(icon).removeClass("rotate");

        jQuery(".filter-content").click(function (e) {
            e.stopPropagation(); // Prevent click from bubbling up
        });

        // Toggle clicked filter content
        content.slideToggle().toggleClass("active");
        icon.toggleClass("rotate");
    });

    // Function to open modal

    // Attach close function to button
    jQuery(".close-btn").click(closeFilterModal);
});

jQuery(document).ready(function ($) {
    $.ajax({
        url: "/wp-content/filter-options.php",
        type: "GET",
        dataType: "json",
        success: function (response) {
            if (response) {
                // Populate Services
                let servicesContainer = $("#modal-services-filters");
                servicesContainer.empty();
                response.services.forEach(service => {
                    servicesContainer.append(`
                        <label><input class="smaller-size" type="checkbox" value="${service.toLowerCase()}"> ${service}</label>
                    `);
                });

                // Populate Industries
                let industriesContainer = $("#modal-industries-filters");
                industriesContainer.empty();
                response.industries.forEach(industry => {
                    industriesContainer.append(`
                        <label><input class="smaller-size" type="checkbox" value="${industry.toLowerCase()}"> ${industry}</label>
                    `);
                });

                // Populate Content Types
                let contentTypesContainer = $("#modal-content-type-filter");
                contentTypesContainer.empty();
                response.contentTypes.forEach(contentType => {
                    contentTypesContainer.append(`
                        <label><input class="smaller-size" type="checkbox" value="${contentType.toLowerCase()}"> ${contentType}</label>
                    `);
                });

            } else {
                console.error("Empty response received");
            }
        },
        error: function (xhr, status, error) {
            console.error("Error fetching data:", error);
        }
    });
});

jQuery(document).ready(function () {
    jQuery(".close-btn").click(closeFilterModal); // Close on cross icon click
    jQuery(".filter-now-btn").click(closeFilterModal); // Close on "Filter Now" button click
});


// DESCRIPTION:post-display-section

jQuery(document).ready(function () {
    let postsPerPage = getPostsPerPage();
    let currentPage = 1;
    let totalPages = 1;
    let selectedFilters = {}; // Store filters persistently
    let previousScreenCategory = getScreenCategory();
    let searchActive = false; // Track if search is active

    jQuery('#clearAllBtn').click(function () {
        // Uncheck all checkboxes within the modal
        jQuery('.filter-content input[type=checkbox]').prop('checked', false);

        // Call the defaultPost() function after clearing filters
        fetchDefaultPosts();
    });

    // Function definitions
    function getScreenCategory() {
        let width = window.innerWidth;
        if (width >= 1025) return "desktop";
        if (width >= 768) return "tablet";
        return "mobile";
    }

    function getPostsPerPage() {
        let width = window.innerWidth;
        let height = window.innerHeight;
        let isLandscape = width > height;

        if (width >= 1025 || (width >= 768 && isLandscape)) return 6;
        if (width >= 768) return 4;
        return 3;
    }

    function fetchDefaultPosts(page = 1) {
        postsPerPage = getPostsPerPage();
        currentPage = page;

        jQuery("#loading-overlay").fadeIn(); // Show loader

        jQuery.ajax({
            url: "/wp-admin/admin-ajax.php?action=fetch_posts",
            type: "GET",
            data: { page: page, postsPerPage: postsPerPage },
            dataType: "json",
            success: function (data) {
                totalPages = data.totalPages || 1;
                setupPagination(totalPages, false);
                let postsToDisplay = page === 1 ? [...data.featured_posts, ...data.regular_posts] : data.regular_posts;
                displayPosts(postsToDisplay);

                jQuery("#loading-overlay").fadeOut(); // Hide loader
            },
            error: function (xhr) {
                console.error("Error fetching posts:", xhr.responseText);
                jQuery("#loading-overlay").fadeOut(); // Hide loader on error
            }
        });
    }


    jQuery(document).ready(function ($) {
        $.ajax({
            url: "/wp-content/filter-options.php",
            type: "GET",
            dataType: "json",
            success: function (response) {
                if (response) {
                    // Populate Services
                    let servicesContainer = $("#services-filters");
                    servicesContainer.empty();
                    response.services.forEach(service => {
                        servicesContainer.append(`
                        <label><input class="smaller-size" type="checkbox" value="${service.toLowerCase()}"> ${service}</label>
                    `);
                    });
                    /*  servicesContainer.append(`
                          <button class="clear-all-btn" data-target="services-filters" onclick="clearAllCheckboxes(this)">Clear All
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                  <path d="M1 1L15 15" stroke="white" stroke-width="2" stroke-linecap="round"/>
                                  <path d="M1 15L15 0.999997" stroke="white" stroke-width="2" stroke-linecap="round"/>
                              </svg>
                          </button>
                      `); */

                    // Populate Industries
                    let industriesContainer = $("#industries-filters");
                    industriesContainer.empty();
                    response.industries.forEach(industry => {
                        industriesContainer.append(`
                        <label><input class="smaller-size" type="checkbox" value="${industry.toLowerCase()}"> ${industry}</label>
                    `);
                    });
                    /*  industriesContainer.append(`
                          <button class="clear-all-btn" data-target="industries-filters" onclick="clearAllCheckboxes(this)">Clear All
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                  <path d="M1 1L15 15" stroke="white" stroke-width="2" stroke-linecap="round"/>
                                  <path d="M1 15L15 0.999997" stroke="white" stroke-width="2" stroke-linecap="round"/>
                              </svg>
                          </button>
                      `);  */

                    // Populate Content Types
                    let contentTypesContainer = $("#content-type-filter");
                    contentTypesContainer.empty();
                    response.contentTypes.forEach(contentType => {
                        contentTypesContainer.append(`
                        <label><input class="smaller-size" type="checkbox" value="${contentType.toLowerCase()}"> ${contentType}</label>
                    `);
                    });
                    /* contentTypesContainer.append(`
                         <button class="clear-all-btn" data-target="content-type-filter" onclick="clearAllCheckboxes(this)">Clear All
                             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                 <path d="M1 1L15 15" stroke="white" stroke-width="2" stroke-linecap="round"/>
                                 <path d="M1 15L15 0.999997" stroke="white" stroke-width="2" stroke-linecap="round"/>
                             </svg>
                         </button>
                     `); */

                } else {
                    console.error("Empty response received");
                }
            },
            error: function (xhr, status, error) {
                console.error("Error fetching data:", error);
            }
        });
        // window.clearAllCheckboxes = clearAllCheckboxes;
    });

    function collectSelectedFilters(isMobile = false) {
        // console.log("Storing filter options before sending request...");
        let newFilters = {};
        let filterPrefix = isMobile ? "#modal-" : "#";

        function collectFilters(filterKey, selector) {
            let values = jQuery(`${filterPrefix}${selector} input:checked`).map(function () {
                return jQuery(this).val();
            }).get();
            if (values.length > 0) {
                newFilters[filterKey] = values;
            }
        }

        collectFilters("services", "services-filters");
        collectFilters("industries", "industries-filters");
        collectFilters("contentType", "content-type-filter");

        if (jQuery.isEmptyObject(newFilters)) {
            //  console.warn("No filters selected, resetting...");
            return {};
        }
        return newFilters;
    }

    function sendFilterRequest(isMobile = false, page = 1) {
        selectedFilters.postsPerPage = getPostsPerPage();
        selectedFilters.page = page;
        currentPage = page;

        if (jQuery.isEmptyObject(selectedFilters)) {
            //  console.warn("No filters applied, fetching default posts.");
            fetchDefaultPosts();
            return;
        }

        // console.log("Applying filters with stored options:", selectedFilters);
        jQuery("#loading-overlay").fadeIn(); // Show loader

        jQuery.ajax({
            url: "/wp-content/filter-posts.php",
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify(selectedFilters),
            dataType: "json",
            success: function (data) {
                //  console.log("Filtered posts received:", data);
                if (!data || !Array.isArray(data.posts)) {
                    console.error("Invalid response format:", data);
                    return;
                }
                totalPages = data.totalPages || 1;
                setupPagination(totalPages, true);
                displayPosts(data.posts);
                if (isMobile) closeFilterModal();
                jQuery("#loading-overlay").fadeOut(); // Hide loader
                jQuery('html, body').animate({
                    scrollTop: jQuery("#postGrid").offset().top - 100
                }, 400);

            },
            error: function (xhr) {
                console.error("Error:", xhr.responseText);
                jQuery("#loading-overlay").fadeOut();
            }
        });
    }
    /*
    function clearAllCheckboxes(button) {
        console.log("Clear All button clicked!");
        let targetId = jQuery(button).attr("data-target"); // Get the dropdown container ID
    
        if (targetId) {
            jQuery("#" + targetId)
                .find("input[type='checkbox']")
                .prop("checked", false); // Uncheck all checkboxes inside the target container
            console.log(`Cleared checkboxes in ${targetId}`);
    
            // Update the global selectedFilters object
            selectedFilters = collectSelectedFilters(false); // Assuming false for desktop mode
    
            // If no filters are selected, fetch default posts
            if (jQuery.isEmptyObject(selectedFilters)) {
                console.log("No filters selected, fetching default posts...");
                fetchDefaultPosts(1);
            } else {
                // If there are still selected filters, send the filter request
                console.log("Filters remaining after clearing:", selectedFilters);
                sendFilterRequest(false, 1);
            }
        } else {
            console.error("Clear All button is missing data-target attribute.");
        }
    }
    */
    function displayPosts(posts) {
        //   console.log("Displaying posts:", posts);
        let gridHTML = "";
        jQuery("#postGrid").empty();

        if (posts.length === 0) {
            jQuery("#postGrid").html('<p class="no-posts largest-size">No posts found.</p>');
            return;
        }


        posts.forEach(post => {
            let postImage = post.image && post.image !== false ? post.image : "/wp-content/uploads/2025/04/Service-Sub-Service-General-Our-Offerings-and-Capabilities-Texture.webp";
            gridHTML += `
                <div class="grid-item">
                    <div class="post">
                        <span class="tag">${post.post_type}</span>
                        <a href="${post.permalink}">
                           <img src="${postImage}" alt="${post.title}">
                        </a>
                        <p class="read-time">${post.read_minutes}</p>
                        <h3 class="title">
                            <a href="${post.permalink}">${post.title}<svg xmlns="http://www.w3.org/2000/svg" width="50" height="24" viewBox="0 0 50 24" fill="none">
<path d="M38 12L2 12" stroke="white" stroke-width="2" stroke-linecap="round"/>
<path d="M28.2354 12C28.2354 13.9778 28.8218 15.9112 29.9207 17.5557C31.0195 19.2002 32.5813 20.4819 34.4085 21.2388C36.2358 21.9957 38.2464 22.1937 40.1863 21.8078C42.1261 21.422 43.9079 20.4696 45.3064 19.0711C46.7049 17.6725 47.6573 15.8907 48.0432 13.9509C48.4291 12.0111 48.231 10.0004 47.4741 8.17316C46.7173 6.3459 45.4355 4.78412 43.7911 3.6853C42.1466 2.58649 40.2132 2 38.2353 2C35.5832 2 33.0396 3.05357 31.1643 4.92893C29.2889 6.8043 28.2354 9.34783 28.2354 12Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg></a>
                        </h3>
                    </div>
                </div>`;
        });

        jQuery("#postGrid").html(gridHTML);
        // Add smooth scroll to the top of the page when pagination buttons are clicked
    }

    function setupPagination(totalPages, isFiltered) {
        // console.log(`Setting up pagination: Total pages: ${totalPages}, Is filtered: ${isFiltered}`);
        let paginationHTML = "";
        let maxVisiblePages = 5; // Max pages to show at a time

        // Previous button
        paginationHTML += `<button class="page-btn prev-btn circle-btn" ${currentPage === 1 ? "disabled" : ""} data-page="${currentPage - 1}">
        <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none">
            <circle cx="16" cy="16" r="16" transform="matrix(-1 0 0 1 33 1)" stroke="white" stroke-width="2"/>
            <path d="M25 16C25.5523 16 26 16.4477 26 17C26 17.5523 25.5523 18 25 18L25 16ZM8.29289 17.7071C7.90237 17.3166 7.90237 16.6834 8.29289 16.2929L14.6569 9.92893C15.0474 9.53841 15.6805 9.53841 16.0711 9.92893C16.4616 10.3195 16.4616 10.9526 16.0711 11.3431L10.4142 17L16.0711 22.6569C16.4616 23.0474 16.4616 23.6805 16.0711 24.0711C15.6805 24.4616 15.0474 24.4616 14.6569 24.0711L8.29289 17.7071ZM25 18L9 18L9 16L25 16L25 18Z" fill="white"/>
        </svg>
    </button>`;

        let startPage = Math.max(1, currentPage - 2);
        let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

        if (startPage > 1) {
            paginationHTML += `<button class="page-btn" data-page="1">1</button>`;
            if (startPage > 2) {
                paginationHTML += `<span class="dots">...</span>`;
            }
        }

        for (let i = startPage; i <= endPage; i++) {
            paginationHTML += `<button class="page-btn ${i === currentPage ? "active" : ""}" data-page="${i}">${i}</button>`;
        }

        if (endPage < totalPages) {
            if (endPage < totalPages - 1) {
                paginationHTML += `<span class="dots">...</span>`;
            }
            paginationHTML += `<button class="page-btn" data-page="${totalPages}">${totalPages}</button>`;
        }

        // Next button
        paginationHTML += `<button class="page-btn next-btn circle-btn" ${currentPage === totalPages ? "disabled" : ""} data-page="${currentPage + 1}">
        <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none">
            <circle cx="17" cy="17" r="16" stroke="white" stroke-width="2"/>
            <path d="M9 16C8.44772 16 8 16.4477 8 17C8 17.5523 8.44772 18 9 18L9 16ZM25.7071 17.7071C26.0976 17.3166 26.0976 16.6834 25.7071 16.2929L19.3431 9.92893C18.9526 9.53841 18.3195 9.53841 17.9289 9.92893C17.5384 10.3195 17.5384 10.9526 17.9289 11.3431L23.5858 17L17.9289 22.6569C17.5384 23.0474 17.5384 23.6805 17.9289 24.0711C18.3195 24.4616 18.9526 24.4616 19.3431 24.0711L25.7071 17.7071ZM9 18L25 18L25 16L9 16L9 18Z" fill="white"/>
        </svg>
    </button>`;

        if (isFiltered) {
            jQuery("#filtered-pagination").html(paginationHTML).show();
            jQuery("#default-pagination").hide();
        } else {
            jQuery("#default-pagination").html(paginationHTML).show();
            jQuery("#filtered-pagination").hide();
        }

        jQuery(".page-btn").off("click").on("click", function () {
            let page = jQuery(this).data("page");
            if (page < 1 || page > totalPages) return;

            // console.log(`Pagination button clicked: ${page}`);

            jQuery(".page-btn").removeClass("active");
            jQuery(this).addClass("active");
            jQuery('html, body').animate({
                scrollTop: jQuery("#postGrid").offset().top - 100
            }, 300);
            if (!jQuery.isEmptyObject(selectedFilters)) {
                sendFilterRequest(false, page);
            } else {
                fetchDefaultPosts(page);
            }
        });
    }

    function closeFilterModal() {
        //  console.log("Closing filter modal");
        jQuery("#filterModal").hide();
    }

    // Search functionality
    var searchInput = jQuery("#search-input");
    var suggestionsBox = jQuery("#suggestions-box");
    var resultsContainer = jQuery("#results-container");
    var typingTimer;
    var doneTypingInterval = 300; // 300ms debounce

    searchInput.on("keyup", function (e) {
        clearTimeout(typingTimer);

        var query = jQuery(this).val().trim();
        // console.log("User typed:", query); 

        if (query.length === 0) {
            selectedFilters = {}; // Reset filters
            jQuery(".filters-container input[type='checkbox']").prop("checked", false);
            fetchDefaultPosts(1); // Load default posts if input is cleared
            suggestionsBox.hide();
            jQuery("#search-pagination").hide();
            return;
        }

        if (query.length < 3) {
            suggestionsBox.html("").hide();
            return;
        }

        typingTimer = setTimeout(function () {
            fetchSearchSuggestions(query);
        }, doneTypingInterval);

        // Fetch full results if Enter is pressed
        if (e.key === "Enter") {
            selectedFilters = {}; // Reset filters
            jQuery(".filters-container input[type='checkbox']").prop("checked", false);
            fetchAllMatchingPosts(query);
            suggestionsBox.hide();
        }
    });

    // Fetch post suggestions based on title
    function fetchSearchSuggestions(query) {
        //  console.log("Fetching suggestions for:", query); // Debugging
        jQuery.ajax({
            url: "/wp-content/search.php",
            method: "POST",
            dataType: "json",
            data: {
                action: "fetch_suggestions",
                query: query
            },
            success: function (response) {
                console.log("AJAX response:", response); // Debugging

                if (!response.success || !Array.isArray(response.data)) {
                    console.error("Unexpected response format", response);
                    return;
                }

                if (response.data.length === 0) {
                    suggestionsBox.html("<ul><li>No results found</li></ul>").show();
                    return;
                }

                var suggestionsHTML = "<ul>";
                jQuery.each(response.data, function (index, post) {
                    suggestionsHTML += `
                        <li>
                            <a href="${post.permalink}">
                                <p>${post.title}</p>
                            </a>
                        </li>`;
                });
                suggestionsHTML += "</ul>";

                suggestionsBox.html(suggestionsHTML).show();
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", status, error);
            }
        });
    }

    // Fetch all matching posts when search is used
    function fetchAllMatchingPosts(query, page = 1) {
        //  console.log("Fetching all posts for:", query, "on page:", page);

        const postsPerPage = getPostsPerPage(); // assuming you already defined this
        currentPage = page; // update the global currentPage

        jQuery("#loading-overlay").fadeIn(); // Show loader

        jQuery.ajax({
            url: "/wp-content/search.php",
            method: "POST",
            dataType: "json",
            data: {
                action: "fetch_all_matching_posts",
                query: query,
                page: page,
                postsPerPage: postsPerPage
            },
            success: function (response) {
                if (!response.success || !Array.isArray(response.data.posts)) {
                    console.error("Unexpected response format", response);
                    jQuery("#postGrid").html("<p>No matching posts found.</p>");
                    jQuery("#search-pagination").hide();
                    jQuery("#loading-overlay").fadeOut();
                    return;
                }

                const posts = response.data.posts;
                const totalPages = response.data.totalPages || 1;

                if (posts.length === 0) {
                    jQuery("#postGrid").html("<p>No matching posts found.</p>");
                    jQuery("#search-pagination").hide();
                    jQuery("#loading-overlay").fadeOut();
                    return;
                }

                searchActive = true;
                jQuery("#filtered-pagination, #default-pagination").hide();

                displayPosts(posts);
                setupSearchPagination(totalPages, query, page);

                jQuery("#loading-overlay").fadeOut();
                jQuery('html, body').animate({
                    scrollTop: jQuery("#postGrid").offset().top - 100
                }, 400);
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", status, error);
                jQuery("#loading-overlay").fadeOut(); // Hide loader on error
            }
        });
    }


    function setupSearchPagination(totalPages, query, currentPage) {
        //  console.log(`Setting up search pagination: Total pages: ${totalPages}, Current page: ${currentPage}`);
        let paginationHTML = "";
        let maxVisiblePages = 4;
        let startPage, endPage;

        if (totalPages <= maxVisiblePages) {
            startPage = 1;
            endPage = totalPages;
        } else {
            if (currentPage <= 3) {
                startPage = 1;
                endPage = maxVisiblePages;
            } else if (currentPage + 2 >= totalPages) {
                startPage = totalPages - (maxVisiblePages - 1);
                endPage = totalPages;
            } else {
                startPage = currentPage - 2;
                endPage = currentPage + 2;
            }
        }

        // Previous button
        paginationHTML += `<button class="page-btn prev-btn circle-btn" ${currentPage === 1 ? "disabled" : ""} data-page="${currentPage - 1}" data-query="${query}">
        <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none">
            <circle cx="16" cy="16" r="16" transform="matrix(-1 0 0 1 33 1)" stroke="white" stroke-width="2"/>
            <path d="M25 16C25.5523 16 26 16.4477 26 17C26 17.5523 25.5523 18 25 18L25 16ZM8.29289 17.7071C7.90237 17.3166 7.90237 16.6834 8.29289 16.2929L14.6569 9.92893C15.0474 9.53841 15.6805 9.53841 16.0711 9.92893C16.4616 10.3195 16.4616 10.9526 16.0711 11.3431L10.4142 17L16.0711 22.6569C16.4616 23.0474 16.4616 23.6805 16.0711 24.0711C15.6805 24.4616 15.0474 24.4616 14.6569 24.0711L8.29289 17.7071ZM25 18L9 18L9 16L25 16L25 18Z" fill="white"/>
        </svg>
    </button>`;

        if (startPage > 1) {
            paginationHTML += `<button class="page-btn" data-page="1" data-query="${query}">1</button>`;
            if (startPage > 2) {
                paginationHTML += `<span class="dots">...</span>`;
            }
        }

        for (let i = startPage; i <= endPage; i++) {
            paginationHTML += `<button class="page-btn ${i === currentPage ? "active" : ""}" data-page="${i}" data-query="${query}">${i}</button>`;
        }

        if (endPage < totalPages) {
            if (endPage < totalPages - 1) {
                paginationHTML += `<span class="dots">...</span>`;
            }
            paginationHTML += `<button class="page-btn" data-page="${totalPages}" data-query="${query}">${totalPages}</button>`;
        }

        // Next button
        paginationHTML += `<button class="page-btn next-btn circle-btn" ${currentPage === totalPages ? "disabled" : ""} data-page="${currentPage + 1}" data-query="${query}">
        <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none">
            <circle cx="17" cy="17" r="16" stroke="white" stroke-width="2"/>
            <path d="M9 16C8.44772 16 8 16.4477 8 17C8 17.5523 8.44772 18 9 18L9 16ZM25.7071 17.7071C26.0976 17.3166 26.0976 16.6834 25.7071 16.2929L19.3431 9.92893C18.9526 9.53841 18.3195 9.53841 17.9289 9.92893C17.5384 10.3195 17.5384 10.9526 17.9289 11.3431L23.5858 17L17.9289 22.6569C17.5384 23.0474 17.5384 23.6805 17.9289 24.0711C18.3195 24.4616 18.9526 24.4616 19.3431 24.0711L25.7071 17.7071ZM9 18L25 18L25 16L9 16L9 18Z" fill="white"/>
        </svg>
    </button>`;

        jQuery("#search-pagination").html(paginationHTML).show();

        jQuery("#search-pagination .page-btn").off("click").on("click", function () {
            const page = jQuery(this).data("page");
            const query = jQuery(this).data("query");

            if (page < 1 || page > totalPages) return;

            jQuery('html, body').animate({
                scrollTop: jQuery("#postGrid").offset().top - 100
            }, 300);

            fetchAllMatchingPosts(query, page); // Important: Pass current page explicitly again
        });
    }


    // Handle input change in search bar
    jQuery("#searchInput").on("input", function () {
        let query = jQuery(this).val().trim();

        if (query.length > 0) {
            fetchAllMatchingPosts(query);
        } else {
            searchActive = false; // Search is no longer active
            jQuery("#search-pagination").hide(); // Hide search pagination
            jQuery("#filtered-pagination, #default-pagination").show(); // Show default pagination

            if (!jQuery.isEmptyObject(selectedFilters)) {
                sendFilterRequest(false, 1); // Restore filtered posts
            } else {
                fetchDefaultPosts(); // Restore default posts
            }
        }
    });
    // Ensure search resets on filter changes
    jQuery(".filters-container").on("change", "input[type='checkbox']", function () {
        // Clear any active search state when user switches to filters
        searchActive = false;
        jQuery("#search-pagination").hide();
        jQuery("#filtered-pagination, #default-pagination").show();

        selectedFilters = collectSelectedFilters(false);

        if (jQuery.isEmptyObject(selectedFilters)) {
            fetchDefaultPosts(1);
        } else {
            sendFilterRequest(false, 1);
        }
    });


    // Handle filter button click
    jQuery(".filter-now-btn").on("click", function () {
        if (!searchActive) {
            //  console.log("Filter Now button clicked, applying filters...");
            selectedFilters = collectSelectedFilters(true);

            if (jQuery.isEmptyObject(selectedFilters)) {
                //  console.warn("No filters selected, fetching default posts.");
                fetchDefaultPosts();
            } else {
                sendFilterRequest(true, 1);
            }
        }
    });

    // Reset filters and fetch default posts when screen size changes
    jQuery(window).on("resize", function () {
        let newScreenCategory = getScreenCategory();
        if (newScreenCategory !== previousScreenCategory) {
            //  console.log(`Screen category changed from jQuery{previousScreenCategory} to jQuery{newScreenCategory}. Resetting filters.`);

            selectedFilters = {};
            jQuery(".filters-container input[type='checkbox']").prop("checked", false);

            fetchDefaultPosts();
            previousScreenCategory = newScreenCategory;
        }
    });

    // Load default posts on page load
    fetchDefaultPosts();

    // Apply filters when checkboxes change
    // jQuery(".filters-container").on("change", "input[type='checkbox']", function () {
    //     console.log("Filter changed, applying filters...");
    //     selectedFilters = collectSelectedFilters(false);
    //     sendFilterRequest(false, 1);
    // });

    // Apply filters when "Filter Now" button is clicked
    jQuery(".filter-now-btn").on("click", function () {
        //console.log("Filter Now button clicked, applying filters...");
        selectedFilters = collectSelectedFilters(true);

        if (jQuery.isEmptyObject(selectedFilters)) {
            //console.warn("No filters selected, fetching default posts.");
            fetchDefaultPosts();
            jQuery(".filter-modal").hide();
        } else {
            sendFilterRequest(true, 1);
        }
    });
});

jQuery(document).ready(function () {
    jQuery("#search-icon").on("click", function () {
        let query = jQuery("#search-input").val().trim();
        if (query.length >= 3) {
            fetchAllMatchingPosts(query);
        }
    });
});
jQuery(document).on("click", function (event) {
    const $target = jQuery(event.target);

    // If the click is NOT inside the suggestions box or the search input
    if (
        !$target.closest("#suggestions-box").length &&
        !$target.closest("#search-input").length
    ) {
        jQuery("#suggestions-box").hide();
    }
});