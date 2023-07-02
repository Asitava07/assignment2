<!DOCTYPE html>
<head>
    <meta charset="UFT-8">
    <title>Reset Password Page</title>
    <link rel="stylesheet" href="style.css">
<body>
<div class="loginbox">
            <h1>Reset Password</h1>
    	    <form action="password_reset.php" method="post" name="form2">
                <p>Enter Your ID</p>
                    <input type="text" name="userid" placeholder="Enter Your User ID">
                <p>New Password</p>
                    <input type="password" name="newpassword" placeholder="Enter New Password">
                <p>Confirm Password</p>
                    <input type="password" id="confirm_password" name="confirm_password"  placeholder="Enter New Password " required>
                <br><br>
                
                <input type="submit" name="update" value="Update Password">
                <br><br>
                <a href="login.php">Go back to Login Page</a>
                <br><br>

            </form>
</div>
   
</body>

</html>



<?php

$databaseHost     = 'localhost';
$databaseName     = 'juhosi';
$databaseUsername = 'root';
$databasePassword = '';
$conn = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
if ($conn->connect_error){
    header("Connection failed: " . $conn->connect_error);
    
}
?>



<?php
if (isset($_POST['update'])) {

    $userid = $_POST['userid'];
    $newpassword = $_POST['newpassword'];
    $confirmPassword = $_POST['confirm_password'];
    if ($newpassword !== $confirmPassword) {
        echo "New password and confirm password do not match.";
    }else{
    $conn = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
    $q1 = "UPDATE login SET password ='$newpassword' WHERE id = '$userid'";


    $result = mysqli_query($conn,$q1);


if($result)
    {
        echo "Password Changed Successfully!! ";
    }
    else{
        echo "Failed to change Password";
    }
}
}

?>
