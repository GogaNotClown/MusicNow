const downloadButtons = document.querySelectorAll('.download-button');
downloadButtons.forEach(button => {
    button.addEventListener('click', () => {
        const filePath = button.dataset.file;
        const link = document.createElement('a');
        link.href = filePath;
        link.download = filePath.split('/').pop();
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    });
});