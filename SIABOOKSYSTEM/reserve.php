<?php
include "db.php";

include "db.php";

if (isset($_GET['book_id']) && isset($_GET['user_id'])) {
  $userID = $_GET['user_id'];
  $bookID = $_GET['book_id'];
  $statID = 'Pending';

  $query = "INSERT INTO reservetable (ReserveID, userID, BookID, DateReserve, Status) VALUES (NULL, '{$userID}', '{$bookID}', NOW(), '{$statID}')";

  $insert_reserve = mysqli_query($conn, $query);

  if (!$insert_reserve) {
    echo "Something went wrong" . mysqli_error($conn);
  } else {
    echo "<script type='text/javascript'>window.location.href = 'home.php';</script>";
  }
}

if (isset($_GET['reserve_id']) && isset($_GET['reserve_stat'])) {
  $reserveId = $_GET['reserve_id'];
  $reserveStat = $_GET['reserve_stat'];

  if ($reserveStat == "Pending") {

    $insertQuery = "INSERT INTO `returntable` (ReserveID,UserID, DateApproved, DateReturn, Status) 
    VALUES ($reserveId,NULL, NULL, NULL, 'Cancelled')";

$conn->query($insertQuery);

    $sql = "UPDATE `reservetable` SET Status = 'Cancelled' WHERE ReserveID ='{$reserveId}'";


    // execute the query
    if (mysqli_query($conn, $sql)) {
      echo "<script type = 'text/javascript'> window.location.href = 'home.php';</script>";
    } else {
      echo "Error deleting record: " . mysqli_error($conn);
    }
  }
}
?>