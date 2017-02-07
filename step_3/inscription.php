<?php

include_once("database.php");
include_once("user.php");

$title = "Inscription";
include_once("header.php");

$flag = 0;
$flag_name = 0;
$flag_email = 0;
$flag_password = 0;

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


if ($flag_name == 1 && $flag_email == 1 && $flag_password == 1)
	$flag++;

if ($flag == 1)
	{
		$passwordToSet = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$user->addUser($_POST['name'], $_POST['email'], $passwordToSet);
		echo "User created";
		echo "<br><br>";
	}

?>

<!-- <!DOCTYPE html>
<html>
	<head>
		<title>inscription</title>
	</head> -->

	<body>


		<form method="post" action="inscription.php">

			<label for="name">Name</label> : <input type="text" name="name" id="name" placeholder="Your name here" title="3 to 10 characters"> <br>

			<label for="email">Email</label> : <input type="text" name="email" id="email" placeholder="Your email here"> <br>

			<label for="name">Password</label> : <input type="password" name="password" id="password" placeholder="Your password here" title="3 to 10 characters"> <br>

			<label for="name">Password confirmation</label> : <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Your password confirmation here" title="3 to 10 characters">

			<input type="submit"><br><br>

		</form>

		<a href="login.php">Login</a>

	</body>
	<?php include_once("footer.php"); ?>
</html>
