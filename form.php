<!DOCTYPE html>
<head>
    <meta charset="UFT-8">
    <title>Customer Form Page</title>
    <link rel="stylesheet" href="style2.css">
<body>
<div class="loginbox">
        <h1>Customer Form</h1>
    	<form action="form.php" method="post" name="form3">
                
                <p>Product ID</p>
                    <input type="number" name="productid" placeholder="Enter Product ID">
                <p>Package</p>
                    <input type="text" name="package" placeholder="Enter Product Name">
                <p>Request Weight</p>
                    <input type="number" name="weight" placeholder="Enter Request Weight">
                <p>Result Weight</p>
                    <input type="number" name="weight2" placeholder="Enter Request Weight">
                <p>Order Date</p>
                    <input type="date" name="date" placeholder="Enter Order Date">
                <p>Order ID</p>
                    <input type="number" name="order" placeholder="Enter Order ID">
                <p>Requests</p>
                    <input type="text" name="request" placeholder="Enter Requests"><br><br> 
                    <input type="hidden" name="userid" value="<?php echo $fetch1['id'];?>"/>           

                <input type="submit" name="submit" value="Submit"><br><br>
		
                <a href="table.php">Show Your Data</a><br><br>        
                <a href="logout.php">Logout</a>
        </form>
</div>
   
</body>

</html>



<?php
include_once("db.php");
?>

<?php
	session_start();
	// if(!ISSET($_SESSION['email'])){
	// 	header('location:form.php');
	// }
    $id = $_SESSION["id"];
?>

    <?php
    $conn = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
    $q1="SELECT * from orderitem WHERE id= '$id'";
    $query = mysqli_query($conn,$q1);

    
    $query1 = mysqli_query($conn, "SELECT * FROM `login` WHERE `Id`='$id'") or die(mysqli_error());
    $fetch1 = mysqli_fetch_array($query1);

    ?>    

<?php
        if (isset($_POST['submit'])){

            $productid = $_POST['productid'];
            $package = $_POST['package'];
            $weight = $_POST['weight'];
            $weight2 = $_POST['weight2'];
            $date = $_POST['date'];
            $order = $_POST['order'];
            $request = $_POST['request'];

    $sql=mysqli_query($mysqli,"INSERT INTO `orderitem`(`id`,`productId`, `package`, `request_weight`, `result_weight`, `orderDate`, `order_id`, `requests`) VALUES ('$id','$productid','$package','$weight','$weight2','$date','$order','$request')");

                if ($sql) {
                    echo "<br/><br/>Data Stored Successfully.";
                } 
                else {
                    echo "Error. Please try again." . mysqli_error($mysqli);
                }
       
        }

?>
