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
		include ("./hpdata/nishikigawacom/mf_designsetting.php");
		$pagetype="gw";
		break;			/* 新着情報 */
		case "news_reg":
		include "./hpdata/nishikigawacom/mf_news_reg.php";
		$pagetype="hp";
		break;
		case "top_contents_category":
		include ("./hpdata/nishikigawacom/top_contents_category.php");
		$pagetype="hp";
		break;			/* 新着情報 */
		case "news":
		include "./hpdata/nishikigawacom/mf_news.php";
		$pagetype="hp";
		break;
		case "maillogs":
		include "./hpdata/nishikigawacom/maillogs.php";
		$pagetype="hp";
		break;
                case "maillogsdetail":
                include "./hpdata/nishikigawacom/maillogsdetail.php";
                $pagetype="hp";
                break;
		case "hp_basic_link_category":
		include "./hpdata/nishikigawacom/mf_link_category.php";
		$pagetype="hp";
		break;		
		case "link":
		include "./hpdata/nishikigawacom/mf_link_category.php";
		$pagetype="hp";
		break;
		case "link_category":
		$pagetype="hp";
		include "./hpdata/nishikigawacom/mf_link_category.php";
		break;
		case "hp_basic_link_category_reg":
		$pagetype="hp";
		include "./hpdata/nishikigawacom/mf_link_category_reg.php";
		break;		
		case "link_add":
		include "./hpdata/nishikigawacom/mf_link_reg.php";
		$pagetype="hp";
		break;
		case "link_up":
		include "./link/update.php";
		$pagetype="hp";
		break;
		case "hp_basic_link_d":
		include "./hpdata/nishikigawacom/mf_link.php";		
		$pagetype="hp";
		break;
		case "hp_basic_link_reg":
		include "./hpdata/nishikigawacom/mf_link_reg.php";		
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
		include "./hpdata/nishikigawacom/mf_blog_lineup.php";
		break;
		case "basic_blog_lineup":
		$pagetype="hp";
		include "./hpdata/nishikigawacom/mf_blog_lineup.php";		
		break;		
		case "hp_basic_blog_cate":
		$pagetype="hp";		
		include "./hpdata/nishikigawacom/mf_blog_cate.php";		
		break;
		case "hp_basic_blog_cate_reg":
		$pagetype="hp";
		include "./hpdata/nishikigawacom/mf_blog_cate_reg.php";
		break;
		case "basic_blog_reg":
		$pagetype="hp";
		include "./hpdata/nishikigawacom/mf_blog_reg.php";
		break;
		case "hp_basic_blog_closeup":
		$pagetype="hp";		
		include "./hpdata/nishikigawacom/mf_blog_closeup.php";		
		break;
		case "blog_dadd":
		$pagetype="hp";
		include "./blog2/d_addition.php";
		break;
		case "basic_blog_reg":
		$pagetype="hp";
		include "./hpdata/nishikigawacom/mf_blog_reg.php";
		break;
		case "hp_basic_blog_cate":
		$pagetype="hp";
		
		include "./blog2/d_update.php";
		break;
		case "hp_basic_blog_closeup":
		$pagetype="hp";
		include "./hpdata/nishikigawacom/mf_blog_closeup.php";
		break;
		case "hp_basic_blog_cate_reg":
		$pagetype="hp";
		include "./hpdata/nishikigawacom/mf_blog_cate_reg.php";
		break;
		case "patternlist":
		$pagetype="hp";
		
		include "./hpdata/nishikigawacom/patternlist.php";
		
		break;
		/* ブログコンテンツ */
		
		case "news_setting":
		$pagetype="hp";
		include "./news/setting.php";
		break;
		case "banner":
		$pagetype="hp";
		include "./hpdata/nishikigawacom/mf_banner.php";
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
			include "./hpdata/nishikigawacom/mf_contents_category.php";
		$pagetype="hp";
		break;
		
		case "contents_details":
		if($_REQUEST["pattern"]=="freelist"){
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/nishikigawacom/su/mf_freelist_up.php";
		}
		else {
		include "./hpdata/nishikigawacom/mf_list.php";
		}
			}
			elseif($_REQUEST["pattern"]=="freepage"){
				if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/nishikigawacom/su/mf_about.php";
		}
		else {
		include "./hpdata/nishikigawacom/mf_about.php";
					}
				}
				else if($_REQUEST["pattern"]=="plist"){
		include "./hpdata/nishikigawacom/mf_plist.php";
					}
					else if($_REQUEST["pattern"]=="ppage") {
	if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/nishikigawacom/su/mf_about.php";
		}
		else {
		include "./hpdata/nishikigawacom/mf_about.php";
}
		}
		$pagetype="hp";
		break;
		
