

<?php
$conn = new mysqli("localhost", "root", "", "guvi");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo 'processing...';

if (isset($_POST['username'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "INSERT INTO signupinfo1 (username, dob, age, email, password) VALUES ('$username', '$dob', '$age', '$email', '$password')";

    if (mysqli_query($conn, $query)) {
       
        echo "success";
    } else {
        
        echo "error: User data insertion failed";
    }
}

$conn->close();
?>

