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

     if ($authority != "manager")
     {
     	header("location:home.php");
        exit();
     }

     $invalid = "";
     $absent = "";
     $disconnect = "";

     if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$report = mysqli_real_escape_string($c, $_POST['report']);
		$direction = mysqli_real_escape_string($c, $_POST['direction']);

		if (isset($_POST['submit']))
		{

			if(!empty($direction) && !empty($report))
			{
				$query4 = "SELECT * FROM notifications WHERE reminder = '$report' AND email = '$direction'";

				$ps4 = mysqli_query($c, $query4);
				if(!$ps4)
			    {
			        die("Failed to retrieve data:" . mysqli_error($c));
			        header("location: notifications.php");
			        exit();
			    }

			    $record = mysqli_num_rows($ps4);

			    if ($record != 0)
			    {
					$query5 = "SELECT * FROM notifications WHERE reminder = '$report'";

					$ps5 = mysqli_query($c, $query4);
					if(!$ps5)
				    {
				        die("Failed to retrieve data:" . mysqli_error($c));
				        header("location: notifications.php");
				        exit();
				    }

				    $reading = mysqli_num_rows($ps5);

				    if ($reading != 0)
				    {
				     	while($rs5 = mysqli_fetch_assoc($ps5))
						{
							$nature = $rs5['category'];
						}

						if(!empty($report))
						{
							if($nature != "payment")
							{
								if(!empty($direction))
								{
									$query6 = "DELETE FROM notifications WHERE reminder = '$report' AND email = '$direction'";
									$ps6 = mysqli_query($c, $query6);

									if(!$ps6)
								    {
								        die("Failed to delete data:" . mysqli_error($c));
								        header("location: deletenotifications.php");
								        exit();
								    }
								    else
								    {
								    	header("location: notifications.php");
								        exit();
								    }
								}
								else
								{
									$peculiar = "*Email Required";
								}
							}
							else
							{
								$invalid = "*Cannot Delete Entry";
							}
						}
						else
						{
							$absent = "*No Entry Available";
						}		
					}
					else
					{
						header("location: deletenotifications.php");
					    exit();
					}
				}
			}
		}
	}

	mysqli_close($c);
?>
<html>
<head>
	<title>Delete Notifications</title>
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
				    <li class="navbar-brand">
				      <a class="nav-link" href="vehicles.php">
						<img src = "vehicle icon.png" alt = "vehicle" id = "scale">
						Vehicles</a>
				    </li>
					<li class="navbar-brand nav-item active">
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
		<div id = "drape">
			<center>
				<fieldset>
					<form method = "post" action = "deletenotifications.php" onsubmit = "return deletenotifications()">
						<div class = "form-group">
							<h1><strong><center>Delete Notification</center></strong></h1>
						</div>
						<div class="form-group">
						<label>Reminder:</label>
					    <input type="text" class="form-control" name = "report" id = "modify">
						<div class = "text-danger">
							<?php echo $absent; ?>
							<?php echo $invalid; ?>
						</div>
					  </div>
						<div class="form-group">
					    <label>Email Address:</label>
					    <input type="text" class="form-control" name = "direction" id = "modify">
						<div class = "text-danger">
							<?php echo $disconnect; ?>
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