<?php

$conn = mysqli_connect("localhost","root","","library_db");

$id = $_GET['id'];

$sql = "DELETE FROM books
        WHERE book_id='$id'";
$result = mysqli_query($conn,$sql);

if($result)
{
    echo "<script>
    alert('Book Deleted Successfully');
    window.location='home.php?page=view';
    </script>";
}

?>
