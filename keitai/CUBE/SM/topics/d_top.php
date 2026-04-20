<?php
$ad_blog=new Admin_Blog($dbobj);

if($_GET["pmode"]=="delete"&&$_GET["delid"]!=NULL) {
	$ad_blog->DeleteOneData($_GET["delid"]);
}
if($_REQUEST["btm_upata"]=="更新する") {

	$ad_blog->UpdateDataList($_POST);
	
}
if($_GET["blog_id"]!=NULL) {
	$topicsdata=$dbobj->GetData("select * from blog_data where blog_id= ".$_GET["blog_id"]."");
		$_GET["year"]=$topicsdata["ryear"];
		$_GET["month"]=$topicsdata["rmonth"];
		
}
else if($_GET["year"]!=NULL&&$_GET["month"]!=NULL){
	$topicsdata=$dbobj->GetData("select * from blog_data where ryear=".$_GET["year"]." and rmonth=".$_GET["month"]." order by rdate desc, blog_id desc");
		$_GET["year"]=$topicsdata["ryear"];
		$_GET["month"]=$topicsdata["rmonth"];
	$_GET["blog_id"]=$topicsdata["blog_id"];
}
else if($_GET["year"]!=NULL){
	$topicsdata=$dbobj->GetData("select * from blog_data where ryear=".$_GET["year"]." order by rdate desc, blog_id desc");
	$_GET["blog_id"]=$topicsdata["blog_id"];
		$_GET["year"]=$topicsdata["ryear"];
		$_GET["month"]=$topicsdata["rmonth"];
}
else if($_GET["month"]!=NULL) {
$_GET["year"]=date("Y");
	$topicsdata=$dbobj->GetData("select * from blog_data where ryear=".$_GET["year"]." and rmonth=".$_GET["month"]." order by rdate desc, blog_id desc");
	$_GET["blog_id"]=$topicsdata["blog_id"];
		$_GET["year"]=$topicsdata["ryear"];
		$_GET["month"]=$topicsdata["rmonth"];
}
else {
	$topicsdata=$dbobj->GetData("select * from blog_data order by rdate desc, blog_id desc");
	$_GET["blog_id"]=$topicsdata["blog_id"];
		$_GET["year"]=$topicsdata["ryear"];
		$_GET["month"]=$topicsdata["rmonth"];
}

$topicsnxdata=$dbobj->GetData("select * from blog_data where blog_id > ".$_GET["blog_id"]."  order by blog_id");
$topicsbfdata=$dbobj->GetData("select * from blog_data where blog_id < ".$_GET["blog_id"]."  order by blog_id desc");

if($_GET["year"]==NULL&&$_GET["month"]==NULL) {
	$newbloglistdata=$dbobj->GetData("select * from blog_data  order by rdate desc, blog_id desc");
	$_GET["year"]=$newbloglistdata["ryear"];
	$_GET["month"]=$newbloglistdata["rmonth"];
}
else if($_GET["year"]==NULL&&$_GET["month"]==NULL) {
	$newbloglistdata=$dbobj->GetData("select * from blog_data  order by rdate desc, blog_id desc");
	$_GET["year"]=$newbloglistdata["ryear"];
	$_GET["month"]=$newbloglistdata["rmonth"];
}
else if($_GET["year"]==NULL) {
	$newbloglistdata=$dbobj->GetData("select * from blog_data where rmonth=".$_GET["month"]." order by rdate desc, blog_id desc");
	$_GET["year"]=$newbloglistdata["ryear"];
}else if($_GET["year"]==NULL) {
	$newbloglistdata=$dbobj->GetData("select * from blog_data where rmonth=".$_GET["month"]." order by rdate desc, blog_id desc");
	$_GET["year"]=$newbloglistdata["ryear"];
}
else if($_GET["month"]==NULL) {
	$newbloglistdata=$dbobj->GetData("select * from blog_data where  ryear = ".$_GET["year"]." order by rdate desc, blog_id desc");
	$_GET["month"]=date("m");
}
else if($_GET["month"]==NULL) {
	$newbloglistdata=$dbobj->GetData("select * from blog_data where  ryear = ".$_GET["year"]." order by rdate desc, blog_id desc");
	$_GET["month"]=date("m");
}

$newblogsql="select * from blog_data where rmonth=".$_GET["month"]." and ryear = ".$_GET["year"]." order by rdate desc, blog_id desc";
$newblogdata=$dbobj->GetList($newblogsql);
$yearlist=$dbobj->GetList("select distinct ryear from blog_data  order by ryear desc");
$monthlist=$dbobj->GetList("select distinct rmonth from blog_data where ryear = ".$_GET["year"]." order by rmonth desc");
$catelist=$dbobj->GetList("select * from blog_cate  order by turn");

