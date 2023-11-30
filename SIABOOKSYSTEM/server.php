<?php include "db.php";


session_start();


define('ADMIN_CONTACT', 'admin');
define('ADMIN_PASSWORD', '1234');

$_SESSION['admin_logged_in'] = false;

if (isset($_POST['loginCheck'])) {

    $sr = $_POST['srcode'];
    $pass = $_POST['password'];

    $query = "SELECT * FROM `student table` WHERE `SR-Code` = '{$sr}'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $_SESSION['userID'] = $row['userID'];
        $studid = $row['studid'];
        $_SESSION['sr'] = $row['SR-Code'];
        $_SESSION['sec'] = $row['Section'];
        $passd = $row['Password'];
        $srd = $row['SR-Code'];

        $query = "SELECT * FROM `tbstudinfo` WHERE `studid` = '{$studid}'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $_SESSION['firstname'] = $row['firstname'];
            $_SESSION['lastname'] = $row['lastname'];
            $_SESSION['course'] = $row['course'];
        }


    }


    // $query = "SELECT * FROM `logintable` WHERE `StudentID` = '{$_SESSION['StudentID']}'";
    // $result = $conn->query($query);

    // if ($result->num_rows > 0) {
    //     $row = $result->fetch_assoc();
    //     $passd = $row['Password'];
    // } 



    if (empty($pass) || empty($sr)) {
        echo "<script type='text/javascript'>alert('Please enter your sr-code and password.'); window.location.href = 'login.php';</script>";
    } else {
        if ($pass == $passd && $sr == $srd) {
            echo "<script type='text/javascript'>alert('Login successful!'); window.location.href = 'home.php';</script>";
        } else {
            echo "<script type='text/javascript'>alert('Incorrect sr-code or password.'); window.location.href = 'login.php';</script>";
        }
    }

    // Close the database connection
    mysqli_close($conn);
} else if (isset($_POST['loginCheck2'])) {

    $cont = $_POST['contact'];
    $pass = $_POST['password'];

    $query = "SELECT * FROM `employe table` WHERE `contact` = '{$cont}'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $_SESSION['UserID'] = $row['UserID'];
        $empid = $row['empid'];
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


    }


    // $query = "SELECT * FROM `logintable` WHERE `StudentID` = '{$_SESSION['StudentID']}'";
    // $result = $conn->query($query);

    // if ($result->num_rows > 0) {
    //     $row = $result->fetch_assoc();
    //     $passd = $row['Password'];
    // } 


    if (empty($pass) || empty($cont)) {
        echo "<script type='text/javascript'>alert('Please enter your contact and password.'); window.location.href = 'empLogin.php';</script>";
    } else {
        if ($pass == $passd && $cont == $contd) {
            echo "<script type='text/javascript'>alert('Login successful!'); window.location.href = 'librarian.php';</script>";
        } else {
            echo "<script type='text/javascript'>alert('Incorrect contact or password.'); window.location.href = 'empLogin.php';</script>";
        }
    }

    // Close the database connection
    mysqli_close($conn);

} 


?>