case "contents_list_reg":
		if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/nishikigawacom/su/mf_about.php";
		}
		else {

		include "./hpdata/nishikigawacom/mf_list_reg.php";
}		
		$pagetype="hp";
break;
case "contents_plist_reg":
		include "./hpdata/nishikigawacom/mf_plist_reg.php";
		$pagetype="hp";
break;
case "contents_list_up":
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/nishikigawacom/su/mf_about.php";
		}
		else {
	include "./hpdata/nishikigawacom/mf_list_up.php";
}		
		$pagetype="hp";
break;

case "contents_plist_up":
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/nishikigawacom/su/mf_plist_up.php";
		}
		else {
	include "./hpdata/nishikigawacom/mf_plist_up.php";
}		
		$pagetype="hp";
break;
		case "link_category":
		include "./hpdata/nishikigawacom/mf_link_category.php";
		$pagetype="hp";
		break;
		case "link_category_reg":
		
			include "./hpdata/nishikigawacom/mf_link_category_reg.php";
		$pagetype="hp";
		break;
		case "link_d":
		include "./hpdata/nishikigawacom/mf_link.php";
		$pagetype="hp";
		break;
		case "banner":
		include "./hpdata/nishikigawacom/mf_banner.php";
		$pagetype="hp";
		break;
		case "news":
		include "./hpdata/nishikigawacom/mf_news.php";
		$pagetype="hp";
		break;
		case "news_reg":
		include "./hpdata/nishikigawacom/mf_news_reg.php";
		$pagetype="hp";
		break;
		case "contents_category_reg":
		
		if($_SESSION["editmode"]=="webmaster"){
				include "./hpdata/nishikigawacom/su/mf_contents_category.php";
		}
		else {
		include "./hpdata/nishikigawacom/mf_contents_category_reg.php";
		}
		
		$pagetype="hp";
		break;
		case "contents_category_up":
		if($_SESSION["editmode"]=="webmaster"){
				include "./hpdata/nishikigawacom/su/mf_contents_category.php";
		}
		else {
		include "./hpdata/nishikigawacom/mf_contents_category_up.php";
		}
		
		$pagetype="hp";
		break;
		case "blog_lineup":
		include "./hpdata/nishikigawacom/mf_blog_lineup.php";
		$pagetype="hp";
		break;
		case "blog_closeup":
		include "./hpdata/nishikigawacom/mf_blog_closeup.php";
		$pagetype="hp";
		break;
		case "menu":
		include "./hpdata/nishikigawacom/mf_menu.php";
		$pagetype="hp";
		break;
		case "pagesetting":
		include "./hpdata/nishikigawacom/mf_pagesetting.php";
		$pagetype="hp";
		break;
		case "blog_cate":
		include "./hpdata/nishikigawacom/mf_blog_cate.php";
		$pagetype="hp";
		break;
		case "blog_cate_reg":
		include "./hpdata/nishikigawacom/mf_blog_cate_reg.php";
		$pagetype="hp";
		break;
		case "blog_reg":
		
		include "./hpdata/nishikigawacom/mf_blog_reg.php";
		$pagetype="hp";
		
		break;
		case "contact":
		
		include "./hpdata/nishikigawacom/mf_contact.php";
		$pagetype="hp";
		
		break;
		
		case "link_reg":
		
		include "./hpdata/nishikigawacom/mf_link_reg.php";
		$pagetype="hp";
		break;
	
case "contents2_list_reg":
		if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/nishikigawacom/su/mf_about2.php";
		}
		else {

		include "./hpdata/nishikigawacom/mf_list2_reg.php";
}		
		$pagetype="hp";
break;
case "contents2_plist_reg":
		include "./hpdata/nishikigawacom/mf_plist2_reg.php";
		$pagetype="hp";
break;

