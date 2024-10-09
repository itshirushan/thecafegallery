<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
    exit();
}

if (isset($_POST['add_promotion'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_img/'.$image;

    if (move_uploaded_file($image_tmp_name, $image_folder)) {
        $add_promotion = $conn->prepare("INSERT INTO `promotions` (title, description, image) VALUES (?, ?, ?)");
        $add_promotion->execute([$title, $description, $image]);
        $message[] = 'Promotion added successfully!';
    } else {
        $message[] = 'Failed to upload image!';
    }
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_promotion = $conn->prepare("DELETE FROM `promotions` WHERE id = ?");
    $delete_promotion->execute([$delete_id]);
    header('location:promotions.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Promotions</title>

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<!-- header section starts  -->
<?php include '../components/admin_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>Manage Promotions</h3>
   <p><a href="dashboard.php">dashboard</a> <span> / promotions</span></p>
</div>

<!-- promotions section starts  -->
<section class="promotions">

   

   <?php
   if (isset($message)) {
      foreach ($message as $msg) {
         echo '<p class="message">' . $msg . '</p>';
      }
   }
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <input type="text" name="title" class="box" placeholder="Promotion title" required>
      <textarea name="description" class="box" placeholder="Promotion description" required></textarea>
      <input type="file" name="image" class="box" accept="image/*" required>
      <input type="submit" value="Add Promotion" name="add_promotion" class="btn">
   </form>

   <div class="box-container">

      <?php
         $select_promotions = $conn->prepare("SELECT * FROM `promotions`");
         $select_promotions->execute();
         if($select_promotions->rowCount() > 0){
            while($fetch_promotions = $select_promotions->fetch(PDO::FETCH_ASSOC)){
      ?>
      <div class="box">
         <img src="../uploaded_img/<?= $fetch_promotions['image']; ?>" alt="">
         <div class="name"><?= $fetch_promotions['title']; ?></div>
         <div class="description"><?= $fetch_promotions['description']; ?></div>
         <a href="promotions.php?delete=<?= $fetch_promotions['id']; ?>" class="delete-btn" onclick="return confirm('Delete this promotion?');">Delete</a>
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

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>
