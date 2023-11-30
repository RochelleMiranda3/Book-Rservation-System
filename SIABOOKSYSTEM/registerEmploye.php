<?php include "db.php"; // Include your database connection

if (isset($_POST['register'])) {

    // Extract the input values
    extract($_POST);

    // Use prepared statements to prevent SQL injection
    $registerq = "SELECT empid, firstname, lastname FROM tbempinfo WHERE firstname = ? AND lastname = ?";
    $stmt = $conn->prepare($registerq);
    $stmt->bind_param("ss", $firstname, $lastname);
    $stmt->execute();
    $registerResult = $stmt->get_result();

    // Check if the query returned any data
    if ($registerResult->num_rows > 0) {
        $row = $registerResult->fetch_assoc();
        $iddb = $row['empid'];

        // Check if empid already exists in the employe table
        $checkEmpIdQuery = "SELECT * FROM `employe table` WHERE `empid` = ?";
        $stmt = $conn->prepare($checkEmpIdQuery);
        $stmt->bind_param("s", $iddb);
        $stmt->execute();
        $checkEmpIdResult = $stmt->get_result();

        if ($checkEmpIdResult->num_rows > 0) {
            $error_message = 'This employee already exists in the employe table.';
        } else {
            // Insert the new user into the employe table
            $insertEmpQuery = "INSERT INTO `employe table` (`UserID`, `empid`, `admin`, `contact`, `password`) VALUES (NULL, ?, ?, ?, ?) ";
            $stmt = $conn->prepare($insertEmpQuery);
            $stmt->bind_param("ssss", $iddb, $admin, $cont, $pass);
            $stmt->execute();
            echo "<script type='text/javascript'>alert(' New User Added.'); window.location.href = 'admin.php';</script>";
        }

    } else {
        $error_message = 'First Name or Last Name doesnt match the Data.';
    }

} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ADD USER</title>
    <link href="design/login_style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel=" stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

</head>

<body>
    <header> <img src="img/Batangas_State_Logo.png">
        <h1>Add employe User</h1>
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
                <label for="SR-Code" class="form-label">Contact</label>
                <input type="text" class="form-control" name="cont">
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="pass">
            </div>

            <label for="admin" class="form-label">Admin</label>
            <select class="form-control" name="admin">
                <option value="no">No</option>
                <option value="yes">Yes</option>
            </select>

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