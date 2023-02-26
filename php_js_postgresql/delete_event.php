<?php
include 'config.php';
session_start();
if (!isset($_SESSION['name']) || strlen($_SESSION['name']) == 0) 
{
    header('Location: ./login_form.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>DELETE EVENT</title>
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="topnav">
   <a href="admin_profile.php" class="btn">profile</a>
   <a href="add_events.php" class="btn">add events</a>
   <a href="show_events.php" class="btn">show events</a>
   <a href="logout.php" class="btn">logout</a>
</div>

<?php if (isset($_GET['event_id'])) 
{
    $e_id=$_GET['event_id'];
    $delete="DELETE FROM events WHERE event_id = '$e_id'";
    $stmt=pg_query($conn,$delete);
} ?>

<script>
  document.location.href="./show_events.php?";
</script>