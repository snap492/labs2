<?php
/********************************
 * блок обработки входных данных*
 * *****************************/
/**
 * @param $data
 * @return string
 */
function clearStr($data){
   return trim(strip_tags($data));
}
/**
 * @param $data
 * @return number
 */
function clearInt($data){
   return abs((int)$data);
}
/**
 * @param $data
 * @return string
 */
function clearSQL($data){
   global $link;
   return mysqli_real_escape_string($link, clearStr($data));
}
/**************************************
 *конец блока обработки входных данных*
 *************************************/
///////////////////////////////////////////////
/*********************************************
*Блок функций по управлению корзиной магазина*
*********************************************/
function saveBasket()
{
   global $basket;
   $basket = base64_encode(serialize($basket));
   setcookie('basket', $basket, 0x7fffffff);
}
//функция basketInit(), создает либо загружает в переменную
//$basket корзину с товарами, либо создает новую корзину с идентификатором заказа
function basketInit(){
   global $basket,$count;
   if(!isset ($_COOKIE['basket'])){
      $basket=array('orderid'=>uniqid());
      saveBasket();
   }else{
      $basket= unserialize(base64_decode($_COOKIE['basket']));
      $count= count($basket)-1;
   }
}
//функция add2Basket($id), добавляет товар в корзину пользователя
//и принимает в качестве аргумента идентификатор товара
/**
 * @param $id
 * @param $q
 */
function add2Basket($id,$q){
  global $basket;

  $basket[$id]=$q;
   saveBasket();
}
//функция которая увеличевает кол-во товара на еденицу при каждом переходе по ссылке товара
/**
 * @param $data
 * @return int
 */
function quantity($data){
   global $basket ;
   if(array_key_exists($data, $basket)){
      $result   = $basket[$data]+1;
      return $result;
   }
   $data=1;
   return $data;
}
/* функция myBasket(), возвращает всю пользовательскую корзину в
виде ассоциативного массива*/
/**
 * @return array|null
 */
function myBasket(){
   global $link;
   global $basket;
  
   $key = array_keys($basket);
   array_shift($key);
	if(!$key){
		$result=false;
		}
	else{	$keys = implode(", ",$key);
			$query = mysqli_query($link,"SELECT id, title, author, pubyear, price
												FROM catalog
												WHERE id IN ($keys)");
			$result = mysqli_fetch_all($query,MYSQLI_ASSOC);
			}

	return $result ;
}
//функция удаления товара из корзины//
function deleteFromBasket ($data){
   global $basket;
   unset ($basket[$data]);
   saveBasket();
}

/********************************
*конец блока управления корзиной*
********************************/
/////////////////////////////////////////////////////////////////////////
/***************************
* блок управления каталогом*
***************************/
/**
 * @param $title
 * @param $author
 * @param $pubyear
 * @param $price
 * @return bool
 */
function addItemToCatalog($title, $author, $pubyear, $price){
   global $link;
     $sql_query= 'INSERT INTO catalog (title, author, pubyear, price)
                                    VALUES (?, ?, ?, ?);' ;
   if(!$stmt=mysqli_prepare($link, $sql_query)) {
      return false;
   }
   mysqli_stmt_bind_param($stmt, 'ssii', $title, $author, $pubyear, $price);
   mysqli_stmt_execute($stmt);
   mysqli_stmt_close($stmt);
      return true;
}
/**
 * @return array|null
 */
function selectAllItem() {
   global $link;
   $sql= mysqli_query($link,'SELECT id,title, author, pubyear, price FROM catalog')
                     or die (mysqli_error($link));
   $result=mysqli_fetch_all($sql,MYSQLI_ASSOC);
   return $result;

}
/**********************************
* конец блока управления катологом*
**********************************/
/////////////////////////////////////////
/*************************
* блок управления заказом*
*************************/
 function saveOrder($dT){
    global $link, $basket;
    $goods=myBasket();
    $stmt=mysqli_stmt_init($link);
    $sql='INSERT INTO orders(title, author, pubyear, price, quantity, orderid, datetime)
                  VALUES (?,?,?,?,?,?,?);';

    if (!mysqli_stmt_prepare($stmt, $sql)){
       return false;
    }
    foreach ($goods as $item){
       mysqli_stmt_bind_param($stmt, 'ssiiiss', $item['title'],
           $item['author'], $item['pubyear'], $item['price'],
          $basket[$item['id']],$basket ['orderid'], $dT);
       mysqli_stmt_execute($stmt) or die (mysqli_error($link));
    }
    mysqli_stmt_close($stmt);
    setcookie('basket', "",time() -3600);
    return true;
 }
function getOrders(){
   global $link;
   $orders = array();
      $order = file('orders.log');
  
      foreach($order as $val) {
         list($name, $email, $phone, $address, $orderid, $dt) = explode('|', $val);
      $orderinfo=array();
         $orderinfo['name']=$name;
         $orderinfo['email']=$email;
         $orderinfo['phone']=$phone;
         $orderinfo['address']=$address;
         $orderinfo['orderid']=$orderid;
         $orderinfo['dt']=$dt;
         $orderid=trim($orderid);
        $sql = "SELECT title, author, pubyear,
                       price, quantity
                FROM orders
                WHERE orderid LIKE '$orderid'";
         $result = mysqli_query($link, $sql) or die(mysqli_errno($link));
         $goods = mysqli_fetch_all($result, MYSQLI_ASSOC);
         $orderinfo['goods'] = $goods;
         $orders[] = $orderinfo;
         
      }
   return $orders;

}
/*******************************
*конец блока управления заказом*
*******************************/
//////////////////////////////////////

