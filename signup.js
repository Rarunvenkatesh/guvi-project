document.getElementById("signupForm").addEventListener('submit', postName);

function postName(event) {


    var username = document.getElementById("username").value;
    var age = document.getElementById("age").value;
    var dob = document.getElementById("dob").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

  

    var params = "username=" + encodeURIComponent(username); 
                 "&dob=" + encodeURIComponent(dob) +
                 "&age=" + encodeURIComponent(age) +
                 "&email=" + encodeURIComponent(email) +
                 "&password=" + encodeURIComponent(password);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "signup_process.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log(this.response);
            // Process the response here
        } else {
            console.error("Error: " + xhr.status);
        }
    };

    xhr.send(params);
}
