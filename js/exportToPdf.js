function exportToPdf(){
    let element = document.getElementById('export'); // sem treba vlozit id elementu ktory sa ma exportovat (exportuje vsetko co je v nom)
    html2pdf(element);
}


// header: <script src="lib/html2pdf.bundle.min.js"></script>
// footer: <script src="js/exportToPdf.js"></script>

// button: <button onclick="exportToPdf()">To Pdf</button>