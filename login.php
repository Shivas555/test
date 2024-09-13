<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare the SQL query to get the user data
    $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Start a session and redirect the user to the homepage
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email; // Store user email in session
            header("Location: index.php"); // Redirect to homepage
            exit();
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "No user found with that email!";
    }

    $stmt->close();
}

$conn->close();
?>
