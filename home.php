<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="home-bg">

   <section class="home">

      <div class="content">
         <span>Food Recipies</span>
         <h3>All your favorite recipies here </h3>
         <p></p>
         <a href="about.php" class="btn">about us</a>
      </div>

   </section>

</div>

<section class="home-category">

   <h1 class="title">Category</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/cat-1.jpg" alt="">
         <h3>rice</h3>
         <p></p>
         <a href="category.php?category=fruits" class="btn">rice</a>
      </div>

      <div class="box">
         <img src="images/cat-2.jpg" alt="">
         <h3>pasta</h3>
         <p></p>
         <a href="category.php?category=meat" class="btn">pasta</a>
      </div>

      <div class="box">
         <img src="images/cat-3.jpg" alt="">
         <h3>burger</h3>
         <p></p>
         <a href="category.php?category=vegitables" class="btn">burger</a>
      </div>

   </div>

</section>

<section class="blogs">

   <h1 class="title">Trending</h1>

   <div class="box-container">

   <?php
      $select_blogs = $conn->prepare("SELECT * FROM `blogs` LIMIT 6");
      $select_blogs->execute();
      if($select_blogs->rowCount() > 0){
         while($fetch_blogs = $select_blogs->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" class="box" method="POST">
      <img src="uploaded_img/<?= $fetch_blogs['image']; ?>" alt="">
      <div class="name"><?= $fetch_blogs['name']; ?></div>
      <input type="hidden" name="pid" value="<?= $fetch_blogs['id']; ?>">
      <input type="hidden" name="p_name" value="<?= $fetch_blogs['name']; ?>">
      <input type="hidden" name="p_image" value="<?= $fetch_blogs['image']; ?>">
      <a href="view_page.php?pid=<?= $fetch_blogs['id']; ?>" class="btn">SEE MORE</a>     
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">no blogs added yet!</p>';
   }
   ?>

   </div>

</section>







<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>