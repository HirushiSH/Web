<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['add_to_favorites'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);

   $check_favorites_numbers = $conn->prepare("SELECT * FROM `favorites` WHERE name = ? AND user_id = ?");
   $check_favorites_numbers->execute([$p_name, $user_id]);

   if($check_favorites_numbers->rowCount() > 0){
      $message[] = 'already added to favorites!';
   }else{
      $insert_favorites = $conn->prepare("INSERT INTO `favorites`(user_id, pid, name, image) VALUES(?,?,?,?)");
      $insert_favorites->execute([$user_id, $pid, $p_name, $p_image]);
      $message[] = 'added to favorites!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>category</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="blogs">

   <h1 class="title">blogs</h1>

   <div class="box-container">

   <?php
      $category_name = $_GET['category'];
      $select_blogs = $conn->prepare("SELECT * FROM `blogs` WHERE category = ?");
      $select_blogs->execute([$category_name]);
      if($select_blogs->rowCount() > 0){
         while($fetch_blogs = $select_blogs->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" class="box" method="POST">
      <a href="view_page.php?pid=<?= $fetch_blogs['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_blogs['image']; ?>" alt="">
      <div class="name"><?= $fetch_blogs['name']; ?></div>
      <input type="hidden" name="pid" value="<?= $fetch_blogs['id']; ?>">
      <input type="hidden" name="p_name" value="<?= $fetch_blogs['name']; ?>">
      <input type="hidden" name="p_image" value="<?= $fetch_blogs['image']; ?>">
      <input type="submit" value="add to favorites" class="option-btn" name="add_to_favorites">
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">no blogs available!</p>';
      }
   ?>

   </div>

</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>