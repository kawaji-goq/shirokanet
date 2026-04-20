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
    <td width="50"><a href="../../admin/news/?PID=news"><img src="/img/news_ic.jpg" alt="news" width="50" height="50" border="0" /></a></td>
    <td width="640" align="left">
      <div id="tree">
        <table width="100%" border="0" cellpadding="10" cellspacing="10">
          <tr>
            <td width="25%"><a href="../../admin/news/?PID=news_list_src">一覧表示用ソース</a></td>
            <td width="25%"><a href="../../admin/news/?PID=news_setting">News設定</a></td>
            <td width="25%">&nbsp;</td>
            <td width="25%">&nbsp;</td>
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
    <td align="left"><font color="#FF0000">※</font>の項目は必須です。</td>
  </tr>
  <tr>
    <td>
      <form id="form1" name="form1" method="post" action="">
        <table width="600" border="0" align="center">
          <tr>
            <th width="100" align="left">使用タグ<font color="#FF0000">※</font></th>
            <td align="left">
              <input type="button" name="Submit" value="ソース表示" onclick="dispchange('tb_load')" />
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
            <th width="100" align="left">開始タグ<font color="#FF0000">※</font></th>
            <td align="left">
              <input type="button" name="Submit" value="ソース表示" onclick="dispchange('tb_head')" />
            </td>
          </tr>
        </table>
        <table width="600" border="0" align="center" id="tb_head" style="display:none">
          <tr>
            <td>
              <textarea name="starttag"  readonly="readonly"  id="starttag" style="width:600px;height:100px;"><?php echo '<?php
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　　新着情報一覧開始　　　　　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/
$newsdata=$newsobj->GetDataList("",$lim,$setnum,$orderby);
for($newsrow=0;$newsdata[$newsrow];$newsrow++){ 
$newsddata=new Ary_Viewer($newsdata[$newsrow]);
?>';?></textarea>
            </td>
          </tr>
        </table>
        <table width="600" border="0" align="center">
          <tr>
            <th width="100" align="left">日付</th>
            <td align="left">
              <input type="button" name="Submit" value="ソース表示" onclick="dispchange('tb_date')" />
            </td>
          </tr>
        </table>
        <table width="600" border="0" align="center" id="tb_date" style="display:none">
          <tr>
            <td width="500">
              <textarea name="datetag"  readonly="readonly"  id="datetag" style="width:600px;height:50px;"><?php echo '<?php $newsddata->Date("rdate","年","月","日"); ?>';?></textarea>
            </td>
          </tr>
        </table>
        <table width="600" border="0" align="center">
          <tr>
            <th width="100" align="left">タイトル</th>
            <td align="left">
              <input type="button" name="Submit" value="ソース表示"  onclick="dispchange('tb_title')"/>
            </td>
          </tr>
        </table>
        <table width="600" border="0" align="center" id="tb_title" style="display:none">
          <tr>
            <td width="500">
              <textarea name="titletag"  readonly="readonly"  id="titletag" style="width:600px;height:50px;"><?php echo '<?php $newsddata->Moji("title"); ?>';?></textarea>
            </td>
          </tr>
        </table>
        <table width="600" border="0" align="center">
          <tr>
            <th width="100" align="left">内容</th>
            <td align="left">
              <input type="button" name="Submit" value="ソース表示" onclick="dispchange('tb_comm')" />
            </td>
          </tr>
        </table>
        <table width="600" border="0" align="center" id="tb_comm" style="display:none">
          <tr>
            <td width="500">
              <textarea name="commtag"  readonly="readonly"  id="commtag" style="width:600px;height:50px;"><?php echo '<?php $newsddata->Moji("comm"); ?>';?></textarea>
            </td>
          </tr>
        </table>
        <table width="600" border="0" align="center">
          <tr>
            <th width="100" align="left">リンク</th>
            <td>
              <div align="left">
                <input type="button" name="Submit" value="ソース表示" onclick="dispchange('tb_link')" />
                </div>
            </td>
          </tr>
        </table>
        <table width="600" border="0" align="center" id="tb_link" style="display:none">
          <tr>
            <td width="500">
              <textarea name="linktag"  readonly="readonly"  id="linktag" style="width:600px;height:50px;"><?php echo '<?php $newsddata->Moji("link"); ?>';?></textarea>
            </td>
          </tr>
        </table>
        <table width="600" border="0" align="center">
          <tr>
            <th width="100" align="left">イメージ画像</th>
            <td>
              <div align="left">
                <input type="button" name="Submit" value="ソース表示"  onclick="dispchange('tb_image')"/>
                </div>
            </td>
          </tr>
        </table>
        <table width="600" border="0" align="center" id="tb_image" style="display:none">
          <tr>
            <td width="500">
              <textarea name="imagetag"  readonly="readonly"  id="imagetag" style="width:600px;height:50px;"><?php echo '<?php $newsddata->Image("image"); ?>';?></textarea>
            </td>
          </tr>
        </table>
        <table width="600" border="0" align="center">
          <tr>
            <th width="100" align="left">終了タグ<font color="#FF0000">※</font></th>
            <td>
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
/*　　　　　　　　　新着情報一覧終了　　　　　　　　　　　　　　*/
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
