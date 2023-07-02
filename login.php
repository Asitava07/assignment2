<!DOCTYPE html>
<head>
    <meta charset="UFT-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
<body>
<div class="loginbox">
        <h1>Customer Login </h1>
    	<form action="login.php" method="post" name="form1">
                <p>ID</p>
                    <input type="text" name="id" placeholder="Enter Your ID">
                <p>Password</p>
                    <input type="password" name="password" placeholder="Enter Password"><br><br>
                <input type="submit" name="login" value="Submit"><br><br>
                <a href="password_reset.php">Forget Password</a><br><br>
        </form>
</div>
   
</body>

</html>




<?php

session_start();
$databaseHost     = 'localhost';
$databaseName     = 'juhosi';
$databaseUsername = 'root';
$databasePassword = '';
$conn = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
if ($conn->connect_error){
    header("Connection failed: " . $conn->connect_error);
    
}

if (isset($_POST['login'])) {
    
    $id = $_POST['id'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "select 'id', 'password' from login
        where id='$id' and password='$password'");

    $user_matched = mysqli_num_rows($result);

    if ($user_matched > 0) {
        
        $_SESSION["id"] = $id;
        header('location:form.php?=' .$id. '');
    } else {
        echo "User email or password is not matched, Try again! <br/><br/>";
    }
}

?>