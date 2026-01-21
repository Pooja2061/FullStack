<?php
require 'session.php';
require 'db.php';

$error = '';

if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!hash_equals($_SESSION['token'], $_POST['token'] ?? '')) {
        die('Invalid request');
    }

    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];

    if ($email && $password) {
        $stmt = $pdo->prepare("SELECT id, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            header('Location: dashboard.php');
            exit;
        }
    }
    $error = "Invalid email or password";
}
?>
<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
<h2>Login</h2>
<p><?php echo htmlspecialchars($error); ?></p>
<form method="post">
<input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
<input type="email" name="email" required>
<br><br>
<input type="password" name="password" required>
<br><br>
<button type="submit">Login</button>
</form>
<a href="signup.php">Signup</a>
</body>
</html>
