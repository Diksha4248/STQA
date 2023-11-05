<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    } else {
        // Query the database for the user with the provided email
        $stmt = $conn->prepare("SELECT email, password FROM registration WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $dbPassword = $row['password'];

            // Verify the entered password against the hashed password in the database
            if (password_verify($psw, $dbPassword)) {
                echo "Sign in successful.";
            } else {
                echo "Invalid password. Please try again.";
            }
        } else {
            echo "Email not found. Please register first.";
        }

        $stmt->close();
        $conn->close();
    }
}
?>
