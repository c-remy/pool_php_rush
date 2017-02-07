<?php

include_once("database.php");
include_once("user.php");

session_start();

$title = "Login Page";
include_once("header.php");

$user = new User();

if (isset($_POST['email']) && isset($_POST['password']))
{
	$emailToCheck = $_POST['email'];
	$passwordToCheck = $_POST['password'];

	$sth = $user->loginUser($emailToCheck);

	if ($sth->rowCount() == 0)
{
	echo "Incorrect email/password";
}
else
{
	
	$pass = $sth->fetch();

	if (password_verify($passwordToCheck, $pass[1]))
	{
		if (isset($_POST['remember_me']))
		{
			setcookie('name', $pass[2], time() + 3600*24*7);
			setcookie('email', $pass[0], time() + 3600*24*7);
			setcookie('admin', $pass[3], time() + 3600*24*7);
		}
		else 
		{
			$_SESSION['name'] = $pass[2];
			$_SESSION['email'] = $pass[0];
			$_SESSION['admin'] = $pass[3];	
		}
		header('Location: index.php');
		exit;
	}
	else
	{
		echo "Incorrect email/password";
	}

}



}

?>


<!-- <!DOCTYPE html>
<html>
	<head>
		<title>login</title>
	</head> -->

	<body>

		<form method="post" action="login.php">

			<label for="email">Email</label> : <input type="text" name="email" id="email"> <br>

			<label for="password">Password</label> : <input type="password" name="password" id="password"> <br>

			<input type="checkbox" name="remember_me" id="remember_me"><label for="remember_me">Remember me</label><br>

			<input type="submit" name="submit" value="Connect"><br><br>

		</form>

		<a href="inscription.php">Not registered ? Sign in !</a>

	</body>

	<?php include_once("footer.php"); ?>
</html>