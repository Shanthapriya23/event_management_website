<?php
include 'config.php';

session_start();

if (!isset($_SESSION['name']) || strlen($_SESSION['name']) == 0) {
    header('Location: ./login_form.php');
}

if (isset($_GET['add_event'])) {
    $title = $_GET['e_title'];
    $genre = $_GET['e_genre'];
    $venue = $_GET['e_venue'];
    $date = $_GET['e_date'];
    $time = $_GET['e_time'];
    $date = $_GET['e_date'];
    $desc = $_GET['e_desc'];

    $insert = "INSERT INTO events(event_title,event_genre,event_venue,date,time,description) VALUES ('$title','$genre','$venue','$date','$time','$desc')";

    pg_query($conn, $insert);
    header('location:show_events.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>ADD EVENTS</title>
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="topnav">
   <a href="admin_profile.php" class="btn">profile</a>
   <a class="btn">add events</a>
   <a href="show_events.php" class="btn">show events</a>
   <a href="logout.php" class="btn">logout</a>
</div>

<div class="form-container">

   <form action="" method="GET">
      <h3>ADD EVENTS:</h3>
      <?php if (isset($error)) {
          foreach ($error as $error) {
              echo '<span class="error-msg">' . $error . '</span>';
          }
      } ?>
      <input type="text" name="e_title" required placeholder="enter title of the event">
      <input type="text" name="e_genre" required placeholder="enter genre of event">
      <input type="text" name="e_venue" required placeholder="enter venue of event">
      <input type="date" name="e_date" required placeholder="enter date of event">
      <input type="time" name="e_time" required placeholder="enter time of event">
      <input type="text" name="e_desc" required placeholder="enter description about the event">
      <input type="submit" name="add_event" value="create event" class="form-btn">
      
   </form>
   </body>
</html>

