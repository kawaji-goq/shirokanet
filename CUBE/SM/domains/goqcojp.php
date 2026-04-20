<?php
/*
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<?php
*/
	switch($_REQUEST["PID"]){
			/* 携帯 */
		case "keitai":
		include ("./keitai/index.php");
		$pagetype="gw";
		break;	
		case "designsetting":
		include ("./hpdata/goqcojp/mf_designsetting.php");
		$pagetype="gw";
		break;			/* 新着情報 */
		case "news_reg":
		include "./hpdata/goqcojp/mf_news_reg.php";
		$pagetype="hp";
		break;
		case "top_contents_category":
		include ("./hpdata/goqcojp/top_contents_category.php");
		$pagetype="hp";
		break;			/* 新着情報 */
		case "news":
		include "./hpdata/goqcojp/mf_news.php";
		$pagetype="hp";
		break;
		case "hp_basic_link_category":
		include "./hpdata/goqcojp/mf_link_category.php";
		$pagetype="hp";
		break;		
		case "link":
		include "./hpdata/goqcojp/mf_link_category.php";
		$pagetype="hp";
		break;
		case "link_category":
		$pagetype="hp";
		include "./hpdata/goqcojp/mf_link_category.php";
		break;
		case "hp_basic_link_category_reg":
		$pagetype="hp";
		include "./hpdata/goqcojp/mf_link_category_reg.php";
		break;		
		case "link_add":
		include "./hpdata/goqcojp/mf_link_reg.php";
		$pagetype="hp";
		break;
		case "link_up":
		include "./link/update.php";
		$pagetype="hp";
		break;
		case "hp_basic_link_d":
		include "./hpdata/goqcojp/mf_link.php";		
		$pagetype="hp";
		break;
		case "hp_basic_link_reg":
		include "./hpdata/goqcojp/mf_link_reg.php";		
		$pagetype="hp";
		break;
		case "link_d_up":
		include "./link/d_update.php";
		$pagetype="hp";
		break;
		case "domain":
		include "./domain/top.php";
		break;
		
		/* ブログコンテンツ */
		case "blog":
		$pagetype="hp";
		include "./hpdata/goqcojp/mf_blog_lineup.php";
		break;
		case "basic_blog_lineup":
		$pagetype="hp";
		include "./hpdata/goqcojp/mf_blog_lineup.php";		
		break;		
		case "hp_basic_blog_cate":
		$pagetype="hp";		
		include "./hpdata/goqcojp/mf_blog_cate.php";		
		break;
		case "hp_basic_blog_cate_reg":
		$pagetype="hp";
		include "./hpdata/goqcojp/mf_blog_cate_reg.php";
		break;
		case "basic_blog_reg":
		$pagetype="hp";
		include "./hpdata/goqcojp/mf_blog_reg.php";
		break;
		case "hp_basic_blog_closeup":
		$pagetype="hp";		
		include "./hpdata/goqcojp/mf_blog_closeup.php";		
		break;
		case "blog_dadd":
		$pagetype="hp";
		include "./blog2/d_addition.php";
		break;
		case "basic_blog_reg":
		$pagetype="hp";
		include "./hpdata/goqcojp/mf_blog_reg.php";
		break;
		case "hp_basic_blog_cate":
		$pagetype="hp";
		
		include "./blog2/d_update.php";
		break;
		case "hp_basic_blog_closeup":
		$pagetype="hp";
		include "./hpdata/goqcojp/mf_blog_closeup.php";
		break;
		case "hp_basic_blog_cate_reg":
		$pagetype="hp";
		include "./hpdata/goqcojp/mf_blog_cate_reg.php";
		break;
		case "patternlist":
		$pagetype="hp";
		
		include "./hpdata/goqcojp/patternlist.php";
		
		break;
		/* ブログコンテンツ */
		
		case "news_setting":
		$pagetype="hp";
		include "./news/setting.php";
		break;
		case "banner":
		$pagetype="hp";
		include "./hpdata/goqcojp/mf_banner.php";
		break;
		case "banner_add":
		$pagetype="hp";
		include "./banner/d_addition.php";
		break;
		case "banner_up":
		$pagetype="hp";
		include "./banner/d_update.php";
		break;
		case "vup":
		$pagetype="hp";
		include "./vup/top.php";
		break;
		case "vup_d":
		$pagetype="hp";
		include "./vup/details.php";
		break;
		case "tenpo":
		$pagetype="gw";
		include ("./tenpo/index.php");
		break;
		case "contents_category":
			include "./hpdata/goqcojp/mf_contents_category.php";
		$pagetype="hp";
		break;
		case "contents_details":
		if($_REQUEST["pattern"]=="freelist"){
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/goqcojp/su/mf_freelist_up.php";
		}
		else {
		include "./hpdata/goqcojp/mf_list.php";
		}
			}
			elseif($_REQUEST["pattern"]=="freepage"){
				if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/goqcojp/su/mf_about.php";
		}
		else {
		include "./hpdata/goqcojp/mf_about.php";
					}
				}
				else if($_REQUEST["pattern"]=="plist"){
		include "./hpdata/goqcojp/mf_plist.php";
					}
					else if($_REQUEST["pattern"]=="ppage") {
	if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/goqcojp/su/mf_about.php";
		}
		else {
		include "./hpdata/goqcojp/mf_about.php";
}
		}
		$pagetype="hp";
		break;
