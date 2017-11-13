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
	 if(!isset($_SESSION['name']) && !isset($_SESSION['email']) && !isset($_SESSION['conduct']))
	 {
	    header("location:login.php");
	    exit();
	 }
    }

    $archives = "";

  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    if (isset($_POST['usage']))
    {
      $key = mysqli_real_escape_string($c, $_POST['key']);

      if(!empty($key))
      {       
        $query2 = "SELECT * FROM history WHERE email = '$heading' AND registration = '$key'";

        $ps3 = mysqli_query($c, $query2);
        if(!$ps3)
          {
              die("Failed to retrieve data:" . mysqli_error($c));
              header("location: usersearch.php");
              exit();
          }

          $reading2 = mysqli_num_rows($ps3);

          require 'usersearch.php';
      }
      else
      {
        header("location: uservehicles.php");
        exit();
      }
    }
    elseif (isset($_POST['regulate'])) 
    {
      $key = mysqli_real_escape_string($c, $_POST['key']);

      if(!empty($key))
      {       
        $query3 = "SELECT * FROM history WHERE registration = '$key'";

        $ps4 = mysqli_query($c, $query3);
        
        if(!$ps4)
        {
            die("Failed to retrieve data:" . mysqli_error($c));
            header("location: viewschedule.php");
            exit();
        }

        $reading3 = mysqli_num_rows($ps4);

        require 'adminsearch.php';
      }
      else
      {
        header("location: adminvehicles.php");
        exit();
      }
    }
    else
    {
      header("location: home.php");
      exit();
    }
  }
  
?>