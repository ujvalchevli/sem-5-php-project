<?php 

include 'connect.php';
$id=$_GET['id'];

$query = "DELETE FROM tbl_audio WHERE `tbl_audio`.`id` = $id";
$result = mysqli_query($con, $query);
if($result>0){
    header("location: audio.php");
}else{
    echo "<script>alert('Error deleting category');</script>";
}

$con->close();
?>