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
    else
    {  
	 if(!isset($_SESSION['name']) && !isset($_SESSION['email']) && !isset($_SESSION['conduct']) && !isset($_SESSION['line']))
	 {
	    header("location:login.php");
	    exit();
	 }
    }

    $missing = "";
    
    if($authority == "manager" || $authority == "owner")
    {
    	header("location:home.php");
	    exit();
    }

     if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$group = mysqli_real_escape_string($c, $_POST['updatetype']);
		$alter = mysqli_real_escape_string($c, $_POST['updatevalue']);
		$label = mysqli_real_escape_string($c, $_POST['label']);

		if (isset($_POST['submit']))
		{
			
			if(!empty($label) && !empty($alter))
			{
				$query5 = "SELECT * FROM vehicles WHERE registration = '$label' AND email = '$heading'";

				$ps5 = mysqli_query($c, $query5);
				if(!$ps5)
			    {
			        die("Failed to retrieve data:" . mysqli_error($c));
			        header("location: viewvehicles.php");
			        exit();
			    }

			    $instance = mysqli_num_rows($ps5);

			    if($instance != 0)
			    {
					if ($group == "type")
					{
						$query2 = "UPDATE vehicles SET model = '$alter' WHERE registration = '$label' AND email = '$heading'";
						$ps2 = mysqli_query($c, $query2);

						if(!$ps2)
					    {
					        die("Failed to update data:" . mysqli_error($c));
					        header("location: updatevehicles.php");
					        exit();
					    }
					    else
					    {
					    	$query6 = "SELECT * FROM notifications";

							$ps6 = mysqli_query($c, $query6);
							if(!$ps6)
						    {
						        die("Failed to retrieve data:" . mysqli_error($c));
						        header("location: userinsert.php");
						        exit();
						    }
						    $iteration = mysqli_num_rows($ps6);

						    if($iteration == 0)
						    {
						    	$source = 1;
						    }
						    else
						    {
						    	$source = $iteration + 1;
						    }

						    $query7 = "SELECT * FROM notifications WHERE serialno = '$source'";

							$ps7 = mysqli_query($c, $query7);
							if(!$ps7)
						    {
						        die("Failed to retrieve data:" . mysqli_error($c));
						        header("location: userinsert.php");
						        exit();
						    }
						    $valid = mysqli_num_rows($ps7);

						    if($valid != 0)
						    {
						    	while ($rs7 = mysqli_fetch_assoc($ps7))
						    	{
						    		$source = $rs7['serialno'] + 1;
						    	}
						    }

						    $query8  = "SELECT * FROM accounts WHERE usertype = 'manager'";

							$ps8 = mysqli_query($c, $query8);

							if(!$ps8)
						    {
						        die("Failed to retrieve data:" . mysqli_error($c));
						        header("location: insertnotifications.php");
						        exit();
						    }
						    
						    $reading = mysqli_num_rows($ps8);

						    if($reading != 0)
						    {
						    	while ($rs8 = mysqli_fetch_assoc($ps8))
						    	{
							    	$directory = $rs8['first'];
							    	$surname = $rs8['last'];
							    	$beacon = $rs8['email'];
							    	$contact = $rs8['phone'];

							    	$designate = $directory . " " . $surname;
							    }

								$query9 = "INSERT INTO `notifications` (`serialno`,`reminder`, `category`, `priority`, `username`, `phone`, `email`) VALUES ('$source','Vehicle Updated', 'vehicle', 'high', '$designate', '$contact' ,'$beacon')";
										
								$ps9 = mysqli_query($c, $query9);

								if(!$ps9)
								{
									die("Failed to insert data:" . mysqli_error($c));
									header("location: userinsert.php");
									exit();
								}
						    }

					    	header("location: vehicles.php");
					    	exit();
					    }
					}
					elseif ($group == "duration")
					{
						$query3 = "UPDATE vehicles SET year = '$alter' WHERE registration = '$label' AND email = '$heading'";
						$ps3 = mysqli_query($c, $query3);

						if(!$ps3)
					    {
					        die("Failed to update data:" . mysqli_error($c));
					        header("location: updatevehicles.php");
					        exit();
					    }
					    else
					    {
					    	$query10 = "SELECT * FROM notifications";

							$ps10 = mysqli_query($c, $query10);
							if(!$ps10)
						    {
						        die("Failed to retrieve data:" . mysqli_error($c));
						        header("location: userinsert.php");
						        exit();
						    }
						    $iteration = mysqli_num_rows($ps10);

						    if($iteration == 0)
						    {
						    	$source = 1;
						    }
						    else
						    {
						    	$source = $iteration + 1;
						    }

						    $query11 = "SELECT * FROM notifications WHERE serialno = '$source'";

							$ps11 = mysqli_query($c, $query11);
							if(!$ps11)
						    {
						        die("Failed to retrieve data:" . mysqli_error($c));
						        header("location: userinsert.php");
						        exit();
						    }
						    $valid = mysqli_num_rows($ps11);

						    if($valid != 0)
						    {
						    	while ($rs11 = mysqli_fetch_assoc($ps11))
						    	{
						    		$source = $rs11['serialno'] + 1;
						    	}
						    }

						    $query12  = "SELECT * FROM accounts WHERE usertype = 'manager'";

							$ps12 = mysqli_query($c, $query12);

							if(!$ps12)
						    {
						        die("Failed to retrieve data:" . mysqli_error($c));
						        header("location: insertnotifications.php");
						        exit();
						    }
						    
						    $reading = mysqli_num_rows($ps12);

						    if($reading != 0)
						    {
						    	while ($rs12 = mysqli_fetch_assoc($ps12))
						    	{
							    	$directory = $rs12['first'];
							    	$surname = $rs12['last'];
							    	$beacon = $rs12['email'];
							    	$contact = $rs12['phone'];

							    	$designate = $directory . " " . $surname;
							    }

								$query13 = "INSERT INTO `notifications` (`serialno`,`reminder`, `category`, `priority`, `username`, `phone`, `email`) VALUES ('$source','Vehicle Updated', 'vehicle', 'high', '$designate', '$contact' ,'$beacon')";
										
								$ps13 = mysqli_query($c, $query13);

								if(!$ps13)
								{
									die("Failed to insert data:" . mysqli_error($c));
									header("location: userinsert.php");
									exit();
								}
						    }

					    	header("location: vehicles.php");
					    	exit();
					    }
					}
					else
					{
						$query18 = "SELECT * FROM history WHERE email = '$heading'";

						$ps18 = mysqli_query($c, $query18);
						if(!$ps18)
					    {
					        die("Failed to retrieve data:" . mysqli_error($c));
					        header("location: userhistory.php");
					        exit();
					    }
					    $exhibit = mysqli_num_rows($ps18);

					    if($exhibit>0)
					    {
					    	while ($rs18 = mysqli_fetch_assoc($ps18))
					    	{
					    		$query19 = "UPDATE history SET registration = '$alter' WHERE registration = '$label' AND email = '$heading'";
								
								$ps19 = mysqli_query($c, $query19);

								if(!$ps19)
							    {
							        die("Failed to update data:" . mysqli_error($c));
							        header("location: updatehistory.php");
							        exit();
							    }
					    	}
					    }

						$query4 = "UPDATE vehicles SET registration = '$alter' WHERE registration = '$label' AND email = '$heading'";
						$ps4 = mysqli_query($c, $query4);

						if(!$ps4)
					    {
					        die("Failed to update data:" . mysqli_error($c));
					        header("location: updatevehicles.php");
					        exit();
					    }
					    else
					    {
					    	$query14 = "SELECT * FROM notifications";

							$ps14 = mysqli_query($c, $query14);
							if(!$ps14)
						    {
						        die("Failed to retrieve data:" . mysqli_error($c));
						        header("location: userinsert.php");
						        exit();
						    }
						    $iteration = mysqli_num_rows($ps14);

						    if($iteration == 0)
						    {
						    	$source = 1;
						    }
						    else
						    {
						    	$source = $iteration + 1;
						    }

						    $query15 = "SELECT * FROM notifications WHERE serialno = '$source'";

							$ps15 = mysqli_query($c, $query15);
							if(!$ps15)
						    {
						        die("Failed to retrieve data:" . mysqli_error($c));
						        header("location: userinsert.php");
						        exit();
						    }
						    $valid = mysqli_num_rows($ps15);

						    if($valid != 0)
						    {
						    	while ($rs15 = mysqli_fetch_assoc($ps15))
						    	{
						    		$source = $rs15['serialno'] + 1;
						    	}
						    }

						    $query16  = "SELECT * FROM accounts WHERE usertype = 'manager'";

							$ps16 = mysqli_query($c, $query16);

							if(!$ps16)
						    {
						        die("Failed to retrieve data:" . mysqli_error($c));
						        header("location: insertnotifications.php");
						        exit();
						    }
						    
						    $reading = mysqli_num_rows($ps16);

						    if($reading != 0)
						    {
						    	while ($rs16 = mysqli_fetch_assoc($ps16))
						    	{
							    	$directory = $rs16['first'];
							    	$surname = $rs16['last'];
							    	$beacon = $rs16['email'];
							    	$contact = $rs16['phone'];

							    	$designate = $directory . " " . $surname;
							    }

								$query17 = "INSERT INTO `notifications` (`serialno`,`reminder`, `category`, `priority`, `username`, `phone`, `email`) VALUES ('$source','Vehicle Updated', 'vehicle', 'high', '$designate', '$contact' ,'$beacon')";
										
								$ps17 = mysqli_query($c, $query17);

								if(!$ps17)
								{
									die("Failed to insert data:" . mysqli_error($c));
									header("location: userinsert.php");
									exit();
								}
						    }

					    	header("location: vehicles.php");
					    	exit();
					    }
					}
				}
				else
				{
					$missing = "*Vehicle Not Found";
				}
			}
			else
			{
				header("location: updatevehicles.php");
			    exit();
			}
		}
	}

	mysqli_close($c);
