<?php

include 'db_connect.php';

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$psw = $_POST['psw'];
$user_type = "nuser";

$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    header("Location: ../pages/registration.php?error=email_exists");
    exit();
}

else{
    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password, user_type) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $fname, $lname, $email, $psw, $user_type);

    if ($stmt->execute()){
        header("Location: ../pages/login.php?info=registered");
        exit();
    }
    else{
        header("Location: ../pages/registration.php?error=record didnt added.");
    }
}

$stmt->close();
$conn->close();

?>