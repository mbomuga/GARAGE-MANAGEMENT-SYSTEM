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

    $entry = "";
	$label = "";
	$period = "";
	$lapse = "";
	$report = "";
	$quota = "";
	$tender = "";
	$title = "";
	$tag = "";
    $archives = "";

     if ($authority != "admin")
     {
     	header("location:home.php");
        exit();
     }
	
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
	 	$key = mysqli_real_escape_string($c, $_POST['key']);
	 	$direction = mysqli_real_escape_string($c, $_POST['direction']);

	 	if (isset($_POST['submit']))
		{
			if(!empty($key) && !empty($direction))
			{				
				$query2 = "SELECT * FROM history WHERE email = '$direction' AND registration = '$key'";

				$ps3 = mysqli_query($c, $query2);
				if(!$ps3)
			    {
			        die("Failed to retrieve data:" . mysqli_error($c));
			        header("location: viewschedule.php");
			        exit();
			    }

			    $reading2 = mysqli_num_rows($ps3);
			}
		}
	}

	mysqli_close($c);
?>
<html>
<head>
	<title>Vehicle History</title>
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
			<h1><strong>Vehicle History</strong></h1>
		</div>
		<div>
			<center>
				<fieldset>
					<table id = "primary" class = "table table-active table-hover">
						<thead class = "thead-dark">
							<th id = "field">
								<center>
									<strong>Reference No.</strong>
								</center>
							</th>
							<th id = "field">
								<center>
									<strong>Registration:</strong>
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
									if($reading2>0)
								    {
										while($rs2 = mysqli_fetch_assoc($ps3))
										{
											$entry = $rs2['serialno'];
											$label = $rs2['registration'];
											$period = $rs2['period'];
											$lapse = $rs2['lapse'];
											$report = $rs2['description'];
											$quota = $rs2['expense'];
											$tender = $rs2['charge'];
											$title = $rs2['username'];
											$tag = $rs2['email'];

											echo "<tr><td id = 'log'><center>" . $entry . "</center></td><td id = 'log'><center>" . $label . "</center></td><td id = 'log'><center>" . $period . "</center></td><td id = 'log'><center>" . $lapse . "</center></td><td id = 'narrative'><center>" . $report . "</center></td><td id = 'log'><center>" . $quota . "</center></td><td id = 'log'><center>" . $tender . "</center></td><td id = 'log'><center>" . $title . "</center></td><td id = 'log'><center>" . $archives . $tag . "</center></td></tr>";
										}
									}
									else
									{
										$archives = "No Entry Available";
										
										echo "<tr><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'narrative'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td></tr>";
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