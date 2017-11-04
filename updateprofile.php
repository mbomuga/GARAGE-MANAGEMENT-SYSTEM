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

     if($_SERVER['REQUEST_METHOD'] == 'POST')
	   {
        $group = mysqli_real_escape_string($c, $_POST['updatetype']);
        $alter = mysqli_real_escape_string($c, $_POST['updatevalue']);

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
                header("location: profile.php");
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
                header("location: profile.php");
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
                header("location: profile.php");
                exit();
              }
            }
            else
            {
              $query5 = "UPDATE accounts SET phone = '$alter' WHERE email = '$heading'";
              $ps5 = mysqli_query($c, $query5);

              if(!$ps5)
              {
                  die("Failed to update data:" . mysqli_error($c));
                  header("location: editprofile.php");
                  exit();
              }
              else
              {
                header("location: profile.php");
                exit();
              }
            }
          }
          else
          {
            header("location:editprofile.php");
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
        <a href = "home.html" target = "_self"><h1><strong>GARAGE MANAGEMENT SYSTEM</strong></h1></a>
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
        <form method = "post" action = "updateprofile.php" onsubmit = "return updateprofile()">
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
            <label>Update Value:</label>
              <input type="text" class="form-control" id = "modify" name = "updatevalue">
            </div>
          <button type="submit" class="btn btn-primary" name = "submit">Update</button>
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