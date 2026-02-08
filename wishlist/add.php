<?php
session_start();
include "../config/db.php";

$user_id = $_SESSION['user_id'];

/* Accept product_id safely (GET because link/button sends id) */
$product_id = intval($_GET['id']);

mysqli_query($conn,
    "INSERT IGNORE INTO wishlist (user_id, product_id)
     VALUES ($user_id, $product_id)"
);

/* Redirect to wishlist page */
header("Location: view.php");
exit;