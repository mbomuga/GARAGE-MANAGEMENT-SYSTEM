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

  $negative = "";
  $inventory = "";

  if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$reference = mysqli_real_escape_string($c, $_POST['reference']);
		$alert = "Forgot Password";
		$relevance = "high";

		if (isset($_POST['submit']))
		{
			if (!empty($reference))
			{
				$query2 = "SELECT * FROM accounts WHERE email = '$reference'";

				$ps2 = mysqli_query($c, $query2);
					
				if(!$ps2)
				{
					die("Failed to retrieve data:" . mysqli_error($c));
					header("location: recovery.php");
					exit();
				}

			    $reading = mysqli_num_rows($ps2);

			    if($reading>0)
			    {
			    	while($rs2 = mysqli_fetch_assoc($ps2))
					{
					    $directory = $rs2['first'];
					    $surname = $rs2['last'];
						$direction = $rs2['email'];

						$designate = $directory . " " . $surname;
					}

			    	$query3 = "SELECT * FROM notifications WHERE email = '$reference' AND reminder = '$alert'";

					$ps3 = mysqli_query($c, $query3);
					if(!$ps3)
				    {
				        die("Failed to retrieve data:" . mysqli_error($c));
				        header("location: recovery.php");
				        exit();
				    }

					$reading2 = mysqli_num_rows($ps3);

					if($reading2 == 0)
					{

						$query4 = "INSERT INTO `notifications` (`reminder`, `priority`, `username`, `email`) VALUES ('$alert', '$relevance', '$designate', '$direction')";
						
						$ps4 = mysqli_query($c, $query4);

						if(!$ps4)
						{
							die("Failed to insert data:" . mysqli_error($c));
							header("location: recovery.php");
							exit();
						}
						else
						{
							header("location: login.php");
	    					exit();	
						}
					}
					else
					{
						$inventory = "Entry already Present in Directory";
					}
				}
			    else
			    {
					$negative = "User does not Exist";
				}			    	
			}
			else
			{
				header("location: recovery.php");
	    		exit();
			}
		}
	}

	mysqli_close($c);
?>
<html>
<head>
	<title>Password Recovery</title>
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
				<h1><strong>GARAGE MANAGEMENT SYSTEM</strong></h1>
			</center>
		</div>
		<div>
			<center>
				<fieldset id = "position">
					<center>
						<form method = "post" action = "recovery.php" onsubmit = "return recovery()">
						<div class = "form-group">
							<label>Email Address:</label>
						  <input type="text" class="form-control" id = "dimensions" name = "reference">
						</div>
						  <button type="submit" class="btn btn-primary" name = "submit">Submit</button>
						<div class = "form-group">
							<?php echo $negative; ?>
								<br>
							<?php echo $inventory; ?>
						</div>
						</form>
					</center>
				</fieldset>
			</center>
		</div>
		<div>
			<center>
				<footer id = "refine">
					<h1>(C). 2017 All Rights Reserved</h1>
				</footer>
			</center>
		</div>
	</body>
	</body>
</html>