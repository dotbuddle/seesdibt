<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>看山商-山商新闻-教务处-学生处-就业指导中心-韶华网</title>
</head>

<body>
<table width="100%" border="0" cellspacing="0">
  <tr>
    <td><div align="center"><a href="index.php">首页</a></div></td>
    <td><div align="center"><a href="index.php?class=1">校园新闻</a></div></td>
    <td><div align="center"><a href="index.php?class=2">教务处</a></div></td>
    <td><div align="center"><a href="index.php?class=6">学生处</a></div></td>
    <td><div align="center"><a href="index.php?class=5">就业处</a></div></td>
    <td><div align="center"><a href="index.php?class=4">团委</a></div></td>
    <td><div align="center"><a href="index.php?class=3">社联</a></div></td>
  </tr>
</table>
<br />
<br />
<table width="90%" border="0" align="center" cellspacing="0">

<?php
include 'conn.php';
if (!empty($_GET['class'])&&$_GET['class']<7&&$_GET['class']>0){
	$getclass=$_GET['class'];
	$sql="select * from content where class='$getclass' order by id desc";
}else if(!empty($_GET['search'])){
	$getseach=$_GET['search'];
	$sql="select * from content where title like '$getseach' order by id desc";
}else{
	$sql="select * from content order by id desc";
}
$rs=mysql_query($sql);
while ($arr=mysql_fetch_array($rs)){
	
	switch ($arr['class']){
		case 1:
			$class="校园新闻";
			break;
		case 2:
			$class="教务处";
			break;
		case 3:
			$class="社联";
			break;
		case 4:
			$class="团委";
			break;
		case 5:
			$class="就业处";
			break;
		case 6:
			$class="学生处";
			break;
		default:
			break;
	}
	?>
	<tr>
    <td><a href="index.php?class=<?php echo $arr['class']?>"><?php echo $class;?></a></td>
    <td><a href="view.php?id=<?php echo $arr['id']?>"><?php echo $arr['title'];?></a></td>
    <td>热度</td>
    <td><?php echo $arr['date']?></td>
    </tr>
	<?php 
}?>

</table>
<br />
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="50%"><div align="right">上一页||</div></td>
    <td width="50%"><div align="left">||下一页</div></td>
  </tr>
</table>
<br />
<br />
<div id="footer" align="center">关于这||联系我</div>
</body>
</html>