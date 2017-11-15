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

  session_start();
   
   $identity = "";
   $passion = "";

	if(!isset($_SESSION['name']) && !isset($_SESSION['email']) && !isset($_SESSION['conduct']) && !isset($_SESSION['line']))
	{
		$passion = "Sign In";
	}
	else
	{
		$identity = $_SESSION['name'];
		$heading = $_SESSION['email'];
		$authority = $_SESSION['conduct'];
		$line = $_SESSION['line'];

		$query =  "SELECT * FROM accounts WHERE email = '$heading'";
		$ps = mysqli_query($c, $query);

		if(!$ps)
		{
		    die("Failed to retrieve data:" . mysqli_error($c));
		    header("location: login.php");
		    exit();
		}
	}


   mysqli_close($c);
?>
<html>
<head>
	<title>GMS Home</title>
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
			<ul class= "nav justify-content-end">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" data-toggle="dropdown">
					<img src = "id icon.png" alt = "Login" id = "scale" class = "rounded">						
					<strong><?php echo $identity; ?></strong>
					<strong><?php echo $passion; ?></strong>
					</a>
				    <?php 
						if(!isset($_SESSION['name']) && !isset($_SESSION['email']) && !isset($_SESSION['conduct']) && !isset($_SESSION['line']))
						{
							echo "<div class = 'dropdown-menu'><a class = 'dropdown-item' href = 'login.php'><img src = 'unlock.png' alt = 'unlock' id = 'scale' class = 'rounded'>Login</a><a class = 'dropdown-item' href = 'registration.php'><img src = 'registration.jpg' alt = 'register' id = 'scale' class = 'rounded'>Sign Up</a></div>";
						}
						else
						{
							echo "<div class = 'dropdown-menu'><a class = 'dropdown-item' href = 'logout.php'><img src = 'lock.png' alt = 'lock' id = 'scale' class = 'rounded'>Logout</a></div>";
						}
					 ?>
				</li>
			</ul>
		</div>
		<div>
			<center>
				<a href = "home.php"><h1><strong>GARAGE MANAGEMENT SYSTEM</strong></h1></a>
			</center>
		</div>
		<div>
			<center>
				<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
				  <ul class="navbar-nav">
				    <li class="navbar-brand nav-item active">
				    <a class="nav-link" href="home.php">
						<img src = "home.png" alt = "home" id = "scale" class = "rounded">
						Home
					</a>
				    </li>
				    <li class="nav-item dropdown navbar-brand">
				      <a class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">
						<img src = "details.png" alt = "profile" id = "scale">
							Profile
							<div class="dropdown-menu">
						        <a class="dropdown-item" href="userprofile.php">
									<img src = "Profile Picture.png" alt = "profile" id = "scale" class = "rounded">
									User Profile
								</a>
						        <a class="dropdown-item" href="adminprofile.php">
									<img src = "group icon.png" alt = "group" id = "scale" class = "rounded">
									View Users
								</a>
							</div>
						</a>
				    </li>
				    <li class="navbar-brand">
				      <a class="nav-link" href="vehicles.php">
						<img src = "vehicle icon.png" alt = "vehicle" id = "scale" class = "rounded">
						Vehicles</a>
				    </li>
					<li class="navbar-brand">
				      <a class="nav-link" href="notifications.php">
						<img src = "notifications.png" alt = "notification" id = "scale" class = "rounded">
						Notifications
						</a>
				    </li>
					<li class="navbar-brand">
				      <a class="nav-link" href="schedule.php">
						<img src = "schedule icon.png" alt = "schedule" id = "scale" class = "rounded">
						Schedule
						</a>
				    </li>
					<li class="navbar-brand">
				      <a class="nav-link" href="payment.php">
						<img src = "payment icon.png" alt = "payment" id = "scale" class = "rounded">
						Payment</a>
				    </li>
					<li class="navbar-brand">
				      <a class="nav-link" href="history.php">
						<img src = "history icon.png" alt = "history" id = "scale" class = "rounded">
						Service History
					</a>
				    </li>
				  </ul>
				</nav>
			</center>
		</div>
		<div>
			<center>
				<h1><strong>Welcome to GMS</strong></h1>
			</center>
		</div>
		<div id="demo" class="carousel slide" data-ride="carousel">
		  <ul class="carousel-indicators">
		    <li data-target="#demo" data-slide-to="0" class="active"></li>
		    <li data-target="#demo" data-slide-to="1"></li>
		    <li data-target="#demo" data-slide-to="2"></li>
			<li data-target="#demo" data-slide-to="3"></li>
			<li data-target="#demo" data-slide-to="4"></li>
			<li data-target="#demo" data-slide-to="5"></li>
		  </ul>
		  <div class="carousel-inner">
		    <div class="carousel-item active">
			<center>
				<a href = "userprofile.php" target = "_self">
			      <img src="personal details.jpg" alt="personal details" id = "extend">
					<div class="carousel-caption">
						<div class="text-dark">
						    <h1>Profile</h1>
						</div>
				  </div>
				</a>
			</center>
		    </div>
		    <div class="carousel-item">
				<center>
					<a href = "vehicles.php" target = "_self">
				      <img src="vehicle photo.jpg" alt="vehicle photo" id = "extend">
						<div class="carousel-caption">
							<div class="text-dark">
						    	<h1>Vehicles</h1>
							</div>
					  	</div>
					</a>
				</center>
		    </div>
			<div class="carousel-item">
				<center>
					<a href = "notifications.php" target = "_self">
				      <img src="notification photo.png" alt="notification photo" id = "extend">
						<div class="carousel-caption">
							<div class="text-dark">
							    <h1>Notifications</h1>
							</div>
					  </div>
					</a>
				</center>
		    </div>
			<div class="carousel-item">
				<center>
					<a href = "schedule.php" target = "_self">
				      <img src="schedule photo.jpg" alt="schedule photo" id = "extend">
						<div class="carousel-caption">
							<div class="text-dark">
							    <h1>Schedule</h1>
							</div>
					  </div>
					</a>
				</center>
		    </div>
			<div class="carousel-item">
				<center>
					<a href = "payment.php" target = "_self">
				      <img src="payment photo.jpg" alt="Chicago" id = "extend">
						<div class="carousel-caption">
							<div class="text-dark">
							    <h1>Payment</h1>
							</div>
					  </div>
					</a>
				</center>
		    </div>
			<div class="carousel-item">
				<center>
					<a href = "history.php" target = "_self">
				      <img src="history photo.jpg" alt="history photo" id = "extend">
						<div class="carousel-caption">
							<div class="text-dark">
						    	<h1>Service History</h1>
							</div>
					  </div>
					</a>
				</center>
		    </div>
		  </div>
		  <a class="carousel-control-prev" href="#demo" data-slide="prev">
		    <span class="carousel-control-prev-icon"></span>
		  </a>
		  <a class="carousel-control-next" href="#demo" data-slide="next">
		    <span class="carousel-control-next-icon"></span>
		  </a>
		</div>
		<div>
			<center>
				<fieldset>
						<table id = "primary">
							<tr>
								<td id = "lounge">
									<center>
										<a href = "userprofile.php" target = "_self">
											<img src = "details.png" alt = "profile" id = "scale" class = "rounded">
											Profile
										</a>
									</center>
								</td>
								<td id = "lounge">
									<center>
										<a href = "vehicles.php" target = "_self">
											<img src = "vehicle icon.png" alt = "vehicle" id = "scale" class = "rounded">
											Vehicles
										</a>
									</center>
								</td>
							</tr>
							<tr>
								<td id = "lounge">
									<center>
										<p class = "lead">View your Personal details and Edit them</p>
									</center>
								</td>
								<td id = "lounge">
									<center>
										<p class = "lead">View Vehicles and Modify their Information</p>
									</center>
								</td>
							</tr>
						</tr>
							<td id = "lounge">
								<center>
									<a href = "notifications.php" target = "_self">
										<img src = "notifications.png" alt = "notification" id = "scale" class = "rounded">
										Notifications
									</a>
								</center>
							</td>
							<td id = "lounge">
								<center>
									<a href = "schedule.php" target = "_self">
										<img src = "schedule icon.png" alt = "schedule" id = "scale" class = "rounded">
										Schedule
									</a>
								</center>
							</td>
						</tr>
							<td id = "lounge">
								<center>
									<p class = "lead">See Notifications that you've Received</p>
								</center>
							</td>
							<td id = "lounge">
								<center>
									<p class = "lead">Request Service Appointments to the Garage and Receive Feedbeck</p>
								</center>
							</td>
						</tr>
						<tr>
							<td id = "lounge">
								<center>
									<a href = "payment.php" target = "_self">
										<img src = "payment icon.png" alt = "payment" id = "scale" class = "rounded">
										Payment
									</a>
								</center>
							</td>
							<td id = "lounge">
								<center>
									<a href = "history.php" target = "_self" class = "rounded">
										<img src = "history icon.png" alt = "history" id = "scale" class = "rounded">
										Service History
									</a>
								</center>
							</td>
						</tr>
						<tr>
							<td id = "lounge">
								<center>
									<p class = "lead">Perform Payments for Garage Services Received</p>
								</center>
							</td>
							<td id = "lounge">
								<center>
									<p class = "lead">Shows Service Information of Vehicles from the Garage</p>
								</center>
							</td>
						</tr>
					</table>
				</fieldset>
			</center>
		</div>
		<div>
			<center>
				<footer id = "footnote">
					<h1>(C). 2017 All Rights Reserved</h1>
				</footer>
			</center>
		</div>
	</body>
</html>