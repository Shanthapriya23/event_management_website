<?php

include 'config.php';

session_start();

if (isset($_POST['submit'])) {
    //$name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    //$user_type = $_POST['user_type'];

    $select = " SELECT * FROM registered WHERE email = '$email' and password = '$pass' ";

    $result = pg_query($conn, $select);

    if (pg_numrows($result) > 0) {
        $row = pg_fetch_array($result);
        $_SESSION['email'] = $row['email'];
        $_SESSION['name'] = $row['name'];
        if ($row['user_type'] == 'admin') {
            $_SESSION['admin_name'] = $row['name'];
            header('location:admin_page.php');
        } elseif ($row['user_type'] == 'user') {
            $_SESSION['user_name'] = $row['name'];
            header('location:user_page.php');
        }
    } else {
        $error[] = 'incorrect email or password!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<h1  style="text-align:center;background: #fbd0d9;
   color:crimson;"> EVENT MANAGEMENT SYSTEM </h1>
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>login now</h3>
      <?php if (isset($error)) 
      {
          foreach ($error as $error) 
          {
              echo '<span class="error-msg">' . $error . '</span>';
          }
      } ?>
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="submit" name="submit" value="login" class="form-btn">
      <p>don't have an account? <a href="register_form.php">register now</a></p>
   </form>


</div>

</body>
</html>