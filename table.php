<?php
error_reporting(0);

$databaseHost     = 'localhost';
$databaseName     = 'juhosi';
$databaseUsername = 'root';
$databasePassword = '';
$conn = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
?>

<?php
	session_start();
	if(!isset($_SESSION['id'])){
		header('location:table.php');
	}

?>


<?php

$conn = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
$id = $_SESSION['id'];
$q1="SELECT * from orderitem WHERE id = '$id'";
$query = mysqli_query($conn,$q1);
$result = mysqli_num_rows($query);

?>










<!DOCTYPE html>
<head>
<title>Table Details</title>
        <style>
            table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            }

            td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
            }

            tr:nth-child(even) {
            background-color: #dddddd;
            }
        </style>
</head>
<body>

<h2>Order List</h2>
<table>
  <tr>
    <th>ID</th>
    <th>Product ID</th>
    <th>Package</th>
    <th>Request Weight</th>
    <th>Request Weight</th>
    <th>Order Date</th>
    <th>Order ID</th>
    <th>Request</th>
  </tr>

  <?php
      for($i=1; $i<=$result; $i++){
        $r = mysqli_fetch_array($query)
      ?>
        <tr>
          <td><?php echo $r['id'];?></td>
          <td><?php echo $r['productId'];?></td>
          <td><?php echo $r['package'];?></td>
          <td><?php echo $r['request_weight'];?></td>
          <td><?php echo $r['result_weight'];?></td>
          <td><?php echo $r['orderDate'];?></td>
          <td><?php echo $r['order_id'];?></td>
          <td><?php echo $r['requests'];?></td>
        </tr>
      <?php
      }
      ?>
      
</table>
<br><br>
<form method="post"  action ="table.php">
    <input type="submit" name="export" value="Generate Excel Sheet"><br><br>
    <a href="logout.php">Logout</a>
</form>

</body>
</html>





<?php
$conn = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
$output = '';
$export = $_POST['export'];
if($export != 0){
  $sql = "SELECT * FROM orderitem ORDER BY id DESC";
  $result1 = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result1) > 0)
  {
      $output .= '
          <table class="table1" borderred="1">
          <tr>
            <th>ID</th>
            <th>Product ID</th>
            <th>Package</th>
            <th>Request Weight</th>
            <th>Request Weight</th>
            <th>Order Date</th>
            <th>Order ID</th>
            <th>Request</th>
          </tr>
          ';
          while($r = mysqli_fetch_array($result1))
          {
              $output .= '
                <tr>
                  <th>'.$r["id"].'</th>
                  <th>'.$r["productId"].'</th>
                  <th>'.$r["package"].'</th>
                  <th>'.$r["request_weight"].'</th>
                  <th>'.$r["result_weight"].'</th>
                  <th>'.$r["orderDate"].'</th>
                  <th>'.$r["order_id"].'</th>
                  <th>'.$r["requests"].'</th>
                </tr>
              ';
          }
          $output .= '</table>';
          header("Content-Type: application/xls");
          header("Content-Disposition: attachment; filename= download.xls");
          echo $output;
  }       
}

?>



