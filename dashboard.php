<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

echo "<h1>Welcome, " . $_SESSION['email'] . "!</h1>";
?>
<a href="logout.php">Logout</a>
