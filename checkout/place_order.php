<?php
session_start();
include "../config/db.php";

/* ---------- LOGIN CHECK ---------- */
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$address = mysqli_real_escape_string($conn, $_POST['address']);
$payment = mysqli_real_escape_string($conn, $_POST['payment']);

$total = 0;

/* ---------- CART TOTAL ---------- */
$cart = mysqli_query($conn,
    "SELECT products.price, cart.quantity
     FROM cart
     JOIN products ON cart.product_id = products.id
     WHERE cart.user_id = $user_id"
);

while ($row = mysqli_fetch_assoc($cart)) {
    $total += $row['price'] * $row['quantity'];
}

if ($total <= 0) {
    header("Location: ../cart/view.php");
    exit();
}

$delivery_date = date('Y-m-d', strtotime('+7 days'));

/* ---------- INSERT ORDER ---------- */
mysqli_query($conn,
    "INSERT INTO orders (user_id, total, address, payment_method, delivery_date)
     VALUES ($user_id, $total, '$address', '$payment', '$delivery_date')"
);

/* ---------- CLEAR CART ---------- */
mysqli_query($conn, "DELETE FROM cart WHERE user_id = $user_id");

/* ---------- REDIRECT ---------- */
header("Location: ../orders/view.php");
exit();