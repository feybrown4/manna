<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Manna- Bootstrap Admin Template</title>
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
                    <a href="manage_food.php" class="nav-item nav-link"><i class="fa fa-carrot me-2"></i>Fruits</a>
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
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
            }
            if (isset($_SESSION['reset'])) {
                echo $_SESSION['reset'];
                unset($_SESSION['reset']);
            }
            if (isset($_SESSION['pwdMissMatch'])) {
                echo $_SESSION['pwdMissMatch'];
                unset($_SESSION['pwdMissMatch']);
            }
            ?>
            <!-- Add Admin Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">

                    <div class="col-sm-12 col-xl-6 pt-4">
                        <div class="bg-light rounded h-100 p-4">
                            <div class="mb-3">
                                <h6>Change Password</h6>
                                <span class="form-text">Fill out the form to change admin password</span>
                            </div>
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <label for="currentPassword" class="form-label">Current Password</label>
                                    <input type="password" class="form-control" id="currentPassword" name="currentPassword">

                                </div>

                                <div class="mb-3">
                                    <label for="newPassword" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="newPassword" name="newPassword">
                                </div>

                                <div class="mb-3">
                                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
                                </div>
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="submit" class="btn btn-warning px-3" name="submit" value="Update">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Admin End -->

            <?php

            //check whether submit button cliked
            if (isset($_POST['submit'])) {
                $id = $_POST['id'];
                $currentPassword = md5($_POST['currentPassword']);
                $newPassword = md5($_POST['newPassword']);
                $confirmPassword = md5($_POST['confirmPassword']);

                //2. create query for insertion
                $sql = "SELECT * FROM admin WHERE id=$id AND password='$currentPassword'";
                $res = mysqli_query($con, $sql);


                //4. check whether data was inserted
                if ($res == true) {
                    $count = mysqli_num_rows($res);
                    if ($count == 1) {
                        if ($newPassword == $confirmPassword ||  $currentPassword !=  $currentPassword) {

                            $sql2 = "UPDATE admin SET password='$newPassword' WHERE id='$id' ";
                            $res2 = mysqli_query($con, $sql2);
                            if ($res2 == true) {

                                $_SESSION['pwdUpdated'] = ' <div class="alert alert-success alert-dismissible fade show" id="alert" role="alert">
                            Password updated succesfully
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                             </div>';
                                echo  '<script> location.replace("manage_admin.php"); </script>';
                            } else {
                                $_SESSION['pwdfailed'] = ' <div class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
                            Password Failed to update
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                             </div>';
                                echo  '<script> location.replace("manage_admin.php"); </script>';
                            }
                        } else {
                            $_SESSION['pwdMissMatch'] = ' <div class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
                            Password did not match
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                             </div>';
                            echo  '<script> location.replace("manage_admin.php"); </script>';
                        }
                    } else {
                        $_SESSION['reset'] = ' <div class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
                    Admin not found
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>';
                        echo  '<script> location.replace("manage_admin.php"); </script>';
                    }
                }
            }

            ?>


            <!-- Footer Start -->
            <?php
            include('../includes/admin_footer.php');
            ?>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


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
</body>

</html>