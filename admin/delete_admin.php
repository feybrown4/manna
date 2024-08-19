<?php
include('../connect.php');

//get id to be deleted
$id = $_GET['id'];

//create query
$sql = "DELETE FROM admin WHERE id =$id";

//excute query;
$res = mysqli_query($con, $sql);

// check whether the query executed sucessfully or not
if ($res == true) {
    //echo "admin deleted";
    $_SESSION['delete'] = ' <div class="alert alert-success alert-dismissible fade show" id="alert" role="alert">
                             Admin deleted Successfully                               
                             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
    header('location:'.SITEURL.'/admin/manage_admin.php');
} else {
    $_SESSION['delete'] = ' <div class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
                           Failed to delete Admin 
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
    header('location:'.SITEURL.'/admin/manage_admin.php');
}

?>