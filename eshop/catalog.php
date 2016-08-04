<?php
	// подключение библиотек
	require "inc/lib.inc.php";
	require "inc/db.inc.php";
?>
<html>
<head>
	<title>Каталог товаров</title>
</head>
<body>
<p>Товаров в <a href="basket.php">корзине</a>: <?= $count?></p>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
<tr>
	<th>Название</th>
	<th>Автор</th>
	<th>Год издания</th>
	<th>Цена, руб.</th>
	<th>В корзину</th>
</tr>
<?php
$result=selectAllItem();
foreach($result as $values){
	?>
		<tr>
	<td> <?=$values['title']?> </td>
	<td><?= $values['author']?> </td>
	<td> <?=$values['pubyear']?> </td>
	<td> <?=$values['price']?> </td>
	<td><a href='add2basket.php?id=<?=$values['id']?>'> В корзину</a></td>
	</tr>
<?
}
?>
</table>
</body>
</html>