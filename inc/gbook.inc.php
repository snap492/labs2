<!-- Основные настройки -->
<?
define (DB_HOST, 'localhost');
define (DB_LOGIN, 'root');
define (DB_PWD,"");
define (DB_NAME, 'gbook');
$link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME);
include 'funct.inc.php';

?>
<!-- Основные настройки -->

<!-- Сохранение записи в БД -->
<?
if ($_SERVER['REQUEST_METHOD']=='POST'){
	if ($_POST ['submit']){
	$name = cutStrSQL($_POST['name']);
	$email = cutStrSQL($_POST['email']);
	$msg = cutStrSQL($_POST['msg']);
	
	$result = mysqli_query ($link, "INSERT INTO msgs (name, email, msg) 
												VALUES ('$name', '$email', '$msg')") or die (mysqli_error($link));
	echo "Ваша запись \"$msg\" успешно добавлена.";
	}
}
?>
<!-- Сохранение записи в БД -->

<!-- Удаление записи из БД -->
<?
if ($_SERVER['REQUEST_METHOD']=='GET'){
	cutStr($_GET['id']);
	$idDel = cutStr($_GET ['del']);
	$deleteSQL = mysqli_query($link, "DELETE FROM msgs WHERE id='$idDel'") or die(mysqli_error($link));
	echo"Запись удалена.";
}
?>
<!-- Удаление записи из БД -->
<h3>Оставьте запись в нашей Гостевой книге</h3>

<form method="post" action="<?= $_SERVER['REQUEST_URI']?>">
Имя: <br /><input type="text" name="name" /><br />
Email: <br /><input type="text" name="email" /><br />
Сообщение: <br /><textarea name="msg"></textarea><br />

<br />

<input type="submit" value="Отправить!" name = "submit" />
<input type="submit" value="Просмотреть" name="read" />

</form>
<!-- Вывод записей из БД -->
<?
if ($_SERVER['REQUEST_METHOD']=='POST'){
	if ($_POST['read']){
		$read = mysqli_query ($link, "SELECT id, name, email, msg, UNIX_TIMESTAMP(datetime) as dt
									 FROM msgs
									 ORDER BY id DESC;");
		$showQuery = mysqli_fetch_all($read);
		mysqli_close($link);
			$arrayCount = count($showQuery);
			echo "<p> Всего записей в гостивой книге: $arrayCount</p>";
		
			
			foreach ($showQuery as $val){
				list($idR, $nameR, $emailR, $masage, $dateR)= $val;
				$dateR = date ("d-m-Y в H:i", $dateR);
				echo <<<SHOW
					<p>
						<a href="mailto:$emailR">$nameR</a> $dateR написал
						<br />$masage.
					</p>
					<p align="right">
						<a href="http://labs2.local/index.php?id=gbook&del=$idR">Удалить</a>
					</p>
SHOW;


			}
	}
}

?>
<!-- Вывод записей из БД -->
