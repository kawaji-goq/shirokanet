<?php  /* ?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<?php */ ?>
<?php 
/*

$original_img = "img/Sample.jpg";//イメージパス

$reduce = "200";//変更後の横幅

$new_img = "img/200209041136.jpg";

$file_type = .jpg or .gif//ファイルの拡張子



$reduce = "200";//変更後の横幅

$new_img = "img/200209041136.jpg";

$file_type = .jpg or .gif//ファイルの拡張子

*/

function size_down($original_img,$reduce,$new_img) {

// 出力エンコーディングをパス

	mb_http_output("pass");

	//画像の幅と高さを取得

	list($width, $height) = @getimagesize($original_img);

	if($width<$reduce) {

		$reduce=$width;
	}

	// サイズを設定

	$newwidth = round($reduce);//幅の設定

	$newheight = round($height / ($width/$reduce));//高さの設定

	// イメージ作成 

	$src = imagecreatefromjpeg($original_img) or die();

	$dst = imagecreatetruecolor($newwidth, $newheight) or die();

	// リサイズ

	@imagecopyresized($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height) or die();

	//@imagecopyresampled($dst,$src,0, 0, 0, 0, $newwidth, $newheight, $width, $height); //or die();

	// 保存

	imagejpeg($dst,$new_img,100);

	// メモリ開放

	imagedestroy($src);

	imagedestroy($dst);
}
function size_down2($original_img,$reducewidth,$reduceheight,$new_img) {

// 出力エンコーディングをパス

	mb_http_output("pass");

	//画像の幅と高さを取得

	list($width, $height) = @getimagesize($original_img);
	if($width>=$reducewidth||$height>=$reduceheight) {
		#写真は縦長か横長か？
		if($width<$height) {
			#実際の縦より大きいか？
			if($height<$reduceheight) {
				#修正するサイズを実際のサイズに変更する
				#$reduceheight=$height;
				#修正後のサイズ
				$newheight=$height;
				#修正幅を設定
				$newwidth = round($width / ($height/$newheight));
				#設定した高さが希望の高さより高くない？
				if($newheight>$reduceheight) {
					$newsize=sizechk($newwidth,$reducewidth,$newheight,$reduceheight,$height,$width,1,$maxcount+1);
				}
				else if($newwidth>$reducewidth) {#希望の幅より大きくない？
				
					$newsize=sizechk($newwidth,$reducewidth,$newheight,$reduceheight,$height,$width,2,$maxcount+1);
				}
				else{
					
					#新しいサイズはこれで決定
					$newsize[width]=$newwidth;
					$newsize[height]=$newheight;
				}
			}
			else {
				#高さを設定
				$newheight=$reduceheight;
				#幅を設定
				$newwidth = round($width / ($height/$newheight));
				#指定の幅より大きくない？
				if($newwidth>$reducewidth) {
					$newsize=sizechk($newwidth,$reducewidth,$newheight,$reduceheight,$height,$width,2,$maxcount+1);
				}
				else if($newheight>$reduceheight) {#指定の高さより大きくない？
				
					$newsize=sizechk($newwidth,$reducewidth,$newheight,$reduceheight,$height,$width,1,$maxcount+1);
				}
				else {
				
					#新しいサイズはこれで決定
					$newsize[width]=$newwidth;
					$newsize[height]=$newheight;
				}
			}
	
	#		$newsize=sizechk($newwidth,$reducewidth,$newheight,$reduceheight,1);
		}
		else {#横長のページ
		
			#実際の幅より大きい？
			if($width>$reducewidth) {
			
				#$reducewidth=$width;
				#幅を設定
				$newwidth=$width;
				#高さをを設定
				$newheight = round($height / ($width/$newwidth));
				#指定の高さより大きくない？
				if($newheight>$reduceheight) {
				
					$newsize=sizechk($newwidth,$reducewidth,$newheight,$reduceheight,$height,$width,1,1);
				}
				else if($newwidth>$reducewidth) {#指定の幅より大きくない？
				
					$newsize=sizechk($newwidth,$reducewidth,$newheight,$reduceheight,$height,$width,2,1);
				}
				else {
					#新しいサイズはこれで決定
					$newsize[width]=$newwidth;
					$newsize[height]=$newheight;
				}
			}
			else {
			
				$newwidth=$reducewidth;
				#幅を設定
				$newheight = round($height / ($width/$newwidth));
				if($newheight>$reduceheight) {
					$newsize=sizechk($newwidth,$reducewidth,$newheight,$reduceheight,$height,$width,1,1);
				}
				else if($newwidth>$reducewidth) {
					$newsize=sizechk($newwidth,$reducewidth,$newheight,$reduceheight,$height,$width,2,1);
				}
				else {
					#新しいサイズはこれで決定
					$newsize[width]=$newwidth;
					$newsize[height]=$newheight;
				}
			}
	#		$newsize=sizechk($newwidth,$reducewidth,$newheight,$reduceheight,2);
		}
	}
	else {
		#新しいサイズはこれで決定
		$newsize[width]=$width;
		$newsize[height]=$height;
		
	}
	// イメージ作成 
#	echo $newsize[width];
#	echo $newsize[height];

	$filedata=pathinfo($original_img);
	if($filedata[extension]=="jpg"||$filedata[extension]=="jpeg") {
		$src = imagecreatefromjpeg($original_img) or die();
	}
	else if($filedata[extension]=="gif") {
		$src = imagecreatefromgif($original_img) or die();
	}
	
#	$dst = imagecreatetruecolor($newsize[width],$newsize[height]) or die();
	$newsrc=imagecreatetruecolor($reducewidth,$reduceheight);
	$white=imagecolorallocate($newsrc,255,255,255);
	imagefill($newsrc,0,0,$white);
	// リサイズ
	$paste_x=($reducewidth- $newsize[width])/2;
	$paste_y=($reduceheight- $newsize[height])/2;

	@imagecopyresized($newsrc, $src, $paste_x, $paste_y, 0, 0, $newsize[width], $newsize[height], $width, $height) or die();
	//@imagecopyresampled($dst,$src,0, 0, 0, 0, $newwidth, $newheight, $width, $height); //or die();
	
	// 保存

	imagejpeg($newsrc,$new_img,100);

	// メモリ開放

	imagedestroy($src);

	imagedestroy($newsrc);
}

