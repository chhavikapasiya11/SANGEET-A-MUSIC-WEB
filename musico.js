document.addEventListener("DOMContentLoaded", function() {
    const signupButton = document.querySelector(".button button:nth-child(1)");
    const loginButton = document.querySelector(".log");

    signupButton.addEventListener("click", function() {
        const username = prompt("Enter a username:");
        const password = prompt("Enter a password:");

        if (username && password) {
            localStorage.setItem("username", username);
            localStorage.setItem("password", password);
            alert("Sign up successful!");
        } else {
            alert("Please enter a username and password.");
        }
    });

    loginButton.addEventListener("click", function() {
        const username = prompt("Enter your username:");
        const password = prompt("Enter your password:");

        const storedUsername = localStorage.getItem("username");
        const storedPassword = localStorage.getItem("password");

        if (username === storedUsername && password === storedPassword) {
            alert("Login successful!");
        } else {
            alert("Incorrect username or password.");
        }
    });
});
