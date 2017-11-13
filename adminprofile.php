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

     if ($authority == "manager" || $authority != "owner")
     {
     	header("location:home.php");
        exit();
     }

    $archives = "";

   $query2 = "SELECT * FROM accounts";

   $ps2 = mysqli_query($c, $query2);
 	
 	if(!$ps2)
 	{
 		die("Failed to retrieve data:" . mysqli_error($c));
    	header("location: login.php");
    	exit();
 	}

   	$reading2 = mysqli_num_rows($ps2);

   	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$decision = mysqli_real_escape_string($c, $_POST['decision']);
		$prefix = mysqli_real_escape_string($c, $_POST['prefix']);
		$index = mysqli_real_escape_string($c, $_POST['index']);
		$privilege = mysqli_real_escape_string($c, $_POST['privilege']);

		if (isset($_POST['submit']))
		{
			if(!empty($index))
			{
				if($decision == "first" && $privilege != "none")
				{
					$query3 = "SELECT * FROM accounts WHERE first = '$index' AND usertype = '$privilege'";

					$ps = mysqli_query($c, $query3);
 	
				 	if(!$ps)
				 	{
				 		die("Failed to retrieve data:" . mysqli_error($c));
				    	header("location: login.php");
				    	exit();
				 	}

				 	$reading = mysqli_num_rows($ps);
				}
				elseif ($decision == "last" && $privilege != "none")
				{
					$query4 = "SELECT * FROM accounts WHERE last = '$index' AND usertype = '$privilege'";

					$ps = mysqli_query($c, $query4);
 	
				 	if(!$ps)
				 	{
				 		die("Failed to retrieve data:" . mysqli_error($c));
				    	header("location: login.php");
				    	exit();
				 	}

				 	$reading = mysqli_num_rows($ps);
				}
				elseif ($decision == "email" && $privilege != "none")
				{
					$query5 = "SELECT * FROM accounts WHERE email = '$index' AND usertype = '$privilege'";

					$ps = mysqli_query($c, $query5);
 	
				 	if(!$ps)
				 	{
				 		die("Failed to retrieve data:" . mysqli_error($c));
				    	header("location: login.php");
				    	exit();
				 	}

				 	$reading = mysqli_num_rows($ps);
				}
				elseif ($decision == "phone" && $privilege != "none")
				{
					$dial = ltrim($index, "0");

					$call = $prefix . $dial;

					$query6 = "SELECT * FROM accounts WHERE phone = '$call' AND usertype = '$privilege'";

					$ps = mysqli_query($c, $query6);
 	
				 	if(!$ps)
				 	{
				 		die("Failed to retrieve data:" . mysqli_error($c));
				    	header("location: login.php");
				    	exit();
				 	}

				 	$reading = mysqli_num_rows($ps);
				}
				elseif ($decision == "none" && $privilege != "none")
				{
					$query7 = "SELECT * FROM accounts WHERE usertype = '$privilege'";

					$ps = mysqli_query($c, $query7);
 	
				 	if(!$ps)
				 	{
				 		die("Failed to retrieve data:" . mysqli_error($c));
				    	header("location: login.php");
				    	exit();
				 	}

				 	$reading = mysqli_num_rows($ps);
				}
				elseif ($decision == "first" && $privilege == "none")
				{
					$query8 = "SELECT * FROM accounts WHERE first = '$index'";

					$ps = mysqli_query($c, $query8);
 	
				 	if(!$ps)
				 	{
				 		die("Failed to retrieve data:" . mysqli_error($c));
				    	header("location: login.php");
				    	exit();
				 	}

				 	$reading = mysqli_num_rows($ps);
				}
				elseif ($decision == "last" && $privilege == "none")
				{
					$query9 = "SELECT * FROM accounts WHERE last = '$index'";

					$ps = mysqli_query($c, $query9);
 	
				 	if(!$ps)
				 	{
				 		die("Failed to retrieve data:" . mysqli_error($c));
				    	header("location: login.php");
				    	exit();
				 	}

				 	$reading = mysqli_num_rows($ps);
				}
				elseif ($decision == "email" && $privilege == "none")
				{
					$query10 = "SELECT * FROM accounts WHERE email = '$index'";

					$ps = mysqli_query($c, $query10);
 	
				 	if(!$ps)
				 	{
				 		die("Failed to retrieve data:" . mysqli_error($c));
				    	header("location: login.php");
				    	exit();
				 	}

				 	$reading = mysqli_num_rows($ps);
				}
				elseif ($decision == "phone" && $privilege == "none")
				{
					$dial = ltrim($index, "0");

					$call = $prefix . $dial;

					$query11 = "SELECT * FROM accounts WHERE phone = '$call'";

					$ps = mysqli_query($c, $query11);
 	
				 	if(!$ps)
				 	{
				 		die("Failed to retrieve data:" . mysqli_error($c));
				    	header("location: login.php");
				    	exit();
				 	}

				 	$reading = mysqli_num_rows($ps);
				}
				else
				{
					header("location: adminprofile.php");
    				exit();
				}
			}
			else
			{
				header("location: adminprofile.php");
    			exit();
			}
		}
	}

	mysqli_close($c);
