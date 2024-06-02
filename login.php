<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Lab_7";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST["matric"];
    $name = $_POST["name"];

    $sql = "SELECT * FROM users WHERE matric='$matric' AND name='$name'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION["matric"] = $matric;
        header("Location: display.php");
    } else {
        echo "Invalid credentials";
    }
}

$conn->close();
?>
