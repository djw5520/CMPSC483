<?php
	

class ANSURDataClass
	{
		/*
		 Notes: 
		 
		*/
		private $dbHandle;
		
		public function connect()
		{
			try
			{
				$this->dbHandle = new PDO('sqlite:' . dirname($_SERVER['SCRIPT_FILENAME']) . '/tools.sqlite');
			}
			catch (PDOException $exception)
			{
				die($exception->getMessage());
			}
		}
		
		public function disconnect()
		{
			if ($this->dbconn > 0)
			{
				sqlite_close($this->dbconn);
			}
		}
		
		public function reducedANSUR($m1,$m2,$m3,$m4,$gen) {

			$records = array();
		
			if($m4 == "undefined" || $m4 == null){	
				if($m3 == "undefined" || $m3 == null){
				$sql = "SELECT BMI, STATURE," . $m1 . ", " . $m2 . " FROM reducedANSUR WHERE GENDER= " . $gen . " ORDER BY rowid ASC";
		
				}
				else{
				$sql = "SELECT BMI, STATURE," . $m1 . ", " . $m2 . ", ". $m3 . " FROM reducedANSUR WHERE GENDER= " . $gen . " ORDER BY rowid ASC";	
				}
			}
			else{	
			$sql = "SELECT BMI, STATURE," . $m1 . ", " . $m2 . ", ". $m3 . ", " . $m4 . " FROM reducedANSUR WHERE GENDER= " . $gen . " ORDER BY rowid ASC";
			}
			
			
			$result = $this->dbHandle->query($sql);
			$records = $result->fetchAll(PDO::FETCH_ASSOC);
			return $records;
	
		}
		
		public function allReducedANSUR($gen) {

			$records = array();
		
			$sql = "SELECT * FROM reducedANSUR WHERE GENDER= " . $gen . " ORDER BY rowid ASC";
			
			
			
			$result = $this->dbHandle->query($sql);
			$records = $result->fetchAll(PDO::FETCH_ASSOC);
			return $records;
	
		}
		
	



		
		public function allNames($dimCategory=0) {
		
			$names = array();
			
			if ($dimCategory>0 ){
									$sqlr = "SELECT abrevName, fullName, Units, category, description, image FROM NameTable WHERE category='".$dimCategory."'  ORDER BY fullName ASC";

			}else{
				
									$sqlr = "SELECT abrevName, fullName, Units, category, Availability, description, image FROM NameTable WHERE Availability = 1 ORDER BY category ASC, fullName ASC";

			}
			
			$result = $this->dbHandle->query($sqlr);
			$names = $result->fetchAll(PDO::FETCH_ASSOC);
			return $names;
		
		}

					

	}
	
	class genderSplitDataClass {
		
		public function connect()
		{
			try
			{
				$this->dbHandle = new PDO('sqlite:' . dirname($_SERVER['SCRIPT_FILENAME']) . '/tools.sqlite');
			}
			catch (PDOException $exception)
			{
				die($exception->getMessage());
			}
		}
		
		public function disconnect()
		{
			if ($this->dbconn > 0)
			{
				sqlite_close($this->dbconn);
			}
		}

			
		

		public function getDataForSplitAndPercentile($maleRatio, $percentile) {
		
			$record = array();
	
			$sql = "SELECT stature, mass, BMI FROM genderSplitData WHERE maleRatio = " . $maleRatio . " AND percentile = " . $percentile;
				
				$result = $this->dbHandle->query($sql);
				$record = $result->fetchAll(PDO::FETCH_ASSOC);				
				if ($record !== FALSE) return $record[0]; // Only one record returned
				else return FALSE;
			}
			
		
		public function getDataForGenderSplit($maleRatio) {

			$records = array();
			
			$sql = "SELECT percentile, stature, mass, BMI FROM genderSplitData WHERE maleRatio = " . $maleRatio . " ORDER BY percentile ASC";
		
			$result = $this->dbHandle->query($sql);
			$records = $result->fetchAll(PDO::FETCH_ASSOC);
			return $records;
	
		}
		
	}
	
	
?>