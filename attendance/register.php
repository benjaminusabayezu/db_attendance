<?php
session_start();
require "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize inputs
    $name = trim($_POST["name"]);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $password = $_POST["password"];

    // Validate inputs
    if (empty($name) || empty($email) || empty($password)) {
        $error = "All fields are required.";
    } else {
        // Check if email already exists
        $check = mysqli_prepare($connect, "SELECT id FROM users_table WHERE email = ?");
        mysqli_stmt_bind_param($check, "s", $email);
        mysqli_stmt_execute($check);
        mysqli_stmt_store_result($check);

        if (mysqli_stmt_num_rows($check) > 0) {
            $error = "Email is already registered.";
        } else {
            // Hash password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user
            $stmt = mysqli_prepare($connect, "INSERT INTO users_table (name, email, password) VALUES (?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashedPassword);

            if (mysqli_stmt_execute($stmt)) {
                $_SESSION["user_id"] = mysqli_insert_id($connect);
                $_SESSION["user_name"] = $name;
                header("Location:index.php");
                exit;
            } else {
                $error = "Registration failed. Please try again.";
            }
        }

        mysqli_stmt_close($check);
        mysqli_stmt_close($stmt);
    }
}
?>