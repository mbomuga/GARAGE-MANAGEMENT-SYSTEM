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

    $fiction = "";

     if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$label = mysqli_real_escape_string($c, $_POST['label']);
		$direction = mysqli_real_escape_string($c, $_POST['direction']);

		if (isset($_POST['submit']))
		{
			$query4 =  "SELECT * FROM accounts WHERE email = '$direction'";
		   	$ps4 = mysqli_query($c, $query4);

		    if(!$ps4)
		    {
		        die("Failed to retrieve data:" . mysqli_error($c));
		        header("location: login.php");
		        exit();
		    }

		    $reading = mysqli_num_rows($ps4);

		    if($reading>0)
		    {
		    	while ($rs4 = mysqli_fetch_assoc($ps4))
		    	{
					if(!empty($label))
					{
						$query3 = "DELETE FROM vehicles WHERE registration = '$label' AND email = '$direction'";
						$ps3 = mysqli_query($c, $query3);

						if(!$ps3)
					    {
					        die("Failed to delete data:" . mysqli_error($c));
					        header("location: deletevehicles.php");
					        exit();
					    }
					    else
					    {
					    	$query5 = "SELECT * FROM notifications";

							$ps5 = mysqli_query($c, $query5);
							if(!$ps5)
						    {
						        die("Failed to retrieve data:" . mysqli_error($c));
						        header("location: userinsert.php");
						        exit();
						    }
						    $iteration = mysqli_num_rows($ps5);

						    if($iteration == 0)
						    {
						    	$source = 1;
						    }
						    else
						    {
						    	$source = $iteration + 1;
						    }

						    $query12 = "SELECT * FROM notifications WHERE serialno = '$source'";

							$ps13 = mysqli_query($c, $query12);
							if(!$ps13)
						    {
						        die("Failed to retrieve data:" . mysqli_error($c));
						        header("location: userinsert.php");
						        exit();
						    }
						    $valid = mysqli_num_rows($ps13);

						    if($valid != 0)
						    {
						    	while ($rs13 = mysqli_fetch_assoc($ps13))
						    	{
						    		$source = $rs13['serialno'] + 1;
						    	}
						    }

						    $query6  = "SELECT * FROM accounts WHERE email = '$direction'";

							$ps6 = mysqli_query($c, $query6);

							if(!$ps6)
						    {
						        die("Failed to retrieve data:" . mysqli_error($c));
						        header("location: insertnotifications.php");
						        exit();
						    }
						    
						    $reading = mysqli_num_rows($ps6);

						    if($reading != 0)
						    {
						    	while ($rs6 = mysqli_fetch_assoc($ps6))
						    	{
							    	$directory = $rs6['first'];
							    	$surname = $rs6['last'];
							    	$beacon = $rs6['email'];
							    	$contact = $rs6['phone'];

							    	$designate = $directory . " " . $surname;
							    }

								$query7 = "INSERT INTO `notifications` (`serialno`,`reminder`, `category`, `priority`, `username`, `phone`, `email`) VALUES ('$source','Vehicle Deleted', 'vehicle', 'high', '$designate', '$contact' ,'$beacon')";
										
								$ps7 = mysqli_query($c, $query7);

								if(!$ps7)
								{
									die("Failed to insert data:" . mysqli_error($c));
									header("location: userinsert.php");
									exit();
								}
							}

				    	header("location: vehicles.php");
				        exit();
				    	}
					}
					else
					{	
						header("location: deletevehicles.php");
					    exit();
					}
				}
			}
			else
			{
				$fiction = "*User Does Not Exist";
			}
		}
	}

	mysqli_close($c);
?>
<html>
<head>
	<title>Delete Vehicle</title>
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
	          <img src = "id icon.png" alt = "Login" id = "scale">            
	          <strong><?php echo $identity; ?></strong>
	          </a>
	          <div class="dropdown-menu">
	              <a class="dropdown-item" href="logout.php">
	            <img src = "lock.png" alt = "lock" id = "scale">
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
				    <li class="navbar-brand nav-item active">
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
		<div>
			<center>
			<fieldset id = "drape">
			<form name = "admindelete" method = "post" action = "admindelete.php" onsubmit = "return(admindelete());">
			<div class = "form-group">
				<h1><strong><center>Delete Vehicle</center></strong></h1>
			</div>
			<div class="form-group">
		    <label>Vehicle Registration:</label>
		    <input type="text" class="form-control" name = "label" id = "modify">
		  </div>
			<div class="form-group">
			    <label>Email Address:</label>
			    <input type="text" class="form-control" name = "direction" id = "modify">
				<div class = "text-danger">
					<?php echo $fiction; ?>
				</div>
			  </div>
			<button type="submit" class="btn btn-dark" name = "submit">Delete</button>
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