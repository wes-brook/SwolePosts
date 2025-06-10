const textarea = document.getElementById("autogrow");

const autoGrow = () => {
    textarea.style.height = "auto";
    textarea.style.height = textarea.scrollHeight + "px";
};

// Trigger on page load in case of old input
autoGrow();

// Adjust height on user input
textarea.addEventListener("input", autoGrow);
