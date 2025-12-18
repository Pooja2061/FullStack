<?php
require "header.php";

if (file_exists("students.txt")) {
    $lines = file("students.txt", FILE_IGNORE_NEW_LINES);
    foreach ($lines as $line) {
        [$name, $email, $skills] = explode("|", $line);
        $skillsArray = explode(",", $skills);
        echo "<p><strong>Name:</strong> $name</p>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<p><strong>Skills:</strong></p><ul>";
        foreach ($skillsArray as $skill) {
            echo "<li>$skill</li>";
        }
        echo "</ul><hr>";
    }
} else {
    echo "<p>No students found</p>";
}

require "footer.php";
