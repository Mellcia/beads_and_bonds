<?php
include "../includes/header.php";
include "../config/db.php";

$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn,
    "SELECT wishlist.id AS wid, products.*
     FROM wishlist
     JOIN products ON wishlist.product_id = products.id
     WHERE wishlist.user_id = $user_id"
);
?>

<div class="container">
    <h2>Your Wishlist</h2>

    <div class="product-grid">
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <div class="product-card">
                <img 
                src="../assets/images/<?= htmlspecialchars($row['image']); ?>" 
                alt="<?= htmlspecialchars($row['name']); ?>" 
                class="wishlist-img"
                >
                <h3><?= $row['name']; ?></h3>
                <p>₹<?= $row['price']; ?></p>

                <a href="remove.php?id=<?= $row['wid']; ?>" class="btn-outline">Remove</a>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include "../includes/footer.php"; ?>