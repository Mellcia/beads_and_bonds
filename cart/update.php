<?php
include "../config/db.php";

$cid = $_POST['cid'];
$qty = $_POST['qty'];

mysqli_query($conn,
    "UPDATE cart SET quantity=$qty WHERE id=$cid"
);

header("Location: view.php");