<?php

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = isset($_POST["email"]) ? $_POST["email"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";

    
    if (empty($username) || empty($password)) {
        
        echo json_encode(array("success" => false, "message" => "Username and password are required."));
    } else {
       
        $validUser = validateUser($username, $password);

        if ($validUser) {
           
            $_SESSION['user'] = $username;

            echo json_encode(array("success" => true , "message" => "Valid credentials."));
            
            header("Location:profile.php");
            exit();
        } else {
            
            echo json_encode(array("success" => false, "message" => "Invalid username or password."));
        }
    }
} else {
    
    echo json_encode(array("success" => false, "message" => "Invalid request method."));
}

function validateUser($username, $password) {
   
    $conn = new mysqli("localhost", "root", "", "guvi");

    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

   
    $query = "SELECT * FROM signupinfo1 WHERE email = ? AND password = ?";
    
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    $validUser = $result->num_rows > 0;

    $stmt->close();
    $conn->close();

    return $validUser;
}
?>
