<!DOCTYPE html>
<html>
<head>
	<title>Success Page</title>
	<style>            
        p{
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;

        }
        span{
            font-weight: bold;
            background-image: url("https://cdn.pixabay.com/photo/2017/01/07/15/07/bible-1960635_1280.jpg");
            height:100vh;


        }

	</style>
</head>
<body>
	<div class="student-dashboard-bg-container">
		<div>
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

            $register_no = $_GET['register_no'];

            $sql = mysqli_query($conn, "SELECT * FROM student_details WHERE register_no = '$register_no'");
            
            if (!$sql) {
                die("Query failed: " . mysqli_error($conn));
            }

            if (mysqli_num_rows($sql) > 0){
                
                $row = mysqli_fetch_assoc($sql);
                $name = $row['name'];
                $reg_no = $row['register_no'];
                $email = $row['email'];
                $dept = $row['department'];


            }
            ?>

                <p><span>Name: </span> <?php echo $name ?></p>
                <p><span>Register_no: </span><?php echo $reg_no?></p>
                <p><span>Email: </span><?php echo $email?></p>
                <p><span>Department: </span><?php echo $dept?></p>
		</div>
	</div>
</body>
</html> 