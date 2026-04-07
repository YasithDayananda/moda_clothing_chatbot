<?php
session_start();

include 'db_connect.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_email = $_POST['uname'];
    $input_password = $_POST['psw'];

    if (!empty($input_email) && !empty($input_password)) {
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("SELECT email, password, user_type FROM users WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $input_email, $input_password);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($email, $password, $user_type);
            $stmt->fetch();

            // Set session variable
            $_SESSION['email'] = $email;

            // Redirect based on user type
            if ($user_type === 'admin') {
                header("Location: ../pages/admin.php");
            } else {
                header("Location: ../pages/home.php");
            }
            exit();
        } else {
            // Credentials are incorrect
            header("Location: ../pages/login.php?error=Login Failed.");
            exit();
        }
        $stmt->close();
    } else {
        $error = "Please fill in both fields.";
        header("Location: ../pages/login.php?error=$error");
        exit();
    }
}

$conn->close();
?>
