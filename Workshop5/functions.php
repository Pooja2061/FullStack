<?php
function formatName($name)
{
    return ucwords(strtolower(trim($name)));
}

function validateEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function cleanSkills($string)
{
    $skills = explode(",", $string);
    return array_map("trim", $skills);
}

function saveStudent($name, $email, $skillsArray)
{
    $line = $name . "|" . $email . "|" . implode(",", $skillsArray) . PHP_EOL;
    file_put_contents("students.txt", $line, FILE_APPEND);
}

function uploadPortfolioFile($file)
{
    if (!isset($file) || $file["error"] !== 0) {
        throw new Exception("Upload error");
    }

    $allowed = ["pdf", "jpg", "jpeg", "png"];
    $sizeLimit = 2 * 1024 * 1024;

    if ($file["size"] > $sizeLimit) {
        throw new Exception("File too large");
    }

    $ext = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed)) {
        throw new Exception("Invalid file type");
    }

    if (!is_dir("uploads")) {
        if (!mkdir("uploads")) {
            throw new Exception("Upload directory error");
        }
    }

    $newName = time() . "_" . preg_replace("/[^a-zA-Z0-9]/", "", pathinfo($file["name"], PATHINFO_FILENAME)) . "." . $ext;
    $destination = "uploads/" . $newName;

    if (!move_uploaded_file($file["tmp_name"], $destination)) {
        throw new Exception("File move failed");
    }

    return $newName;
}
