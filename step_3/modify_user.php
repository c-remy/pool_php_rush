<?php

session_start();

include_once("database.php");
include_once("user.php");

$title = "Modify User";
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

if (isset($_POST['emailUserToEdit']) && filter_var($_POST['emailUserToEdit'], FILTER_VALIDATE_EMAIL))
{
	$userToEdit = $_POST['emailUserToEdit'];
	$flag_email = 1;
}
elseif (isset($_POST['emailUserToEdit']))
{
	echo "Invalid email for the user to edit";
	$flag_email = 0;
}

if (isset($_POST['name']))
	{
		$flag_name = $user->checkUserName($_POST['name']);
	}

if (isset($_POST['email']))
	{
		$flag_email = $user->checkUserEmailForEditOnly($_POST['email']);	
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
		$user->editUser($userToEdit, $_POST['name'], $_POST['email'], $passwordToSet, $admin);
		echo "User updated";
		echo "<br>";
	}



?>


<!-- <!DOCTYPE html>
<html>
	<head>
		<title>Modify User</title>
	</head> -->

	<body>

		<form method="post" action="modify_user.php">

			<label for="userToEdit">Email address of the user to edit</label> : <select name="emailUserToEdit">
			<?php

			$sth = $user->selectAllUsers();
			while ($row = $sth->fetch())
			{
				echo "<option>" . $row['email'] . "</option>";
			}

			?>
			 </select><br>

			<label for="name">Name</label> : <input type="text" name="name" id="name" placeholder="New username for user" title="3 to 10 characters"> <br>

			<label for="email">Email</label> : <input type="text" name="email" id="email" placeholder="New email for user"> <br>

			<label for="name">Password</label> : <input type="password" name="password" id="password" placeholder="New password for user" title="3 to 10 characters"> <br>

			<label for="name">Password confirmation</label> : <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Password confirmation" title="3 to 10 characters"><br>

			<input type="checkbox" name="admin" id="admin"><label for="admin">Admin</label><br><br>

			<input type="submit" value="Update user">
			
		</form>

	</body>

	<a href="admin.php">Back to MY_ADMIN</a>

	<?php include_once("footer.php"); ?>
</html>
