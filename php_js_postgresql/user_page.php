<?php

include ('config.php');
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>user page</title>
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<span class="container">

   <div class="content">
      <h3>hi, <span>user</span></h3>
      <h1>welcome <span><?php echo $_SESSION['user_name'] ?></span></h1>
      <p>this is an user page</p>
      <a href="stu_profile.php" class="btn">profile</a>
      <a href="user_display_events.php" class="btn">show events</a>
      <a href="my_events.php" class="btn">my events</a>
      <a href="logout.php" class="btn">logout</a>
   </div>

</span>

</body>
</html>