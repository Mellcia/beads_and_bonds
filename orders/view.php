<?php
include "../includes/header.php";
include "../config/db.php";

$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn,
    "SELECT * FROM orders 
     WHERE user_id=$user_id 
     ORDER BY created_at DESC"
);
?>

<div class="container">
    <h2>Your Orders</h2>

    <?php if(mysqli_num_rows($result) == 0): ?>
        <p>You have not placed any orders yet.</p>
    <?php endif; ?>

    <?php while($row = mysqli_fetch_assoc($result)): ?>
        <div class="order-card">
            <p><strong>Order ID:</strong> <?= $row['id']; ?></p>
            <p><strong>Total:</strong> ₹<?= $row['total']; ?></p>
            <p><strong>Payment Method:</strong> <?= $row['payment_method']; ?></p>
            <p><strong>Delivery Date:</strong> <?= $row['delivery_date']; ?></p>
            <p><strong>Delivery Address:</strong> <?= htmlspecialchars($row['address']); ?></p>
            <p><strong>Status:</strong> <?= $row['status']; ?></p>

            <!-- CANCEL ORDER BUTTON -->
            <?php if ($row['status'] !== 'Delivered' && $row['status'] !== 'Cancelled'): ?>
                <form action="cancel.php" method="POST" onsubmit="return confirm('Are you sure you want to cancel this order?');">
                    <input type="hidden" name="order_id" value="<?= $row['id']; ?>">
                    <button type="submit" class="btn-cancel">Cancel Order</button>
                </form>
            <?php endif; ?>

            <?php if ($row['status'] === 'Cancelled'): ?>
                <p class="cancelled-text">This order has been cancelled.</p>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>
</div>

<?php include "../includes/footer.php"; ?>