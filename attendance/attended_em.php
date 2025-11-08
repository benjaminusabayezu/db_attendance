<?php
// Database connection settings
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'db_attendance';

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch data
$sql = "SELECT attendEmpId, emp_code, fname, lname, role, time FROM attended_emp";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Attendance List</title>
     <link rel="icon" type="image/x-icon" href="attendance.png">
    <style>
        body{
            font-family: Aptos;
            color: #200900a6;
        }
        table { 
            border-collapse: collapse;
             width: 80%;
              margin: 20px auto; 
          }
        th, td 
        { 
            border: 1px solid #ccc; 
            padding: 8px; 
            text-align: center; 
        }
        th 
        { 
            background-color: #f2f2f2; 
        }
            button{
        width: 100%; padding: 12px; margin: 10px 0;
        background: #200900a6;
        border: none;
        border-radius: 2px;
        color: #fff;
    }
    a{
        text-decoration: none;
    }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Employee Attendance Records</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Emp Code</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Role</th>
            <th>Time</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                ?>
                <tr>
                        <td><?php echo $row['attendEmpId'];?></td>
                        <td><?= $row['emp_code']?></td>
                        <td><?= $row['fname']?></td>
                        <td><?= $row['lname']?></td>
                        <td><?= $row['role']?></td>
                        <td><?= $row['time']?></td>
                        <td>
    <a href='update_att.php?id=<?php echo $row['attendEmpId']; ?>'>Update</a> |
    <a href='delete_att.php?id=<?php echo $row['attendEmpId']; ?>' onclick="return confirm('This actiion can\'t be undone.')">Clear</a>
</td>


                      </tr>
                      <?php

            }
        } else {
            echo "<tr><td colspan='6'>No one attended!</td></tr>";
        }
        $conn->close();
        ?>
        <tr>
            <td><button onclick="if(confirm('You are about to go back to mark attendance.')) { window.location.href='Attendance.php'; }">Back to Attend</button></td>
        </tr>
    </table>
</body>
</html>