case "contents2_list_up":
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/nishikigawacom/su/mf_about2.php";
		}
		else {
	include "./hpdata/nishikigawacom/mf_list2_up.php";
}		
		$pagetype="hp";
break;

case "contents2_plist_up":
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/nishikigawacom/su/mf_plist2_up.php";
		}
		else {
	include "./hpdata/nishikigawacom/mf_plist2_up.php";
}		
		$pagetype="hp";
break;
		case "contents2_category_reg":
		
		if($_SESSION["editmode"]=="webmaster"){
				include "./hpdata/nishikigawacom/su/mf_contents2_category.php";
		}
		else {
		include "./hpdata/nishikigawacom/mf_contents2_category_reg.php";
		}
		
		$pagetype="hp";
		break;
		case "contents2_category_up":
		if($_SESSION["editmode"]=="webmaster"){
				include "./hpdata/nishikigawacom/su/mf_contents2_category.php";
		}
		else {
		include "./hpdata/nishikigawacom/mf_contents2_category_up.php";
		}
		
		$pagetype="hp";
		break;
				case "contents2_category":
		if($_SESSION["editmode"]=="webmaster"){
				include "./hpdata/nishikigawacom/su/mf_contents2_category.php";
		}
		else {
		include "./hpdata/nishikigawacom/mf_contents2_category.php";
		}
		$pagetype="hp";
		break;
		case "contents2_details":
		if($_REQUEST["pattern"]=="freelist"){
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/nishikigawacom/su/mf_freelist2_up.php";
		}
		else {
		include "./hpdata/nishikigawacom/mf_list2.php";
		}
			}
			elseif($_REQUEST["pattern"]=="freepage"){
				if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/nishikigawacom/su/mf_about2.php";
		}
		else {
		include "./hpdata/nishikigawacom/mf_about2.php";
					}
				}
				else if($_REQUEST["pattern"]=="plist"){
		include "./hpdata/nishikigawacom/mf_plist2.php";
					}
					else if($_REQUEST["pattern"]=="ppage") {
	if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/nishikigawacom/su/mf_about2.php";
		}
		else {
		include "./hpdata/nishikigawacom/mf_about2.php";
}
		}
		$pagetype="hp";
		break;
	case "company":
		include ("./hpdata/nishikigawacom/company.php");
		$pagetype="hp";
		break;			/* 新着情報 */	
	case "staff_d_add":
		include ("./hpdata/nishikigawacom/staff_add.php");
		$pagetype="hp";
		break;		
	case "staff_d_up":
		include ("./hpdata/nishikigawacom/staff_up.php");
		$pagetype="hp";
		break;			/* 新着情報 */	
		
		
		/* 新着情報 */	
	case "top_contents_category_reg":
		include ("./hpdata/nishikigawacom/top_contents_category_reg.php");
		$pagetype="hp";
		break;			/* 新着情報 */	
		case "top_contents_category_up":
		include ("./hpdata/nishikigawacom/top_contents_category_up.php");
		$pagetype="hp";
		break;			/* 新着情報 */	
		
	case "top_contents":
			include "./hpdata/nishikigawacom/top_plist.php";
		$pagetype="hp";
	break;
	case "top_contents_reg":
			include "./hpdata/nishikigawacom/top_plist_reg.php";
		$pagetype="hp";
	break;
	case "top_contents_up":
		include "./hpdata/nishikigawacom/top_plist_up.php";
		$pagetype="hp";
	break;
	case "top_flash_up":
	if($_SESSION["editmode"]=="webmaster"){
			include "./hpdata/nishikigawacom/su/top_flash.php";
	}
	else if($_SESSION["loginmode"]=="su"){
		include "./hpdata/nishikigawacom/su/top_flash.php";
		}
		else {
			include "./hpdata/nishikigawacom/top_flash_up.php";
		}
		$pagetype="hp";
	break;
	case "template":
	if($_SESSION["editmode"]=="webmaster"){
			include "./hpdata/nishikigawacom/template.php";
	}
		$pagetype="hp";
	break;

	case "template_reg":
	if($_SESSION["editmode"]=="webmaster"){
			include "./hpdata/nishikigawacom/template_reg.php";
	}
		$pagetype="hp";
	break;
	case "template_up":
	if($_SESSION["editmode"]=="webmaster"){
			include "./hpdata/nishikigawacom/template_up.php";
	}
		$pagetype="hp";
	break;
	case "template_cate":
	if($_SESSION["editmode"]=="webmaster"){
			include "./hpdata/nishikigawacom/template_cate.php";
	}
		$pagetype="hp";
	break;
	case "template_cate_up":
	if($_SESSION["editmode"]=="webmaster"){
			include "./hpdata/nishikigawacom/template_cate_up.php";
	}
		$pagetype="hp";
	break;

	case "top_template":
	if($_SESSION["editmode"]=="webmaster"){
			include "./hpdata/nishikigawacom/top_template.php";
	}
		$pagetype="hp";
	break;
	case "top_template_up":
	if($_SESSION["editmode"]=="webmaster"){
			include "./hpdata/nishikigawacom/top_template_up.php";
	}
		$pagetype="hp";
	break;
		case "qa":
					$pagetype="hp";
					include "./hpdata/nishikigawacom/qa_category.php";
					break;
		   		case "qa_category":
					include "./hpdata/nishikigawacom/qa_category.php";
					$pagetype="hp";
					break;
		   		case "qa_setting":
					include "./hpdata/nishikigawacom/qanda/setting.php";
					$pagetype="hp";
					break;
		   
						case "qa_add":	
						$pagetype="hp";
					include "./hpdata/nishikigawacom/qa_addition.php";
					break;
		   		case "qa_up":
					$pagetype="hp";
					include "./hpdata/nishikigawacom/qa_update.php";
					break;
		   		case "qa_details":
					include "./hpdata/nishikigawacom/qa_d_top.php";
					$pagetype="hp";
					break;
		   		case "qa_d_add":
					include "./hpdata/nishikigawacom/qa_d_addition.php";
					$pagetype="hp";
					break;
				
		   		case "qa_d_up":
					include "./hpdata/nishikigawacom/qa_d_update.php";	
					$pagetype="hp";
					break;
		   		case "link_header":
					include "./hpdata/nishikigawacom/link_header.php";	
					$pagetype="hp";
					break;
		case "link_header_reg":
					include "./hpdata/nishikigawacom/link_header_reg.php";	
					$pagetype="hp";
					break;
					
		case "link_header_up":
					include "./hpdata/nishikigawacom/link_header_up.php";	
					$pagetype="hp";
					break;					
					
		case "qanda_header":
					include "./hpdata/nishikigawacom/qanda_header.php";	
					$pagetype="hp";
					break;
					
		case "qanda_header_reg":
					include "./hpdata/nishikigawacom/qanda_header_reg.php";	
					$pagetype="hp";
					break;
					
		case "qanda_header_up":
					include "./hpdata/nishikigawacom/qanda_header_up.php";	
					$pagetype="hp";
					break;				
		case "topics_header":
					include "./hpdata/nishikigawacom/topics_header.php";	
					$pagetype="hp";
					break;
					
		case "topics_header_reg":
					include "./hpdata/nishikigawacom/topics_header_reg.php";	
					$pagetype="hp";
					break;
					
		case "topics_header_up":
					include "./hpdata/nishikigawacom/topics_header_up.php";	
					$pagetype="hp";
					break;
					
		case "contact_header":
					include "./hpdata/nishikigawacom/contact_header.php";	
					$pagetype="hp";
					break;
					
		case "contact_header_reg":
					include "./hpdata/nishikigawacom/contact_header_reg.php";	
					$pagetype="hp";
					break;
					
		case "contact_header_up":
					include "./hpdata/nishikigawacom/contact_header_up.php";	
					$pagetype="hp";
					break;				
				
		case "company_header":
					include "./hpdata/nishikigawacom/company_header.php";	
					$pagetype="hp";
					break;
					
		case "company_header_reg":
					include "./hpdata/nishikigawacom/company_header_reg.php";	
					$pagetype="hp";
					break;
					
		case "company_header_up":
					include "./hpdata/nishikigawacom/company_header_up.php";	
					$pagetype="hp";
					break;				
		case "seiryu_timeschedule_lower":
					include "./hpdata/nishikigawacom/seiryu_timeschedule_lower.php";	
					$pagetype="hp";
					break;
		case "seiryu_timeschedule_upper":
					include "./hpdata/nishikigawacom/seiryu_timeschedule_upper.php";	
					$pagetype="hp";
					break;
		case "seiryu_timeschedule_lower_reg":
					include "./hpdata/nishikigawacom/seiryu_timeschedule_lower_reg.php";	
					$pagetype="hp";
					break;
		case "seiryu_timeschedule_lower_up":
					include "./hpdata/nishikigawacom/seiryu_timeschedule_lower_up.php";	
					$pagetype="hp";
					break;
		case "seiryu_timeschedule_upper_reg":
					include "./hpdata/nishikigawacom/seiryu_timeschedule_upper_reg.php";	
					$pagetype="hp";
					break;
		case "seiryu_timeschedule_upper_up":
					include "./hpdata/nishikigawacom/seiryu_timeschedule_upper_up.php";	
					$pagetype="hp";
					break;

