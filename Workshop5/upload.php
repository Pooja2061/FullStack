<?php
require "functions.php";
require "header.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $fileName = uploadPortfolioFile($_FILES["portfolio"]);
        echo "<p>File uploaded: $fileName</p>";
    } catch (Exception $e) {
        echo "<p>Error: {$e->getMessage()}</p>";
    }
}
?>
<form method="post" enctype="multipart/form-data">
    <input type="file" name="portfolio">
    <button type="submit">Upload</button>
</form>
<?php require "footer.php"; ?>
