<?
$dt = date('d-m-Y H:i:s');
$page = $_SERVER['REQUEST_URI'];
$ref = $_SERVER['HTTP_REFERER'];
$path = "$dt | $page | $ref \n";
file_put_contents (PATH_LOG, $path, FILE_APPEND);