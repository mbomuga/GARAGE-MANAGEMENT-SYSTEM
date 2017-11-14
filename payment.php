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

    if ($authority == "manager" || $authority == "owner")
	 {
	 	header("location:home.php");
	    exit();
	 }

	 /*Prevents the admin from accessing the page*/

    $futile = "";
    $fiction = "";
    $complete = "";
    $currency = "$";
    $finance = "-";

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$scenario = mysqli_real_escape_string($c, $_POST['scenario']);

		if (isset($_POST['submit']))
		{
			if (!empty($scenario))
			{
				$query4  = "SELECT * FROM history WHERE serialno = '$scenario'  AND email = '$heading'";

				$ps5 = mysqli_query($c, $query4);

				if(!$ps5)
			    {
			        die("Failed to retrieve data:" . mysqli_error($c));
			        header("location: inserthistory.php");
			        exit();
			    }
			    
			    $total = mysqli_num_rows($ps5);
			    			
			}
			else
			{
				header("location: payment.php");
				exit();
			}
		}
	}

	mysqli_close($c);
?>
<html>
<head>
	<title>Payment</title>
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
				    <li class="navbar-brand">
				      <a class="nav-link" href="userprofile.php">
						<img src = "Profile Picture.png" alt = "profilr" id = "scale" class = "rounded">
						Profile</a>
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
					<li class="navbar-brand nav-item active">
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
				<form method = "post" action = "payment.php" onsubmit = "return payment()">
					<div class = "form-group">
						<h1><strong><center>Payment</center></strong></h1>
					</div>
					<div class="form-group">
					    <label>Reference No:</label>
					    <input type="text" class="form-control" name = "scenario" id = "modify">
						<div class = "text-danger">
							<?php echo $futile; ?>
						</div>
						 <button type="submit" id = "remit" class="btn btn-dark" name = "submit">
							Search
						</button>
					</div>
				</form>
				<div>
					<center>
						<fieldset>
							<table id = "frame" class = "table table-active table-hover">
								<thead class = "thead-dark">
									<th id = "default">
									<center>
										<strong>Amount:</strong>
									</center>
									</th>
								</thead>
								<?php 
									if ($_SERVER['REQUEST_METHOD'] == 'POST')
									{
										if (isset($_POST["submit"]))
										{
											if (!empty($scenario))
											{
												if($total != 0)
			    								{
											    	while ($rs4 = mysqli_fetch_assoc($ps5))
			    									{
			    										$instance = $rs4['serialno'];
											    		
											    		$revenue = $rs4['expense'];
											    		$phase = $rs4['charge'];

											    		$fund = $revenue / 103;

											    		$incur = strpos($fund, ".");

											    		$limit = $incur + 3;

											    		$finance = substr($fund, 0, $limit) + 0.01;

														if ($phase != "confirmed")
					    								{
					    									$complete = "*No Outstanding Balance";

					    									echo "<tr><td id = 'default'><center><div class = 'text-danger'>" . $complete .  "</div></center></td></tr>";
					    								}
					    								else
					    								{
					    									$factor = $currency . " " . $finance;

					    									echo "<tr><td id = 'default'><center>" . $factor .  "</center></td></tr>";
					    								}
					    							}
					    						}
					    						else
												{
													$fiction = "*Entry Unavailable";

													echo "<tr><td id = 'default'><center><div class = 'text-danger'>" . $fiction .  "</div></center></td></tr>";
												}
											}
										}
									}
									else
									{
										echo "<tr><td id = 'default'><center>" . $finance .  "</center></td></tr>";
									}
								 ?>
								 </table>
							</fieldset>
						</center>
					</div>
			</fieldset>
		</center>
	</div>
	<div>
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