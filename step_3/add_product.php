<?php

session_start();

include_once("database.php");
include_once("product.php");
include_once("category.php");

$title = "Add Product";
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
		$product->addProduct($_POST['name'], $_POST['price'], $_POST['category']);
		echo "Product created";
		echo "<br>";
	}

$categoryList = $category->fetchCategoryTree();

?>

<!-- <!DOCTYPE html>
<html>
	<head>
		<title>Create product</title>
	</head> -->

	<body>

		<form method="post" action="add_product.php">

			<label for="name">Name</label> : <input type="text" name="name" id="name" placeholder="Enter Product name" title="3 to 20 characters"> <br>

			<label for="price">Price</label> : <input type="number" name="price" id="price" placeholder="Enter product price"> <br>

			<label for="category">Category</label> : <select name="category">
			
			<?php foreach ($categoryList as $row)
			{ ?>
				<option value="<?php echo $row["id"] ?>"><?php echo $row["name"]; ?></option>
			<?php }

			?>
			</select>

			<a href="add_category.php">Create New Category</a><br><br>

			<input type="submit" value="Add product">
			
		</form>

	</body>

	<a href="admin.php">Back to MY_ADMIN</a>

		<?php include_once("footer.php"); ?>

</html>




