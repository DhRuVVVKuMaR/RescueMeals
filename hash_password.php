<?php
// Replace "password123" with the password you want to hash
$password = "password123";

// Hash the password using password_hash() function
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Display the hashed password
echo "Hashed Password: " . $hashed_password;
?>
