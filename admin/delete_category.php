<?php
include('../connect.php');

//get id to be deleted

if(isset($_GET['id']) AND isset($_GET['image_name'])){

   $id = $_GET['id'];
   $image_name = $_GET['image_name'];

   if($image_name != ""){
    $path ="img/category/" . $image_name;
    $remove = unlink( $path);

    if ($remove ==false){
        $_SESSION['remove'] = ' <div class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
        Failed to delete category image                            
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>';
       header('location:'.SITEURL.'/admin/manage_category.php');
       exit();
    }
    
   }


//create query
$sql = "DELETE FROM category WHERE id =$id";

//excute query;
$res = mysqli_query($con, $sql);

// check whether the query executed sucessfully or not
if ($res == true) {
   
    $_SESSION['delete'] = ' <div class="alert alert-success alert-dismissible fade show" id="alert" role="alert">
                             Category deleted Successfully                               
                             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
    header('location:'.SITEURL.'/admin/manage_category.php');
} else {
    $_SESSION['delete'] = ' <div class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
                           Failed to delete Category 
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
    header('location:'.SITEURL.'/admin/manage_category.php');
}
}else{
    header('location:'.SITEURL.'/admin/manage_category.php');
}

?>