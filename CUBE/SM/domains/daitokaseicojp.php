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
		include ("./hpdata/daitokaseicojp/mf_designsetting.php");
		$pagetype="gw";
		break;			/* 新着情報 */
		case "news_reg":
		include "./hpdata/daitokaseicojp/mf_news_reg.php";
		$pagetype="hp";
		break;
		case "top_contents_category":
		include ("./hpdata/daitokaseicojp/top_contents_category.php");
		$pagetype="hp";
		break;			/* 新着情報 */
		case "news":
		include "./hpdata/daitokaseicojp/mf_news.php";
		$pagetype="hp";
		break;
		case "hp_basic_link_category":
		include "./hpdata/daitokaseicojp/mf_link_category.php";
		$pagetype="hp";
		break;		
		case "link":
		include "./hpdata/daitokaseicojp/mf_link_category.php";
		$pagetype="hp";
		break;
		case "link_category":
		$pagetype="hp";
		include "./hpdata/daitokaseicojp/mf_link_category.php";
		break;
		case "hp_basic_link_category_reg":
		$pagetype="hp";
		include "./hpdata/daitokaseicojp/mf_link_category_reg.php";
		break;		
		case "link_add":
		include "./hpdata/daitokaseicojp/mf_link_reg.php";
		$pagetype="hp";
		break;
		case "link_up":
		include "./link/update.php";
		$pagetype="hp";
		break;
		case "hp_basic_link_d":
		include "./hpdata/daitokaseicojp/mf_link.php";		
		$pagetype="hp";
		break;
		case "hp_basic_link_reg":
		include "./hpdata/daitokaseicojp/mf_link_reg.php";		
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
		include "./hpdata/daitokaseicojp/mf_blog_lineup.php";
		break;
		case "basic_blog_lineup":
		$pagetype="hp";
		include "./hpdata/daitokaseicojp/mf_blog_lineup.php";		
		break;		
		case "hp_basic_blog_cate":
		$pagetype="hp";		
		include "./hpdata/daitokaseicojp/mf_blog_cate.php";		
		break;
		case "hp_basic_blog_cate_reg":
		$pagetype="hp";
		include "./hpdata/daitokaseicojp/mf_blog_cate_reg.php";
		break;
		case "basic_blog_reg":
		$pagetype="hp";
		include "./hpdata/daitokaseicojp/mf_blog_reg.php";
		break;
		case "hp_basic_blog_closeup":
		$pagetype="hp";		
		include "./hpdata/daitokaseicojp/mf_blog_closeup.php";		
		break;
		case "blog_dadd":
		$pagetype="hp";
		include "./blog2/d_addition.php";
		break;
		case "basic_blog_reg":
		$pagetype="hp";
		include "./hpdata/daitokaseicojp/mf_blog_reg.php";
		break;
		case "hp_basic_blog_cate":
		$pagetype="hp";
		
		include "./blog2/d_update.php";
		break;
		case "hp_basic_blog_closeup":
		$pagetype="hp";
		include "./hpdata/daitokaseicojp/mf_blog_closeup.php";
		break;
		case "hp_basic_blog_cate_reg":
		$pagetype="hp";
		include "./hpdata/daitokaseicojp/mf_blog_cate_reg.php";
		break;
		case "patternlist":
		$pagetype="hp";
		
		include "./hpdata/daitokaseicojp/patternlist.php";
		
		break;
		/* ブログコンテンツ */
		
		case "news_setting":
		$pagetype="hp";
		include "./news/setting.php";
		break;
		case "banner":
		$pagetype="hp";
		include "./hpdata/daitokaseicojp/mf_banner.php";
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
			include "./hpdata/daitokaseicojp/mf_contents_category.php";
		$pagetype="hp";
		break;
		case "contents_details":
		if($_REQUEST["pattern"]=="freelist"){
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/daitokaseicojp/su/mf_freelist_up.php";
		}
		else {
		include "./hpdata/daitokaseicojp/mf_list.php";
		}
			}
			elseif($_REQUEST["pattern"]=="freepage"){
				if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/daitokaseicojp/su/mf_about.php";
		}
		else {
		include "./hpdata/daitokaseicojp/mf_about.php";
					}
				}
				else if($_REQUEST["pattern"]=="plist"){
		include "./hpdata/daitokaseicojp/mf_plist.php";
					}
					else if($_REQUEST["pattern"]=="ppage") {
	if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/daitokaseicojp/su/mf_about.php";
		}
		else {
		include "./hpdata/daitokaseicojp/mf_about.php";
}
		}
		$pagetype="hp";
		break;
case "contents_list_reg":
		if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/daitokaseicojp/su/mf_about.php";
		}
		else {

		include "./hpdata/daitokaseicojp/mf_list_reg.php";
}		
		$pagetype="hp";
break;
case "contents_plist_reg":
		include "./hpdata/daitokaseicojp/mf_plist_reg.php";
		$pagetype="hp";
