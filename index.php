<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>��ɽ��-ɽ������-����-ѧ����-��ҵָ������-�ػ���</title>
</head>

<body>
<table width="100%" border="0" cellspacing="0">
  <tr>
    <td><div align="center"><a href="index.php">��ҳ</a></div></td>
    <td><div align="center"><a href="index.php?class=1">У԰����</a></div></td>
    <td><div align="center"><a href="index.php?class=2">����</a></div></td>
    <td><div align="center"><a href="index.php?class=6">ѧ����</a></div></td>
    <td><div align="center"><a href="index.php?class=5">��ҵ��</a></div></td>
    <td><div align="center"><a href="index.php?class=4">��ί</a></div></td>
    <td><div align="center"><a href="index.php?class=3">����</a></div></td>
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
			$class="У԰����";
			break;
		case 2:
			$class="����";
			break;
		case 3:
			$class="����";
			break;
		case 4:
			$class="��ί";
			break;
		case 5:
			$class="��ҵ��";
			break;
		case 6:
			$class="ѧ����";
			break;
		default:
			break;
	}
	?>
	<tr>
    <td><a href="index.php?class=<?php echo $arr['class']?>"><?php echo $class;?></a></td>
    <td><a href="view.php?id=<?php echo $arr['id']?>"><?php echo $arr['title'];?></a></td>
    <td>�ȶ�</td>
    <td><?php echo $arr['date']?></td>
    </tr>
	<?php 
}?>

</table>
<br />
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="50%"><div align="right">��һҳ||</div></td>
    <td width="50%"><div align="left">||��һҳ</div></td>
  </tr>
</table>
<br />
<br />
<div id="footer" align="center">������||��ϵ��</div>
</body>
</html>