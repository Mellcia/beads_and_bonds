<?php
include "../config/db.php";
include "../includes/header.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if email already exists
    $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");

    if (mysqli_num_rows($check) > 0) {
        // Email already registered
        $_SESSION['auth_error'] = "Email already registered. Please login.";
        header("Location: login.php");
        exit;
    } else {
        // Register new user
        mysqli_query($conn,
            "INSERT INTO users (name, email, password)
             VALUES ('$name', '$email', '$password')"
        );

        $_SESSION['auth_success'] = "Registration successful. Please login.";
        header("Location: login.php");
        exit;
    }
}
?>

<div class="container auth-box">
    <h2>Create Account</h2>

    <form method="POST">
        <input type="text" name="name" required placeholder="Full Name">
        <input type="email" name="email" required placeholder="Email Address">
        <input type="password" name="password" required placeholder="Password">
        <button class="btn">Sign Up</button>
    </form>

    <p style="margin-top:10px;">
        Already have an account? <a href="login.php">Login</a>
    </p>
</div>

<?php include "../includes/footer.php"; ?>