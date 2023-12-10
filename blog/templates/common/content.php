<?php
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Include database configuration
require('config.php');

// Fetch posts from the database
$sql = "SELECT * FROM posts ORDER BY post_id DESC"; // Assuming you have a column named post_id for ordering
$stmt = $db->query($sql);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../assets/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>
<body>
    


<div class="container">
   <!-- left sidebar -->
   <div class="left-sidebar">
        <div class="sidelink">
            <a href="./index.php"> <i class='bx bxs-home'></i> Home</a>
            <a href="./create_post.php"><i class='bx bx-chat'></i> Create Post</a>
            <a href="#"> <i class='bx bx-question-mark'></i>About</a>
            <a href="#"><i class='bx bx-chat'></i> Latest Post</a>
            <a href="#"> <i class='bx bx-question-mark'></i>About</a>
            <a href="#">See More</a>
        </div>


     </div>
     <!-- left sidebar -->

        

     <!-- main-content -->
     <div class="main-content">


     <div class="story-gallery">
        <div class="story">
        <img src="./image/luffy.jpeg" alt="">
            <p>Post Story</p>
        </div>
        <div class="story">
            <img src="./image/luffy.jpeg" alt="">
            <p>Post Story</p>
        </div>
        <div class="story">
        <img src="./image/luffy.jpeg" alt="">
            <p>Post Story</p>
        </div>
        <div class="story">
        <img src="./image/luffy.jpeg" alt="">
            <p>Post Story</p>
        </div>
        <div class="story">
        <img src="./image/luffy.jpeg" alt="">
            <p>Post Story</p>
        </div>

     </div>


  
    <?php
    $user_id = $_SESSION['user_id'];

    $select_profile = $db->prepare("SELECT * FROM user WHERE user_id= ?");
    $select_profile->execute([$user_id]);
    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="write-post-container">
         <div class="user-profile">
             <img src="./image/pic.png" alt="">
              <div>
              <p><?php echo $fetch_profile['username']; ?></p>
                   <small>Public</small>
              </div>
         </div>

         <div class="post-input-container">
         <form method="POST" action="././create_post.php" enctype="multipart/form-data">
         
                <textarea name="post" rows="4" placeholder="What's on your mind,  <?php echo $fetch_profile['username']; ?> ?" class="content"></textarea>
                <input type="file" name="image" accept="image/*">
                <button type="submit" class="button" name="new_post">Add Post</button>
          
         </form>

         </div>
    </div> 








    <?php foreach ($posts as $post): ?>
    <?php
    $user_id = $post['user_id'];

    $select_profile = $db->prepare("SELECT * FROM user WHERE user_id= ?");
    $select_profile->execute([$user_id]);
    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="post-container">
                        <div class="post-row">
                            <div class="user-profile">
                                <img src="<?php echo $post['image']; ?>" alt="">
                                    <div>
                                        <p><?php echo $fetch_profile['username']; ?></p>
                                        <small>1 hour ago</small>
                                        <small>
                                            <i class='bx bx-world'></i>
                                            Public
                                            <i class='bx bxs-down-arrow'></i>
                                        </small>
                                    </div>
                            </div>  <!-- user-profile -->


                            <div class="post">
                    


                            <div class="dropdown">
                            <i class="fa fa-ellipsis-v" onclick="toggleEditPost(this)"></i>
                                    <div class="content">
                                  
                                        <a href="edit_post.php?id=<?php echo $post['post_id'];?>" class="edit-post-link">Edit Post</a>
                                 
                                


                                    <a href="delete_post.php?id=<?php echo $post['post_id'];?>" class="edit-post-link">Delete Post</a>
                                   
                                    </div>
                                </div>
                            </div> <!-- post -->

                         
        </div> <!-- post-row -->
        
  
        <p class="post-text">
            <?php echo htmlspecialchars($post['post']); ?>
            <?php if (!empty($post['image'])): ?>
                <img src="<?php echo $post['image']; ?>" alt="" class="post-img">
            <?php endif; ?>
        </p>
    </div> <!-- post-container -->

    <script>
        function toggleEditPost(ellipsisIcon) {
            var dropdown = ellipsisIcon.closest('.dropdown');
            var content = dropdown.querySelector('.content');
            
            // Toggle visibility of the dropdown content
            content.style.display = (content.style.display === 'none' || content.style.display === '') ? 'block' : 'none';
        }
    </script>
<?php endforeach; ?>






    </div> <!--main-content-->







   























<!-- 
         <div class="post-container">
            <div class="post-row">
                                     <div class="user-profile">                         
                                            <img src="image/pic.png" alt="">
                                            <div>
                                                <p>john lloyd C Daroy</p>
                                                <small>1 hours ago</small>

                                                <small>
                                                    <i class='bx bx-world' ></i>
                                                    Public 
                                                    <i class='bx bxs-down-arrow'></i>
                                                </small>
                                            </div>
                                                
                                    </div>
                                    <i class="fa fa-ellipsis-v"></i>

            </div>
                                  

                                    <p class="post-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Fugit architecto animi esse vel quos accusantium, 
                                    eius veritatis. Adipisci provident reiciendis iste impedit veritatis 
                                    natus neque a eos? Repudiandae, porro debitis.
                                    <img src="image/wallpaper.jpg" alt="" class="post-img">
                                    </p>

                                    
        

          
         Other post content goes here 
    </div> -->

  


    <!-- More HTML content -->
            
       























                <!-- right side bar -->
            <div class="right-sidebar">
         
            </div> <!-- right-side bar -->





  </div> <!-- container -->

 
</body>
</html>

