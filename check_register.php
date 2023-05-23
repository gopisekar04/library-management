<html>
    <head>

    </head>
    <body>
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

        // Get register number from HTML form
        $register_no = $_POST["register_no"];

        // Check if register number exists in database
        $sql = "SELECT * FROM student_details WHERE register_no = $register_no";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Register number exists in database, redirect to success page
            header("Location: success.php?register_no=" . urlencode($register_no));
            exit();
        } else {
            // Register number does not exist in database, print error message
            echo "Not yet registered...";
            
        }
        $conn->close();
        ?>
        <a href = "sign-up.html">sign-up  now!</a>
    </body>
</html>