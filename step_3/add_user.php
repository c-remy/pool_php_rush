<?php

session_start();

include_once("database.php");
include_once("user.php");

$title = "Add User";
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
$flag_email = 0;
$flag_password = 0;
$admin = 0;

$user = new User();

if (isset($_POST['name']))
	{
		$flag_name = $user->checkUserName($_POST['name']);
	}

if (isset($_POST['email']))
	{
		$flag_email = $user->checkUserEmail($_POST['email'], $user);
	}
	
if (isset($_POST['password']) && isset($_POST['password_confirmation']))
	{
		$flag_password = $user->checkUserPassword($_POST['password'], $_POST['password_confirmation']);
	}

if (isset($_POST['admin']))
	{
		$admin = 1;
	}


if ($flag_name == 1 && $flag_email == 1 && $flag_password == 1)
	$flag++;

if ($flag == 1)
	{
		$passwordToSet = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$user->addUserAsAdmin($_POST['name'], $_POST['email'], $passwordToSet, $admin);
		echo "User created";
		echo "<br>";
	}

?>

<!-- <!DOCTYPE html>
<html>
	<head>
		<title>Add a user</title>
	</head> -->

	<body>

		<form method="post" action="add_user.php">

			<label for="name">Name</label> : <input type="text" name="name" id="name" placeholder="User name here" title="3 to 10 characters"> <br>

			<label for="email">Email</label> : <input type="text" name="email" id="email" placeholder="User email here"> <br>

			<label for="name">Password</label> : <input type="password" name="password" id="password" placeholder="User password here" title="3 to 10 characters"> <br>

			<label for="name">Password confirmation</label> : <input type="password" name="password_confirmation" id="password_confirmation" placeholder="User password confirmation here" title="3 to 10 characters">

			<input type="checkbox" name="admin" id="admin"><label for="admin">Admin</label><br><br>

			<input type="submit" value="Add user">
			
		</form>

	</body>

	<a href="admin.php">Back to MY_ADMIN</a>

		<?php include_once("footer.php"); ?>

</html>


