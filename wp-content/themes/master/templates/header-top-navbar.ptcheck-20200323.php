<?php
require_once('/data/webdoc/website_pt/iam_saml_functions.php');
/*GET Cookie and check the SSOToken and put to $token*/
$token = isset($_COOKIE["SSOToken"])?$_COOKIE["SSOToken"]:'';
if (!empty($token)) {
	if (empty($username)) {
		/* Use the API below to replace the {token_value} from cookie */
		// 'curl --request POST --header "Content-Type: application/json" --header "Accept-API-Version: resource=2.0" --header "PearsonExtSTGSSOSession: $token" --data '{}' "https://iam-stage.pearson.com/auth/json/realms/root/realms/pearson/sessions/?_action=getSessionInfo&tokenId='.$token;
// 		$cmd = 'curl --request POST --header "Content-Type: application/json" --header "Accept-API-Version: resource=2.0" --header "PearsonExtSTGSSOSession: $token" --data "{}" "https://iam-stage.pearson.com/auth/json/realms/root/realms/pearson/sessions/?_action=getSessionInfo&tokenId='.$token.'"';
// 		exec($cmd,$result);
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, IAM_HOST.'/auth/json/realms/root/realms/pearson/sessions/?_action=getSessionInfo&tokenId='.$token);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "{}");
		curl_setopt($ch, CURLOPT_POST, 1);
		
		$headers = array();
		$headers[] = 'Content-Type: application/json';
		$headers[] = 'Accept-Api-Version: resource=2.0';
		$headers[] = 'Pearsonextstgssosession: '.$token;
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		
		$result = curl_exec($ch);
		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		} else {
			$parseResult = json_decode($result, true);
			/* Get the result username and put to variable $username */
			// {"username":"tp12177447","universalId":"id=tp12177447,ou=user,o=pearson,ou=services,dc=openam,dc=forgerock,dc=org","realm":"/pearson","latestAccessTime":"2019-08-01T06:05:01Z","maxIdleExpirationTime":"2019-08-02T06:05:01Z","maxSessionExpirationTime":"2019-08-02T06:05:00Z","properties":{}}
			$username = isset($parseResult['username'])?$parseResult['username']:'';
		}
		curl_close($ch);
	}
} else {
//******   $IAM = new SimpleSAML_HK_IAM('default-sp');
//******   if (!$IAM->isAuthenticated()) error_log('RALPH RALPH RALPH No LOGIN');
//******   $username = $IAM->__get('UserName');
}

$lang_arr = icl_get_languages('skip_missing=1&orderby=id&order=desc');

?>
<div class="download_overlay"></div>
<header class="banner navbar navbar-default mainmenu" role="banner">
	<div class="topbar-wrapper">
	  <div class="container-fluid">
		<div class="row">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar top-bar"></span>
				<span class="icon-bar middle-bar"></span>
				<span class="icon-bar bottom-bar"></span>
			  </button>
			  <a href="javascript:;" class="menu-label hidden-xs hidden-sm hidden-md hidden-lg" data-toggle="collapse" data-target=".navbar-collapse">menu</a>
			  <a class="navbar-brand" href="<?php echo home_url(); ?>/"><img src="<?=get_stylesheet_directory_uri()?>/assets/img/pearson-logo.svg" class="img-responsive"></a>
			</div>
			<div class="navbar-header-right hidden-xs hidden-sm visible-md visible-lg">
				<?php
				if (has_nav_menu('corners-menu')) :
				
					echo '<div class="clearfix corners-menu">';
					
					wp_nav_menu(array('theme_location' => 'corners-menu', 'menu_class' => '', 'depth' => 4)); 
					
					echo '</div>';		  
					
				endif;
					
				if ( function_exists('icl_object_id') ) {
					
					$lang_class = '';
					
					if(sizeof($lang_arr) > 1){
					
						echo '<div class="lang-wrapper">';
						
						foreach( $lang_arr as $lang ){
						  echo '<a class="'.$lang_class.'" href="'.$lang['url'].'" data-original-href="'.strtok($lang['url'], '?').'">'.$lang['native_name'].'</a>';
						}
						
						echo '</div>';
					}
					
				}
				initAccessRightChecking($username); 
				if (!empty($username)) {
				
					echo('<div class="login-wrapper"><a href="/login_iam.php?logout">' . $username . ' ('.__('Logout', 'Pearson-master').')</a></div>');
				
				}else{
					echo('<div class="login-wrapper"><a href="'.APP_URL.'/nd_index.php?back=https://'.$_SERVER['HTTP_HOST'].'&type=web">'.__('Sign in', 'Pearson-master').'</a></div>');
//echo('<div class="login-wrapper"><a href="/login_iam.php?logout">' . $username . ' ('.__('Logout', 'Pearson-master').')</a></div>');
					foreach ($_COOKIE as $key => $value) {
							unset($_COOKIE[$key]);
							setcookie($key, null, -1, '/');
							session_unset();
					}		
					session_unset();
					error_log('CLEAR SESSION');
				}
				?>
			</div>
		</div>
	  </div>
	</div>
  <div class="nav-container">
	<div class="container-fluid">
		<div class="row">
			<nav class="collapse navbar-collapse" role="navigation">
				<div class="mobile-menu-wrapper">
				<?php
					//Main menu
					if (has_nav_menu('primary_navigation')) :
					 
					  wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav main_menu', 'depth' => 4)); //updated by Ron on 20180916
					  
					endif;
				?>
					<div class="hidden-md hidden-lg hidden-xl">
						<?php
						
						if (has_nav_menu('corners-menu')) :
							 
						  wp_nav_menu(array('theme_location' => 'corners-menu', 'menu_class' => 'nav navbar-nav', 'depth' => 4));
						  
						endif;
						
						
						if ( function_exists('icl_object_id') ) {
							if(sizeof($lang_arr) > 1){
								echo '<ul class="nav navbar-nav">';
								foreach( $lang_arr as $lang ){
								  echo '<li><a class="'.$lang_class.'" href="'.$lang['url'].'" data-original-href="'.strtok($lang['url'], '?').'">'.$lang['native_name'].'</a></li>';
								}
								echo '</ul>';
							}
						}
						
						?>
						
						<ul class="nav navbar-nav">
						<?php
						
						initAccessRightChecking($username); 
						if ($username) {
							echo('<li><a href="/login_iam.php?logout">' . $username . ' ('.__('Logout', 'Pearson-master').')</a></li>');
						}
						else{
							echo('<li><a href="'.APP_URL.'/nd_index.php?back=https://'.$_SERVER['HTTP_HOST'].'&type=web">'.__('Sign in', 'Pearson-master').'</a></li>');
//							echo('<li><a href="/login_iam.php">'.__('Sign in', 'Pearson-master').'</a></li>');
							foreach ($_COOKIE as $key => $value) {
								unset($_COOKIE[$key]);
								setcookie($key, null, -1, '/');
								session_unset();
							}		
							session_unset();
							error_log('CLEAR SESSION');
						}
						
						?>
						</ul>
					</div>
				</div>
			</nav>
		</div>
	</div>
  </div>
</header>
<div class="menu_bg hidden-md hidden-lg hidden-xl"></div>
