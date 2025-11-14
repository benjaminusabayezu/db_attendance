<?php
require_once 'config.php';

$id = $_GET['id'];

$sql = "DELETE FROM attended_emp WHERE attendEmpId=?";
$stmt = $connect->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("location: attended_em.php");
} else {
    echo "Error deleting record: " . $connect->error;
}

$conn->close();
?>