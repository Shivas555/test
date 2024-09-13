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

// Handle the sign-up form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signupBtn'])) {
    $full_name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate form data
    if (empty($full_name) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "Please fill in all required fields.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address.";
    } else if ($password !== $confirm_password) {
        echo "Passwords do not match.";
    } else {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "Email address already exists.";
        } else {
            // Hash the password before storing it
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Prepare and bind the SQL statement
            $stmt = $conn->prepare("INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $full_name, $email, $hashed_password);

            // Execute the query
            if ($stmt->execute()) {
                // Sign-up successful
                echo "Sign-up successful!";
                // Set session variables and redirect
                $_SESSION['loggedIn'] = true;
                $_SESSION['user_name'] = $full_name;
                header("Location: dashboard.php"); // Replace with your desired redirect
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
        }

        $stmt->close();
    }
}

// Handle the login form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['loginBtn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate form data
    if (empty($email) || empty($password)) {
        echo "Please fill in all required fields.";
    } else {
        // Prepare and bind the SQL statement
        $stmt = $conn->prepare("SELECT id, full_name, profile_picture FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($user_id, $user_name, $profile_picture);
            $stmt->fetch();

            // Verify password
            if (password_verify($password, $hashed_password)) {
                // Login successful
                echo "Login successful!";
                // Set session variables and redirect
                $_SESSION['loggedIn'] = true;
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_name'] = $user_name;
                $_SESSION['profile_picture'] = $profile_picture;
                header("Location: dashboard.php"); // Replace with your desired redirect
                exit();
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "Email address not found.";
        }

        $stmt->close();
    }
}

// Check if the user is logged in before rendering the navigation
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
    // User is logged in
    $loggedIn = true;
    $user_name = $_SESSION['user_name'];
    $profile_picture = $_SESSION['profile_picture'];
} else {
    // User is not logged in
    $loggedIn = false;
}

$conn->close();
?>