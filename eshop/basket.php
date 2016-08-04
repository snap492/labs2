<?php
	// подключение библиотек
	require "inc/lib.inc.php";
	require "inc/db.inc.php";
?>
<html>
<head>
	<title>Корзина пользователя</title>
</head>
<body>
	<h1>Ваша корзина</h1>
<?php
$var=1;
global $basket;
if(myBasket()==false){
	echo "<h3>Корзина пуста.вернитесь в <a href='catalog.php'>каталог</a></h3>";
}else{
echo "<blockquote>Заказ №: '".$basket['orderid']." '!</blockquote>";

?>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
<tr>
	<th>N п/п</th>
	<th>Название</th>
	<th>Автор</th>
	<th>Год издания</th>
	<th>Цена, руб.</th>
	<th>Количество</th>
	<th>Удалить</th>
</tr>
<?php

foreach(myBasket() as $books){
   $id=$books['id'];
$q=(int)$basket[$id];
?>
	<tr>
		<td><?= $var++; ?></td>
		<td><?=$books['title'];?></td>
		<td><?=$books['author'];?></td>
		<td><?=$books['pubyear'];?></td>
		<td><?=$books['price'];?></td>
		<td><?= $q;?></td>
		<td><a href="delete_from_basket.php?del=<?=$id?>">Удалить</a></td>
	</tr>
<?
   $sum+=$books['price']*$q;
	}
}
?>
</table>

<p>Всего товаров в корзине на сумму:<?=$sum;?> руб.</p>

<div align="center">
	<input type="button" value="Оформить заказ!"
                      onClick="location.href='orderform.php'" />
</div>

</body>
</html>







