<?php
include "db.php";
if(isset($_POST['add_Book'])) 
    {

        $bookName = $_POST['bookName'];
        $bookDes = $_POST['bookDes'];
        $bookAut = $_POST['bookAut'];
        $bookCat = $_POST['bookCat'];
        $bookISBN = $_POST['bookISBN'];
      
      // SQL query to update the data in user table where the id = $userid 
      $query = "INSERT INTO booktable (`BookID`, `Author`, `BookNames`, `Description`, `Category`, `ISBN`) VALUES (NULL, '$bookAut', '$bookName', '$bookDes', '$bookCat', '$bookISBN')";
      $update_user = mysqli_query($conn, $query);
      echo $query;
      echo "<script type='text/javascript'>alert('Book data added successfully!'); window.location.href = 'addBook.php';</script>";
      
    }             
   
    ?>