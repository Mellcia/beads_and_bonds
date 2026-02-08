<?php
include "../config/db.php";
include "../includes/header.php";

if (isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit;
}

$error = "";
if (isset($_SESSION['auth_error'])) {
    $error = $_SESSION['auth_error'];
    unset($_SESSION['auth_error']);
}

if (isset($_SESSION['auth_success'])) {
    $success = $_SESSION['auth_success'];
    unset($_SESSION['auth_success']);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_name'] = $user['name'];

        header("Location: ../index.php");
        exit;
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<div class="container auth-box">
    <h2>Login</h2>

    <?php if ($error): ?>
        <p style="color:red"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST">
        <input type="email" name="email" required placeholder="Email">
        <input type="password" name="password" required placeholder="Password">
        <button class="btn">Login</button>
    </form>

    <p style="margin-top:10px;">
        New user? <a href="signup.php">Sign up</a>
    </p>
</div>

<?php include "../includes/footer.php"; ?>