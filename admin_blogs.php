<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_blog'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select_blogs = $conn->prepare("SELECT * FROM `blogs` WHERE name = ?");
   $select_blogs->execute([$name]);

   if($select_blogs->rowCount() > 0){
      $message[] = 'blog title already exist!';
   }else{

      $insert_blogs = $conn->prepare("INSERT INTO `blogs`(name, category, details, image) VALUES(?,?,?,?)");
      $insert_blogs->execute([$name, $category, $details, $image]);

      if($insert_blogs){
         if($image_size > 2000000){
            $message[] = 'image size is too large!';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'new blog added!';
         }

      }

   }

};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $select_delete_image = $conn->prepare("SELECT image FROM `blogs` WHERE id = ?");
   $select_delete_image->execute([$delete_id]);
   $fetch_delete_image = $select_delete_image->fetch(PDO::FETCH_ASSOC);
   unlink('uploaded_img/'.$fetch_delete_image['image']);
   $delete_blogs = $conn->prepare("DELETE FROM `blogs` WHERE id = ?");
   $delete_blogs->execute([$delete_id]);
   $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
   $delete_wishlist->execute([$delete_id]);
   header('location:admin_blogs.php');


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>blogs</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="add-blogs">

   <h1 class="title">add new blog</h1>

   <form action="" method="POST" enctype="multipart/form-data">
      <div class="flex">
         <div class="inputBox">
         <input type="text" name="name" class="box" required placeholder="enter title">
         <select name="category" class="box" required>
            <option value="" selected disabled>select category</option>
               <option value="rice">rice</option>
               <option value="pasta">pasta</option>
               <option value="burger">burger</option>
         </select>
         </div>
         <div class="inputBox">
         <input type="file" name="image" required class="box" accept="image/jpg, image/jpeg, image/png">
         </div>
      </div>
      <textarea name="details" class="box" required placeholder="enter blog deatails" cols="30" rows="10"></textarea>
      <input type="submit" class="btn" value="add blog" name="add_blog">
   </form>

</section>

<section class="show-blogs">

   <h1 class="title">Added Blogs</h1>

   <div class="box-container">

   <?php
      $show_blogs = $conn->prepare("SELECT * FROM `blogs`");
      $show_blogs->execute();
      if($show_blogs->rowCount() > 0){
         while($fetch_blogs = $show_blogs->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <div class="box">
      <img src="uploaded_img/<?= $fetch_blogs['image']; ?>" alt="">
      <div class="name"><?= $fetch_blogs['name']; ?></div>
      <div class="cat"><?= $fetch_blogs['category']; ?></div>
      <div class="details"><?= $fetch_blogs['details']; ?></div>
      <div class="flex-btn">
         <a href="admin_update_blogs.php?update=<?= $fetch_blogs['id']; ?>" class="option-btn">update</a>
         <a href="admin_blogs.php?delete=<?= $fetch_blogs['id']; ?>" class="delete-btn" onclick="return confirm('delete this blog?');">delete</a>
      </div>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">no blogs added yet!</p>';
   }
   ?>

   </div>

</section>

<script src="js/script.js"></script>

</body>
</html>