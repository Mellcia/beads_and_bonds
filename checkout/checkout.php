<?php
include "../includes/header.php";
include "../config/db.php";

$user_id = $_SESSION['user_id'];

$cart = mysqli_query($conn,
    "SELECT products.price, cart.quantity
     FROM cart
     JOIN products ON cart.product_id = products.id
     WHERE cart.user_id = $user_id"
);

$total = 0;
while($c = mysqli_fetch_assoc($cart)) {
    $total += $c['price'] * $c['quantity'];
}
?>

<div class="container">
    <h2>Checkout</h2>

    <form method="POST" action="../checkout/place_order.php">
        <textarea name="address" required placeholder="Delivery Address"></textarea>

        <select name="payment" required>
            <option value="">Select Payment</option>
            <option>Cash on Delivery</option>
        </select>

        <h3>Total Payable: ₹<?= $total; ?></h3>

        <button class="btn">Place Order</button>
    </form>
</div>

<?php include "../includes/footer.php"; ?>