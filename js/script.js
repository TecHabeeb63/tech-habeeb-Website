document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("contactForm");

    form.addEventListener("submit", function (event) {
        const name = document.getElementById("name");
        const email = document.getElementById("email");
        const message = document.getElementById("message");

        let isValid = true;

        // Reset previous error styles
        [name, email, message].forEach(input => {
            input.classList.remove("error");
            removeErrorMessage(input);
        });

        // Validate Name
        if (name.value.trim() === "") {
            showError(name, "Name is required.");
            isValid = false;
        }

        // Validate Email
        if (email.value.trim() === "") {
            showError(email, "Email is required.");
            isValid = false;
        } else if (!validateEmail(email.value)) {
            showError(email, "Enter a valid email address.");
            isValid = false;
        }

        // Validate Message
        if (message.value.trim() === "") {
            showError(message, "Message cannot be empty.");
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault();
        }
    });

    function showError(input, message) {
        input.classList.add("error");
        const error = document.createElement("div");
        error.className = "error-message";
        error.innerText = message;

        // Remove existing error messages
        removeErrorMessage(input);

        input.parentNode.insertBefore(error, input.nextSibling);
    }

    function removeErrorMessage(input) {
        const nextElement = input.nextElementSibling;
        if (nextElement && nextElement.classList.contains("error-message")) {
            nextElement.remove();
        }
    }

    function validateEmail(email) {
        const re = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        return re.test(email);
    }
});
