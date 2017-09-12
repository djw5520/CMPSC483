          
<?php
		class center_members
	
	{
		/*
		 Notes:
		
		*/
		private $dbHandle;
		
		public function connect($database2)
		{
			try
			{
				$this->dbHandle = new PDO('sqlite:' .  
dirname($_SERVER['SCRIPT_FILENAME']) .$database2);
			}
			catch (PDOException $exception)
			{
				die($exception->getMessage());
			}
		}
		
		public function disconnect()
		{
			/*if ($this->dbconn > 0)
			{
				sqlite_close($this->dbconn);
			}*/
		}
		
		public function getMembers($pMaxRecords,$table,$Column)
		{
			$records = array();
			
			$sql = 'SELECT ' .$Column.' FROM ' .$table;
			if ($pMaxRecords > 0)
			{
				$sql .= ' LIMIT ' . $pMaxRecords;
			}
			$result = $this->dbHandle->query($sql);
			$records = $result->fetchAll(PDO::FETCH_ASSOC);
			return $records;
			//$results = sqlite_array_query($this->dbconn, $sql, SQLITE_ASSOC);		
			//return $results;
		}


	}
	
	class Stat{
	
	function median($data){
		$median = $this->percentile($data,50);
		return $median;
	}
	
	function percentile($data,$percentile){
		if( 0 < $percentile && $percentile < 1 ) {
			$p = $percentile;
		}else if( 1 < $percentile && $percentile <= 100 ) {
			$p = $percentile * .01;
		}else {
			return "";
		}
		$count = count($data);
		$allindex = ($count-1)*$p;
		$intvalindex = intval($allindex);
		$floatval = $allindex - $intvalindex;
		sort($data);
		if(!is_float($floatval)){
			$result = $data[$intvalindex];
		}else {
			if($count > $intvalindex+1)
				$result = $floatval*($data[$intvalindex+1] - $data[$intvalindex]) + $data[$intvalindex];
			else
				$result = $data[$intvalindex];
		}
		return $result;
	}
	
	function quartiles($data) {
		$q1 = $this->percentile($data,25);
		$q2 = $this->percentile($data, 50);
		$q3 = $this->percentile($data, 75);
		$quartile = array ( '25' => $q1, '50' => $q2, '75' => $q3);
		return $quartile;
	}
	
}
	

?>

