<?php

require_once 'config.php';

$employees = $connect->query("SELECT emp_id, emp_code, fname, lname FROM employee");


if (isset($_POST['submit'])) {
    $emp_id = $_POST['emp_id'];

    // Get full employee info
    $emp = $connect->query("SELECT emp_code, fname, lname, role FROM employee WHERE emp_id = '$emp_id'")->fetch_assoc();

    if ($emp) {
        $emp_code = $emp['emp_code'];
        $fname = $emp['fname'];
        $lname = $emp['lname'];
        $role = $emp['role'];

        // Insert into attended_emp table
        $insert = $connect->prepare("INSERT INTO attended_emp (emp_code, fname, lname, role) VALUES (?, ?, ?, ?)");
        $insert->bind_param("ssss", $emp_code, $fname, $lname, $role);

        if ($insert->execute()) {
            echo "<p style='color:#001848;'>Attendance recorded for $fname $lname</p>";
        } else {
            echo "<p style='color:red;'>Error: " . $insert->error . "</p>";
        }
    } else {
        echo "<p style='color:red;'>Employee not found!</p>";
    }
}
?>
<!** html form to send employee credential*>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Attendance Form</title>
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
    	width: 350px; 
    	color:#200900a6 ;
    }
    select{ width: 100%; padding: 10px; margin: 10px 0;
     }
    button{
    	width: 100%; padding: 10px; margin: 10px 0;
    	background: #200900a6;
    	border: none;
    	border-radius: 2px;
    	color: #fff;
    }
    img{
    	width: 100px;
    	height: 70px;
    }
    a{
    	text-decoration: none;
    }
  </style>
</head>
<body>

<h2><img src="attendance.png"></h2>


<form method="POST" action="">
  <label>Select Employee:</label>
  <select name="emp_id" required>
    <option value="">-- Choose Employee --</option>
    <?php while($row = $employees->fetch_assoc()): ?>
      <option value="<?= $row['emp_id']; ?>">
        <?= $row['fname'] . " " . $row['lname'] . " (" . $row['emp_code'] . ")"; ?>
      </option>
    <?php endwhile; ?>
  </select>
  <button type="submit" name="submit">Mark Attendance</button>
  <a href="attended_em.php">Veiw Attended</a>
</form>

</body>
</html>
