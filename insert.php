<?php
include 'database.php';
include 'User.php';

// Create an instance of the Database class and get the connection
$database = new database();
$db = $database->getConnection();

// Create an instance of the User class
$user = new User($db);

// Check if POST data is set before trying to use it
if (isset($_POST['matric']) && isset($_POST['name']) && isset($_POST['password']) && isset($_POST['role'])) {
    // Register the user using POST data
    $user->createUser($_POST['matric'], $_POST['name'], $_POST['password'], $_POST['role']);
} else {
    echo "Required fields are missing.";
}

// Close the connection
$db->close();
?>
