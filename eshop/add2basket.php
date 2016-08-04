<?php
	// подключение библиотек
	require "inc/lib.inc.php";
	require "inc/db.inc.php";
	$id=$_GET['id'];
	$q=quantity($id);
	add2Basket($id,$q);
	header('Location: catalog.php');


