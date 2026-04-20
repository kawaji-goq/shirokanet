<?php
if($_REQUEST["update_re"]=="更新する") {
	$dbobj->Query("update contents_data set comm1='".$_REQUEST["comm"]."' where data_id =1");
}
$ddata=$dbobj->GetData("select * from contents_data where data_id=1");
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<script language="JavaScript" src="/tool/keypress.js" type="text/javascript">
function hback() {
history.back();
}
</script>
<style type="text/css">
<!--
.btmwidth_100 {
	width: 100px;
	font-weight: bold;
	text-transform: uppercase;
	text-align: center;
	height: 40px;
}
-->
</style>
<script type="text/javascript" src="/fckeditor/fckeditor.js"></script>

<script language="javascript">

function realestate_move(mode) {
	location.replace("index.php?mode=lease_"+mode+"&realestate_id=");
}

function chsyougaku(){
	//alert(data.value);
	document.bukken_form.syougakkouku.value=document.bukken_form.syougakkou.value;
}
function chchugaku(){
	//alert(data.value);
	document.bukken_form.chuugakouku.value=document.bukken_form.chugakkou.value;
}
function zipcode() {
	var zipcode;
	var address;
	zipcode=document.bukken_form.yubinbangou.value;
	result=showModalDialog("tool/zipsearch.php?zipcode="+zipcode,"test");
	address=result.split(",");
	document.bukken_form.todouhuken.value=address[0];
	document.bukken_form.jyusyo1.value=address[1];
	document.bukken_form.jyusyo2.value=address[2];
}

function realestate_move(mode) {
	location.replace("index.php?PAGEID=realestate&mode=lease_"+mode+"&realestate_id=");
}
//リスト内の移動をする関数
function func(elenum1,elenum2) {
	var devneko;
			switch(document.bukken_form.elements[elenum1].value) {
				case "1":
				devneko="";
				document.bukken_form.elements[elenum2].length=0;
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "1";
					var str = document.createTextNode("大竹駅");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "2";
					var str = document.createTextNode("岩国駅");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "3";
					var str = document.createTextNode("南岩国駅");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "4";
					var str = document.createTextNode("藤生駅");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "5";
					var str = document.createTextNode("通津駅");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "6";
					var str = document.createTextNode("由宇駅");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "7";
					var str = document.createTextNode("神代駅");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "8";
					var str = document.createTextNode("大畠駅");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "9";
					var str = document.createTextNode("柳井港駅");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "10";
					var str = document.createTextNode("柳井駅");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
								break;
					case "2":
				devneko="";
				document.bukken_form.elements[elenum2].length=0;
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "2";
					var str = document.createTextNode("岩国駅");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "11";
					var str = document.createTextNode("川西駅");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "12";
					var str = document.createTextNode("御庄駅");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
								break;
					case "3":
				devneko="";
				document.bukken_form.elements[elenum2].length=0;
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "2";
					var str = document.createTextNode("岩国駅");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "11";
					var str = document.createTextNode("川西駅");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
				if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "13";
					var str = document.createTextNode("西岩国駅");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
				if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "14";
					var str = document.createTextNode("柱野駅");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
				if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "15";
					var str = document.createTextNode("欽明路駅");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
				if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "16";
					var str = document.createTextNode("玖珂駅 ");
					ele.appendChild(str);
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
				break;
					default:
				document.bukken_form.elements[elenum2].length=0;
				var ele = document.createElement("option");
				ele.value = "0";
				var str = document.createTextNode("駅を選択してください");
				ele.appendChild(str);
				document.bukken_form.elements[elenum2].appendChild(ele);
	}
}

function  gotolist() {
	location.replace("index.php?PID=re_c3");
}

</script>
<TABLE width="700"  border="0" align="left" cellpadding="0" cellspacing="0" class="realestate_bgcolor1">
		<TR class="realestate_bgcolor2">
		    <TD valign="top">
		        <table width="100%"  border="0" cellpadding="0" cellspacing="0" class="border">
              <tr>
                  <td width="15" bgcolor="#CCCCCC">&nbsp; </td>
                  <td>
                      <table width="100%"  border="0" cellspacing="0" cellpadding="5">
                          <tr>
                              <td bgcolor="#FFFFFF" class="font10">
                                  <p>お部屋探しガイド</p>
                              </td>
                          </tr>
                      </table>
                  </td>
              </tr>
          </table>
		    </TD>
    </TR>
		<TR class="realestate_bgcolor2">
		    <TD valign="top">&nbsp;</TD>
    </TR>
		<TR class="realestate_bgcolor2">
				<TD valign="top">
						<form action="" method="post" enctype="multipart/form-data" name="bukken_form">
						    <table width="696" cellpadding="1" cellspacing="1">

              <tr>
              		<td valign="top" class="font14"><label><textarea name="comm" id="comm" cols="45" rows="5"><link href='/css/import.css' rel='stylesheet' type='text/css' media='all' /><style>.style1{
	color:#FFF;								
									}</style><?php
									echo $ddata["comm1"];
									?></textarea></label></td>
              		</tr>
									
              <tr>
              		<td valign="top" class="font14"> 
              				<input name="update_re" type="submit" id="update_re" value="更新する" />
              				<input type="reset" name="Submit" value="リセット" />
              				<script type="text/javascript"><!--
    //==================================================================
    // FCK Editor    
    var oFCKeditor = new FCKeditor( 'comm' );  
    oFCKeditor.BasePath = '/fckeditor/';
    oFCKeditor.Width = '700';
    oFCKeditor.Height = '700';
    oFCKeditor.ToolbarSet = 'Mymenu4';
    oFCKeditor.ReplaceTextarea();

// --></script>
              				<span class="realestate_bgcolor3">
              						<input name="btm" type="button" id="btm" onClick="gotolist()" value="一覧へ戻る" />
              						</span>
              				<input name="bid" type="hidden" id="bid" value="<?php echo $_REQUEST["bid"];?>" />              				</td>
              		</tr>
          </table>
						</form>
				</TD>
		</TR>
</TABLE>
