<?php
require 'session.php';
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
}

$stmt = $pdo->prepare("SELECT email FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

$email = $user ? $user['email'] : '';
?>
<!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<body>

<h1>Dashboard</h1>

<p><?php echo htmlspecialchars($email); ?></p>

<form method="post">
    <button name="logout">Logout</button>
</form>

</body>
</html>