?>
<html>
<head>
	<title>Profile</title>
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
				    <li class="nav-item dropdown navbar-brand nav-item active">
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
			<h1><strong>User List</strong></h1>
		</div>
		<div>
			<fieldset>
				<form class="form-inline" method = "post" action = "adminprofile.php" onsubmit = "return adminhistory()">
				  <label>Category:</label>
				  <select name = "decision" class = "form-control">
					<option value = "first">First Name</option>
					<option value = "last">Last name</option>
					<option value = "email">Email Address</option>
					<option value = "phone">Phone Number</option>
					<option value = "none">None</option>
					</select>
					<label>Prefix:</label>
				     <select name = "prefix" class = "form-control">
					<option value = "+254">+254</option>
					<option value = "+255">+255</option>
					<option value = "+256">+256</option>
					<option value = "+1">+1</option>
					<option value = "+44">+44</option>
					</select>
					<label>Keyword:</label>
				   <input type="text" class="form-control" name = "index">
					<label>Access Level:</label>
					<select name = "privilege" class = "form-control">
					<option value = "regular">Regular</option>
					<option value = "manager">Manager</option>
					<option value = "owner">Owner</option>
					<option value = "none">None</option>
					</select>
				  <button type="submit" class="btn btn-dark" name = "submit">Filter</button>
				</form> 
			</fieldset>
		</div>
		<div>
			<center>
				<fieldset>
					<table id = "primary" class = "table table-active table-hover">
						<thead class = "thead-dark">
							<th id = "default">
								<center>
									<strong>First Name:</strong>
								</center>
							</th>
							<th id = "default">
								<center>
									<strong>Last Name:</strong>
								</center>
							</th>
							<th id = "default">
							<center>
								<strong>Email Address:</strong>
							</center>
							</th>
							<th id = "default">
								<center>
									<strong>Phone Number:</strong>
								</center>
							</th>
							<th id = "default">
								<center>
									<strong>Access Level:</strong>
								</center>
							</th>
						</thead>
						<?php 
							if ($_SERVER['REQUEST_METHOD'] == 'POST')
							{
								if (isset($_POST['submit']))
								{
									if($reading>0)
								    {
									   	while($rs = mysqli_fetch_assoc($ps))
										{
										    $designate = $rs['first'];
											$surname =  $rs['last'];
											$key = $rs['email'];
											$contact = $rs['phone'];
											$access = $rs['usertype'];

											echo "<tr><td id = 'default'><center>" . $designate . "</center></td><td id = 'default'><center>" . $surname . "</center></td><td id = 'default'><center>" . $key . "</center></td><td id = 'default'><center>" . $contact . "</center></td><td id = 'default'><center>" . $access . "</center></td></tr>";
										}
									}
									else
									{
										$archives = "No Entry Available";

										echo "<tr><td id = 'default'><center>" . $archives . "</center></td><td id = 'default'><center>" . $archives . "</center></td><td id = 'default'><center>" . $archives . "</center></td><td id = 'default'><center>" . $archives . "</center></td><td id = 'default'><center>" . $archives . "</center></td></tr>";
									}
								}
							}
							else
							{
								if($reading2>0)
								{
									while($rs2 = mysqli_fetch_assoc($ps2))
									{
										echo "<tr><td id = 'default'><center>" . $rs2['first'] . "</center></td><td id = 'default'><center>" . $rs2['last'] . "</center></td><td id = 'default'><center>" . $rs2['email'] . "</center></td><td id = 'default'><center>" . $rs2['phone'] . "</center></td><td id = 'default'><center>" . $rs2['usertype'] . "</center></td></tr>";
									}
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