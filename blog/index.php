<?php
# Initialize the session
session_start();

# If user is not logged in then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== TRUE) {
  echo "<script>" . "window.location.href='login/login.php';" . "</script>";
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
 
   <link rel="stylesheet" href="assets/home.css">
</head>
<body>



<?php
include('templates/common/nav.php');

include('templates/common/content.php');
?>













<a href="login/logout.php" class="btn btn-primary">Log Out</a>


<footer>
    <p></p>
</footer>




</body>
</html>