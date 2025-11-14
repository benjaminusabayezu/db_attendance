
<?php
session_start();
require_once 'config.php';

// Optional: check if user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}
?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CRUD Operation</title>
	<style>
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
			font-family: Arial, sans-serif;
		}
nav {
	width: 100%;
	background-color: #dbd7d5;
	display: flex;
	justify-content: space-between;
	align-items: center;
	padding: 15px 30px;
	box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}
		nav .logo h2 {
			color: #6c757d;
			font-size: 24px;
		}
		nav ul {
			display: flex;
			gap: 40px;
		}
		nav ul li {
			list-style: none;
		}
		nav ul li a {
			text-decoration: none;
			color: #6c757d;
			font-weight: bold;
			padding: 8px 12px;
			border-radius: 4px;
			transition: background-color 0.3s ease;
		}
		nav ul li a:hover,
	    {
			background-color: #7a543e;
		}
	</style>
</head>
<body>
	<nav>
		<div class="logo"><h2>CRUD OPERATION</h2></div>
		<ul>
			<li><a href="attended_em.php">Home</a></li>
			<li>Welcome, <?php echo htmlspecialchars($_SESSION["user_name"]); ?>.</li>
			<li><a href="Logout.php">Logout</a></li>
			
		</ul>
	</nav>
</body>
</html>