<?php

// Replace these with your actual database connection details
$servername = "localhost";
$username = "root"; // Replace with your actual MySQL username
$password = "123";
$dbname = "Lab_7";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get form data
$matric = $_POST["matric"];
$password = $_POST["password"];

// Hash the password before storing it in the database
// You should have already hashed the password during registration and stored it in the database

// SQL query to check if user exists
$sql = "SELECT * FROM users WHERE matric='$matric'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // User found, verify the password
  $row = $result->fetch_assoc();
  $hashed_password = $row['password'];

  if (password_verify($password, $hashed_password)) {
    // Password is correct, redirect to a welcome page or dashboard
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

$conn->close();

?>
