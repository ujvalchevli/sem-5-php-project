<?php
include 'connect.php';
$id = $_GET['id'];
$query = "DELETE FROM tbl_album WHERE `tbl_album`.`Aid` = $id";
$result = mysqli_query($con, $query);
if ($result > 0) {
    header("location: album.php");
} else {
    echo "<script>alert('Error deleting album');</script>";
}
?>