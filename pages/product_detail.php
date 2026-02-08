<?php
include "../includes/header.php";
include "../config/db.php";

if (!isset($_GET['id'])) {
    header("Location: products.php");
    exit();
}

$id = intval($_GET['id']);
$query = mysqli_query($conn, "SELECT * FROM products WHERE id = $id");
$product = mysqli_fetch_assoc($query);

// Check login
$isLoggedIn = isset($_SESSION['user_id']);
?>

<div class="product-detail-container">

    <!-- PRODUCT IMAGE -->
    <div class="product-image">
        <img 
            src="../assets/images/<?php echo $product['image']; ?>" 
            alt="<?php echo $product['name']; ?>" 
            class="detail-img"
        >
    </div>

    <!-- PRODUCT INFO -->
    <div class="product-info">
        <h2><?php echo $product['name']; ?></h2>
        <p class="price">₹<?php echo $product['price']; ?></p>
        <p><?php echo $product['description']; ?></p>

        <div class="product-actions">

            <?php if ($isLoggedIn) { ?>

                <!-- ADD TO CART -->
                <a href="../cart/add.php?id=<?php echo $product['id']; ?>" class="cart-btn">
                    Add to Cart
                </a>

                <!-- ADD TO WISHLIST -->
                <a href="../wishlist/add.php?id=<?php echo $product['id']; ?>" class="wishlist-btn">
                    Add to Wishlist
                </a>

                <!-- BUY NOW -->
                <form action="../cart/add.php" method="POST">
                    <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                    <input type="hidden" name="price" value="<?= $product['price']; ?>">
                    <button class="buy-btn",type="submit">Buy</button>
                </form>

            <?php } else { ?>

                <!-- FORCE LOGIN -->
                <a href="../auth/login.php" class="cart-btn">
                    Login to Add to Cart
                </a>

                <a href="../auth/login.php" class="wishlist-btn">
                    Login to Wishlist
                </a>

                <a href="../auth/login.php" class="buy-btn">
                    Login to Buy
                </a>

            <?php } ?>

        </div>
    </div>

</div>

<?php include "../includes/footer.php"; ?>