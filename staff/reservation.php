<?php

include '../components/connect.php';

session_start();

$staff_id = $_SESSION['staff_id'];

if (!isset($staff_id)) {
    header('location:staff_login.php');
    exit();
}

if (isset($_POST['update_reservation'])) {
    $reservation_id = $_POST['reservation_id'];
    $states = $_POST['states'];
    $update_status = $conn->prepare("UPDATE `reservation` SET `states` = ? WHERE `id` = ?");
    $update_status->execute([$states, $reservation_id]);
    $message[] = 'Reservation status updated!';
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_reservation = $conn->prepare("DELETE FROM `reservation` WHERE `id` = ?");
    $delete_reservation->execute([$delete_id]);
    header('location:reservation.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations</title>

    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="../css/staff_style.css">
    <style>
        .box-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .box {
            background-color: #f7f7f7;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            width: calc(33.333% - 20px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            font-size: 20px;
        }
        .box p {
            margin: 10px 0;
        }
        .box .flex-btn {
            display: flex;
            gap: 10px;
        }
        .box .btn, .box .delete-btn {
            flex: 1;
            text-align: center;
            padding: 10px 0;
            border-radius: 5px;
            cursor: pointer;
            color: #fff;
            border-color:black;
        }
        .box .btn {
            background-color: #f39c12;
        }
        .box .delete-btn {
            background-color: #e74c3c;
        }
    </style>
</head>
<body>

<?php include '../components/staff_header.php' ?>

<!-- Reservations section starts -->
<section class="reservations">

    <h1 class="heading">Reservations</h1>

    <?php
    if (isset($message)) {
        foreach ($message as $msg) {
            echo '<p class="message">' . $msg . '</p>';
        }
    }
    ?>

    <div class="box-container">

    <?php
    $select_reservations = $conn->prepare("SELECT * FROM `reservation`");
    $select_reservations->execute();
    if ($select_reservations->rowCount() > 0) {
        while ($fetch_reservations = $select_reservations->fetch(PDO::FETCH_ASSOC)) {
    ?>
    <div class="box">
        <p> User ID : <span><?= $fetch_reservations['user_id']; ?></span> </p>
        <p> Name : <span><?= $fetch_reservations['name']; ?></span> </p>
        <p> Email : <span><?= $fetch_reservations['email']; ?></span> </p>
        <p> Number : <span><?= $fetch_reservations['number']; ?></span> </p>
        <p> Date : <span><?= $fetch_reservations['date']; ?></span> </p>
        <p> Time : <span><?= $fetch_reservations['time']; ?></span> </p>
        <p> Guests : <span><?= $fetch_reservations['guests']; ?></span> </p>
        <p> Message : <span><?= $fetch_reservations['message']; ?></span> </p>
        <form action="" method="POST">
            <input type="hidden" name="reservation_id" value="<?= $fetch_reservations['id']; ?>">
            <select name="states" class="drop-down">
                <option value="pending" <?= $fetch_reservations['states'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="reserved" <?= $fetch_reservations['states'] == 'reserved' ? 'selected' : '' ?>>Reserved</option>
            </select>
            <div class="flex-btn">
                <input type="submit" value="Update" class="btn" name="update_reservation">
                <a href="reservation.php?delete=<?= $fetch_reservations['id']; ?>" class="delete-btn" onclick="return confirm('Delete this reservation?');">Delete</a>
            </div>
        </form>
    </div>
    <?php
        }
    }
?>
    </div>

</section>
<!-- Reservations section ends -->

<!-- Custom JS file link -->
<script src="../js/staff_script.js"></script>

</body>
</html>
