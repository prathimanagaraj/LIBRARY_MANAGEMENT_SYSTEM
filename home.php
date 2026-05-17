<?php
$conn = mysqli_connect("localhost","root","","library_db");

$page = $_GET['page'] ?? 'add';
?>

<!DOCTYPE html>
<html>

<head>

<title>Library Management System</title>

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
	  <a href="home.php?page=reader"
	class="<?php if($page=='reader') echo 'active'; ?>">
	Add Reader
	</a>

        <a href="home.php?page=add"
        class="<?php if($page=='add') echo 'active'; ?>">
        Add Book
        </a>

        <a href="home.php?page=view"
        class="<?php if($page=='view') echo 'active'; ?>">
        View Books
        </a>

        <a href="home.php?page=issue"
        class="<?php if($page=='issue') echo 'active'; ?>">
        Issue Book
        </a>

        <a href="home.php?page=return"
        class="<?php if($page=='return') echo 'active'; ?>">
        Return Book
        </a>

    </div>

    <!-- RIGHT CONTENT -->

    <div class="right-box">

        <?php
	if($page == 'reader')
{
    include "addreader.php";
}

        elseif($page == 'add')
        {
            include "addbook.php";
        }
        elseif($page == 'view')
        {
            include "viewbook.php";
        }
        elseif($page == 'issue')
        {
            include "issuebook.php";
        }
        elseif($page == 'return')
        {
            include "returnbook.php";
        }
        else
        {
            echo "<h2>Welcome to Library System</h2>";
        }

        ?>

    </div>

</div>

</body>
</html>