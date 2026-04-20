<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<script language="javascript">
function dispchange(txt) {
	switch(txt) {
		case "tb_head":
			if(document.all.tb_head.style.display=="none"){
				document.all.tb_head.style.display="block";
			}
			else {
				document.all.tb_head.style.display="none";
			}
			break;
		case "tb_load":
			if(document.all.tb_load.style.display=="none"){
				document.all.tb_load.style.display="block";
			}
			else {
				document.all.tb_load.style.display="none";
			}
			break;

		case "tb_date":
			if(document.all.tb_date.style.display=="none"){
				document.all.tb_date.style.display="block";
			}
			else {
				document.all.tb_date.style.display="none";
			}
			break;
		case "tb_title":
			if(document.all.tb_title.style.display=="none"){
				document.all.tb_title.style.display="block";
			}
			else {
				document.all.tb_title.style.display="none";
			}
			break;
		case "tb_comm":
			if(document.all.tb_comm.style.display=="none"){
				document.all.tb_comm.style.display="block";
			}
			else {
				document.all.tb_comm.style.display="none";
			}
			break;
		case "tb_link":
			if(document.all.tb_link.style.display=="none"){
				document.all.tb_link.style.display="block";
			}
			else {
				document.all.tb_link.style.display="none";
			}
			break;
		case "tb_image":
			if(document.all.tb_image.style.display=="none"){
				document.all.tb_image.style.display="block";
			}
			else {
				document.all.tb_image.style.display="none";
			}
			break;
		case "tb_h_image":
			if(document.all.tb_h_image.style.display=="none"){
				document.all.tb_h_image.style.display="block";
			}
			else {
				document.all.tb_h_image.style.display="none";
			}
			break;
		case "tb_f_image":
			if(document.all.tb_f_image.style.display=="none"){
				document.all.tb_f_image.style.display="block";
			}
			else {
				document.all.tb_f_image.style.display="none";
			}
			break;
			
		case "tb_foot":
			if(document.all.tb_foot.style.display=="none"){
				document.all.tb_foot.style.display="block";
			}
			else {
				document.all.tb_foot.style.display="none";
			}
			break;
		case "addstarttag":
			if(document.all.addstarttag.style.display=="none"){
				document.all.addstarttag.style.display="block";
			}
			else {
				document.all.addstarttag.style.display="none";
			}
			break;
		case "tb_addtitle":
			if(document.all.tb_addtitle.style.display=="none"){
				document.all.tb_addtitle.style.display="block";
			}
			else {
				document.all.tb_addtitle.style.display="none";
			}
			break;
		case "tb_addcomm":
			if(document.all.tb_addcomm.style.display=="none"){
				document.all.tb_addcomm.style.display="block";
			}
			else {
				document.all.tb_addcomm.style.display="none";
			}
			break;
		case "tb_addfoot":
			if(document.all.tb_addfoot.style.display=="none"){
				document.all.tb_addfoot.style.display="block";
			}
			else {
				document.all.tb_addfoot.style.display="none";
			}
			break;
	}
}
</script>
<table width="700" border="0" align="center">
  <tr>
    <td width="50"><a href="?PID=news"><img src="/img/jissseki_ic.gif" alt="news" width="50" height="50" border="0" /></a></td>
    <td width="640" align="left">
      <div id="tree">
        <table width="100%" border="0" cellpadding="10" cellspacing="10">
          <tr>
            <td width="25%"><a href="?PID=sekou_list_src">カテゴリ一覧ソース</a></td>
            <td width="25%"><a href="?PID=sekou_detailslist_src">詳細一覧ソース</a></td>
            <td width="25%"><a href="?PID=sekou_setting">施工実績設定</a></td>
            <td width="25%">&nbsp;</td>
          </tr>
        </table>
      </div>
    </td>
  </tr>
</table>
<table width="700" border="0" align="center" class="src">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><font color="#FF0000">※</font>の項目は必須です。</td>
  </tr>
  <tr>
    <td>
      <form id="form1" name="form1" method="post" action="">
        <table width="600" border="0" align="center" id="tb_load" style="display:block">
          <tr>
            <th>使用タグ<font color="#FF0000">※</font></th>
          </tr>
          <tr>
            <td>&lt;?php<br />
