<?
if(file_exists(PATH_LOG)){
	$log = file(PATH_LOG);
	foreach($log as $val){
		list($dt, $page, $ref)=explode('|', $val);
		echo "<p>$dt - $ref ==> $page </br></p>";
	}
}