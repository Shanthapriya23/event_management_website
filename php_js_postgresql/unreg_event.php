<?php

@include 'config.php';
 
session_start();

if (!isset($_SESSION['name']) || strlen($_SESSION['name']) == 0) 
{
    header('Location: ./login_form.php');
}

if(isset($_SESSION['user_name']))
  $u_name=$_SESSION['user_name'];
if (isset($_GET['event_id'])) 
{
  $id = $_GET['event_id'];
  $title = '';
  $genre = '';
  $venue = '';
  $date = '';
  $time = '';
  $desc = '';
}
$select_user_id="select reg_id from registered where name='$u_name'";
$result=pg_query($conn, $select_user_id);
if (pg_numrows($result) > 0) 
  {
        $row = pg_fetch_array($result);
        $user_no = $row['reg_id'];
  }
$delete="DELETE FROM user_event_booking WHERE event_no = '$id' AND user_id ='$user_no'";
$stmt=pg_query($conn,$delete);
header('location:user_display_events.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=3.0">
   <title>BOOKING PAGE</title>
   <link rel="stylesheet" href="css/style.css">

</head>
</html>