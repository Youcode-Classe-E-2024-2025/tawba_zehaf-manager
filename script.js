const btn = document.querySelector("button.mobile-menu-button");
const menu = document.querySelector(".mobile-menu");

btn.addEventListener("click", () => {
    menu.classList.toggle("hidden");
});

// Function to toggle the visibility of the details section
function toggleDetails(id) {
const details = document.getElementById(id);
details.classList.toggle('hidden'); // Toggle the 'hidden' class
}