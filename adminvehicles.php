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

     if ($authority != "admin")
     {
     	header("location:home.php");
        exit();
     }

	$query3 = "SELECT * FROM vehicles";

	$ps4 = mysqli_query($c, $query3);
	if(!$ps4)
    {
        die("Failed to retrieve data:" . mysqli_error($c));
        header("location: viewvehicles.php");
        exit();
    }

    $reading3 = mysqli_num_rows($ps4);

	mysqli_close($c);
?>
<html>
<head>
	<title>Vehicles</title>
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
						Service History
					</a>
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
								<a href="editvehicles.php" target = "_self">
									<center>
										<img src = "edit icon.png" alt = "edit icon" id = "scale">
										Edit
									</center>
								</a>
							</center>
						</td>
					</tr>
				</table>
			</fieldset>
		</div>
		<div>
			<h1><strong>Vehicles</strong></h1>
		</div>
		<div>
			<center>
				<fieldset>
					<table id = "primary" class = "table table-active table-hover">
						<thead class = "thead-dark">
							<th id = "default">
							<center>
								<strong>Vehicle Registration</strong>
							</center>
							</th>
							<th id = "default">
								<center>
									<strong>Model:</strong>
								</center>
							</th>
							<th id = "default">
								<center>
									<strong>Year of Manufacture:</strong>
								</center>
							</th>
							<th id = "default">
								<center>
									<strong>Name:</strong>
								</center>
							</th>
							<th id = "default">
								<center>
									<strong>Email Address:</strong>
								</center>
							</th>
						</thead>
						<?php 
							if($reading3>0)
						    {
								while($rs3 = mysqli_fetch_assoc($ps4))
								{
									$label = $rs3['registration'];
									$type = $rs3['model'];
									$duration = $rs3['year'];
									$title = $rs3['username'];
									$tag = $rs3['email'];

									echo "<tr><td id = 'default'><center>" . $label . "</center></td><td id = 'default'><center>" . $type . "</center></td><td id = 'default'><center>" . $duration . "</center></td><td id = 'default'><center>" . $title . "</center></td><td id = 'default'><center>" . $tag . "</center></td></tr>";
								}
							}
							else
							{
								$archives = "No Entries Available";

								echo "<tr><td id = 'default'><center>" . $archives . "</center></td><td id = 'default'><center>" . $archives . "</center></td><td id = 'default'><center>" . $archives . "</center></td><td id = 'default'><center>" . $archives . "</center></td><td id = 'default'><center>" . $archives . "</center></td></tr>";
							}
						 ?>
					</table>
				</fieldset>
			</center>
		</div>
		<div>
			<center>
				<fieldset id = "position">
					<form method = "post" action = "adminsearch.php" onsubmit = "return searchadmin()">
						<div class = "form-group">
							<h2><strong><center>Vehicle History</center></strong></h2>
						</div>
						<div class="form-group">
					    <label>Vehicle Registration:</label>
					    <input type="text" class="form-control" name = "key" id = "dimensions">
					  </div>
					  <div class="form-group">
					    <label>Email Address:</label>
					    <input type="text" class="form-control" name = "direction" id = "dimensions">
					  </div>
					<button type="submit" class="btn btn-primary" name = "submit">Search History</button>
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