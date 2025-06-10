document.addEventListener('DOMContentLoaded', () => {
    const textarea = document.getElementById('autogrow');

    const autoGrow = () => {
        textarea.style.height = 'auto';
        textarea.style.height = textarea.scrollHeight + 'px';
    };

    if (textarea) {
        autoGrow(); // Trigger on page load
        textarea.addEventListener('input', autoGrow); // On input
    }
});
