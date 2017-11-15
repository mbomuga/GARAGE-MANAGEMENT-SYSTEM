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

     if($_SERVER['REQUEST_METHOD'] == 'POST')
	   {
        $group = mysqli_real_escape_string($c, $_POST['updatetype']);
        $alter = mysqli_real_escape_string($c, $_POST['updatevalue']);
        $prefix = mysqli_real_escape_string($c, $_POST['prefix']);

        if (isset($_POST['submit']))
        {
          if (!empty($alter) || !empty($address))
          {
            if ($group == "first")
            {
              $query2 = "UPDATE accounts SET first = '$alter' WHERE email = '$heading'";
              $ps2 = mysqli_query($c, $query2);

              if(!$ps2)
              {
                  die("Failed to update data:" . mysqli_error($c));
                  header("location: editprofile.php");
                  exit();
              }
              else
              {
                if($authority != "manager" && $authority != "owner")
                {
                  $query6 =  "SELECT * FROM accounts WHERE email = '$heading'";
                
                  $ps6 = mysqli_query($c, $query6);

                  if(!$ps6)
                  {
                      die("Failed to retrieve data:" . mysqli_error($c));
                      header("location: login.php");
                      exit();
                  }

                  $reading6 = mysqli_num_rows($ps6);

                  if($reading6>0)
                  {
                    while ($rs6 = mysqli_fetch_assoc($ps6))
                    {
                      $directory = $rs6['first'];
                      $surname = $rs6['last'];

                      $designate = $directory . " " . $surname;
                    }
                  }

                  $query7 = "SELECT * FROM vehicles WHERE email = '$heading'";

                  $ps7 = mysqli_query($c, $query7);

                  if(!$ps7)
                  {
                      die("Failed to retrieve data:" . mysqli_error($c));
                      header("location: viewvehicles.php");
                      exit();
                  }

                  $reading7 = mysqli_num_rows($ps7);

                  if ($reading7>0)
                  {
                    while ($rs7 = mysqli_fetch_assoc($ps7))
                    {
                      $query8 = "UPDATE vehicles SET username = '$designate' WHERE email = '$heading'";
                      $ps8 = mysqli_query($c, $query8);

                      if(!$ps8)
                      {
                            die("Failed to update data:" . mysqli_error($c));
                            header("location: updatevehicles.php");
                            exit();
                      }
                    }
                  }

                  $query9 = "SELECT * FROM notifications WHERE email = '$heading'";

                  $ps9 = mysqli_query($c, $query9);

                  if(!$ps9)
                  {
                      die("Failed to retrieve data:" . mysqli_error($c));
                      header("location: viewvehicles.php");
                      exit();
                  }

                  $reading9 = mysqli_num_rows($ps9);

                  if ($reading9>0)
                  {
                    while ($rs9 = mysqli_fetch_assoc($ps9))
                    {
                      $query10 = "UPDATE notifications SET username = '$designate' WHERE email = '$heading'";
                      $ps10 = mysqli_query($c, $query10);

                      if(!$ps10)
                      {
                            die("Failed to update data:" . mysqli_error($c));
                            header("location: updatevehicles.php");
                            exit();
                      }
                    }
                  }

                  $query11 = "SELECT * FROM schedule WHERE email = '$heading'";

                  $ps11 = mysqli_query($c, $query11);

                  if(!$ps11)
                  {
                      die("Failed to retrieve data:" . mysqli_error($c));
                      header("location: viewvehicles.php");
                      exit();
                  }

                  $reading11 = mysqli_num_rows($ps11);

                  if ($reading11>0)
                  {
                    while ($rs11 = mysqli_fetch_assoc($ps11))
                    {
                      $query12 = "UPDATE schedule SET username = '$designate' WHERE email = '$heading'";
                      $ps12 = mysqli_query($c, $query12);

                      if(!$ps12)
                      {
                            die("Failed to update data:" . mysqli_error($c));
                            header("location: updatevehicles.php");
                            exit();
                      }
                    }
                  }

                  $query13 = "SELECT * FROM history WHERE email = '$heading'";

                  $ps13 = mysqli_query($c, $query13);

                  if(!$ps13)
                  {
                      die("Failed to retrieve data:" . mysqli_error($c));
                      header("location: viewvehicles.php");
                      exit();
                  }

                  $reading13 = mysqli_num_rows($ps13);

                  if ($reading13>0)
                  {
                    while ($rs13 = mysqli_fetch_assoc($ps13))
                    {
                      $query14 = "UPDATE history SET username = '$designate' WHERE email = '$heading'";
                      $ps14 = mysqli_query($c, $query14);

                      if(!$ps14)
                      {
                            die("Failed to update data:" . mysqli_error($c));
                            header("location: updatevehicles.php");
                            exit();
                      }
                    }
                  }
                }

                header("location: logout.php");
                exit();
              }
            }
            elseif ($group == "last")
            {
              $query3 = "UPDATE accounts SET last = '$alter' WHERE email = '$heading'";
              $ps3 = mysqli_query($c, $query3);

              if(!$ps3)
              {
                  die("Failed to update data:" . mysqli_error($c));
                  header("location: editprofile.php");
                  exit();
              }
              else
              {
                if($authority != "manager" && $authority != "owner")
                {
                  $query15 =  "SELECT * FROM accounts WHERE email = '$heading'";
                
                  $ps15 = mysqli_query($c, $query15);

                  if(!$ps15)
                  {
                      die("Failed to retrieve data:" . mysqli_error($c));
                      header("location: login.php");
                      exit();
                  }

                  $reading15 = mysqli_num_rows($ps15);

                  if($reading15>0)
                  {
                    while ($rs15 = mysqli_fetch_assoc($ps15))
                    {
                      $directory2 = $rs15['first'];
                      $surname2 = $rs15['last'];

                      $designate2 = $directory2 . " " . $surname2;
                    }
                  }

                  $query16 = "SELECT * FROM vehicles WHERE email = '$heading'";

                  $ps16 = mysqli_query($c, $query16);

                  if(!$ps16)
                  {
                      die("Failed to retrieve data:" . mysqli_error($c));
                      header("location: viewvehicles.php");
                      exit();
                  }

                  $reading16 = mysqli_num_rows($ps16);

                  if ($reading16>0)
                  {
                    while ($rs16 = mysqli_fetch_assoc($ps16))
                    {
                      $query17 = "UPDATE vehicles SET username = '$designate2' WHERE email = '$heading'";
                      $ps17 = mysqli_query($c, $query17);

                      if(!$ps17)
                      {
                            die("Failed to update data:" . mysqli_error($c));
                            header("location: updatevehicles.php");
                            exit();
                      }
                    }
                  }

                  $query18 = "SELECT * FROM notifications WHERE email = '$heading'";

                  $ps18 = mysqli_query($c, $query18);

                  if(!$ps18)
                  {
                      die("Failed to retrieve data:" . mysqli_error($c));
                      header("location: viewvehicles.php");
                      exit();
                  }

                  $reading18 = mysqli_num_rows($ps18);

                  if ($reading18>0)
                  {
                    while ($rs18 = mysqli_fetch_assoc($ps18))
                    {
                      $query19 = "UPDATE notifications SET username = '$designate2' WHERE email = '$heading'";
                      $ps19 = mysqli_query($c, $query19);

                      if(!$ps19)
                      {
                            die("Failed to update data:" . mysqli_error($c));
                            header("location: updatevehicles.php");
                            exit();
                      }
                    }
                  }

                  $query20 = "SELECT * FROM schedule WHERE email = '$heading'";

                  $ps20 = mysqli_query($c, $query20);

                  if(!$ps20)
                  {
                      die("Failed to retrieve data:" . mysqli_error($c));
                      header("location: viewvehicles.php");
                      exit();
                  }

                  $reading20 = mysqli_num_rows($ps20);

                  if ($reading20>0)
                  {
                    while ($rs20 = mysqli_fetch_assoc($ps20))
                    {
                      $query21 = "UPDATE schedule SET username = '$designate2' WHERE email = '$heading'";
                      $ps21 = mysqli_query($c, $query21);

                      if(!$ps21)
                      {
                            die("Failed to update data:" . mysqli_error($c));
                            header("location: updatevehicles.php");
                            exit();
                      }
                    }
                  }

                  $query22 = "SELECT * FROM history WHERE email = '$heading'";

                  $ps22 = mysqli_query($c, $query22);

                  if(!$ps22)
                  {
                      die("Failed to retrieve data:" . mysqli_error($c));
                      header("location: viewvehicles.php");
                      exit();
                  }

                  $reading22 = mysqli_num_rows($ps22);

                  if ($reading22>0)
                  {
                    while ($rs22 = mysqli_fetch_assoc($ps22))
                    {
                      $query23 = "UPDATE history SET username = '$designate2' WHERE email = '$heading'";
                      $ps23 = mysqli_query($c, $query23);

                      if(!$ps23)
                      {
                            die("Failed to update data:" . mysqli_error($c));
                            header("location: updatevehicles.php");
                            exit();
                      }
                    }
                  }
                }

                header("location: logout.php");
                exit();
              }
            }
            elseif ($group == "email")
            {
              $query4 = "UPDATE accounts SET email = '$alter' WHERE email = '$heading'";
              $ps4 = mysqli_query($c, $query4);

              if(!$ps4)
              {
                  die("Failed to update data:" . mysqli_error($c));
                  header("location: editprofile.php");
                  exit();
              }
              else
              {
                if($authority != "manager" && $authority != "owner")
                {
                  $query24 = "SELECT * FROM vehicles WHERE email = '$heading'";

                  $ps24 = mysqli_query($c, $query24);

                  if(!$ps24)
                  {
                      die("Failed to retrieve data:" . mysqli_error($c));
                      header("location: viewvehicles.php");
                      exit();
                  }

                  $reading24 = mysqli_num_rows($ps24);

                  if ($reading24>0)
                  {
                    while ($rs24 = mysqli_fetch_assoc($ps24))
                    {
                      $query25 = "UPDATE vehicles SET email = '$alter' WHERE email = '$heading'";
                      $ps25 = mysqli_query($c, $query25);

                      if(!$ps25)
                      {
                            die("Failed to update data:" . mysqli_error($c));
                            header("location: updatevehicles.php");
                            exit();
                      }
                    }
                  }

                  $query26 = "SELECT * FROM notifications WHERE email = '$heading'";

                  $ps26 = mysqli_query($c, $query26);

                  if(!$ps26)
                  {
                      die("Failed to retrieve data:" . mysqli_error($c));
                      header("location: viewvehicles.php");
                      exit();
                  }

                  $reading26 = mysqli_num_rows($ps26);

                  if ($reading26>0)
                  {
                    while ($rs26 = mysqli_fetch_assoc($ps26))
                    {
                      $query27 = "UPDATE notifications SET email = '$alter' WHERE email = '$heading'";
                      $ps27 = mysqli_query($c, $query27);

                      if(!$ps27)
                      {
                            die("Failed to update data:" . mysqli_error($c));
                            header("location: updatevehicles.php");
                            exit();
                      }
                    }
                  }

                  $query28 = "SELECT * FROM schedule WHERE email = '$heading'";

                  $ps28 = mysqli_query($c, $query28);

                  if(!$ps28)
                  {
                      die("Failed to retrieve data:" . mysqli_error($c));
                      header("location: viewvehicles.php");
                      exit();
                  }

                  $reading28 = mysqli_num_rows($ps28);

                  if ($reading28>0)
                  {
                    while ($rs28 = mysqli_fetch_assoc($ps28))
                    {
                      $query29 = "UPDATE schedule SET email = '$alter' WHERE email = '$heading'";
                      $ps29 = mysqli_query($c, $query29);

                      if(!$ps29)
                      {
                            die("Failed to update data:" . mysqli_error($c));
                            header("location: updatevehicles.php");
                            exit();
                      }
                    }
                  }

                  $query30 = "SELECT * FROM history WHERE email = '$heading'";

                  $ps30 = mysqli_query($c, $query30);

                  if(!$ps30)
                  {
                      die("Failed to retrieve data:" . mysqli_error($c));
                      header("location: viewvehicles.php");
                      exit();
                  }

                  $reading30 = mysqli_num_rows($ps30);

                  if ($reading30>0)
                  {
                    while ($rs30 = mysqli_fetch_assoc($ps30))
                    {
                      $query31 = "UPDATE history SET email = '$alter' WHERE email = '$heading'";
                      $ps31 = mysqli_query($c, $query31);

                      if(!$ps31)
                      {
                            die("Failed to update data:" . mysqli_error($c));
                            header("location: updatevehicles.php");
                            exit();
                      }
                    }
                  }
                }

                header("location: logout.php");
                exit();
              }
            }
            else
            {
              if($authority != "manager" && $authority != "owner")
              {
                $contact = ltrim($alter, "0");
                $call = $prefix . $contact;

                $query5 = "UPDATE accounts SET phone = '$call' WHERE email = '$heading'";
                $ps5 = mysqli_query($c, $query5);

                if(!$ps5)
                {
                    die("Failed to update data:" . mysqli_error($c));
                    header("location: editprofile.php");
                    exit();
                }
                else
                {
                  $query32 = "SELECT * FROM vehicles WHERE email = '$heading'";

                  $ps32 = mysqli_query($c, $query32);

                  if(!$ps32)
                  {
                      die("Failed to retrieve data:" . mysqli_error($c));
                      header("location: viewvehicles.php");
                      exit();
                  }

                  $reading32 = mysqli_num_rows($ps32);

                  if ($reading32>0)
                  {
                    while ($rs32 = mysqli_fetch_assoc($ps32))
                    {
                      $query33 = "UPDATE vehicles SET phone = '$call' WHERE email = '$heading'";
                      $ps33 = mysqli_query($c, $query33);

                      if(!$ps33)
                      {
                            die("Failed to update data:" . mysqli_error($c));
                            header("location: updatevehicles.php");
                            exit();
                      }
                    }
                  }

                  $query34 = "SELECT * FROM notifications WHERE email = '$heading'";

                  $ps34 = mysqli_query($c, $query34);

                  if(!$ps34)
                  {
                      die("Failed to retrieve data:" . mysqli_error($c));
                      header("location: viewvehicles.php");
                      exit();
                  }

                  $reading34 = mysqli_num_rows($ps34);

                  if ($reading34>0)
                  {
                    while ($rs34 = mysqli_fetch_assoc($ps34))
                    {
                      $query35 = "UPDATE notifications SET phone = '$call' WHERE email = '$heading'";
                      $ps35 = mysqli_query($c, $query35);

                      if(!$ps35)
                      {
                            die("Failed to update data:" . mysqli_error($c));
                            header("location: updatevehicles.php");
                            exit();
                      }
                    }
                  }

                  $query35 = "SELECT * FROM schedule WHERE email = '$heading'";

                  $ps35 = mysqli_query($c, $query35);

                  if(!$ps35)
                  {
                      die("Failed to retrieve data:" . mysqli_error($c));
                      header("location: viewvehicles.php");
                      exit();
                  }

                  $reading35 = mysqli_num_rows($ps35);

                  if ($reading35>0)
                  {
                    while ($rs35 = mysqli_fetch_assoc($ps35))
                    {
                      $query36 = "UPDATE schedule SET phone = '$call' WHERE email = '$heading'";
                      $ps36 = mysqli_query($c, $query36);

                      if(!$ps36)
                      {
                            die("Failed to update data:" . mysqli_error($c));
                            header("location: updatevehicles.php");
                            exit();
                      }
                    }
                  }

                  $query37 = "SELECT * FROM history WHERE email = '$heading'";

                  $ps37 = mysqli_query($c, $query37);

                  if(!$ps37)
                  {
                      die("Failed to retrieve data:" . mysqli_error($c));
                      header("location: viewvehicles.php");
                      exit();
                  }

                  $reading37 = mysqli_num_rows($ps37);

                  if ($reading37>0)
                  {
                    while ($rs37 = mysqli_fetch_assoc($ps37))
                    {
                      $query38 = "UPDATE history SET phone = '$call' WHERE email = '$heading'";
                      $ps38 = mysqli_query($c, $query38);

                      if(!$ps38)
                      {
                            die("Failed to update data:" . mysqli_error($c));
                            header("location: updatevehicles.php");
                            exit();
                      }
                    }
                  }
                }

                header("location: logout.php");
                exit();
              }
            }
          }
          else
          {
            header("location:updateprofile.php");
            exit();
          }
        }
     }
  mysqli_close($c);
?>
<html>
<head>
  <title>Update Profile</title>
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
            <li class="nav-item dropdown navbar-brand nav-item active">
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
    <div id = "drape">
      <center>
      <fieldset>
        <form name = "updateprofile" method = "post" action = "updateprofile.php" onsubmit = "return(updateprofile());">
            <div class = "form-group">
              <h1><strong><center>Update Profile</center></strong></h1>
            </div>
            <div class="form-group">
              <label>Update:</label>
              <select class="form-control" name = "updatetype" id = "modify">
              <option value = "first">First Name</option>
              <option value = "last">Last Name</option>
              <option value = "email">Email</option>
              <option value = "phone">Phone</option>
            </select>
            </div>
            <div class="form-group">
            <label>Mobile Prefix:</label>
              <select name = "prefix" id = "modify" class = "form-control">
              <option value = "+254">+254</option>
              <option value = "+255">+255</option>
              <option value = "+256">+256</option>
              <option value = "+1">+1</option>
              <option value = "+44">+44</option>
            </select>
            </div>
            <div class="form-group">
            <label>Update Value:</label>
              <input type="text" class="form-control" id = "modify" name = "updatevalue">
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