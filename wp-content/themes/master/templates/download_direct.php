
<?php
require('../../../../wp-blog-header.php');
require_once("../../../../wp-config.php");
require_once("../../../../wp-includes/wp-db.php");
// Load WP components, no themes
define('WP_USE_THEMES', false);
require('../../../../wp-load.php');

//get_template_part('../templates/head'); ?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/x-icon/" href="<?=get_stylesheet_directory_uri()?>/favicon.ico" />
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action('get_header');?>
<?php wp_footer(); ?>

<script>
	var getUrlParameter = function getUrlParameter(sParam) {
		var sPageURL = decodeURIComponent(window.location.search.substring(1)),
			sURLVariables = sPageURL.split('&'),
			sParameterName,
			i;
	
		for (i = 0; i < sURLVariables.length; i++) {
			sParameterName = sURLVariables[i].split('=');
	
			if (sParameterName[0] === sParam) {
				return sParameterName[1] === undefined ? true : sParameterName[1];
			}
		}
	};


	$('document').ready(function(){
		var ajaxurl = '/wp-admin/admin-ajax.php';
	
		var file = getUrlParameter('file');
		var pageid = getUrlParameter('pageid');
		
		var data = {
			file: file,
			pageid: pageid,
			action: 'download_nosource'
		};
		
		$.post(ajaxurl, data, function(response) {
			//console.log('createzip done');
		}).done(function(response){
			//window.location.href = window.location.protocol + "//" + response;
			
			var blob = new Blob([response]);
			var link = document.createElement('a');
			link.href = window.URL.createObjectURL(blob);
			link.download = filename;
	
			document.body.appendChild(link);
	
			link.click();
	
			document.body.removeChild(link);
			
		}).fail(function(response){
			//console.log('createzip fail');
			console.log('fail: '+response);
		});
	});
</script>
</body>
</html>