?><script language="javascript">
function delchk(name,id) {
	var res=confirm(name+"を削除してもよろしいですか？");
	
	if(res) {
		location.href="?PID=topics_list&pmode=delete&cate_id=<?php echo $_GET["cate_id"];?>&delid="+id;
	}
	
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<style type="text/css">
<!--
.text {font-family: "ＭＳ Ｐゴシック", Osaka, "ヒラギノ角ゴ Pro W3";
	font-size: 12px;
	line-height: 18px;
	color: #333333;
}
-->
</style>
<table border="0" align="left" cellpadding="0" cellspacing="0">
  
  <tr>
      <td>&nbsp;</td>
  </tr>
  <tr>
      <td>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                  <td width="2%"><img src="img/topics_icon.jpg" width="37" height="37"></td>
                  <td width="98%" class="title"><strong><?php echo $_GET["year"]."年".$_GET["month"]."月" ?>のトピックス</strong></td>
              </tr>
          </table>
        </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td>
      <form id="form1" name="form1" method="post" action="">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                  <td valign="top">
                      <table width="556" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                              <td colspan="3" width="556"><img src="img/topics/TopicsHeader.jpg" width="558" height="41" /></td>
                          </tr>
                          <tr>
                              <td width="18" background="img/topics/TopicsLeft.jpg"><img src="img/topics/TopicsLeft.jpg" width="20" height="43" /></td>
                              <td width="511">
                                  <table width="511" border="0" cellpadding="0" cellspacing="0">
                                      <tr>
                                          <td>
                                              <table width="511" border="0" cellspacing="0" cellpadding="0">
                                                  <tr>
                                                      <td class="maintitle"><strong><span class="yearmonth"><?php echo $topicsdata["ryear"];?>年<?php echo $topicsdata["rmonth"];?>月 <?php echo $catedata["cate_name"]; ?></span></strong></td>
                                                      <td class="maintitle">
                                                          <div align="right"><a href="?PID=topics_dadd"><img src="img/topics/new_topics.gif" width="106" height="29" border="0"></a></div>
                                                      </td>
                                                  </tr>
                                              </table>
                                          </td>
                                      </tr>
                                      <?php
												for($mi=0;$newblogdata[$mi]["blog_id"]!=NULL;$mi++) {
												?>
                                      <tr>
                                          <td><img src="img/topics/TopicsLine.jpg" width="507" height="13" /></td>
                                      </tr>
                                      <tr>
                                          <td>
                                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                  <tr>
                                                      <td><strong><span class="date"><?php echo str_replace("-","/",$newblogdata[$mi]["rdate"]);?></span></strong></td>
                                                      <td class="navi">
                                                          <div align="center">　</div>
                                                      </td>
                                                  </tr>
                                              </table>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td>&nbsp;</td>
                                      </tr>
                                      <tr>
                                          <td class="title">
                                              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                  <tr>
                                                      <td width="72%">■<?php echo $newblogdata[$mi]["title"];?> </td>
                                                      <td width="13%">
                                                          <a href="#" onClick="location.href='?PID=topics_dup&blog_id=<?php echo $newblogdata[$mi]["blog_id"];?>'"><img src="img/topics/up.gif" width="76" height="23" border="0"></a> </td>
                                                      <td width="3%">&nbsp;</td>
                                                      <td width="12%">
                                                          <a href="#" onClick="delchk('<?php echo $newblogdata[$mi]["title"];?>',<?php echo $newblogdata[$mi]["blog_id"];?>)"><img src="img/topics/del.gif" width="76" height="23" border="0"></a></td>
                                                  </tr>
                                              </table>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td valign="top">&nbsp;</td>
                                      </tr>
                                      <tr>
                                          <td valign="top" class="text"><span><?php echo $newblogdata[$mi]["comm"];?>
                                                      <?php if($newblogdata[$mi]["image"]!=NULL) {?>
                                                      <br />
                                                      <br />
                                                      <div align="center"> <img src="<?php echo $newblogdata[$mi]["image"];?>?<?php echo time();?>" alt="<?php echo strip_tags($newblogdata[$mi]["title"]);?>" /></div>
                                              <br />
                                                      <?php }?>
                                              </span><br /><div></div>
                                          </td>
                                      </tr>
                                      <?php
																																								}
																																								?>
                                      <tr>
                                          <td>
                                              <div align="center"></div>
                                          </td>
                                      </tr>
                                  </table>
                              </td>
                              <td width="24" background="img/topics/TopicsRight.jpg"><img src="img/topics/TopicsRight.jpg" width="24" height="43" /></td>
                          </tr>
                          <tr>
                              <td colspan="3" width="556"><img src="img/topics/TopicsFoot.jpg" width="558" height="27" /></td>
                          </tr>
                      </table>
                  </td>
                  <td valign="top">
                      <table width="200" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                              <td colspan="3"><img src="img/topics/TopicsList.jpg" width="210" height="41" /></td>
                          </tr>
                          <tr>
                              <td width="19" background="img/topics/TopicsMenuLeft.jpg"><img src="img/topics/TopicsMenuLeft.jpg" width="19" height="20" /></td>
                              <td width="163" valign="top">
                                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                      <?php
												for($mi=0;$newblogdata[$mi]["blog_id"]!=NULL;$mi++) {
												?>
                                      <tr>
                                          <td width="14" height="20" valign="top"><img src="img/topics/icon1.jpg" width="14" height="20" /></td>
                                          <td width="95%" height="20" align="left" valign="middle" class="cate"><a href="?PID=topics_dup&blog_id=<?php echo $newblogdata[$mi]["blog_id"];?>"><?php echo $newblogdata[$mi]["title"];?></a></td>
                                      </tr>
                                      <tr>
                                          <td height="5" colspan="2" valign="top"></td>
                                      </tr>
                                      <?php
														}
														?>
                                  </table>
                              </td>
                              <td width="28" align="right" background="img/topics/TopicsMenuRight.jpg"><img src="img/topics/TopicsMenuRight.jpg" width="28" height="20" /></td>
                          </tr>
                          <tr>
                              <td colspan="3"><img src="img/topics/TopicsMenuFoot.jpg" width="210" height="21" /></td>
                          </tr>
                      </table>
                      <table width="200" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                              <td colspan="3"><img src="img/topics/TopicsMonthlyHeader.jpg" width="210" height="43" /></td>
                          </tr>
                          <tr>
                              <td width="16" background="img/topics/TopicsMenuLeft.jpg"><img src="img/topics/TopicsMenuLeft.jpg" width="19" height="20" /></td>
                              <td width="163" valign="top">
                                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                      <?php
												for($mi=0;$monthlist[$mi]["rmonth"]!=NULL;$mi++) {
												?>
                                      <tr>
                                          <td width="14" height="20" valign="top"><img src="img/topics/icon2.jpg" width="14" height="20" /></td>
                                          <td width="95%" height="20" align="left" valign="middle" class="cate"><a href="?PID=topics_list&year=<?php echo $_GET["year"];?>&amp;month=<?php echo $monthlist[$mi]["rmonth"];?>"><?php echo $_GET["year"] ?>年<?php echo $monthlist[$mi]["rmonth"] ?>月 (
                                                      <?php
																$numdata=$dbobj->GetData("select count(rmonth) as monthnum from blog_data where ryear = ".$_GET["year"]." and rmonth=".$monthlist[$mi]["rmonth"]."");
																echo $numdata["monthnum"];
																?>
                                              )</a></td>
                                      </tr>
                                      <?php
														}
														?>
                                  </table>
                              </td>
                              <td width="8" background="img/topics/TopicsMenuRight.jpg"><img src="img/topics/TopicsMenuRight.jpg" width="28" height="20" /></td>
                          </tr>
                          <tr>
                              <td colspan="3"><img src="img/topics/TopicsMenuFoot.jpg" width="210" height="21" /></td>
                          </tr>
                      </table>
                      <table width="200" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                              <td colspan="3"><img src="img/topics/TopicsYearHeader.jpg" width="210" height="46" /></td>
                          </tr>
                          <tr>
                              <td width="19" background="img/topics/TopicsMenuLeft.jpg"><img src="img/topics/TopicsMenuLeft.jpg" width="19" height="20" /></td>
                              <td width="163" valign="top">
                                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                      <?php
												for($yi=0;$yearlist[$yi]["ryear"]!=NULL;$yi++) {
												?>
                                      <tr>
                                          <td width="14" height="20" valign="top"><img src="img/topics/icon3.jpg" width="14" height="20" /></td>
                                          <td width="163" height="20" align="left" valign="middle" class="cate"><a href="?PID=topics_list&year=<?php echo $yearlist[$yi]["ryear"]; ?>"><?php echo $yearlist[$yi]["ryear"]; ?>年</a></td>
                                      </tr>
                                      <?php
														}
														?>
                                  </table>
                              </td>
                              <td width="28" background="img/topics/TopicsMenuRight.jpg"><img src="img/topics/TopicsMenuRight.jpg" width="28" height="20" /></td>
                          </tr>
                          <tr>
                              <td colspan="3"><img src="img/topics/TopicsMenuFoot.jpg" width="210" height="21" /></td>
                          </tr>
                      </table>
                  </td>
              </tr>
          </table>
      </form>
    </td>
  </tr>
</table>
