<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: /beads_and_bonds/auth/login.php");
    exit();
}
?>