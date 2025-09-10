document.addEventListener('DOMContentLoaded', function () {
    // Global carousel configuration object
    window.carouselConfig = {
        dotColor: '#FFFFFF', // Default white - can be changed to any hex color
        methodCalled: false, // Track if method has been called

        // Method to set custom color
        setDotColor: function (hexColor) {
            if (!/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/.test(hexColor)) {
                console.warn('Invalid hex color provided. Using default white.');
                return false;
            }
            this.dotColor = hexColor.toUpperCase(); // Store in uppercase for consistency
            this.methodCalled = true; // Mark that method has been called
            this.updateAllCarouselDots();
            console.log(`Carousel dot color updated to: ${this.dotColor}`);
            return true;
        },

        // Helper method to convert hex to rgba
        hexToRgba: function (hex, alpha) {
            // Handle 3-character hex codes
            if (hex.length === 4) {
                hex = hex.replace(/([^#])/g, '$1$1');
            }
            const r = parseInt(hex.slice(1, 3), 16);
            const g = parseInt(hex.slice(3, 5), 16);
            const b = parseInt(hex.slice(5, 7), 16);
            return `rgba(${r}, ${g}, ${b}, ${alpha})`;
        },

        // Method to update all existing carousels
        updateAllCarouselDots: function () {
            const carousels = document.querySelectorAll('.owl-carousel');
            if (carousels.length === 0) {
                console.warn('No carousels found to update');
                return;
            }
            carousels.forEach(carousel => {
                this.applyDotColors(carousel);
            });
            console.log(`Updated ${carousels.length} carousel(s) with new dot colors`);
        },

        // Apply colors to a specific carousel
        applyDotColors: function (carousel) {
            const dots = carousel.querySelectorAll('.owl-dot');
            if (dots.length === 0) return;

            dots.forEach(dot => {
                this.updateSingleDot(dot);
            });
        },

        // Update a single dot's colors based on its current classes
        updateSingleDot: function (dot) {
            const baseColor = this.dotColor;

            // Only apply method colors if method has been called
            if (!this.methodCalled) {
                return; // Let CSS handle the colors
            }

            // Clear existing inline styles
            dot.style.borderColor = '';
            dot.style.backgroundColor = '';

            if (dot.classList.contains('active')) {
                dot.style.setProperty('background-color', baseColor, 'important');
                dot.style.setProperty('border-color', baseColor, 'important');
            } else if (dot.classList.contains('adjacent')) {
                dot.style.setProperty('border-color', this.hexToRgba(baseColor, 0.7), 'important');
                dot.style.setProperty('background-color', 'transparent', 'important');
            } else if (dot.classList.contains('near')) {
                dot.style.setProperty('border-color', this.hexToRgba(baseColor, 0.5), 'important');
                dot.style.setProperty('background-color', 'transparent', 'important');
            } else if (dot.classList.contains('far')) {
                dot.style.setProperty('border-color', this.hexToRgba(baseColor, 0.3), 'important');
                dot.style.setProperty('background-color', 'transparent', 'important');
            } else {
                // Default state
                dot.style.setProperty('border-color', this.hexToRgba(baseColor, 0.4), 'important');
                dot.style.setProperty('background-color', 'transparent', 'important');
            }
        },

        // Get current color
        getCurrentColor: function () {
            return this.dotColor;
        },

        // Reset to default color and clear method flag
        resetToDefault: function () {
            this.methodCalled = false;
            this.dotColor = '#FFFFFF';
            this.updateAllCarouselDots();
            console.log('Reset to default color and cleared method override');
        },

        // Clear method override (allows CSS to take precedence again)
        clearMethodOverride: function () {
            this.methodCalled = false;
            this.updateAllCarouselDots();
            console.log('Cleared method override, CSS colors will take precedence');
        }
    };

    // Also create a shorthand global function for easy access
    window.setCarouselDotColor = function (hexColor) {
        return window.carouselConfig.setDotColor(hexColor);
    };


    // Log that the carousel config is ready
    console.log('Carousel configuration loaded. Priority: CSS > Method > Default');

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

            // Hide all dots initially - no animation
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

                // Show/hide dots with slight transition for better visual feedback
                allDots.forEach((dot, index) => {
                    if (index >= startIndex && index <= endIndex) {
                        dot.style.display = 'block';
                        // Add a subtle scale animation for newly visible dots
                        if (dot.style.display === 'none') {
                            dot.style.transform = 'scale(0.8)';
                            setTimeout(() => {
                                dot.style.transform = 'scale(1)';
                            }, 50);
                        }
                    } else {
                        dot.style.display = 'none';
                    }
                });

                // Apply size classes with enhanced middle state feedback
                const visibleDots = Array.from(allDots).slice(startIndex, endIndex + 1);
                const activeIndexInVisible = activeIndex - startIndex;

                visibleDots.forEach((dot, index) => {
                    // Remove all size classes first
                    dot.classList.remove('adjacent', 'near', 'far', 'transitioning');

                    const distance = Math.abs(index - activeIndexInVisible);

                    // Add transitioning class for middle state visual feedback
                    if (activeIndex > 2 && activeIndex < totalSlides - 3) {
                        dot.classList.add('transitioning');
                    }

                    // Apply gradient sizing with enhanced feedback
                    if (distance === 1) {
                        dot.classList.add('adjacent');
                    } else if (distance === 2) {
                        dot.classList.add('near');
                    } else if (distance > 2) {
                        dot.classList.add('far');
                    }

                    // Apply colors after classes are set
                    window.carouselConfig.updateSingleDot(dot);
                });
            } else {
                // Less than or equal to 5 dots - show all with gradient sizing
                allDots.forEach((dot, index) => {
                    dot.style.display = 'block';
                    dot.classList.remove('adjacent', 'near', 'far', 'transitioning');

                    const distance = Math.abs(index - activeIndex);

                    if (distance === 1) {
                        dot.classList.add('adjacent');
                    } else if (distance === 2) {
                        dot.classList.add('near');
                    } else if (distance > 2) {
                        dot.classList.add('far');
                    }

                    // Apply colors after classes are set
                    window.carouselConfig.updateSingleDot(dot);
                });
            }
        }

        // Initial setup
        setTimeout(updateDotsAppearance, 50);

        // Update on carousel events - reduced delays
        const $carousel = jQuery(carousel);

        $carousel.on('changed.owl.carousel', function () {
            updateDotsAppearance(); // Immediate update, no delay
        });

        $carousel.on('translated.owl.carousel', function () {
            updateDotsAppearance(); // Immediate update
        });

        $carousel.on('resized.owl.carousel', function () {
            setTimeout(updateDotsAppearance, 50); // Minimal delay only for resize
        });

        // Handle dot clicks immediately
        dots.addEventListener('click', function (e) {
            if (e.target.classList.contains('owl-dot')) {
                setTimeout(updateDotsAppearance, 50); // Minimal delay
            }
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

            // Apply initial colors to dots
            window.carouselConfig.applyDotColors(carousel);
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
        const observer = new MutationObserver((mutations) => {
            let shouldUpdate = false;

            mutations.forEach((mutation) => {
                if (mutation.type === 'childList') {
                    // Check if dots were added
                    if (mutation.addedNodes.length > 0) {
                        for (let node of mutation.addedNodes) {
                            if (node.classList && node.classList.contains('owl-dots')) {
                                shouldUpdate = true;
                                break;
                            }
                        }
                    }
                }
            });

            if (shouldUpdate) {
                setTimeout(() => {
                    addCustomControls(carousel);
                    setupInstagramDots(carousel);
                }, 150);
                observer.disconnect();
            }
        });

        observer.observe(carousel, {
            childList: true,
            subtree: true
        });
    }

    jQuery('.owl-carousel').on('initialized.owl.carousel', function (event) {
        const carousel = event.target;

        // Add a small delay to ensure everything is rendered
        setTimeout(() => {
            addCustomControls(carousel);
            setupInstagramDots(carousel);
        }, 200);

        // Also set up the observer as backup
        observeCarouselChanges(carousel);
    });

    jQuery('.owl-carousel').on('changed.owl.carousel', function (event) {
        const carousel = event.target;
        setupInstagramDots(carousel);
    });
});

// Ensure the scroll top element is updated when DOM is ready
document.addEventListener('DOMContentLoaded', function () {
    const scrollTop = document.getElementById('ast-scroll-top');
    if (scrollTop) {
        scrollTop.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none"><path d="M16 25C16 25.5523 16.4477 26 17 26C17.5523 26 18 25.5523 18 25L16 25ZM17.7071 8.29289C17.3166 7.90237 16.6834 7.90237 16.2929 8.29289L9.92893 14.6569C9.53841 15.0474 9.53841 15.6805 9.92893 16.0711C10.3195 16.4616 10.9526 16.4616 11.3431 16.0711L17 10.4142L22.6569 16.0711C23.0474 16.4616 23.6805 16.6805 24.0711 16.0711C24.4616 15.6805 24.4616 15.0474 24.0711 14.6569L17.7071 8.29289ZM18 25L18 9L16 9L16 25L18 25Z" fill="#1A2C47"></path></svg>';
    }
});
