document.addEventListener("DOMContentLoaded", function() {
    document.querySelector("button").addEventListener("click", function() {
        document.querySelector(".container").classList.toggle("show");
    });

    document.querySelector(".side-hide").addEventListener("click", function() {
        document.querySelector(".container").classList.toggle("show");
    });
});

const toggles = document.querySelectorAll('.toggle');

toggles.forEach(toggle => {
    toggle.addEventListener('click', () => {
        const content = toggle.nextElementSibling;
        content.classList.toggle('active');
        
        toggle.querySelector('i').classList.toggle('fa-plus');
        toggle.querySelector('i').classList.toggle('fa-minus');
    });
});
