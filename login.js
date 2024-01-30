

function redirectToSignup() {
    window.location.href = "./signup.html";
}

document.addEventListener("DOMContentLoaded", function () {

document.getElementById("loginForm").addEventListener("submit", function (event) {
    event.preventDefault();

    
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    var xhr = new XMLHttpRequest();
xhr.open("POST", "login_process.php", true);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.onload = function () {
if (xhr.status === 200) {
    window.location = 'profile.php  ';

} else {
    console.error("Error: " + xhr.status);
}
};


    // Send data in the request
    xhr.send("email=" + encodeURIComponent(email) +
            "&password=" + encodeURIComponent(password));
});
});