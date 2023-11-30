
<?php include "db.php" ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<?php
   // checking if the variable is set or not and if set adding the set data value to variable userid
   if(isset($_GET['book_edit']))
    {
      $bookid = $_GET['book_edit']; 
    }
      // SQL query to select all the data from the table where id = $userid
      $query="SELECT * FROM booktable WHERE BookID = $bookid ";
      $view_book= mysqli_query($conn,$query);

      while ($row = mysqli_fetch_assoc($view_book)) {
        $bookId = $row['BookID'];
        $bookName = $row['BookNames'];
        $bookDes = $row['Description'];
        $bookAut = $row['Author'];
        $bookCat = $row['Category'];
        $bookISBN = $row['ISBN'];
        }
 
    //Processing form data when form is submitted
    if(isset($_POST['update'])) 
    {

        $bookName = $_POST['bookName'];
        $bookDes = $_POST['bookDes'];
        $bookAut = $_POST['bookAut'];
        $bookCat = $_POST['bookCat'];
        $bookISBN = $_POST['bookISBN'];
      
      // SQL query to update the data in user table where the id = $userid 
      $query = "UPDATE booktable SET  BookNames = '{$bookName}' , Description = '{$bookDes}' , Author = '{$bookAut}', Category = '{$bookCat}',  ISBN = '{$bookISBN}' WHERE BookID = $bookid";
      $update_user = mysqli_query($conn, $query);
      echo "<script type='text/javascript'>alert('Book data updated successfully!')</script>";
    }             
?>

<h1 class="text-center">Update Book Details</h1>
  <div class="container ">
    <form action="" method="post">
      <div class="form-group">
        <label for="user" >Book Name</label>
        <input type="text" name="bookName" class="form-control" value="<?php echo $bookName  ?>">
      </div>

      <div class="form-group">
        <label for="email" >Book Description</label>
        <input type="text" name="bookDes"  class="form-control" value="<?php echo $bookDes  ?>">
      </div>
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    
      <div class="form-group">
        <label for="pass" >Book Author</label>
        <input type="password" name="bookAut"  class="form-control" value="<?php echo $bookAut  ?>">
      </div>
      
      <div class="form-group">
        <label for="pass" >Book Category</label>
        <input type="password" name="bookCat"  class="form-control" value="<?php echo $bookCat  ?>">
      </div>

      <div class="form-group">
        <label for="pass" >Book ISBN</label>
        <input type="password" name="bookISBN"  class="form-control" value="<?php echo $bookISBN  ?>">
      </div>

      <div class="form-group">
         <input type="submit"  name="update" class="btn btn-primary mt-2" value="update">
      </div>
    </form>    
  </div>

    <!-- a BACK button to go to the home page -->
    <div class="container text-center mt-5">
      <a href="adminBook.php" class="btn btn-warning mt-5"> Back </a>
    <div>

<!-- Footer -->
