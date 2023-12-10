<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get user ID from the session
$user_id = $_SESSION['user_id'];










// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Get post content from the textarea
    $post_content = $_POST['post'];

    // Check if an image is selected
    if (isset($_FILES["image"]) && !empty($_FILES["image"]["name"])) {
        // Image upload handling
        $targetDir = "uploads/"; // Create this directory in your project
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);

        // Now $targetFile contains the path to the uploaded image
    } else {
        // No image selected
        $targetFile = "";
    }

    $post = $_POST['post'];
if($post == '')
{
    echo "please type something!";
}else{

    // Save post details to the database
    savePostToDatabase($user_id, $post_content, $targetFile);
    
    // Redirect to the main page or wherever you want after creating a post
    header("Location: index.php");
    exit();
     }
}

// Function to save post details to the database
function savePostToDatabase($user_id, $post_content, $image_path) {
    // Implement your database connection and insertion logic here
    // Use prepared statements to prevent SQL injection

    require('config.php');

    $sql = "INSERT INTO posts (user_id, post, image) VALUES (:user_id, :post, :image)";
    $stmtInsert = $db->prepare($sql);

    // Bind parameters
    $stmtInsert->bindParam(':user_id', $user_id);
    $stmtInsert->bindParam(':post', $post_content);
    $stmtInsert->bindParam(':image', $image_path);

    // Execute the statement
    $stmtInsert->execute();

     // Close the statement
     $stmtInsert->closeCursor();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <link rel="stylesheet" href="assets/create_post.css">
    <link rel="stylesheet" href="assets/home.css">

</head>

<body>



<!-- <form method="POST" action="" enctype="multipart/form-data">
    <div class="container">
        <textarea name="post" placeholder="What's on your mind?" class="content"></textarea>
        <input type="file" name="image" accept="image/*">
        <button type="submit" class="button" name="new_post">Add Post</button>
    </div>
</form> -->


















<!-- <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

    <div class="container">
        <div class="post">
        <textarea name="post" placeholder="What's on your mind?" class="content"></textarea>
           <div class="add_image">
               <label for="">
                    <a href="">
                    <img src="image/image-icon.png" alt="">
                          <input type="file">
                    </a>
               </label>
           </div>

            
            
        <button type="submit" class="button" name="new_post">Add Post</button>
        </div>
    </div>
 
</form> -->

</body>
</html>
