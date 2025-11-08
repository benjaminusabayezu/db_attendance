<?php

$server = "localhost";
$username = "root";
$password = "";
$dbname = "classA";

$conn = new mysqli($server, $username, $password, $dbname);

if ($conn->connect_error) {
    echo "Not connected!";
} else {
    
if (isset($_POST['save']))
{
  $phone=$_POST['phone_number'];
  $fname=$_POST['first_name'];
  $lname=$_POST['last_name'];
  $gender=$_POST['gender'];

 $province=$_POST['province'];
 $insert_message='Send data';

$insert= "INSERT INTO information (phone_number,first_name,last_name,gender,province)
VALUES('$phone','$fname','$lname','$gender','$province')";

if ($conn->query($insert)===TRUE) {
 
 $insert_message="Data insertion Successfully!";	

	}
else{
	echo "Data not inserted..".$conn->error;
}

}

}
$conn->close();

?>


<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>DB| Class A</title>
	<style>
		form{
			background-color: #00050;
			width: 500px;
			height: auto;
			padding: 14px;
			margin: 120px auto;
		}
		form label{
			margin: 22px;
			padding: 22px;

		}

	</style>
</head>
<body>
	<form method="POST">
		<h2>Insert Records in This Form</h2>
		<label>Phone number:</label>
		<input type="text" name="phone_number" required>
		<label>First Name:</label>
		<input type="text" name="first_name" required>

		<label>Last Name:</label>
		<input type="text" name="last_name" required>

		<label>Gender:</label>
		<select name="gender" required>
			<option value="F">Female</option>
			<option value="M">Male</option>
		</select>
		<label>Province:</label>
		<select name="province" required>
			<option value="North">North</option>
			<option value="South">South</option>

			<option value="East">East</option>
			<option value="West">West</option>
			<option value="Kigali">Kigali City</option>
		</select>
		<hr>

			<input type="submit" name="save"  value="Save">
		<hr>
		<input type="text" name="" value="<?php echo $insert_message;?>" readonly>
	</form>


</body>
</html>