<?php 

include 'connect.php';
$id=$_GET['id'];

$query = "DELETE FROM tbl_catagory WHERE `tbl_catagory`.`cat_id` = $id";
$result = mysqli_query($con, $query);
if($result>0){
    header("location: category.php");
}else{
    echo "<script>alert('Error deleting category');</script>";
}

$con->close();
?>