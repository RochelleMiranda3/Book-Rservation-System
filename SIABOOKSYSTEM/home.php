<?php
include "db.php";
include "server.php";

$userID = $_SESSION['userID'];
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Book Reservation</title>
  <link href="design/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <script>
  function toggleDropdown() {
    var dropdown = document.querySelector('.extra-buttons');
    dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
  }
</script>

</head>


<body>
  <div class="navigation" style="">
  <h1>Batangas State University</h1>
    <img src="img/Batangas_State_Logo.png">

    <p><strong>Welcome:</strong>
      <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname'] . "<br>" ?>
      <strong>Sr-Code: </strong>
      <?php echo $_SESSION['sr']; ?>
    </p>

    <a class="logoutBtn" href="login.php">
      <img src="img/cics_logo.jpg">
      <div class="logoutC">LOGOUT</div>
    </a>

  </div>

  <img class="background" src="img/bsu_pic">


  <div class="midContainer">
    <div class="bookContainer">
      <div class="bookNav">
        <form method="post">
          <input type="text" placeholder="Search books..." name="searchThis" class="search-input">
          <button type="button" class="search-button" onclick="toggleDropdown()">Search</button>
          <div class="extra-buttons">
            <input name="bookSearch" type="submit" class="btn btn-sm book-button"
              style="background-color: #2196f3; margin-top: 7px" value="Book">
            <input name="desSearch" type="submit" class="btn btn-sm description-button"
              style="background-color: #4caf50; margin-top: 7px" value="Description">
            <input name="autSearch" type="submit" class="btn btn-sm author-button"
              style="background-color: #ff9800; margin-top: 7px" value="Author">
            <input name="catSearch" type="submit" class="btn btn-sm category-button"
              style="background-color: #f44336; margin-top: 7px" value="Category">
          </div>
        </form>

        <script>
          function toggleDropdown() {
            var dropdown = document.querySelector('.extra-buttons');
            dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
          }
        </script>
      </div>

      <table class="table  h6 table-bordered table-striped table-bordered table-hover mx-auto" style="width: 750px; ">
        <thead class="table-dark text-white">
          <tr>
          <th scope="col"></th>
          <th scope="col">Book Names</th>

            <th scope="col">Description</th>
            <th scope="col">Author</th>
            <th scope="col">Category</th>
            <th scope="col" colspan="3" class="text-center"></th>
          </tr>
        </thead>
        <tbody>
          <tr>

            <?php
            $bookSearch = "";

            $QUERY = "SELECT * FROM booktable WHERE (NOT EXISTS (SELECT * FROM reservetable WHERE booktable.BookID = reservetable.BookID AND reservetable.Status IN ('Pending', 'Approved')) OR (EXISTS (SELECT * FROM reservetable WHERE booktable.BookID = reservetable.BookID AND reservetable.Status IN ('Cancelled', 'Returned')) AND NOT EXISTS (SELECT * FROM reservetable WHERE booktable.BookID = reservetable.BookID AND reservetable.Status IN ('Pending', 'Approved')))) ";


            if (isset($_POST['bookSearch'])) {

              $Search = $_POST['searchThis'];
              $query = $QUERY . "AND BookNames LIKE '%" . $Search . "%'";
            } else if (isset($_POST["desSearch"])) {
              $Search = $_POST['searchThis'];
              $query = $QUERY . "AND `Description` LIKE '%" . $Search . "%'";
            } else if (isset($_POST["autSearch"])) {
              $Search = $_POST['searchThis'];
              $query = $QUERY . "AND `Author` LIKE '%" . $Search . "%'";
            } else if (isset($_POST["catSearch"])) {
              $Search = $_POST['searchThis'];
              $query = $QUERY . "AND `Category` LIKE '%" . $Search . "%'";
            } else {

              $query = $QUERY;
              echo "<script type = 'text/javascript'>alert('{$query}')</script>";

            }


            $view_book = mysqli_query($conn, $query); //sending the query to the database
            $count = 0;
            //displaying all the data retrieved from database using while loop
            while ($row = mysqli_fetch_assoc($view_book)) {
              $bookId = $row['BookID'];
              $bookName = $row['BookNames'];
              $bookDes = $row['Description'];
              $bookAut = $row['Author'];
              $bookCat = $row['Category'];
              $bookISBN = $row['ISBN'];

              $count = $count + 1;

              echo "<tr>";
              echo "<th scope='row'>{$count}</th>";
              echo "<td class='book-name-cell' data-isbn='{$bookISBN}'>{$bookName}<span class='isbn'>ISBN: {$bookISBN}</span></td>";

              echo "<td> {$bookDes} </td>";
              echo "<td> {$bookAut} </td>";
              echo "<td> {$bookCat} </td>";
              echo "<td class = 'text-center'> <a href='reserve.php?book_id={$bookId}&user_id={$userID}' class='btn btn-success'> RESERVE </a></td>";
              echo "</tr>";
            }

            ?>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="reserveContainer">
      <div class="reserveNAV">
        <form method="post">
          <input name="View_All" type="submit" class="book-button" style="background-color: #2196f3" 
            value="View All">
          <input name="View_Pendings" type="submit" class="description-button" style="background-color: #4caf50"
            value="View Pendings">
          <input name="View_Cancelled" type="submit" class="author-button" style="background-color: #ff9800"
            value="View Cancelled">
          <input name="View_Approved" type="submit" class="category-button" style="background-color: #f44336"
            value="View Approved">      
            <input name="View_Returned" type="submit" class="category-button" style="background-color: black"
            value="Returned">
        </form>
      </div>

      <table class="table h6 table-bordered table-striped table-bordered table-hover mx-auto" style="width: 440px; ">
        <thead class="table-dark text-white">
          <tr>
            <th scope="col">Book Name</th>
            <th scope="col">Date Reserve</th>
            <th scope="col">Status</th>
            <th scope="col" colspan="0" class="text-center"></th>
          </tr>
        </thead>
        <tbody>

          <tr>

            <?php
            // if (isset($_GET['reserve']) && $_GET['reserve'] == 'history') {

              $QUERY = "SELECT * FROM reservetable ";

              if (isset($_POST['View_All'])) {
                $query = $QUERY;
              } else if (isset($_POST["View_Pendings"])) {
               
                $query = $QUERY . "WHERE `Status` = 'Pending'";
              } else if (isset($_POST["View_Cancelled"])) {
               
                $query = $QUERY . "WHERE `Status` = 'Cancelled'";
              } else if (isset($_POST["View_Approved"])) {
               
                $query = $QUERY . "WHERE `Status` = 'Approved'";
              } else if (isset($_POST["View_Returned"])) {
                
                $query = $QUERY . "WHERE `Status` = 'Returned'";
              } else {
                $query = $QUERY;
              }

              $view_book = mysqli_query($conn, $query);

              while ($row = mysqli_fetch_assoc($view_book)) {
                $reserveId = $row['ReserveID'];
                $reserveStuId = $row['userID'];
                $reserveBookId = $row['BookID'];
                $reserveDate = $row['DateReserve'];
                $reserveStat = $row['Status'];

                $query = "SELECT * FROM booktable WHERE BookId = $reserveBookId";
                $search_book = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($search_book)) {
                  $bookName = $row['BookNames'];
                }

                $query = "SELECT * FROM returntable WHERE ReserveID = $reserveId";
                $select_date = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($select_date)) {
                  $dateReturn = $row['DateReturn'];
                }

                if ($reserveStuId == $_SESSION['userID']) {
                  echo "<tr>";
                  echo "<th scope='row'>{$bookName}</th>";
                  echo "<td> {$reserveDate} </td>";
                 

                  if ($reserveStat == "Approved") {
                    echo "<td style='background-color: #f44336;'> {$reserveStat} </td>";
                    echo "<td > Return: {$dateReturn} </td>";
                  } else if ($reserveStat == "Pending") {
                    echo "<td style='background-color: #4caf50;'> {$reserveStat} </td>";
                    echo "<td class = 'text-center'> <a href='reserve.php?reserve_id={$reserveId}&reserve_stat={$reserveStat}' class='btn btn-danger'> Cancel </a></td>";

                  } else if ($reserveStat == "Cancelled") {
                    echo "<td style='background-color: #ff9800;'> {$reserveStat} </td>";
                    echo "<td> </td>";

                  }else {
                    echo "<td style='background-color: black; color: white;'> {$reserveStat} </td>";
                    echo "<td> </td>";
                  }


                  echo "</tr>";
                }

              }
            

            ?>

          </tr>
        </tbody>
      </table>

    </div>
  </div>
</body>

</html>