/////////////////////////////////////////////////////////////////////////////////



		case "seiryu_timeschedule_lower_next":
					include "./hpdata/nishikigawacom/seiryu_timeschedule_lower_next.php";	
					$pagetype="hp";
					break;
		case "seiryu_timeschedule_upper_next":
					include "./hpdata/nishikigawacom/seiryu_timeschedule_upper_next.php";	
					$pagetype="hp";
					break;
		case "seiryu_timeschedule_lower_next_reg":
					include "./hpdata/nishikigawacom/seiryu_timeschedule_lower_next_reg.php";	
					$pagetype="hp";
					break;
		case "seiryu_timeschedule_lower_next_up":
					include "./hpdata/nishikigawacom/seiryu_timeschedule_lower_next_up.php";	
					$pagetype="hp";
					break;
		case "seiryu_timeschedule_upper_next_reg":
					include "./hpdata/nishikigawacom/seiryu_timeschedule_upper_next_reg.php";	
					$pagetype="hp";
					break;
		case "seiryu_timeschedule_upper_next_up":
					include "./hpdata/nishikigawacom/seiryu_timeschedule_upper_next_up.php";	
					$pagetype="hp";
					break;



//////////////////////////////////////////////////////////////////////////////////

		case "tokotoko_timeschedule_lower_next":
					include "./hpdata/nishikigawacom/tokotoko_timeschedule_lower_next.php";	
					$pagetype="hp";
					break;
		case "tokotoko_timeschedule_upper_next":
					include "./hpdata/nishikigawacom/tokotoko_timeschedule_upper_next.php";	
					$pagetype="hp";
					break;
		case "tokotoko_timeschedule_lower_next_reg":
					include "./hpdata/nishikigawacom/tokotoko_timeschedule_lower_next_reg.php";	
					$pagetype="hp";
					break;
		case "tokotoko_timeschedule_lower_next_up":
					include "./hpdata/nishikigawacom/tokotoko_timeschedule_lower_next_up.php";	
					$pagetype="hp";
					break;
		case "tokotoko_timeschedule_upper_next_reg":
					include "./hpdata/nishikigawacom/tokotoko_timeschedule_upper_next_reg.php";	
					$pagetype="hp";
					break;
					
		case "tokotoko_timeschedule_upper_next_up":
					include "./hpdata/nishikigawacom/tokotoko_timeschedule_upper_next_up.php";	
					$pagetype="hp";
					break;

