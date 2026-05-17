<?php

$conn = mysqli_connect("localhost","root","","library_db");

if(isset($_POST['submit']))
{
    $isbn = $_POST['isbn'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $pub_year = $_POST['pub_year'];
    $quantity = $_POST['quantity'];

    $sql = "INSERT INTO books
    (isbn,title,author,pub_year,quantity)
    VALUES
    ('$isbn','$title','$author','$pub_year','$quantity')";

    $result = mysqli_query($conn,$sql);

    if($result)
    {
        echo "<script>
        alert('Book Added Successfully');
        window.location='home.php?page=view';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Add Book</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="main-box">

<h2>Add Book</h2>

<form method="POST">

<div class="form-row">
    <label>ISBN</label>
    <input type="text" name="isbn" required>
</div>

<div class="form-row">
    <label>Title</label>
    <input type="text" name="title" required>
</div>

<div class="form-row">
    <label>Author</label>
    <input type="text" name="author" required>
</div>

<div class="form-row">
    <label>Pub Year</label>
    <input type="number" name="pub_year" required>
</div>

<div class="form-row">
    <label>Quantity</label>
    <input type="number" name="quantity" required>
</div>

<input type="submit" name="submit" value="Add Book">

</form>

</div>

</body>
</html>