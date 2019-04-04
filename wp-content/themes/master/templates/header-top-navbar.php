<?php
/*require_once('/var/www/html/pearson.catus.tech/public_html/wp-content/themes/master/iam_saml_functions.php');
$IAM = new SimpleSAML_HK_IAM('default-sp');
if (!$IAM->isAuthenticated()) error_log('RALPH RALPH RALPH No LOGIN');
$username = $IAM->__get('UserName');
//initAccessRightChecking($username);
$lang_arr = icl_get_languages('skip_missing=1&orderby=id&order=desc');
*/
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
					
					wp_nav_menu(array('theme_location' => 'corners-menu', 'menu_class' => '', 'depth' => 3)); 
					
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
				
				if (!empty($username)) {
				
					echo('<div class="login-wrapper"><a href="/login_iam.php?logout">' . $username . ' ('.__('Logout', 'Pearson-master').')</a></div>');
				
				}else{
					
					echo('<div class="login-wrapper"><a href="/login_iam.php">'.__('Sign in', 'Pearson-master').'</a></div>');
					
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
					 
					  wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav main_menu', 'depth' => 3)); //updated by Ron on 20180916
					  
					endif;
				?>
					<div class="hidden-md hidden-lg hidden-xl">
						<?php
						
						if (has_nav_menu('corners-menu')) :
							 
						  wp_nav_menu(array('theme_location' => 'corners-menu', 'menu_class' => 'nav navbar-nav', 'depth' => 3));
						  
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
						
						if ($username) {
							echo('<li><a href="/login_iam.php?logout">' . $username . ' ('.__('Logout', 'Pearson-master').')</a></li>');
						}
						else{
							echo('<li><a href="/login_iam.php">'.__('Sign in', 'Pearson-master').'</a></li>');
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
