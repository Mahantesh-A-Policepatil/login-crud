<?php
	session_start();
	if(!isset($_SESSION['valid'])) {
		header('Location: ../login/login.php');
	}
	//including the database connection file
	include_once("../config/connection.php");

	//fetching data in descending order (lastest entry first)
	$result = mysqli_query($mysqli, "SELECT * FROM products WHERE user_id=".$_SESSION['id']." ORDER BY id DESC");
?>

<html>
<head>
	<title>Homepage</title>
</head>

<body>
	<?php
      include '../layout/header.php'
    ?>
	<div class="container" style="margin-top:100px;">
		<a href="../product/add.php" class="btn btn-primary">Add New Data</a>
		<table width='80%' border=0 class="table table-dark">
			<tr bgcolor='#CCCCCC'>
				<td>Name</td>
				<td>Quantity</td>
				<td>Price (Rs)</td>
				<td>Actions</td>
			</tr>
			<?php
			if(!empty($result)){
				while($res = mysqli_fetch_array($result)) {		
					echo "<tr>";
					echo "<td>".$res['name']."</td>";
					echo "<td>".$res['quantity']."</td>";
					echo "<td>".$res['price']."</td>";	
					echo "<td><a href=\"edit.php?id=$res[id]\" class='btn btn-success'>Edit</a>  
					<a href=\"delete.php?id=$res[id]\" class='btn btn-danger' onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";		
				}
			}
			?>
		</table>
	</div>
	<?php
		include '../layout/footer.php'
	?>	
</body>
</html>
