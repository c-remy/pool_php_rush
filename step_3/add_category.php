<?php

session_start();

include_once("database.php");
include_once("product.php");
include_once("category.php");

$title = "Add Category";
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
$category = new Category();

$categoryList = $category->fetchCategoryTree();


if (isset($_POST['name']) && !empty($_POST['name']))
{
	$category->addCategory($_POST['name'], 0);
	echo "Category created";
	header('Location: add_category.php');
}
elseif (isset($_POST['category']) && isset($_POST['name_child']))
{
	$category->addCategory($_POST['name_child'], $_POST['category']);
	echo "Category created";

}

?>

<!-- <!DOCTYPE html>
<html>
	<head>
		<title>Create category</title>
	</head> -->

	<body>

		<form method="post" action="add_category.php">

			<label for="name">Name of new parent category</label> : <input type="text" name="name" id="name" placeholder="Enter new Category name" title="3 to 20 characters"> <br><br>


			<label for="category">Category</label> : <select name="category">
			
			<?php foreach ($categoryList as $row)
			{ ?>
				<option value="<?php echo $row["id"] ?>"><?php echo $row["name"]; ?></option>
			<?php }

			?>
			</select><br>

			<label for="name">Name of new child category</label> : <input type="text" name="name_child" id="name" placeholder="Enter new Category name" title="3 to 20 characters"> <br><br>

			<input type="submit" value="Add category">
			
		</form>

	</body>

	<a href="add_product.php">Back to Add Product</a>
	<a href="modify_product.php">Back to Modify Product</a>
	<a href="admin.php">Back to MY_ADMIN</a>

		<?php include_once("footer.php"); ?>

</html>