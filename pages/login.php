<?php include 'header.php'; ?>
<?php include 'footer.php'; ?>
<!DOCTYPE html>
<html>
<head>
     <meta charset="UTF-8">
     <title>Moda Login</title>
     <link rel="stylesheet" href="../CSS/login.css">
</head>
<body>
    <h1>LOGIN</h1>
    <div class="container">
        <form action="../php/login_process.php" method="post">
        <label for="uname"></label>
        <input type="text" placeholder="Email" name="uname" required>
        <label for="psw"></label>
        <input type="password" placeholder="Password" name="psw" required>
        <button type="submit">LOGIN</button>
        <div class="links">
            <a href="#">Forgot Password</a>
            <span class="separator">|</span>
            <a href="../pages/registration.php">Create Account</..>
        </div>
        </form>
    </div>
</body>
</html>