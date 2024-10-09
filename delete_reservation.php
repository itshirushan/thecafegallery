<?php
include 'components/connect.php';

session_start();

if(!isset($_SESSION['user_id'])){
   header('location:home.php');
   exit();
}

$user_id = $_SESSION['user_id'];

if(isset($_GET['id'])){
   $reservation_id = $_GET['id'];

   // Fetch reservation details
   $fetch_reservation = $conn->prepare("SELECT * FROM reservation WHERE id = ? AND user_id = ?");
   $fetch_reservation->execute([$reservation_id, $user_id]);
   $reservation = $fetch_reservation->fetch(PDO::FETCH_ASSOC);

   if($reservation){
      // Delete reservation
      $delete_reservation = $conn->prepare("DELETE FROM reservation WHERE id = ? AND user_id = ?");
      $delete_reservation->execute([$reservation_id, $user_id]);
   }
}

header('location:profile.php');
exit();
?>
