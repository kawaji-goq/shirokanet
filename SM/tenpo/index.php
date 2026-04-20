<?php
if($_REQUEST["bbtm_regist"]=="更新する") {
			$tenposql="update tenpo_data set ".
													"sm_title='".$_REQUEST["sm_title"]."',".
  											"gwpc_title='".$_REQUEST["gwpc_title"]."',".
  											"gwkeitai_title='".$_REQUEST["gwkeitai_title"]."'";
			$tenpodata=$dbobj->GetData($tenposql);
}

$tenposql="select * from tenpo_data";
$tenpodata=$dbobj->GetData($tenposql);
if($tenpodata["id"]==NULL||$tenpodata["id"]=="") {
	$dbobj->Query("insert into tenpo_data(id) values(1)");
}
?><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<table width="700" border="0" align="left" cellpadding="0" cellspacing="0">
    <tr>
        <td>
            <table width="700" border="0" align="center">
                <tr>
                    <td>
                        <p><strong>各種設定</strong></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
   <?php
			if($_REQUEST["bbtm_regist"]=="更新する") {

?> <tr>
        <td><table width="100%" border="0" cellpadding="3" cellspacing="1" class="helper">
    <tr>
        <td height="50">
            <div align="center"><strong>タイトルを更新しました。</strong></div>
        </td>
    </tr>
    
</table></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
				<?php
				}
				?>
    <tr>
        <td width="690">
            <form action="" method="post" enctype="multipart/form-data" name="update_form" id="update_form">
                <?php 

?>
                <script type="text/javascript">
<!--

function on_load() {
    //==================================================================
    // FCK Editor
    
    var oFCKeditor = new FCKeditor( 'data_comm' );
    
    oFCKeditor.BasePath = '/FCK/';
    oFCKeditor.Width = '400';
    oFCKeditor.Height = '400';
    oFCKeditor.ToolbarSet = 'Mymenu';
    
    oFCKeditor.ReplaceTextarea();
}

// -->

</script>
                <table width="700" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC"><?php 
		 ?>
                    <tr>
                        <td width="202" align="left" valign="top" nowrap bgcolor="#ECECEC">&nbsp;</td>
                        <td width="483" align="left" valign="top" bgcolor="#FFFFFF">
                            <input name="bbtm_regist" type="submit" id="bbtm_regist" value="更新する">
                            <input name="pmode" type="hidden" id="pmode" value="update">
                            <input name="data_id" type="hidden" id="data_id" value="<?php echo $_REQUEST["data_id"];?>">
                            <input name="cate_id" type="hidden" id="cate_id" value="<?php echo $qandadata["cate_id"];?>" />
                        </td>
                    </tr>
                </table>
            </form>
        </td>
    </tr>
</table>

