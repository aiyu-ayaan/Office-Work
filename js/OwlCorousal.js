document.addEventListener('DOMContentLoaded', function () {

    const svg_prev = `<svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none">
<g id="Icon button desktop Laptop tablet Mobile menu"><circle id="Ellipse 14" cx="16" cy="16" r="16" transform="matrix(-1 0 0 1 33 1)" stroke="#00CCFF" stroke-width="2"/><path id="Arrow 2" d="M25 16C25.5523 16 26 16.4477 26 17C26 17.5523 25.5523 18 25 18L25 16ZM8.29289 17.7071C7.90237 17.3166 7.90237 16.6834 8.29289 16.2929L14.6569 9.92893C15.0474 9.53841 15.6805 9.53841 16.0711 9.92893C16.4616 10.3195 16.4616 10.9526 16.0711 11.3431L10.4142 17L16.0711 22.6569C16.4616 23.0474 16.4616 23.6805 16.0711 24.0711C15.6805 24.4616 15.0474 24.4616 14.6569 24.0711L8.29289 17.7071ZM25 18L9 18L9 16L25 16L25 18Z" stroke-width="0"/></g></svg>`
    const svg_next = `<svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none"><g id="Navigation Desktop &amp; laptop"><circle id="Ellipse 13" cx="17" cy="17" r="16" stroke="#00CCFF" stroke-width="2"/><path id="Arrow 3" d="M9 16C8.44772 16 8 16.4477 8 17C8 17.5523 8.44772 18 9 18L9 16ZM25.7071 17.7071C26.0976 17.3166 26.0976 16.6834 25.7071 16.2929L19.3431 9.92893C18.9526 9.53841 18.3195 9.53841 17.9289 9.92893C17.5384 10.3195 17.5384 10.9526 17.9289 11.3431L23.5858 17L17.9289 22.6569C17.5384 23.0474 17.5384 23.6805 17.9289 24.0711C18.3195 24.4616 18.9526 24.4616 19.3431 24.0711L25.7071 17.7071ZM9 18L25 18L25 16L9 16L9 18Z" stroke-width="0"/></g></svg>`
    const svg_pause = `<svg class="ic-pause" xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none"><circle cx="16" cy="16" r="16" transform="matrix(-1 0 0 1 33 1)" stroke="#00CCFF" stroke-width="2"/><path d="M25 17.0745L13 9L13 25L25 17.0745Z" stroke-width="2" stroke-miterlimit="10" stroke-linejoin="round"/></svg>`
    const svg_play = `<svg class="ic-play" xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none"><circle cx="16" cy="16" r="16" transform="matrix(-1 0 0 1 33 1)" stroke="#00CCFF" stroke-width="2"/><line x1="13" y1="9" x2="13" y2="25" stroke-width="2" stroke-linecap="round"/><line x1="21" y1="9" x2="21" y2="25" stroke-width="2" stroke-linecap="round"/>`


    function setupInstagramDots(carousel) {
        const dots = carousel.querySelector('.owl-dots');
        if (!dots) return;

        const allDots = dots.querySelectorAll('.owl-dot');
        const totalSlides = allDots.length;
        const maxVisibleDots = 5;

        // Add scrollable class if more than 5 slides
        if (totalSlides > maxVisibleDots) {
            dots.classList.add('scrollable-dots');

            // Hide all dots initially
            allDots.forEach(dot => {
                dot.style.display = 'none';
            });
        }

        function updateDotsAppearance() {
            const activeDot = dots.querySelector('.owl-dot.active');
            if (!activeDot) return;

            const activeIndex = Array.from(allDots).indexOf(activeDot);

            if (totalSlides > maxVisibleDots) {
                // Calculate which dots to show (max 5)
                let startIndex, endIndex;

                if (activeIndex <= 2) {
                    startIndex = 0;
                    endIndex = maxVisibleDots - 1;
                } else if (activeIndex >= totalSlides - 3) {
                    startIndex = totalSlides - maxVisibleDots;
                    endIndex = totalSlides - 1;
                } else {
                    startIndex = activeIndex - 2;
                    endIndex = activeIndex + 2;
                }

                // Show/hide dots based on calculated range
                allDots.forEach((dot, index) => {
                    if (index >= startIndex && index <= endIndex) {
                        dot.style.display = 'block';
                    } else {
                        dot.style.display = 'none';
                    }
                });

                // Apply size classes to visible dots
                const visibleDots = Array.from(allDots).slice(startIndex, endIndex + 1);
                const activeIndexInVisible = activeIndex - startIndex;

                visibleDots.forEach((dot, index) => {
                    // Remove all size classes
                    dot.classList.remove('adjacent', 'near', 'far');

                    const distance = Math.abs(index - activeIndexInVisible);

                    // Apply gradient sizing based on distance from active dot
                    if (distance === 1) {
                        dot.classList.add('adjacent'); // Medium-large
                    } else if (distance === 2) {
                        dot.classList.add('near'); // Medium
                    } else if (distance > 2) {
                        dot.classList.add('far'); // Smallest
                    }
                });
            } else {
                // Less than or equal to 5 dots - show all with gradient sizing
                allDots.forEach((dot, index) => {
                    dot.style.display = 'block';
                    // Remove all size classes
                    dot.classList.remove('adjacent', 'near', 'far');

                    const distance = Math.abs(index - activeIndex);

                    // Apply gradient sizing
                    if (distance === 1) {
                        dot.classList.add('adjacent'); // Medium-large
                    } else if (distance === 2) {
                        dot.classList.add('near'); // Medium  
                    } else if (distance > 2) {
                        dot.classList.add('far'); // Smallest
                    }
                });
            }
        }

        // Initial setup
        updateDotsAppearance();

        // Update on carousel change
        jQuery(carousel).on('changed.owl.carousel', function () {
            setTimeout(updateDotsAppearance, 50);
        });
    }



    function addCustomControls(carousel) {
        let isPlaying = true;

        const carouselControls = document.createElement('div');
        carouselControls.className = 'carousel-controls';
        const playPauseButton = document.createElement('button');
        playPauseButton.id = 'playPauseBtn';
        playPauseButton.innerHTML = svg_play;
        carouselControls.appendChild(playPauseButton);
        let navButtonsWrap = carousel.querySelector('.owl-nav');
        let navButtons = carousel.querySelectorAll('.owl-nav button');
        if (navButtons.length > 0) {
            navButtons.forEach(button => {
                if (button.classList.contains('owl-next')) {
                    button.innerHTML = svg_next;
                } else if (button.classList.contains('owl-prev')) {
                    button.innerHTML = svg_prev;
                }
            });
        }
        carouselControls.appendChild(navButtonsWrap);
        let dots = carousel.querySelector('.owl-dots');
        if (dots) {
            carouselControls.appendChild(dots);
            dots.addEventListener('click', function (event) {
                if (event.target && event.target.classList.contains('owl-dot')) {
                    event.preventDefault();
                    event.stopPropagation();
                }
            });
        }
        carousel.appendChild(carouselControls);
        playPauseButton.addEventListener('click', () => {
            const carouselInstance = jQuery(carousel)
            if (isPlaying) {
                playPauseButton.innerHTML = svg_pause;
                carouselInstance.trigger("stop.owl.autoplay");
            } else {
                playPauseButton.innerHTML = svg_play;
                carouselInstance.trigger("play.owl.autoplay");
            }
            isPlaying = !isPlaying;
        });
    }
    function observeCarouselChanges(carousel) {
        const observer = new MutationObserver(() => {
            addCustomControls(carousel);
            setupInstagramDots(carousel);
            observer.disconnect();
        });
        observer.observe(carousel, { childList: true, subtree: true });
    }
    jQuery('.owl-carousel').on('initialized.owl.carousel', function (event) {
        const carousel = event.target;
        observeCarouselChanges(carousel);
    });
});

document.getElementById('ast-scroll-top').innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none"><path d="M16 25C16 25.5523 16.4477 26 17 26C17.5523 26 18 25.5523 18 25L16 25ZM17.7071 8.29289C17.3166 7.90237 16.6834 7.90237 16.2929 8.29289L9.92893 14.6569C9.53841 15.0474 9.53841 15.6805 9.92893 16.0711C10.3195 16.4616 10.9526 16.4616 11.3431 16.0711L17 10.4142L22.6569 16.0711C23.0474 16.4616 23.6805 16.4616 24.0711 16.0711C24.4616 15.6805 24.4616 15.0474 24.0711 14.6569L17.7071 8.29289ZM18 25L18 9L16 9L16 25L18 25Z" fill="#1A2C47"></path></svg>';
