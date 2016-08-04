<?
//обработка входящих строк
function cutStrSQL($date){
	global $link;
	return mysqli_real_escape_string($link, trim(strip_tags($date)));
}
function cutStr($date){
	return trim(strip_tags($date));
}
?>