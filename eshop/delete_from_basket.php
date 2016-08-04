<?php
	// подключение библиотек
	require "inc/lib.inc.php";
	require "inc/db.inc.php";
	$id=$_GET['del'];
	deleteFromBasket($id);
   header('Location: basket.php');
?>