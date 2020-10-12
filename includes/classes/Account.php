<?php
    class Account{
        private $con;
        private $errorArray = array();
        public function __construct($con){
             $this->con = $con;
        }

        public function register($fn, $ln, $un, $em, $em2, $pass, $pass2){
            $this->validateFirstName($fn);
            $this->validateLastName($ln);
            $this->validateUsername($un);
            $this->validateEmail($em, $em2);
            $this->validatePasswords($pass, $pass2);

            if(empty($this->errorArray)){
                return $this->insertUserDetails($fn, $ln, $un, $em, $pass);
            }
            return false;
        }
        public function login($un, $pass){
            $pass = hash("sha512", $pass);
            
            $query = $this->con->prepare("SELECT * FROM users WHERE username=:un AND password=:pass");
            
            
            $query->bindValue(":un", $un);
            
            $query->bindValue(":pass", $pass);

            $query->execute(); 

            if($query->rowCount() == 1){
                return true;
            }

            array_push($this->errorArray, Constants::$loginFailed);
            return false;
        }
        private function insertUserDetails($fn, $ln, $un, $em, $pass){

            $pass = hash("sha512", $pass);
            $query = $this->con->prepare("INSERT INTO users (firstName, lastName, username, email, password)
                                          VALUES (:fn, :ln, :un, :em, :pass)");
            
            $query->bindValue(":fn", $fn);
            $query->bindValue(":ln", $ln);
            $query->bindValue(":un", $un);
            $query->bindValue(":em", $em);
            $query->bindValue(":pass", $pass);

            return $query->execute();

        }
        private function validateFirstName($fn){
            if(strlen($fn) < 2 || strlen($fn) > 25){
                array_push($this->errorArray, Constants::$firstNameCharacters);
            }
        }
        private function validateLastName($ln){
            if(strlen($ln) < 2 || strlen($ln) > 25){
                array_push($this->errorArray, Constants::$lastNameCharacters);
            }
        }
        private function validateUsername($un){
            if(strlen($un) < 2 || strlen($un) > 25){
                array_push($this->errorArray, Constants::$usernameCharacters);
                return;
            }
            $query = $this->con->prepare("SELECT * FROM users WHERE username=:un");
            $query->bindValue(":un", $un);
            
            $query->execute();
            if($query->rowCount() != 0){
                array_push($this->errorArray, Constants::$usernameTaken);
            }
        }
        private function validateEmail($em1, $em2){
            if($em1 != $em2){
                array_push($this->errorArray, Constants::$emailsDontMatch);
                return;
            }

            if(!filter_var($em1, FILTER_VALIDATE_EMAIL)){
                array_push($this->errorArray, Constants::$emailInvalid); 
                return;
            }

            $query = $this->con->prepare("SELECT * FROM users WHERE email=:em");
            $query->bindValue(":em", $em1);
            
            $query->execute();
            if($query->rowCount() != 0){
                array_push($this->errorArray, Constants::$emailTaken);
            } 
        }

        private function validatePasswords($password1, $password2){
            if(strlen($password1) < 5 || strlen($password1) > 25){
                array_push($this->errorArray, Constants::$passwordLength);
                return;
            }
            if($password1 != $password2){
                array_push($this->errorArray, Constants::$passwordNotMatch);
                
            }
           
        }

        public function getError($e){
            if(in_array($e, $this->errorArray)){
                return "<span class='errorMessage'>$e</span>";
            }
        }
    }
?>
