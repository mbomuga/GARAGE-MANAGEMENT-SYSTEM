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

     if ($authority != "admin")
     {
     	header("location:home.php");
        exit();
     }
    if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$alert = mysqli_real_escape_string($c, $_POST['alert']);
		$relevance = mysqli_real_escape_string($c, $_POST['relevance']);
		$direction = mysqli_real_escape_string($c, $_POST['direction']);

		if (isset($_POST['submit']))
		{
			if(!empty($alert) && !empty($relevance) && !empty($direction))
			{
				$query6  = "SELECT * FROM accounts WHERE email = '$direction'";

				$ps7 = mysqli_query($c, $query6);

				if(!$ps7)
			    {
			        die("Failed to retrieve data:" . mysqli_error($c));
			        header("location: insertnotifications.php");
			        exit();
			    }

			    $rs6 = mysqli_fetch_assoc($ps7);
			    $reference = $rs6['serialno'];

			    $reading = mysqli_num_rows($ps7);

			    if($reading != 0)
			    {
			    	$directory = $rs6['first'];
			    	$surname = $rs6['last'];

			    	$designate = $directory . " " . $surname;
			    }
			    else
			    {
			    	$inventory = "User does not Exist";
			    	header("location: insertnotifications.php");
			        exit();
			    }

				$query5 = "INSERT INTO `notifications` (`reminder`, `priority`, `username`, `email`) VALUES ('$alert', '$relevance', '$designate', '$direction')";
						
				$ps6 = mysqli_query($c, $query5);

				if(!$ps6)
				{
					die("Failed to insert data:" . mysqli_error($c));
					header("location: insertnotifications.php");
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
				header("location: insertnotifications.php");
				exit();
			}
		}
	}

	mysqli_close($c);
?>
<html>
<head>
	<title>Add Notification</title>
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
	<div id = "drape">
		<center>
			<fieldset>
				<form method = "post" action = "insertnotifications.php" onsubmit = "return insertnotifications()">
					<div class = "form-group">
					<h1><strong><center>Insert Notification</center></strong></h1>
					</div>
					<div class="form-group">
				    <label>Reminder:</label>
				    <input type="text" class="form-control" name = "alert" id = "modify">
				  </div>
				  <div class="form-group">
				    <label>Priority:</label>
				    <select class="form-control" name = "relevance" id = "modify">
						<option value = "low">Low</option>
						<option value = "medium">Medium</option>
						<option value = "high">High</option>
					</select>
				  </div>
					<div class="form-group">
				    <label>Email Address:</label>
				    <input type="text" class="form-control" name = "direction" id = "modify">
				  </div>
			  <button type="submit" class="btn btn-primary" name = "submit">Add</button>
			</form>
		</fieldset>
	<div>
		<footer id = "footnote">
			<center>
				<h1> (C). 2017 All Rights Reserved</h1>
			</center>
		</footer>
	</div>
</body>
</html>