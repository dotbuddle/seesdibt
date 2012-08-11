<?php
date_default_timezone_set('Asia/Chongqing');
$days=date("d");
if(($days)==0)//每15天停止
{
return false; 
}
else
{
return true; //返回假则停止
}
?>