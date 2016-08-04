<?php
	require "secure/session.inc.php";
	require "../inc/lib.inc.php";
	require "../inc/db.inc.php";
$allOrders= getOrders();

?>
<html>
<head>
	<title>Поступившие заказы</title>
</head>
<body>
<h1>Поступившие заказы:</h1>
<?php
foreach ($allOrders as $orders) {
	?>
	<hr>
	<h2>Заказ номер:<?=$orders['orderid']?> </h2>
	<p><b>Заказчик</b>:<?=$orders['name']?> </p>
	<p><b>Email</b>:<?=$orders['email']?> </p>
	<p><b>Телефон</b>:<?=$orders['phone']?> </p>
	<p><b>Адрес доставки</b>: <?=$orders['address']?></p>
	<p><b>Дата размещения заказа</b>:<?=$orders['dt']?> </p>
	<?$cnt = 1;
	foreach ($orders['goods'] as $goods){
		var_dump($orders['goods']);
		?>
<h3>Купленные товары:</h3>
<table border="1" cellpadding="5" cellspacing="0" width="90%">
<tr>
	<th>N п/п</th>
	<th>Название</th>
	<th>Автор</th>
	<th>Год издания</th>
	<th>Цена, руб.</th>
	<th>Количество</th>
</tr>
	<tr>
	<td><?=$cnt++?></td>
	<td><?=$goods['title']?></td>
	<td><?=$goods['author']?></td>
	<td><?=$goods['pubyear']?></td>
	<td><?=$goods['price']?>, руб.</td>
	<td><?=$goods['quantity']?></td>
</tr>


</table>
<p>Всего товаров в заказе на сумму:<?=$goods['price']*$goods['quantity']?> руб.</p>
	<?}
}
?>
</body>
</html>