case "contents_list_reg":
		if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/goqcojp/su/mf_about.php";
		}
		else {

		include "./hpdata/goqcojp/mf_list_reg.php";
}		
		$pagetype="hp";
break;
case "contents_plist_reg":
		include "./hpdata/goqcojp/mf_plist_reg.php";
		$pagetype="hp";
break;
case "contents_list_up":
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/goqcojp/su/mf_about.php";
		}
		else {
	include "./hpdata/goqcojp/mf_list_up.php";
}		
		$pagetype="hp";
break;

case "contents_plist_up":
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/goqcojp/su/mf_plist_up.php";
		}
		else {
	include "./hpdata/goqcojp/mf_plist_up.php";
}		
		$pagetype="hp";
break;
		case "link_category":
		include "./hpdata/goqcojp/mf_link_category.php";
		$pagetype="hp";
		break;
		case "link_category_reg":
		
			include "./hpdata/goqcojp/mf_link_category_reg.php";
		$pagetype="hp";
		break;
		case "link_d":
		include "./hpdata/goqcojp/mf_link.php";
		$pagetype="hp";
		break;
		case "banner":
		include "./hpdata/goqcojp/mf_banner.php";
		$pagetype="hp";
		break;
		case "news":
		include "./hpdata/goqcojp/mf_news.php";
		$pagetype="hp";
		break;
		case "news_reg":
		include "./hpdata/goqcojp/mf_news_reg.php";
		$pagetype="hp";
		break;
		case "contents_category_reg":
		
		if($_SESSION["editmode"]=="webmaster"){
				include "./hpdata/goqcojp/su/mf_contents_category.php";
		}
		else {
		include "./hpdata/goqcojp/mf_contents_category_reg.php";
		}
		
		$pagetype="hp";
		break;
		case "contents_category_up":
		if($_SESSION["editmode"]=="webmaster"){
				include "./hpdata/goqcojp/su/mf_contents_category.php";
		}
		else {
		include "./hpdata/goqcojp/mf_contents_category_up.php";
		}
		
		$pagetype="hp";
		break;
		case "blog_lineup":
		include "./hpdata/goqcojp/mf_blog_lineup.php";
		$pagetype="hp";
		break;
		case "blog_closeup":
		include "./hpdata/goqcojp/mf_blog_closeup.php";
		$pagetype="hp";
		break;
		case "menu":
		include "./hpdata/goqcojp/mf_menu.php";
		$pagetype="hp";
		break;
		case "pagesetting":
		include "./hpdata/goqcojp/mf_pagesetting.php";
		$pagetype="hp";
		break;
		case "blog_cate":
		include "./hpdata/goqcojp/mf_blog_cate.php";
		$pagetype="hp";
		break;
		case "blog_cate_reg":
		include "./hpdata/goqcojp/mf_blog_cate_reg.php";
		$pagetype="hp";
		break;
		case "blog_reg":
		
		include "./hpdata/goqcojp/mf_blog_reg.php";
		$pagetype="hp";
		
		break;
		case "contact":
		
		include "./hpdata/goqcojp/mf_contact.php";
		$pagetype="hp";
		
		break;
		
		case "link_reg":
		
		include "./hpdata/goqcojp/mf_link_reg.php";
		$pagetype="hp";
		break;
	
