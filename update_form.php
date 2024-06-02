<?php
include 'database.php';
include 'User.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Check if 'matric' is set in the GET request
    if (isset($_GET['matric'])) {
        // Retrieve the matric value from the GET request
        $matric = $_GET['matric'];

        // Create an instance of the Database class and get the connection
        $database = new Database();
        $db = $database->getConnection();

        // Create an instance of the User class and fetch the user details
        $user = new User($db);
        $userDetails = $user->getUser($matric);

        $db->close();

        if ($userDetails) {
            // Display the update form with the fetched user data
            ?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Update User</title>
            </head>

            <body>
                <form action="update.php" method="post">
                    <input type="hidden" name="matric" value="<?php echo htmlspecialchars($userDetails['matric']); ?>">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($userDetails['name']); ?>"><br>
                    <label for="role">Role:</label>
                    <select name="role" id="role" required>
                        <option value="">Please select</option>
                        <option value="lecturer" <?php if ($userDetails['role'] == 'lecturer') echo "selected"; ?>>Lecturer</option>
                        <option value="student" <?php if ($userDetails['role'] == 'student') echo "selected"; ?>>Student</option>
                    </select><br>
                    <input type="submit" value="Update">
                </form>
            </body>

            </html>
            <?php
        } else {
            echo "Error fetching user: No user found with the provided matric number.";
        }
    } else {
        echo "Error: Matric number is not provided.";
    }
}
?>
