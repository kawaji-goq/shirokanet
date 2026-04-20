<?php 
$ad_blog=new Admin_Blog($dbobj);
$blogcdata=$ad_blog->GetDetailsCate($_GET["cate_id"]);
$blogsetting=$ad_blog->LoadSetting();
if($_GET["syear"]==NULL){
$_GET["syear"]=date("Y");
}

if($_GET["smonth"]==NULL) {
	$_GET["smonth"]=date("m");
}

$jandata=$dbobj->GetData("select count(blog_id) as countnum from blog_data where ryear=".$_GET["syear"]." and rmonth=1");
$febdata=$dbobj->GetData("select count(blog_id) as countnum from blog_data where ryear=".$_GET["syear"]." and rmonth=2");
$mardata=$dbobj->GetData("select count(blog_id) as countnum from blog_data where ryear=".$_GET["syear"]." and rmonth=3");
$aprdata=$dbobj->GetData("select count(blog_id) as countnum from blog_data where ryear=".$_GET["syear"]." and rmonth=4");
$maydata=$dbobj->GetData("select count(blog_id) as countnum from blog_data where ryear=".$_GET["syear"]." and rmonth=5");
$jundata=$dbobj->GetData("select count(blog_id) as countnum from blog_data where ryear=".$_GET["syear"]." and rmonth=6");
$juldata=$dbobj->GetData("select count(blog_id) as countnum from blog_data where ryear=".$_GET["syear"]." and rmonth=7");
$auggdata=$dbobj->GetData("select count(blog_id) as countnum from blog_data where ryear=".$_GET["syear"]." and rmonth=8");
$sepdata=$dbobj->GetData("select count(blog_id) as countnum from blog_data where ryear=".$_GET["syear"]." and rmonth=9");
$ougdata=$dbobj->GetData("select count(blog_id) as countnum from blog_data where ryear=".$_GET["syear"]." and rmonth=10");
$novdata=$dbobj->GetData("select count(blog_id) as countnum from blog_data where ryear=".$_GET["syear"]." and rmonth=11");
$decdata=$dbobj->GetData("select count(blog_id) as countnum from blog_data where ryear=".$_GET["syear"]." and rmonth=12");

?><script type="text/javascript" src="/fckeditor/fckeditor.js"></script>

<script language="javascript">
function datachk() {
if(document.update_form.new_data_title.value!=""&&document.update_form.new_data_title.value!=null){
	res=confirm("この内容で登録してもよろしいですか?");
	if(res) {
		document.update_form.submit();
	}
	}
	else {
		alert("タイトルを入力してください。");
	}
}

