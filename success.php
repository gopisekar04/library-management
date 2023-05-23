<!DOCTYPE html>
<html>
<head>
    <title>Success Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>        
        <script src="https://kit.fontawesome.com/af47678b69.js" crossorigin="anonymous"></script>
    <style>
        p {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        span {
            font-weight: bold;
        }

        .student-dashboard-bg-container {
            background-image: linear-gradient(-135deg, #c850c0, #4158d0);
            height: 100vh;
        }

        table {
            margin-top: 40px;
            width: 100%;
            text-align: center;
            border: 1px solid;
            border-color:black;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border: 1px solid;
            border-color: black;
            background-color: #ffffff;
            

        }
        th {
            background-color: #ffffff;
            height: 40px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="student-dashboard-bg-container">
                    <div>
                        <?php 
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "transaction_database";
                        
                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        
                        // Check connection 
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $register_no = $_GET['register_no'];

                        $sql = "SELECT * FROM transactions WHERE reg_no = '$register_no'";
                        $result = $conn->query($sql);

                        if (!$result) {
                            die("Query failed: " . $conn->error);
                        }
                        ?>
                        
                        <h1 class="text-center pt-5">Borrowed Books</h1>

                        <table>
                            <thead>
                                <tr>
                                    <th>Book No</th>
                                    <th>Borrow Date</th>
                                    <th>Due Date</th>
                                    <th>Return Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        //$bookTitle = $row['book_title'];
                                        $bookNo = $row['book_no'];
                                        $borrowDate = $row['borrow_date'];
                                        $dueDate = $row['due_date'];
                                        $returnDate = $row['return_date'];
                                        $status = $row['status'];

                                        ?>
                                        <tr>
                                            <td><?php echo $bookNo; ?></td>
                                            <td><?php echo $borrowDate; ?></td>
                                            <td><?php echo $dueDate; ?></td>
                                            <td><?php echo $returnDate; ?></td>
                                            <td><?php echo $status; ?></td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="5">No borrowed books found.</td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