function sizechk($newwidth,$reducewidth,$newheight,$reduceheight,$height,$width,$mode,$maxcount) {
	if($maxcount<100) {
		switch($mode) {
			case 1:#高さが大きいといわれた
				#高さを指定の高さに変更
				$newheight=$reduceheight;
				#幅を設定
				$newwidth = round($width / ($height/$newheight));
				$newheight;
				if($newheight>$reduceheight) {#指定より高い？
				
					$newsize=sizechk($newwidth,$reducewidth,$newheight,$reduceheight,$height,$width,1,$maxcount+1);
				}
				else if($newwidth>$reducewidth) {#指定より太い？
				
					$newsize=sizechk($newwidth,$reducewidth,$newheight,$reduceheight,$height,$width,2,$maxcount+1);
				}
				else {
				
					#新しいサイズはこれで決定
					$newsize[width]=$newwidth;
					$newsize[height]=$newheight;
				}
				break;
			case 2:
				#幅を設定
				$newwidth=$reducewidth;
				#高さをを設定
				$newheight = round($height / ($width/$newwidth));
				#指定の高さより大きくない？
				if($newheight>$reduceheight) {
				
					$newsize=sizechk($newwidth,$reducewidth,$newheight,$reduceheight,$height,$width,1,$maxcount+1);
				}
				else if($newwidth>$reducewidth) {#指定の幅より大きくない？
					$newsize=sizechk($newwidth,$reducewidth,$newheight,$reduceheight,$height,$width,2,$maxcount+1);
				}
				else {
					#新しいサイズはこれで決定
					$newsize[width]=$newwidth;
					$newsize[height]=$newheight;
				}
				break;
		}
#		echo $mode;
	}
	else {
	
		echo "画像の修正に失敗しました。".$maxcount;
	}
	return $newsize;
}

class GdCustom {
	var $width;
	var $height;
	var $quality;
	var $originalphoto;
	var $path;
	
	function GdCustom($originalphoto,$path) {
		$this->originalphoto=$originalphoto;
		$this->path=$path;
	}
	
