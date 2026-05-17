<?php
$username = "admin";
$password = "1234";

if(isset($_POST['login']))
{
    $user = $_POST['username'];
    $pass = $_POST['password'];

    if($user == $username && $pass == $password)
    {
        header("Location:home.php");
    }
    else
    {
        echo "<script>alert('Invalid Username or Password');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>

<link rel="stylesheet" href="style.css">

<style>

/* FULL SCREEN CENTER */
.login-container{
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* LOGIN BOX */
.login-box{
    width: 350px;
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0px 0px 15px gray;
    text-align: center;
}

/* FORM */
.login-box input{
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border-radius: 5px;
    border: 1px solid gray;
}

/* BUTTON */
.login-box input[type="submit"]{
    background-color: darkblue;
    color: white;
    border: none;
    cursor: pointer;
}

.login-box input[type="submit"]:hover{
    background-color: navy;
}

</style>

</head>

<body>

<div class="login-container">

    <div class="login-box">

        <h2>Library Management System</h2>

        <form method="POST">

            <input type="text" name="username" placeholder="Username" required>

            <input type="password" name="password" placeholder="Password" required>

            <input type="submit" name="login" value="Login">

        </form>

    </div>

</div>

</body>
</html>