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

    $inventory = "";
    $negative = "";
    $peculiar = "";

     if ($authority != "manager")
     {
     	header("location:home.php");
        exit();
     }

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$label = mysqli_real_escape_string($c, $_POST['label']);
		$period = mysqli_real_escape_string($c, $_POST['period']);
		$lapse = mysqli_real_escape_string($c, $_POST['lapse']);
		$report = mysqli_real_escape_string($c, $_POST['report']);
		$quota = mysqli_real_escape_string($c, $_POST['quota']);
		$arrears = "pending";
		$direction = mysqli_real_escape_string($c, $_POST['direction']);
		$headway = "approved";

		if (isset($_POST['submit']))
		{
			if (!empty($label) && !empty($period) && !empty($lapse) && !empty($report) && !empty($quota) && !empty($direction))
			{
				$query6 = "SELECT * FROM schedule WHERE status = '$headway' AND email = '$direction'";

				$ps7 = mysqli_query($c, $query6);
				if(!$ps7)
			    {
			        die("Failed to retrieve data:" . mysqli_error($c));
			        header("location: insertschedule.php");
			        exit();
			    }
				
				$rs6 = mysqli_fetch_assoc($ps7);

				$instance = mysqli_num_rows($ps7);

				if($instance != 0)
				{
			    	$query7 = "DELETE FROM schedule WHERE status = '$headway' AND (period = '$period' AND (lapse = '$lapse' AND email = '$direction'))";
					$ps8 = mysqli_query($c, $query7);

					if(!$ps8)
				    {
				        die("Failed to delete data:" . mysqli_error($c));
				        header("location: insertschedule.php");
				        exit();
				    }

					$query4  = "SELECT * FROM history";

					$ps5 = mysqli_query($c, $query4);

					if(!$ps5)
				    {
				        die("Failed to retrieve data:" . mysqli_error($c));
				        header("location: inserthistory.php");
				        exit();
				    }

				    $rs4 = mysqli_fetch_assoc($ps5);

				    $reference = $rs4['serialno'];
				    $list = mysqli_num_rows($ps5);

				    if($list == 0)
				    {
				    	$entry = 1;
				    }
				    else
				    {
				    	$entry = $list + 1;
				    }

				    $query6  = "SELECT * FROM accounts WHERE email = '$direction'";

					$ps7 = mysqli_query($c, $query6);

					if(!$ps7)
				    {
				        die("Failed to retrieve data:" . mysqli_error($c));
				        header("location: inserthistory.php");
				        exit();
				    }

				    $reading = mysqli_num_rows($ps7);

				    if($reading != 0)
				    {
					    while ($rs6 = mysqli_fetch_assoc($ps7))
					    {
					    	$directory = $rs6['first'];
					    	$surname = $rs6['last'];
					    	$contact = $rs6['phone'];

					    	$designate = $directory . " " . $surname;
					    }

					    $query8 = "SELECT * FROM vehicles WHERE registration = '$label'";

					    $ps9 = mysqli_query($c, $query9);

					    if(!$ps9)
					    {
					        die("Failed to retrieve data:" . mysqli_error($c));
					        header("location: inserthistory.php");
					        exit();
					    }

					    $review = mysqli_num_rows($ps8);

					    if($review != 0)
					    {
					    	$query5 = "INSERT INTO `history`(`serialno`, `registration`, `period`, `lapse`, `description`, `expense`, `charge`, `username`, `phone`, `email`) VALUES ('$entry', '$label', '$period', '$lapse', '$report', '$quota', '$arrears', '$designate', '$contact', '$direction')";

							$ps6 = mysqli_query($c, $query5);

							if(!$ps6)
						    {
						        die("Failed to insert data:" . mysqli_error($c));
						        header("location: inserthistory.php");
						        exit();
						    }
						    else
						    {
						    	$query9 = "SELECT * FROM notifications";

								$ps10 = mysqli_query($c, $query9);
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

							    $query10 = "SELECT * FROM notifications WHERE serialno = '$source'";

								$ps11 = mysqli_query($c, $query10);
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

							    $query11  = "SELECT * FROM accounts WHERE email = '$direction'";

								$ps12 = mysqli_query($c, $query11);

								if(!$ps12)
							    {
							        die("Failed to retrieve data:" . mysqli_error($c));
							        header("location: insertnotifications.php");
							        exit();
							    }
							    
							    $reading = mysqli_num_rows($ps12);

							    if($reading != 0)
							    {
							    	while ($rs11 = mysqli_fetch_assoc($ps12))
							    	{
								    	$directory = $rs11['first'];
								    	$surname = $rs11['last'];
								    	$beacon = $rs11['email'];
								    	$contact = $rs11['phone'];

								    	$designate = $directory . " " . $surname;
								    }

									$query12 = "INSERT INTO `notifications` (`serialno`,`reminder`, `category`, `priority`, `username`, `phone`, `email`) VALUES ('$source','New Entry', 'payment', 'high', '$designate', '$contact' ,'$beacon')";
											
									$ps13 = mysqli_query($c, $query12);

									if(!$ps13)
									{
										die("Failed to insert data:" . mysqli_error($c));
										header("location: userinsert.php");
										exit();
									}
							    }

						    	header("location: history.php");
						    	exit();
						    }
						}
						else
						{
							$negative = "*Vehicle Unavailable";
						}
				    }
				    else
				    {
				    	$inventory = "*User does not Exist";
				    }			
				}
				else
				{
					$peculiar = "*Schedule Entry Unavailable";
				}
			}
			else
			{
				header("location: inserthistory.php");
			    exit();
			}
		}
	}

	mysqli_close($c);
?>
<html>
<head>
	<title>Add History</title>
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
					<li class="navbar-brand nav-item active">
				      <a class="nav-link" href="history.php">
						<img src = "history icon.png" alt = "history" id = "scale" class = "rounded">
						Service History
					</a>
				    </li>
				  </ul>
				</nav>
			</center>
		</div>
		<div id = "drape">
			<center>
			<fieldset>
			<form method = "post" action = "inserthistory.php" onsubmit = "return inserthistory()">
				<div class = "form-group">
					<h1><strong><center>Insert Entry</center></strong></h1>
				</div>
				<div class="form-group">
			    <label>Registration:</label>
			    <input type="text" class="form-control" name = "label" id = "modify">
				<div class = "text-danger">
					<?php echo $negative; ?>
				</div>
			  </div>
			  <div class="form-group">
			    <label>Date:</label>
			    <input type="date" class="form-control" name = "period" id = "modify">
			  </div>
				<div class="form-group">
			    <label>Time:</label>
			    <input type="time" class="form-control" name = "lapse" id = "modify">
				<div class = "text-danger">
					<?php echo $peculiar; ?>
				</div>
			  </div>
				<div class="form-group">
			    <label>Description:</label>
				<textarea class = "form-control" id = "extent" name = "report"></textarea>
			  </div>
				<div class="form-group">
			    <label>Value:</label>
			    <input type="text" class="form-control" name = "quota" id = "modify">
			  </div>
				<div class="form-group">
			    <label>Email Address:</label>
			    <input type="text" class="form-control" name = "direction" id = "modify">
				<div class = "text-danger">
					<?php echo $inventory; ?>
				</div>
				</div>
			  <button type="submit" class="btn btn-dark" name = "submit">Add</button>
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