<?php
include 'database.php';
include 'User.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Check if 'matric' is set in the GET request
    if (isset($_GET['matric'])) {
        // Retrieve the matric value from the GET request
        $matric = $_GET['matric'];

        // Create an instance of the Database class and get the connection
        $database = new Database();
        $db = $database->getConnection();

        // Create an instance of the User class
        $user = new User($db);
        $user->deleteUser($matric);

        // Close the connection
        $db->close();
    } else {
        // Handle the case when 'matric' is not provided in the GET request
        echo "Matric value is required.";
    }
}
?>
