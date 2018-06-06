<?php
/**
 * Clean up the_excerpt()
 */
function roots_excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'roots') . '</a>';
}
add_filter('excerpt_more', 'roots_excerpt_more');

function wpsax_filter_option( $value, $option_name ) {
    $defaults = array(
        /**
         * Type of SAML connection bridge to use.
         *
         * 'internal' uses OneLogin bundled library; 'simplesamlphp' uses SimpleSAMLphp.
         *
         * Defaults to SimpleSAMLphp for backwards compatibility.
         *
         * @param string
         */
        'connection_type' => 'internal',
        /**
         * Configuration options for OneLogin library use.
         *
         * See comments with "Required:" for values you absolutely need to configure.
         *
         * @param array
         */
        'internal_config'        => array(
            // Validation of SAML responses is required.
            'strict'       => true,
            'debug'        => defined( 'WP_DEBUG' ) && WP_DEBUG ? true : false,
            'baseurl'      => home_url(),
            'sp'           => array(
                'entityId' => 'urn:' . parse_url( home_url(), PHP_URL_HOST ),
                'assertionConsumerService' => array(
                    'url'  => home_url(),
                    'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST',
                ),
            ),
            'idp'          => array(
                // Required: Set based on provider's supplied value.
                'entityId' => 'http://science.pprod4.ilongman.com',
                'singleSignOnService' => array(
                    // Required: Set based on provider's supplied value.
                    'url'  => 'https://iam-stage.pearson.com:443/auth/SSORedirect/metaAlias/pearson/idp',
                    'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
                ),
                'singleLogoutService' => array(
                    // Required: Set based on provider's supplied value.
                    'url'  => 'https://iam-stage.pearson.com:443/auth/IDPSloRedirect/metaAlias/pearson/idp',
                    'binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
                ),
                // Required: Contents of the IDP's public x509 certificate.
                // Use file_get_contents() to load certificate contents into scope.
                'x509cert' => '',
                // Optional: Instead of using the x509 cert, you can specify the fingerprint and algorithm.
                'certFingerprint' => '9bbec676cff86935b1d803596c96f1e697fdbff0',
                'certFingerprintAlgorithm' => '',
            ),
        ),
        /**
         * Path to SimpleSAMLphp autoloader.
         *
         * Follow the standard implementation by installing SimpleSAMLphp
         * alongside the plugin, and provide the path to its autoloader.
         * Alternatively, this plugin will work if it can find the
         * `SimpleSAML_Auth_Simple` class.
         *
         * @param string
         */
        'simplesamlphp_autoload' => dirname( __FILE__ ) . '/simplesamlphp/lib/_autoload.php',
        /**
         * Authentication source to pass to SimpleSAMLphp
         *
         * This must be one of your configured identity providers in
         * SimpleSAMLphp. If the identity provider isn't configured
         * properly, the plugin will not work properly.
         *
         * @param string
         */
        'auth_source'            => 'default-sp',
        /**
         * Whether or not to automatically provision new WordPress users.
         *
         * When WordPress is presented with a SAML user without a
         * corresponding WordPress account, it can either create a new user
         * or display an error that the user needs to contact the site
         * administrator.
         *
         * @param bool
         */
        'auto_provision'         => true,
        /**
         * Whether or not to permit logging in with username and password.
         *
         * If this feature is disabled, all authentication requests will be
         * channeled through SimpleSAMLphp.
         *
         * @param bool
         */
        'permit_wp_login'        => true,
        /**
         * Attribute by which to get a WordPress user for a SAML user.
         *
         * @param string Supported options are 'email' and 'login'.
         */
        'get_user_by'            => 'email',
        /**
         * SAML attribute which includes the user_login value for a user.
         *
         * @param string
         */
        'user_login_attribute'   => 'uid',
        /**
         * SAML attribute which includes the user_email value for a user.
         *
         * @param string
         */
        'user_email_attribute'   => 'mail',
        /**
         * SAML attribute which includes the display_name value for a user.
         *
         * @param string
         */
        'display_name_attribute' => 'display_name',
        /**
         * SAML attribute which includes the first_name value for a user.
         *
         * @param string
         */
        'first_name_attribute' => 'first_name',
        /**
         * SAML attribute which includes the last_name value for a user.
         *
         * @param string
         */
        'last_name_attribute' => 'last_name',
        /**
         * Default WordPress role to grant when provisioning new users.
         *
         * @param string
         */
        'default_role'           => get_option( 'default_role' ),
    );
    $value = isset( $defaults[ $option_name ] ) ? $defaults[ $option_name ] : $value;
    return $value;
}
add_filter( 'wp_saml_auth_option', 'wpsax_filter_option', 10, 2 );


add_action( 'wp_ajax_create-zip', 'create_zip' );
// We allow non-logged in users to access our pagination
add_action( 'wp_ajax_nopriv_create-zip', 'create_zip' ); 

function create_zip(){
	global $wpdb;
	$overwrite = true;
	$filepath = $_POST['filepathdata'];	
	$files = explode(',', $filepath);
	//$destination = ;
	
	$destination = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/master/assets/zip-archives/'.$_POST['filenamedata'].'.zip';
	
	if(file_exists($_SERVER['DOCUMENT_ROOT'] .'/wp-content/themes/master/assets/img/common/surroundTestDTS.dts.wav')){
		echo 'i found it!';
		echo $_SERVER['DOCUMENT_ROOT'] .'/wp-content/themes/master/assets/img/common/surroundTestDTS.dts.wav';
	}
	
	$validFiles = [];
	if(is_array($files)) {
	  foreach($files as $file) {
		 if(file_exists($file)) {
			$validFiles[] = $file;
			echo '<p>has files</p>';
		 }else{
		 	echo 'not found ';
		 }
	  }
	}
	
	//var_dump($files);
	
	if(count($validFiles)) {
	  $zip = new ZipArchive();
	  /*if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
		 return false;
	  }*/
	
	  foreach($validFiles as $file) {
		 $zip->addFile($destination,$file);
	  }
	
	  $zip->close();
	  //return file_exists($destination);
	  
	  if(file_exists($destination)){  
		  /*header("Content-Disposition: attachment; filename=\"".$destination."\"");
		  header("Content-Length: ".filesize($destination));
		  readfile($destination);*/
		  
		  echo 'yeah';
		  //echo $destination;
	  }
	}else{
	  //return false;
	  echo 'fail';
	}
}