//////////////////////////////////////////////////////////////////////////////////

		case "seiryu_station_fare":
					include "./hpdata/nishikigawacom/seiryu_station_fare.php";	
					$pagetype="hp";
					break;
					
		case "seiryu_station_fare_up":
					include "./hpdata/nishikigawacom/seiryu_station_fare_up.php";	
					$pagetype="hp";
					break;					
					
		case "seiryu_station_fare_next":
					include "./hpdata/nishikigawacom/seiryu_station_fare_next.php";	
					$pagetype="hp";
					break;
					
		case "seiryu_station_fare_next_up":
					include "./hpdata/nishikigawacom/seiryu_station_fare_next_up.php";	
					$pagetype="hp";
					break;	
					
//////////////////////////////////////////////////////////////////////////////////

		case "seiryu_station_bus1_up":
					include "./hpdata/nishikigawacom/seiryu_station_bus1_up.php";	
					$pagetype="hp";
					break;					
					
		case "seiryu_station_bus1_next_up":
					include "./hpdata/nishikigawacom/seiryu_station_bus1_next_up.php";	
					$pagetype="hp";
					break;	

		case "seiryu_station_bus2_up":
					include "./hpdata/nishikigawacom/seiryu_station_bus2_up.php";	
					$pagetype="hp";
					break;					
					
		case "seiryu_station_bus2_next_up":
					include "./hpdata/nishikigawacom/seiryu_station_bus2_next_up.php";	
					$pagetype="hp";
					break;
		case "seiryu_station_bus3_up":
					include "./hpdata/nishikigawacom/seiryu_station_bus3_up.php";	
					$pagetype="hp";
					break;					
					
		case "seiryu_station_bus3_next_up":
					include "./hpdata/nishikigawacom/seiryu_station_bus3_next_up.php";	
					$pagetype="hp";
					break;	
					
		case "seiryu_station_bus4_up":
					include "./hpdata/nishikigawacom/seiryu_station_bus4_up.php";	
					$pagetype="hp";
					break;					
					
		case "seiryu_station_bus4_next_up":
					include "./hpdata/nishikigawacom/seiryu_station_bus4_next_up.php";	
					$pagetype="hp";
					break;	
					

		case "seiryu_station_bus5_up":
					include "./hpdata/nishikigawacom/seiryu_station_bus5_up.php";	
					$pagetype="hp";
					break;					
					
		case "seiryu_station_bus5_next_up":
					include "./hpdata/nishikigawacom/seiryu_station_bus5_next_up.php";	
					$pagetype="hp";
					break;	

		case "seiryu_station_bus6_up":
					include "./hpdata/nishikigawacom/seiryu_station_bus6_up.php";	
					$pagetype="hp";
					break;					
					
		case "seiryu_station_bus6_next_up":
					include "./hpdata/nishikigawacom/seiryu_station_bus6_next_up.php";	
					$pagetype="hp";
					break;	

