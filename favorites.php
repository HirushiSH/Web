<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};


if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_favorites_item = $conn->prepare("DELETE FROM `favorites` WHERE id = ?");
   $delete_favorites_item->execute([$delete_id]);
   header('location:favorites.php');

}

if(isset($_GET['delete_all'])){

   $delete_favorites_item = $conn->prepare("DELETE FROM `favorites` WHERE user_id = ?");
   $delete_favorites_item->execute([$user_id]);
   header('location:favorites.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>favorites</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="favorites">

   <h1 class="title"></h1>

   <div class="box-container">

   <?php
      $grand_total = 0;
      $select_favorites = $conn->prepare("SELECT * FROM `favorites` WHERE user_id = ?");
      $select_favorites->execute([$user_id]);
      if($select_favorites->rowCount() > 0){
         while($fetch_favorites = $select_favorites->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" method="POST" class="box">
      <a href="favorites.php?delete=<?= $fetch_favorites['id']; ?>" class="fas fa-times" onclick="return confirm('delete this from favorites?');"></a>
      <img src="uploaded_img/<?= $fetch_favorites['image']; ?>" alt="">
      <div class="name"><?= $fetch_favorites['name']; ?></div>
      <input type="hidden" name="pid" value="<?= $fetch_favorites['pid']; ?>">
      <input type="hidden" name="p_name" value="<?= $fetch_favorites['name']; ?>">
      <input type="hidden" name="p_image" value="<?= $fetch_favorites['image']; ?>">
      <a href="view_page.php?pid=<?= $fetch_blogs['id']; ?>" class="btn">SEE MORE</a>
   </form>
   <?php

      }
   }else{
      echo '<p class="empty">your favorites is empty</p>';
   }
   ?>
   </div>

</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>