<?php
/*require_once('/var/www/html/pearson.catus.tech/public_html/wp-content/themes/master/iam_saml_functions.php');
$IAM = new SimpleSAML_HK_IAM('default-sp');
if (!$IAM->isAuthenticated()) error_log('RALPH RALPH RALPH No LOGIN');
$username = $IAM->__get('UserName');*/

//error_log('Ralph Get Username mmmmmmmmmmmmmmm: ' . $username);
?>


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
			  <a class="navbar-brand" href="<?php echo home_url(); ?>/"><img src="<?=get_stylesheet_directory_uri()?>/assets/img/common/pearson-logo@2x.png" class="img-responsive"></a>
			</div>
			<div class="navbar-header-right hidden-xs hidden-sm visible-md visible-lg">
				<div class="lang-wrapper">
					<?php
						
						$lang_arr = icl_get_languages('skip_missing=0&orderby=id&order=desc');
						//print_r($lang_arr);
						//$lang_len = sizeof($lang_arr);
						//$i = 0;
						foreach( $lang_arr as $lang ){
						  echo '<a class="'.$lang_class.'" href="'.$lang['url'].'" data-original-href="'.strtok($lang['url'], '?').'">'.$lang['native_name'].'</a>';
						}
					
					?>
				
					<!--<a href="#">中文</a>
					<a href="#">English</a>-->			
				</div>
				<?php

					error_log('Ralph Get Username: ' . $username);

					if ($username) {
						echo('<div class="login-wrapper"><a href="/login_iam.php?logout">' . $username . ' ('.__('Logout', 'Pearson-master').')</a></div>');
					}
					else
						echo('<div class="login-wrapper"><a href="/login_iam.php">'.__('Sign in', 'Pearson-master').'</a></div>');

				?>
			</div>
		</div>
	  </div>
	</div>
  <div class="nav-container">
	<div class="container-fluid">
		<div class="row">
			<nav class="collapse navbar-collapse" role="navigation">
				<?php
					//Main menu
					if (has_nav_menu('primary_navigation')) :
					 
					  wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav', 'depth' => 3));
					  
					endif;
				?>
			</nav>
		</div>
	</div>
  </div>
</header>
<div class="menu_bg hidden-md hidden-lg hidden-xl"></div>
