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

	$peculiar = "";
	$clause = "";
	$disconnect = "";
	$fiction = "";


     if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$report = mysqli_real_escape_string($c, $_POST['report']);
		$group = mysqli_real_escape_string($c, $_POST['updatetype']);
		$category = mysqli_real_escape_string($c, $_POST['nature']);
		$importance = mysqli_real_escape_string($c, $_POST['importance']);
		$alter = mysqli_real_escape_string($c, $_POST['updatevalue']);
		$direction = mysqli_real_escape_string($c, $_POST['direction']);

		if (isset($_POST['submit']))
		{
			$query5 =  "SELECT * FROM accounts WHERE email = '$direction'";
			$ps5 = mysqli_query($c, $query5);


			if(!$ps5)
		    {
		        die("Failed to retrieve data:" . mysqli_error($c));
		        header("location: updateschedule.php");
		        exit();
		    }

		    $feedback = mysqli_num_rows($ps5);

		    if ($feedback>0)
		    {
		    	while ($rs5 = mysqli_fetch_assoc($ps5))
		    	{
		    		$access = $rs5['usertype'];

			    	if($access != "owner" || $access != "manager")
			    	{
						if(!empty($report))
						{
							$query6 = "SELECT * FROM notifications WHERE reminder = '$report' AND email = '$direction'";

							$ps6 = mysqli_query($c, $query6);
							if(!$ps6)
						    {
						        die("Failed to retrieve data:" . mysqli_error($c));
						        header("location: notifications.php");
						        exit();
						    }

						    $record = mysqli_num_rows($ps6);

						    if ($record != 0)
						    {
						     	while($rs6 = mysqli_fetch_assoc($ps6))
								{
									$nature = $rs6['category'];

									if($nature != "payment" && $nature != "vehicle" && $nature != "schedule" && $nature != "account" && $nature != "history")
									{
										if($group == "report")
										{
											if (!empty($alter))
											{
												$query2 = "UPDATE notifications SET reminder = '$alter' WHERE reminder = '$report' AND email = '$direction'";
												$ps2 = mysqli_query($c, $query2);

												if(!$ps2)
											    {
											        die("Failed to update data:" . mysqli_error($c));
											        header("location: updatenotifications.php");
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
												$absent = "Reminder Required";
											}
										}
										elseif($group == "category")
										{
											$query3 = "UPDATE notifications SET category = '$nature' WHERE reminder = '$report' AND email = '$direction'";
											$ps3 = mysqli_query($c, $query3);

											if(!$ps3)
										    {
										        die("Failed to update data:" . mysqli_error($c));
										        header("location: updatenotifications.php");
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
											$query4 = "UPDATE notifications SET priority = '$importance' WHERE reminder = '$report' AND email = '$direction'";
											$ps4 = mysqli_query($c, $query4);

											if(!$ps4)
										    {
										        die("Failed to update data:" . mysqli_error($c));
										        header("location: updatenotifications.php");
										        exit();
										    }
										    else
										    {
										    	header("location: notifications.php");
										    	exit();
										    }
										}
									}
									else
									{
										$clause = "*Cannot Update Record";
									}
								}
							}
							else
							{
								$peculiar = "*Record Unavailable";
							}
						}
						else
						{
							header("location: updatenotifications.php");
							exit();
						}
					}
					else
					{
						$disconnect = "*User is Not a Client";
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
	<title>Update Notification</title>
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
		<div id = "drape">
			<center>
				<fieldset>
				<form name = "updatenotifications" method = "post" action = "updatenotifications.php" onsubmit = "return(updatenotifications());">
					<div class = "form-group">
						<h1><strong><center>Update Notification</center></strong></h1>
					</div>
				  <div class="form-group">
				    <label>Update:</label>
				    <select class="form-control" name = "updatetype" id = "modify">
						<option value = "report">Reminder</option>
						<option value = "category">Category</option>
						<option value = "relevance">Priority</option>
					</select>
				  </div>
					<div class="form-group">
					<label>Reminder Update:</label>
				    <input type="text" class="form-control" name = "updatevalue" id = "modify">					
				  </div>
				<div class="form-group">
				    <label>Category:</label>
					<select class="form-control" name = "nature" id = "modify">
						<option value = "repairs">Repairs</option>
						<option value = "promotion">Promotion</option>
					</select>
				  </div>
				<div class="form-group">
				    <label>Priority Level:</label>
					<select class="form-control" name = "importance" id = "modify">
						<option value = "high">High</option>
						<option value = "medium">Medium</option>
						<option value = "low">Low</option>
					</select>
				  </div>
				<div class="form-group">
					<label>Reminder:</label>
				    <input type="text" class="form-control" name = "report" id = "modify">
					<div class = "text-danger">
						<?php echo $peculiar; ?>
						<?php echo $clause; ?>
					</div>
				  </div>
				<div class="form-group">
				    <label>Email Address:</label>
				    <input type="text" class="form-control" name = "direction" id = "modify">
					<div class = "text-danger">
						<?php echo $disconnect; ?>
						<?php echo $fiction; ?>
					</div>
				  </div>
					<button type="submit" class="btn btn-dark" name = "submit">Update</button>
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