<?php
include "db.php";
session_start();

define('ADMIN_CONTACT', '0000');
define('ADMIN_PASSWORD', '0000');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $cont = $_POST['contact'];
    $pass = $_POST['password'];

    $query = "SELECT * FROM `employe table` WHERE `contact` = '{$cont}'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $_SESSION['UserID'] = $row['UserID'];
        $empid = $row['empid'];
        $admin = $row['admin'];
        $contd = $row['contact'];
        $passd = $row['password'];

        $query = "SELECT * FROM `tbempinfo` WHERE `empid` = '{$empid}'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['Efirstname'] = $row['firstname'];
            $_SESSION['Elastname'] = $row['lastname'];
            $_SESSION['Edepartment'] = $row['department'];
        }

        if ($admin  == "yes") {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin.php');
    } else {
        $error_message = 'You need to be Admin first!';

    }



    } else {

     
        if ($_POST['contact'] === ADMIN_CONTACT && $_POST['password'] === ADMIN_PASSWORD) {
            // Set the session variable to indicate that the user is logged in
            $_SESSION['admin_logged_in'] = true;
            header('Location: admin.php');
            exit();
        } else {
            // Display an error message if the credentials are incorrect
            $error_message = 'Invalid username or password';
        }

        if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
            header('Location: admin.php');
            exit();
        }



    }

    mysqli_close($conn);
}



// $query = "SELECT * FROM `logintable` WHERE `StudentID` = '{$_SESSION['StudentID']}'";
// $result = $conn->query($query);

// if ($result->num_rows > 0) {
//     $row = $result->fetch_assoc();
//     $passd = $row['Password'];
// } 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="admin_login.css">
    <!-- Add your head content here -->
</head>

<body>

<div class="navigation">
        <h1>Batangas State University</h1>
        <img src="img/Batangas_State_Logo.png" alt="BSU Logo">
        </a>
    </div>
    <img class="background" src="img/bsu_pic">
    <!-- Display the login form if not logged in -->
    <div class="login-form">
        <?php if (isset($error_message)): ?>
            <p class="error">
                <?php echo $error_message; ?>
            </p>
        <?php endif; ?>
        <form method="post" action="">
            <label for="contact">Contact:</label>
            <input type="text" id="contact" name="contact" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>