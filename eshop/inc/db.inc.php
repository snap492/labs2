<?php
header("Content-Type: text/html; charset= 'utf-8';");
define (DB_HOST, 'localhost');
define (DB_LOGIN, 'root');
define (DB_PWD,"");
define (DB_NAME, 'eshop');
define(ORDERS_LOGS, 'admin\orders.log');
define(FILE_NAME,'admin\secure\.htpsswd');
$link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME)or die (mysqli_error($link));
$basket=array();
$count=0;
basketInit();