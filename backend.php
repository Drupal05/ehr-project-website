<?php
// Database connection details
$servername = "localhost";  // Usually 'localhost' for local development
$username = "root";         // Default username for MAMP is 'root'
$password = "root";         // Default password for MAMP is 'root'
$dbname = "user_data";      // Name of your database

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$dob = $_POST['dob'];
$age = $_POST['age'];
$school = $_POST['school'];

// Prepare and bind (to avoid SQL injection)
$stmt = $conn->prepare("INSERT INTO users (name, dob, age, school) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssis", $name, $dob, $age, $school);  // "ssis" = string, string, integer, string

// Execute the query
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
