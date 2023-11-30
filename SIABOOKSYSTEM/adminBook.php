<?php
include "db.php";
include "server.php";
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
</head>


<body>
  <div class="navigation" style="">

    <img src="img/Batangas_State_Logo.png">

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

      <table class="table  h6 table-bordered table-striped table-bordered table-hover mx-auto" style="width: 710px; ">
        <thead class="table-dark text-white">
          <tr>
            <th scope="col"> </th>
            <th scope="col">Book Names</th>
          
            <th scope="col">Author</th>
            <th scope="col">Category</th>
            <th scope="col" colspan="3" class="text-center"></th>
          </tr>
        </thead>
        <tbody>
          <tr>

            <?php
            $bookSearch = "";
            
            $QUERY = "SELECT * FROM booktable WHERE (NOT EXISTS (SELECT * FROM reservetable WHERE booktable.BookID = reservetable.BookID AND reservetable.Status IN ('Pending', 'Approved')) OR (EXISTS (SELECT * FROM reservetable WHERE booktable.BookID = reservetable.BookID AND reservetable.Status IN ('Cancelled', 'Returned')) AND NOT EXISTS (SELECT * FROM reservetable WHERE booktable.BookID = reservetable.BookID AND reservetable.Status IN ('Pending', 'Approved'))))";


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
              echo "<th scope='row'>$count</th>";
              echo "<td> {$bookName} </td>";
              echo "<td> {$bookAut} </td>";
              echo "<td> {$bookCat} </td>";
              echo "<td class = 'text-center'> <a href='edit.php?book_edit={$bookId}' class='btn btn-info'> EDIT </a></td>";
              echo "<td class = 'text-center'> <a href='delete.php?delete_book={$bookId}' class='btn btn-danger'> DELETE </a></td>";
              echo "</tr>";
            }



            ?>
          </tr>
        </tbody>
      </table>
      
      <form method='post' action='addBook.php'>
            <button type='submit' class='btn btn-warning' name='warning'>Add Books</button>
        </form>
        <form class = mt-4 style = "" method='post' action='admin.php'>
                <button type='submit' class='btn btn-warning' name='warning'>Go back</button>
            </form>

    </div>
    



  
  </div>
</body>

</html>