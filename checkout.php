<?php
	session_start();
	unset($_SESSION['name_user']);
	unset($_SESSION['name_id']);
	unset($_SESSION['cart']);
	unset($_SESSION['total']);
	header('location:index.php');
?>