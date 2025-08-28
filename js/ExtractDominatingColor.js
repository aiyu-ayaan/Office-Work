/**
 * Extracts the dominant color from an image (local file or URL)
 * @param {string|File} imageSrc - The URL, file path, or File object of the image to analyze
 * @param {boolean} useCors - Whether to use CORS for URLs (defaults to true)
 * @returns {Promise<string>} - Promise that resolves to dominant color in "r,g,b" format
 */
async function getDominantColorFromImage(imageSrc, useCors = true) {
    return new Promise((resolve, reject) => {
        const img = new Image();

        // Handle different input types
        if (imageSrc instanceof File) {
            // Handle File object (from file input)
            const reader = new FileReader();
            reader.onload = (e) => {
                img.src = e.target.result;
            };
            reader.onerror = () => reject(new Error('Failed to read file'));
            reader.readAsDataURL(imageSrc);
        } else if (typeof imageSrc === 'string') {
            // Handle URL or local file path
            if (imageSrc.startsWith('http') || imageSrc.startsWith('https')) {
                // External URL - use CORS if needed
                if (useCors) {
                    img.crossOrigin = 'Anonymous';
                }
            }
            // For local paths, no CORS needed
            img.src = imageSrc;
        } else {
            reject(new Error('Invalid image source type'));
            return;
        }

        img.onload = () => {
            try {
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');

                // Resize image to 50x50 for faster processing
                const width = 50;
                const height = 50;
                canvas.width = width;
                canvas.height = height;

                // Draw and analyze the image
                ctx.drawImage(img, 0, 0, width, height);
                const imageData = ctx.getImageData(0, 0, width, height);

                const data = imageData.data;
                const colorCount = {};

                // Count colors by grouping similar colors (reducing by 10)
                for (let i = 0; i < data.length; i += 4) {
                    const r = data[i];
                    const g = data[i + 1];
                    const b = data[i + 2];

                    // Group similar colors together by rounding to nearest 10
                    const key = `${Math.floor(r / 10) * 10},${Math.floor(g / 10) * 10},${Math.floor(b / 10) * 10}`;
                    colorCount[key] = (colorCount[key] || 0) + 1;
                }

                // Find the most frequent color
                let dominantColor = null;
                let maxCount = 0;
                for (const color in colorCount) {
                    if (colorCount[color] > maxCount) {
                        maxCount = colorCount[color];
                        dominantColor = color;
                    }
                }

                resolve(dominantColor);
            } catch (error) {
                if (useCors && error.name === 'SecurityError' && typeof imageSrc === 'string' && imageSrc.startsWith('http')) {
                    // Retry without CORS for external URLs
                    getDominantColorFromImage(imageSrc, false)
                        .then(resolve)
                        .catch(reject);
                } else {
                    reject(error);
                }
            }
        };

        img.onerror = (error) => {
            if (useCors && typeof imageSrc === 'string' && imageSrc.startsWith('http')) {
                // Retry without CORS for external URLs
                getDominantColorFromImage(imageSrc, false)
                    .then(resolve)
                    .catch(reject);
            } else {
                reject(new Error('Failed to load image: ' + imageSrc));
            }
        };
    });
}

/**
 * Helper function specifically for file input elements
 * @param {HTMLInputElement} fileInput - File input element
 * @returns {Promise<string>} - Promise that resolves to dominant color
 */
async function getDominantColorFromFileInput(fileInput) {
    if (!fileInput.files || fileInput.files.length === 0) {
        throw new Error('No file selected');
    }

    const file = fileInput.files[0];
    if (!file.type.startsWith('image/')) {
        throw new Error('Selected file is not an image');
    }

    return getDominantColorFromImage(file);
}

/**
 * Helper function to convert the result to different color formats
 * @param {string} dominantColor - The dominant color in "r,g,b" format
 * @returns {Object} - Object containing rgb, hex, and raw values
 */
function formatDominantColor(dominantColor) {
    const [r, g, b] = dominantColor.split(',').map(Number);
    const hex = `#${r.toString(16).padStart(2, '0')}${g.toString(16).padStart(2, '0')}${b.toString(16).padStart(2, '0')}`;
    const rgb = `rgb(${r}, ${g}, ${b})`;

    return {
        raw: dominantColor,
        rgb: rgb,
        hex: hex,
        values: { r, g, b }
    };
}
