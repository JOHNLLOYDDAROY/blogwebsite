<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toggle Edit Post</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .edit-post-link {
            display: none;
        }
        
.dropdown{
    display: inline-block;
}
.dropdown button{
    background-color: hsl(0, 0%, 80%);
    color: white;
    padding: 20px 35px; 
    border: none;
    cursor: pointer;
}
.dropdown a{
    display: block;
    color: black;
    text-decoration: none;
    padding: 10px 15px;
}
.dropdown .content{
    display: none;
    position: absolute;
    background-color: hsl(0, 0%, 95%);
    min-width: 100px;
    box-shadow: 2px 2px 5px hsla(0, 0%, 0%, 0.8);
}

    </style>
</head>
<body>

   
<div class="dropdown">
        <button>Food</button>
        <div class="content">
            <a href="edit_post.php">Edit-post</a>
            <a href="delete-post.php">Delete Post</a>
        
        </div>
    </div>


</body>
</html>
