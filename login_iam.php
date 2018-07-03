<?php

// IAM Integration
//require_once '/data/webdoc/science_wp/simplesamlphp/lib/_autoload.php';  //Please update according the setup path
require_once('/data/webdoc/science_wp/iam_saml_functions.php');

//$auth = new \SimpleSAML\Auth\Simple('default-sp');
$auth = new SimpleSAML_HK_IAM('default-sp');
$redirectUrl = 'https://science.pprod4.ilongman.com/';

//error_log('FROM: ' . $_SERVER['HTTP_REFERER']);

if ($_SERVER['QUERY_STRING']=='logout') {
	$auth->logout('/');
	header('Location: '. $redirectUrl);
	die('Logout successful');
} else {
        $auth->requireAuth();
        $username = $auth->__get('UserName');
error_log('RALPH After Login: '  . $username);
        //if (isset($attrs) && isset($attrs['UserName']) && isset($attrs['UserName'][0])) {
         //       $username = $attrs['UserName'][0];
        //}
//	if ($username)
//	        header('Location: '. $redirectUrl . 'redirect.php?u=' . $username . '&r=' . $redirectUrl);
header('Location: ' . $redirectUrl);
//	else
//		header('Location: '.$redirectUrl);
//	header('Location: '.$redirectUrl);

}
?>
