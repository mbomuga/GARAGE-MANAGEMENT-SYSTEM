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
		<fieldset>
		<table id = "extend">
			<tr>
				<td id = "default">
					<center>
						<a href = "insertvehicles.php" target = "_self">
						<img src = "insert icon.png" alt = "insert icon" id = "page">
						Add Vehicle
						</a>
					</center>
				</td>
				<td id = "default">
					<center>
						<a href = "updatevehicles.php" target = "_self">
						<img src = "update icon.png" alt = "update icon" id = "page">
						Update Vehicle
						</a>
					</center>
				</td>
				<td id = "default">
					<center>
						<a href = "deletevehicles.php" target = "_self">
						<img src = "delete icon.png" alt = "delete icon" id = "page">
						Delete Vehicle
						</a>
					</center>
				</td>
			</tr>
		</table>
		</fieldset>
		</center>
	</div>
	<div>
		<center>
		<footer id = "refine">
			<center>
				<h1> (C). 2017 All Rights Reserved</h1>
			</center>
		</footer>
		</center>
	</div>
</body>
</html>