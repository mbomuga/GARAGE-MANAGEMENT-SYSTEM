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

    if ($authority == "admin")
	 {
	 	header("location:home.php");
	    exit();
	 }

	 /*Prevents the admin from accessing the page*/

    $futile = "";
    $success = "";
    $fiction = "";

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$scenario = mysqli_real_escape_string($c, $_POST['scenario']);

		if (isset($_POST['submit']))
		{
			if (!empty($scenario))
			{
				$query4  = "SELECT * FROM history WHERE serialno = '$scenario'";

				$ps5 = mysqli_query($c, $query4);

				if(!$ps5)
			    {
			        die("Failed to retrieve data:" . mysqli_error($c));
			        header("location: inserthistory.php");
			        exit();
			    }

			    $instance = $rs4['serialno'];
			    
			    $total = mysqli_num_rows($ps5);

			    if($total != 0)
			    {
			    	while ($rs4 = mysqli_fetch_assoc($ps5))
			    	{
			    		$revenue = $rs4['expense'];
			    		$phase = $rs4['charge'];

			    		if ($phase != "confirmed")
			    		{
			    			/* Perform call to Paypal at this point. Use the variable '$revenue' as the amount */

			    			$state = "";

			    			/* The variable '$state' and the subsequent block is a templete to execute the Transaction is sucessful. You'll perfoem the neccessary modifications on your side */

			    			if($state == "successful")
			    			{
			    				$query5 = "UPDATE history SET charge = 'confirmed' WHERE serialno = '$scenario'";
								$ps6 = mysqli_query($c, $query5);

								if(!$ps6)
							    {
							        die("Failed to update data:" . mysqli_error($c));
							        header("location: updatehistory.php");
							        exit();
							    }
							    else
							    {
							    	header("location: history.php");
							    	exit();
							    }
			    			}
			    			else
			    			{
			    				$futile = "Transaction Failed";
			    				exit();
			    			}
			    		}
			    		else
			    		{
			    			$success = "Payment Complete";
			    		}
			    	}
			    }
			    else
			    {
			    	$fiction = "Entry Unavailable";
			    }
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
					<li class="navbar-brand">
				      <a class="nav-link" href="schedule.php">
						<img src = "schedule icon.png" alt = "schedule" id = "scale">
						Schedule
						</a>
				    </li>
					<li class="navbar-brand nav-item active">
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
				<form method = "post" action = "payment.php" onsubmit = "return payment()">
					<div class = "form-group">
						<h1><strong><center>Payment</center></strong></h1>
					</div>
					<div class="form-group">
				    <label>Reference No:</label>
				    <input type="text" class="form-control" name = "scenario" id = "modify">
					<?php echo $futile; ?>
					<?php echo $success; ?>
					<?php echo $fiction; ?>
				  <button type="submit" class="btn btn-primary" name = "submit">Transact</button>
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