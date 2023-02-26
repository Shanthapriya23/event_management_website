<?php
echo"<h1>THE ADMIN PROFILE:</h1>";
@include 'config.php';
session_start();
$name="";
$email="";
if (isset($_SESSION["name"]) and $_SESSION["name"]!="")
 {
   $name=$_SESSION["name"];
 }
else{header('location:login_page.php');}
if (isset($_SESSION["email"]))
 {
   $email=$_SESSION["email"];
 }
else{header('location:login_page.php');}

   $searchsql="SELECT * FROM registered WHERE name='$name'";
   
   $result=pg_query($conn,$searchsql);
   
   echo "<table style='align=center;border:10px solid green;width:100%;height:30%;text-align: center'>";
   if($row=pg_fetch_array($result))
   { 
     $user_id=$row['reg_id'];
     $name=$row['name'];
     $emailid=$row["email"];
     $client_type=$row['user_type'];
     
     echo "<tr style='background:#37a14f'>
     <td style='border:3px solid white;font-size:25; font-weight:bold'>USER ID</td>
     <td style='border:3px solid white;font-size:25; font-weight:bold'>NAME</td>
     <td style='border:3px solid white;font-size:25; font-weight:bold'>MAIL-ID</td>
     <td style='border:3px solid white;font-size:25; font-weight:bold'>CLIENT TYPE</td>
     </tr>";
     echo "<tr style='background:#caf57a'>";
     echo "
     <td style='border:3px solid white;text-align: center;font-size:20'>$user_id</td>
     <td style='border:3px solid white;text-align: center;font-size:20'>$name</td>
     <td style='border:3px solid white;text-align: center;font-size:20'>$emailid</td>  
     <td style='border:3px solid white;text-align: center;font-size:20'>$client_type</td></tr>";
     echo "<tr style='background:#caf57a;font-size:25'>
     <td style='border:3px solid white'>OTHER OPERATIONS:</td>

     <td style='border:3px solid white'><a href='show_events.php' class='btn' style='display: inline-block;padding:10px 30px;font-size: 20px;
     background: rgb(250, 171, 171);color:#fff;margin:0 5px;text-transform: capitalize;'>show events</a></td>

     <td style='border:3px solid white'><a href='add_events.php' class='btn' style='display: inline-block;padding:10px 30px;font-size: 20px;
     background: rgb(250, 171, 171);color:#fff;margin:0 5px;text-transform: capitalize;'>add events</a></td>

     <td style='border:3px solid white'><a href='logout.php' class='btn' style='display: inline-block;padding:10px 30px;font-size: 20px;
     background: rgb(250, 171, 171);color:#fff;margin:0 5px;text-transform: capitalize;'>logout</a></td>
     </tr>";
   }
   echo "</table>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=3.0">
   <title>admin profile page</title>
   <link rel="stylesheet" href="css/style.css">

</head>
</html>