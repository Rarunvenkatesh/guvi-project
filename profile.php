<?php
session_start();


if (!isset($_SESSION['user'])) {
    header("Location: login.php"); 
    exit();
}


$userDetails = getUserDetails($_SESSION['user']);

function getUserDetails($username) {
    $conn = new mysqli("localhost", "root", "", "guvi");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT * FROM signupinfo1 WHERE email = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    $userData = $result->fetch_assoc();

    $stmt->close();
    $conn->close();

    return $userData;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["logout"])) {
    
    $_SESSION = array();

    
    session_destroy();

    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Profile</title>
    <style>



</style>
</head>
<body>

    <div class="container">
     
        <h2>Welcome, <?php echo $_SESSION['user']; ?></h2>

      
       
     
        <div id="profileDisplay">
            <h2>User Profile</h2>
            <p><strong>Username:</strong> <?php echo isset($userDetails['username']) ? $userDetails['username'] : ''; ?></p>
            <p><strong>Age:</strong> <?php echo isset($userDetails['age']) ? $userDetails['age'] : ''; ?></p>
            <p><strong>Date of Birth:</strong> <?php echo isset($userDetails['dob']) ? $userDetails['dob'] : ''; ?></p>
            <p><strong>Email:</strong> <?php echo isset($userDetails['email']) ? $userDetails['email'] : ''; ?></p>
            <!-- Add more fields as needed -->
        </div>
        <form method="post">
            <button type="submit" name="logout">Logout</button>
        </form>
    </div>

    <script src="profile.js"></script>

</body>
</html>
