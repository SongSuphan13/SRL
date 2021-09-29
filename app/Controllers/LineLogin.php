<?php 
    namespace App\Controllers;

    use CodeIgniter\Controller;

    class LineLogin extends Controller{
        // CHANGEME: Default Line Developer ClientID and ClientSecret
        private const CLIENT_ID = '1656449603';
        private const CLIENT_SECRET = 'ce53c663443c4fc1067b129252040f55'; 
    
        // CHANGEME: Default Callback redirect link
        private const REDIRECT_URL = 'http://localhost/srl/line_login_c/';
    
        // CHANGEME: Default value for CURLOPT_SSL_VERIFYHOST
        private const VERIFYHOST = false;
    
        // CHANGEME: Default value for CURLOPT_SSL_VERIFYPEER
        private const VERIFYPEER = false;
    
        // API DEFAULTS
        private const AUTH_URL = 'https://access.line.me/oauth2/v2.1/authorize';
        private const PROFILE_URL = 'https://api.line.me/v2/profile';
        private const REVOKE_URL = 'https://api.line.me/oauth2/v2.1/revoke';
        private const TOKEN_URL = 'https://api.line.me/oauth2/v2.1/token';
        private const VERIFYTOKEN_URL = 'https://api.line.me/oauth2/v2.1/verify';

        function getLink($scope) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
    
            $_SESSION['state'] = hash('sha256', microtime(TRUE).rand().$_SERVER['REMOTE_ADDR']);
    
           $link = self::AUTH_URL.'?response_type=code&client_id='.self::CLIENT_ID.'&redirect_uri='.self::REDIRECT_URL.'&scope=profile%20openid%20email&state='.$_SESSION['state'];
         
           return $link;
        }
    
        /*
         *   function refresh
         *   
         *   Args:
         *      $token - User access token.
         * 
         *   Returns:
         *      $response (array) - Returns response array in json format.
         */
        function refresh($token) {
            $header = ['Content-Type: application/x-www-form-urlencoded'];
            $data = [
                "grant_type" => "refresh_token",
                "refresh_token" => $token,
                "client_id" => self::CLIENT_ID,
                "client_secret" => self::CLIENT_SECRET
            ];
    
            $response = $this->sendCURL(self::TOKEN_URL, $header, 'POST', $data);
            return $response;
        }
    
        /*
         *   function token
         *   
         *   Args:
         *      $code  (GET) - User authorization code.
         *      $state (GET) - Randomized hash
         * 
         *   Returns:
         *      $response (array) - Returns response array in json format.
         */
        function token($code, $state) {
            session_start();
            if ($_SESSION['state'] != $state) {
                return false;
            }
    
            $header = ['Content-Type: application/x-www-form-urlencoded'];
            $data = [
                "grant_type" => "authorization_code",
                "code" => $code,
                "redirect_uri" => self::REDIRECT_URL,
                "client_id" => self::CLIENT_ID,
                "client_secret" => self::CLIENT_SECRET
            ];
    
            $response = $this->sendCURL(self::TOKEN_URL, $header, 'POST', $data);
            return $response;
        }
    
        /*
         *   function profile
         *   
         *   Args:
         *      $token - User access token.
         * 
         *   Returns:
         *      $response (array) - Returns response array in json format.
         */
        function profile($token) {
            $header = ['Authorization: Bearer ' . $token];
            $response = $this->sendCURL(self::PROFILE_URL, $header, 'GET');
            return $response;
        }
    
        /*
         *   function verify
         *   
         *   Args:
         *      $token - User access token.
         * 
         *   Returns:
         *      $response (array) - Returns response array in json format.
         */
        function verify($token) {
          echo   $url = self::VERIFYTOKEN_URL.'?access_token='.$token;
          exit;
            $response = $this->sendCURL($url, NULL, 'GET');
            return $response;
        }
    
        private function scope($scope) {
            $list = ['open_id', 'profile', 'email'];
    
            $scope = decbin($scope);
    
            while (strlen($scope) < 3) {
                $scope = '0'.$scope;
            }
    
            $scope = strrev($scope);
    
            foreach ($list as $key => $value) {
                if ($scope[$key] == 1) {
                    if (isset($ret)) {
                        $ret = $ret . '%20' . $value;
                    } else {
                        $ret = $value;
                    }
                }
            }
    
            return $ret;
        }
    
        /*
         *   private function sendCURL
         *   
         *   Args:
         *      $url      (const) - Request URL.
         *      $header   (array) - Headers used for this request.
         *      $type     (char)  - Request type {POST|GET}.
         *      $data     (array) - Request data (Can be NULL if sending a GET request).
         * 
         *   Returns:
         *      $response (array) - Returns response array in json format.
         */
        private function sendCURL($url, $header, $type, $data=NULL) {
            $request = curl_init();
    
            if ($header != NULL) {
                curl_setopt($request, CURLOPT_HTTPHEADER, $header);
            }
    
            curl_setopt($request, CURLOPT_URL, $url);
            curl_setopt($request, CURLOPT_SSL_VERIFYHOST, self::VERIFYHOST);
            curl_setopt($request, CURLOPT_SSL_VERIFYPEER, self::VERIFYPEER);
    
            if (strtoupper($type) === 'POST') {
                curl_setopt($request, CURLOPT_POST, TRUE);
                curl_setopt($request, CURLOPT_POSTFIELDS, http_build_query($data));
            }
    
            curl_setopt($request, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
    
            $response = curl_exec($request);
            return $response;
        }
    }
?>