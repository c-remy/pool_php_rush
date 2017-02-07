<?php

session_start();

$title = "Index";
include_once("header.php");

$admin = false;

if (isset($_COOKIE['name']))
{
	echo "Hello " . $_COOKIE['name'];
	echo "<br><br>";
	if ($_COOKIE['admin'] == "1")
	{
		$admin = true;
	}
}

elseif (isset($_SESSION['name']))
{
	echo "Hello " . $_SESSION['name'];
	echo "<br><br>";
	if ($_SESSION['admin'] == "1")
	{
		$admin = true;
	}
}

else
{
	header('Location: login.php');
}


?>

<?php

if (isset($_SESSION['name']) || isset($_COOKIE['name']))
{?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<a href="logout.php">LOGOUT</a>

</body>
</html>

<?php } ?>

<?php

if ((isset($_SESSION['name']) || isset($_COOKIE['name'])) && $admin == true)
{?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<a href="admin.php">MY_ADMIN</a>

</body>
</html>

<?php } ?>

<?php include_once("footer.php"); ?>
