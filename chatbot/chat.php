<?php
if (!isset($_POST["msg"])) {
    echo "Chatbot is running!";
    exit();
}

$msg = $_POST["msg"];

$command = "cd C:\\xampp\\htdocs\\sliit_first_year_web_development_project\\chatbot && C:\\Python312\\python.exe bot.py \"" . escapeshellcmd($msg) . "\" 2>&1";

$output = shell_exec($command);

echo $output;
?>