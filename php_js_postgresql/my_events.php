<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>MY EVENTS</title>
   <link rel="stylesheet" href="css/style.css">
   <script>
<?php if (isset($_GET['msg']) and $_GET['msg'] != '') {
    $displayMsg = $_GET['msg'];
    echo "alert($displayMsg)";
} ?>
   </script>
</head>
<body>
<div class="topnav">
   <a href="stu_profile.php" class="btn">profile</a>
   <a href="user_display_events.php" class="btn">show events</a>
   <a href="logout.php" class="btn">logout</a>
</div>
<?php
include 'config.php';
session_start();
if (!isset($_SESSION['name']) || strlen($_SESSION['name']) == 0) 
{
    header('Location: ./login_form.php');
}

if(isset($_SESSION['user_name']))
  $u_name=$_SESSION['user_name'];

$select_user_id="select reg_id from registered where name='$u_name'";
$result=pg_query($conn, $select_user_id);
if (pg_numrows($result) > 0) 
  {
        $row = pg_fetch_array($result);
        $user_no = $row['reg_id'];
  }
$select2 ="SELECT user_event_booking.user_id,user_event_booking.booking_id,user_event_booking.booking_date,events.event_id,events.event_title,
events.event_genre,events.event_venue,events.date,events.time,events.description
FROM user_event_booking
INNER JOIN  events on  events.event_id = user_event_booking.event_no
where user_event_booking.user_id='$user_no'";


//"SELECT * FROM user_event_booking where user_id='$user_no'";

$result2= pg_query($conn, $select2);

echo "<table style='align=center;border:10px solid green;width:100%;height:30%;text-align: center'>";
echo "<tr style='background:aliceBlue'>
  <td>BOOKING ID</td>
  <td>USER NAME</td>
  <td>EVENT ID</td>
  <td>BOOKING DATE</td>
  <td>USER ID</td>
  <td>EVENT TITLE</td>
  <td>EVENT GENRE</td>
  <td>VENUE</td>
  <td>DATE</td>
  <td>TIME</td>
  <td>DESCRIPTION</td>";
while ($row2 = pg_fetch_array($result2))
{
  //to do convert all to table
  
  $title = $row2['event_title'];
  $genre = $row2['event_genre'];
  $venue = $row2['event_venue'];
  $date = $row2['date'];
  $time = $row2['time'];
  $desc = $row2['description'];
  $user_no = $row2['user_id'];
  $book_date = $row2['booking_date'];
  $event_id=$row2['event_id'];
  $booking_id=$row2['booking_id'];
  
  echo "<tr>
  <td>$booking_id</td> 
  <td>$u_name</td> 
  <td>$event_id</td> 
  <td>$book_date</td>
  <td>$user_no</td>
  <td>$title</td>
  <td>$genre</td>
  <td>$venue</td>
  <td>$date</td> 
  <td>$time</td> 
  <td>$desc</td> 
  </tr>";
} ?>
<?php echo '</table>'; ?>

</body>
</html>
