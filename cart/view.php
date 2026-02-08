<?php
include "../includes/header.php";
include "../config/db.php";

$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn,
    "SELECT cart.id AS cid, products.*, cart.quantity
     FROM cart
     JOIN products ON cart.product_id = products.id
     WHERE cart.user_id = $user_id"
);

$total = 0;
?>

<div class="container">
    <h2>Your Cart</h2>

    <table class="cart-table">
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Total</th>
            <th>Action</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)):
            $subtotal = $row['price'] * $row['quantity'];
            $total += $subtotal;
        ?>
        <tr>
            <td><?= $row['name']; ?></td>
            <td>₹<?= $row['price']; ?></td>
            <td>
                <form method="POST" action="update.php">
                    <input type="hidden" name="cid" value="<?= $row['cid']; ?>">
                    <input type="number" name="qty" value="<?= $row['quantity']; ?>" min="1">
                    <button>Update</button>
                </form>
            </td>
            <td>₹<?= $subtotal; ?></td>
            <td><a href="remove.php?id=<?= $row['cid']; ?>">Remove</a></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h3>Grand Total: ₹<?= $total; ?></h3>

    <a href="../checkout/checkout.php" class="btn">Proceed to Checkout</a>
</div>

<?php include "../includes/footer.php"; ?>