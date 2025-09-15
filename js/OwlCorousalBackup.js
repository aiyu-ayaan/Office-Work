document.addEventListener('DOMContentLoaded', function () {

    const svg_prev = `<svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none">
<g id="Icon button desktop Laptop tablet Mobile menu"><circle id="Ellipse 14" cx="16" cy="16" r="16" transform="matrix(-1 0 0 1 33 1)" stroke="#00CCFF" stroke-width="2"/><path id="Arrow 2" d="M25 16C25.5523 16 26 16.4477 26 17C26 17.5523 25.5523 18 25 18L25 16ZM8.29289 17.7071C7.90237 17.3166 7.90237 16.6834 8.29289 16.2929L14.6569 9.92893C15.0474 9.53841 15.6805 9.53841 16.0711 9.92893C16.4616 10.3195 16.4616 10.9526 16.0711 11.3431L10.4142 17L16.0711 22.6569C16.4616 23.0474 16.4616 23.6805 16.0711 24.0711C15.6805 24.4616 15.0474 24.4616 14.6569 24.0711L8.29289 17.7071ZM25 18L9 18L9 16L25 16L25 18Z" stroke-width="0"/></g></svg>`
    const svg_next = `<svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none"><g id="Navigation Desktop &amp; laptop"><circle id="Ellipse 13" cx="17" cy="17" r="16" stroke="#00CCFF" stroke-width="2"/><path id="Arrow 3" d="M9 16C8.44772 16 8 16.4477 8 17C8 17.5523 8.44772 18 9 18L9 16ZM25.7071 17.7071C26.0976 17.3166 26.0976 16.6834 25.7071 16.2929L19.3431 9.92893C18.9526 9.53841 18.3195 9.53841 17.9289 9.92893C17.5384 10.3195 17.5384 10.9526 17.9289 11.3431L23.5858 17L17.9289 22.6569C17.5384 23.0474 17.5384 23.6805 17.9289 24.0711C18.3195 24.4616 18.9526 24.4616 19.3431 24.0711L25.7071 17.7071ZM9 18L25 18L25 16L9 16L9 18Z" stroke-width="0"/></g></svg>`
    const svg_pause = `<svg class="ic-pause" xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none"><circle cx="16" cy="16" r="16" transform="matrix(-1 0 0 1 33 1)" stroke="#00CCFF" stroke-width="2"/><path d="M25 17.0745L13 9L13 25L25 17.0745Z" stroke-width="2" stroke-miterlimit="10" stroke-linejoin="round"/></svg>`
    const svg_play = `<svg class="ic-play" xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none"><circle cx="16" cy="16" r="16" transform="matrix(-1 0 0 1 33 1)" stroke="#00CCFF" stroke-width="2"/><line x1="13" y1="9" x2="13" y2="25" stroke-width="2" stroke-linecap="round"/><line x1="21" y1="9" x2="21" y2="25" stroke-width="2" stroke-linecap="round"/>`

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
                //         console.log(carousel)
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
            observer.disconnect();
        });
        observer.observe(carousel, { childList: true, subtree: true });
    }
    jQuery('.owl-carousel').on('initialized.owl.carousel', function (event) {
        const carousel = event.target;
        observeCarouselChanges(carousel);
    });

    // Replace Social Icon in Astra's Social Icons
    const socialMediaIcons = {
        "Twitter": `
          <svg xmlns="http://www.w3.org/2000/svg" width="47" height="48" viewBox="0 0 47 48" fill="none">
<g clip-path="url(#clip0_346_440)">
  <path d="M23.8203 21.229L15.1467 8.81445H10.5107L21.278 24.1963L22.6239 26.1163L31.8317 39.2945H36.4676L25.1876 23.1708L23.8203 21.229Z"/>
  <path d="M43.0691 0H3.93091C1.75182 0 0 1.78909 0 4.01455V43.9855C0 46.2109 1.75182 48 3.93091 48H43.0691C45.2482 48 47 46.2109 47 43.9855V4.01455C47 1.78909 45.2482 0 43.0691 0ZM30.4218 41.4545L21.0859 27.9055L9.42136 41.4545H6.40909L19.7614 25.9636L6.40909 6.54545H16.5782L25.4014 19.3745L36.4677 6.54545H39.48L26.7473 21.3382L40.5909 41.4545H30.4218Z"/>
</g>
<defs>
  <clipPath id="clip0_346_440">
    <rect width="47" height="48"/>
  </clipPath>
</defs>
</svg>`,
        "LinkedIn": `
          <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
<g clip-path="url(#clip0_1893_1908)">
  <path d="M44.4554 0H3.54671C1.58775 0 0 1.53922 0 3.43897V44.56C0 46.4597 1.58828 48.0005 3.54671 48.0005H44.4554C46.4144 48.0005 48 46.4592 48 44.56V3.43897C48 1.53975 46.4144 0 44.4554 0ZM14.5522 40.1796H7.29981V18.5079H14.5522V40.1796ZM10.9265 15.5474H10.878C8.44596 15.5474 6.86941 13.8839 6.86941 11.8017C6.86941 9.67744 8.49236 8.05929 10.9724 8.05929C13.4529 8.05929 14.9788 9.67691 15.0268 11.8017C15.0268 13.8844 13.4535 15.5474 10.9265 15.5474ZM40.6954 40.1796H33.4452V28.5848C33.4452 25.6707 32.3945 23.6829 29.7726 23.6829C27.7667 23.6829 26.5763 25.0243 26.0536 26.3187C25.8595 26.7816 25.812 27.428 25.812 28.0744V40.1791H18.5629C18.5629 40.1791 18.6578 20.54 18.5629 18.5074H25.8126V21.58C26.7752 20.1037 28.4947 17.9975 32.3454 17.9975C37.1172 17.9975 40.6954 21.093 40.6954 27.7528V40.1796ZM25.7656 21.6488C25.7784 21.6285 25.7955 21.6034 25.8126 21.58V21.6488H25.7656Z"/>
</g>
<defs>
  <clipPath id="clip0_1893_1908">
    <rect width="48" height="48"/>
  </clipPath>
</defs>
</svg>`,
        "YouTube": `
          <svg xmlns="http://www.w3.org/2000/svg" width="63" height="48" viewBox="0 0 63 48" fill="none">
<g clip-path="url(#clip0_346_437)">
  <path d="M62.5912 10.5994C62.5912 4.97474 58.5178 0.449977 53.4845 0.449977C46.6668 0.124993 39.7137 0 32.6129 0H30.3978C23.3093 0 16.3439 0.124993 9.52615 0.449977C4.50515 0.449977 0.431745 4.99974 0.431745 10.6244C0.124086 15.0742 -0.011284 19.524 -0.000208302 23.9738C-0.0125147 28.4235 0.122855 32.8733 0.418208 37.3356C0.418208 42.9603 4.49162 47.5225 9.51262 47.5225C16.6749 47.86 24.0218 48.01 31.4918 47.9975C38.9741 48.0225 46.2964 47.8725 53.471 47.5225C58.5043 47.5225 62.5777 42.9603 62.5777 37.3356C62.873 32.8733 63.0084 28.4235 62.9961 23.9613C63.0207 19.5115 62.8853 15.0617 62.59 10.5994H62.5912ZM25.4752 36.2356V11.6744L43.3195 23.9488L25.4752 36.2356Z"/>
</g>
<defs>
  <clipPath id="clip0_346_437">
    <rect width="63" height="48"/>
  </clipPath>
</defs>
</svg>`
    };

    //     // Loop through the social media icons list
    //     Object.keys(socialMediaIcons).forEach(label => {
    //         // Query all <a> tags with the matching aria-label
    //         document.querySelectorAll(`a[aria-label="${label}"] span`).forEach(svgElement => {
    //             // Replace the inner HTML of the parent <span> with the custom SVG
    //             svgElement.parentElement.innerHTML = socialMediaIcons[label];
    //         });
    //     });
});

document.getElementById('ast-scroll-top').innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none"><path d="M16 25C16 25.5523 16.4477 26 17 26C17.5523 26 18 25.5523 18 25L16 25ZM17.7071 8.29289C17.3166 7.90237 16.6834 7.90237 16.2929 8.29289L9.92893 14.6569C9.53841 15.0474 9.53841 15.6805 9.92893 16.0711C10.3195 16.4616 10.9526 16.4616 11.3431 16.0711L17 10.4142L22.6569 16.0711C23.0474 16.4616 23.6805 16.4616 24.0711 16.0711C24.4616 15.6805 24.4616 15.0474 24.0711 14.6569L17.7071 8.29289ZM18 25L18 9L16 9L16 25L18 25Z" fill="#1A2C47"></path></svg>';
