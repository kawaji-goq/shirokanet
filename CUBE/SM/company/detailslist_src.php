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
		case "tb_head":
			if(document.all.tb_head.style.display=="none"){
				document.all.tb_head.style.display="block";
			}
			else {
				document.all.tb_head.style.display="none";
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
	}
}
</script>
<table width="700" border="0" align="center">
  <tr>
    <td width="50"><a href="?PID=news"><img src="/img/shop_ic.jpg" alt="news" width="50" height="50" border="0" /></a></td>
    <td width="640" align="left">
      <div id="tree">
        <table width="100%" border="0" cellpadding="10" cellspacing="10">
          <tr>
            <td width="25%" align="left"><a href="?PID=company_list_src">ｶﾃｺﾞﾘ一覧表示用ｿｰｽ</a></td>
            <td width="25%" align="left"><a href="?PID=company_detailslist_src">詳細一覧表示用ソース</a></td>
            <td width="25%" align="left"><a href="?PID=company_setting">会社概要設定</a></td>
            <td width="25%" align="left">&nbsp;</td>
          </tr>
        </table>
      </div>
    </td>
  </tr>
</table>
<table width="700" border="0" align="center">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><font color="#FF0000">※</font>の項目は必須です。</td>
  </tr>
  <tr>
    <td>
      <form id="form1" name="form1" method="post" action="">
        <table width="600" border="0" align="center">
          <tr>
            <td width="100" align="left">使用タグ<font color="#FF0000">※</font></td>
            <td align="left">
              <div align="left">
                <input type="button" name="Submit" value="ソース表示" onclick="dispchange('tb_load')" />
                </div>
            </td>
          </tr>
        </table> <table width="600" border="0" align="center" id="tb_load" style="display:none">
          <tr>
            <td>
              <textarea name="loadtag"  readonly="readonly"  id="loadtag" style="width:600px;height:50px;"><?php echo '';?></textarea>
            </td>
          </tr>
        </table>
        <table width="600" border="0" align="center">
          <tr>
            <td width="100" align="left">開始タグ<font color="#FF0000">※</font></td>
            <td align="left">
              <div align="left">
                <input type="button" name="Submit" value="ソース表示" onclick="dispchange('tb_head')" />
                </div>
            </td>
          </tr>
        </table>
        <table width="600" border="0" align="center" id="tb_head" style="display:none">
          <tr>
            <td>
              <textarea name="starttag"  readonly="readonly"  id="starttag" style="width:600px;height:100px;"><?php echo '<?php
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　　会社概要データ　一覧開始　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/
//この部分は変更しないでください。 
$companydatadata=$comobj->GetDataList(2,$lim,$setnum,$orderby);
for($companyrow=0;$companydatadata[$companyrow];$companyrow++){ 
$companydata=new Ary_Viewer($companydatadata[$companyrow]);
?>';?></textarea>
            </td>
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
        <table width="600" border="0" align="center" id="tb_title" style="display:none">
          <tr>
            <td width="500">
              <textarea name="titletag"  readonly="readonly"  id="titletag" style="width:600px;height:50px;"><?php echo '<?php $companydata->Moji("data_name"); ?>';?></textarea>
            </td>
          </tr>
        </table>
        <table width="600" border="0" align="center">
          <tr>
            <td width="100" align="left">内容</td>
            <td align="left">
              <div align="left">
                <input type="button" name="Submit" value="ソース表示" onclick="dispchange('tb_comm')" />
                </div>
            </td>
          </tr>
        </table>
        <table width="600" border="0" align="center" id="tb_comm" style="display:none">
          <tr>
            <td width="500">
              <textarea name="commtag"  readonly="readonly"  id="commtag" style="width:600px;height:50px;"><?php echo '<?php $companydata->Moji("data_comm"); ?>';?></textarea>
            </td>
          </tr>
        </table>
        <table width="600" border="0" align="center">
          <tr>
            <td width="100" align="left">イメージ画像</td>
            <td align="left">
              <div align="left">
                <input type="button" name="Submit" value="ソース表示"  onclick="dispchange('tb_image')"/>
                </div>
            </td>
          </tr>
        </table>
        <table width="600" border="0" align="center" id="tb_image" style="display:none">
          <tr>
            <td width="500">
              <textarea name="imagetag"  readonly="readonly"  id="imagetag" style="width:600px;height:50px;"><?php echo '<?php $companycate->Image("data_image"); ?>';?></textarea>
            </td>
          </tr>
        </table>        
        <table width="600" border="0" align="center" id="tb_f_image" style="display:none">
          <tr>
            <td width="500">
              <textarea name="f_imagetag"  readonly="readonly"  id="f_imagetag" style="width:600px;height:50px;"><?php echo '<?php $companycate->Image("data_foot_image"); ?>';?></textarea>
            </td>
          </tr>
        </table>
        <table width="600" border="0" align="center">
          <tr>
            <td width="100" align="left">終了タグ<font color="#FF0000">※</font></td>
            <td align="left">
              <div align="left">
                <input type="button" name="Submit" value="ソース表示" onclick="dispchange('tb_foot')" />
                </div>
            </td>
          </tr>
        </table>
        <table width="600" border="0" align="center" id="tb_foot" style="display:none">
          <tr>
            <td width="500">
              <textarea name="endtag"  readonly="readonly"  id="endtag" style="width:600px;height:100px;"><?php echo '<?php 
}
/*↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　会社概要カテゴリ一覧終了　　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/****************************************************************/
?>
';?></textarea>
            </td>
          </tr>
        </table>
      </form>
    </td>
  </tr>
</table>
