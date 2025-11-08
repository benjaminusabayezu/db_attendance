<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'db_attendance';

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

$sql = "DELETE FROM attended_emp WHERE attendEmpId=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("location: attended_em.php");
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>