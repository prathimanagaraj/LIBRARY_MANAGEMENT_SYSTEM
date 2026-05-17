
<?php

$conn = mysqli_connect("localhost","root","","library_db");

if(!$conn)
{
    die("Connection Failed");
}

if(isset($_GET['search']))
{
    $search = $_GET['search'];

    $sql = "SELECT * FROM books

    WHERE isbn LIKE '%$search%'

    OR title LIKE '%$search%'

    OR author LIKE '%$search%'

    OR pub_year LIKE '%$search%'";
}
else
{
    $sql = "SELECT * FROM books";
}

$result = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html>

<head>

<title>View Books</title>

<link rel="stylesheet" href="style.css">

</head>

<body>
<h2>Book List</h2>

<form method="GET" style="text-align:center; margin-top:20px;">

<input type="text"
id="searchInput"
placeholder="Search Book"
onkeyup="searchBook()">

</form>

<table id="bookTable">

<tr>

<th>ISBN</th>

<th>Title</th>

<th>Author</th>

<th>Pub Year</th>

<th>Available Copies</th>

<th>Action</th>

</tr>

<?php

while($row = mysqli_fetch_assoc($result))
{
?>

<tr>

<td>
<?php echo $row['isbn']; ?>
</td>
<td>

<?php

$title = $row['title'];

if(isset($_GET['search']))
{
    $search = $_GET['search'];

    $title = preg_replace(

    "/($search)/i",

    "<mark>$1</mark>",

    $title

    );
}

echo $title;

?>

</td>
<td>
<?php echo $row['author']; ?>
</td>

<td>
<?php echo $row['pub_year']; ?>
</td>

<td>
<?php echo $row['quantity']; ?>
</td>

<td>

<a href="updatebook.php?id=<?php echo $row['book_id']; ?>">
Update
</a>

|

<a href="deletebook.php?id=<?php echo $row['book_id']; ?>">
Delete
</a>

</td>

</tr>

<?php
}
?>

</table>
<?php

$total = "SELECT SUM(quantity)
AS total_books FROM books";

$total_result =
mysqli_query($conn,$total);

$total_row =
mysqli_fetch_assoc($total_result);

?>

<div style="

width:400px;

margin:20px auto;

background-color:white;

padding:15px;

border-radius:10px;

box-shadow:0px 0px 10px gray;

text-align:center;

font-size:20px;

font-weight:bold;

color:darkblue;

">

Total Books Available :
<?php echo $total_row['total_books']; ?>

</div>
<script>

function searchBook()
{
    let input =
    document.getElementById("searchInput")
    .value.toLowerCase();

    let table =
    document.getElementById("bookTable");

    let tr = table.getElementsByTagName("tr");

    for(let i = 1; i < tr.length; i++)
    {
        let found = false;

        let td = tr[i].getElementsByTagName("td");

        for(let j = 0; j < td.length; j++)
        {
            if(td[j])
            {
                let text =
                td[j].innerText.toLowerCase();

                if(text.indexOf(input) > -1)
                {
                    found = true;
                }
            }
        }

        if(found)
        {
            tr[i].style.display = "";
        }
        else
        {
            tr[i].style.display = "none";
        }
    }
}

</script>
</body>
</html>