<?php
$conn = mysqli_connect("localhost","root","","library_db");

/* ADD */
if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    mysqli_query($conn,"INSERT INTO readers(name,phone,address)
    VALUES('$name','$phone','$address')");

    echo "<script>
    alert('Reader Added Successfully');
    window.location='home.php?page=reader';
    </script>";
}

/* UPDATE */
if(isset($_POST['update']))
{
    $id = $_POST['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    mysqli_query($conn,"UPDATE readers SET
    name='$name',
    phone='$phone',
    address='$address'
    WHERE reader_id=$id");

    echo "<script>
    alert('Reader Updated Successfully');
    window.location='home.php?page=reader';
    </script>";
}

/* DELETE */
if(isset($_GET['delete']))
{
    $id = $_GET['delete'];
    mysqli_query($conn,"DELETE FROM readers WHERE reader_id=$id");
}

/* EDIT FETCH */
$editData = null;

if(isset($_GET['edit']))
{
    $id = $_GET['edit'];
    $res = mysqli_query($conn,"SELECT * FROM readers WHERE reader_id=$id");
    $editData = mysqli_fetch_assoc($res);
}

/* LOAD ALL READERS */
$result = mysqli_query($conn,"SELECT * FROM readers");
?>

<div class="main-box">

<h2>Reader Management</h2>

<!-- ADD / UPDATE FORM -->
<form method="POST">

<input type="hidden" name="id"
value="<?php echo $editData['reader_id'] ?? ''; ?>">

<input type="text" name="name"
placeholder="Name"
value="<?php echo $editData['name'] ?? ''; ?>" required>
<br><br>

<input type="text" name="phone"
placeholder="Phone"
value="<?php echo $editData['phone'] ?? ''; ?>" required>
<br><br>

<input type="text" name="address"
placeholder="Address"
value="<?php echo $editData['address'] ?? ''; ?>" required>
<br><br>

<?php if(isset($editData)) { ?>
    <input type="submit" name="update" value="Update Reader">
<?php } else { ?>
    <input type="submit" name="submit" value="Add Reader">
<?php } ?>

</form>

</div>

<!-- TABLE -->
<table>

<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Phone</th>
    <th>Address</th>
    <th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<tr>
    <td><?php echo $row['reader_id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['phone']; ?></td>
    <td><?php echo $row['address']; ?></td>

    <td>

        <!-- EDIT -->
        <a href="home.php?page=reader&edit=<?php echo $row['reader_id']; ?>">
        Edit
        </a>

        &nbsp;

        <!-- DELETE -->
        <a href="home.php?page=reader&delete=<?php echo $row['reader_id']; ?>"
        onclick="return confirm('Delete this reader?')">
        Delete
        </a>

    </td>
</tr>

<?php } ?>

</table>