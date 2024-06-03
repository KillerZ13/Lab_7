<?php
include 'database.php';
include 'User.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") 
{
    if(isset($_GET['matric']))
    {
    // Retrieve the matric value from the POST request
    $matric = $_GET['mtric'];
a
    // Create an instance of the Database class and get the connection
    $database = new Database();
    $db = $database->getConnection();

    // Create an instance of the User class
    $user = new User($db);
    $user->deleteUser($matric);

    // Close the connection
    $db->close();
    }
    else
    {
        echo "Matric value is not set in the GET request.";
    }
}
?>