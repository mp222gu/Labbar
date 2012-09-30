<?php
require_once 'settings.php';


class DatabaseHandler{
	private $mysqli = null;
        public function ConnectToDb(){
		
		$settings = Settings::GetDataBaseSettings();
	    $this->mysqli = new mysqli($settings['host'], $settings["username"],$settings['password'],$settings['tablename']);
		
	    if ($this->mysqli->connect_error) {
                    throw new Exception($this->mysqli->connect_error);
                }
               
                $this->mysqli->set_charset("utf8");
               
                return true;

		
	 
	}
		public function RunDeleteQuery($stmt){
			if ($stmt->execute() == FALSE) {
                        throw new Exception($this->mysqli->error);
                }
                
                $ret = $stmt->insert_id;
               
                $stmt->close();
               
                return $ret;
			
		}
		public function RunInsertQuery(mysqli_stmt $stmt) {
                       
                       
                if ($stmt->execute() == FALSE) {
                        throw new Exception($this->mysqli->error);
                }
                
                $ret = $stmt->insert_id;
               
                $stmt->close();
               
                return $ret;
        }
		
		 public function Close() {
                return $this->mysqli->close();
        }
		 function resultToArray($result) {
			$rows = array();
			while($row = $result->fetch_assoc()) {
			$rows[] = $row;
			}
			return $rows;
		}
		public function SelectMany($stmt){
			
			
               
            if ($stmt === FALSE) {
                        throw new Exception($this->mysqli->error);
            	}
			if ($stmt->execute() == FALSE) {
                        throw new Exception($this->mysqli->error);
                }
			$result = $stmt->get_result();
			$res = array();
		    
	        $res = $this->resultToArray($result);
			$stmt->close();
			
            return $res;
		}
		public function SelectOne($sqlQuery) {
               
                //http://php.net/manual/en/mysqli.prepare.php
                //http://php.net/manual/en/class.mysqli-stmt.php
                $stmt = $this->Prepare($sqlQuery);
               
                if ($stmt === FALSE) {
                        throw new Exception($this->mysqli->error);
                }
               
                //execute the statement
                //http://php.net/manual/en/mysqli-stmt.execute.php
                if ($stmt->execute() == FALSE) {
                        throw new Exception($this->mysqli->error);
                }
                $ret = 0;
               
                //Bind the $ret parameter so when we call fetch it gets its value
                //http://php.net/manual/en/mysqli-stmt.bind-result.php
                if ($stmt->bind_result($ret) == FALSE) {
                        throw new Exception($this->mysqli->error);
                }
               
                //http://php.net/manual/en/mysqli-stmt.fetch.php
                $stmt->fetch();
               
                $stmt->close();
               
               
                return $ret;
        }

		
        public function Prepare($sql) {
        	    $this->ConnectToDb();
                $ret = $this->mysqli->prepare($sql);
               
                if ($ret == FALSE) {
                        throw new Exception($this->mysqli->error);
                }
               
                return $ret;
               
        }
		

}