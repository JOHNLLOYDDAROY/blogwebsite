<?php
session_start();


// Redirect to login page if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Function to delete post from the database
function deletePostFromDatabase($post_id) {
    // Implement your database connection and deletion logic here
    // Use prepared statements to prevent SQL injection

    require('config.php');
    try {
        $sql = "DELETE FROM posts WHERE post_id = :post_id";
        $stmtDelete = $db->prepare($sql);

        // Bind parameter
        $stmtDelete->bindParam(':post_id', $post_id);
      // Execute the statement
        $query_execute = $stmtDelete->execute();
        // Close the statement
        $stmtDelete->closeCursor();

        return $query_execute;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}

// Check if the form is submitted for deletion
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['delete'])) {
    $post_id = $_POST['delete'];

    // Attempt to delete the post
    $query_execute = deletePostFromDatabase($post_id);

    if ($query_execute) {
        $_SESSION['message'] = "Deleted Successfully";
        
    header('Location: index.php');
    exit(0);    
    } else {
        $_SESSION['message'] = "Not Deleted";
    }

    header('Location: index.php');
    exit(0);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Post</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js'></script>
</head>
<body>
    <form action="delete_post.php" method="POST">
    <?php
           //to get the value from the post id
          $post_id = isset($_GET['id']) ? $_GET['id'] : null;?> 
         <button type="submit" name="delete" value="<?php echo $post_id; ?>">Delete</button>
        
    </form>
</body>
</html>
