<?php

include 'database.php';
include 'User.php';

if (isset($_POST['submit']) && ($_SERVER['REQUEST_METHOD'] == 'POST')) {
    // Create database connection
    $database = new Database();
    $db = $database->getConnection();

    if ($db) {
        // Sanitize inputs using mysqli_real_escape_string
        $matric = $db->real_escape_string($_POST['matric']);
        $password = $db->real_escape_string($_POST['password']);

        // Validate inputs
        if (!empty($matric) && !empty($password)) {
            $user = new User($db);
            $userDetails = $user->getUser($matric);

            if ($userDetails) {
                // Debugging: Check retrieved user details
                echo '<pre>';
                print_r($userDetails);
                echo '</pre>';

                // Check if user exists and verify password
                if (password_verify($password, $userDetails['password'])) {
                    echo 'Login Successful';
                } else {
                    echo 'Login Failed: Incorrect password';
                }
            } else {
                echo 'Login Failed: User not found';
            }
        } else {
            echo 'Please fill in all required fields.';
        }
    } else {
        echo 'Database connection failed';
    }
}
?>
