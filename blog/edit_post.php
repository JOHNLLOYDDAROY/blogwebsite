<?php
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


?>


<?php
 $post_id = isset($_GET['id']) ? $_GET['id'] : null;


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

   
    if ($post_content == '') {
        echo "Please type something!";
    } else {
        // Update post details in the database
        updatePostInDatabase($post_id, $post_content, $targetFile);

        // Redirect to the main page or wherever you want after updating a post
        header("Location: index.php");
        exit();
    }
}

// Function to update post details in the database
function updatePostInDatabase($post_id, $post_content, $image_path) {
    // Implement your database connection and update logic here
    // Use prepared statements to prevent SQL injection

    require('config.php');
  
    $post_id = isset($_GET['id']) ? $_GET['id'] : null;
    $sql = "UPDATE posts SET post = :post, image = :image WHERE post_id = :post_id";
    $stmtUpdate = $db->prepare($sql);

    // Bind parameters
    $stmtUpdate->bindParam(':post', $post_content);
    $stmtUpdate->bindParam(':image', $image_path);
    $stmtUpdate->bindParam(':post_id', $post_id);

    // Execute the statement
    $stmtUpdate->execute();

    // Close the statement
    $stmtUpdate->closeCursor();
}
?>












<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Post</title>
    <link rel="stylesheet" href="assets/create_post.css">
    <link rel="stylesheet" href="assets/home.css">
</head> 
<body>
<form method="POST" action="" enctype="multipart/form-data">

<div class="container">
    <div class="post">
        <textarea name="post" placeholder="Update your post" class="content"></textarea>

        <!-- Image input and preview -->
        <div class="add_image">
            <label for="updatedImageInput">
                <img src="image/image-icon.png" alt="Add Image">
                <input type="file" id="updatedImageInput" name="image" onchange="previewImage(this)">
            </label>
            <img id="updatedImagePreview" class="image-preview" alt="Image Preview">
        </div>

    
        <button type="submit" class="button" name="update_post">Update Post</button>
    </div>
</div>

</form>
     <!-- JavaScript to handle image preview -->
     <script>
        function previewImage(input) {
            var preview = document.getElementById('updatedImagePreview');
            var file = input.files[0];

            if (file) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block'; // Show the image preview
                }
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none'; // Hide the image preview
            }
        }
    </script>



</body>



</html>



















<?php

// // Fetch posts using PDO
// $sql = "SELECT * FROM posts";
// $stmt = $db->query($sql);
// $results = $stmt->fetchAll(PDO::FETCH_OBJ);
// echo($results);

// $stmt->closeCursor(); // Close the cursor to allow for subsequent queries

// if (isset($_POST['update'])) {
//     $id = $_POST['id'];
//     $post = $_POST['post'];

//     // Update post in the database
//     $sql = "UPDATE posts SET post=:post WHERE id=:id";
//     $stmtUpdate = $db->prepare($sql);
//     $sql_exec = $stmtUpdate->execute(array(":post" => $post, ":id" => $id));

//     if ($sql_exec) {
//         echo '<script>alert("Data Updated");</script>';
//         header('Location: index.php');
//         exit;
//     } else {
// //         echo '<script>alert("Data failed");</script>';
//     }
// }
?>
<?php

//$query = "SELECT * FROM posts";
// $stmt = $db->query($query);

// while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//     echo $row['id'];
//     '<br>';
// }

// // Process form submission
// if ($_SERVER['REQUEST_METHOD'] == "POST") {
//     $post = $_POST['post'];
//     $targetFile = '';

//     // Check if an image is selected
//     if (!empty($_FILES["image"]["name"])) {
//         $targetDir = "uploads/";
//         $targetFile = $targetDir . basename($_FILES["image"]["name"]);
//         move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
//     }

//     $id = $_POST['id'];

//     // Update post in the database
//     $sql = "UPDATE posts SET post = :post, image = :image WHERE user_id = :user_id AND id = :id";
//     $stmtUpdate = $db->prepare($sql);

//     $stmtUpdate->bindParam(':user_id', $_SESSION['user_id']);
//     $stmtUpdate->bindParam(':id', $id);  // Fixed the parameter name here
//     $stmtUpdate->bindParam(':post', $post);
//     $stmtUpdate->bindParam(':image', $targetFile);

//     $stmtUpdate->execute();

//     header('Location:index.php');
//}

// Close the database connection
//$db = null;


?>



