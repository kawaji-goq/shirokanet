<?php 
class Calendar {
	var $dbobj;
	var $year;
	var $month;
	var $data;
	var $n_year;
	var $n_month;
	var $e_wday;
	var $r_year;
	var $r_month;
	
	function Calendar() {
		$this->dbobj=$dbobj;
		$this->year=date("Y",time());
		$this->month=date("m",time());
		$this->e_wday=array("日","月","火","水","木","金","土");
		$this->n_year=date("Y",mktime(0,0,0,($this->month+1),1,$year));
		$this->n_month=date("m",mktime(0,0,0,($this->month+1),1,$year));
		$this->r_year=date("Y",mktime(0,0,0,($this->month-1),1,$year));
		$this->r_month=date("m",mktime(0,0,0,($this->month-1),1,$year));
		
	}
	
	function Set() {
		$year=$this->year;
		$month=$this->month;
		$data["year"]=$year;
		$data["month"]=$month;
		$data["f_day"]=1;
		
		$data["l_day"]=date("t",mktime(0,0,0,$month,1,$year));
		$data["f_wday"]=date("w",mktime(0,0,0,$month,1,$year));
		$data["l_wday"]=date("w",mktime(0,0,0,$month,$data["l_day"],$year));
		
		$this->n_year=date("Y",mktime(0,0,0,($this->month+1),1,$year));
		$this->n_month=date("m",mktime(0,0,0,($this->month+1),1,$year));
		$this->r_year=date("Y",mktime(0,0,0,($this->month-1),1,$year));
		$this->r_month=date("m",mktime(0,0,0,($this->month-1),1,$year));
		
		$this->data=$data;
	}
	
	function Create($type) {
		$this->Set();
		switch($type) {
			case 1:
				$data=$this->Type1();
				break;
			case 2:
				$data=$this->Type2();
				break;
			default:
				$data=$this->Type1();
				break;
		}
		return $data;
	}
	
	function Type1() {
		$data=$this->data;
		$_ewday=$this->e_wday;
		$rows=$data["f_day"];
		
		while($rows<=$data["l_day"]) {
			$rdata[$rows]["year"]=$data["year"];
			$rdata[$rows]["month"]=$data["month"];
			$rdata[$rows]["day"]=$rows;
			$rdata[$rows]["wday"]=date("w",mktime(0,0,0,$data["month"],$rows,$data["year"]));
			$rdata[$rows]["ewday"]=$_ewday[date("w",mktime(0,0,0,$data["month"],$rows,$data["year"]))];
			$rdata[$rows]["eday"]=(date("Y-m-d",mktime(0,0,0,$data["month"],$rows,$data["year"])));
			$rows++;
		}
		
		return $rdata;
	}
	
	function Type2() {
	
		$data=$this->data;
		$_ewday=$this->e_wday;
		$rows=0;
		$i=0;
		$j=0;
		$max=$data["l_day"]+(6-$data["l_wday"])+$data["f_wday"]-1;
		while($rows<=$max) {
			$i=(int)($rows/7);
			$j=(int)($rows%7);
			$rdata[$i][$j]["year"]=date("Y",mktime(0,0,0,$data["month"],(($rows+1)-($data["f_wday"])),$data["year"]));
			$rdata[$i][$j]["month"]=date("m",mktime(0,0,0,$data["month"],($rows+1-($data["f_wday"])),$data["year"]));
			$rdata[$i][$j]["day"]=date("j",mktime(0,0,0,$data["month"],($rows+1-($data["f_wday"])),$data["year"]));
			$rdata[$i][$j]["wday"]=date("w",mktime(0,0,0,$data["month"],($rows+1-($data["f_wday"])),$data["year"]));
			$rdata[$i][$j]["ewday"]=$_ewday[date("w",mktime(0,0,0,$data["month"],($rows+1-($data["f_wday"])),$data["year"]))];
			$rdata[$i][$j]["eday"]=(date("Y-m-d",mktime(0,0,0,$data["month"],($rows+1-($data["f_wday"])),$data["year"])));
			$rows++;
		}
		
		return $rdata;
	}
	
	function GetList($schedule_id) {
		
	}
	
	function GetNextMonth() {
		$this->n_year=date("Y",mktime(0,0,0,($this->month+1),1,$year));
		$this->n_month=date("m",mktime(0,0,0,($this->month+1),1,$year));
	}
	
	//create one weeks calendars
	function CreateOneWeek($fday,$period,$ray) {
		$_ewday=$this->e_wday;
		if($fday==NULL||$fday=="") {
			$fday=date("Y-m-d",time());
		}
		$data=explode("-",$fday);
		
		if($ray==0) {
			$rows=0;
			while($rows<$period) {
				$rdata[$rows]["year"]=date("w",mktime(0,0,0,($data[1]),($data[2]+$rows),($data[0])));
				$rdata[$rows]["month"]=date("w",mktime(0,0,0,$data[1],($data[2]+$rows),($data[0])));
				$rdata[$rows]["day"]=date("w",mktime(0,0,0,$data[1],($data[2]+$rows),($data[0])));
				$rdata[$rows]["wday"]=date("w",mktime(0,0,0,$data[1],($data[2]+$rows),($data[0])));
				$rdata[$rows]["ewday"]=$_ewday[date("w",mktime(0,0,0,$data[1],($data[2]+$rows),($data[0])))];
				$rdata[$rows]["eday"]=(date("Y-m-d",mktime(0,0,0,$data[1],($data[2]+$rows),($data[0]))));
				$rows++;
			}
		}
		else {
			$rows=0;
			$i=0;
			$j=0;
			
			while($rows<$period) {
				$i=(int)($rows/$ray);
				$j=(int)($rows%$ray);
				$rdata[$j][$i]["year"]=date("Y",mktime(0,0,0,$data[1],($data[2]+$rows),$data[0]));
				$rdata[$j][$i]["month"]=date("m",mktime(0,0,0,$data[1],($data[2]+$rows),$data[0]));
				$rdata[$j][$i]["day"]=date("j",mktime(0,0,0,$data[1],($data[2]+$rows),$data[0]));
				$rdata[$j][$i]["wday"]=date("w",mktime(0,0,0,$data[1],($data[2]+$rows),$data[0]));
				$rdata[$j][$i]["ewday"]=$_ewday[date("w",mktime(0,0,0,$data[1],($data[2]+$rows),$data[0]))];
				$rdata[$j][$i]["eday"]=(date("Y-m-d",mktime(0,0,0,$data[1],($data[2]+$rows),$data[0])));
				$rows++;
			}
			
		}
		return $rdata;
	}
}
/*
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php 
*/

?>