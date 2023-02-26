<?php
include 'config.php';
session_start();
if (!isset($_SESSION['name']) || strlen($_SESSION['name']) == 0) {
    header('Location: ./login_form.php');
}

$title = '';
$genre = '';
$venue = '';
$date = '';
$time = '';
$desc = '';
if (isset($_GET['e_title']) and $_GET['e_title'] != '') {
    $title = $_GET['e_title'];
}

if (isset($_GET['e_genre'])) {
    $genre = $_GET['e_genre'];
}

if (isset($_GET['add_event'])) {
    $title = $_GET['e_title'];
    $genre = $_GET['e_genre'];
    $venue = $_GET['e_venue'];
    $date = $_GET['e_date'];
    $time = $_GET['e_time'];
    $desc = $_GET['e_desc'];
}
$select =
    "SELECT e.*, 
        CASE
            WHEN ueb.user_id IS NULL THEN 'FALSE' 
            ELSE 'TRUE'
        END AS isuserregistered
    FROM events e
        LEFT JOIN user_event_booking ueb ON ueb.event_no = e.event_id
            AND ueb.user_id IN (SELECT reg_id FROM registered WHERE name='" .
    $_SESSION['name'] .
    "')
    WHERE e.date >= now() ORDER BY e.date, e.time";

$result = pg_query($conn, $select);
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>DISPLAY EVENTS TO USER</title>
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
   <a href="my_events.php" class="btn">my events</a>
   <a href="logout.php" class="btn">logout</a>
</div>

<?php
echo "<table style='align=center;border:10px solid #151074 ;width:100%;height:30%;text-align: center'>";
echo "<tr style='background:DodgerBlue'>
  <td>EVENT_ID</td>
  <td>EVENT TITLE</td>
  <td>EVENT GENRE</td>
  <td>VENUE</td>
  <td>DATE</td>
  <td>TIME</td>
  <td>DESCRIPTION</td>
  <td colspan='2'></td></tr>";
?>
<?php
while ($row = pg_fetch_array($result)) {
    //to do convert all to table
    $e_id = $row['event_id'];
    $title = $row['event_title'];
    $genre = $row['event_genre'];
    $venue = $row['event_venue'];
    $date = $row['date'];
    $time = $row['time'];
    $desc = $row['description'];
    $isReg = $row['isuserregistered'];
    $linkMessage = 'BOOK';
    $link = "book_event.php?event_id=$e_id";
    if ($isReg == 'TRUE') {
        $linkMessage = 'UNREGISTER';
        $link = "unreg_event.php?event_id=$e_id";
    }
    echo "
    <tr>
        <td>$e_id</td>
        <td>$title</td>
        <td>$genre</td>
        <td>$venue</td>
        <td>$date</td> 
        <td>$time</td> 
        <td>$desc</td> 
        <td> <a onClick=\"javascript: return confirm('Please confirm booking this event');\" href='$link'>$linkMessage</a> </td>
    </tr>";
}
echo '</table>';

