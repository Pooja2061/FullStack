<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $password = $_POST['password'];

    $stmt = $conn->prepare(
        "SELECT password FROM students WHERE student_id = ?"
    );
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($storedhash);
        $stmt->fetch();

        if (password_verify($password, $storedhash)) {
            $_SESSION['logged_in'] = true;
            $_SESSION['student_id'] = $student_id;
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "Student not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<body>
<h2>Login</h2>
<form method="POST">
    Student ID: <input type="text" name="student_id" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Login</button>
</form>
<a href="register.php">Register</a>
</body>
</html>
