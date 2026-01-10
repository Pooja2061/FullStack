<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $name = $_POST['name'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare(
        "INSERT INTO students (student_id, name, password) VALUES (?, ?, ?)"
    );
    $stmt->bind_param("sss", $student_id, $name, $hashed_password);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit();
    } else {
        echo "Registration failed. Student ID may already exist.";
    }
}
?>

<!DOCTYPE html>
<html>
<body>
<h2>Register</h2>
<form method="POST">
    Student ID: <input type="text" name="student_id" required><br><br>
    Name: <input type="text" name="name" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Register</button>
</form>
<a href="login.php">Login</a>
</body>
</html>
