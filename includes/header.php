<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Beads & Bonds</title>
    <link rel="stylesheet" href="/beads_and_bonds/assets/css/style.css">
    <script src="/beads_and_bonds/assets/js/main.js" defer></script>
</head>
<body>

<nav class="navbar">
    <h2>Beads & Bonds</h2>
    <ul>
        <li>
            <a href="/beads_and_bonds/index.php"
               class="<?= ($currentPage == 'index.php') ? 'active-nav' : '' ?>">
               Home
            </a>
        </li>

        <li>
            <a href="/beads_and_bonds/pages/products.php"
               class="<?= ($currentPage == 'products.php') ? 'active-nav' : '' ?>">
               Products
            </a>
        </li>

        <?php if(isset($_SESSION['user_id'])): ?>
            <li>
                <a href="/beads_and_bonds/wishlist/view.php"
                   class="<?= ($currentPage == 'view.php' && strpos($_SERVER['REQUEST_URI'],'wishlist') !== false) ? 'active-nav' : '' ?>">
                   Wishlist
                </a>
            </li>

            <li>
                <a href="/beads_and_bonds/cart/view.php"
                   class="<?= ($currentPage == 'view.php' && strpos($_SERVER['REQUEST_URI'],'cart') !== false) ? 'active-nav' : '' ?>">
                   Cart
                </a>
            </li>

            <li>
                <a href="/beads_and_bonds/orders/view.php"
                   class="<?= ($currentPage == 'view.php' && strpos($_SERVER['REQUEST_URI'],'orders') !== false) ? 'active-nav' : '' ?>">
                   Orders
                </a>
            </li>
        <?php endif; ?>

        <?php if(isset($_SESSION['user_id'])): ?>
            <li>
                <?php
                $userName = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Guest';
                ?>
                Hi, <?= htmlspecialchars($userName); ?>
            </li>
            <li><a href="/beads_and_bonds/auth/logout.php">Logout</a></li>
        <?php else: ?>
            <li>
                <a href="/beads_and_bonds/auth/login.php"
                   class="<?= ($currentPage == 'login.php') ? 'active-nav' : '' ?>">
                   Login
                </a>
            </li>
        <?php endif; ?>

        <li>
            <a href="/beads_and_bonds/pages/about.php"
               class="<?= ($currentPage == 'about.php') ? 'active-nav' : '' ?>">
               About
            </a>
        </li>
    </ul>
</nav>