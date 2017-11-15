<!DOCTYPE html>
<?php

	$server = "localhost";
	$user = "root";
	$password = "";
	$db = "garage";

	$c = new mysqli($server, $user, $password, $db);

	if(mysqli_connect_errno())
	{
		die("Connection error:" . mysqli_connect_error());
		header("location: registration.php");
		exit();
	}

	$reservation = "";	

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$first = mysqli_real_escape_string($c, $_POST['first']);
		$last = mysqli_real_escape_string($c, $_POST['last']);
		$email = mysqli_real_escape_string($c, $_POST['email']);
		$prefix = mysqli_real_escape_string($c, $_POST['prefix']);
		$phone = mysqli_real_escape_string($c, $_POST['phone']);
		$p1 = mysqli_real_escape_string($c, $_POST['password1']);
		$p2 = mysqli_real_escape_string($c, $_POST['password2']);
		$usertype = "regular";

		$call = ltrim($phone, "0");
		$line = $prefix . $call;
		$encrypt = strlen($p1);
		$reinforce = strlen($p2);
	
		if(isset($_POST['submit']))
		{
			$query = "SELECT * FROM accounts WHERE email = ?";
					
			$ps = $c->prepare($query);

			$ps->bind_param("s", $email);

			$ps->execute();

			$ps->store_result();

			if(!$ps)
			{
				die("Failed to retrieve data:" . mysqli_error($c));
				header("location: registration.php");
				exit();
			}
			else
			{
				$instance = $ps->num_rows;

				if($instance == 0)
				{
					if(empty($first) && empty($last) && empty($email) && empty($prefix) && empty($phone) && empty($p1) && empty($p2) && $p1 != $p2 && $encrypt < 6 && $reinforce < 6)
					{
						header("location: registration.php");
						exit();
					}
					else
					{

						$ps->close();

						$query2 = "INSERT INTO `accounts` (`first`, `last`, `email`, `password1`, `password2`, `phone`, `usertype`) VALUES (?, ?, ?, ?, ?, ?, ?)";

						$ps2 = $c->prepare($query2);

						$ps2->bind_param("sssssss", $first, $last, $email, $p1, $p2, $line, $usertype);

						$ps2->execute();

						$ps2->close();

						if(!$ps2)
						{
							die("Failed to insert data:" . mysqli_error($c));
							header("location: registration.php");
							exit();
						}
						else
						{
							$query3 = "SELECT * FROM notifications";

							$ps3 = $c->prepare($query3);

							$ps3->execute();
							
							if(!$ps3)
						    {
						        die("Failed to retrieve data:" . mysqli_error($c));
						        header("location: registration.php");
						        exit();
						    }

							$ps3->store_result();

						    $recording = $ps3->num_rows;

						    if($recording == 0)
						    {
						    	$index = 1;
						    }
						    else
						    {
						    	$index = $recording + 1;
						    }

						    $query4 = "SELECT * FROM notifications WHERE serialno = ?";

							$ps4 = $c->prepare($query4);

							$ps4->bind_param("s", $index);

							$ps4->execute();
							
							if(!$ps4)
						    {
						        die("Failed to retrieve data:" . mysqli_error($c));
						        header("location: registration.php");
						        exit();
						    }

						    $ps4->store_result();

						    $valid = $ps4->num_rows;

						    $ps4->bind_result($key, $nature, $entry, $credentials, $contact, $tag);

						    if($valid != 0)
						    {
						    	while ($ps4->fetch())
						    	{
						    		$index = $key + 1;
						    	}
						    }

						    $ps4->close();

							$query5  = "SELECT * FROM accounts WHERE email = ?";

							$ps5 = $c->prepare($query5);

							$ps5->bind_param("s", $email);

							$ps5->execute();

							if(!$ps5)
						    {
						        die("Failed to retrieve data:" . mysqli_error($c));
						        header("location: insertnotifications.php");
						        exit();
						    }
						    
						    $ps5->store_result();

						    $reading = $ps5->num_rows;

						    $ps5->bind_result($directory, $surname, $direction, $encrypt, $reinforce, $contact, $access);

						    if($reading != 0)
						    {
						    	while ($ps5->fetch())
						    	{
							    	$designate = $directory . " " . $surname;
							    }

							    $report = "New Account";
							    $beacon = "";
							    $relevance = "high";

							    $ps5->close();

						    	$query6 = "INSERT INTO `notifications` (`serialno`,`reminder`, `category`, `priority`, `username`, `phone`, `email`) VALUES (?,?, ?, ?, ?, ?, ?)";
									
								$ps6 = $c->prepare($query6);

								$ps6->bind_param("ssssss", $index, $report, $beacon, $relevance, $designate, $contact, $direction);

								$ps6->execute();

								if(!$ps5)
								{
									die("Failed to insert data:" . mysqli_error($c));
									header("location: insertnotifications.php");
									exit();
								}
								else
								{
									header("location: notifications.php");
									exit();

									$ps6->close();
								}
						    }

							header("location: login.php");
							exit();
						}
					}
				}
				else
				{
					$reservation = "*You Already have an Account";
				}
			}
		}
	}

	$c->close();
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
					<img src = "registration.jpg" alt = "Registration" class = "rounded">
					<h1><strong>User Registration</strong></h1>
				</center>
		</div>
		<div id = "stationary">
			<center>
				<fieldset id = "drape">
					<div class = "form-group">
						<h4><center>Registration Details</center></h4>
					</div>
					<form name = "registration" method = "post" action = "registration.php" onsubmit = "return(register());">
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
						<div class = "text-danger">
							<?php echo $reservation; ?>
						</div>
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
							<option value = "+256">+256</option>
							<option value = "+1">+1</option>
							<option value = "+44">+44</option>
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