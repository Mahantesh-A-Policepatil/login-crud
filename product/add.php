<?php 
	session_start(); 
	include '../layout/header.php'
?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: ../login/login.php');
}
?>

<html>
<head>
	<title>Add Data</title>
</head>

<body>
<?php
	//including the database connection file
	include_once("../config/connection.php");

	if(isset($_POST['submit'])) {	
		$name = $_POST['name'];
		$quantity = $_POST['quantity'];
		$price = $_POST['price'];
		$userId = $_SESSION['id'];
			
		// checking empty fields
		if(empty($name) || empty($quantity) || empty($price)) {
					
			if(empty($name)) {
				echo "<font color='red'>Name field is empty.</font><br/>";
			}
			
			if(empty($quantity)) {
				echo "<font color='red'>Quantity field is empty.</font><br/>";
			}
			
			if(empty($price)) {
				echo "<font color='red'>Price field is empty.</font><br/>";
			}
			
			//link to the previous page
			echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
		} else { 
			// if all the fields are filled (not empty) 
				
			//insert data to database	
			$result = mysqli_query($mysqli, "INSERT INTO products(name, quantity, price, user_id) VALUES('$name','$quantity','$price', '$userId')");
			
			//display success message
			header("Location: ../product/view.php");
		}
	}
?>

<div class="container" style="margin-top:100px;">
	<a href="../product/view.php">View Products</a>
	<form name="form1" method="post" action="../product/add.php" class="form">
        <h1 class="text-center text-info">Add Product</h1>
        <div class="form-group">
            <label for="name" class="text-info">Product Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="quantity" class="text-info">Quantity:</label>
            <input type="text" name="quantity" class="form-control" required>
        </div>
         <div class="form-group">
            <label for="price" class="text-info">Proce:</label>
            <input type="text" name="price" class="form-control" required>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" class="btn btn-info btn-md" value="Add">
        </div>       
    </form>

</div>
<?php
  include '../layout/footer.php'
?>
</body>
</html>
