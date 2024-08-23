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
                    <a href="manage_admin.php" class="nav-item nav-link"><i class="fa fa-users me-2"></i>Manage</a>
                    <a href="manage_category.php" class="nav-item nav-link active"><i class="fa fa-keyboard me-2"></i>Category</a>
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

            <!-- Add Admin Start -->
            <div class="container-fluid pt-4 px-4">
                <?php

                if (isset($_SESSION['failed'])) {
                    echo $_SESSION['failed'];
                    unset($_SESSION['failed']);
                }
                if (isset($_SESSION['imageFailed'])) {
                    echo $_SESSION['imageFailed'];
                    unset($_SESSION['imageFailed']);
                }
                if (isset($_SESSION['remove'])) {
                    echo $_SESSION['remove'];
                    unset($_SESSION['remove']);
                }
                if (isset($_SESSION['noRecord'])) {
                    echo $_SESSION['noRecord'];
                    unset($_SESSION['noRecord']);
                }

                ?>
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6 pt-4">
                        <div class="bg-light rounded h-100 p-4">
                            <div class="mb-4">
                                <h6>Add Category</h6>
                                <span class="form-text">Fill out the form to create category</span>
                            </div>
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label for="title" class="col-sm-2 col-form-label">Title </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="title" required name="title">
                                    </div>
                                </div>
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Featured</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="featured" id="featuredYes" value="Yes" checked>
                                            <label class="form-check-label" for="featuredYes">Yes</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="featured" id="featuredNo" value="No">
                                            <label class="form-check-label" for="featuredNo">No</label>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Active</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="active" id="activeYes" value="Yes" checked>
                                            <label class="form-check-label" for="activeYes">Yes</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="active" id="activeNo" value="No">
                                            <label class="form-check-label" for="activeNo">No</label>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="mb-3 row">
                                    <div><label for="title" class="col-sm-2 col-md-2 col-lg-10 col-form-label">Upload Image </label></div>

                                    <div class="col-sm-10 col-md-10 col-lg-10">
                                        <input class="form-control" type="file" name="image">
                                    </div>
                                </div>

                                <div class="form-floating mb-3 row">
                                    <textarea class="form-control" placeholder="Leave a comment here"
                                        id="floatingTextarea" name="description" style="height: 150px;"></textarea>
                                    <label for="floatingTextarea">Comments</label>
                                </div>
                                <input type="submit" name="submit" value="Add" class="btn btn-success px-3">
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
            $title = $_POST['title'];
            $description = $_POST['description'];
            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            } else {
                $featured = "No";
            }
            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No";
            }

            // Assuming image upload has already happened successfully and the file name is stored in $_SESSION['image_name']
            if (isset($_FILES['image']['name'])) {

                $image_name = $_FILES['image']['name'];

                $ext = end(explode('.',  $image_name));

                $image_name = "fruit_category" . rand(000, 999) . '.' . $ext;

                $temp = $_FILES['image']['tmp_name'];

                $dir = "img/category/" . $image_name;

                $upload = move_uploaded_file($temp, $dir);


                //check image uploaded
                if ($upload == false) {
                    $_SESSION['imageFailed'] = '<div class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
                   Image upload failed
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                    echo '<script> location.replace("add_category.php"); </script>';
                    exit();
                }
            } else {
                $image_name = "";
            }

            // Combine checks for email and username in a single query
            $sql = "INSERT INTO category SET title='$title', feature='$featured', comment = '$description',  image_name='$image_name', active='$active'";
            $res = mysqli_query($con, $sql);

            // Check whether data was inserted
            if ($res == true) {
                $_SESSION['add'] = '<div class="alert alert-success alert-dismissible fade w-50 show" id="alert" role="alert">
                            Category Created Successfully                               
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                           </div>';
                echo '<script>location.replace("manage_category.php");</script>';
            } else {
                $_SESSION['failed'] = '<div class="w-50 alert alert-danger alert-dismissible fade show" id="alert" role="alert">
                               Failed to Create Category 
                               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                               </div>';
                echo '<script>location.replace("add_category.php");</script>';
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

    <!-- Initialize Dropzone -->


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