//////////////////////////////////////////////////////////////////////////////////
		case "seiryu_station_info":
					include "./hpdata/nishikigawacom/seiryu_station_info.php";	
					$pagetype="hp";
					break;
		case "seiryu_station_info_up":
					include "./hpdata/nishikigawacom/seiryu_station_info_up.php";	
					$pagetype="hp";
					break;					
			case "seiryu_joko_info":
					include "./hpdata/nishikigawacom/seiryu_joko_info.php";	
					$pagetype="hp";
					break;
		case "seiryu_joko_info_up":
					include "./hpdata/nishikigawacom/seiryu_joko_info_up.php";	
					$pagetype="hp";
					break;
			case "seiryu_site_info":
					include "./hpdata/nishikigawacom/seiryu_site_info.php";	
					$pagetype="hp";
					break;
		case "seiryu_site_info_reg":
					include "./hpdata/nishikigawacom/seiryu_site_info_reg.php";	
					$pagetype="hp";
					break;
		case "seiryu_site_info_up":
					include "./hpdata/nishikigawacom/seiryu_site_info_up.php";	
					$pagetype="hp";
					break;
		case "valley_timeschedule_lower":
					include "./hpdata/nishikigawacom/valley_timeschedule_lower.php";	
					$pagetype="hp";
					break;
		case "valley_timeschedule_upper":
					include "./hpdata/nishikigawacom/valley_timeschedule_upper.php";	
					$pagetype="hp";
					break;
		case "valley_timeschedule_lower_reg":
					include "./hpdata/nishikigawacom/valley_timeschedule_lower_reg.php";	
					$pagetype="hp";
					break;
		case "valley_timeschedule_lower_up":
					include "./hpdata/nishikigawacom/valley_timeschedule_lower_up.php";	
					$pagetype="hp";
					break;
		case "valley_timeschedule_upper_reg":
					include "./hpdata/nishikigawacom/valley_timeschedule_upper_reg.php";	
					$pagetype="hp";
					break;
		case "valley_timeschedule_upper_up":
					include "./hpdata/nishikigawacom/valley_timeschedule_upper_up.php";	
					$pagetype="hp";
					break;

		case "kayama_timeschedule_lower":
					include "./hpdata/nishikigawacom/kayama_timeschedule_lower.php";	
					$pagetype="hp";
					break;
		case "kayama_timeschedule_upper":
					include "./hpdata/nishikigawacom/kayama_timeschedule_upper.php";	
					$pagetype="hp";
					break;
		case "kayama_timeschedule_lower_reg":
					include "./hpdata/nishikigawacom/kayama_timeschedule_lower_reg.php";	
					$pagetype="hp";
					break;
		case "kayama_timeschedule_lower_up":
					include "./hpdata/nishikigawacom/kayama_timeschedule_lower_up.php";	
					$pagetype="hp";
					break;
		case "kayama_timeschedule_upper_reg":
					include "./hpdata/nishikigawacom/kayama_timeschedule_upper_reg.php";	
					$pagetype="hp";
					break;
		case "kayama_timeschedule_upper_up":
					include "./hpdata/nishikigawacom/kayama_timeschedule_upper_up.php";	
					$pagetype="hp";
					break;
		case "takane_timeschedule_lower":
					include "./hpdata/nishikigawacom/takane_timeschedule_lower.php";	
					$pagetype="hp";
					break;
		case "takane_timeschedule_upper":
					include "./hpdata/nishikigawacom/takane_timeschedule_upper.php";	
					$pagetype="hp";
					break;
		case "takane_timeschedule_lower_reg":
					include "./hpdata/nishikigawacom/takane_timeschedule_lower_reg.php";	
					$pagetype="hp";
					break;
		case "takane_timeschedule_lower_up":
					include "./hpdata/nishikigawacom/takane_timeschedule_lower_up.php";	
					$pagetype="hp";
					break;
		case "takane_timeschedule_upper_reg":
					include "./hpdata/nishikigawacom/takane_timeschedule_upper_reg.php";	
					$pagetype="hp";
					break;
		case "takane_timeschedule_upper_up":
					include "./hpdata/nishikigawacom/takane_timeschedule_upper_up.php";	
					$pagetype="hp";
					break;
		case "tokotoko_timeschedule_lower":
					include "./hpdata/nishikigawacom/tokotoko_timeschedule_lower.php";	
					$pagetype="hp";
					break;
		case "tokotoko_timeschedule_upper":
					include "./hpdata/nishikigawacom/tokotoko_timeschedule_upper.php";	
					$pagetype="hp";
					break;
		case "tokotoko_timeschedule_lower_reg":
					include "./hpdata/nishikigawacom/tokotoko_timeschedule_lower_reg.php";	
					$pagetype="hp";
					break;
		case "tokotoko_timeschedule_lower_up":
					include "./hpdata/nishikigawacom/tokotoko_timeschedule_lower_up.php";	
					$pagetype="hp";
					break;
		case "tokotoko_timeschedule_upper_reg":
					include "./hpdata/nishikigawacom/tokotoko_timeschedule_upper_reg.php";	
					$pagetype="hp";
					break;
		case "tokotoko_timeschedule_upper_up":
					include "./hpdata/nishikigawacom/tokotoko_timeschedule_upper_up.php";	
					$pagetype="hp";
					break;

		case "tokotoko_schedule":
					include "./hpdata/nishikigawacom/tokotoko_schedule.php";	
					$pagetype="hp";
					break;
		case "tokotoko_schedule_rep":
					include "./hpdata/nishikigawacom/tokotoko_schedule_rep.php";	
					$pagetype="hp";
					break;
		case "tokotoko":
					include "./hpdata/nishikigawacom/tokotoko.php";	
					$pagetype="hp";
					break;
	case "gallery":
			include "./hpdata/nishikigawacom/mf_gallery.php";
		$pagetype="hp";
	break;
	case "gallery_reg":
			include "./hpdata/nishikigawacom/mf_gallery_reg.php";
		$pagetype="hp";
	break;
		default:

$newschkdata=$dbobj->GetData("select * from menu_data where data_code='news'");
$blogchkdata=$dbobj->GetData("select * from menu_data where data_code='blog'");

if($blogchkdata["use_chk"]==1&&$newschkdata["use_chk"]==1){
	
	include "./hpdata/nishikigawacom/index.php";
		$pagetype="hp";
}
else if($blogchkdata["use_chk"]==1){
		include "./hpdata/nishikigawacom/mf_blog_lineup.php";
		$pagetype="hp";
}
else if($newschkdata["use_chk"]==1){
	include "./hpdata/nishikigawacom/index.php";
		$pagetype="hp";
}
else {
		include "./hpdata/nishikigawacom/top_plist.php";
		$pagetype="hp";

}
break;
	}	

?>
