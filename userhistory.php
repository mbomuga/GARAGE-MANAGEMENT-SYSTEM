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
	 if(!isset($_SESSION['name']) && !isset($_SESSION['email']) && !isset($_SESSION['conduct']))
	 {
	    header("location:login.php");
	    exit();
	 }
    }

    $archives = "";
    $currency = "Ksh";

	$query2 = "SELECT * FROM history WHERE email = '$heading'";

	$ps3 = mysqli_query($c, $query2);
	if(!$ps3)
    {
        die("Failed to retrieve data:" . mysqli_error($c));
        header("location: userhistory.php");
        exit();
    }
    $reading2 = mysqli_num_rows($ps3);

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$group = mysqli_real_escape_string($c, $_POST['group']);
		$field = mysqli_real_escape_string($c, $_POST['field']);
		$opening = mysqli_real_escape_string($c, $_POST['opening']);
		$slot = mysqli_real_escape_string($c, $_POST['slot']);

		if(isset($_POST['submit']))
		{
			if(!empty($field) && !empty($opening) && !empty($slot))
			{
				if ($group == 'registration')
				{
					$query3 = "SELECT * FROM history WHERE registration = '$field' AND (period = '$opening' AND (lapse = '$slot' AND email = '$heading'))";

					$ps = mysqli_query($c, $query3);
					if(!$ps)
				    {
				        die("Failed to retrieve data:" . mysqli_error($c));
				        header("location: userhistory.php");
				        exit();
				    }

				    $reading = mysqli_num_rows($ps);
				}
				elseif ($group == 'fund')
				{
					$query4 = "SELECT * FROM history WHERE expense = '$field' AND (period = '$opening' AND (lapse = '$slot' AND email = '$heading'))";

					$ps = mysqli_query($c, $query4);
					if(!$ps)
				    {
				        die("Failed to retrieve data:" . mysqli_error($c));
				        header("location: userhistory.php");
				        exit();
				    }
				    $reading = mysqli_num_rows($ps);

				}
				else
				{
					$query14 = "SELECT * FROM history WHERE period = '$opening' AND (lapse = '$slot' AND email = '$heading')";

					$ps = mysqli_query($c, $query14);
					if(!$ps)
				    {
				        die("Failed to retrieve data:" . mysqli_error($c));
				        header("location: userhistory.php");
				        exit();
				    }
				    $reading = mysqli_num_rows($ps);
				}	
			}
			elseif (!empty($field) && !empty($opening))
			{
				if ($group == 'registration')
				{
					$query5 = "SELECT * FROM history WHERE registration = '$field' AND (period = '$opening' AND email = '$heading')";

					$ps = mysqli_query($c, $query5);
					if(!$ps)
				    {
				        die("Failed to retrieve data:" . mysqli_error($c));
				        header("location: userhistory.php");
				        exit();
				    }

				    $reading = mysqli_num_rows($ps);

				}
				elseif ($group == 'fund')
				{
					$query6 = "SELECT * FROM history WHERE expense = '$field' AND (period = '$opening' AND email = '$heading')";

					$ps = mysqli_query($c, $query6);
					if(!$ps)
				    {
				        die("Failed to retrieve data:" . mysqli_error($c));
				        header("location: userhistory.php");
				        exit();
				    }

				    $reading = mysqli_num_rows($ps);
				}
				else
				{
					$query15 = "SELECT * FROM history WHERE period = '$opening' AND email = '$heading'";

					$ps = mysqli_query($c, $query15);
					if(!$ps)
				    {
				        die("Failed to retrieve data:" . mysqli_error($c));
				        header("location: userhistory.php");
				        exit();
				    }

				    $reading = mysqli_num_rows($ps);
				}

			}
			elseif(!empty($field) && !empty($slot))
			{
				if ($group == 'registration')
				{
					$query7 = "SELECT * FROM history WHERE registration = '$field' AND (lapse = '$slot' AND email = '$heading')";

					$ps = mysqli_query($c, $query7);
					if(!$ps)
				    {
				        die("Failed to retrieve data:" . mysqli_error($c));
				        header("location: userhistory.php");
				        exit();
				    }
				    $reading = mysqli_num_rows($ps);

				}
				elseif($group == 'fund')
				{
					$query8 = "SELECT * FROM history WHERE expense = '$field' AND (lapse = '$slot' AND email = '$heading')";

					$ps = mysqli_query($c, $query8);
					if(!$ps)
				    {
				        die("Failed to retrieve data:" . mysqli_error($c));
				        header("location: userhistory.php");
				        exit();
				    }
				    $reading = mysqli_num_rows($ps);
				}
				else
				{
					$query16 = "SELECT * FROM history WHERE lapse = '$slot' AND email = '$heading'";

					$ps = mysqli_query($c, $query16);
					if(!$ps)
				    {
				        die("Failed to retrieve data:" . mysqli_error($c));
				        header("location: userhistory.php");
				        exit();
				    }
				    $reading = mysqli_num_rows($ps);	
				}
			}
			elseif(!empty($opening) && !empty($slot) && $group == 'none')
			{
				$query9 = "SELECT * FROM history WHERE period = '$opening' AND (lapse = '$slot' AND email = '$heading')";

				$ps = mysqli_query($c, $query9);
				if(!$ps)
			    {
			        die("Failed to retrieve data:" . mysqli_error($c));
			        header("location: userhistory.php");
			        exit();
			    }

			    $reading = mysqli_num_rows($ps);

			}
			elseif (!empty($opening) && $group == 'none')
			{
				$query12 = "SELECT * FROM history WHERE period = '$opening' AND email = '$heading'";

				$ps = mysqli_query($c, $query12);
				if(!$ps)
			    {
			        die("Failed to retrieve data:" . mysqli_error($c));
			        header("location: userhistory.php");
			        exit();
			    }
			    $reading = mysqli_num_rows($ps);
			}
			elseif (!empty($slot) && $group == "none")
			{
				$query13 = "SELECT * FROM history WHERE lapse = '$slot' AND email = '$heading'";

				$ps = mysqli_query($c, $query13);
				if(!$ps)
			    {
			        die("Failed to retrieve data:" . mysqli_error($c));
			        header("location: userhistory.php");
			        exit();
			    }
			    $reading = mysqli_num_rows($ps);
			}
			else
			{
				if ($group == 'registration')
				{
					$query10 = "SELECT * FROM history WHERE registration = '$field' AND email = '$heading'";

					$ps = mysqli_query($c, $query10);
					if(!$ps)
				    {
				        die("Failed to retrieve data:" . mysqli_error($c));
				        header("location: userhistory.php");
				        exit();
				    }

				    $reading = mysqli_num_rows($ps);

				}
				elseif ($group == 'fund')
				{
					$query11 = "SELECT * FROM history WHERE expense = '$field' AND email = '$heading'";

					$ps = mysqli_query($c, $query11);
					if(!$ps)
				    {
				        die("Failed to retrieve data:" . mysqli_error($c));
				        header("location: userhistory.php");
				        exit();
				    }

				    $reading = mysqli_num_rows($ps);
				}
				else
				{
					$query17 = "SELECT * FROM history WHERE email = '$heading'";

					$ps = mysqli_query($c, $query17);
					if(!$ps)
				    {
				        die("Failed to retrieve data:" . mysqli_error($c));
				        header("location: userhistory.php");
				        exit();
				    }

				    $reading = mysqli_num_rows($ps);
				}
			}
		}
	}

	mysqli_close($c);
