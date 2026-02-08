// Smooth scroll
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener("click", function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute("href"))
            .scrollIntoView({ behavior: "smooth" });
    });
});

// Simple form validation feedback
document.querySelectorAll("form").forEach(form => {
    form.addEventListener("submit", () => {
        alert("Processing your request...");
    });
});