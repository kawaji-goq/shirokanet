<?php 
session_start(); 
mb_language("japanese");
mb_internal_encoding("euc-jp");
$dbname="fujitechno";
$usedb="postgresql";
$language="japanese";
$charcode="euc-jp";
$host="localhost";
$port="5432";
$name="fujitechno";
$user="postgres";
$pass="vw112739";
$debag=0;

$_CUBE["SIMGSIZE_W"]="150";
$_CUBE["SIMGSIZE_H"]="113";
$_CUBE["MIMGSIZE_W"]="660";
$_CUBE["MIMGSIZE_H"]="495";
$_CUBE["LIMGSIZE_W"]="800";
$_CUBE["LIMGSIZE_H"]="600";
$_CUBE["LEFTBANNER_W"]="182";
$_CUBE["TOPBANNER_W"]="660";

include "./class/db.php";
include "./class/ab_basictype.php";
include "./class/calendar.php";
include "./class/files.php";
include "./class/Image.php";
include "./class/links.php";
include "./class/mysql.php";
include "./class/postgresql.php";
include "./class/news.php";
include "./class/schedule.php";
include "./class/upload.php";
include "./class/sekou.php";
include "./class/sekou_info.php";
include "./class/company.php";
include "./class/viewer.php";

$dbobj=Cube_DB :: UseDB($usedb);
$dbobj->dbname=$dbname;
$usedb="postgresql";
$dbobj->language=$language;
$dbobj->charcode=$charcode;
$dbobj->host=$host;
$dbobj->port=$port;
$dbobj->name=$name;
$dbobj->user=$user;
$dbobj->pass=$pass;
$dbobj->debag=0;
$dbobj->Connect();
$sekouobj=new Sekou($dbobj);
$sekouinfoobj=new Sekou_Info($dbobj);
$comobj=new Company($dbobj);
$newsobj=new News($dbobj);
$linkobj=new Links($dbobj);
?>