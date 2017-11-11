<!DOCTYPE html>
<?php 

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
    $currency = "Ksh";

     if ($authority != "manager")
     {
     	header("location:home.php");
        exit();
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
					<li class="navbar-brand">
				      <a class="nav-link" href="payment.php">
						<img src = "payment icon.png" alt = "payment" id = "scale" class = "rounded">
						Payment</a>
				    </li>
					<li class="navbar-brand nav-item active">
				      <a class="nav-link" href="history.php">
						<img src = "history icon.png" alt = "history" id = "scale" class = "rounded">
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
								<div id = "reverse">
									<fieldset>
										<table id = "primary">
											<tr>
												<td id = "default">
													<center>
														<div class="btn-group">
														  <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown">
															<img src = "edit icon.png" alt = "edit icon" id = "narrow" class = "rounded">
															Edit
															</button>
														  <div class="dropdown-menu dropdown-menu right">
														    <a class="dropdown-item" href="inserthistory.php">
															<img src = "insert icon.png" alt = "insert icon" id = "scale" class = "rounded">
															Add
															</a>
														    <a class="dropdown-item" href="updatehistory.php">
															<img src = "update icon.png" alt = "update icon" id = "scale">
															Update
															</a>
														  </div>
														</div>
													</center>
												</td>
											</tr>
										</table>
									</fieldset>
								</div>
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
									<strong>Reference No.:</strong>
								</center>
							</th>
							<th id = "field">
								<center>
									<strong>Registration No.:</strong>
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
									<strong>Phone Number:</strong>
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
								if(isset($_POST['regulate']))
								{
									if(!empty($key))
									{
										if($reading3>0)
									    {
											while($rs3 = mysqli_fetch_assoc($ps4))
											{
												$entry = $rs3['serialno'];
												$label = $rs3['registration'];
												$period = $rs3['period'];
												$lapse = $rs3['lapse'];
												$report = $rs3['description'];
												$quota = $rs3['expense'];
												$tender = $rs3['charge'];
												$title = $rs3['username'];
												$contact = $rs3['phone'];
												$tag = $rs3['email'];
												$manner = $currency . " " . $quota;

												echo "<tr><td id = 'log'><center>" . $entry . "</center></td><td id = 'log'><center>" . $label . "</center></td><td id = 'log'><center>" . $period . "</center></td><td id = 'log'><center>" . $lapse . "</center></td><td id = 'narrative'><center>" . $report . "</center></td><td id = 'log'><center>" . $manner . "</center></td><td id = 'log'><center>" . $tender . "</center></td><td id = 'log'><center>" . $title . "</center></td><td id = 'log'><center>" . $contact . "</center></td><td id = 'log'><center>" .  $tag . "</center></td></tr>";
											}
										}
										else
										{
											$archives = "No Entry Available";
											
											echo "<tr><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'narrative'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td></tr>";
										}
									}
									else
									{
										$archives = "No Entry Available";
										
										echo "<tr><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'narrative'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td><td id = 'log'><center>" . $archives . "</center></td></tr>";
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