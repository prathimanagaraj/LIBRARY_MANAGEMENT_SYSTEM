<?php
$conn = mysqli_connect("localhost","root","","library_db");

/* RETURN BOOK */
if(isset($_POST['return']))
{
    $issue_id = $_POST['issue_id'];
    $return_date = $_POST['return_date'];

    $get = mysqli_query($conn,"SELECT book_id FROM issue_books WHERE issue_id='$issue_id'");
    $row = mysqli_fetch_assoc($get);

    if($row)
    {
        $book_id = $row['book_id'];

        // increase stock
        mysqli_query($conn,"UPDATE books 
        SET quantity = quantity + 1 
        WHERE book_id='$book_id'");

        // update issue record
        mysqli_query($conn,"UPDATE issue_books 
        SET return_date='$return_date',
            status='Returned'
        WHERE issue_id='$issue_id'");

        echo "<script>
        alert('Book Returned Successfully');
        window.location='home.php?page=return';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Return Book</title>

<style>

/* SAME STYLE AS ISSUE PAGE */
body{
    background: #f5f5f5;
}

/* CENTER FORM */
.form-container{
    width: 400px;
    margin: 60px auto;
}

/* TITLE */
h2{
    text-align: center;
    margin-bottom: 20px;
}

/* SIMPLE ROW */
.form-row{
    margin-bottom: 12px;
}

/* LABEL */
label{
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

/* INPUT */
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

<h2>Return Book</h2>

<div class="form-container">

<form method="POST">

<!-- ISSUED BOOK -->
<div class="form-row">
<label>Issued Book</label>

<select name="issue_id" required>
<option value="">Select Issued Book</option>

<?php
$sql = "SELECT i.issue_id,
               r.name AS reader_name,
               b.title AS book_title
        FROM issue_books i
        INNER JOIN readers r ON i.reader_id = r.reader_id
        INNER JOIN books b ON i.book_id = b.book_id
        WHERE i.status = 'Issued'";

$result = mysqli_query($conn,$sql);

if($result && mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_assoc($result))
    {
?>
<option value="<?php echo $row['issue_id']; ?>">
<?php echo $row['reader_name']; ?> - <?php echo $row['book_title']; ?>
</option>
<?php
    }
}
else
{
?>
<option>No issued books found</option>
<?php } ?>

</select>
</div>

<!-- RETURN DATE -->
<div class="form-row">
<label>Return Date</label>
<input type="date" name="return_date" required>
</div>

<!-- BUTTON -->
<input type="submit" name="return" value="Return Book">

</form>

</div>

</body>
</html>