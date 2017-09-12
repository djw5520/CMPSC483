
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
dirname($_SERVER['SCRIPT_FILENAME']) .'/sqlLiteDatabases/Male.sqlite');
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
		
		public function getMembers($pMaxRecords=0)
		{
			$records = array();
			
			$sql = 'SELECT Dimension,MaleQa, MaleRa, FemaleQa, FemaleRa ' .
					'FROM DimensionTable  ';
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

