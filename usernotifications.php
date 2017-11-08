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

    $archives = "";

    if ($authority == "manager" || $authority == "owner")
	{
		header("location:home.php");
		exit();
	}
    
	$query2 = "SELECT * FROM notifications WHERE email = '$heading' AND NOT category = 'vehicle'";

	$ps3 = mysqli_query($c, $query2);
	if(!$ps3)
    {
        die("Failed to retrieve data:" . mysqli_error($c));
        header("location: notifications.php");
        exit();
    }
    $reading2 = mysqli_num_rows($ps3);

	mysqli_close($c);
?>
<html>
<head>
	<title>Notifications</title>
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
					<li class="navbar-brand nav-item active">
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
			<h1><strong>Notifications</strong></h1>
		</div>
		<div>
			<center>
				<fieldset>
					<table id = "primary" class = "table table-active table-hover">
						<thead class = "thead-dark">
							<th id = "default">
							<center>
								<strong>Reminder:</strong>
							</center>
							</th>
							<th id = "default">
							<center>
								<strong>Category:</strong>
							</center>
							</th>
							<th id = "default">
								<center>
									<strong>Priority:</strong>
								</center>
							</th>
						</thead>
						<?php 
							
							if($reading2>0)
						    {
								while($rs2 = mysqli_fetch_assoc($ps3))
								{
									$reference = $rs2['reminder'];
									$nature = $rs2['category'];
									$entry = $rs2['priority'];

									echo "<tr><td id = 'default'><center>" . $reference . "</center></td><td id = 'default'><center>" . $nature . "</center></td><td id = 'default'><center>" . $entry . "</center></td></tr>";
								}
							}
							else
							{
								$archives = "No Entry Available";
								
								echo "<tr><td id = 'default'><center>" . $archives . "</center></td><td id = 'default'><center>" . $archives . "</center></td><td id = 'default'><center>" . $archives . "</center></td></tr>";
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