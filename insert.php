<?php
include 'database.php';
include 'User.php';

// Create an instance of the Database class and get the connection
$database = new Database();
$db = $database->getConnection();

// Create an instance of the User class
$user = new User($db);

// Check if POST data is set before using it
$matric = isset($_POST['matric']) ? $_POST['matric'] : null;
$name = isset($_POST['name']) ? $_POST['name'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;
$role = isset($_POST['role']) ? $_POST['role'] : null;

if ($matric && $name && $password && $role) {
    // Register the user using POST data
    $user->createUser($matric, $name, $password, $role);
} else {
    echo "All fields are required.";
}

// Close the connection
$db->close();
?>
