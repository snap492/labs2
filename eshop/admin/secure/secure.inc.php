<?
/******************************
 *блок управление безопасностью*
 ******************************/
function getHash($string, $salt, $iterationCnt){
   for ($i=0; $i<$iterationCnt; $i++){
      $string= sha1($string.$salt);
   }
   return $string;
}
function saveHash ($login, $hash, $salt,$iteration){
   $str="$login:$hash:$salt:$iteration\n";
   if(file_put_contents(FILE_NAME, $str, FILE_APPEND)){
      return true;
   }
   else return false;
}
function userExists($login){
   if(!is_file(FILE_NAME))
      return false;
   $users = file(FILE_NAME);
   foreach($users as $user){
      if(strpos($user, $login) !== false)
         return $user;
   }
   return false;
}