	function ChPhoto($w,$h,$q,$new_img) {
		// メモリ開放
		if(file_exists($new_img)) {
			unlink($new_img);
		}		
		$this->width=$w;
		$this->height=$h;
		$this->quality=$q;
		
		mb_http_output("pass");
		
		list($width, $height) = @getimagesize(($this->path).($this->originalphoto));
		
		$reduce=($this->width)/$width;
		
		if((($height*$reduce)>($this->height))) {
			$reduce=($this->height)/$height;
		}

		$newwidth = round($width*$reduce);//幅の設定
		$newheight = round($height*$reduce);//高さの設定
		// イメージ作成 

		$src = imagecreatefromjpeg(($this->path).($this->originalphoto)) or die();
		$dst = imagecreatetruecolor($newwidth, $newheight) or die();
		// リサイズ
	
		@imagecopyresized($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height) or die();
		imagejpeg($dst,$new_img,100);
		imagedestroy($src);
		chmod($new_img,"0777");
		imagedestroy($dst); 
	}
	
}

class ImgMagic {

	function ImgMagic() {
	}
	
	function convert_Size($original_img,$photoname,$path,$new_width,$new_height) {
		$filedata=pathinfo($original_img);
			if($filedata["extension"]=="bmp"){
				$filedata["extension"]="jpg";
			}
		//tmpファイルの削除
		@unlink($path."tmp1.".$filedata["extension"]);
		@unlink($path."tmp2.".$filedata["extension"]);
		$filepath=$path.$photoname;
		$result=0;
		$orignimge_size=@getimagesize($original_img);
		
		if($orignimge_size[0]<=$new_width&&$orignimge_size[1]<=$new_height) {
			$imgsizelist=@getimagesize($original_img);
			$flame_width=$new_width-$imgsizelist[0];
			$flame_height=$new_height-$imgsizelist[1];
			system("convert -border ".(int)($flame_width/2)."x".(int)($flame_height/2)." -bordercolor white ".$original_img." ".$filepath,$result);
			//echo "convert -border ".(int)($flame_width/2)."x".(int)($flame_height/2)." -bordercolor white ".$original_img." ".$filepath;
			return 2;
		}
		else {
			system("convert -geometry ".$new_width."x".$new_height." ".$original_img." ".$path."tmp2.".$filedata["extension"],$result);
			//echo "convert -geometry ".$new_width."x".$new_height." ".$original_img." ".$path."tmp2.".$filedata["extension"];
			
			$result;
		}
		$rows=0;

		while(!file_exists($path."tmp2.".$filedata["extension"])&&$rows<100) {
			$rows++;
		}

		$imgsizelist=@getimagesize($path."tmp2.".$filedata["extension"]);
		$flame_width=$new_width-$imgsizelist[0];
		$flame_height=$new_height-$imgsizelist[1];
		system("convert -border ".(int)($flame_width/2)."x".(int)($flame_height/2)." -bordercolor white ".$path."tmp2.".$filedata["extension"]." ".$filepath,$result);
		//echo "convert -border ".(int)($flame_width/2)."x".(int)($flame_height/2)." -bordercolor white ".$path."tmp2.".$filedata["extension"]." ".$filepath;
		@unlink($original_img);
		return 0;
		
		//echo "convert -border ".(int)($flame_width/2)."x".(int)($flame_height/2)." -bordercolor white ./tmp/sample4.jpg ./tmp/sample5.jpg";
	}
	
	function convert_Width($original_img,$photoname,$path,$new_width) {
		$filedata=@pathinfo($original_img);
			if($filedata["extension"]=="bmp"){
				$filedata["extension"]="jpg";
			}
		
		//tmpファイルの削除
		@unlink($path."tmp1.".$filedata["extension"]);
		@unlink($path."tmp2.".$filedata["extension"]);
		
		$filepath=$path.$photoname;
		$result=0;
		
		$orignimge_size=@getimagesize($original_img);
		
		if($orignimge_size[0]<=$new_width) {//横幅が指定より小さい時
			$imgsizelist=@getimagesize($original_img);
			$flame_width=$new_width-$imgsizelist[0];
			$flame_height=0;
			@system("convert -border ".(int)($flame_width/2)."x0 -bordercolor white ".$original_img." ".$filepath,$result);
			return 2;
		}
		else {//横幅が指定よりも大きいとき
			$newimg_ratio=$orignimge_size[0]/$new_width;
			$new_height=$orignimge_size[1]*$newimg_ratio;
			@system("convert -geometry ".$new_width."x".$new_height." ".$original_img." ".$path."tmp2.".$filedata["extension"],$result);
			$result;
		}
		$rows=0;

		while(!file_exists($path."tmp2.".$filedata["extension"])&&$rows<100) {
			$rows++;
		}

		$imgsizelist=@getimagesize($path."tmp2.".$filedata["extension"]);
		$flame_width=$new_width-$imgsizelist[0];
		$flame_height=0;
		@system("convert -border ".(int)($flame_width/2)."x11 -bordercolor white ".$path."tmp2.".$filedata["extension"]." ".$filepath,$result);
		@unlink($original_img);
		return 0;
	}

