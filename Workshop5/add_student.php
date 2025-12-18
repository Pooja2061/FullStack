<?PHP
require "functions.php";
require "header.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $name = formatName($_POST["name"] ?? "");
        $email = $_POST["email"] ?? "";
        $skillsInput = $_POST["skills"] ?? "";

        if ($name === "" || !validateEmail($email) || $skillsInput === "") {
            throw new Exception("Invalid input");
        }

        $skillsArray = cleanSkills($skillsInput);
        saveStudent($name, $email, $skillsArray);
        echo "<p>Student saved successfully</p>";
    } catch (Exception $e) {
        echo "<p>Error: {$e->getMessage()}</p>";
    }
}
?>
<form method="post">
    <label>Name</label><br>
    <input type="text" name="name"><br><br>
    <label>Email</label><br>
    <input type="text" name="email"><br><br>
    <label>Skills</label><br>
    <input type="text" name="skills"><br><br>
    <button type="submit">Save</button>
</form>
<?php require "footer.php"; ?>
