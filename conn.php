<?php
@mysql_connect("localhost:3306","root","nihao");
@mysql_select_db("sdibt");
mysql_query("SET NAMES gbk");
function Text2Html($txt){
        $txt = str_replace("&lt;","<",$txt);
        $txt = str_replace("&gt;",">",$txt);
       // $txt = preg_replace("/[\r\n]{1,}/isU","<br/>\r\n",$txt);
        return $txt;
}
?>