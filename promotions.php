<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Promotions</title>

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>Promotions</h3>
   <p><a href="home.php">home</a> <span> / promotions</span></p>
</div>

<!-- promotions section starts  -->
<section class="products">

   <h1 class="title">Current Promotions</h1>

   <div class="box-container">

      <?php
         $select_promotions = $conn->prepare("SELECT * FROM `promotions`");
         $select_promotions->execute();
         if($select_promotions->rowCount() > 0){
            while($fetch_promotions = $select_promotions->fetch(PDO::FETCH_ASSOC)){
      ?>
      <div class="box">
         <img src="uploaded_img/<?= $fetch_promotions['image']; ?>" alt="">
         <div class="name"><?= $fetch_promotions['title']; ?></div>
         <div class="description"><?= $fetch_promotions['description']; ?></div>
      </div>
      <?php
            }
         }else{
            echo '<p class="empty">No promotions available at the moment!</p>';
         }
      ?>

   </div>

</section>
<!-- promotions section ends -->

<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
