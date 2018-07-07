<?php 
/*require_once('/var/www/html/pearson.catus.tech/public_html/wp-content/themes/master/iam_saml_functions.php');
//echo get_stylesheet_directory().'/iam_saml_functions.php';
//require_once(get_stylesheet_directory().'/iam_saml_functions.php');
$IAM = new SimpleSAML_HK_IAM('default-sp');
if (!$IAM->isAuthenticated()) error_log('RALPH RALPH RALPH No LOGIN');
$username = $IAM->__get('UserName');

error_log('Ralph Get Username xxxxxxxxxxx: ' . $username);*/

//echo ($username);

get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>

  <!--[if lt IE 8]>
    <div class="alert alert-warning">
      <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?>
    </div>
  <![endif]-->

  <?php
    do_action('get_header');
    get_template_part('templates/header-top-navbar');
  ?>

      <main class="main" role="main">
	        <?php include roots_template_path(); ?>
      </main>

  <?php get_template_part('templates/footer'); ?>

</body>
</html>