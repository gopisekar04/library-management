<?php
// Establish connection to transaction database
$host = "localhost";
$username = "root";
$password = "";
$dbname = "transaction_database";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$reg_no = $_POST['register_no'];
$isbn = $_POST['isbn_no'];

// Check if the book is borrowed
$sql = "SELECT * FROM transactions WHERE reg_no = '$reg_no' AND book_no = '$isbn' AND status = 'Borrowed'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Book is borrowed, update the status to "Returned"
    $updateSql = "UPDATE transactions SET status = 'Returned' WHERE reg_no = '$reg_no' AND book_no = '$isbn' AND status = 'Borrowed'";
    
    if ($conn->query($updateSql) === true) {
        echo "Book returned successfully!";
        header("refresh:2; url=admin_dashboard.php");
        exit;
    } else {
        echo "Error updating book status: " . $conn->error;
    }
} else {
    echo "Book is not currently borrowed by the student.";
}

// Close the database connection
$conn->close();
?>
