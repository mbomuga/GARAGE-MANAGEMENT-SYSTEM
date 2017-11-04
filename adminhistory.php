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

    $archives = "";
    $currency = "Ksh";

     if ($authority != "admin")
     {
     	header("location:home.php");
        exit();
     }
	
	$query2 = "SELECT * FROM history";

	$ps3 = mysqli_query($c, $query2);
	if(!$ps3)
    {
        die("Failed to retrieve data:" . mysqli_error($c));
        header("location: adminhistory.php");
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
					$query3 = "SELECT * FROM history WHERE registration = '$field' AND (period = '$opening' AND lapse = '$slot')";

					$ps = mysqli_query($c, $query3);
					if(!$ps)
				    {
				        die("Failed to retrieve data:" . mysqli_error($c));
				        header("location: adminhistory.php");
				        exit();
				    }

				    $reading = mysqli_num_rows($ps);

				}
				elseif ($group == 'value')
				{
					$query4 = "SELECT * FROM history WHERE expense = '$field' AND (period = '$opening' AND lapse = '$slot')";

					$ps = mysqli_query($c, $query4);
					if(!$ps)
				    {
				        die("Failed to retrieve data:" . mysqli_error($c));
				        header("location: adminhistory.php");
				        exit();
				    }
				    $reading = mysqli_num_rows($ps);

				}
				elseif ($group == "username")
				{
					$query19 = "SELECT * FROM history WHERE username = '$field' AND (period = '$opening' AND lapse = '$slot')";

					$ps = mysqli_query($c, $query19);
					if(!$ps)
				    {
				        die("Failed to retrieve data:" . mysqli_error($c));
				        header("location: adminhistory.php");
				        exit();
				    }
				    $reading = mysqli_num_rows($ps);

				}
				else
				{
					$query20 = "SELECT * FROM history WHERE email = '$field' AND (period = '$opening' AND lapse = '$slot')";

					$ps = mysqli_query($c, $query20);
					if(!$ps)
				    {
				        die("Failed to retrieve data:" . mysqli_error($c));
				        header("location: adminhistory.php");
				        exit();
				    }
				    $reading = mysqli_num_rows($ps);

				}	
			}
			elseif (!empty($field) && !empty($opening))
			{
				if ($group == 'registration')
				{
					$query5 = "SELECT * FROM history WHERE registration = '$field' AND period = '$opening'";

					$ps = mysqli_query($c, $query5);
					if(!$ps)
				    {
				        die("Failed to retrieve data:" . mysqli_error($c));
				        header("location: adminhistory.php");
				        exit();
				    }
				    $reading = mysqli_num_rows($ps);

				}
				elseif($expense == 'value')
				{
					$query6 = "SELECT * FROM history WHERE expense = '$field' AND period = '$opening'";

					$ps = mysqli_query($c, $query6);
					if(!$ps)
				    {
				        die("Failed to retrieve data:" . mysqli_error($c));
				        header("location: adminhistory.php");
				        exit();
				    }
				    $reading = mysqli_num_rows($ps);

				}
				elseif ($group == "username")
				{
					$query14 = "SELECT * FROM history WHERE username = '$field' AND period = '$opening'";

					$ps = mysqli_query($c, $query14);
					if(!$ps)
				    {
				        die("Failed to retrieve data:" . mysqli_error($c));
				        header("location: adminhistory.php");
				        exit();
				    }
				    $reading = mysqli_num_rows($ps);

				}
				else
				{
					$query21 = "SELECT * FROM history WHERE email = '$field' AND period = '$opening'";

					$ps = mysqli_query($c, $query21);
					if(!$ps)
				    {
				        die("Failed to retrieve data:" . mysqli_error($c));
				        header("location: adminhistory.php");
				        exit();
				    }
				    $reading = mysqli_num_rows($ps);
				}
			}
			elseif(!empty($field) && !empty($slot))
			{
				if ($group == 'registration')
				{
					$query7 = "SELECT * FROM history WHERE registration = '$field' AND lapse = '$slot'";

					$ps = mysqli_query($c, $query7);
					if(!$ps)
				    {
				        die("Failed to retrieve data:" . mysqli_error($c));
				        header("location: adminhistory.php");
				        exit();
				    }
				    $reading = mysqli_num_rows($ps);
				}
				elseif ($group == 'value')
				{
					$query8 = "SELECT * FROM history WHERE expense = '$field' AND lapse = '$slot'";

					$ps = mysqli_query($c, $query8);
					if(!$ps)
				    {
				        die("Failed to retrieve data:" . mysqli_error($c));
				        header("location: adminhistory.php");
				        exit();
				    }
				    $reading = mysqli_num_rows($ps);
				}
				elseif ($group == "username")
				{
					$query15 = "SELECT * FROM history WHERE username = '$field' AND lapse = '$slot'";

					$ps = mysqli_query($c, $query15);
					if(!$ps)
				    {
				        die("Failed to retrieve data:" . mysqli_error($c));
				        header("location: adminhistory.php");
				        exit();
				    }
				    $reading = mysqli_num_rows($ps);
				}
				else
				{
					$query22 = "SELECT * FROM history WHERE email = '$field' AND lapse = '$slot'";

					$ps = mysqli_query($c, $query22);
					if(!$ps)
				    {
				        die("Failed to retrieve data:" . mysqli_error($c));
				        header("location: adminhistory.php");
				        exit();
				    }
				    $reading = mysqli_num_rows($ps);
				}
			}
			elseif(!empty($opening) && !empty($slot))
			{
				$query9 = "SELECT * FROM history WHERE period = '$opening' AND lapse = '$slot'";

				$ps = mysqli_query($c, $query9);
				if(!$ps)
			    {
			        die("Failed to retrieve data:" . mysqli_error($c));
			        header("location: adminhistory.php");
			        exit();
			    }
			    $reading = mysqli_num_rows($ps);
			}
			elseif (!empty($group))
			{
				if ($group == 'registration')
				{
					$query10 = "SELECT * FROM history WHERE registration = '$field'";

					$ps = mysqli_query($c, $query10);
					if(!$ps)
				    {
				        die("Failed to retrieve data:" . mysqli_error($c));
				        header("location: adminhistory.php");
				        exit();
				    }
				    $reading = mysqli_num_rows($ps);
				}
				elseif($group == 'value')
				{
					$query11 = "SELECT * FROM history WHERE expense = '$field'";

					$ps = mysqli_query($c, $query11);
					if(!$ps)
				    {
				        die("Failed to retrieve data:" . mysqli_error($c));
				        header("location: adminhistory.php");
				        exit();
				    }
				    $reading = mysqli_num_rows($ps);
				}
				elseif ($group == "username")
				{
					$query13 = "SELECT * FROM history WHERE username = '$field'";

					$ps = mysqli_query($c, $query13);
					if(!$ps)
				    {
				        die("Failed to retrieve data:" . mysqli_error($c));
				        header("location: adminhistory.php");
				        exit();
				    }
				    $reading = mysqli_num_rows($ps);
				}
				else
				{
					$query23 = "SELECT * FROM history WHERE email = '$field'";

					$ps = mysqli_query($c, $query23);
					if(!$ps)
				    {
				        die("Failed to retrieve data:" . mysqli_error($c));
				        header("location: adminhistory.php");
				        exit();
				    }
				    $reading = mysqli_num_rows($ps);
				}
			}
			elseif (!empty($opening))
			{
				$query12 = "SELECT * FROM history WHERE period = '$opening'";

				$ps = mysqli_query($c, $query12);
				if(!$ps)
			    {
			        die("Failed to retrieve data:" . mysqli_error($c));
			        header("location: adminhistory.php");
			        exit();
			    }
			    $reading = mysqli_num_rows($ps);
			}
			else
			{
				$query17 = "SELECT * FROM history WHERE lapse = '$slot'";

				$ps = mysqli_query($c, $query17);
				if(!$ps)
			    {
			        die("Failed to retrieve data:" . mysqli_error($c));
			        header("location: adminhistory.php");
			        exit();
			    }
			    $reading = mysqli_num_rows($ps);
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
				    <li class="nav-item">
				    <a class="nav-link" href="home.php">
						<img src = "home.png" alt = "home" id = "scale">
						Home
					</a>
				    </li>
				    <li class="nav-item">
				      <a class="nav-link" href="profile.php">
						<img src = "Profile Picture.png" alt = "profile" id = "scale">
						Profile
						</a>
				    </li>
				    <li class="nav-item">
				      <a class="nav-link" href="vehicles.php">
						<img src = "vehicle icon.png" alt = "vehicle" id = "scale">
						Vehicles</a>
				    </li>
					<li class="nav-item">
				      <a class="nav-link" href="notifications.php">
						<img src = "notifications.png" alt = "notification" id = "scale">
						Notifications
						</a>
				    </li>
					<li class="nav-item">
				      <a class="nav-link" href="schedule.php">
						<img src = "schedule icon.png" alt = "schedule" id = "scale">
						Schedule
						</a>
				    </li>
					<li class="nav-item">
				      <a class="nav-link" href="payment.php">
						<img src = "payment icon.png" alt = "payment" id = "scale">
						Payment</a>
				    </li>
					<li class="nav-item">
				      <a class="nav-link" href="history.php">
						<img src = "history icon.png" alt = "history" id = "scale">
						Service History</a>
				    </li>
				  </ul>
				</nav>
			</center>			
		</div>
		<div id = "reverse">
			<fieldset>
				<table id = "primary">
					<tr>
						<td id = "default">
							<center>
								<a href="edithistory.php" target = "_self">
									<img src = "edit icon.png" alt = "edit icon" id = "scale">
									Edit
								</a>
							</center>
						</td>
					</tr>
				</table>
			</fieldset>
		</div>
		<div>
			<h1><strong>Service History</strong></h1>
		</div>
		<div>
			<fieldset>
				<form class="form-inline" method = "post" action = "adminhistory.php" onsubmit = "return adminhistory()">
				  <label>Category:</label>
				  <select name = "group" class = "form-control">
					<option value = "registration">Registration</option>
					<option value = "value">Cost</option>
					<option value = "username">Username</option>
					<option value = "email">Email</option>
					</select>
					<label>Value:</label>
				  <input type="text" class="form-control" name = "field">
				  <label>Date:</label>
				  <input type="date" class="form-control" name ="opening">
					<label>Time:</label>
				  <input type="time" class="form-control" name ="slot">
				  <button type="submit" class="btn btn-primary" name = "submit">Filter</button>
				</form> 
			</fieldset>
		</div>
		<div>
			<center>
				<fieldset>
					<table id = "primary" class = "table table-active table-hover">
						<thead class = "thead-dark">
							<th id = "field">
								<center>
									<strong>Reference No.:</strong>
								</center>
							</th>
							<th id = "field">
								<center>
									<strong>Registration No.:</strong>
								</center>
							</th>
							<th id = "field">
								<center>
									<strong>Date:</strong>
								</center>
							</th>
							<th id = "field">
							<center>
								<strong>Time:</strong>
							</center>
							</th>
							<th id = "narrative">
								<center>
									<strong>Description:</strong>
								</center>
							</th>
							<th id = "field">
								<center>
									<strong>Value:</strong>
								</center>
							</th>
							<th id = "field">
								<center>
									<strong>Payment:</strong>
								</center>
							</th>
							<th id = "field">
								<center>
									<strong>Name:</strong>
								</center>
							</th>
							<th id = "field">
								<center>
									<strong>Email Address:</strong>
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
											$title = $rs['username'];
											$tag = $rs['email'];
											$manner = $currency . " " . $quota;

											echo "<tr><td id = 'log'><center>" . $entry . "</center></td><td id = 'log'><center>" . $label . "</center></td><td id = 'log'><center>" . $period . "</center></td><td id = 'log'><center>" . $lapse . "</center></td><td id = 'narrative'><center>" . $report . "</center></td><td id = 'log'><center>" . $manner . "</center></td><td id = 'log'><center>" . $tender . "</center></td><td id = 'log'><center>" . $title . "</center></td><td id = 'log'><center>" . $archives . $tag . "</center></td></tr>";
										}
									}
									else
									{
										$archives = "No Entry Available";
										
										echo "<tr><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'narrative'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td></tr>";
									}
								}
							}
							else
							{
								if($reading2>0)
							    {
									while($rs2 = mysqli_fetch_assoc($ps3))
									{
										echo "<tr><td id = 'log'><center>" . $rs2['serialno'] . "</center></td><td id = 'log'><center>" . $rs2['registration'] . "</center></td><td id = 'log'><center>" . $rs2['period'] . "</center></td><td id = 'log'><center>" . $rs2['lapse'] . "</center></td><td id = 'narrative'><center>" . $rs2['description'] . "</center></td><td id = 'log'><center>" . $currency . " " . $rs2['expense'] . "</center></td><td id = 'log'><center>" . $rs2['charge'] . "</center></td><td id = 'log'><center>" . $rs2['username'] . "</center></td><td id = 'log'><center>" . $rs2['email'] . "</center></td></tr>";
									}
								}
								else
								{
									$archives = "No Entry Available";
										
									echo "<tr><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'narrative'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td></tr>";
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