	function convert_Width2($photoname,$path,$new_width) {
		$filepath=$photoname;
		
		$filedata=@pathinfo($filepath);
			if($filedata["extension"]=="bmp"){
				$filedata["extension"]="jpg";
			}
		//tmpファイルの削除
		@unlink($path."tmp1.".$filedata["extension"]);
		@unlink($path."tmp2.".$filedata["extension"]);
		$result=0;
		$orignimge_size=@getimagesize($filepath);
		
		if($new_width<$orignimge_size[0]) {
			$newimg_ratio=$orignimge_size[0]/$new_width;
			$new_height=$orignimge_size[1]*$newimg_ratio;
			system("convert -geometry ".$new_width."x".$new_height." ".$filepath." ".$filepath,$result);
			//print_r($result);
			//echo "<br /><br />convert -geometry ".$new_width."x".$new_height." ".$filepath." ".$filepath."<br /><br />";
		}
		else {
			system("convert -geometry ".$orignimge_size[0]."x".$orignimge_size[1]." ".$filepath." ".$filepath,$result);
		//print_r($result);
		//	echo "<br /><br />convert -geometry ".$orignimge_size[0]."x".$orignimge_size[1]." ".$filepath." ".$filepath."<br /><br />";
		}
		return 0;
	}
	
	function convert_Height2($photoname,$path,$new_height) {
		$filepath=$photoname;
		$filedata=@pathinfo($filepath);
			if($filedata["extension"]=="bmp"){
				$filedata["extension"]="jpg";
			}
		//tmpファイルの削除
		@unlink($path."tmp1.".$filedata["extension"]);
		@unlink($path."tmp2.".$filedata["extension"]);
		$result=0;
		$orignimge_size=@getimagesize($filepath);
		$newimg_ratio=$orignimge_size[0]/$new_height;
		$new_width=$orignimge_size[1]*$newimg_ratio;
		@system("convert -geometry ".$new_width."x".$new_height." ".$filepath." ".$filepath,$result);
		return 0;
	}
	
//縦長の写真は横にする
//$original_img,	変換前の画像ファイル、パス付き
//$photoname,		変換後のファイル名
//$path,			画像へのパス
//$new_long,		長いほうのサイズ
//$new_short,		短いほうのサイズ
//$rotate			回転角度	
	function convert_Image($original_img,$photoname,$path,$new_long,$new_short,$rotate) {
		$filedata=@pathinfo($original_img);
			if($filedata["extension"]=="bmp"){
				$filedata["extension"]="jpg";
			}
		
		//tmpファイルの削除
		@unlink($path."tmp0.".$filedata["extension"]);
		@unlink($path."tmp1.".$filedata["extension"]);
		@unlink($path."tmp2.".$filedata["extension"]);
		
		//回転角度が0じゃなければ回転させる
		if($rotate!=0) {
			@system("convert -rotate ".$rotate." ".$original_img." ".$path."tmp0.".$filedata["extension"],$result);
		}
		else { //なければ名前を変更するだけ
			@rename($original_img,$path."tmp0.".$filedata["extension"]);
		}
		
		//新しい画像のおき場所
		$filepath=$path.$photoname;
		$result=0;
		//画像のサイズは？
		$orignimge_size=@getimagesize($path."tmp0.".$filedata["extension"]);
		
		//縦横大きいほうは？
		if($orignimge_size[0]>=$orignimge_size[1]) { //横の方が大きいよ
		
			if($new_long<$orignimge_size[0]||$new_short<$orignimge_size[1]) {//どちらかが指定より大きい
				@system("convert -geometry ".$new_long."x".$new_short." ".$path."tmp0.".($filedata["extension"])." ".$filepath,$result);
			}
			else {
				@rename($path."tmp0.".($filedata["extension"]),$filepath);
			}
		}
		else {//縦のほうが大きいな
		
			if($new_long<$orignimge_size[1]||$new_short<$orignimge_size[0]) {//どちらかが指定より大きい
				//変換必須
				@system("convert -geometry ".$new_short."x".$new_long." ".$path."tmp0.".($filedata["extension"])." ".$filepath,$result);
			}
			else {
				@rename($path."tmp0.".($filedata["extension"]),$filepath);
			}
		}
	}
	
