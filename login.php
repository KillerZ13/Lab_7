<?php
// Replace these with your actual database connection details
$servername = "localhost";
$username = ""; // Replace with your actual MySQL username
$password = "123";
$dbname = "Lab_7";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Initialize variables to store form data
$matric = "";
$password = "";

// Check if form data is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Check if matric and password are set and not empty
  if (isset($_POST["matric"]) && isset($_POST["password"])) {
      $matric = $_POST["matric"];
      $password = $_POST["password"];

      // SQL query to check if user exists
      $sql = "SELECT * FROM users WHERE matric = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $matric);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
          // User found, verify the password
          $row = $result->fetch_assoc();
          $hashed_password = $row['password'];

          if (password_verify($password, $hashed_password)) {
              // Password is correct, redirect to a welcome page or dashboard
              session_start();
              $_SESSION['matric'] = $matric; // Store matric in session for further use
              header("Location: welcome.php");
              exit();
          } else {
              // Password is incorrect
              echo "Invalid password";
          }
      } else {
          // User not found
          echo "Invalid matric";
      }
  } else {
      // Handle case where matric or password is not set or empty
      echo "Matric and password must be provided.";
  }
}

$conn->close();

?>
