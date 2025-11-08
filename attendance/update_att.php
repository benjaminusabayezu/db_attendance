<?php
$servername="localhost";
$user="root";
$password="";
$database="db_attendance";

//creating connection.
$dbcon= new mysqli($servername,$user,$password,$database);
 if ($dbcon->connect_error) {
 	die("Connection failed".dbcon->connect_error);
 } 

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

    $stmt = $dbcon->prepare($update);
    if (!$stmt) {
        die("Prepare failed: " . $dbcon->error);
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
    $stmt = $dbcon->prepare($sql);
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
	    body { 
    	font-family: Aptos; 
    	margin: 140px 420px; 
    	background: #200900a6; 
    	color: #fff;
    }
    form { 
    	background: #fff; 
    	padding: 20px; 
    	border-radius: 8px; 
    	width: 370px; 
    	color:#200900a6 ;
    }
    select{ width: 100%; padding: 10px; margin: 10px 0;
     }
    input{
    	width: 94%; padding: 12px; margin: 10px 0;
    	background: #200900a6;
    	border: none;
    	border-radius: 2px;
    	color: #fff;
    }
    input[type=submit]{
    	width: 100%;
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
        <input type="submit" value="Update">
    </form>

</body>
</html>
<?php
}
$dbcon->close();
?>




