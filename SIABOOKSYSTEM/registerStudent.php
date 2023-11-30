<?php

include "db.php"; // Include your database connection

if (isset($_POST['register'])) {

    extract($_POST);

    $registerq = "SELECT * FROM tbstudinfo WHERE firstname = ? AND lastname = ?";
    $stmt = $conn->prepare($registerq);
    $stmt->bind_param("ss", $firstname, $lastname);
    $stmt->execute();
    $registerResult = $stmt->get_result();

    // Check if the query returned any data
    if ($registerResult->num_rows > 0) {
        $row = $registerResult->fetch_assoc();
        $iddb = $row['studid'];

        $checkStudIdQuery = "SELECT * FROM `student table` WHERE `studid` = ?";
        $stmt = $conn->prepare($checkStudIdQuery);
        $stmt->bind_param("s", $iddb);
        $stmt->execute();
        $checkStudIdResult = $stmt->get_result();

        if ($checkStudIdResult->num_rows > 0) {
            $error_message = 'This student already exists in the employe table.';
        } else {
            // Insert the new user into the employe table
            $insertStudQuery = "INSERT INTO `student table` (`userID`, `studid`, `SR-Code`, `Section`, `Password`) VALUES (NULL, ?, ?, ?, ?) ";
            $stmt = $conn->prepare($insertStudQuery);
            $stmt->bind_param("ssss", $iddb, $sr, $sec, $pass);
            $stmt->execute();
            echo "<script type='text/javascript'>alert(' New User Added.'); window.location.href = 'admin.php';</script>";
        }

    } else {
        $error_message = 'First Name or Last Name doesnt match the Data.';
    }

}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ADD USER</title>
    <link href="design/login_style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

</head>

<body>
    <header>
        <img src="img/Batangas_State_Logo.png">
        <h1>Add Student User</h1>
    </header>

    </div>
    <img class="background" src="img/bsu_pic">

    <div class="login-container">
    <?php if (isset($error_message)): ?>
            <p style="color: #ff0000;
margin-bottom: 10px;">
                <?php echo $error_message; ?>
            </p>
        <?php endif; ?>
        
        <form id="register-form" action="" method="post">
            <div class="login-form">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" class="form-control" name="firstname">
            </div>

            <div class="login-form">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" class="form-control" name="lastname">
            </div>

            <div class="form-group">
                <label for="SR-Code" class="form-label">SR-Code</label>
                <input type="text" class="form-control" name="sr">
            </div>

            <div class="form-group">
                <label for="Year & Section" class="form-label">Section</label>
                <input type="text" class="form-control" name="sec">
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="pass">
            </div>

            <div class="container text-center mt-5">
                <input type="submit" name="register" class="btn btn-primary mt-2" value="SUBMIT">
            </div>
        </form>
        <form class="mt-4" style="" method='post' action='admin.php'>
            <button type='submit' class='btn btn-warning' name='warning'>Go back</button>
        </form>
    </div>
</body>

</html>