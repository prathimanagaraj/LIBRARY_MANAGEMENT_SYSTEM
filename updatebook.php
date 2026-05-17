<?php
$conn = mysqli_connect("localhost","root","","library_db");

$id = $_GET['id'];

$select = "SELECT * FROM books WHERE book_id='$id'";
$result = mysqli_query($conn,$select);
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update']))
{
    $isbn = $_POST['isbn'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $pub_year = $_POST['pub_year'];
    $quantity = $_POST['quantity'];

    $sql = "UPDATE books SET
    isbn='$isbn',
    title='$title',
    author='$author',
    pub_year='$pub_year',
    quantity='$quantity'
    WHERE book_id='$id'";

    $result = mysqli_query($conn,$sql);

    if($result)
    {
        echo "<script>
        alert('Book Updated Successfully');
        window.location='home.php?page=view';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
<title>Update Book</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<!-- TOP BAR -->

<div class="top-bar">

    <span class="top-title">
        Library Management System
    </span>

    <a href="login.php" class="logout">
        Logout
    </a>

</div>

<!-- MAIN CONTAINER -->

<div class="container">

    <!-- LEFT MENU -->

    <div class="left-menu">

        <a href="home.php?page=add">Add Book</a>
        <a href="home.php?page=view">View Books</a>
        <a href="home.php?page=issue">Issue Book</a>
        <a href="home.php?page=return">Return Book</a>

    </div>

    <!-- RIGHT BOX -->

    <div class="right-box">

        <div class="main-box">

            <h2>Update Book</h2>

            <form method="POST">

                <div class="form-row">
                    <label>ISBN</label>
                    <input type="text" name="isbn" value="<?php echo $row['isbn']; ?>">
                </div>

                <div class="form-row">
                    <label>Title</label>
                    <input type="text" name="title" value="<?php echo $row['title']; ?>">
                </div>

                <div class="form-row">
                    <label>Author</label>
                    <input type="text" name="author" value="<?php echo $row['author']; ?>">
                </div>

                <div class="form-row">
                    <label>Pub Year</label>
                    <input type="number" name="pub_year" value="<?php echo $row['pub_year']; ?>">
                </div>

                <div class="form-row">
                    <label>Quantity</label>
                    <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>">
                </div>

                <input type="submit" name="update" value="Update Book">

            </form>

        </div>

    </div>

</div>

</body>
</html>