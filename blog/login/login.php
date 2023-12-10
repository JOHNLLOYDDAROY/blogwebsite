<?php

# Initialize session
session_start();
require '../config.php';
//require '../includes/db.php';
# Check if user is already logged in, If yes then redirect him to index page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == TRUE) {
	echo "<script>" . "window.location.href='../index.php'" . "</script>";
	exit;
  }

if (isset($_POST['login'])) {
    $errMsg = '';

    $email = $_POST['email'];
    $password = $_POST['password'];
  

    if ($email == '')
        $errMsg = 'Enter email';
    if ($password == '')
        $errMsg = 'Enter password';

    if ($errMsg == '') {
        try {
            $stmt = $db->prepare('SELECT user_id, username, password, email FROM user WHERE email = :email');
            $stmt->execute(array(':email' => $email));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data == false) {
                $errMsg = "Email $email not found.";
            } else {
                if ($password == $data['password']) {
                    $_SESSION['user_id'] = $data['user_id'];
                    $_SESSION['name'] = $data['fullname'];
                    $_SESSION['username'] = $data['username'];
                    $_SESSION['password'] = $data['password'];
                    $_SESSION["loggedin"] = TRUE;
                    
					//   # Store data in session variables
					//   $_SESSION["id"] = $id;
					//   $_SESSION["username"] = $username;
				

                    header('Location: ../index.php');
                    exit;
                } else {
                    $errMsg = 'Password not match.';
                }
            }
        } catch (PDOException $e) {
            $errMsg = $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="../assets/register.css">
</head>
<body>
  
    <form action="" method="post">
        <div class="box">
            <div id="logo" class="" title="">
                <h2>Log in</h2>
                <?php
                    if (isset($errMsg)) {
                        echo '<div style="color:#FF0000;text-align:center;font-size:15px; margin-top:10px">' . $errMsg . '</div>';
                    }

             
                    
                    ?>
                <p>Use a Google account</p>
                <div class="inputBox">
                    <input type="email" name="email" onkeyup="this.setAttribute('value', this.value);" value="<?php if (isset($_POST['email'])) echo $_POST['email'] ?>" autocomplete="off">
                    <label>Email Address</label>
                </div>
               
                <div class="inputBox">
                    <input type="password" name="password" onkeyup="this.setAttribute('value', this.value);" value="<?php if (isset($_POST['password'])) echo $_POST['password'] ?>">
                    <label>Password </label>
                </div>
                <div class="forgot">
                    <a href="register.php">
                        <button type="button">Create Account</button>
                    </a>
                </div>
                <input type="submit" name='login' value="Login" class='submit' /><br />
            </div>
        </div>
    </form>
</body>
</html>