	function cpandconv_Size($original_img,$photoname,$path,$new_width,$new_height) {
		$filedata=@pathinfo($original_img);
		//print_r($filedata);
		
		//echo $new_width,$new_height;
		
		if($filedata["extension"]=="bmp"){
			$filedata["extension"]="jpg";
		}
		if($filedata["extension"]=="png"){
			$filedata["extension"]="jpg";
		}
		
		$tmppath=$path."tmp.".$filedata["extension"];
		//tmpファイルの削除
		@unlink($path."tmp1.".$filedata["extension"]);
		@unlink($path."tmp2.".$filedata["extension"]);
		@unlink($tmppath);
		
		@copy($original_img,$tmppath);
		
		$filepath=$path.$photoname;
		$result=0;
		$orignimge_size=@getimagesize($tmppath);
///		print_r($orignimge_size);
		if($new_width!=NULL&&$new_height!=NULL&&$new_width!=0&&$new_height!=0) {
///			echo "0";

			if($orignimge_size[0]<=$new_width&&$orignimge_size[1]<=$new_height) {
				//echo "1";
				$imgsizelist=@getimagesize($tmppath);
				$flame_width=$new_width-$imgsizelist[0];
				$flame_height=$new_height-$imgsizelist[1];
				@system("convert -border ".(int)($flame_width/2)."x".(int)($flame_height/2)." -bordercolor white ".$tmppath." ".$filepath,$result);
				// $result;
				return 2;
			}
			else {
				//echo "2";
				//echo "convert -geometry ".$new_width."x".$new_height." ".$tmppath." ".$path."tmp2.".$filedata["extension"];
				if($new_width!=0&&$new_height!=0) {
					@system("convert -geometry ".$new_width."x".$new_height." ".$tmppath." ".$path."tmp2.".$filedata["extension"],$result);
				}
				else {
					@system("mv ".$tmppath." ".$path."tmp2.".$filedata["extension"],$result);
					copy($tmppath,$path."tmp2.".$filedata["extension"]);

				}
				
			//	echo "convert -geometry ".$new_width."x".$new_height." ".$tmppath." ".$path."tmp2.".$filedata["extension"];
				$rows=0;
		
				while(!file_exists($path."tmp2.".$filedata["extension"])&&$rows<500) {
					$rows++;
				}
				
				if(@file_exists($path."tmp2.".$filedata["extension"])) {
					$imgsizelist=@getimagesize($path."tmp2.".$filedata["extension"]);
					$flame_width=$new_width-$imgsizelist[0];
					$flame_height=$new_height-$imgsizelist[1];
					if($new_width!=0&&$new_height!=0){
						system("convert -border ".(int)($flame_width/2)."x".(int)($flame_height/2)." -bordercolor white ".$path."tmp2.".$filedata["extension"]." ".$filepath,$result);
						//echo "convert -border ".(int)($flame_width/2)."x".(int)($flame_height/2)." -bordercolor white ".$path."tmp2.".$filedata["extension"]." ".$filepath;
					}else {
						//system("mv ".$path."tmp2.".$filedata["extension"]." ".$filepath,$result);
						//echo "mv ".$path."tmp2.".$filedata["extension"]." ".$filepath;
						copy($path."tmp2.".$filedata["extension"],$filepath);
	
					}
				
				
					//echo $result;
					return 0;
					//echo "1";
				}
				else {
				//	echo "NG";
					
					return "アップロードに失敗しました。";
				}
			}
		}
		else if($new_width!=NULL&&$new_width!=0) {
					//	echo "4";

			@copy($original_img,$filepath);
			ImgMagic :: convert_Width2($filepath,$path,$new_width);
			return 0;
			
		}
		else if($new_height!=NULL&&$new_height!=0) {
						//echo "5";

			@copy($original_img,$filepath);
			ImgMagic :: convert_Height2($filepath,$path,$new_height);
			return 0;
		
		}
		else {
		
		copy($tmppath,$filepath);
						//cho "6";

			return "";
		}
	}
	
