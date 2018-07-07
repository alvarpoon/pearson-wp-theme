<?php

require_once('/var/www/html/pearson.catus.tech/public_html/simplesamlphp/lib/_autoload.php');

class SimpleSAML_HK_IAM {

    /** 	
     * SimpleSAML_Auth_Simple's object.
     */
    private $authSimpleSAMLObj;

    /**
     * protocol 
     */
    public $protocol;
    private $path_ = null;
    private $domain_ = null;
    private $expiryTime_;

    public function __construct() {

        $this->authSimpleSAMLObj = new SimpleSAML_Auth_Simple('default-sp');

        $this->protocol = 'http';
        if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == "on")) {
            $this->protocol = 'https';
        }
    }

    /**
     * Log in the current user. He will be redirected to Simplesamlphp IdP login page. After a successfull login, he will be redirected to the referer page.
     * @see https://simplesamlphp.org/docs/stable/simplesamlphp-sp-api
     */
    public function login() {
        $this->requireAuth();
        if (!$this->isAuthenticated()) {

            $url = $this->protocol . "://" . $_SERVER['HTTP_HOST'] . "/login_iam.php";
            $params = array(
                'ErrorURL' => $url,
                'ReturnTo' => $url,
            );
            $this->authSimpleSAMLObj->login($params);

            // $authData=$this->getAuthData('saml:sp:IdP');
            // $attributes = $as->getAttributes();
            // if($attributes['mail'][0]!=''){
            // setcookie('usermail', $attributes['mail'][0], time() + (86400 * 30), "/");
            // setcookie('username',$attributes['Username'][0] , time() + (86400 * 30), "/");
            // $return_url = $this->protocol. "://" . $_SERVER['HTTP_HOST'] . "/MyPediaDashboard/Presentation/dashboard_authentication_process.php"
            // header("location: $return_url");
            // }
        }
    }

    /**
     * Logout the current user. Clear Simplesamlphp Sp and Simplesamlphp IdP session and redirected to the referer page.
     * @see https://simplesamlphp.org/docs/stable/simplesamlphp-sp-api
     */
    public function logout() {
        $params = $this->protocol . "://" . $_SERVER['HTTP_HOST'];
        $this->authSimpleSAMLObj->logout($params);
    }

    /**
     * Make sure user is authenticated. If the user is not authenticated, he will be rediected to Simplesamlphp IdP login page. If he is authenticated, it does nothing.
     * @see https://simplesamlphp.org/docs/stable/simplesamlphp-sp-api
     */
    public function requireAuth(array $params = array()) {
        $this->authSimpleSAMLObj->requireAuth($params);
    }

    /**
     * Get login url.
     * @see https://simplesamlphp.org/docs/stable/simplesamlphp-sp-api
     */
    public function getLoginURL($returnTo = null) {
        $this->authSimpleSAMLObj->getLogoutUrl($returnTo);
    }

    /**
     * Get logout url.
     * @see https://simplesamlphp.org/docs/stable/simplesamlphp-sp-api
     */
    public function getLogoutURL($returnTo = null) {
        $this->authSimpleSAMLObj->getLogoutUrl($returnTo);
    }

    /**
     * Check wether the user is authenticated or not.
     * @see https://simplesamlphp.org/docs/stable/simplesamlphp-sp-api
     * @return bool true if user is authenticated, false it he is not.
     */
    public function isAuthenticated() {
        return $this->authSimpleSAMLObj->isAuthenticated();
    }

    /**
     * Get attributes which are returned from Simplesamlphp IdP after a successfull login.
     * @see https://simplesamlphp.org/docs/stable/simplesamlphp-sp-api
     * @return array attributes
     */
    public function getAttributes() {
        return $this->authSimpleSAMLObj->getAttributes();
    }

    /**
     * Get auth data.
     * @see https://simplesamlphp.org/docs/stable/simplesamlphp-sp-api
     * @return mixed
     */
    public function getAuthData(string $name) {
        return $this->authSimpleSAMLObj->getAuthData($name);
    }

    /**
     * Get attribute by it's key.
     * @return string the attribute value
     */
    public function __get($name) {
    	$tmp = $this->getAttributes();
    	return isset($tmp[$name]) ? $tmp[$name][0] : null;
        //return isset($this->getAttributes()[$name]) ? $this->getAttributes()[$name][0] : null;
    }

    public function deleteSessions() {

        foreach ($_COOKIE as $key => $value) {
            
            unset($_COOKIE[$key]);
            setcookie($key, null, -1, '/');
            session_unset();
        }
    }

}

?>
