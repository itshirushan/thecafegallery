<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
   exit();
}

// Fetch the admin profile
$select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
$select_profile->execute([$admin_id]);
$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- Admin dashboard section starts -->
<section class="dashboard">

   <h1 class="heading">Dashboard</h1>

   <div class="box-container">

      <div class="box">
         <h3>Welcome!</h3>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="update_profile.php" class="btn">Update Profile</a>
      </div>

      <div class="box">
         <?php
            $select_orders = $conn->prepare("SELECT * FROM `orders`");
            $select_orders->execute();
            $numbers_of_orders = $select_orders->rowCount();
         ?>
         <h3><?= $numbers_of_orders; ?></h3>
         <p>Total Orders</p>
         <a href="orders.php" class="btn">See Orders</a>
      </div>

      <div class="box">
         <?php
            $select_products = $conn->prepare("SELECT * FROM `products`");
            $select_products->execute();
            $numbers_of_products = $select_products->rowCount();
         ?>
         <h3><?= $numbers_of_products; ?></h3>
         <p>Products Added</p>
         <a href="products.php" class="btn">See Products</a>
      </div>

      <div class="box">
         <?php
            $select_users = $conn->prepare("SELECT * FROM `users`");
            $select_users->execute();
            $numbers_of_users = $select_users->rowCount();
         ?>
         <h3><?= $numbers_of_users; ?></h3>
         <p>User Accounts</p>
         <a href="users_accounts.php" class="btn">See Users</a>
      </div>

      <div class="box">
         <?php
            $select_staff = $conn->prepare("SELECT * FROM `staff`");
            $select_staff->execute();
            $numbers_of_staff = $select_staff->rowCount();
         ?>
         <h3><?= $numbers_of_staff; ?></h3>
         <p>Staff Accounts</p>
         <a href="staff_accounts.php" class="btn">See Staff</a>
      </div>

      <div class="box">
         <?php
            $select_admins = $conn->prepare("SELECT * FROM `admin`");
            $select_admins->execute();
            $numbers_of_admins = $select_admins->rowCount();
         ?>
         <h3><?= $numbers_of_admins; ?></h3>
         <p>Admin Accounts</p>
         <a href="admin_accounts.php" class="btn">See Admins</a>
      </div>

      <div class="box">
         <?php
            $select_messages = $conn->prepare("SELECT * FROM `messages`");
            $select_messages->execute();
            $numbers_of_messages = $select_messages->rowCount();
         ?>
         <h3><?= $numbers_of_messages; ?></h3>
         <p>New Messages</p>
         <a href="messages.php" class="btn">See Messages</a>
      </div>

      <div class="box">
         <?php
            $select_promotions = $conn->prepare("SELECT * FROM `promotions`");
            $select_promotions->execute();
            $numbers_of_promotions = $select_promotions->rowCount();
         ?>
         <h3><?= $numbers_of_promotions; ?></h3>
         <p>Promotions</p>
         <a href="promotions.php" class="btn">See Promotions</a>
      </div>

      <div class="box">
         <?php
            $select_events = $conn->prepare("SELECT * FROM `events`");
            $select_events->execute();
            $numbers_of_events = $select_events->rowCount();
         ?>
         <h3><?= $numbers_of_promotions; ?></h3>
         <p>Events</p>
         <a href="events.php" class="btn">Events</a>
      </div>

   </div>

</section>
<!-- Admin dashboard section ends -->

<!-- Custom JS file link -->
<script src="../js/admin_script.js"></script>

</body>
</html>
