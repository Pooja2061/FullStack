<?php include "db.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Library Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Add Book</h2>
<form action="add_book.php" method="post">
    <input type="text" name="title" placeholder="Title" required>
    <input type="text" name="author" placeholder="Author" required>
    <input type="text" name="category" placeholder="Category" required>
    <input type="number" name="quantity" placeholder="Quantity" required>
    <button type="submit">Add Book</button>
</form>

<h2>Search by Category</h2>
<form method="get">
    <input type="text" name="search" placeholder="Category">
    <button type="submit">Search</button>
</form>

<h2>Book List</h2>
<table>
<tr>
    <th>Title</th>
    <th>Author</th>
    <th>Category</th>
    <th>Quantity</th>
    <th>Action</th>
</tr>

<?php
$search = $_GET['search'] ?? "";
$sql = "SELECT * FROM books";
if ($search != "") {
    $sql .= " WHERE category='$search'";
}
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>{$row['title']}</td>
            <td>{$row['author']}</td>
            <td>{$row['category']}</td>
            <td>{$row['quantity']}</td>
            <td><a href='delete_book.php?id={$row['book_id']}'>Delete</a></td>
          </tr>";
}
?>
</table>

</body>
</html>
