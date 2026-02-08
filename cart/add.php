<?php
session_start();
include "../config/db.php";

$user_id = $_SESSION['user_id'];
// Accept product_id from GET (Add to Cart) or POST (Buy)
if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
} elseif (isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']);
} else {
    die("Product ID not found");
}

$check = mysqli_query($conn,
    "SELECT * FROM cart WHERE user_id=$user_id AND product_id=$product_id"
);

if (mysqli_num_rows($check) > 0) {
    mysqli_query($conn,
        "UPDATE cart SET quantity = quantity + 1
         WHERE user_id=$user_id AND product_id=$product_id"
    );
} else {
    mysqli_query($conn,
        "INSERT INTO cart (user_id, product_id, quantity)
         VALUES ($user_id, $product_id, 1)"
    );
}

header("Location: view.php");