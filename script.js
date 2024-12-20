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

    // Function to toggle modal visibility
    function toggleModal(modalId) {
        var modal = document.getElementById(modalId);
        if (modal.style.display === "none" || modal.style.display === "") {
            modal.style.display = "block";
        } else {
            modal.style.display = "none";
        }
    }

    // Add event listeners for each "View Menu" button
    document.getElementById("viewMenuBtn").onclick = function() {
        toggleModal("myModal");
    }

    document.getElementById("viewMenuBtn2").onclick = function() {
        toggleModal("myModal2");
    }

    document.getElementById("viewMenuBtn3").onclick = function() {
        toggleModal("myModal3");
    }

    // Close the modal when the user clicks on <span> (x)
    var closeButtons = document.getElementsByClassName("close");
    for (var i = 0; i < closeButtons.length; i++) {
        closeButtons[i].onclick = function() {
            this.closest(".modal").style.display = "none";
        }
    }

    // Close the modal if the user clicks outside of the modal content
    window.onclick = function(event) {
        var modals = document.getElementsByClassName("modal");
        for (var i = 0; i < modals.length; i++) {
            if (event.target === modals[i]) {
                modals[i].style.display = "none";
            }
        }
    }

    // Validation côté client pour l'email
    const emailInput = document.getElementById('email');
    emailInput.addEventListener('input', function() {
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!emailPattern.test(emailInput.value)) {
            emailInput.setCustomValidity('Email invalide');
        } else {
            emailInput.setCustomValidity('');
        }
    });
    function toggleDetails(detailId) {
        var details = document.getElementById(detailId);
        details.classList.toggle("hidden");
     }
