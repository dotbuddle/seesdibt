<?php
date_default_timezone_set('Asia/Chongqing');
$days=date("d");
if(($days)==0)//ÿ15��ֹͣ
{
return false; 
}
else
{
return true; //���ؼ���ֹͣ
}
?>