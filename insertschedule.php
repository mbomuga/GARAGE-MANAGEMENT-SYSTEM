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

    if ($authority != "regular")
     {
     	header("location:home.php");
        exit();
     }

    $reservation = "";
    $present = "";
    $disconnect = "";

     if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$period = mysqli_real_escape_string($c, $_POST['period']);
		$lapse = mysqli_real_escape_string($c, $_POST['lapse']);
		$progress = "pending";
		$progress2 = "rejected";

		if (isset($_POST['submit']))
		{
			if (!empty($period) && !empty($lapse))
			{	
				$query6 = "SELECT * FROM history WHERE charge = 'pending'";

				$ps7 = mysqli_query($c, $query6);
				if(!$ps7)
			    {
			        die("Failed to retrieve data:" . mysqli_error($c));
			        header("location: userhistory.php");
			        exit();
			    }
			    
			    $reading = mysqli_num_rows($ps7);

			    if($reading == 0)
			    {

					$query2 = "SELECT * FROM schedule WHERE status = '$progress2' AND email = '$heading'";

					$ps2 = mysqli_query($c, $query2);
					if(!$ps2)
				    {
				        die("Failed to retrieve data:" . mysqli_error($c));
				        header("location: insertschedule.php");
				        exit();
				    }
					
					$rs2 = mysqli_fetch_assoc($ps2);

					$report = mysqli_num_rows($ps2);

					if($report != 0)
					{
						$query3 = "DELETE FROM schedule WHERE status = '$progress2' AND email = '$heading'";
						$ps3 = mysqli_query($c, $query3);

						if(!$ps3)
					    {
					        die("Failed to delete data:" . mysqli_error($c));
					        header("location: insertschedule.php");
					        exit();
					    }
					}

					$query4 = "SELECT * FROM schedule WHERE period = '$period' AND lapse = '$lapse'";

					$ps4 = mysqli_query($c, $query4);
					if(!$ps4)
				    {
				        die("Failed to retrieve data:" . mysqli_error($c));
				        header("location: insertschedule.php");
				        exit();
				    }

				    $rs4 = mysqli_fetch_assoc($ps4);

				    $report2 = mysqli_num_rows($ps4);

				    if($report2 != 0)
				    {
				    	$reservation = "*Appointment Request Already Made";
				    }
				    else
				    {
				    	$query8 = "SELECT * FROM schedule WHERE (status = 'pending' AND status = 'approved') AND email = '$heading'";

						$ps9 = mysqli_query($c, $query8);
						if(!$ps9)
					    {
					        die("Failed to retrieve data:" . mysqli_error($c));
					        header("location: schedule.php");
					        exit();
					    }
					    $instance = mysqli_num_rows($ps9);

					    if ($instance == 0)
					    {
					    	$query7 = "SELECT * FROM schedule";

							$ps8 = mysqli_query($c, $query7);
							if(!$ps8)
						    {
						        die("Failed to retrieve data:" . mysqli_error($c));
						        header("location: schedule.php");
						        exit();
						    }
						    $recording = mysqli_num_rows($ps8);

						    if ($recording == 0)
						    {
						    	$index = 1;
						    }
						    else
						    {
						    	$index = $recording + 1;
						    }

							$query5 = "INSERT INTO `schedule`(`serialno`,`period`, `lapse`, `status`, `username`, `phone`, `email`) VALUES ('$index','$period','$lapse','$progress','$identity', '$line','$heading')";
							$ps6 = mysqli_query($c, $query5);

							if(!$ps6)
						    {
						        die("Failed to insert data:" . mysqli_error($c));
						        header("location: insertschedule.php");
						        exit();
						    }
						    else
						    {
						    	header("location: schedule.php");
						    	exit();
						    }
						}
						else
						{
							$present = "*You Already Have an Appointment";
						}
					}
				}
				else
				{
					header("location: payment.php");
			    	exit();
				}
			}
			else
			{
				header("location: insertschedule.php");
			    exit();
			}
		}
	}

	mysqli_close($c);
?>
<html>
<head>
	<title>Add Schedule</title>
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
					<li class="navbar-brand nav-item active">
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
		<div id = "drape">
			<center>
				<fieldset>
					<form method = "post" action = "insertschedule.php" onsubmit = "return insertschedule()">
						<div class = "form-group">
							<h1><strong><center>Insert Entry</center></strong></h1>
						</div>
						<div class="form-group">
					    <label>Date:</label>
					    <input type="date" class="form-control" name = "period" id = "modify">
					  </div>
					  <div class="form-group">
					    <label>Time:</label>
					    <input type="time" class="form-control" name = "lapse" id = "modify">
						<?php echo $reservation; ?>
						<?php echo $present; ?>
						<?php echo $disconnect; ?>
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