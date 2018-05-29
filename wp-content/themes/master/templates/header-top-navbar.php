<header class="banner navbar navbar-default mainmenu" role="banner">
	<div class="topbar-wrapper">
	  <div class="container">
		<div class="clearfix">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a href="javascript:;" class="menu-label hidden-xs hidden-sm hidden-md hidden-lg" data-toggle="collapse" data-target=".navbar-collapse">menu</a>
			  <a class="navbar-brand" href="<?php echo home_url(); ?>/"><img src="<?=get_stylesheet_directory_uri()?>/assets/img/common/pearson-logo@2x.png" class="img-responsive"></a>
			</div>
			<div class="navbar-header-right hidden-xs hidden-sm visible-md visible-lg">
				<div class="lang-wrapper">
					<a href="#">中文</a>
					<a href="#">English</a>			
				</div>
				<div class="login-wrapper">
					<a href="#">Sign in</a>
				</div>
			</div>
		</div>
	  </div>
	</div>
  <div class="nav-container">
	<div class="container">
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
