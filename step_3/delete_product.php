<?php

session_start();

include_once("database.php");
include_once("product.php");

$title = "Delete Product";
include_once("header.php");


if (isset($_COOKIE['name']) && $_COOKIE['admin'] == "1")
{
	echo "Hello " . $_COOKIE['name'];
	echo "<br><br>";
}

elseif (isset($_SESSION['name']) && $_SESSION['admin'] == "1")
{
	echo "Hello " . $_SESSION['name'];
	echo "<br><br>";
}

else
{
	header('Location: login.php');
}

$product = new Product();

$flag_product = 0;

if (isset($_POST['productToDelete']))
{
	$productToDelete = $_POST['productToDelete'];
	$flag_product = 1;
}


if ($flag_product == 1)
	{
		$product->deleteProduct($productToDelete);
		echo "Product deleted";
		echo "<br>";
	}



?>


<!-- <!DOCTYPE html>
<html>
	<head>
		<title>Delete Product</title>
	</head> -->

	<body>

		<form method="post" action="delete_product.php">

			<label for="productToDelete">Product name to delete</label> : <select name="productToDelete" >
			<?php

			$sth = $product->selectAllProducts();
			while ($row = $sth->fetch())
			{
				echo "<option>" . $row['name'] . "</option>";
			}

			?>
			</select><br>

			<input type="submit" value="Delete product">
			
		</form>

	</body>

	<a href="admin.php">Back to MY_ADMIN</a>

	<?php include_once("footer.php"); ?>
</html>
