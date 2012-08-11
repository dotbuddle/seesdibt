<?php
ignore_user_abort();//关掉浏览器，PHP脚本也可以继续执行.
set_time_limit(0);// 通过set_time_limit(0)可以让程序无限制的执行下去
$interval=60*60*6;// 每隔6小时执行一次

do{
$run = require_once 'switch.php';
if($run) die('process abort');
//这里是你要执行的代码 

//---------------------------------------
/*
date_default_timezone_set('Asia/Chongqing');
$sql="insert into test(updatetime) values('".date("Y-m-d H:i:s")."')";
mysql_query($sql);
echo $sql;
echo date("Y-m-d H:i:s");

*/
//----------------------------------------
sleep($interval);// 
}while(true);

?>