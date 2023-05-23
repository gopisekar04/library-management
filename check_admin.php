<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn -> connect_error){
    die("connection failed");
}
$admin_id = $_POST['admin_id'];
$admin_password = $_POST["password"];

$sql = "SELECT * FROM admin_details WHERE phone_no = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("s", $admin_password);

$stmt->execute();

$result = $stmt->get_result();


if (!$result) {
    die("Query execution failed: " . mysqli_error($conn));
}


if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $admin_id = $row['admin_id'];
    $admin_name = $row['name'];
    $admin_designation = $row['designation'];
    $admin_dept = $row['department'];
    $admin_email = $row['email_id'];
    $admin_ph = $row['phone_no'];

}
session_start();
$_SESSION['name'] = $admin_name;

// Redirect to admin_dashboard.html
header("refresh:2; url=admin_dashboard.php");
exit;
?>