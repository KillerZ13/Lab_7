<?php

// Replace these with your actual database connection details
$servername = "localhost";
$username = "";
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
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// SQL query to check if user exists
$sql = "SELECT * FROM users WHERE matric='$matric' AND password='$hashed_password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // User found, redirect to a welcome page or dashboard
  header("Location: welcome.php");
} else {
  // User not found, display an error message
  echo "Invalid matric or password";
}

$conn->close();
