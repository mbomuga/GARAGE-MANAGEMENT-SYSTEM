<!DOCTYPE html>
<?php
	
	$server = "localhost";
	$user = "root";
	$password = "";
	$db = "garage";

	$c = mysqli_connect($server, $user, $password, $db);

	if(mysqli_connect_errno())
	{
		die("Connection error:" . mysqli_connect_error());
		header("location: login.php");
		exit();
	}
	else
	{
		session_start();
		
		$access = "";

		if(!isset($_SESSION['name']) && !isset($_SESSION['email']) && !isset($_SESSION['conduct']))
		{
			if($_SERVER['REQUEST_METHOD'] == 'POST')
			{
				$email = mysqli_real_escape_string($c, $_POST['email']);
				$p = mysqli_real_escape_string($c, $_POST['key']);
				
				if(isset($_POST['submit']))
				{

					if (empty($email) && empty($p))
					{
						header("location: login.php");
						exit();
					}
					else
					{
						$query = "SELECT * FROM accounts WHERE email = '$email' AND password1 = '$p'";
						
						$ps = mysqli_query($c, $query);

						if(!$ps)
						{
							die("Failed to retrieve data:" . mysqli_error($c));
							header("location: registration.php");
							exit();
						}
						else
						{

							$tally = mysqli_num_rows($ps);

							if($tally == 1)
							{
								while ($rs = mysqli_fetch_assoc($ps))
								{
									$authority = $rs['usertype'];

									if($authority == "manager")
									{
										$_SESSION['name'] = "Garage Manager";
										$_SESSION['email'] = $rs['email'];
										$_SESSION['line'] = $rs['phone'];
										$_SESSION['conduct'] = $authority;
									}
									elseif ($authority == "owner")
									{
										$_SESSION['name'] = "Owner";
										$_SESSION['email'] = $rs['email'];
										$_SESSION['line'] = $rs['phone'];
										$_SESSION['conduct'] = $authority;
									}
									else
									{
										$first = $rs['first'];
										$last =  $rs['last'];
										$credentials = $first . " " . $last;
										$_SESSION['name'] = $credentials;
										$_SESSION['email'] = $rs['email'];
										$_SESSION['line'] = $rs['phone'];
										$_SESSION['conduct'] = $authority;
									}
								}
								
								header("location: home.php");
								exit();
							}
							else
							{
								$access = "*Access Denied";
							}
						}
					}
				}
			}
		}
		else
		{
			header("location: home.php");
			exit();
		}
	}

	mysqli_close($c);
?>
<html>
<head>
	<title>Login</title>
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
		<div>
			<center>
				<form method = "post" action="login.php" onsubmit = "return login()">
					<fieldset id = "position">
						<div class = "form-group">
							<table class = "table" id = "frame">
								<tr>
									<td colspan = "2">
									<center>
										<img src = "unlock.png" alt = "unlock" class = "rounded">
									</center>
									</td>
								</tr>
							</table>
						</div>
					<div class="form-group">
				    <label>Email address:</label>
				    <input type="text" class="form-control" name="email" id = "dimensions">
				  </div>
				  <div class="form-group">
				    <label>Password:</label>
				    <input type="password" class="form-control" name="key" id = "dimensions">
					<div class = "text-danger">
						<?php echo $access; ?>
					</div>
				  </div>
				  <button type="submit" class="btn btn-dark" name = "submit">Submit</button>
						<div class = "form-group">
							<table id = "frame">							
								<tr>
									<td id = "default">
										<center>
											<strong>If you don't have an Account:</strong>
										</center>
									</td>
									<td id = "default">
										<center>
											<a href = "registration.php" target = "_self">Sign Up</a>
										</center>
									</td>
								</tr>
							</table>
						</div>
					</fieldset>
				</form>
			</center>
		</div>
		<div>
			<center>
				<footer id = "refine">
					<h1>(C). 2017 All Rights Reserved</h1>
				</footer>
			</center>
		</div>
	</body>
</html>