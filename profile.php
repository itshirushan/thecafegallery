<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
   exit(); // Always use exit() after a header redirect
}

// Fetch user profile
$fetch_profile = $conn->prepare("SELECT * FROM users WHERE id = ?");
$fetch_profile->execute([$user_id]);
$fetch_profile = $fetch_profile->fetch(PDO::FETCH_ASSOC);

// Fetch user reservations
$fetch_reservation = $conn->prepare("SELECT * FROM reservation WHERE user_id = ?");
$fetch_reservation->execute([$user_id]);
$reservation = $fetch_reservation->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Profile</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/reservation.css">
</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<section class="user-details">
   <div class="user">
      <img src="images/user-icon.png" alt="User Icon">
      <p><i class="fas fa-user"></i><span><?= htmlspecialchars($fetch_profile['name']); ?></span></p>
      <p><i class="fas fa-phone"></i><span><?= htmlspecialchars($fetch_profile['number']); ?></span></p>
      <p><i class="fas fa-envelope"></i><span><?= htmlspecialchars($fetch_profile['email']); ?></span></p>
      <a href="update_profile.php" class="btn">Update Info</a>
      <p class="address"><i class="fas fa-map-marker-alt"></i><span><?php if($fetch_profile['address'] == ''){echo 'Please enter your address';}else{echo htmlspecialchars($fetch_profile['address']);} ?></span></p>
      <a href="update_address.php" class="btn">Update Address</a>
   </div>
</section>

<!-- Reservation section starts -->
<section class="user-reservation">
   <h3>Your Reservations</h3>
   <?php if (count($reservation) > 0): ?>
   
        <table class="reservation-table" > 
            <thead>
               <tr>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Guests</th>
                  <th>Message</th>
               </tr>
            </thead>
            <tbody>
               <?php foreach ($reservation as $res): ?>
                  <tr>
                     <td><?= htmlspecialchars($res['date']); ?></td>
                     <td><?= htmlspecialchars($res['time']); ?></td>
                     <td><?= htmlspecialchars($res['guests']); ?></td>
                     <td><?= htmlspecialchars($res['message']); ?></td>
                  </tr>
               <?php endforeach; ?>
            </tbody>
         </table>
      </div>
     
      <div class="reservation-actions">
         <a href="edit_reservation.php?id=<?= $res['id']; ?>" class="btn">Edit</a>
         <a href="delete_reservation.php?id=<?= $res['id']; ?>" class="btn" onclick="return confirm('Are you sure you want to delete this reservation?');">Delete</a>
      </div>
   <?php else: ?>
      <p>You have no reservations yet.</p>
   <?php endif; ?>
</section>
   </div>
<!-- Reservation section ends -->

<?php include 'components/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
