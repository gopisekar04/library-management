<?php
//Connect to database
$host = "localhost";
$username = "root";
$password = "";
$dbname = "transaction_database";
$conn = mysqli_connect($host, $username, $password, $dbname);

// Connection to Transaction Database
$transaction_dbname = "transaction_database";
$transaction_conn = mysqli_connect($host, $username, $password, $transaction_dbname);
if (!$transaction_conn) {
    die("Connection to transaction database failed: " . mysqli_connect_error());
}

// Connection to Student Database
$student_dbname = "student_database";
$student_conn = mysqli_connect($host, $username, $password, $student_dbname);
if (!$student_conn) {
    die("Connection to student database failed: " . mysqli_connect_error());
}

//Retrieve form data
$reg_no = $_POST['reg_no'];
$book_no = $_POST['isbn'];

// Check if the reg_no exists in the student database
$sql = "SELECT COUNT(*) AS student_count FROM student_details WHERE register_no = '$reg_no'";
$result = mysqli_query($student_conn, $sql);
$row = mysqli_fetch_assoc($result);
$student_count = $row['student_count'];

// Check if the reg_no exists in the student database
if ($student_count == 0) {
    // Registration number does not exist in the student database
    // Error adding transaction details
    echo "Invalid registration number!\n Please enter a valid registration number....";
    echo "\nRedirecting to Checkout page...";
    header("refresh:2; url=transaction.html");
    exit;
}



// Check the number of existing transactions for the given reg_no
$sql = "SELECT COUNT(*) AS transaction_count FROM transactions WHERE reg_no = '$reg_no'";
$result = mysqli_query($transaction_conn, $sql);
$row = mysqli_fetch_assoc($result);
$transaction_count = $row['transaction_count'];

// Check if the maximum limit of 4 transactions has been reached
if ($transaction_count >= 4) {
    // Maximum transaction limit reached
    echo "Maximum transaction limit reached for the given registration number!";
    header("refresh:2; url=transaction.html");
    exit;
}


//Generate transaction ID
$sql = "SELECT MAX(transaction_id) AS max_id FROM transactions";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$new_id = $row['max_id'] + 1;

// Current date in d-m-y format
$borrow_date = date_create()->format('y-m-d');

// Due date in d-m-y format, 7 days from now
$due_date = date_create()->modify('+7 days')->format('y-m-d');

$return_date = date_create()->modify('+10 days')->format('y-m-d');


//Insert transaction details into database
$sql = "INSERT INTO transactions (transaction_id, reg_no, book_no, borrow_date, due_date, return_date, status) VALUES ('$new_id', '$reg_no', '$book_no', '$borrow_date', '$due_date', '$return_date', 'Borrowed')";
if (mysqli_query($conn, $sql)) {
    //Transaction details added successfully
    echo "New transaction details added successfully!\n";
    echo "Redirecting to home page....";
    header("refresh:3; url=admin_dashboard.php");
    exit;
} else {
    // Error adding transaction details
    $message = "Error adding transaction details: " . mysqli_error($conn);
    $alertType = "danger";
    echo '<div class="alert alert-danger" role="alert">
        ' . $message . '
    </div>';
}

?>