//ページの一番上に貼り付けて下さい。<br />
include &quot;./conf.php&quot;; <br />
//既にある場合は追加しなくても良いです。<br />
?&gt;</td>
          </tr>
        </table>
        <br />
        <table width="600" border="0" align="center" id="tb_head" style="display:block">
          <tr>
            <th>施工実績一覧開始<font color="#FF0000">※</font></th>
          </tr>
          <tr>
            <td>&lt;?php<br />
              /****************************************************************/<br />
              /*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/<br />
              /*　　　　　　　　　　施工実績一覧開始　　　　　　　　　　　　　*/<br />
              /*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/<br />
              /*↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/<br />
              $sekoudatadata=$sekouobj-&gt;GetDataList($_GET[&quot;cate_id&quot;],$lim,$setnum,$orderby); <br />
              for($sekourow=0;$sekoudatadata[$sekourow];$sekourow++){ <br />
              $sekoudata=new Ary_Viewer($sekoudatadata[$sekourow]);<br />
            ?&gt;</td>
          </tr>
        </table>
        <table width="600" border="0" align="center">
          <tr>
            <td width="100" align="left">タイトル</td>
            <td align="left">
              <input type="button" name="Submit" value="ソース表示"  onclick="dispchange('tb_title')"/>
            </td>
          </tr>
        </table>
        <table width="600" border="0" align="center" id="tb_title" style="display:block">
          <tr>
            <td width="500">
              <textarea name="titletag"  readonly="readonly"  id="titletag" style="width:600px;height:50px;"><?php echo '<?php $sekoudata->Moji("data_name"); ?>';?></textarea>
            </td>
          </tr>
        </table>
        <table width="600" border="0" align="center">
          <tr>
            <td width="100" align="left">内容</td>
            <td align="left">
              <input type="button" name="Submit" value="ソース表示" onclick="dispchange('tb_comm')" />
            </td>
          </tr>
        </table>
        <table width="600" border="0" align="center" id="tb_comm" style="display:block">
          <tr>
            <td width="500">
              <textarea name="commtag"  readonly="readonly"  id="commtag" style="width:600px;height:50px;"><?php echo '<?php $sekoudata->Moji("data_comm"); ?>';?></textarea>
            </td>
          </tr>
        </table>
        <table width="600" border="0" align="center">
          <tr>
            <td width="100" align="left">イメージ画像</td>
            <td align="left">
              <input type="button" name="Submit" value="ソース表示"  onclick="dispchange('tb_image')"/>
            </td>
          </tr>
        </table>
        <table width="600" border="0" align="center" id="tb_image" style="display:block">
          <tr>
            <td width="500">
              <textarea name="imagetag"  readonly="readonly"  id="imagetag" style="width:600px;height:50px;"><?php echo '<?php $sekoucate->Image("data_image"); ?>';?></textarea>
            </td>
          </tr>
        </table>        
        <table width="600" border="0" align="center">
          <tr>
            <td width="100" align="left">追記開始タグ<font color="#FF0000">※</font></td>
            <td align="left">
              <input type="button" name="Submit" value="ソース表示" onclick="dispchange('tb_addstart')" />
            </td>
          </tr>
        </table>
        <table width="600" border="0" align="center" id="tb_addstart" style="display:block">
          <tr>
            <td>
              <textarea name="addstarttag"  readonly="readonly"  id="addstarttag" style="width:600px;height:100px;"><?php echo '<?php
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　施工実績追記一覧開始　　　　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/
$sekousubdatalist=$sekouobj->GetSubDataList($sekoudatadata[$sekourow]["data_id"]);
for($sekousubrow=0;$sekousubdatalist[$sekousubrow];$sekousubrow++){ 
$sekousubdata=new Ary_Viewer($sekousubdatalist[$sekousubrow]);
?>';?></textarea>
            </td>
          </tr>
        </table>
        <table width="600" border="0" align="center">
          <tr>
            <td width="100" align="left">タイトル</td>
            <td align="left">
              <input type="button" name="Submit" value="ソース表示"  onclick="dispchange('tb_addtitle')"/>
            </td>
          </tr>
        </table>
        <table width="600" border="0" align="center" id="tb_addtitle" style="display:block">
          <tr>
            <td width="500">
              <textarea name="addtitletag"  readonly="readonly"  id="addtitletag" style="width:600px;height:50px;"><?php echo '<?php $sekousubdata->Moji("data_name"); ?>';?></textarea>
            </td>
          </tr>
        </table>
        <table width="600" border="0" align="center">
          <tr>
            <td width="100" align="left">内容</td>
            <td align="left">
              <input type="button" name="Submit" value="ソース表示" onclick="dispchange('tb_addcomm')" />
            </td>
          </tr>
        </table>
        <table width="600" border="0" align="center" id="tb_addcomm" style="display:block">
          <tr>
            <td width="500">
              <textarea name="addcommtag"  readonly="readonly"  id="addcommtag" style="width:600px;height:50px;"><?php echo '<?php $sekousubdata->Moji("data_comm"); ?>';?></textarea>
            </td>
          </tr>
        </table>
        <table width="600" border="0" align="center">
          <tr>
            <td width="100" align="left">追記終了タグ<font color="#FF0000">※</font></td>
            <td align="left">
              <input type="button" name="Submit" value="ソース表示" onclick="dispchange('tb_addfoot')" />
            </td>
          </tr>
        </table>
        <table width="600" border="0" align="center" id="tb_addfoot" style="display:block">
          <tr>
            <td width="500">
              <textarea name="addendtag"  readonly="readonly"  id="addendtag" style="width:600px;height:100px;"><?php echo '<?php 
}
/*↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　施工実績追記一覧終了　　　　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/****************************************************************/
?>';?></textarea>
            </td>
          </tr>
        </table>
        <table width="600" border="0" align="center">
          <tr>
            <td width="100" align="left">終了タグ<font color="#FF0000">※</font></td>
            <td align="left">
              <input type="button" name="Submit" value="ソース表示" onclick="dispchange('tb_foot')" />
            </td>
          </tr>
        </table>
        <table width="600" border="0" align="center" id="tb_foot" style="display:block">
          <tr>
            <td width="500">
              <textarea name="endtag"  readonly="readonly"  id="endtag" style="width:600px;height:100px;"><?php echo '<?php 
}
/*↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　施工実績カテゴリ一覧終了　　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/****************************************************************/
?>';?></textarea>
            </td>
          </tr>
        </table>
      </form>
    </td>
  </tr>
</table>
