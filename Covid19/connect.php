<?php 
 $user_name = $_POST['username'];
 $email = $_POST['email'];
 $psw= $_POST['password'];

 $servername = "localhost:3307";
 $username = "root";
 $password = "";
 $database = "register_data";

// Create a database connection
$conn = new mysqli($servername,$username,$password,$database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{
    // Prepare an SQL statement
    $stmt = $conn->prepare("INSERT INTO registration (username, email, password) VALUES (?, ?, ?)");

    // Bind parameters and execute the statement
    $stmt->bind_param("sss", $user_name, $email, $psw);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Registration Successfully Done";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