	function cpandconv_ReSize($original_img,$photoname,$path,$new_width,$new_height) {
		$filedata=pathinfo($original_img);
		$tmppath=$path."tmp.".$filedata["extension"];
		//tmpファイルの削除
		@unlink($path."tmp1.".$filedata["extension"]);
		@unlink($path."tmp2.".$filedata["extension"]);
		@unlink($tmppath);
		copy($original_img,$tmppath);
		$filepath=$path.$photoname;
		$result=0;
		$orignimge_size=@getimagesize($tmppath);
		if($orignimge_size[0]>$new_width||$orignimge_size[1]>$new_height) {
			@system("convert -geometry ".$new_width."x".$new_height." ".$original_img." ".$path.$photoname,$result);
			$result;
		}
		else {
				@copy($original_img,$path.$photoname);
		}
		
		return 0;
		
	}
	
	function cpandconv_Size_Noborder($original_img,$photoname,$path,$new_width,$new_height) {
		$filedata=@pathinfo($original_img);

		if($filedata["extension"]=="bmp"){
			$filedata["extension"]="jpg";
		}
		if($filedata["extension"]=="png"){
			$filedata["extension"]="jpg";
		}
		$tmppath=$path."tmp.".$filedata["extension"];
		//tmpファイルの削除
		@unlink($path."tmp1.".$filedata["extension"]);
		@unlink($path."tmp2.".$filedata["extension"]);
		@unlink($tmppath);
		
		@copy($original_img,$tmppath);
		
		$filepath=$path.$photoname;
		$result=0;
		$orignimge_size=@getimagesize($tmppath);
		
		if($new_width!=NULL&&$new_height!=NULL) {
				@system("convert -geometry ".$new_width."x".$new_height." ".$tmppath." ".$path."tmp2.".$filedata["extension"],$result);
				
			//	echo "convert -geometry ".$new_width."x".$new_height." ".$tmppath." ".$path."tmp2.".$filedata["extension"];
				$rows=0;
		
				while(!file_exists($path."tmp2.".$filedata["extension"])&&$rows<500) {
					$rows++;
				}				
		}
		else if($new_width!=NULL) {
			@copy($original_img,$filepath);
			ImgMagic :: convert_Width2($filepath,$path,$new_width);
			return 0;
		}
		else if($new_height!=NULL) {
			@copy($original_img,$filepath);
			ImgMagic :: convert_Height2($filepath,$path,$new_height);
			return 0;
		
		}
		else {
			return "";
		}
	}
		
	
	function convert_WidthND($photoname,$path,$new_width) {
		$filepath=$path.$photoname;
		$filedata=@pathinfo($filepath);
		$original_img=$path."tmp1.".$filedata["extension"];
		
		//tmpファイルの削除
		@unlink($path."tmp1.".$filedata["extension"]);
		@unlink($path."tmp2.".$filedata["extension"]);
		@copy($filepath,$original_img);
		@unlink($filepath);
		$result=0;
		
		$orignimge_size=@getimagesize($original_img);
		
		if($orignimge_size[0]<=$new_width) {//横幅が指定より小さい時
			$imgsizelist=@getimagesize($original_img);
			$flame_width=$new_width-$imgsizelist[0];
			$flame_height=0;
			@system("convert -border ".(int)($flame_width/2)."x0 -bordercolor white ".$original_img." ".$filepath,$result);
			return 2;
		}
		else {//横幅が指定よりも大きいとき
			$newimg_ratio=$orignimge_size[0]/$new_width;
			$new_height=$orignimge_size[1]*$newimg_ratio;
			
			if($filedata["extension"]=="bmp"){
				$filedata["extension"]="jpg";
			}
			
			@system("convert -geometry ".$new_width."x".$new_height." ".$original_img." ".$path."tmp2.".$filedata["extension"],$result);
			$result;
		}
		$rows=0;

		while(!file_exists($path."tmp2.".$filedata["extension"])&&$rows<100) {
			$rows++;
		}

		$imgsizelist=@getimagesize($path."tmp2.".$filedata["extension"]);
		$flame_width=$new_width-$imgsizelist[0];
		$flame_height=0;
		@system("convert -border ".(int)($flame_width/2)."x11 -bordercolor white ".$path."tmp2.".$filedata["extension"]." ".$filepath,$result);
		//echo "convert -border ".(int)($flame_width/2)."x".(int)($flame_height/2)." -bordercolor white ".$path."tmp2.".$filedata["extension"]." ".$filepath;
		//@unlink($original_img);
		return 0;
	}
}

?>