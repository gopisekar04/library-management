<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>        
        <script src="https://kit.fontawesome.com/af47678b69.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="admin_dashboard_style2.css">
    </head>
    <body>
        <div>
            <div class="container-fluid admin_dashboard_bg-container">
                <div class="row">
                <div class="col-12">
                <div class="adminDashboard_container">
                    <nav class="navbar navbar-expand-lg navbar-light bg-white mt-3 admin_dash_navbar">
                        <a class="navbar-brand"> <i class="fa-solid fa-user icon_admin_dash "></i>
                            Admin Dashboard <span id="adminName"></span></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse  d-flex flex-row justify-content-end" id="navbarNavAltMarkup">
                        <div class="navbar-nav ">
                            <a class="nav-link active" href="admin_dashboard.php">Home <span class="sr-only">(current)</span></a>
                            <a class="nav-link text-dark" href="transaction.html">Ckeckout</a>
                            <a class="nav-link text-dark" href="alert.php" >Send Alert</a>   
                            <a class="nav-link text-dark" href="transaction.html">Return Book</a>                                                                                               
                            <a class="nav-link text-dark" href="admin_login.html">logout<i class="fa-regular fa-person-from-portal"></i></a>
                        </div>
                        </div>
                    </nav>            
                    <div class="home_container">
                        <div class="return_container mt-5 m-auto">
                            <h2 class="p-4">Return</h2>
                            <form method="post" action="return_book.php">
                                <label>Register No: <input type="text" name="register_no" placeholder="Enter Register No" required/></label>
                                <label>ISBN No: <input type="text" name="isbn_no" placeholder="Enter ISBN NO" required/></label>
                                <div class="btn-style">
                                    <button class="btn btn-primary mb-5" type="submit">Return Book</button>
                                </div>
                            </form>                        
                        </div>
                    </div>
                </div>
            </div>
                </div>
            </div>
        </div>
    <script>
        // Retrieve admin details from session using JavaScript
        let name = '<?php echo isset($_SESSION["name"]) ? $_SESSION["name"] : "" ?>';
        console.log(name);

        // Set the admin name in the HTML element
        document.getElementById('adminName').textContent = name;
    </script>
    </body>
</html>
