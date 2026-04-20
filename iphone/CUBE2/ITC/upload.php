<?php 
/* 
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<?php  
*/

class Upload {
	var $upfile;
	var $fdata;
	var $newname;
	var $path;
	var $rdata;
	var $rpath;
	function Upload() {
		$this->path="../tmp/";
		$this->rpath="/tmp/";
		$this->upfile=$_FILES;
	}
	
	function Upfile($fname) {
		switch($this->fdata["type"]) {
			case "image/gif":
				$this->Up_Image($fname);
				return $this->rdata;
				break;
			case "image/pjpeg":
				$this->Up_Image($fname);
				return $this->rdata;
				break;
			case "image/x-png":
				$this->Up_Image($fname);
				return $this->rdata;
				break;
			case "image/bmp":
				$this->Up_Image($fname);
				return $this->rdata;
				break;
			default:
				$this->Up_Other($fname);
				return $this->rdata;
				break;
		}
	}
	
	function Upfile2($fname,$num) {
		
		switch($this->fdata["type"][$num]) {
			case "image/gif":
				$this->Up_Image2($fname,$num);
				return $this->rdata;
				break;
			case "image/pjpeg":
				$this->Up_Image2($fname,$num);
				return $this->rdata;
				break;
			case "image/x-png":
				$this->Up_Image2($fname,$num);
				return $this->rdata;
				break;
			case "image/bmp":
				$this->Up_Image2($fname,$num);
				return $this->rdata;
				break;
			default:
				$this->Up_Other($fname);
				return $this->rdata;
				break;
		}
	}
	
	function Up_Image($fname) {
		if($this->fdata["error"]==0) {
			$sname=pathinfo($this->fdata["name"]);
			if($this->newname==NULL) {
				$this->newname=date("Ymdhis",time()).".".$sname["extension"];
			}
			
			$result=move_uploaded_file($this->fdata["tmp_name"],$this->path.$this->newname);
			if($result) {
				chmod($this->path.$this->newname,0777);
				
				$rdata["name"]=$this->newname;
				$rdata["path"]=$this->path;
				$rdata["filepath"]=$this->rpath.$this->newname;
				$rdata["type"]=$sname["extension"];
				$rdata["size"]=$this->fdata["size"];
				$rdata["error"]=$this->fdata["error"];
			}
			$this->rdata[]=$rdata;
		}
		else {
			$rdata["error"]=$this->fdata["error"];
			
		}
	}
	function Up_Image2($fname,$num) {
		if($this->fdata["error"][$num]==0) {
			$sname=pathinfo($this->fdata["name"][$num]);
			if($this->newname==NULL) {
				$this->newname=date("Ymdhis",time()).".".$sname["extension"];
			}
			
			$result=move_uploaded_file($this->fdata["tmp_name"][$num],$this->path.$this->newname);
			if($result) {
				chmod($this->path.$this->newname,0777);
				
				$rdata["name"]=$this->newname;
				$rdata["path"]=$this->path;
				$rdata["filepath"]=$this->rpath.$this->newname;
				$rdata["type"]=$sname["extension"];
				$rdata["size"]=$this->fdata["size"][$num];
				$rdata["error"]=$this->fdata["error"][$num];
			}
			$this->rdata[]=$rdata;
		}
		else {
			$rdata["error"]=$this->fdata["error"][$num];
		}
	}
	function Up_Other() {
			$fdata=$this->upfile[$fid];
		if($this->fdata["error"]==0) {
			$sname=pathinfo($this->fdata["name"]);
			if($this->newname==NULL) {
				$this->newname=date("Ymdhis",time()).".".$sname["extension"];
			}
			
			$result=move_uploaded_file($this->fdata["tmp_name"],$this->path.$this->newname);
			if($result) {
				chmod($this->path.$this->newname,0777);
				
				$rdata["name"]=$this->newname;
				$rdata["path"]=$this->path;
				$rdata["filepath"]=$this->rpath.$this->newname;
				$rdata["type"]=$sname["extension"];
				$rdata["size"]=$this->fdata["size"];
				$rdata["error"]=$this->fdata["error"];
			}
		}
		else {
			$rdata["error"]=$this->fdata["error"];
			
		}
		
			$this->rdata[]=$rdata;
	}
	
