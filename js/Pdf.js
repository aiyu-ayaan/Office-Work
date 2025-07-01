import * as pdfjsLib from 'pdfjs-dist/legacy/build/pdf.mjs';
import fs from 'fs';
import { fileURLToPath } from 'url';
import { dirname, join } from 'path';

// Get current directory for ES modules
const __filename = fileURLToPath(import.meta.url);
const __dirname = dirname(__filename);

// Configure PDF.js worker
const workerPath = join(__dirname, 'node_modules', 'pdfjs-dist', 'legacy', 'build', 'pdf.worker.mjs');
pdfjsLib.GlobalWorkerOptions.workerSrc = workerPath;

// Main function to extract text from PDF URL
async function extractPDFText(pdfUrl, outputFileName = 'extracted_text.txt') {
    try {
        console.log(`🔄 Extracting text from: ${pdfUrl}`);
        console.log('⏳ Please wait...\n');
        
        // Load PDF document
        const loadingTask = pdfjsLib.getDocument(pdfUrl);
        const pdf = await loadingTask.promise;
        
        console.log(`📄 PDF loaded successfully!`);
        console.log(`📊 Total pages: ${pdf.numPages}\n`);
        
        let fullText = '';
        
        // Extract text from each page
        for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
            process.stdout.write(`📖 Processing page ${pageNum}/${pdf.numPages}... `);
            
            const page = await pdf.getPage(pageNum);
            const textContent = await page.getTextContent();
            
            // Combine all text items from the page
            const pageText = textContent.items
                .map(item => item.str)
                .join(' ')
                .replace(/\s+/g, ' ')
                .trim();
            
            if (pageText) {
                fullText += `--- Page ${pageNum} ---\n`;
                fullText += pageText + '\n\n';
            }
            
            console.log('✅');
        }
        
        // Print extracted text to console
        console.log('\n' + '='.repeat(60));
        console.log('📝 EXTRACTED TEXT:');
        console.log('='.repeat(60));
        console.log(fullText);
        console.log('='.repeat(60));
        
        // Save to file
        fs.writeFileSync(outputFileName, fullText, 'utf8');
        
        console.log(`\n✅ Extraction completed successfully!`);
        console.log(`💾 Text saved to: ${outputFileName}`);
        console.log(`📊 Total characters extracted: ${fullText.length}`);
        console.log(`📄 Total pages processed: ${pdf.numPages}`);
        
        return fullText;
        
    } catch (error) {
        console.error('❌ Error extracting text from PDF:', error.message);
        throw error;
    }
}

// Example usage function
async function demo() {
    try {
        // Test with a sample PDF URL
        const pdfUrl = 'https://websitedev-db0c5dadd1-endpoint.azureedge.net/wp-content/uploads/2025/04/Whitepaper_Pardot_ADROSONIC.pdf';
        const outputFile = 'demo_extracted_text.txt';
        
        const extractedText = await extractPDFText(pdfUrl, outputFile);
        
        console.log('\n🎉 Demo completed successfully!');
        
    } catch (error) {
        console.error('❌ Demo failed:', error.message);
    }
}

// If this file is run directly, run the demo
if (import.meta.url === `file://${process.argv[1]}`) {
    demo();
}

// Export the function for use in other files
export { extractPDFText };