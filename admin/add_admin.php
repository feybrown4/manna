<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar bg-light pe-4 pb-3">
            <nav class="navbar">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-dark"><i class="fa  me-2"></i>Manna</h3>
                </a>
                <div class="navbar-nav w-100">
                    <a href="index.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="manage_admin.php" class="nav-item nav-link active"><i class="fa fa-users me-2"></i>Manage</a>
                    <a href="manage_category.php" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Category</a>
                    <a href="manage_fruit.php" class="nav-item nav-link"><i class="fa fa-carrot me-2"></i>Fruit</a>
                    <a href="manage_order.php" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Order</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php
            include('../includes/admin_navbar.php');
            ?>
            <!-- Navbar End -->
            <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if (isset($_SESSION['emailExist'])) {
                echo $_SESSION['emailExist'];
                unset($_SESSION['emailExist']);
            }
            if (isset($_SESSION['usernameExist'])) {
                echo $_SESSION['usernameExist'];
                unset($_SESSION['usernameExist']);
            }
            ?>
            <!-- Add Admin Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6 pt-4">
                        <div class="bg-light rounded h-100 p-4">
                            <div class="mb-4">
                                <h6>Add Admin</h6>
                                <span class="form-text">Fill out the form to create an admin</span>
                            </div>
                            <form action="" method="POST">
                                <div class="row mb-3">
                                    <label for="inputFullName" class="col-sm-2 col-form-label">Fullname </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control"  id="inputText" required name="inputFullName">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="email" class="col-sm-2 col-form-label">Email </label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="email" required name="email">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputUsername" name="inputUsername" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="inputPassword" required name="inputPassword">
                                    </div>
                                </div>

                                <input type="submit" name="submit" value="Create Admin" class="btn btn-success"></input>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Admin End -->




            <!-- Footer Start -->
            <?php
            include('../includes/admin_footer.php');
            ?>
            <!-- Footer End -->
        </div>
        <!-- Content End -->

        <?php
        //1. get the data
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $full_name = $_POST['inputFullName'];
            $username = $_POST['inputUsername'];
            $password = md5($_POST['inputPassword']);

            // Combine checks for email and username in a single query
            $checkQuery = "SELECT * FROM admin WHERE email='$email' OR user_name='$username'";
            $resCheck = mysqli_query($con, $checkQuery);

            if (mysqli_num_rows($resCheck) > 0) {
                $row = mysqli_fetch_assoc($resCheck);
                if ($row['email'] == $email) {
                    $_SESSION['emailExist'] = '<div class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
                                    Email already exists. Please use a different email.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                } elseif ($row['user_name'] == $username) {
                    $_SESSION['usernameExist'] = '<div class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
                                    Username already exists. Please use a different username.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                }
                echo '<script> location.replace("add_admin.php"); </script>';
            } else {
                //2. create query for insertion
                $sql = "INSERT INTO admin SET
        email='$email',
        full_name='$full_name',
        user_name='$username',
        password='$password'
        ";


                // 3. connect with db and execute query
                // $conn = mysqli_connect('localhost', 'username', 'password') or die(mysqli_error());
                // $db_select = mysqli_select_db($conn, 'manna') or die(mysqli_error());
                $res = mysqli_query($con, $sql);

                //4. check whether data was inserted
                if ($res == true) {
                    //echo "admin deleted";

                    $_SESSION['add'] = ' <div class="alert alert-success alert-dismissible fade show" id="alert" role="alert">
                                     Admin Created Successfully                               
                                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>';
                    echo  '<script> location.replace("manage_admin.php"); </script>';
                } else {

                    $_SESSION['failed'] = ' <div class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
                                   Failed to Create Admin 
                                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>';
                    echo  '<script> location.replace("add_category.php"); </script>';
                }
            }
        }
        ?>
        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-success btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>




    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script>
        $(document).ready(function() {
            document.getElementById("spinner").style.display = "none";
            setTimeout(function() {
                $("#alert").fadeOut("slow", function() {
                    $(this).remove();
                });
            }, 5000); // 5000ms 
        });
    </script>
</body>

</html>