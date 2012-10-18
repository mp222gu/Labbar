<?php
namespace Model;

require_once '/Common/settings.php';

class DatabaseHandler{
	private $mysqli = null;
	
		/**
		 * @retrun boolean
		 */
        public function ConnectToDb(){
		
		
	    $this->mysqli = new \mysqli(\Common\DatabaseSettings::host, 
	    						\Common\DatabaseSettings::username,
	    						\Common\DatabaseSettings::password,
	    						\Common\DatabaseSettings::tablename);
		
	    if ($this->mysqli->connect_error) {
	    	
                    throw new Exception($this->mysqli->connect_error);
			
					return false;
		}
					
		else{
               
                $this->mysqli->set_charset(\Common\DatabaseSettings::charset);
               
                return true;
		}
	}
		/**
		 * @return int
		 */
		public function RunDeleteQuery(\mysqli_stmt $stmt){
			
			if ($stmt->execute() == FALSE) {
				
                        throw new Exception($this->mysqli->error);
                }
                
                $ret = $stmt->insert_id;
                $stmt->close();
               
                return $ret;
		}
		/**
		 * @return int
		 */
		public function RunInsertQuery(\mysqli_stmt $stmt) {
                       
                       
                if ($stmt->execute() == FALSE) {
                        throw new Exception($this->mysqli->error);
                }
                
                $ret = $stmt->insert_id;
                $stmt->close();
               
                return $ret;
        }
		/**
		 * @return boolean
		 */
		 public function Close() {
		 	
                return $this->mysqli->close();
		 }
        /**
		 * @return array
		 */
		 function resultToArray(\mysqli_result $result) {
		 	
			$rows = array();
			while($row = $result->fetch_assoc()) {
				
				$rows[] = $row;
				
			}
			return $rows;
		}
	 	/**
		 * @return array
		 */
		public function SelectMany(\mysqli_stmt $stmt){
			
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
		/**
		 *  @return var
		 */
		public function SelectOne($sqlQuery) {
               
                $stmt = $this->Prepare($sqlQuery);
               
                if ($stmt === FALSE) {
                	
                        throw new Exception($this->mysqli->error);
                }
               
                if ($stmt->execute() == FALSE) {
                	
                        throw new Exception($this->mysqli->error);
                }
                $ret = 0;
               
                if ($stmt->bind_result($ret) == FALSE) {
                        throw new Exception($this->mysqli->error);
                }
               
                $stmt->fetch();
                $stmt->close();
               
                return $ret;
        }

		/**
		 * @return mysqli statement
		 */
        public function Prepare($sql) {
        	
        	    $this->ConnectToDb();
                $ret = $this->mysqli->prepare($sql);
               
                if ($ret == FALSE) {
                	
                        throw new Exception($this->mysqli->error);
                }
               
                return $ret;
        }
}