function view_change(num) {
	switch(num) {
		case 0:
			document.all.type_link.style.display="none";
			document.all.type_text.style.display="block";
			break;
		case 1:
			document.all.type_link.style.display="block";
			document.all.type_text.style.display="none";
			break;
	}	
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<table width="700" border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
  		<td>
  				<table width="700" border="0" align="center">
							<tr>
									<td width="278"><img src="./img/siteadmin/edit_menu.gif" alt="編集中のエリア" width="278" height="18" /></td>
									<td width="412" align="left">
											<p><strong>　<?php echo $menudata[1]["data_name"]; ?>　&gt;&gt;　データ登録</strong></p>
									</td>
							</tr>
					</table>
  		</td>
 		</tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
      <td> <?php echo $_GET["syear"];?>
          <?php if($jandata["countnum"]!=0){?>
          <a href="?PID=blog&syear=<?php echo $_GET["syear"];?>&smonth=1">
          <font color="#FF6600"><?php }?>
          1月
          <?php if($jandata["countnum"]!=0){?>
          </font></a>
          <?php }?>
          <?php if($febdata["countnum"]!=0){?>
          <a href="?PID=blog&syear=<?php echo $_GET["syear"];?>&smonth=2">
          <font color="#FF6600"><?php }?>
2月
<?php if($febdata["countnum"]!=0){?>
          </font></a>
          <?php }?>
          <?php if($mardata["countnum"]!=0){?>
          <a href="?PID=blog&syear=<?php echo $_GET["syear"];?>&smonth=3">
          <font color="#FF6600"><?php }?>
3月
<?php if($mardata["countnum"]!=0){?></font>          </a>
          <?php }?>
          <?php if($aprdata["countnum"]!=0){?>
          <a href="?PID=blog&syear=<?php echo $_GET["syear"];?>&smonth=4">
          <font color="#FF6600"><?php }?>
4月
<?php if($aprdata["countnum"]!=0){?>
          </font></a>
          <?php }?>
          <?php if($maydata["countnum"]!=0){?>
          <a href="?PID=blog&syear=<?php echo $_GET["syear"];?>&smonth=5">
          <font color="#FF6600"><?php }?>
5月
<?php if($maydata["countnum"]!=0){?>
         </font> </a>
          <?php }?>
          <?php if($jundata["countnum"]!=0){?>
          <a href="?PID=blog&syear=<?php echo $_GET["syear"];?>&smonth=6">
          <font color="#FF6600"><?php }?>
6月
<?php if($jundata["countnum"]!=0){?>
          </font></a>
          <?php }?>
          <?php if($juldata["countnum"]!=0){?>
          <a href="?PID=blog&syear=<?php echo $_GET["syear"];?>&smonth=7">
          <font color="#FF6600"><?php }?>
7月
<?php if($juldata["countnum"]!=0){?>
         </font> </a>
          <?php }?>
          <?php if($augdata["countnum"]!=0){?>
          <a href="?PID=blog&syear=<?php echo $_GET["syear"];?>&smonth=8">
          <font color="#FF6600"><?php }?>
8月
<?php if($augdata["countnum"]!=0){?>
         </font> </a>
          <?php }?>
          <?php if($sepdata["countnum"]!=0){?>
          <a href="?PID=blog&syear=<?php echo $_GET["syear"];?>&smonth=9">
          <font color="#FF6600"><?php }?>
9月
<?php if($sepdata["countnum"]!=0){?>
         </font> </a>
          <?php }?>
          <?php if($octdata["countnum"]!=0){?>
          <a href="?PID=blog&syear=<?php echo $_GET["syear"];?>&smonth=10">
          <font color="#FF6600"><?php }?>
10月
<?php if($octdata["countnum"]!=0){?>
          </font></a>
          <?php }?>
          <?php if($novdata["countnum"]!=0){?>
          <a href="?PID=blog&syear=<?php echo $_GET["syear"];?>&smonth=11">
          <font color="#FF6600"><?php }?>
11月
<?php if($novdata["countnum"]!=0){?>
         </font> </a>
          <?php }?>
          <?php if($decdata["countnum"]!=0){?>
          <a href="?PID=blog&syear=<?php echo $_GET["syear"];?>&smonth=12">
          <font color="#FF6600"><?php }?>
12月
<?php if($decdata["countnum"]!=0){?>
          </font></a>
          <?php }?>
          <a href="?PID=blog&syear=<?php echo $_GET["syear"]-1;?>&smonth=<?php echo $_GET["smonth"];?>"><?php echo $_GET["syear"]-1;?></a> <a href="?PID=blog&syear=<?php echo $_GET["syear"]+1;?>&smonth=<?php echo $_GET["smonth"];?>"><?php echo $_GET["syear"]+1;?></a> </td>
  </tr>
  <tr>
      <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
      <form action="" method="post" enctype="multipart/form-data" name="update_form" id="update_form">
<?php 
if($_REQUEST["pmode"]=="regist") {
	$newid=$ad_blog->AdditionData($_POST);
	$blogdata=$ad_blog->GetDetailsData($newid);
?>
<script language="javascript">
location.replace('?PID=blog_list&syear=<?php echo $_REQUEST["ryear"];?>&smonth=<?php echo $_REQUEST["rmonth"];?>');
</script>
<?php
		}
		else {
		?>
				    <script>
<!--
//****月によって、日付のselect.optionを変更****
function check3(){
	year=document.update_form.ryear.value;
	month=document.update_form.rmonth.value;
	day=document.update_form.rday.value;
	day_cnt=31;
	if(month=="02"){
		if((year % 4 )!=0){day_cnt=28}	else{day_cnt=29}}
	if((month=="04")|(month=="06")|(month=="09")|(month=="11")){day_cnt=30}

//		前のSELECTをクリアー
			obj=eval("document.update_form.rday") 
			del_cnt=document.update_form.rday.length;
		for(i=0;i<del_cnt;i++){
			obj.options.remove(0);
		}
//		新しいSELECTを組立
		for(i=1;i<=day_cnt;i++){
			new_option=document.createElement("option");
				if(i<10){date="0" +i;} else {date=""+i;}
			new_option.value=date
			new_option.text=date
			obj=eval("document.update_form.rday") 
			obj.options.add(new_option,eval(obj.length));
		}
}
//****月によって、日付のselect.optionを変更****
function set_date_dft(){
		dft_date=document.all.dft_dat.value;
		document.update_form.ryear.value=dft_date.substr(0,4);
		document.update_form.rmonth.value=dft_date.substr(4,2);
		document.update_form.rday.value=dft_date.substr(6,2);
}
function day_chk() {
	if(document.update_form.day_view.checked){
		document.update_form.ryear.value="";
		document.update_form.rmonth.value="";
		document.update_form.rday.value="";
		
	}
	else {
		set_date_dft();
	}
}
//-->
</script>
<script type="text/javascript">
<!--

function on_load() {
    //==================================================================
    // FCK Editor
    
    var oFCKeditor = new FCKeditor( 'new_data_comm' );
    
    oFCKeditor.BasePath = '/fckeditor/';
    oFCKeditor.Width = '400';
    oFCKeditor.Height = '400';
    oFCKeditor.ToolbarSet = 'Mymenu4';
    
    oFCKeditor.ReplaceTextarea();

}

// -->

</script>
		<table width="600" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
        <?php
		if($blogdata["rdate"]!=NULL) {
			$exday=explode("-",$blogdata["rdate"]);
		}
		else {
			$exday=explode("-",date("Y-m-d"));
		}
		
		$RDATE=date("Ymd",mktime(0,0,0,$exday[1],$exday[2],$exday[0])); 
		$year=$exday[0];
		$month=$exday[1];
		$day=$exday[2];
		?>
          <tr>
            <th rowspan="1" align="left" valign="top" bgcolor="#ECECEC">日付
            <input name="dft_dat" type="hidden" id="dft_dat" value="<?php echo $RDATE;?>"></th>
            <td align="left" bgcolor="#FFFFFF"><select name="ryear" id="ryear" onChange="check3()">
			<option value="">--</option>
			<?php
			for($yi=-1;$yi<2;$yi++) {
				?>
				<option value="<?php echo $year+$yi;?>" <?php if($yi==0) {echo " selected";}?>><?php echo $year+$yi;?></option>
				<?php
			}
			?>
            </select>
年
<select name="rmonth" id="rmonth" onChange="check3()">
				<option value="">--</option>
		<?php
			for($mi=1;$mi<13;$mi++) {
				?>
				<option value="<?php if($mi<10) {echo "0";}echo $mi;?>"<?php if($mi==$month){echo " selected";}?>><?php if($mi<10) {echo "0";}echo $mi;?></option>
				<?php
			}

			?>
</select>
月
<select name="rday" id="rday">
					<option value="">--</option>
		<?php
			$mday=date("t",mktime(0,0,0,$month,$day,$year));
			for($di=1;$di<=$mday;$di++) {
				?>
				<option value="<?php if($di<10) {echo "0";}echo $di;?>"<?php if($di==$day){echo " selected";}?>><?php if($di<10) {echo "0";}echo $di;?></option>
				<?php
			}

			?>
</select>
日
<label for="day_view"></label>
            </td>
          </tr>	<?php
	$catedata=$dbobj->GetList("select * from blog_cate order by turn");
	$res=$dbobj->Query("select * from blog_cate order by turn");
	$num=$dbobj->NumRows($res);
	if($num!=0) {
	?>
  
			<?php
			}
			?>

          <tr>
            <th width="118" align="left" valign="top" bgcolor="#ECECEC"><strong>タイトル<font color="#FF0000">(※必須)</font></strong></th>
            <td width="471" align="left" bgcolor="#FFFFFF">
                <input name="new_data_title" type="text" id="new_data_title" value="" size="50">
            </td>
          </tr>
         <?php if($blogsetting["image_chk"]==1) {?>
         <tr>
							<th align="left" valign="top" bgcolor="#ECECEC"><strong>内容</strong></th>
         		<td align="left" valign="top" bgcolor="#FFFFFF">
									<textarea name="new_data_comm" cols="50" rows="20" id="new_data_comm"></textarea>
							</td>
         		</tr>
         <tr>
           <th align="left" valign="top" bgcolor="#ECECEC">イメージ画像1</th>
           <td align="left" valign="top" bgcolor="#FFFFFF">
             <input name="imagefile" type="file" id="imagefile" />
           </td>
         </tr>
         <tr>
             <th align="left" valign="top" bgcolor="#ECECEC">公開
                     <input name="cate_id" type="hidden" id="cate_id" value="1">
             </th>
             <td align="left" valign="top" bgcolor="#FFFFFF">
                 <select name="new_view_chk" id="new_view_chk">
                     <option value="1" selected>公開する</option>
                     <option value="0">公開しない</option>
                 </select>
             </td>
         </tr>
         <tr>
             <td align="left" valign="top" bgcolor="#ECECEC">&nbsp;</td>
             <td align="left" valign="top" bgcolor="#FFFFFF">
                 <input name="bbtm_regist" type="button" id="bbtm_regist" value="登録する" onclick="datachk()" />
                 <input name="pmode" type="hidden" id="pmode" value="regist" />
                 <input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onclick="history.back()" />
             </td>
         </tr>
         
         <?php 
				 }
				 ?>
        </table>
        <div id="type_text" style="display:block;"></div>
				<div id="type_link" style="display:none;">
				<table width="510" border="0" align="center" >
          <tr>
            <th width="100" align="left" valign="top">リンク先</th>
            <td align="left" valign="top">
              <input name="new_link" type="text" id="new_link" size="50" />
            </td>
          </tr>
          <tr>
            <th height="24" align="left" valign="top">ウィンドウ</th>
            <td align="left" valign="top">
              <select name="new_linktarget" id="new_linktarget">
                <option value="_self" selected="selected">ページを移動する</option>
                <option value="_brank">新しいウィンドウを開く</option>
              </select>
            </td>
          </tr></table></div>
				<script>
		//day_chk();
		</script>

   <?php
		  }
		  ?>
      </form>
    </td>
  </tr>
</table>
<script type="text/javascript">
on_load();
</script>