?>
<html>
<head>
	<title>Update Vehicle</title>
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
					</a>
				    <div class="dropdown-menu">
				      <a class="dropdown-item" href="logout.php">
						<img src = "lock.png" alt = "lock" id = "scale" class = "rounded">
						Logout
						</a>
				    </div>
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
				    <li class="navbar-brand">
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
				    <li class="navbar-brand nav-item active">
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
			<fieldset id = "drape">
			<form method = "post" action = "userupdate.php" onsubmit = "return updatevehicles()">
					<div class = "form-group">
						<h1><strong><center>Update Vehicle</center></strong></h1>
					</div>
				  <div class="form-group">
				    <label>Update:</label>
				    <select class="form-control" name = "updatetype" id = "modify">
						<option value = "licence">Registration</option>
						<option value = "type">Model</option>
						<option value = "duration">Year</option>
					</select>
				  </div>
					<div class="form-group">
					<label>Update Value:</label>
				    <input type="text" class="form-control" name = "updatevalue" id = "modify">
				  </div>
					<div class="form-group">
				    <label>Vehicle Registration:</label>
				    <input type="text" class="form-control" name = "label" id = "modify">
					<div class = "text-danger">
						<?php echo $missing; ?>
					</div>
				  </div>
				<button type="submit" class="btn btn-dark" name = "submit">Update</button>
			</form>
			</fieldset>
			</center>
		</div>
		<div>
			<footer id = "footnote">
				<center>
					<h1> (C). 2017 All Rights Reserved</h1>
				</center>
			</footer>
		</div>
	</body>
</html>