<?php
include "../config/db.php";
include "../includes/header.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $token = bin2hex(random_bytes(16));

    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        $error = "Email already registered.";
    } else {

        mysqli_query($conn,
            "INSERT INTO users (email, verification_token)
             VALUES ('$email', '$token')"
        );

        $link = "http://localhost/beads_and_bonds/auth/verify.php?token=$token";
    }
}
?>

<div class="container auth-box">
    <h2>Sign Up</h2>

    <?php if(isset($error)): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <?php if(isset($link)): ?>
        <p>Email verification link (simulated):</p>
        <a href="<?= $link ?>"><?= $link ?></a>
    <?php else: ?>
        <form method="POST">
            <input type="email" name="email" required placeholder="Email">
            <button class="btn">Verify Email</button>
        </form>
    <?php endif; ?>
</div>

<?php include "../includes/footer.php"; ?>