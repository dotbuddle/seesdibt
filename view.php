<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<style type="text/css">
<!--
a:link {
 text-decoration: none;
}
a:visited {
 text-decoration: none;
}
a:hover {
 text-decoration: underline;
}
a:active {
 text-decoration: none;
}
-->
</style>
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
<table width="80%" align="center" border="0" cellspacing="0">
  

<?php
include 'conn.php';
if(!empty($_GET['id'])){
	$getid=$_GET['id'];
	$sql="select * from content where id='$getid' limit 1";
}
$rs=mysql_query($sql);
while ($arr=mysql_fetch_array($rs)){
	?>
	<tr>
     <td align="center"><h3><?php echo $arr['title']?></h3></td>
  </tr>
   <tr>
     <td align="left">��Դ:<a href="<?php echo $arr['url']?>" target="_blank" ><?php echo $arr['url']?></a></td>
     <td width="20%" align="left">ʱ��:<?php echo $arr['date']?></td>
  </tr>
  </table>
  <br />
  <table width="80%" align="center">
  <tr>
		<td align="left"><?php echo Text2Html($arr['content'])?></td>
  </tr>
  </table>
  
	
	<?php 
}
?>


<br />
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="50%"><div align="right"><a href="view.php?id=<?php echo $getid++;?>">��һƪ</a>||</div></td>
    <td width="50%"><div align="left">||<a href="view.php?id=<?php echo $getid--;?>">��һƪ</a></div></td>
  </tr>
</table>
<!--����--->
<br />
<br />
<br />
<div id="footer" align="center">������||��ϵ��</div>
</body>
</html>