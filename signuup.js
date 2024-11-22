document.getElementById("signupForm").addEventListener("submit", function(event) {
    event.preventDefault(); 

    const username = document.getElementById("signupUsername").value;
    const email = document.getElementById("signupEmail").value;
    const password = document.getElementById("signupPassword").value;
    const confirmPassword = document.getElementById("confirmPassword").value;
    const termsCheckbox = document.getElementById("termsCheckbox").checked;

    if (!termsCheckbox) {
        alert("Please agree to the terms and conditions.");
        return;
    }

    if (password !== confirmPassword) {
        alert("Passwords do not match.");
        return;
    }

    if (username && email && password) {
        localStorage.setItem("username", username);
        localStorage.setItem("email", email);
        localStorage.setItem("password", password);
        alert("Sign up successful!");
        window.location.href = "login.html"; // Redirect to login page
    } else {
        alert("Please complete all required fields.");
    }
});
