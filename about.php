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
   <title>about</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>about us</h3>
   <p><a href="home.php">home</a> <span> / about</span></p>
</div>

<!-- about section starts  -->

<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/about-img.png" alt="">
      </div>

      <div class="content">
         <h3>why choose us?</h3>
         <p>The Gallery Café, situated in central Colombo, is a well-loved eatery celebrated for its superb cuisine and exceptional service. 
            We aim to offer every guest an unforgettable dining experience through a combination of delectable dishes, a charming atmosphere, and top-notch customer care.</p>
      </div>

      <div class="image">
         <img src="images/table-img.png" alt="">
      </div>

      <div class="content">
         <h3>Our Table Capacities</h3>
         <p>We provide a variety of table options to cater to different group sizes and preferences. Our table capacities include two-seater tables, perfect for couples or intimate dining experiences; 
            four-seater tables, ideal for small families or groups of friends; six-seater tables, suitable for larger families or small gatherings; eight-seater tables, 
            great for medium-sized groups or celebrations; and ten-seater tables, best for large gatherings, parties, or corporate events.</p>
      </div>

      <div class="image">
         <img src="images/parking-img.png" alt="">
      </div>

      <div class="content">
         <h3>Our Parking Availability</h3>
         <p>We understand the necessity of convenient parking for our guests. The Gallery Café has plenty of on-site parking spots available right at the restaurant. For added convenience, 
            we offer valet parking services for a nominal fee. Additional parking can be found in nearby lots within a short walking distance. We also have designated handicap accessible 
            parking spaces near the entrance for guests with disabilities, as well as secure bicycle racks for those who opt for eco-friendly transportation.</p>
      </div>

   </div>

</section>

<!-- about section ends -->

<!-- steps section starts  -->

<section class="steps">

   <h1 class="title">simple steps</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/step-1.png" alt="">
         <h3>choose order</h3>
         <p>Choose from our exquisite menu and place your order.</p>
      </div>

      <div class="box">
         <img src="images/step-2.png" alt="">
         <h3>reserve table</h3>
         <p>Reserve your table now for an unforgettable dining experience.</p>
      </div>

      <div class="box">
         <img src="images/step-3.png" alt="">
         <h3>enjoy food</h3>
         <p>Savor the delicious flavors and enjoy your meal.</p>
      </div>

   </div>

</section>

<!-- steps section ends -->

<!-- reviews section starts  -->

<section class="reviews">

   <h1 class="title">customer's reivews</h1>

   <div class="swiper reviews-slider">

      <div class="swiper-wrapper">

         <div class="swiper-slide slide">
            <img src="images/pic-1.png" alt="">
            <p>The Bloom Bistro delivers a remarkable dining experience. The dishes are delightful, and the atmosphere suits both casual and formal events. The service is warm and efficient. Highly recommend!</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Niomi</h3>
         </div>

         <div class="swiper-slide slide">
            <img src="images/pic-2.png" alt="">
            <p>The Rustic Table provides an outstanding dining experience. The cuisine is delicious, and the setting is ideal for any gathering. The team is welcoming and prompt. Highly recommend!</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Kaily</h3>
         </div>

         <div class="swiper-slide slide">
            <img src="images/pic-3.png" alt="">
            <p>The Ocean View offers a superb dining experience. The seafood is fresh, and the scenery is perfect for all occasions. The crew is friendly and helpful. Highly recommend!</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Lisa</h3>
         </div>

         <div class="swiper-slide slide">
            <img src="images/pic-4.png" alt="">
            <p>The Garden Terrace ensures an excellent dining experience. The menu is diverse, and the environment is great for any event. The staff is courteous and quick. Highly recommend!</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Sahara</h3>
         </div>

      </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

<!-- reviews section ends -->






<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->=






<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   grabCursor: true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
      slidesPerView: 1,
      },
      700: {
      slidesPerView: 2,
      },
      1024: {
      slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>