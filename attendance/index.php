
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login Form</title>
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

	<!-- Login Form -->
	<form method="POST" action="login.php">
		<h3>Login Here!</h3>
		<hr>
		<label for="email">E-mail</label>
		<input type="text" id="phone" name="email" required>

		<label for="password">Password</label>
		<input type="password" id="password" name="password" required>

		<div class="checkbox-label">
			<input type="checkbox" id="remember" name="remember">
			<label for="remember">Remember Me</label>
		</div>

		<button type="submit" name="login">Sign In</button>
		<a id="openModal">Sign Up</a>
	</form>

	<!-- Sign Up Modal -->
	<div id="signupModal" class="modal">
		<div class="modal-content">
			<span class="close" id="closeModal">&times;</span>
			<h3>Create an Account</h3>
			<hr>
			<form method="POST" action="register.php">
				<label for="name">Full Name</label>
				<input type="text" id="name" name="name" required>

				<label for="email">Email</label>
				<input type="text" id="email" name="email" required>

				<label for="password_signup">Password</label>
				<input type="password" id="password_signup" name="password" required>

				<button type="submit">Register</button>
			</form>
		</div>
	</div>

	<!-- Modal Script -->
	<script>
		const modal = document.getElementById("signupModal");
		const openBtn = document.getElementById("openModal");
		const closeBtn = document.getElementById("closeModal");

		openBtn.onclick = () => modal.style.display = "flex";
		closeBtn.onclick = () => modal.style.display = "none";
		window.onclick = (e) => {
			if (e.target == modal) modal.style.display = "none";
		};
	</script>