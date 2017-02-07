<?php

session_start();

include_once("database.php");
include_once("user.php");

$title = "Delete User";
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


$flag_email = 0;

$user = new User();

if (isset($_POST['emailUserToDelete']) && filter_var($_POST['emailUserToDelete'], FILTER_VALIDATE_EMAIL))
{
	$userToDelete = $_POST['emailUserToDelete'];
	$flag_email = 1;
}
elseif (isset($_POST['emailUserToDelete']))
{
	echo "Invalid email for the user to delete";
	$flag_email = 0;
}


if ($flag_email == 1)
	{
		$user->deleteUser($userToDelete);
		echo "User deleted";
		echo "<br>";
	}

?>


<!-- <!DOCTYPE html>
<html>
	<head>
		<title>Delete User</title>
	</head> -->

	<body>

		<form method="post" action="delete_user.php">

			<label for="emailUserToDelete">Email address of the user to delete</label> : <select name="emailUserToDelete" >
			<?php

			$sth = $user->selectAllUsers();
			while ($row = $sth->fetch())
			{
				echo "<option>" . $row['email'] . "</option>";
			}

			?>
			</select><br>

			<input type="submit" value="Delete user">
			
		</form>

	</body>

	<a href="admin.php">Back to MY_ADMIN</a>

		<?php include_once("footer.php"); ?>

</html>
