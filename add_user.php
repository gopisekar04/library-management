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

$name = $_POST['name'];
$reg_no = $_POST['reg_no'];
$department = $_POST['department'];
$email = $_POST['email'];

$sql = "INSERT INTO student_details (register_no, name, email, department) VALUES ('$reg_no', '$name', '$email', '$department')";

// Execute SQL statement
if ($conn->query($sql) === TRUE) {
    // Redirect to login page
    echo "<script>alert('Sign up successful!')</script>";
    header("Location: login_page.html");
    exit();
} else {
    echo "Error: " . $conn->error;
}

// Close connection
$conn->close();
?>
