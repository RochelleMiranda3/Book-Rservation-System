<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book Reservation Login</title>
    <link href="design/login_style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">


</head>

<body>
    <header>
        <img src="img/Batangas_State_Logo.png">
        <h1>BOOK RESERVATION SYSTEM</h1>
    </header>


    <div class="login-container">
        <h2>LOGIN</h2>
        <form id="login-form" action="server.php" method="post">
            <label for="srcode">SR-Code:</label>
            <input type="text" id="srcode" name="srcode" ><br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" ><br><br>

            <input name="loginCheck" type="submit" value="Login">
        </form>
    </div>
    <img class="background" src ="img/bsu_pic">


</body>

</html>