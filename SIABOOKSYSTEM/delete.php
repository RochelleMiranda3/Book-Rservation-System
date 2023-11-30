<?php 
include "db.php";

if (isset($_GET['delete_book'])) {
    $bookId = $_GET['delete_book'];

    // SQL query to delete data from the user table where id=$userid
    $query = "DELETE FROM booktable WHERE BookID = {$bookId}";
    $delete_query = mysqli_query($conn, $query);

    if (!$delete_query) {
        die("Query failed: " . mysqli_error($conn));
    }

    header("Location: adminBook.php");
    exit();
}
?>