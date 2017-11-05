<!DOCTYPE html>
<?php

	if($_SERVER['REQUEST_METHOD'] = 'POST')
	{
		
		$server = "localhost";
		$user = "root";
		$password = "";
		$db = "garage";

		$c = mysqli_connect($server, $user, $password, $db);

		if(mysqli_connect_errno())
		{
			die("Connection error:" . mysqli_connect_error());
			header("location: registration.php");
			exit();
		}

		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
		
			if(isset($_POST['submit']))
			{

				if(empty($first) && empty($last) && empty($email) && empty($prefix) && empty($phone) && empty($p1) && empty($p2) && $p1 != $p2)
				{
					header("location: registration.php");
					exit();
				}
				else
				{
					
					$first = mysqli_real_escape_string($c, $_POST['first']);
					$last = mysqli_real_escape_string($c, $_POST['last']);
					$email = mysqli_real_escape_string($c, $_POST['email']);
					$prefix = mysqli_real_escape_string($c, $_POST['prefix']);
					$phone = mysqli_real_escape_string($c, $_POST['phone']);
					$p1 = mysqli_real_escape_string($c, $_POST['password1']);
					$p2 = mysqli_real_escape_string($c, $_POST['password2']);
					$usertype = "regular";

					$line = $prefix . " " . $phone;

					$query = "INSERT INTO `accounts` (`first`, `last`, `email`, `password1`, `password2`, `phone`, `usertype`) VALUES ('$first', '$last', '$email', '$p1', '$p2', '$phone', '$usertype')";
					
					$ps = mysqli_query($c, $query);

					if(!$ps)
					{
						die("Failed to insert data:" . mysqli_error($c));
						header("location: registration.php");
						exit();
					}
					else
					{
						echo "Transaction Successful";
						header("location: login.php");
						exit();
					}
				}
			}
		}

		mysqli_close($c);
	}
?>
<html>
<head>
	<title>Registration</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="gms.css">
	<script src="gms.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
</head>
	<body>
		<div>
		<center>
			<a href = "home.php"><h1><strong>GARAGE MANAGEMENT SYSTEM</strong></h1></a>
		</center>
		</div>
		<div id = "sector">
				<center>
					<img src = "registration.jpg" alt = "Registration">
					<h1><strong>Registration</strong></h1>
				</center>
		</div>
		<div id = "stationary">
			<center>
				<fieldset id = "drape">
					<div class = "form-group">
						<h4><center>Registration Details</center></h4>
					</div>
					<form method = "post" action = "registration.php" onsubmit = "return register()">
						<div class="form-group">
					    <label>First Name:</label>
					    <input type="text" class="form-control" name="first" id = "dimensions">
					  </div>
						<div class="form-group">
					    <label>Last Name:</label>
					    <input type="text" class="form-control" name="last" id = "dimensions">
					  </div>
						<div class="form-group">
					    <label>Email Address:</label>
					    <input type="text" class="form-control" name="email" id = "dimensions">
					  </div>
					  <div class="form-group">
					    <label>Password:</label>
					    <input type="password" class="form-control" name="password1" id = "dimensions">
					  </div>
						<div class="form-group">
					    <label>Verify Password:</label>
					    <input type="password" class="form-control" name="password2" id = "dimensions">
					  </div>
						<div class="form-group">
						<label>Prefix:</label>
						  <select name = "prefix" id = "dimensions" class = "form-control">
							<option value = "+254">+254</option>
							<option value = "+255">+255</option>
							<option value = "+254">+256</option>
							<option value = "+254">+1</option>
							<option value = "+254">+44</option>
						</select>
						</div>
						<div class="form-group">
					    <label>Phone Number:</label>
					    <input type="text" class="form-control" name="phone" id = "dimensions">
					  </div>
					  <button type="submit" class="btn btn-dark" name = "submit">Submit</button>
					</form>
				</fieldset>
			</center>
		</div>
		<div id = "adapt">
			<center>
				<footer id = "footnote">
					<h1>(C). 2017 All Rights Reserved</h1>
				</footer>
			</center>
		</div>
	</body>
</html>