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


            //get id to be deleted
            $id = $_GET['id'];


            //create query
            $sql = "SELECT * FROM admin where id=$id";

            //excute query;
            $res = mysqli_query($con, $sql);

            // check whether the query executed sucessfully 
            if ($res == true) {

                //check whether the table is available 
                $count = mysqli_num_rows($res);

                //check admin data
                if ($count == 1) {
                    $row = mysqli_fetch_assoc($res);
                    $fullname = $row['full_name'];
                    $username = $row['user_name'];
                    $email = $row['email'];
                } else {
                    echo  '<script> location.replace("update_admin.php"); </script>';
                }
            } else {
            }

            ?>

            <?php

            if (isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            ?>
            <!-- Add Admin Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6 pt-4">
                        <div class="bg-light rounded h-100 p-4">
                            <div class="mb-4">
                                <h6>Update Admin</h6>
                                <span class="form-text">Fill out the form to update an admin</span>
                            </div>
                            <form action="" method="POST">
                                <div class="row mb-3">
                                    <label for="inputFullName" class="col-sm-2 col-form-label">Fullname </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputText" required name="inputFullName" value="<?php echo $fullname; ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputUsername" name="inputUsername" required value="<?php echo $username; ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="email" name="email" required value="<?php echo $email; ?>">
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="<?php echo $id; ?>"></input>
                                <input type="submit" name="submit" value="Update" class="btn btn-warning px-3"></input>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Admin End -->

            <?php
            //1. Get the data
            if (isset($_POST['submit'])) {
                $id = $_POST['id'];
                $full_name = $_POST['inputFullName'];
                $username = $_POST['inputUsername'];
                $email = $_POST['email'];

                // Combine checks for email and username in a single query
                $checkQuery = "SELECT * FROM admin WHERE (email='$email' OR user_name='$username') AND id != '$id'";
                $resCheck = mysqli_query($con, $checkQuery);

                if (mysqli_num_rows($resCheck) > 0) {
                    $row = mysqli_fetch_assoc($resCheck);
                    if ($row['email'] == $email) {
                        $_SESSION['update'] = '<div class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
                                    Email already exists. Please use a different email.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                    } elseif ($row['user_name'] == $username) {
                        $_SESSION['update'] = '<div class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
                                    Username already exists. Please use a different username.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                    }
                    echo '<script> location.replace("update_admin.php?id=' . $id . '"); </script>';
                } else {
                    // Update the admin record
                    $sql = "UPDATE admin SET
                full_name='$full_name',
                user_name='$username',
                email='$email'
                WHERE id='$id'";

                    $res = mysqli_query($con, $sql);

                    // Check whether data was updated
                    if ($res == true) {
                        $_SESSION['update'] = '<div class="alert alert-success alert-dismissible fade show" id="alert" role="alert">
                                    Admin Updated Successfully                               
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                        echo '<script> location.replace("manage_admin.php"); </script>';
                    } else {
                        $_SESSION['update'] = '<div class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
                                    Failed to Update Admin 
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                        echo '<script> location.replace("update_admin.php?id=' . $id . '"); </script>';
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