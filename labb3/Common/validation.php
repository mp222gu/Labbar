<?php
namespace Common;

class Validator {
        private $errorList = null;
        private static $instance;
        private static $kMinPasswordLength = 8;
        private static $kMaxPasswordLength = 15;
        
        // Valideringsfel
        const WRONG_EMAIL_FORMAT = 0;
        const WRONG_USERNAME_FORMAT = 1;
        const WRONG_PASSWORD_FORMAT = 2;
        const WRONG_SSN_FORMAT = 3;
        const WRONG_DATE_FORMAT = 4;
        
      /* public static function GetInstance() {
            if (!self::$instance) {
                self::$instance = new Validator();
				
            } 
            return  self::$instance;
        } */
        public function __construct(){
        	$this->errorList = array();
        }
        public function GetValidationErrors() {
            return $this->errorList;
        }
        
        public function ValidateEmail($email) {
                $pattern = "/^([a-z0-9\\+_\\-]+)(\\.[a-z0-9\\+_\\-]+)*@([a-z0-9\\-]+\\.)+[a-z]{2,6}$/ix";
                if (preg_match($pattern, $email)) {
                        return true;
                } else {
                    $this->errorList[] = self::WRONG_EMAIL_FORMAT;
                    return false;
                }
        }
        
        public function ValidateUsername($username) {
            if (preg_match('/[a-zA-Z0-9]{5,}$/', $username)) {
                return true;
            } else {
                 $this->errorList[] = self::WRONG_USERNAME_FORMAT;
                return false;
            }
        }
        
        public function ValidatePassword($password) {
            if (preg_match('/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}/', $password)) {
                return true;
            } else {
                 $this->errorList[] = self::WRONG_PASSWORD_FORMAT;
                return false;
            }
        }
        
        // Borde funka? Dock måste vi ha en funktion (alt. bygga in i denna)
        // för att testa luhns algoritm med.
        
        public function ValidateSSN($ssn) {
            $pattern[]="^[12]{1}[90]{1}[0-9]{6}-[0-9]{4}$";    //XXXXXXXX-XXXX
            $pattern[]="^[12]{1}[90]{1}[0-9]{6}[0-9]{4}$";     //XXXXXXXXXXXX
            $pattern[]="^[10]{1}[90]{1}[0-9]{6}-[0-9]{4}$";    //XXXXXX-XXXX
            $pattern[]="^[10]{1}[90]{1}[0-9]{6}[0-9]{4}$";     //XXXXXXXXXX
            foreach ($pattern as $val) {
                if (!preg_match($val, $ssn)){
                     $this->errorList[] = self::WRONG_SSN_FORMAT;
                    return false;
                }
            }
            
            $testWithLuhn = $this->TestWithLuhn($ssn);    // Testa numret med luhns algoritm
            
            if ($testWithLuhn == false) {
                 $this->errorList[] = self::WRONG_SSN_FORMAT;
                return false;
            }
            
            return true;
        }
        
        public function TestWithLuhn($number) {
            
            $number=preg_replace('/\D/', '', $number);    // ta bort eventuella bindestreck
            $nr_length = strlen($number);       // längden på strängen
            $parity = $nr_length % 2;           // pariteten
            
            $sum = 0;
            
            // Loopa igenom samtliga siffror och räkna ut den korrekta summan
            for ($i = 0; $i < $nr_length; $i++){
                $digit = $number[$i];
                
                // Multiplicera varannat tal med 2
                if ($i % 2 == $parity) {
                    $digit*=2;
                    
                    // Om talet har två siffror lägg ihop dem
                    if ($digit > 9) {
                        $digit-=9;
                    }
                }
                
                $sum+=$digit;
            }
            
            // Om summan är delbar med 10 är allt okej och true returneras
            if ($sum % 10 == 0) {
                return true;
            } else {
                return false;
            }
        }
    
        public function ValidateDate($date) {
             if (preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $date) || preg_match("/^[0-9]{2}-[0-9]{2}-[0-9]{2}$/", $date) || preg_match("/^[0-9]{6}$/", $date)) {
                                $date = str_replace('-', '', $date);
                                if (strlen($date) > 6) {
                                        $date = substr($date, -6);
                                }
                                return $date;
                        }
                        else {
                             $this->errorList[] = self::WRONG_DATE_FORMAT;
                            return false;
                        }
        
        }
        
        public function RemoveScripts($string) {
            return strip_tags($string, '<h2><h3><p><a>'); // tillåter h2,h3 osv
        }
        
        public function RemoveHtmlAndScripts($string) {
            return strip_tags($string); // tar bort alla taggar
        }

public function Test() {
        $errors = array();
        
        // korrekt epost
        if ($this->ValidateEmail('test@test.se') == true) { 
                $errors[] = 'OK. Korrekt epost <br />';
        }
        // fel epost
        if ($this->ValidateEmail('test_test.se') == false) {
                $errors[]= 'OK. Felaktig epost <br />';
        }
        // korrekt username
        if ($this->ValidateUsername('Username222') == true) {
                $errors[] = 'OK. Korrekt användarnamn <br />';
        }
        // fel username, för kort
        if ($this->ValidateUsername('Um22') == false) {
               $errors[] = 'OK. Felaktigt användarnamn <br />';
        }
        
        //korrekt datum
        if($this->ValidateDate('1999-10-01') == true) {
            $errors[] = 'OK. Korrekt datum <br />';
        }
        //korrekt datum
        if($this->ValidateDate('99-10-01') == true) {
            $errors[] = 'OK. Korrekt datum <br />';
        }
         //korrekt datum
        if($this->ValidateDate('991001') == true) {
            $errors[] = 'OK. Korrekt datum <br />';
        }
        
        //felaktigt datum
        if($this->ValidateDate('testing') == false) {
            $errors[] = 'OK.  Felaktigt datum <br />';
        }
        
        // RemoveHtmlAndScripts
        if (strpos($this->RemoveHtmlAndScripts('<h1>Hej</h1>') ,'<h1>') === false) {
                $errors[] = "OK. Tagg hittades ej.";
        }
	return $errors;
	}
}
// Test();
