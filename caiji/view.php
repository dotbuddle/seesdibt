<?php
	include 'conn.php';
	$getclass=$_GET['class'];
	//正则
	$pregxyxw="#</font>次</div></td>(.*)<td height=\"2\">&nbsp;</td>#iUs";
	$pregjwc="#<td colspan=\"2\" align=\"left\" style=\"font-size:12px\">(.*)<td colspan=\"2\" align=\"center\" style=\"font-size:14px\">&nbsp;</td>#iUs";
	$pregsldt="#<div class=\"content\">(.*)<!-- /content -->#iUs";
	$preggqt="#<div class=\"content\">(.*)<!-- /content -->#iUs";
	$pregjyc="#<div id=\"ArticleCnt\">(.*)<!--<table width#iUs";
	$pregxsc="#<td height=\"22\" style=\"line-height:16pt;font-size:10.5pt;\">(.*)<center><hr size=1>#iUs";
	$pregxsc_title="#<font color=\"\#000080\" style=\"font-size: 15pt\">(.*)</font>#iUs";
	$pregxsc_date="#加入时间：(\d{4}-\d{1,2}-\d{1,2})#iUs";
	
			//判断
	$flag_sql="select `title` from content where class=$getclass order by id desc limit 1";
	$flag_rs=mysql_query($flag_sql);
	$flag_arr_rs=mysql_fetch_array($flag_rs);
	$flag_title=$flag_arr_rs['title'];
	echo $flag_title;
	
	if ($getclass==6){//class=6除外,狗日的学生处
		
		$xsc_url="http://xsc.sdibt.edu.cn/news/news_view.asp?newsid=";
		$xsc_sql="select * from content where class=6";
		$rs=mysql_query($xsc_sql);
		$arr=mysql_fetch_array($rs);
		$xsc_id=str_replace($xsc_url,"", $arr['url']);
		$xsc_id_stop=$xsc_id+4;
		while ($xsc_id<$xsc_id_stop){
			
			if ($con=file_get_contents($xsc_url.$xsc_id)){
			
			$con=file_get_contents($xsc_url.$xsc_id);
			$con=preg_replace("/\s+/", " ", $con);//过滤多余回车
			preg_match_all($pregxsc,$con,$arr_con);
			$content=Html2Text(str_replace("<hr size=1>", "", $arr_con[0][0]));
			preg_match_all($pregxsc_title, $con, $arr_title);
			preg_match_all($pregxsc_date, $con, $arr_date);
			print_r($arr_title);
			print_r($arr_date);
			$title=$arr_title[1][0];
			$date=$arr_date[1][0];
			$url=$xsc_url.$xsc_id;
			$class=6;
			if ($title!=$flag_title){
					$sql_into="INSERT INTO content (`id`,`class`,`title`,`date`,`content`,`url`) VALUES (NULL,'$class','$title','$date','$content','$url')";
					mysql_query($sql_into);
					//echo $sql_into;
					$xsc_id++;
				}else {
					exit();
				}
				
			}else {
				exit();
			}
			

			
		}
		
	}else {
		
	$sql_url="select * from temp_url where class=$getclass";
	$rs=mysql_query($sql_url);
	while($arr_rs=mysql_fetch_array($rs)){
		//print_r($arr_rs);
		if ($con=file_get_contents($arr_rs['url'])){
			
			$con=preg_replace("/\s+/", " ", $con);//过滤多余回车
			switch ($getclass){
			case 1://校园新闻
				preg_match_all($pregxyxw,$con,$arr);
				$title=$arr_rs['title'];
				$class=$arr_rs['class'];
				$date=$arr_rs['date'];
				$url=$arr_rs['url'];
				$content=Html2Text($arr[1][0]);
				if ($title!=$flag_title){
					$sql_into="INSERT INTO content (`id`,`class`,`title`,`date`,`content`,`url`) VALUES (NULL,'$class','$title','$date','$content','$url')";
					mysql_query($sql_into);
				}else {
					if($getclass<6){
						$getclass++;
						echo "<script>location.href='view.php?class=".$getclass."'</script>";
					exit();
					}
				}
				$getclass++;
				echo "<script>location.href='view.php?class=".$getclass."'</script>";	
				break;
			case 2://教务处
				preg_match_all($pregjwc,$con,$arr);
				$title=$arr_rs['title'];
				$class=$arr_rs['class'];
				$date=$arr_rs['date'];
				$url=$arr_rs['url'];
				$content=Html2Text($arr[0][0]);
				//print_r($arr[0][0]);
				if ($title!=$flag_title){
					$sql_into="INSERT INTO content (`id`,`class`,`title`,`date`,`content`,`url`) VALUES (NULL,'$class','$title','$date','$content','$url')";
					mysql_query($sql_into);
				}else {
					if($getclass<6){
						$getclass++;
						echo "<script>location.href='view.php?class=".$getclass."'</script>";
					exit();
					}
				}
				$getclass++;
				echo "<script>location.href='view.php?class=".$getclass."'</script>";					
				break;
			case 3://社联动态
				preg_match_all($pregsldt,$con,$arr);
				//print_r($arr);
				$title=$arr_rs['title'];
				$class=$arr_rs['class'];
				$date=$arr_rs['date'];
				$url=$arr_rs['url'];
				$content=Html2Text($arr[0][0]);
				//print_r($arr[0][0]);
				if ($title!=$flag_title){
					$sql_into="INSERT INTO content (`id`,`class`,`title`,`date`,`content`,`url`) VALUES (NULL,'$class','$title','$date','$content','$url')";
					mysql_query($sql_into);
					//echo $sql_into;
				}else {
					if($getclass<6){
						$getclass++;
						echo "<script>location.href='view.php?class=".$getclass."'</script>";
					exit();
					}
				}	
				$getclass++;
				echo "<script>location.href='view.php?class=".$getclass."'</script>";			
				break;
			case 4://共青团
				preg_match_all($pregsldt,$con,$arr);
				print_r($arr);
				$title=$arr_rs['title'];
				$class=$arr_rs['class'];
				$date=$arr_rs['date'];
				$url=$arr_rs['url'];
				$content=Html2Text($arr[0][0]);
				//print_r($arr[0][0]);
				if ($title!=$flag_title){
					$sql_into="INSERT INTO content (`id`,`class`,`title`,`date`,`content`,`url`) VALUES (NULL,'$class','$title','$date','$content','$url')";
					mysql_query($sql_into);
					//echo $sql_into;
				}else {
					if($getclass<6){
						$getclass++;
						echo "<script>location.href='view.php?class=".$getclass."'</script>";
					exit();
					}
				}
				$getclass++;
				echo "<script>location.href='view.php?class=".$getclass."'</script>";	
				break;
			case 5://就业专场
				preg_match_all($pregjyc,$con,$arr);
				$title=$arr_rs['title'];
				$class=$arr_rs['class'];
				$date=$arr_rs['date'];
				$url=$arr_rs['url'];
				$content=Html2Text($arr[0][0]);
				//print_r($arr[0][0]);
				if ($title!=$flag_title){
					$sql_into="INSERT INTO content (`id`,`class`,`title`,`date`,`content`,`url`) VALUES (NULL,'$class','$title','$date','$content','$url')";
					mysql_query($sql_into);
					//echo $sql_into;
				}else {
					if($getclass<6){
						$getclass++;
						echo "<script>location.href='view.php?class=".$getclass."'</script>";
					exit();
					}
				}
				$getclass++;
				echo "<script>location.href='view.php?class=".$getclass."'</script>";					
				break;
//			case 6://就业公告
//				preg_match_all($pregjyc,$con,$arr);
//				$title=$arr_rs['title'];
//				$class="5";//将就业公告与就业专场强制转换
//				$date=$arr_rs['date'];
//				$url=$arr_rs['url'];
//				$content=Html2Text($arr[0][0]);
//				//print_r($arr[0][0]);
//				if ($title!=$flag_title){
//					$sql_into="INSERT INTO content (`id`,`class`,`title`,`date`,`content`,`url`) VALUES (NULL,'$class','$title','$date','$content','$url')";
//					mysql_query($sql_into);
//				}else {
//					if($getclass<6){
//						$getclass++;
//						echo "<script>location.href='view.php?class=".$getclass."'</script>";
//					exit();
//					}
//				}
//				break;		
			//case 6://学生处

				
				//break;														
			default:
				break;
			
		}
			
			
		}else {
			$getclass++;
		}
		
	}
		
	}
		
	
	
?>