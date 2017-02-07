<?php

session_start();

$title = "Admin Page";
include_once("header.php");


if (isset($_COOKIE['name']) && $_COOKIE['admin'] == "1")
{
	echo "Hello " . $_COOKIE['name']. ", you are admin.";
	echo "<br><br>";
}

elseif (isset($_SESSION['name']) && $_SESSION['admin'] == "1")
{
	echo "Hello " . $_SESSION['name']. ", you are admin.";
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
		<title>admin.php</title>
	</head> -->

	<body>

		<br><br><a href="add_user.php">Create user</a><br><br>
		<a href="delete_user.php">Delete user</a><br><br>
		<a href="modify_user.php">Edit user</a><br><br>
		<a href="display_user.php">Display user</a><br><br>
		<a href="add_product.php">Add a new product</a><br><br>
		<a href="delete_product.php">Delete product</a><br><br>
		<a href="modify_product.php">Edit product</a><br><br>
		<a href="display_product.php">Display product</a><br><br><br><br>
		<a href="index.php">Back to Homepage</a>

	</body>

		<?php include_once("footer.php"); ?>

</html>