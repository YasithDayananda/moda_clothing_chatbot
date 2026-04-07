
<?php include 'footer.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Moda Create Account</title>
    <link rel="stylesheet" href="../CSS/registration.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/registration_validation_script.js"></script>
    <script src="../js/error_alert.js"></script>
</head>
<body>
<?php include 'header.php';?>
    <h1>CREATE ACCOUNT</h1>
    <div class="container">
        <form name="registrationForm" action="../php/registration_process.php" onsubmit="return validateForm()" method="post">
            <label for="fname"></label>
            <input type="text" placeholder="First Name" name="fname" required>
            <label for="lname"></label>
            <input type="text" placeholder="Last Name" name="lname" required>
            <label for="email"></label>
            <input type="text" placeholder="Email" name="email" required>
            <label for="psw"></label>
            <input type="password" placeholder="Password" name="psw" required>
            <label for="psw-confirm"></label>
            <input type="password" placeholder="Confirm Password" name="psw-confirm" required>
            <button type="submit">Create</button>
        </form>
        <div id="notification"></div>
    </div>
</body>
</html>
