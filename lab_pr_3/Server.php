<?php
    
    class Server
    {
        private $_username;
        private $_password;
        private $salt;
        private $error;
        
        public function __construct()
        {
            $this->_username = 'user';
            $this->_password = 'pass';
            $this->salt = 'qaz][p;loik32rfe';
            $this->error = 0;
        }
        
        public function getMethod()
        {
            return $_SERVER['REQUEST_METHOD'];
        }
        
        public function validateGET()
        {
            $username = trim($_GET['username']);
            $password = trim($_GET['password']);
            
            if ($this->_username == $username && $this->_password == $password) {
                return true;
            } else {
                return false;
            }
        }
        
        public function validatePOST()
        {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            
            if ($this->_username == $username && $this->_password == $password) {
                return true;
            } else {
                return false;
            }
        }
        
        public function handleOptionsForm()
        {
            $authenticated = $this->checkCookie();
    
            if ($authenticated) {
                $method = isset($_POST['method']) ? $_POST['method'] : null;
                $headUrl = isset($_POST['head-input']) ? trim($_POST['head-input']) : null;
                $optionsUrl = isset($_POST['options-input']) ? trim($_POST['options-input']) : null;
        
                $ch = curl_init();
                if ($method == 'head') {
                    curl_setopt($ch, CURLOPT_URL, $headUrl);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'HEAD');
                    curl_setopt($ch, CURLOPT_HEADER, true);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    echo (curl_exec($ch));
                } elseif ($method == 'options') {
                    curl_setopt($ch, CURLOPT_URL, $optionsUrl);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'OPTIONS');
                    curl_setopt($ch, CURLOPT_HEADER, true);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    echo (curl_exec($ch));
                } elseif ($method == 'regex') {
                    $this->processRegex();
                }
                curl_close($ch);
                exit();
            } else {
                header('Location: http://localhost/lab_pr_3/');
            }
        }
        
        public function setError($error)
        {
            $this->error = $error;
        }
        
        public function getError()
        {
            return $this->error;
        }
        
        public function setCookie()
        {
            $encryption = $this->buildEncryption();
            $expirationTime = time() + 6000;
            $path = '/lab_pr_3/';
            
            return setcookie('TestCookie', $encryption, $expirationTime, $path);
        }
        
        public function getCookie()
        {
            $cookie = isset($_COOKIE['TestCookie']) ? $_COOKIE['TestCookie'] : null;
            
            return $cookie;
        }
        
        public function checkCookie()
        {
            $cookie = $this->getCookie();
            if ($cookie) {
                $encryption = $this->buildEncryption();
                if ($cookie == $encryption) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        
        private function buildEncryption()
        {
            $string = $this->_username.$this->_password.$this->salt;
            $hash = sha1($string);
            
            return $hash;
        }
        
        private function processRegex()
        {
            $regexAlnum = isset($_POST['regexAlnum']) ? $_POST['regexAlnum'] : null;
            $regexAlnumSpecialChars = isset($_POST['regexAlnumSpecialChars']) ? $_POST['regexAlnumSpecialChars'] : null;
            $regexEmail = isset($_POST['regexEmail']) ? $_POST['regexEmail'] : null;
            $regexFirstUpper = isset($_POST['regexFirstUpper']) ? $_POST['regexFirstUpper'] : null;
            $regexLength = isset($_POST['regexLength']) ? $_POST['regexLength'] : null;
            
            $statusArray = array('regex-alnum' => 0, 'regex-alnum-special-chars' => 0, 'regex-email' => 0, 'regex-first-upper' => 0, 'regex-length' => 0);
        
            if ($regexAlnum != null) {
                $status = preg_match('/^([a-z0-9]+)$/i', $regexAlnum);
                $statusArray['regex-alnum'] = $status;
            }
            if ($regexAlnumSpecialChars != null) {
                $status = preg_match('/^([a-z0-9!?#% ]+)$/i', $regexAlnumSpecialChars);
                $statusArray['regex-alnum-special-chars'] = $status;
            }
            if ($regexEmail != null) {
                $status = preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i', $regexEmail);
                $statusArray['regex-email'] = $status;
            }
            if ($regexFirstUpper != null) {
                $status = preg_match('/^([A-Z][a-zA-Z0-9]*[ ]?)+$/', $regexFirstUpper);
                $statusArray['regex-first-upper'] = $status;
            }
            if ($regexLength != null) {
                $status = preg_match('/^([^a-zA-Z0-9]{1,20})$/', $regexLength);
                $statusArray['regex-length'] = $status;
            }
            
            echo json_encode($statusArray);
        }
    }
   