<?php
include "../includes/header.php";
include "../config/db.php";

/* Get selected category */
$category = isset($_GET['category']) ? $_GET['category'] : 'All';

/* Build query based on category */
if ($category == 'All') {
    $query = "SELECT * FROM products";
} else {
    $query = "SELECT * FROM products WHERE category = '$category'";
}

$result = mysqli_query($conn, $query);
?>

<div class="container">
    <h2 class="section-title">Our Collection</h2>

    <!-- CATEGORY FILTER -->
    <div class="category-filter">
    <a href="products.php?category=All"
       class="filter-btn <?php echo ($category=='All') ? 'active all-active' : ''; ?>">
       All
    </a>

    <a href="products.php?category=Bracelets"
       class="filter-btn <?php if($category=='Bracelets') echo 'active'; ?>">
       Bracelets
    </a>

    <a href="products.php?category=Earrings"
       class="filter-btn <?php if($category=='Earrings') echo 'active'; ?>">
       Earrings
    </a>

    <a href="products.php?category=Necklaces"
       class="filter-btn <?php if($category=='Necklaces') echo 'active'; ?>">
       Necklaces
    </a>
</div>

    <!-- PRODUCTS GRID -->
    <div class="products-grid">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="product-card">
                <img 
                    src="../assets/images/<?php echo $row['image']; ?>" 
                    alt="<?php echo $row['name']; ?>" 
                    class="product-img"
                >

                <h3><?php echo $row['name']; ?></h3>
                <p class="price">₹<?php echo $row['price']; ?></p>

                <a href="product_detail.php?id=<?php echo $row['id']; ?>" class="btn-sm">
                    View Details
                </a>
            </div>
        <?php } ?>
    </div>
</div>

<?php include "../includes/footer.php"; ?>