case "contents2_list_reg":
		if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/goqcojp/su/mf_about2.php";
		}
		else {

		include "./hpdata/goqcojp/mf_list2_reg.php";
}		
		$pagetype="hp";
break;
case "contents2_plist_reg":
		include "./hpdata/goqcojp/mf_plist2_reg.php";
		$pagetype="hp";
break;

case "contents2_list_up":
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/goqcojp/su/mf_about2.php";
		}
		else {
	include "./hpdata/goqcojp/mf_list2_up.php";
}		
		$pagetype="hp";
break;

case "contents2_plist_up":
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/goqcojp/su/mf_plist2_up.php";
		}
		else {
	include "./hpdata/goqcojp/mf_plist2_up.php";
}		
		$pagetype="hp";
break;
		case "contents2_category_reg":
		
		if($_SESSION["editmode"]=="webmaster"){
				include "./hpdata/goqcojp/su/mf_contents2_category.php";
		}
		else {
		include "./hpdata/goqcojp/mf_contents2_category_reg.php";
		}
		
		$pagetype="hp";
		break;
		case "contents2_category_up":
		if($_SESSION["editmode"]=="webmaster"){
				include "./hpdata/goqcojp/su/mf_contents2_category.php";
		}
		else {
		include "./hpdata/goqcojp/mf_contents2_category_up.php";
		}
		
		$pagetype="hp";
		break;
				case "contents2_category":
		if($_SESSION["editmode"]=="webmaster"){
				include "./hpdata/goqcojp/su/mf_contents2_category.php";
		}
		else {
		include "./hpdata/goqcojp/mf_contents2_category.php";
		}
		$pagetype="hp";
		break;
		case "contents2_details":
		if($_REQUEST["pattern"]=="freelist"){
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/goqcojp/su/mf_freelist2_up.php";
		}
		else {
		include "./hpdata/goqcojp/mf_list2.php";
		}
			}
			elseif($_REQUEST["pattern"]=="freepage"){
				if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/goqcojp/su/mf_about2.php";
		}
		else {
		include "./hpdata/goqcojp/mf_about2.php";
					}
				}
				else if($_REQUEST["pattern"]=="plist"){
		include "./hpdata/goqcojp/mf_plist2.php";
					}
					else if($_REQUEST["pattern"]=="ppage") {
	if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/goqcojp/su/mf_about2.php";
		}
		else {
		include "./hpdata/goqcojp/mf_about2.php";
}
		}
		$pagetype="hp";
		break;
	case "company":
		include ("./hpdata/goqcojp/company.php");
		$pagetype="hp";
		break;			/* 新着情報 */	
	case "staff_d_add":
		include ("./hpdata/goqcojp/staff_add.php");
		$pagetype="hp";
		break;		
	case "staff_d_up":
		include ("./hpdata/goqcojp/staff_up.php");
		$pagetype="hp";
		break;			/* 新着情報 */	
		
		
		/* 新着情報 */	
	case "top_contents_category_reg":
		include ("./hpdata/goqcojp/top_contents_category_reg.php");
		$pagetype="hp";
		break;			/* 新着情報 */	
		case "top_contents_category_up":
		include ("./hpdata/goqcojp/top_contents_category_up.php");
		$pagetype="hp";
		break;			/* 新着情報 */	
		
	case "top_contents":
			include "./hpdata/goqcojp/top_plist.php";
		$pagetype="hp";
	break;
	case "top_contents_reg":
			include "./hpdata/goqcojp/top_plist_reg.php";
		$pagetype="hp";
	break;
	case "top_contents_up":
			include "./hpdata/goqcojp/top_plist_up.php";
		$pagetype="hp";
	break;
	case "top_flash_up":
	if($_SESSION["editmode"]=="webmaster"){
			include "./hpdata/goqcojp/su/top_flash.php";
	}
	else if($_SESSION["loginmode"]=="su"){
		include "./hpdata/goqcojp/su/top_flash.php";
		}
		else {
			include "./hpdata/goqcojp/top_flash_up.php";
		}
		$pagetype="hp";
	break;
	case "template":
	if($_SESSION["editmode"]=="webmaster"){
			include "./hpdata/goqcojp/template.php";
	}
		$pagetype="hp";
	break;

	case "template_reg":
	if($_SESSION["editmode"]=="webmaster"){
			include "./hpdata/goqcojp/template_reg.php";
	}
		$pagetype="hp";
	break;
	case "template_up":
	if($_SESSION["editmode"]=="webmaster"){
			include "./hpdata/goqcojp/template_up.php";
	}
		$pagetype="hp";
	break;
	case "template_cate":
	if($_SESSION["editmode"]=="webmaster"){
			include "./hpdata/goqcojp/template_cate.php";
	}
		$pagetype="hp";
	break;
	case "template_cate_up":
	if($_SESSION["editmode"]=="webmaster"){
			include "./hpdata/goqcojp/template_cate_up.php";
	}
		$pagetype="hp";
	break;

	case "top_template":
	if($_SESSION["editmode"]=="webmaster"){
			include "./hpdata/goqcojp/top_template.php";
	}
		$pagetype="hp";
	break;
	case "top_template_up":
	if($_SESSION["editmode"]=="webmaster"){
			include "./hpdata/goqcojp/top_template_up.php";
	}
		$pagetype="hp";
	break;
		case "qa":
					$pagetype="hp";
					include "./hpdata/goqcojp/qa_category.php";
					break;
		   		case "qa_category":
					include "./hpdata/goqcojp/qa_category.php";
					$pagetype="hp";
					break;
		   		case "qa_setting":
					include "./hpdata/goqcojp/qanda/setting.php";
					$pagetype="hp";
					break;
		   
						case "qa_add":	
						$pagetype="hp";
					include "./hpdata/goqcojp/qa_addition.php";
					break;
		   		case "qa_up":
					$pagetype="hp";
					include "./hpdata/goqcojp/qa_update.php";
					break;
		   		case "qa_details":
					include "./hpdata/goqcojp/qa_d_top.php";
					$pagetype="hp";
					break;
		   		case "qa_d_add":
					include "./hpdata/goqcojp/qa_d_addition.php";
					$pagetype="hp";
					break;
				
		   		case "qa_d_up":
					include "./hpdata/goqcojp/qa_d_update.php";	
					$pagetype="hp";
					break;
		   		case "link_header":
					include "./hpdata/goqcojp/link_header.php";	
					$pagetype="hp";
					break;
		case "link_header_reg":
					include "./hpdata/goqcojp/link_header_reg.php";	
					$pagetype="hp";
					break;
					
		case "link_header_up":
					include "./hpdata/goqcojp/link_header_up.php";	
					$pagetype="hp";
					break;					
					
		case "qanda_header":
					include "./hpdata/goqcojp/qanda_header.php";	
					$pagetype="hp";
					break;
					
		case "qanda_header_reg":
					include "./hpdata/goqcojp/qanda_header_reg.php";	
					$pagetype="hp";
					break;
					
		case "qanda_header_up":
					include "./hpdata/goqcojp/qanda_header_up.php";	
					$pagetype="hp";
					break;				
		case "topics_header":
					include "./hpdata/goqcojp/topics_header.php";	
					$pagetype="hp";
					break;
					
		case "topics_header_reg":
					include "./hpdata/goqcojp/topics_header_reg.php";	
					$pagetype="hp";
					break;
					
		case "topics_header_up":
					include "./hpdata/goqcojp/topics_header_up.php";	
					$pagetype="hp";
					break;
					
		case "contact_header":
					include "./hpdata/goqcojp/contact_header.php";	
					$pagetype="hp";
					break;
					
		case "contact_header_reg":
					include "./hpdata/goqcojp/contact_header_reg.php";	
					$pagetype="hp";
					break;
					
		case "contact_header_up":
					include "./hpdata/goqcojp/contact_header_up.php";	
					$pagetype="hp";
					break;				
				
		case "company_header":
					include "./hpdata/goqcojp/company_header.php";	
					$pagetype="hp";
					break;
					
		case "company_header_reg":
					include "./hpdata/goqcojp/company_header_reg.php";	
					$pagetype="hp";
					break;
					
		case "company_header_up":
					include "./hpdata/goqcojp/company_header_up.php";	
					$pagetype="hp";
					break;				
				
		default:

$newschkdata=$dbobj->GetData("select * from menu_data where data_code='news'");
if($newschkdata["use_chk"]==1){
	include "./hpdata/goqcojp/index.php";
		$pagetype="hp";
}
else {
		include "./hpdata/goqcojp/top_plist.php";
		$pagetype="hp";

}
break;
	}	

?>