?>
<html>
<head>
	<title>Service History</title>
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
				      <a class="dropdown-item" href="login.php">
						<img src = "unlock.png" alt = "unlock" id = "scale" class = "rounded">
						Login
						</a>
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
			<h1><strong>Service History</strong></h1>
		</div>
		<div>
			<fieldset>
				<form class="form-inline" method = "post" action = "userhistory.php" onsubmit = "return userhistory()">
				  <label>Category:</label>
				  <select name = "group" class = "form-control">
					<option value = "registration">Registration</option>
					<option value = "fund">Cost</option>
					<option value = "none">None</option>
					</select>
					<label>Value:</label>
				  <input type="text" class="form-control" name = "field">
				  <label>Date:</label>
				  <input type="date" class="form-control" name ="opening">
					<label>Time:</label>
				  <input type="time" class="form-control" name ="slot">
				  <button type="submit" class="btn btn-dark" name = "submit">Filter</button>
				</form> 
			</fieldset>
		</div>
		<div>
			<center>
				<fieldset>
					<table id = "primary" class = "table table-active table-hover">
						<thead class = "thead-dark">
							<th id = "log">
								<center>
									<strong>Reference No.:</strong>
								</center>
							</th>
							<th id = "log">
								<center>
									<strong>Registration No.:</strong>
								</center>
							</th>
							<th id = "log">
								<center>
									<strong>Date:</strong>
								</center>
							</th>
							<th id = "log">
							<center>
								<strong>Time:</strong>
							</center>
							</th>
							<th id = "entry">
								<center>
									<strong>Description:</strong>
								</center>
							</th>
							<th id = "log">
								<center>
									<strong>Value:</strong>
								</center>
							</th>
							<th id = "log">
								<center>
									<strong>Payment:</strong>
								</center>
							</th>
						</thead>
						<?php 

							if ($_SERVER['REQUEST_METHOD'] == 'POST')
							{
								if(isset($_POST['submit']))
								{
									if($reading>0)
								    {
										while($rs = mysqli_fetch_assoc($ps))
										{
											$entry = $rs['serialno'];
											$label = $rs['registration'];
											$period = $rs['period'];
											$lapse = $rs['lapse'];
											$report = $rs['description'];
											$quota = $rs['expense'];
											$tender = $rs['charge'];
											$manner = $currency . " " . $quota;


											echo "<tr><td id = 'log'><center>" . $entry . "</center></td><td id = 'log'><center>" . $label . "</center></td><td id = 'log'><center>" . $period . "</center></td><td id = 'log'><center>" . $lapse . "</center></td><td id = 'entry'><center>" . $report . "</center></td><td id = 'log'><center>" . $manner . "</center></td><td id = 'log'><center>" . $tender . "</center></td></tr>";
										}
									}
									else
									{
										$archives = "No Entry Available";
										
										echo "<tr><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'entry'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td></tr>";
									}
								}
							}
							else
							{
								if($reading2>0)
							    {
									while($rs2 = mysqli_fetch_assoc($ps3))
									{
										echo "<tr><td id = 'log'><center>" . $rs2['serialno'] . "</center></td><td id = 'log'><center>" . $rs2['registration'] . "</center></td><td id = 'log'><center>" . $rs2['period'] . "</center></td><td id = 'log'><center>" . $rs2['lapse'] . "</center></td><td id = 'entry'><center>" . $rs2['description'] . "</center></td><td id = 'log'><center>" . $currency . " " . $rs2['expense'] . "</center></td><td id = 'log'><center>" . $rs2['charge'] . "</center></td></tr>";
									}
								}
								else
								{
									$archives = "No Entry Available";
									
									echo "<tr><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'entry'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td></tr>";
								}
							}

						 ?>
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