<?php
	include 'conn.php';
	$con="";
	//获取列表信息的连接
	$urlxyxw="http://www.sdibt.edu.cn/list.php?fid=5&page=";//校园新闻 
	$urljwc="http://jwc.sdibt.edu.cn/SmallClass.asp?BigClassName=%D0%C5%CF%A2%B7%A2%B2%BC&SmallClassName=%D0%C2%CE%C5%B6%AF%CC%AC&page=";
	$urlsldt="http://www.shaohua.cn/2008/plus/list.php?tid=292&PageNo=";//社联动态
	$urlgqt="http://www.shaohua.cn/2008/html/gongqingtuan/tuannadongtai/list_56_";// 共青团list_56_1.html
	$urljyzc="http://career.sdibt.edu.cn/career/zczp/list_3_"; //专场招聘list_3_1.html
	$urljygg="http://career.sdibt.edu.cn/career/tongzhi/list_2_"; //公告栏list_2_1.html
	//*****http://xsc.sdibt.edu.cn/news/news_view.asp?newsid=  学生处的新闻,不用取list


	if (!empty($_GET['class'])&&!empty($_GET['page'])){
		$getclass=$_GET['class'];
		$getpage=$_GET['page'];
			//判断
			if ($getclass==6){		
		$flag_sql="select `title` from temp_url where class=5 order by id desc limit 1";
		$flag_rs=mysql_query($flag_sql);
		$flag_arr_rs=mysql_fetch_array($flag_rs);
		$flag_title=$flag_arr_rs['title'];
		echo $flag_title;
			}else {
				
		$flag_sql="select `title` from temp_url where class=$getclass order by id desc limit 1";
		$flag_rs=mysql_query($flag_sql);
		$flag_arr_rs=mysql_fetch_array($flag_rs);
		$flag_title=$flag_arr_rs['title'];
		echo $flag_title;
			}
		
		switch ($getclass){
			case 1: //校园新闻
				$urlqian="http://www.sdibt.edu.cn/";
				$urlli=$urlxyxw.$getpage;
				$preg="#<span class=\"title\"><a href=\"(.*)\" target=\"_self\" title='(.*)'>(.*)</a></span>(.*)<span class=\"time\">\[(.*)\]</span>#iUs";
				break;
			case 2://教务处
				$urlqian="http://jwc.sdibt.edu.cn/";
				$urlli=$urljwc.$getpage;
				$preg="#<a class=white_bg href=\"(.*)\" target=_blank><img src=images/dian.gif border=\"0\">(.*)</a><font color=\"\#666666\">\((.*)\)\[<font color=#iUs";
				break;
			case 3://社联动态
				$urlqian="http://www.shaohua.cn/2008/html/shelian/zxdt/";
				$urlli=$urlsldt.$getpage;
				$preg="#<a href=\"/2008/html/shelian/zxdt/(\d\d\d\d)/(\d\d)(\d\d)/(.*)\.html\" class=\"title\">(.*)</a>#iUs";
				break;
			case 4://共青团
				$urlqian="http://www.shaohua.cn/2008/html/gongqingtuan/tuannadongtai/";
				$urlli=$urlgqt.$getpage.".html";
				//echo $urlli;
				$preg="#<a href=\"/2008/html/gongqingtuan/tuannadongtai/(\d\d\d\d)(\d\d)(\d\d)/(.*)\.html\" class=\"title\">(.*)</a>#iUs";
				break;
			case 5://就业专场
				$urlqian="http://career.sdibt.edu.cn";
				$urlli=$urljyzc.$getpage.".html";
				$preg="#<li><span>\[(\d\d\d\d-\d\d-\d\d) (\d\d:\d\d:\d\d)\]</span>·<a href=\"(.*)\" class=\"title\"><b>(.*)</b></a></li>#iUs";
				break;
			case 6://就业公告
				$urlqian="http://career.sidbt.edu.cn";
				$urlli=$urljygg.$getpage.".html";
				$preg="#<li><span>\[(\d\d\d\d-\d\d-\d\d) (\d\d:\d\d:\d\d)\]</span>·<a href=\"(.*)\" class=\"title\"><b>(.*)</b></a></li>#iUs";
				break;
			default:
				echo "switch default error!";
				break;
		}

			while ($getpage<2){
			//echo $urlli;
			$con.=file_get_contents($urlli);
			$getpage++;
			//echo "<script>location.href='list.php?class='.$getclass.'&page='.$getpage'</script>";
			$con=preg_replace("/\s+/", " ", $con);//过滤多余回车
			preg_match_all($preg,$con,$arr);
			//print_r($arr);
			switch ($getclass){
				case 1:
						//校园新闻专用的数组
				$arr[1]=array_reverse($arr[1]);
				$arr[3]=array_reverse($arr[3]);
				$arr[5]=array_reverse($arr[5]);
				//print_r($arr[1]);//arr[1]=url
				//print_r($arr[3]);//arr[3]=title
				//print_r($arr[5]);//arr[5]=date
				foreach ($arr[1] as $id=>$value ){
				$url_temp=$urlqian.$value;
				$title_temp=$arr[3][$id];
				$date_temp=$arr[5][$id];
				if ($title_temp!=$flag_title){
					$sql="INSERT INTO temp_url (`id`,`class`,`title`,`date`,`url`) VALUES (NULL,'$getclass','$title_temp','$date_temp','$url_temp')";
					mysql_query($sql);
					//echo $sql;
				}else {
					if($getclass<6){
					$getclass++;
					echo "<script>location.href='list.php?class=".$getclass."&page=1'</script>";
					exit();
					}else {//如果class<=7则跳转到view.php开始更新内容
					echo "<script>location.href='view.php?class=1'</script>";	
					}
				}
				}	
				$getclass++;
				echo "<script>location.href='list.php?class=".$getclass."&page=1'</script>";
				break;
				case 2:
						//教务处
				$arr[1]=array_reverse($arr[1]);
				$arr[2]=array_reverse($arr[2]);
				$arr[3]=array_reverse($arr[3]);
				foreach ($arr[1] as $id=>$value ){
				$url_temp=$urlqian.$arr[1][$id];
				$title_temp=$arr[2][$id];
				$date_temp=$arr[3][$id];
				if ($title_temp!=$flag_title){
					$sql="INSERT INTO temp_url (`id`,`class`,`title`,`date`,`url`) VALUES (NULL,'$getclass','$title_temp','$date_temp','$url_temp')";
					mysql_query($sql);
					//echo $sql;
				}else {
					$getclass++;
					echo "<script>location.href='list.php?class=".$getclass."&page=1'</script>";
					exit();
				}
				}
				$getclass++;
				echo "<script>location.href='list.php?class=".$getclass."&page=1'</script>";	
				break;
				case 3:
						//社联动态
				$arr[1]=array_reverse($arr[1]);
				$arr[2]=array_reverse($arr[2]);
				$arr[3]=array_reverse($arr[3]);
				$arr[4]=array_reverse($arr[4]);
				$arr[5]=array_reverse($arr[5]);
				foreach ($arr[1] as $id=>$value ){
				$url_temp=$urlqian.$arr[1][$id]."/".$arr[2][$id].$arr[3][$id]."/".$arr[4][$id].".html";
				$title_temp=Html2Text($arr[5][$id]);
				$date_temp=$arr[1][$id]."-".$arr[2][$id]."-".$arr[3][$id];
				if ($title_temp!=$flag_title){
					$sql="INSERT INTO temp_url (`id`,`class`,`title`,`date`,`url`) VALUES (NULL,'$getclass','$title_temp','$date_temp','$url_temp')";
					mysql_query($sql);
					//echo $sql;
				}else {
					$getclass++;
					echo "<script>location.href='list.php?class=".$getclass."&page=1'</script>";
					exit();
				}
				}
				$getclass++;
				echo "<script>location.href='list.php?class=".$getclass."&page=1'</script>";
				break;
				case 4:
						//共青团
				$arr[1]=array_reverse($arr[1]);
				$arr[2]=array_reverse($arr[2]);
				$arr[3]=array_reverse($arr[3]);
				$arr[4]=array_reverse($arr[4]);
				$arr[5]=array_reverse($arr[5]);
				foreach ($arr[1] as $id=>$value ){
				$url_temp=$urlqian.$arr[1][$id]."/".$arr[2][$id].$arr[3][$id]."/".$arr[4][$id].".html";
				$str=$arr[5][$id];//转码
				//$str=iconv("GBK", "UTF-8", $str);
				$title_temp=Html2Text($str);
				$date_temp=$arr[1][$id]."-".$arr[2][$id]."-".$arr[3][$id];
				if ($title_temp!=$flag_title){
					$sql="INSERT INTO temp_url (`id`,`class`,`title`,`date`,`url`) VALUES (NULL,'$getclass','$title_temp','$date_temp','$url_temp')";
					mysql_query($sql);
					//echo $sql;
				}else {
					$getclass++;
					echo "<script>location.href='list.php?class=".$getclass."&page=1'</script>";
					exit();
				}
				}
				$getclass++;
				echo "<script>location.href='list.php?class=".$getclass."&page=1'</script>";	
				break;
				case 5:
						//就业专场
				$arr[1]=array_reverse($arr[1]);
				$arr[3]=array_reverse($arr[3]);
				$arr[4]=array_reverse($arr[4]);
				foreach ($arr[1] as $id=>$value ){
				$url_temp=$urlqian.$arr[3][$id];
				$title_temp=$arr[4][$id];
				$date_temp=$arr[1][$id];
				if ($title_temp!=$flag_title){
					$sql="INSERT INTO temp_url (`id`,`class`,`title`,`date`,`url`) VALUES (NULL,'$getclass','$title_temp','$date_temp','$url_temp')";
					//echo $sql;
					mysql_query($sql);
				}else {
					$getclass++;
					echo "<script>location.href='list.php?class=".$getclass."&page=1'</script>";
					exit();
				}
				}
				$getclass++;
				echo "<script>location.href='list.php?class=".$getclass."&page=1'</script>";	
				break;
				case 6:
									//公告栏
		
				$arr[1]=array_reverse($arr[1]);
				$arr[3]=array_reverse($arr[3]);
				$arr[4]=array_reverse($arr[4]);
				foreach ($arr[1] as $id=>$value ){
				$url_temp=$urlqian.$arr[3][$id];
				$title_temp=$arr[4][$id];
				$date_temp=$arr[1][$id];
				if ($title_temp!=$flag_title){
					$sql="INSERT INTO temp_url (`id`,`class`,`title`,`date`,`url`) VALUES (NULL,'5','$title_temp','$date_temp','$url_temp')";
					//echo $sql;
					mysql_query($sql);
				}else {
					$getclass++;
					echo "<script>location.href='view.php?class=1'</script>";
					exit();
				}
				}
				$getclass++;
				echo "<script>location.href='view.php?class=1'</script>";	
				break;
				default:
					echo "list_switch_2:error";
					break;							
			}

			
			
			}
	}
	
	
?>