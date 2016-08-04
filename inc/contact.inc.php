<?
function strcut($str){
	return $str= trim(strip_tags($str));
}
$result='';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$sub=strcut($_POST['subject']);
	$text= strcut($_POST['body']);
	if(mail('admin@labs2.local', $sub,$text))
		$result = 'Ваше письмо успешно отправлено';
	else 
		$result = 'произошла ошибка при попытке отправки письма, попробуйте еще раз или повторите позднее.';
}

?>
<h3>Адрес</h3>
<p>123456 Москва, Малый Американский переулок 21</p>
<h3>Задайте вопрос</h3>
<p> <?= $result; ?> </p>
<form action='<?= $_SERVER['REQUEST_URI']?>' method='post'>
	<label>Тема письма: </label><br />
	<input name='subject' type='text' size="50"/><br />
	<label>Содержание: </label><br />
	<textarea name='body' cols="50" rows="10"></textarea><br /><br />
	<input type='submit' value='Отправить' />
</form>	
