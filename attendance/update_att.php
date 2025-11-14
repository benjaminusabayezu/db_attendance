<?php
include ('header.php');
require_once 'config.php';

 $id=$_GET['id'];
if ($_SERVER['REQUEST_METHOD']=='POST') {
    $code = $_POST['emp_code'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $role = $_POST['role'];
    $time = $_POST['time'];

    $update = "UPDATE attended_emp 
               SET emp_code=?, fname=?, lname=?, role=?, time=? 
               WHERE attendEmpId=?";

    $stmt = $connect->prepare($update);
    if (!$stmt) {
        die("Prepare failed: " . $connect->error);
    }

    $stmt->bind_param("sssssi", $code, $fname, $lname, $role, $time, $id);

    if($stmt->execute()){
        echo "Update successfully done!";
        header("Location: attended_em.php");
    } else {
        echo "Error while updating: " . $stmt->error;
    }
}
 else {
    $sql = "SELECT * FROM attended_emp WHERE attendEmpId=?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>update</title>
	<link rel="icon" type="image/x-icon" href="attendance.png">
<style>
        * {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            background-color: #dadbd9;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        form {
            background-color: #dbd7d5;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
            margin: 5% auto;
        }
        form label {
            display: block;
            margin-bottom: 8px;
            font-size: 16px;
            color: #6c757d;
        }
        form input[type="text"],
        form input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        form input[type="checkbox"] {
            margin-right: 8px;
        }
        form .checkbox-label {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            font-size: 14px;
            color: #333;
        }
        form button {
            width: 48%;
            padding: 12px;
            margin-right: 4%;
            border: none;
            border-radius: 5px;
            background-color: #996d51;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        form button:last-child {
            margin-right: 0;
            background-color: #6c757d;
        }
        form button:hover {
            opacity: 0.9;
        }
        a{
            text-decoration: none;
            font-weight: bold;
            color: #996d51;
        }
        a:hover{
            cursor: pointer;
            text-decoration: underline;
        }
        h3{
            padding: 12px;
            margin: 4px;
            color: #6c757d;
        }
        hr{
            width: 100%;
            border: 1px solid #6c757d;
            margin: 2px;
        }
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: #dbd7d5;
            padding: 30px;
            border-radius: 10px;
            width: 90%;
            max-width: 450px;
            box-shadow: 0 0 15px rgba(0,0,0,0.3);
            position: relative;
        }
        .close {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 24px;
            color: #333;
            cursor: pointer;
        }
</style>
</head>
<body>
	    <form method="post">
        Emp Code: <input type="text" name="emp_code" value="<?= $row['emp_code'] ?>"><br>
        First Name: <input type="text" name="fname" value="<?= $row['fname'] ?>"><br>
        Last Name: <input type="text" name="lname" value="<?= $row['lname'] ?>"><br>
        Role: <input type="text" name="role" value="<?= $row['role'] ?>"><br>
        Time: <input type="text" name="time" value="<?= $row['time'] ?>"><br>
       <button type="submit">update</button>
    </form>

</body>
</html>
<?php
}
$connect->close();
?>




