<?php 
  $server = "localhost";
  $user = "root";
  $password = "";
  $db = "garage";

  $c = new mysqli($server, $user, $password, $db);

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

    $denied = "";

     if($_SERVER['REQUEST_METHOD'] == 'POST')
	   {
        $regulate = mysqli_real_escape_string($c, $_POST['regulate']);
        $adjust = mysqli_real_escape_string($c, $_POST['adjust']);
        $examine = mysqli_real_escape_string($c, $_POST['examine']);

        $encrypt = strlen($regulate);
        $reinforce = strlen($adjust);
        $secure = strlen($examine);

        if (isset($_POST['submit']))
        {
          if (!empty($regulate) && !empty($adjust) && !empty($examine) && $adjust == $examine && $regulate != $adjust && $encrypt>=6 && $reinforce>=6 && $secure>=6)
          {
            $query4 =  "SELECT * FROM accounts WHERE email = ? AND (password1 = ? AND password2 = ?)";
            
            $ps4 = $c->prepare($query4);

            $ps4->bind_param("sss", $heading, $regulate, $regulate);

            $ps4->execute();

            $ps4->store_result();

            if(!$ps4)
            {
                die("Failed to retrieve data:" . mysqli_error($c));
                header("location: login.php");
                exit();
            }

            $index = $ps4->num_rows;

            if ($index != 0)
            {
              $ps4->close();

              $query2 = "UPDATE accounts SET password1 = ? WHERE password1 = ? AND email = ?";
              
              $ps2 = $c->prepare($query2);

              $ps2->bind_param("sss", $adjust, $regulate, $heading);

              $ps2->execute();

              $ps2->close();

              $query3 = "UPDATE accounts SET password2 = ? WHERE password1 = ? AND email = ?";
              
              $ps3 = $c->prepare($query3);

              $ps3->bind_param("sss", $examine, $regulate, $heading);

              $ps3->execute();

              $ps3->close();

              if(!$ps2 || !$ps3)
              {
                  die("Failed to update data:" . mysqli_error($c));
                  header("location: updatepassword.php");
                  exit();
              }
              else
              {
                header("location: logout.php");
                exit();
              }
            }
            else
            {
              $denied = "*Incorrect Password";
            }            
          }
          else
          {
            header("location: updatepassword.php");
            exit();
          }
        }
      }

  $c->close();
?>
<html>
<head>
  <title>Update Password</title>
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
      <form name = "updatepassword" method = "post" action = "updatepassword.php" onsubmit = "return(updatepassword());">
          <div class = "form-group">
            <h1><strong><center>Update Password</center></strong></h1>
          </div>
          <div class="form-group">
          <label>Current Password:</label>
            <input type="password" class="form-control" id = "modify" name = "regulate">
            <div class = "text-danger">
              <?php echo $denied; ?>
            </div>
          </div>
          <div class="form-group">
          <label>New Password:</label>
            <input type="password" class="form-control" id = "modify" name = "adjust">
          </div>
          <div class="form-group">
          <label>Verify Password:</label>
            <input type="password" class="form-control" id = "modify" name = "examine">
          </div>
        <button type="submit" class="btn btn-dark" name = "submit">Update</button>
      </form>
      </fieldset>
      </center>
    </div>
    <div>
      <center>
        <footer id = "footnote">
          <center>
            <h1> (C). 2017 All Rights Reserved</h1>
          </center>
        </footer>
      </center>
    </div>
  </body>
</html>