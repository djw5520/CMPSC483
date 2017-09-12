          
<?php
		class center_members1
	
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
			$result=null;
			//$results = sqlite_array_query($this->dbconn, $sql, SQLITE_ASSOC);		
			//return $results;
		}


	}
	

?>

