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
                    <a href="manage_category.php" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Category</a>
                    <a href="manage_fruit.php" class="nav-item nav-link active"><i class="fa fa-carrot me-2"></i>Fruits</a>
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
                if (isset($_SESSION['imageFailed'])) {
                    echo $_SESSION['imageFailed'];
                    unset($_SESSION['imageFailed']);
                }
                if (isset($_SESSION['add'])) {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if (isset($_SESSION['failed'])) {
                    echo $_SESSION['failed'];
                    unset($_SESSION['failed']);
                }
                ?>

                <?php
                if (isset($_GET['id'])) {

                    $id = $_GET['id'];
                    $sql2 = "SELECT * from fruit where id=$id";
                    $res2 = mysqli_query($con, $sql2);
                    $row2 = mysqli_fetch_assoc($res2);

                    $title = $row2['title'];
                    $description = $row2['description'];
                    $price = $row2['price'];
                    $current_image = $row2['image_name'];
                    $current_category = $row2['category_id'];
                    $featured = $row2['feature'];
                    $active = $row2['active'];
                } else {

                    echo '<script> location.replace("add_fruit.php"); </script>';
                }


                ?>

                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6 pt-4">
                        <div class="bg-light rounded h-100 p-4">
                            <div class="mb-4">
                                <h6>Update Fruit</h6>
                                <span class="form-text">Fill out the form to update fruit</span>
                            </div>
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label for="title" class="col-sm-2 col-form-label">Title </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="title" name="title" value="<?php echo $title ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="price" class="col-sm-2 col-form-label">Price </label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="price" value="<?php echo $price ?>" name="price">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="price" class="col-sm-2 col-form-label">Category </label>
                                    <div class="col-sm-10">
                                        <select class="form-select mb-3" name="category" aria-label="Default select example">
                                            <?php

                                            $sql = "SELECT * FROM category where active = 'Yes'";
                                            $res = mysqli_query($con, $sql);

                                            $count = mysqli_num_rows($res);

                                            if ($count > 0) {
                                                while ($row = mysqli_fetch_assoc($res)) {
                                                    $id = $row['id'];

                                                    $title = $row['title'];
                                            ?>
                                                    <option <?php if ($current_category == $id) {
                                                                echo 'selected';
                                                            } ?> value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">no category found</option>

                                            <?php
                                            }


                                            ?>

                                        </select>
                                    </div>
                                </div>
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Featured</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" <?php if ($featured == 'Yes') {
                                                                                echo 'checked';
                                                                            } ?> type="radio" name="featured" id="featuredYes" value="Yes" checked>
                                            <label class="form-check-label" for="featuredYes">Yes</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" <?php if ($featured == 'No') {
                                                                                echo 'checked';
                                                                            } ?> type="radio" name="featured" id="featuredNo" value="No">
                                            <label class="form-check-label" for="featuredNo">No</label>
                                        </div>
                                    </div>

                                </fieldset>
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Active</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" <?php if ($active == 'Yes') {
                                                                                echo 'checked';
                                                                            } ?> type="radio" name="active" id="activeYes" value="Yes" checked>
                                            <label class="form-check-label" for="activeYes">Yes</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" <?php if ($featured == 'No') {
                                                                                echo 'checked';
                                                                            } ?> type="radio" name="active" id="activeNo" value="No">
                                            <label class="form-check-label" for="activeNo">No</label>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="row mb-3 mt-4 w-100 h-50">
                                    <span for="title" class="col-sm-2 col-form-label">Current Image </span>
                                    <div class="col-sm-10">
                                        <?php
                                        if ($current_image  != "") {

                                        ?>
                                            <img src="<?php SITEURL; ?>img/fruit/<?php echo $current_image ?>" alt="Fruit image" class="w-50 h-50">

                                        <?php

                                        } else {
                                            echo "<div class='text-danger'> Image is not added </div>";
                                        }


                                        ?>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div><label for="title" class="col-sm-2 col-md-2 col-lg-10 col-form-label">Upload Image </label></div>

                                    <div class="col-sm-10 col-md-10 col-lg-10">
                                        <input class="form-control" type="file" name="image">
                                    </div>
                                </div>
                                <div class="form-floating mb-3 row">
                                    <textarea class="form-control" placeholder="Leave a comment here"
                                        id="floatingTextarea" name="description" style="height: 150px;"><?php echo  $description ?></textarea>
                                    <label for="floatingTextarea">Comments</label>
                                </div>
                                <input type="hidden" name="id" value="<?php echo $id ?>">
                                <input type="hidden" name="current_image" value="<?php echo $current_image ?>">
                                <input type="submit" name="submit" value="Update" class="btn btn-warning px-3">
                            </form>


                            <?php
                            //1. get the data

                            if (isset($_POST['submit'])) {
                                $id = $_POST['id'];
                                $title = $_POST['title'];
                                $description = $_POST['description'];
                                $price = $_POST['price'];
                                $current_image = $_POST['current_image'];
                                $category = $_POST['category'];
                                $featured = $_POST['featured'];
                                $active = $_POST['active'];

                        

                                if (isset($_FILES['image']['name'])) {

                                    $image_name = $_FILES['image']['name'];

                                    if ($image_name != "") {

                                        $ext = pathinfo($image_name, PATHINFO_EXTENSION);

                                        $image_name = "fruit_" . rand(000, 999) . '.' . $ext;

                                        $temp = $_FILES['image']['tmp_name'];

                                        $dir = "img/fruit/" . $image_name;

                                        $upload = move_uploaded_file($temp, $dir);


                                        //check image uploaded
                                        if ($upload == false) {
                                            $_SESSION['imageFailed'] = '<div class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
                                                                       Image upload failed
                                                                       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                        </div>';
                                            echo '<script> location.replace("manage_fruit.php"); </script>';
                                        }

                                        if ($current_image != "") {
                                            $remove_path = "img/fruit/" . $current_image;
                                            $remove = unlink($remove_path);

                                            if ($remove == false) {
                                                $_SESSION['remove'] = ' <div class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
                                                                       Failed to remove category current image                            
                                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                       </div>';
                                                                       echo '<script>location.replace("manage_fruit.php");</script>';
                                          
                                            }
                                        }
                                    } else {
                                        $image_name = $current_image;
                                    }
                                } else {
                                    $image_name = $current_image;
                                }



                                //updating new image
                                $sql3 = "UPDATE fruit SET 
                                title = '$title',
                                description=  '$description',
                                price = $price,
                                image_name = '$image_name',
                                category_id = '$category',
                                feature = '$featured',
                                active = '$active'                                                
                                 WHERE id= $id";


                                $res3 = mysqli_query($con, $sql3);
                                echo "<div>$res3</div>";

                                if ($res3 == true) {
                                    $_SESSION['update'] = '<div class="alert alert-success alert-dismissible fade w-50 show" id="alert" role="alert">
                                    Fruit Updated Successfully                               
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                   </div>';
                                    echo '<script>location.replace("manage_fruit.php");</script>';
                                } else {
                                    $_SESSION['update'] = '<div class="alert alert-danger alert-dismissible fade w-50 show" id="alert" role="alert">
                                    Category Failed to update                               
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                   </div>';
                                    echo '<script>location.replace("manage_fruit.php");</script>';
                                }
                               
                            }
                            ?>

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