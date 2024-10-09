<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
    exit();
}

if (isset($_POST['add_event'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_img/'.$image;

    if (move_uploaded_file($image_tmp_name, $image_folder)) {
        $add_event = $conn->prepare("INSERT INTO `events` (title, description, image) VALUES (?, ?, ?)");
        $add_event->execute([$title, $description, $image]);
        $message[] = 'Event added successfully!';
    } else {
        $message[] = 'Failed to upload image!';
    }
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_event = $conn->prepare("DELETE FROM `events` WHERE id = ?");
    $delete_event->execute([$delete_id]);
    header('location:events.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Events</title>

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
   <h3>Manage Events</h3>
   <p><a href="dashboard.php">dashboard</a> <span> / events</span></p>
</div>

<!-- events section starts  -->
<section class="events">

   

   <?php
   if (isset($message)) {
      foreach ($message as $msg) {
         echo '<p class="message">' . $msg . '</p>';
      }
   }
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <input type="text" name="title" class="box" placeholder="Event title" required>
      <textarea name="description" class="box" placeholder="Event description" required></textarea>
      <input type="file" name="image" class="box" accept="image/*" required>
      <input type="submit" value="Add Event" name="add_event" class="btn">
   </form>

   <div class="box-container">

      <?php
         $select_events = $conn->prepare("SELECT * FROM `events`");
         $select_events->execute();
         if($select_events->rowCount() > 0){
            while($fetch_events = $select_events->fetch(PDO::FETCH_ASSOC)){
      ?>
      <div class="box">
         <img src="../uploaded_img/<?= $fetch_events['image']; ?>" alt="">
         <div class="name"><?= $fetch_events['title']; ?></div>
         <div class="description"><?= $fetch_events['description']; ?></div>
         <a href="events.php?delete=<?= $fetch_events['id']; ?>" class="delete-btn" onclick="return confirm('Delete this event?');">Delete</a>
      </div>
      <?php
            }
         }else{
            echo '<p class="empty">No events available at the moment!</p>';
         }
      ?>

   </div>

</section>
<!-- events section ends -->

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>
