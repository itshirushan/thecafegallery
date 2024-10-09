<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <section class="flex">

      <a href="staff_dashboard.php" class="logo">STAFFPANEL</a>

      <nav class="navbar">
         <a href="staff_dashboard.php">Home</a>
         <a href="reservation.php">Reservations</a>
         <a href="place_orders.php">Orders</a>
         <a href="messages.php">Message</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `staff` WHERE id = ?");
            $select_profile->execute([$staff_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="update_profile.php" class="btn">update profile</a>
         <div class="flex-btn">
            <a href="staff_login.php" class="option-btn">login</a>
         </div>
         <a href="../components/staff_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>
      </div>

   </section>

</header>
