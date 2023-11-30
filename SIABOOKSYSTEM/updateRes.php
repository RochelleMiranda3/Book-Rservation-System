<?php 
include "db.php";

if(isset($_GET['res_Id'])) {
    $res_Id = $_GET['res_Id'];

    $query = "UPDATE reservetable SET Status = 'Returned' WHERE ReserveID = $res_Id";
    $update_user = mysqli_query($conn, $query);

    $query = "UPDATE returntable SET Status = 'Returned' WHERE ReserveID = $res_Id";
    $update_user = mysqli_query($conn, $query);
    echo "<script type='text/javascript'>alert('Book data updated successfully!')</script>";
     header("Location: return_details.php");
} else {
    echo "<script type='text/javascript'>alert('sdfsdfsdfsdfsdfully!')</script>";

}
?>
