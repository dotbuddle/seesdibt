<?php
ignore_user_abort();//�ص��������PHP�ű�Ҳ���Լ���ִ��.
set_time_limit(0);// ͨ��set_time_limit(0)�����ó��������Ƶ�ִ����ȥ
$interval=60*60*6;// ÿ��6Сʱִ��һ��

do{
$run = require_once 'switch.php';
if($run) die('process abort');
//��������Ҫִ�еĴ��� 

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