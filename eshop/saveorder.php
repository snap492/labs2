<?php
	require "inc/lib.inc.php";
	require "inc/db.inc.php";
if ($_SERVER["REQUEST_METHOD"]=="POST"){
	$name = clearStr($_POST['name']) ;
	$email = clearStr($_POST['email']) ;
	$phone = clearInt($_POST['phone']) ;
	$address = clearStr($_POST['address']) ;
	$orderID = $basket['orderid'];
	$dt = date ("d-m-Y H:i:s");

$order="$name | $email | $phone | $address | $orderID | $dt \n";
file_put_contents (ORDERS_LOGS, $order, FILE_APPEND);
}
if(saveOrder($dt) == true){


?>
<html>
<head>
	<title>Сохранение данных заказа</title>
</head>
<body>

	<p>Ваш заказ принят.</p>
	<?=$dt;?>
<?}?>
	<p><a href="catalog.php">Вернуться в каталог товаров</a></p>
</body>
</html>