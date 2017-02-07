<?php

session_start();

include_once("database.php");
include_once("user.php");

$title = "Display User";
include_once("header.php");

$user = new User();

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
		<title>Display User</title>
	</head> -->

	<body>

		<form method="post" action="display_user.php">

			<label for="userToDisplay">Email address of the user to display</label> : <select name="emailUserToDisplay" >
			<?php

			$sth = $user->selectAllUsers();
			while ($row = $sth->fetch())
			{
				echo "<option>" . $row['email'] . "</option>";
			}

			?>
			</select><br>

			<input type="submit" value="Display user" name="display_user">
			
		</form>

	</body>

<?php

if (isset($_POST['display_user']))
{
	if (isset($_POST['emailUserToDisplay']))
	{
		$sth = $user->displayUser($_POST['emailUserToDisplay']);
		$res = $sth->fetch();
	?>

			<table>

				<tr>
					<th>Username</th>
					<th>Email</th>
					<th>Admin</th>
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

