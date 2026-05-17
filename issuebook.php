<?php
$conn = mysqli_connect("localhost","root","","library_db");

/* ISSUE BOOK */
if(isset($_POST['issue']))
{
    $reader_id = $_POST['reader_id'];
    $book_id = $_POST['book_id'];
    $issue_date = $_POST['issue_date'];

    $check = mysqli_query($conn,"SELECT quantity FROM books WHERE book_id='$book_id'");
    $data = mysqli_fetch_assoc($check);

    if($data && $data['quantity'] > 0)
    {
        $result = mysqli_query($conn,"INSERT INTO issue_books(reader_id,book_id,issue_date)
        VALUES('$reader_id','$book_id','$issue_date')");

        if($result)
        {
            mysqli_query($conn,"UPDATE books 
            SET quantity = quantity - 1 
            WHERE book_id='$book_id'");

            echo "<script>
            alert('Book Issued Successfully');
            window.location='home.php?page=issue';
            </script>";
        }
        else
        {
            echo "Error: " . mysqli_error($conn);
        }
    }
    else
    {
        echo "<script>alert('Book Not Available');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Issue Book</title>

<style>

/* PAGE BACKGROUND ONLY */
body{
    background: #f5f5f5;
}

/* CENTER FORM WITHOUT BOX */
.form-container{
    width: 400px;
    margin: 60px auto;
}

/* TITLE */
h2{
    text-align: center;
    margin-bottom: 20px;
}

/* SIMPLE ROW STYLE */
.form-row{
    margin-bottom: 12px;
}

/* LABEL */
label{
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

/* INPUTS */
select,
input{
    width: 100%;
    padding: 8px;
    border: 1px solid #aaa;
    border-radius: 4px;
}

/* BUTTON */
input[type="submit"]{
    width: 100%;
    padding: 10px;
    background: darkblue;
    color: white;
    border: none;
    cursor: pointer;
    margin-top: 10px;
}

input[type="submit"]:hover{
    background: navy;
}

</style>

</head>

<body>

<h2>Issue Book</h2>

<div class="form-container">

<form method="POST">

<!-- READER -->
<div class="form-row">
<label>Reader</label>
<select name="reader_id" required>
<option value="">Select Reader</option>
<?php
$r = mysqli_query($conn,"SELECT * FROM readers");
while($row = mysqli_fetch_assoc($r)){
?>
<option value="<?php echo $row['reader_id']; ?>">
<?php echo $row['name']; ?>
</option>
<?php } ?>
</select>
</div>

<!-- BOOK -->
<div class="form-row">
<label>Book</label>
<select name="book_id" required>
<option value="">Select Book</option>
<?php
$b = mysqli_query($conn,"SELECT * FROM books WHERE quantity > 0");
while($row = mysqli_fetch_assoc($b)){
?>
<option value="<?php echo $row['book_id']; ?>">
<?php echo $row['title']; ?> - <?php echo $row['author']; ?>
</option>
<?php } ?>
</select>
</div>

<!-- DATE -->
<div class="form-row">
<label>Issue Date</label>
<input type="date" name="issue_date" required>
</div>

<input type="submit" name="issue" value="Issue Book">

</form>

</div>

</body>
</html>