<?php
require_once 'settings.php';
require_once('/Models/user.php');

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
		public function GetUser($stmt){
			     
                if ($stmt === FALSE) {
                        throw new Exception($this->mysqli->error);
                }
               
                
                if ($stmt->execute() == FALSE) {
                        throw new Exception($this->mysqli->error);
                }
                $ret = 0;
               
                //Bind the $ret parameter so when we call fetch it gets its value
                //http://php.net/manual/en/mysqli-stmt.bind-result.php
                
                if ($stmt->bind_result($id, $username, $password, $imagepath) == FALSE) {
                        throw new Exception($this->mysqli->error);
                }
               
                //http://php.net/manual/en/mysqli-stmt.fetch.php
                $stmt->fetch();
               
                $stmt->close();
               
				$user = new User($id, $username, $password, $imagepath);
               
                return $user;
			
			
		}
		 public function Select($stmt, $res) {
               
                
                if ($stmt === FALSE) {
                        throw new Exception($this->mysqli->error);
                }
               
                
                if ($stmt->execute() == FALSE) {
                        throw new Exception($this->mysqli->error);
                }
                $ret = 0;
               
                //Bind the $ret parameter so when we call fetch it gets its value
                //http://php.net/manual/en/mysqli-stmt.bind-result.php
                
                if ($stmt->bind_result($res ) == FALSE) {
                        throw new Exception($this->mysqli->error);
                }
               
                //http://php.net/manual/en/mysqli-stmt.fetch.php
                $stmt->fetch();
               
                $stmt->close();
               
               
                return $res;
        }
       
        /**
         * Prepares query
         * @param $sql String Sql query
         * @return mysqli_stmt
         */
        public function Prepare($sql) {
                $ret = $this->mysqli->prepare($sql);
               
                if ($ret == FALSE) {
                        throw new Exception($this->mysqli->error);
                }
               
                return $ret;
               
        }
		

}