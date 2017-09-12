          
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
		
		public function getMembers($pMaxRecords,$table)
		{
			$records = array();
			
			$sql = 'SELECT Ethnicity, five,ten, fifteen, twentyFive, Fifty,seventyFive,eightyFive,ninty,nintyFive ' .
					' FROM ' .$table. ' ORDER BY Ethnicity ';
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
	

?>

