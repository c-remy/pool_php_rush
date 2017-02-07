<?php

session_start();

include_once("database.php");
include_once("product.php");
include_once("category.php");

$title = "Modify Product";
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


$flag = 0;
$flag_name = 0;
$flag_price = 0;
$flag_category = 0;

$product = new Product();
$category = new Category();


// if (isset($_POST['productToEdit']) && strlen($_POST['productToEdit']) >= 3 && strlen($_POST['productToEdit']) <= 20)
// {
// 	$productToEdit = $_POST['productToEdit'];
// 	$flag_name= 1;
// }
// elseif (isset($_POST['productToEdit']))
// {
// 	echo "Invalid name for the product to edit";
// 	$flag_name = 0;
// }

if (isset($_POST['name']))
	{
		$flag_name = $product->checkProductName($_POST['name']);
	}

if (isset($_POST['price']))
	{
		$flag_price = $product->checkProductPrice($_POST['price']);
	}

if (isset($_POST['category']))
	{
		$flag_category = $product->checkProductCategory($_POST['category']);
	}



if ($flag_name == 1 && $flag_price == 1 && $flag_category == 1)
	$flag++;

if ($flag == 1)
	{
		$product->editProduct($productToEdit, $_POST['name'], $_POST['price'], $_POST['category']);
		echo "Product updated";
		echo "<br>";
	}

$categoryList = $category->fetchCategoryTree();

?>


<!-- <!DOCTYPE html>
<html>
	<head>
		<title>Modify Product</title>
	</head> -->

	<body>

		<form method="post" action="modify_product.php">

			<label for="productToEdit">Product to edit</label> : <select name="productToEdit">
			<?php

			$sth = $product->selectAllProducts();
			while ($row = $sth->fetch())
			{
				echo "<option>" . $row['name'] . "</option>";
			}

			?>
			 </select><br>

			<label for="name">Name</label> : <input type="text" name="name" id="name" placeholder="Enter Product name" title="3 to 20 characters"> <br>

			<label for="price">Price</label> : <input type="number" name="price" id="price" placeholder="Enter product price"> <br>

			<label for="category">Category</label> : <select name="category">
			
			<?php foreach ($categoryList as $row)
			{ ?>
				<option value="<?php echo $row["id"] ?>"><?php echo $row["name"]; ?></option>
			<?php }

			?>
			</select>

			<a href="add_category.php">Create category</a><br><br>

			<input type="submit" value="Update product">
			
		</form>

	</body>

	<a href="admin.php">Back to MY_ADMIN</a>

	<?php include_once("footer.php"); ?>
</html>