break;
case "contents_list_up":
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/daitokaseicojp/su/mf_about.php";
		}
		else {
	include "./hpdata/daitokaseicojp/mf_list_up.php";
}		
		$pagetype="hp";
break;

case "contents_plist_up":
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/daitokaseicojp/su/mf_plist_up.php";
		}
		else {
	include "./hpdata/daitokaseicojp/mf_plist_up.php";
}		
		$pagetype="hp";
break;
		case "link_category":
		include "./hpdata/daitokaseicojp/mf_link_category.php";
		$pagetype="hp";
		break;
		case "link_category_reg":
		
			include "./hpdata/daitokaseicojp/mf_link_category_reg.php";
		$pagetype="hp";
		break;
		case "link_d":
		include "./hpdata/daitokaseicojp/mf_link.php";
		$pagetype="hp";
		break;
		case "banner":
		include "./hpdata/daitokaseicojp/mf_banner.php";
		$pagetype="hp";
		break;
		case "news":
		include "./hpdata/daitokaseicojp/mf_news.php";
		$pagetype="hp";
		break;
		case "news_reg":
		include "./hpdata/daitokaseicojp/mf_news_reg.php";
		$pagetype="hp";
		break;
		case "contents_category_reg":
		
		if($_SESSION["editmode"]=="webmaster"){
				include "./hpdata/daitokaseicojp/su/mf_contents_category.php";
		}
		else {
		include "./hpdata/daitokaseicojp/mf_contents_category_reg.php";
		}
		
		$pagetype="hp";
		break;
		case "contents_category_up":
		if($_SESSION["editmode"]=="webmaster"){
				include "./hpdata/daitokaseicojp/su/mf_contents_category.php";
		}
		else {
		include "./hpdata/daitokaseicojp/mf_contents_category_up.php";
		}
		
		$pagetype="hp";
		break;
		case "blog_lineup":
		include "./hpdata/daitokaseicojp/mf_blog_lineup.php";
		$pagetype="hp";
		break;
		case "blog_closeup":
		include "./hpdata/daitokaseicojp/mf_blog_closeup.php";
		$pagetype="hp";
		break;
		case "menu":
		include "./hpdata/daitokaseicojp/mf_menu.php";
		$pagetype="hp";
		break;
		case "pagesetting":
		include "./hpdata/daitokaseicojp/mf_pagesetting.php";
		$pagetype="hp";
		break;
		case "blog_cate":
		include "./hpdata/daitokaseicojp/mf_blog_cate.php";
		$pagetype="hp";
		break;
		case "blog_cate_reg":
		include "./hpdata/daitokaseicojp/mf_blog_cate_reg.php";
		$pagetype="hp";
		break;
		case "blog_reg":
		
		include "./hpdata/daitokaseicojp/mf_blog_reg.php";
		$pagetype="hp";
		
		break;
		case "contact":
		
		include "./hpdata/daitokaseicojp/mf_contact.php";
		$pagetype="hp";
		
		break;
		
		case "link_reg":
		
		include "./hpdata/daitokaseicojp/mf_link_reg.php";
		$pagetype="hp";
		break;
	
case "contents2_list_reg":
		if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/daitokaseicojp/su/mf_about2.php";
		}
		else {

		include "./hpdata/daitokaseicojp/mf_list2_reg.php";
}		
		$pagetype="hp";
break;
case "contents2_plist_reg":
		include "./hpdata/daitokaseicojp/mf_plist2_reg.php";
		$pagetype="hp";
break;

case "contents2_list_up":
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/daitokaseicojp/su/mf_about2.php";
		}
		else {
	include "./hpdata/daitokaseicojp/mf_list2_up.php";
}		
		$pagetype="hp";
break;

case "contents2_plist_up":
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/daitokaseicojp/su/mf_plist2_up.php";
		}
		else {
	include "./hpdata/daitokaseicojp/mf_plist2_up.php";
}		
		$pagetype="hp";
