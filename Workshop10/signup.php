<?php
require 'db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];

    if ($email && !empty($password) && strlen($password) >= 6) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        $stmt->execute([$email, $hash]);
        $message = "Signup successful";
        header("refresh:2;url=login.php");
    } else {
        $message = "Invalid input";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Signup</title></head>
<body>
<h2>Signup</h2>
<p><?php echo htmlspecialchars($message); ?></p>
<form method="post">
<input type="email" name="email" required>
<br><br>
<input type="password" name="password" required>
<br><br>
<button type="submit">Signup</button>
</form>
<a href="login.php">Login</a>
</body>
</html>
