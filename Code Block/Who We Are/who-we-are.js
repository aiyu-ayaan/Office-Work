// DESCRIPTION: banner
let resizeTimeout;

function initializeAnimation() {
    const animatedTextContainer = document.querySelector('.animated-text');
    if (!animatedTextContainer) return;

    const textElements = animatedTextContainer.querySelectorAll('div');

    // Clear any existing timeouts
    if (resizeTimeout) {
        clearTimeout(resizeTimeout);
    }

    // Calculate width for each text element individually
    textElements.forEach((element, index) => {
        // Reset animation to recalculate
        element.style.animation = 'none';
        element.offsetHeight; // Trigger reflow

        // Create a temporary element to measure width with proper styles
        const temp = document.createElement('div');
        temp.textContent = element.textContent;
        temp.style.position = 'absolute';
        temp.style.visibility = 'hidden';
        temp.style.whiteSpace = 'nowrap';
        temp.style.fontSize = getComputedStyle(element).fontSize;
        temp.style.fontFamily = getComputedStyle(element).fontFamily;
        temp.style.fontWeight = getComputedStyle(element).fontWeight;
        temp.style.letterSpacing = getComputedStyle(element).letterSpacing;
        temp.style.textTransform = getComputedStyle(element).textTransform;
        temp.style.padding = '0';
        temp.style.margin = '0';
        temp.style.border = 'none';

        document.body.appendChild(temp);
        const width = temp.offsetWidth;
        document.body.removeChild(temp);

        // Set individual width and delay for each element
        element.style.setProperty('--text-width', width + 'px');
        element.style.setProperty('--delay', `${index * 2}s`);

        // Restart animation
        element.style.animation = `typewriter 6s infinite ${index * 2}s`;
    });
}

// Initialize on DOM load
document.addEventListener('DOMContentLoaded', initializeAnimation);

// Reinitialize on orientation change with debounce
window.addEventListener('orientationchange', function () {
    // Clear existing timeout
    if (resizeTimeout) {
        clearTimeout(resizeTimeout);
    }

    // Set timeout to reinitialize after orientation change settles
    resizeTimeout = setTimeout(() => {
        initializeAnimation();
    }, 100);
});

// Also handle resize events for desktop
window.addEventListener('resize', function () {
    if (resizeTimeout) {
        clearTimeout(resizeTimeout);
    }

    resizeTimeout = setTimeout(() => {
        initializeAnimation();
    }, 250);
});
// DESCRIPTION: Custom HTML

// DESCRIPTION: content frame section
document.addEventListener("DOMContentLoaded", function () {
    const sections = document.querySelectorAll('.section-wrapper');
    sections.forEach((section, index) => {
        const contentLeft = section.querySelector('.content-left');
        const contentRight = section.querySelector('.content-right');
        const backgroundLeft = section.querySelector('.background-left');
        if ((index + 1) % 2 === 0) {
            contentLeft.classList.add('slide-in-right');
            contentRight.classList.add('slide-in-left');
            if (backgroundLeft) backgroundLeft.classList.add('slide-in-right');
        } else {
            contentLeft.classList.add('slide-in-left');
            contentRight.classList.add('slide-in-right');
            if (backgroundLeft) backgroundLeft.classList.add('slide-in-left');
        }
    });
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("in-view");
            }
        });
    }, {
        threshold: 0.2
    });
    document.querySelectorAll(".animate-on-scroll").forEach(el => {
        observer.observe(el);
    });
});
function syncBackgroundHeight() {
    if (window.innerWidth <= 768) {
        document.querySelectorAll('.section-wrapper').forEach(section => {
            const contentLeft = section.querySelector('.content-left');
            const backgroundLeft = section.querySelector('.background-left');
            if (contentLeft && backgroundLeft) {
                const contentHeight = contentLeft.getBoundingClientRect().height;
                backgroundLeft.style.height = `${contentHeight}px`;
            }
        });
    } else {
        document.querySelectorAll('.background-left').forEach(bg => {
            bg.style.height = '';
        });
    }
}
window.addEventListener('load', syncBackgroundHeight);
window.addEventListener('resize', syncBackgroundHeight);
document.addEventListener("DOMContentLoaded", function () {
    // Get all section-wrapper divs
    const sections = document.querySelectorAll(".content-cards .section-wrapper");

    sections.forEach((section, index) => {
        // Assign numeric id like section-1, section-2, etc.
        section.id = "section-" + (index + 1);
    });
});
// document.addEventListener("DOMContentLoaded", function() {
//  if (window.location.hash) {
//    const target = document.querySelector(window.location.hash);
//    if (target) {
//      target.scrollIntoView({ behavior: "smooth" });
//   }
// Remove #id from URL without reloading
// history.replaceState(null, null, window.location.pathname);
// }
// });
document.addEventListener("DOMContentLoaded", function () {
    const scrollTarget = sessionStorage.getItem("scrollTarget");

    if (scrollTarget) {
        const sections = document.querySelectorAll(".section-wrapper");
        const target = sections[scrollTarget - 1]; // 1-based index

        if (target) {
            target.scrollIntoView({ behavior: "smooth" });
        }

        sessionStorage.removeItem("scrollTarget"); // clear after use
    }
});
// DESCRIPTION: bottom quote