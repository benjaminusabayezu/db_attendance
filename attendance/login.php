<?php
session_start();
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $password = $_POST["password"];

    // Prepare the statement using MySQLi
    $stmt = $connect->prepare("SELECT id, name, password FROM users_table WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    // Get the result and fetch associative array
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user["password"])) {

        session_regenerate_id(true);

        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_name"] = $user["name"];

        header("Location:attended_em.php");
        exit;
    } else {
        $error = "Invalid email or password!";
    }

    $stmt->close();
}
?>