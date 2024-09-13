<?php
session_start();
session_destroy(); // This will end the session and log the user out
header('Location: index.php'); // Redirect the user back to the homepage after logout
exit();
?>
