<?php
require('../config.php');

if (isset($_POST['register'])) {
    $errMsg = '';

    // Get data from form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
  

    if ($username == '')
        $errMsg = 'Enter your username';
    if ($password == '')
        $errMsg = 'Enter password';
    if ($email == '')
        $errMsg = 'Enter email';

    if ($errMsg == '') {
        $checkuser = "SELECT * FROM user WHERE email = :email";
        $stmtCheck = $db->prepare($checkuser);
        $stmtCheck->bindParam(':email', $email, PDO::PARAM_STR);
        $stmtCheck->execute();
        $count = $stmtCheck->rowCount();

        if ($count > 0) {
            
            $emailused = "Email is already used!";
    
        } else {
            // Insert user
            $sql = "INSERT INTO user (username, password, email) VALUES (:username, :password, :email)";
            $stmtInsert = $db->prepare($sql);

            // Bind parameters
            $stmtInsert->bindParam(':username', $username, PDO::PARAM_STR);
            $stmtInsert->bindParam(':password', $password, PDO::PARAM_STR); // Note: You should hash the password before storing it in a real-world scenario
            $stmtInsert->bindParam(':email', $email, PDO::PARAM_STR);

            // Execute the insert statement
            if ($stmtInsert->execute()) {
                
                header('Location: register.php?action=joined');
                exit;
            } else {
                echo "Failed to add user";
            }
        }
    }

}

	
?>



<html>
<head><title>Register</title></head>
<link rel="stylesheet" href="../assets/register.css">


<body>

<script>
        <?php
        // Display alert if URL parameter 'action' is set to 'joined'
        if (isset($_GET['action']) && $_GET['action'] == 'joined') {
            echo 'alert("Registration successful! You can now log in.");';
        }

      

        ?>
    </script>



	
<form action="" method="post">
	<div class="box">
        <div id="logo" class="" title="">		
        <h2>Register</h2>

        <?php
                    if (isset($errMsg)) {
                        echo '<div style="color:#FF0000;text-align:center;font-size:15px; margin-top:10px">' . $emailused . '</div>';

                     
                    }


              


                    ?>
        <p>Use a Google account</p>
     
       
      


		<div class="inputBox">
            <input type="text" name="username" required="" onkeyup="this.setAttribute('value', this.value);" value="<?php if(isset($_POST['username'])) echo $_POST['username'] ?>" autocomplete="off">                          
            <label>User name</label>
          </div>
          <div class="inputBox">
            <input type="password" name="password" required="" onkeyup="this.setAttribute('value', this.value);" value="<?php if(isset($_POST['password'])) echo $_POST['password'] ?>">
            <label>Password </label>
          </div>
          <div class="inputBox">
                <input type="email" name="email" required="" onkeyup="this.setAttribute('value', this.value);" value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>" autocomplete="off">
                <label>Email Address</label>
              </div>
            
              <div class="forgot">
				<a href="login.php">
				<button type="button">Already have Account??</button>
				</a>

              <!-- <div class="forgot">
                <button type="button">Forgot your address?</button>
              </div> -->
          <!-- <input type="submit" name="sign-in" value="Sign In"> -->
		  <input type="submit" name='register' value="Register" class='submit'/><br />
 
      </div>
</form>


</body>

<!---->
</html>
