<?php

session_start();

include_once("database.php");
include_once("product.php");

$title = "Display Product";
include_once("header.php");

$product = new Product();

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

?>

<!-- <!DOCTYPE html>
<html>
	<head>
		<title>Display Product</title>
	</head> -->

	<body>

		<form method="post" action="display_product.php">

			<label for="productToDisplay">Name of the product to display</label> : <select name="productToDisplay" >
			<?php

			$sth = $product->selectAllProducts();
			while ($row = $sth->fetch())
			{
				echo "<option>" . $row['name'] . "</option>";
			}

			?>
			</select><br>

			<input type="submit" value="Display product" name="display_product">
			
		</form>

	</body>

<?php

if (isset($_POST['display_product']))
{
	if (isset($_POST['productToDisplay']))
	{
		$sth = $product->displayProduct($_POST['productToDisplay']);
		$res = $sth->fetch();
	?>

			<table>

				<tr>
					<th>Name</th>
					<th>Price</th>
					<th>Category</th>
				</tr>

				<tr>
					<td><?php echo $res[0]; ?></td>
					<td><?php echo $res[1]; ?></td>
					<td><?php echo $res[2]; ?></td>
				</tr>
			</table>

	<?php

	}
	
}

?>



	<a href="admin.php">Back to MY_ADMIN</a>

	<?php include_once("footer.php"); ?>

</html>

