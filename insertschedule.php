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
	 if(!isset($_SESSION['name']) || !isset($_SESSION['email']) || !isset($_SESSION['conduct']))
	 {
	    header("location:login.php");
	    exit();
	 }
    }

    $reservation = "";

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
			    	header("location: insertschedule.php");
			        exit();
			    }
			    else
			    {

					$query5 = "INSERT INTO `schedule`(`period`, `lapse`, `status`, `username`, `email`) VALUES ('$period','$lapse','$progress','$identity', '$heading')";
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
		    <center>
		      <table id = "primary">
		        <tr>
		          <td id = "default">
		            <center>
		              <strong>Welcome: <?php echo $identity; ?></strong>
		            </center>
		          </td>
		          <td id = "default">
		            <center>
		              <strong><a href = "logout.php">Logout</a></strong>
		            </center>
		          </td>
		        </tr>
		      </table>
		    </center>
	  	</div>
	  	<div id = "reverse">
			<a href = "login.php" target = "_self">
			<img src = "id icon.png" alt = "Login" id = "scale">
			<strong>Login</strong>
			</a>
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
						<img src = "home.png" alt = "home" id = "scale">
						Home
					</a>
				    </li>
				    <li class="nav-item dropdown navbar-brand">
				      <a class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">
						<img src = "details.png" alt = "profile" id = "scale">
							Profile
							<div class="dropdown-menu">
						        <a class="dropdown-item" href="userprofile.php">
									<img src = "Profile Picture.png" alt = "profile" id = "scale">
									User Profile
								</a>
						        <a class="dropdown-item" href="adminprofile.php">
									<img src = "group icon.png" alt = "group" id = "scale">
									View Users
								</a>
							</div>
						</a>
				    </li>
				    <li class="navbar-brand">
				      <a class="nav-link" href="vehicles.php">
						<img src = "vehicle icon.png" alt = "vehicle" id = "scale">
						Vehicles</a>
				    </li>
					<li class="navbar-brand">
				      <a class="nav-link" href="notifications.php">
						<img src = "notifications.png" alt = "notification" id = "scale">
						Notifications
						</a>
				    </li>
					<li class="navbar-brand nav-item active">
				      <a class="nav-link" href="schedule.php">
						<img src = "schedule icon.png" alt = "schedule" id = "scale">
						Schedule
						</a>
				    </li>
					<li class="navbar-brand">
				      <a class="nav-link" href="payment.php">
						<img src = "payment icon.png" alt = "payment" id = "scale">
						Payment</a>
				    </li>
					<li class="navbar-brand">
				      <a class="nav-link" href="history.php">
						<img src = "history icon.png" alt = "history" id = "scale">
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
					  </div>
				  	<button type="submit" class="btn btn-primary" name = "submit">Add</button>
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