break;
		case "contents2_category_reg":
		
		if($_SESSION["editmode"]=="webmaster"){
				include "./hpdata/daitokaseicojp/su/mf_contents2_category.php";
		}
		else {
		include "./hpdata/daitokaseicojp/mf_contents2_category_reg.php";
		}
		
		$pagetype="hp";
		break;
		case "contents2_category_up":
		if($_SESSION["editmode"]=="webmaster"){
				include "./hpdata/daitokaseicojp/su/mf_contents2_category.php";
		}
		else {
		include "./hpdata/daitokaseicojp/mf_contents2_category_up.php";
		}
		
		$pagetype="hp";
		break;
				case "contents2_category":
		if($_SESSION["editmode"]=="webmaster"){
				include "./hpdata/daitokaseicojp/su/mf_contents2_category.php";
		}
		else {
		include "./hpdata/daitokaseicojp/mf_contents2_category.php";
		}
		$pagetype="hp";
		break;
		case "contents2_details":
		if($_REQUEST["pattern"]=="freelist"){
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/daitokaseicojp/su/mf_freelist2_up.php";
		}
		else {
		include "./hpdata/daitokaseicojp/mf_list2.php";
		}
			}
			elseif($_REQUEST["pattern"]=="freepage"){
				if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/daitokaseicojp/su/mf_about2.php";
		}
		else {
		include "./hpdata/daitokaseicojp/mf_about2.php";
					}
				}
				else if($_REQUEST["pattern"]=="plist"){
		include "./hpdata/daitokaseicojp/mf_plist2.php";
					}
					else if($_REQUEST["pattern"]=="ppage") {
	if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/daitokaseicojp/su/mf_about2.php";
		}
		else {
		include "./hpdata/daitokaseicojp/mf_about2.php";
}
		}
		$pagetype="hp";
		break;
	case "company":
		include ("./hpdata/daitokaseicojp/company.php");
		$pagetype="hp";
		break;			/* 新着情報 */	
	case "staff_d_add":
		include ("./hpdata/daitokaseicojp/staff_add.php");
		$pagetype="hp";
		break;			/* 新着情報 */	
	case "top_contents_category_reg":
		include ("./hpdata/daitokaseicojp/top_contents_category_reg.php");
		$pagetype="hp";
		break;			/* 新着情報 */	
		case "top_contents_category_up":
		include ("./hpdata/daitokaseicojp/top_contents_category_up.php");
		$pagetype="hp";
		break;			/* 新着情報 */	
		
	case "top_contents":
			include "./hpdata/daitokaseicojp/top_plist.php";
		$pagetype="hp";
	break;
	case "top_contents_reg":
			include "./hpdata/daitokaseicojp/top_plist_reg.php";
		$pagetype="hp";
	break;
	case "top_contents_up":
			include "./hpdata/daitokaseicojp/top_plist_up.php";
		$pagetype="hp";
	break;
	case "top_flash_up":
	if($_SESSION["editmode"]=="webmaster"){
			include "./hpdata/daitokaseicojp/su/top_flash.php";
	}
	else if($_SESSION["loginmode"]=="su"){
		include "./hpdata/daitokaseicojp/su/top_flash.php";
		}
		else {
			include "./hpdata/daitokaseicojp/top_flash_up.php";
		}
		$pagetype="hp";
	break;
	case "template":
	if($_SESSION["editmode"]=="webmaster"){
			include "./hpdata/daitokaseicojp/template.php";
	}
		$pagetype="hp";
	break;

	case "template_reg":
	if($_SESSION["editmode"]=="webmaster"){
			include "./hpdata/daitokaseicojp/template_reg.php";
	}
		$pagetype="hp";
	break;
	case "template_up":
	if($_SESSION["editmode"]=="webmaster"){
			include "./hpdata/daitokaseicojp/template_up.php";
	}
		$pagetype="hp";
	break;
	case "template_cate":
	if($_SESSION["editmode"]=="webmaster"){
			include "./hpdata/daitokaseicojp/template_cate.php";
	}
		$pagetype="hp";
	break;
	case "template_cate_up":
	if($_SESSION["editmode"]=="webmaster"){
			include "./hpdata/daitokaseicojp/template_cate_up.php";
	}
		$pagetype="hp";
	break;

	case "top_template":
	if($_SESSION["editmode"]=="webmaster"){
			include "./hpdata/daitokaseicojp/top_template.php";
	}
		$pagetype="hp";
	break;
	case "top_template_up":
	if($_SESSION["editmode"]=="webmaster"){
			include "./hpdata/daitokaseicojp/top_template_up.php";
	}
		$pagetype="hp";
	break;
		case "qa":
					$pagetype="hp";
					include "./hpdata/daitokaseicojp/qa_category.php";
					break;
		   		case "qa_category":
					include "./hpdata/daitokaseicojp/qa_category.php";
					$pagetype="hp";
					break;
		   		case "qa_setting":
					include "./hpdata/daitokaseicojp/qanda/setting.php";
					$pagetype="hp";
					break;
		   
						case "qa_add":	
						$pagetype="hp";
					include "./hpdata/daitokaseicojp/qa_addition.php";
					break;
		   		case "qa_up":
					$pagetype="hp";
					include "./hpdata/daitokaseicojp/qa_update.php";
					break;
		   		case "qa_details":
					include "./hpdata/daitokaseicojp/qa_d_top.php";
					$pagetype="hp";
					break;
		   		case "qa_d_add":
					include "./hpdata/daitokaseicojp/qa_d_addition.php";
					$pagetype="hp";
					break;
				
		   		case "qa_d_up":
					include "./hpdata/daitokaseicojp/qa_d_update.php";	
					$pagetype="hp";
					break;
	
		   		case "m_products_download":
					include "./hpdata/daitokaseicojp/m_products_download.php";	
					$pagetype="hp";
					break;
		   		case "m_products_upload":
					include "./hpdata/daitokaseicojp/m_products_upload.php";	
					$pagetype="hp";
					break;
		default:
	include "./hpdata/daitokaseicojp/top_plist.php";
		$pagetype="hp";
		break;
	}	

?>