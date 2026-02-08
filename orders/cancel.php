<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$order_id = intval($_POST['order_id']);

/* Update order status safely */
mysqli_query($conn,
    "UPDATE orders 
     SET status = 'Cancelled'
     WHERE id = $order_id AND user_id = $user_id"
);

header("Location: view.php");
exit;