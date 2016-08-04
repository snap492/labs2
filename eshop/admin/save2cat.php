<?php
	// подключение библиотек
	require "secure/session.inc.php";
	require "../inc/lib.inc.php";
	require "../inc/db.inc.php";
if($_SERVER['REQUEST_METHOD']=='POST') {
   $title = $_POST['title'];
   $author = $_POST['author'];
   $pubyear = $_POST['pubyear'];
   $price = $_POST['price'];

   if (!addItemToCatalog($title, $author, $pubyear, $price)) {
      echo "Произошла ошибка проверьте данные";
   } else {
      header('Location: add2cat.php');
      exit;
   }
}
?>