<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Manna - Manna Admin </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Include SweetAlert CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.css" />

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
            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="d-flex justify-content-between align-items-center">
                    <a type="submit" class="btn btn-success my-4" href="add_admin.php">Create Admin</a>
                    <!-- <span class="ms-auto my-4">make money</span> -->


                    <?php
                    if (isset($_SESSION['add'])) {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                    if (isset($_SESSION['delete'])) {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if (isset($_SESSION['update'])) {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    if (isset($_SESSION['reset'])) {
                        echo $_SESSION['reset'];
                        unset($_SESSION['reset']);
                    }

                    if (isset($_SESSION['pwdUpdated'])) {
                        echo $_SESSION['pwdUpdated'];
                        unset($_SESSION['pwdUpdated']);
                    }
                    if (isset($_SESSION['pwdMissMatch'])) {
                        echo $_SESSION['pwdMissMatch'];
                        unset($_SESSION['pwdMissMatch']);
                    }
                    if (isset($_SESSION['pwdFailed'])) {
                        echo $_SESSION['pwdFailed'];
                        unset($_SESSION['pwdFailed']);
                    }
                    if (isset($_SESSION['emailExist'])) {
                        echo $_SESSION['emailExist'];
                        unset($_SESSION['emailExist']);
                    }
                    if (isset($_SESSION['usernameExist'])) {
                        echo $_SESSION['usernameExist'];
                        unset($_SESSION['usernameExist']);
                    }
                    if (isset($_SESSION['login'])) {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                    ?>

                </div>

                <div class="col-12">
                    <div class="bg-light rounded h-100 p-4">
                        <h6 class="mb-4">Admin Table</h6>
                        <div class="table-responsive">
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th scope="col">#S.N</th>
                                        <th scope="col">Fullname</th>
                                        <th scope="col">Username </th>
                                        <th scope="col">Email </th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //query table
                                    $sql = "SELECT * FROM admin";

                                    //excute the query
                                    $res = mysqli_query($con, $sql);


                                    $sn = 1;
                                    //check wether the query is excute
                                    if ($res == TRUE) {
                                        //count rows
                                        $count = mysqli_num_rows($res);
                                        //check nums of rows
                                        if ($count > 0) {

                                            while ($rows = mysqli_fetch_assoc($res)) {
                                                $id = $rows['id'];
                                                $fullname = $rows['full_name'];
                                                $username = $rows['user_name'];
                                                $email = $rows['email'];


                                    ?>
                                                <tr>
                                                    <td><?php echo $sn++; ?></td>
                                                    <td><?php echo $fullname; ?></td>
                                                    <td><?php echo $username; ?></td>
                                                    <td><?php echo $email; ?></td>
                                                    <td>
                                                        <a class="btn btn-sm my-2 btn-success me-2" href="<?php echo SITEURL; ?>/admin/update_admin.php?id=<?php echo $id; ?>">Update</a>
                                                        <a class="btn btn-sm my-2 btn-warning me-2" href="<?php echo SITEURL; ?>/admin/reset_admin_password.php?id=<?php echo $id; ?>">Reset</a>
                                                        <a class="btn my-2 btn-sm btn-danger" onclick="confirmDelete('<?php echo $id; ?>')">Delete</a>
                                                    </td>
                                                </tr>
                                    <?php


                                            }
                                        } else {
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Recent Sales End -->


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
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#41ba1b',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'delete_admin.php?id=' + id;
                }
            })
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
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
            $('#myTable').DataTable();
            setTimeout(function() {
                $("#alert").fadeOut("slow", function() {
                    $(this).remove();
                });
            }, 5000); // 5000ms 
        });
    </script>
</body>

</html>