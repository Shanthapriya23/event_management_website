<?php
include 'config.php';
session_start();
if (!isset($_SESSION['name']) || strlen($_SESSION['name']) == 0) {
    header('Location: ./login_form.php');
}

if (isset($_GET['event_id'])) {
    $id = $_GET['event_id'];
    $title = '';
    $genre = '';
    $venue = '';
    $date = '';
    $time = '';
    $desc = '';
}
$select = "SELECT * FROM events where event_id = $id";

$result = pg_query($conn, $select);
while ($row = pg_fetch_array($result)) {
    $e_id = $row['event_id'];
    $title = $row['event_title'];
    $genre = $row['event_genre'];
    $venue = $row['event_venue'];
    $date = $row['date'];
    $time = $row['time'];
    $desc = $row['description'];
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
   <a href="add_events.php" class="btn">add events</a>
   <a href="show_events.php" class="btn">show events</a>
   <a href="logout.php" class="btn">logout</a>
</div>
<div class="form-container">
<form name='event_details' action="update_event.php" method="POST">
<fieldset>
  <label for="event_id">EVENT ID</label><br>
  <input type="text" id="event_id" name="event_id" readonly="true" value="<?php echo $e_id; ?> " readonly><br>
  <label for="event_title">EVENT TITLE:</label><br>
  <input type="text" id="event_title" name="event_title" value="<?php echo $title; ?>"><br>
  <label for="event_genre">EVENT GENRE:</label><br>
  <input type="text" id="event_genre" name="event_genre" value="<?php echo $genre; ?>"><br>
  <label for="event_venue">EVENT VENUE</label><br>
  <input type="text" id="event_venue" name="event_venue" value="<?php echo $venue; ?>"><br>
  <label for="date">EVENT DATE</label><br>
  <input type="date" id="date" name="date" value="<?php echo $date; ?>"><br>
  <label for="time">EVENT TIME</label><br>
  <input type="time" id="time" name="time" value="<?php echo $time; ?>"><br>
  <label for="description">DESCRIPTION</label><br>
  <input type="text" id="desc" name="desc" value="<?php echo $desc; ?>"><br>
  <input type="submit" name="edit_event" value="update event" class="form-btn">
</fieldset>
</form>
</div>
</body>
</html>