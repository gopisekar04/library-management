<?php

// Establish connection to student database
$studentHost = "localhost";
$studentUsername = "root";
$studentPassword = "";
$studentDBName = "student_database";

$studentConn = new mysqli($studentHost, $studentUsername, $studentPassword, $studentDBName);

if ($studentConn->connect_error) {
    die("Student database connection failed: " . $studentConn->connect_error);
}

// Establish connection to transaction database
$transactionHost = "localhost";
$transactionUsername = "root";
$transactionPassword = "";
$transactionDBName = "transaction_database";

$transactionConn = new mysqli($transactionHost, $transactionUsername, $transactionPassword, $transactionDBName);

if ($transactionConn->connect_error) {
    die("Transaction database connection failed: " . $transactionConn->connect_error);
}

// Query to join student_details and transactions tables
$sql = "SELECT sd.email
        FROM student_database.student_details AS sd
        JOIN transaction_database.transactions AS t ON sd.register_no = t.reg_no
        WHERE t.status = 'Borrowed'";

$result = $transactionConn->query($sql);

if ($result->num_rows > 0) {
    // Create an array to store the recipient email addresses
    $recipients = array();

    // Loop through the query result and populate the recipients array
    while ($row = $result->fetch_assoc()) {
        $recipients[] = $row['email'];
    }

    // Convert the array of recipients to a comma-separated string
    $recipients_str = implode(',', $recipients);

    echo $recipients_str;

    // Execute the Python script passing the recipients as a command-line argument
    //$command = "python send_email.py \"$recipients_str\"";
    $pythonExecutable = "C:\\Users\\hp\\AppData\\Local\\Programs\\Python\\Python39\\python.exe"; // Specify the desired Python executable path
    $scriptPath = "C:\\xampp\\htdocs\\LibraryAlertSystem\\send_email.py"; // Replace with the actual path to send_email.py
    $command = "{$pythonExecutable} {$scriptPath} \"{$recipients_str}\"";
    exec($command, $output, $return_var);

    if ($return_var === 0) {
        echo "Alert send Successfully";
        header("refresh:2; url=admin_dashboard.php");
    } else {
        echo "Failed to send emails.";
        echo "Command output: " . implode("\n", $output);
    }
} else {
    echo "No recipients found.";
}

// Close the database connections
$studentConn->close();
$transactionConn->close();
?>
