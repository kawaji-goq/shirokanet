<?php 


if($_REQUEST["btm_update"]=="更新する") {

	$ad_company->UpdateData($_REQUEST);
	$ad_company->AdditionData($_REQUEST);
	$ad_company->DeleteData($_REQUEST);
	
}

$nowdata=$ad_company->GetDataIdList(2,$orderby);

//print_r($comcatesep);
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<table width="700" border="0" align="left" cellpadding="0" cellspacing="0">
<form id="form1" name="form1" method="post" action="">
    <tr>
    		<td height="15">
    				<table width="700" border="0" align="center">
								<tr>
										<td width="278"><img src="./img/siteadmin/edit_menu.gif" alt="編集中のエリア" width="278" height="18" /></td>
										<td width="412" align="left">
												<p><strong>　<?php echo $menudata[3]["data_name"]; ?>　&gt;&gt;　データ更新</strong></p>
										</td>
								</tr>
						</table>
    		</td>
    		</tr>
    <tr>
      <td height="15">&nbsp;</td>
    </tr>
   <tr>
      <td height="15">
        <table width="700" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">

          <tr>
            <th align="left" valign="top" nowrap="nowrap" bgcolor="#ECECEC">削除</th>
            <th align="left" valign="top" bgcolor="#ECECEC">&nbsp;</th>
            <th align="left" valign="top" bgcolor="#ECECEC">&nbsp;</th>
            <th align="left" valign="top" bgcolor="#ECECEC">表示</th>
          </tr>
        	<?php 
			for($datanum=0;$nowdata[$datanum];$datanum++) {
			?>
			<tr>
            <td width="28" align="left" valign="top" bgcolor="#FFFFFF">
              <input name="delchk[]" type="checkbox" id="delchk[]" value="<?php echo $nowdata[$datanum]["data_id"] ?>" />
            </td>
            <td width="186" align="left" valign="top" bgcolor="#FFFFFF">
              <input name="data_name[<?php echo $datanum ?>]" type="text" id="data_name[<?php echo $datanum ?>]" value="<?php echo $nowdata[$datanum]["data_name"] ?>" />
              <input name="data_id[<?php echo $datanum ?>]" type="hidden" id="data_id[<?php echo $datanum ?>]"  value="<?php echo $nowdata[$datanum]["data_id"] ?>"/>
            </td>
            <td width="386" align="left" valign="top" bgcolor="#FFFFFF">
              <textarea name="data_comm[<?php echo $datanum ?>]" cols="50" rows="5" id="data_comm[<?php echo $datanum ?>]"><?php echo $nowdata[$datanum]["data_comm"] ?></textarea>
            </td>
            <td width="71" align="left" valign="top" bgcolor="#FFFFFF">
              <select name="view_chk[<?php echo $datanum ?>]" id="view_chk[<?php echo $datanum ?>]">
                <option value="1"<?php if($nowdata[$datanum]["view_chk"]==1) { ?>selected="selected"<?php }?>>表示</option>
                <option value="0"<?php if($nowdata[$datanum]["view_chk"]!=1) { ?>selected="selected"<?php }?>>非表示</option>
              </select>
            </td>
          </tr>
          <?php
		}
		?>
        </table>
      </td>
    </tr>
    <tr>
      <td height="15">&nbsp;</td>
    </tr>
  <tr>
      <th height="15" align="left">新規追加</th>
    </tr>
    <tr>
      <td height="15">&nbsp;</td>
    </tr>
    <tr>
      <td height="15">
        <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">

          <tr>
            <td width="20" align="left" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
            <td width="200" align="left" valign="top" bgcolor="#FFFFFF">
              <input name="new_data_name" type="text" id="new_data_name" />
            </td>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <textarea name="new_data_comm" cols="50" rows="5" id="new_data_comm"></textarea>
              <input name="new_view_chk" type="hidden" id="new_view_chk" value="1" />
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td height="15" align="left">
        <input name="btm_update" type="submit" id="btm_update" value="更新する" />
        <input name="cate_id" type="hidden" value="2" />
      </td>
    </tr>
</form>
</table>
