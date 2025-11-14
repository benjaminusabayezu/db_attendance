<?php
include('header.php');

// Database connection settings
require_once 'config.php';

// Query to fetch data
$sql = "SELECT attendEmpId, emp_code, fname, lname, role, time FROM attended_emp";
$result = $connect->query($sql);
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
              padding: 20px;
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
    hr{
        width: 40%;
        
        border: 1px solid #f2f2f2;
    }
    </style>
</head>
<body>
    <h2 style="text-align:center;padding: 20px;">Employee Attendance Records</h2>
    <hr>

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
    <a href='delete_att.php?id=<?php echo $row['attendEmpId']; ?>' onclick="getElementById('deleteModal').style.display='block'">Clear</a>
</td>


                      </tr>
                      <?php

            }
        } else {
            echo "<tr><td colspan='6'>No one attended!</td></tr>";
        }
        $connect->close();
        ?>
        <tr>
            <td><button onclick="if(confirm('Back to attendance.')) { window.location.href='Attendance.php'; }">Back to Attend</button></td>
        </tr>
    </table>
  

</body>
</html>