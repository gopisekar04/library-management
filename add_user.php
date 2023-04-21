<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement to insert user details into the database
$stmt = $conn->prepare("INSERT INTO student_details (name, register_no, department, email) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $reg_no, $department, $email);

// Set parameters
$name = $_POST["name"];
$reg_no = $_POST["reg_no"];
$department = $_POST["department"];
$email = $_POST["email"];

// Execute SQL statement
if ($stmt->execute()) {
	// Redirect to login page
	header("Location: login_page.html");
	exit();
} else {
	echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
