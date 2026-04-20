<?php 
$ad_news=new Admin_News($dbobj);
$newssetting=$ad_news->LoadSetting();
?>
<script language="javascript">
function datachk() {

	res=confirm("この内容で更新してもよろしいですか?");
	
	if(res) {
		document.update_form.submit();
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
											<p><strong>　&gt;&gt;　データ更新</strong></p>
									</td>
									<strong>　News　&gt;&gt;　データ更新</strong> </tr>
					</table>
  		</td>
 		</tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td>
      <form action="" method="post" enctype="multipart/form-data" name="update_form" id="update_form">
<?php 
if($_REQUEST["pmode"]=="update") {
	$ad_news->UpdateOneData($_POST);
	$newsdata=$ad_news->GetDetailsData($_POST["news_id"]);
	//print_r($_POST);
?>
<table width="600" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <th align="left" bgcolor="#ECECEC">日付</th>
    <td align="left" bgcolor="#FFFFFF"><?php echo $ryear."-".$rmonth."-".$rday;?></td>
  </tr>
	<?php
	$catedata=$dbobj->GetList("select * from news_cate order by turn");
	$res=$dbobj->Query("select * from news_cate order by turn");
	$num=$dbobj->NumRows($res);
	if($num!=0) {
	?>
  <tr>
  		<th align="left" bgcolor="#ECECEC">カテゴリ</th>
  		<td align="left" bgcolor="#FFFFFF">
  				<select name="cate_id" id="cate_id">
  						<?php
							for($i=0;$catedata[$i]["cate_id"];$i++) {
							?><option value="<?php echo $catedata[$i]["cate_id"];?>"><?php echo $catedata[$i]["cate_name"];?></option>
							<?php
							}
							?>
  						</select>
  				</td>
  		</tr>
			<?php
			}
			?>
  <tr>
    <th width="150" align="left" bgcolor="#ECECEC"><strong>タイトル</strong></th>
    <td width="435" align="left" bgcolor="#FFFFFF"> <?php echo nl2br($_POST["title"]);?></td>
  </tr>
  <?php if($newssetting["image_chk"]==1) {?><tr>
    <th align="left" valign="top" bgcolor="#ECECEC">イメージ画像</th>
    <td align="left" valign="top" bgcolor="#FFFFFF">
      <?php if($newsdata["image"]!=NULL){
								$pdata=(@getimagesize("http://".$_SESSION["DomainData"]["domain_name"].$newsdata["image"]));
							if($pdata[0]>400) {
								 $pdata[0]=400;
							}
			
			?>
      <img src="<?php echo "http://".$_SESSION["DomainData"]["domain_name"].$newsdata["image"];?>" alt="image" width="<?php echo $pdata[0];?>px"/>
      <?php }?>
    </td>
  </tr><?php }?>
</table>
<?php if($newssetting["comm_chk"]==1) {?><?php
		if($_REQUEST["view_type"]==0) {
		?>
<table width="600" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <th width="150" align="left" valign="top" bgcolor="#ECECEC"><strong>内容</strong></th>
    <td width="435" align="left" valign="top" bgcolor="#FFFFFF"> <?php echo nl2br($_POST["comm"]);?> </td>
  </tr>
</table>
<?php
		}
		else {
		?>
<table width="600" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC" >
  <tr>
    <th width="150" align="left" valign="top" bgcolor="#ECECEC">リンク先</th>
    <td width="435" align="left" valign="top" bgcolor="#FFFFFF"> <?php echo $_POST["link"];?> </td>
  </tr>
  <tr>
    <th height="24" align="left" valign="top" bgcolor="#ECECEC">ウィンドウ</th>
    <td align="left" valign="top" bgcolor="#FFFFFF">
      <?php
			if($_REQUEST["linktarget"]=="_self") {
				echo "ページを移動する";
			}
			else{
				echo "新しいウィンドウを開く";
			}
			?>
    </td>
  </tr>
</table>
<?php
	   }

 }
?><table width="600" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <th width="150" align="left" valign="top" bgcolor="#ECECEC">公開</th>
    <td width="435" align="left" valign="top" bgcolor="#FFFFFF">
      <?php 
			switch($_POST["view_chk"]) {
				case 0:
					echo "公開しない";
					break;
				case 1:
					echo "公開する";
					break;
				default:
					break;
			}
			
			?>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top" bgcolor="#ECECEC">&nbsp;</td>
    <td align="left" valign="top" bgcolor="#FFFFFF">
      <input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onclick="location.replace('?PID=alnews&amp;cate_id=<?php echo $_REQUEST["cate_id"];?>')" />
    </td>
  </tr>
</table>
<?php

		}
		else {
		
			$newsdata=$ad_news->GetDetailsData($_GET["news_id"]);
			$newscdata=$ad_news->GetDetailsCate($newsdata["cate_id"]);
		?><script>
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
		<table width="600" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
        <?php
		if($newsdata["rdate"]!=NULL) {
			$exday=explode("-",$newsdata["rdate"]);
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
<input name="day_view" type="checkbox" id="day_view" value="1" onClick="day_chk()"<?php if($newsdata["rdate"]==NULL) { echo  " checked";}?>>
<label for="day_view">日付を表示しない</label></td>
          </tr>
          <!--<tr>
            <td align="left"><input name="day_txt" type="text" id="day_txt" size="40" value="<?php echo $newsdata["day_txt"];?>"></td>
          </tr>-->
	<?php
	$catedata=$dbobj->GetList("select * from news_cate order by turn");
	$res=$dbobj->Query("select * from news_cate order by turn");
	$num=$dbobj->NumRows($res);
	if($num!=0) {
	?>
  <tr>
  		<th align="left" bgcolor="#ECECEC">カテゴリ</th>
  		<td align="left" bgcolor="#FFFFFF">
  				<select name="cate_id" id="cate_id">
  						<?php
							for($i=0;$catedata[$i]["cate_id"];$i++) {
							?><option value="<?php echo $catedata[$i]["cate_id"];?>"><?php echo $catedata[$i]["cate_name"];?></option>
							<?php
							}
							?>
  						</select>
  				</td>
  		</tr>
			<?php
			}
			?>
          <tr>
            <th width="150" align="left" valign="top" bgcolor="#ECECEC"><strong>タイトル</strong><strong>
            				<input name="new_view_type" type="hidden" id="new_view_type" value="0">
            </strong></th>
            <td width="435" align="left" bgcolor="#FFFFFF">
              <textarea name="title" cols="50" rows="6" id="title"><?php echo $newsdata["title"];?></textarea>
            </td>
          </tr>
<?php if($newssetting["image_chk"]==1) {?>
         <tr>
           <th rowspan="2" align="left" valign="top" bgcolor="#ECECEC">イメージ画像</th>
           <td align="left" valign="top" bgcolor="#FFFFFF">
             <?php if($newsdata["image"]!=NULL){
								$pdata=(@getimagesize("http://".$_SESSION["DomainData"]["domain_name"].$newsdata["image"]));
							if($pdata[0]>400) {
								 $pdata[0]=400;
							}
					 
						 ?>
             <img src="<?php echo "http://".$_SESSION["DomainData"]["domain_name"].$newsdata["image"];?>" alt="image" width="<?php echo $pdata[0];?>px"/><br />
               <label>
               <input name="delimage" type="checkbox" id="delimage" value="1" />
               写真削除</label><?php }?>
</td>
         </tr>
         <tr>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <input name="imagefile" type="file" id="imagefile">
            </td>
          </tr><?php
					}
				 ?>
        </table>
		 <?php if($newssetting["comm_chk"]==1) {?>
		 <div id="type_text" style="display:<?php if($newsdata["view_type"]==0) { ?>block<?php }else {echo "none";} ?>;">  <table width="600" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <th width="150" align="left" valign="top" bgcolor="#ECECEC"><strong>内容</strong></th>
            <td width="435" align="left" valign="top" bgcolor="#FFFFFF">
              <textarea name="comm" cols="50" rows="10" id="comm"><?php echo $newsdata["comm"];?></textarea>
            </td>
          </tr>
        </table></div>
		<div id="type_link" style="display:<?php if($newsdata["view_type"]==1) { ?>block<?php }else {echo "none";} ?>;">
        <table width="600" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC" >

          <tr>
            <th width="150" align="left" valign="top" bgcolor="#ECECEC">リンク先</th>
            <td width="435" align="left" valign="top" bgcolor="#FFFFFF">
              <input name="link" type="text" id="link" value="<?php echo $newsdata["link"];?>" size="50" />
            </td>
          </tr>
          <tr>
            <th height="24" align="left" valign="top" bgcolor="#ECECEC">ウィンドウ</th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <select name="linktarget" id="linktarget">
                <option value="_self"<?php if($newsdata["link"]=="_self") { ?> selected="selected"<?php } ?>>ページを移動する</option>
                <option value="_brank"<?php if($newsdata["link"]=="_brank") { ?> selected="selected"<?php } ?>>新しいウィンドウを開く</option>
              </select>
            </td>
          </tr>
        </table></div><?php
				}
				?>
        <table width="600" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">

          <tr>
            <th width="150" align="left" valign="top" bgcolor="#ECECEC">公開</th>
            <td width="435" align="left" valign="top" bgcolor="#FFFFFF">
              <select name="view_chk" id="view_chk">
                <option value="1"<?php if($newsdata["view_chk"]==1){echo " selected";}?>>公開する</option>
                <option value="0"<?php if($newsdata["view_chk"]==0){echo " selected";}?> >公開しない</option>
              </select>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top" bgcolor="#ECECEC">&nbsp;</td>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="更新する" onclick="datachk()" />
              <input name="pmode" type="hidden" id="pmode" value="update" />
              <input name="news_id" type="hidden" id="news_id" value="<?php echo $_REQUEST["news_id"];?>" />
              <input name="cate_id" type="hidden" id="cate_id" value="<?php echo $newsdata["cate_id"];?>" />
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onclick="location.replace('?PID=alnews')" />
            </td>
          </tr>
        </table>
		<script>
		day_chk();
		</script>
        <?php 
		}
		?>
      </form>
    </td>
  </tr>
</table>
