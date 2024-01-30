document.addEventListener("DOMContentLoaded", function () {
    
    loadUserProfile();

  
    document.getElementById("profileForm").addEventListener("submit", function (event) {
        event.preventDefault();

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "update_profile.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                
                console.log(xhr.responseText);
            }
        };
    
        xhr.send("age=" + encodeURIComponent(document.getElementById("age").value) +
                 "&dob=" + encodeURIComponent(document.getElementById("dob").value) +
                 "&contact=" + encodeURIComponent(document.getElementById("contact").value));
    });
});


function loadUserProfile() {
    
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "get_profile.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Parse the JSON response and update the profile page content
            var userData = JSON.parse(xhr.responseText);
            document.getElementById("age").value = userData.age;
            document.getElementById("dob").value = userData.dob;
            document.getElementById("contact").value = userData.contact;
           
        }
    };
    xhr.send();
}
