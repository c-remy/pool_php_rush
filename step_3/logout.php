<?php

session_start();
session_destroy();

if (isset($_COOKIE['name']) && isset($_COOKIE['email']) && isset($_COOKIE['admin']))
{
	setcookie('name', '', time() - 3600);	
	setcookie('email', '', time() - 3600);	
	setcookie('admin', '', time() - 3600);	
}

header('Location: login.php');

?>