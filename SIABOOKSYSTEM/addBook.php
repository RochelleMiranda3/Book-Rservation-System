
<?php include "db.php" ;
?>

<head>
  <meta charset="UTF-8">
  <title>Book Add</title>
  <link href="style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>


<h1 class="text-center">Add New Book</h1>
  <div class="container ">
    <form action="insertBook.php" method="post">
      <div class="form-group">
        <label for="user" >Book Name</label>
        <input type="text" name="bookName" class="form-control" >
      </div>

      <div class="form-group">
        <label for="email" >Book Description</label>
        <input type="text" name="bookDes"  class="form-control" >
      </div>
    
      <div class="form-group">
        <label for="pass" >Book Author</label>
        <input type="text" name="bookAut"  class="form-control" >
      </div>
      
      <div class="form-group">
        <label for="pass" >Book Category</label>
        <input type="text" name="bookCat"  class="form-control" >
      </div>

      <div class="form-group">
        <label for="pass" >Book ISBN</label>
        <input type="text" name="bookISBN"  class="form-control">
      </div>

      <small id="emailHelp" class="form-text text-muted"></small>
      <div class="form-group">
         <input type="submit"  name="add_Book" class="btn btn-primary mt-2" value="Add">
      </div>
    </form>    
  </div>

    <div class="container text-center mt-3">
      <a href="adminBook.php" class="btn btn-warning mt-5"> Back </a>
    <div>

<!-- Footer -->