	function UpImgAndResize($fid,$w,$h) {
		$fdata=$this->upfile[$fid];
		$fpath=$this->path;
		//print_r($fdata);
		if($fdata["error"]==0) {
			$sname=pathinfo($fdata["name"]);
			if($sname["extension"]=="bmp") {
				$sname["extension"]="jpg";
			}
			if($sname["extension"]=="gif") {
				$sname["extension"]="jpg";
			}
			if($sname["extension"]=="png") {
				$sname["extension"]="jpg";
			}
			
			//echo $sname["extension"];
			//print_r($fdata);
			if($this->newname==NULL) {
				$this->newname=$fid.".".$sname["extension"];
			}
			
			@mkdir($fpath);
			$result=move_uploaded_file($fdata["tmp_name"],$fpath."temp1.".$sname["extension"]);
			
			
			if($result) {
			//	echo "upok";
				if(file_exists($fpath."temp1.".$sname["extension"])) {
					@unlink($fpath.$this->newname);
					ImgMagic :: cpandconv_Size($fpath."temp1.".$sname["extension"],$this->newname,$fpath,$w,$h);
					@chmod($fpath.$this->newname,0777);
					@unlink($fpath."temp1.".$sname["extension"]);
				}
				$rdata["name"]=$this->newname;
				$rdata["path"]=$fpath;
				$rdata["filepath"]=$this->rpath.$this->newname;
				$rdata["type"]=$sname["extension"];
				$rdata["size"]=$fdata["size"];
				$rdata["error"]=$fdata["error"];
			}
			else {
				//echo "upng";
			}
		}
		else {
		
			$rdata["error"]=$this->fdata["error"];
			
		}
		return $rdata;
	}
	
	function UpImgAndResize2($fid,$w,$h) {
		$fdata=$this->upfile[$fid];
		$fpath=$this->path;
		if($fdata["error"]==0) {
			$sname=pathinfo($fdata["name"]);
			if($sname["extension"]=="bmp") {
				$sname["extension"]=="jpg";
			}
			//print_r($fdata);
			if($this->newname==NULL) {
				$this->newname=$fid.".".$sname["extension"];
			}
			@mkdir($fpath);
			$result=move_uploaded_file($fdata["tmp_name"],$fpath."temp1.".$sname["extension"]);
			if($result) {
			
				if(file_exists($fpath."temp1.".$sname["extension"])) {
					@unlink($fpath.$this->newname);
					ImgMagic :: cpandconv_Size($fpath."temp1.".$sname["extension"],$this->newname,$fpath,$w,$h);
					@chmod($fpath.$this->newname,0777);
					@unlink($fpath."temp1.".$sname["extension"]);
				}
				$rdata["name"]=$this->newname;
				$rdata["path"]=$fpath;
				$rdata["filepath"]=$this->rpath.$this->newname;
				$rdata["type"]=$sname["extension"];
				$rdata["size"]=$fdata["size"];
				$rdata["error"]=$fdata["error"];
			}
		}
		else {
			$rdata["error"]=$this->fdata["error"][$num];
			
		}
		return $rdata;
	}
	
	function UpImgAndResize3($fid,$w,$h) {
		$fdata=$this->upfile[$fid];
		$fpath=$this->path;
		
		if($fdata["error"]==0) {
			$sname=pathinfo($fdata["name"]);
			if($sname["extension"]=="bmp") {
				$sname["extension"]="jpg";
			}
			if($sname["extension"]=="gif") {
				$sname["extension"]="jpg";
			}
			if($sname["extension"]=="png") {
				$sname["extension"]="jpg";
			}
			
			//echo $sname["extension"];
			//print_r($fdata);
			if($this->newname==NULL) {
				$this->newname=$fid.".".$sname["extension"];
			}
			@mkdir($fpath);
			$result=move_uploaded_file($fdata["tmp_name"],$fpath."temp1.".$sname["extension"]);
			
			if($result) {
			
				if(file_exists($fpath."temp1.".$sname["extension"])) {
					@unlink($fpath.$this->newname);
					ImgMagic :: cpandconv_Size_Noborder($fpath."temp1.".$sname["extension"],$this->newname,$fpath,$w,$h);
					@chmod($fpath.$this->newname,0777);
					@unlink($fpath."temp1.".$sname["extension"]);
				}
				
				$rdata["name"]=$this->newname;
				$rdata["path"]=$fpath;
				$rdata["filepath"]=$this->rpath.$this->newname;
				$rdata["type"]=$sname["extension"];
				$rdata["size"]=$fdata["size"];
				$rdata["error"]=$fdata["error"];
			}
		}
		else {
			$rdata["error"]=$this->fdata["error"];
			
		}
		return $rdata;
	}
	
}

/*
		$ftype1=pathinfo($image1_name);
		$photo1_m=$nowtime."1_m.".$ftype1["extension"];
		$photo1_l=$nowtime."1_l.".$ftype1["extension"];
		$photo1_s=$nowtime."1_s.".$ftype1["extension"];
		@unlink("../tmp/temp_l.".$ftype1);
		@unlink("../tmp/temp_m.".$ftype1);
		@unlink("../tmp/temp_s.".$ftype1);
		move_uploaded_file($image1,"../tmp/temp_l.".$ftype1["extension"]);

*/
?>