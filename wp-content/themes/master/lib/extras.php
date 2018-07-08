<?php
/**
 * Clean up the_excerpt()
 */
function roots_excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'roots') . '</a>';
}
add_filter('excerpt_more', 'roots_excerpt_more');

//* Redirect Resource Archive Page to Homepage
add_action( 'template_redirect', 'wpse_128636_redirect_post' );

function wpse_128636_redirect_post() {
  $queried_post_type = get_query_var('post_type');
  if ( is_single() && 'resource' ==  $queried_post_type || is_single() && 'resourcelist' ==  $queried_post_type ) {
    wp_redirect( home_url(), 301 );
    exit;
  }
}

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

function is_url_exist($url){
    $ch = curl_init($url);    
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if($code == 200){
       $status = true;
    }else{
      $status = false;
    }
    curl_close($ch);
   return $status;
}


add_action( 'wp_ajax_create-zip', 'create_zip' );
// We allow non-logged in users to access our pagination
add_action( 'wp_ajax_nopriv_create-zip', 'create_zip' ); 

function create_zip(){
	global $wpdb;
	$overwrite = true;
	$filepath = $_POST['filepaths'];	
	$files = explode(',', $filepath);
	
	if(extension_loaded('zip')):
		$zip = new ZipArchive();            // Load zip library 
        $zip_name = $_POST['zipname'].".zip";
		
		$destination_path = parse_url('http://local.pearson-master.com/wp-content/uploads/zip/', PHP_URL_PATH);
	
		$zip_name = $_SERVER['DOCUMENT_ROOT'].$destination_path.$zip_name;
		
		$result = $zip->open($zip_name, ZIPARCHIVE::OVERWRITE);
		
		if($result === TRUE){
			if(is_array($files)) {
			  foreach($files as $file) {
				$file_path = parse_url($file, PHP_URL_PATH);
				$file_root_path = $_SERVER['DOCUMENT_ROOT'].$file_path;
				$onlyfilename = substr(strrchr($file_root_path, "/"), 1);
			  
				 if(file_exists($file_root_path)) {
					//$validFiles[] = $file_root_path;
					$zip->addFile( $file_root_path, $onlyfilename );
				 }
			  }
			}
			
			if ($zip->close() === false) {
				exit("Error creating ZIP file");
			};
			
			$zipfile = $zip_name;
			if (file_exists($zipfile)) {
				/*header('Content-Description: File Transfer');
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename='.basename($zipfile));
				header('Expires: 0');
				header('Cache-Control: must-revalidate');
				header('Pragma: public');
				header('Content-Length: ' . filesize($zipfile));
				ob_clean();
				flush();
				readfile($zipfile);*/
				$zipfile_path_arr = explode("/",$zipfile);
				$output = array_slice($zipfile_path_arr, -4, 4);
				$output = $_SERVER['SERVER_NAME'].'/'.implode('/',$output);
				//echo $zipfile;
				echo $output;
				exit;
			}
		}else{
			$error .=  "* Sorry ZIP creation failed at this time<br/>";
		}
	endif;
	
	exit();
}

function get_main_download_file_type($resource_id){
	
	if( have_rows('downloads', $resource_id) ){
	
		while( have_rows('downloads', $resource_id) ): the_row();

			$downloadable_file = get_sub_field('downloadable_file');
			
			$set_as_main_download_file = get_sub_field('set_as_main_download_file');
			
			if($set_as_main_download_file){

				$filename = array_pop(explode('/', $downloadable_file['url']));

				$filetype = wp_check_filetype($filename);
			}
			
		endwhile;
		
	}
	
	return $filetype['ext'];
}

function filetype_thumbnail($filetype){
	

	switch($filetype){
		case 'doc':
		case 'gif':
		case 'html':
		case 'jpg':
		case 'mov':
		case 'mp4':
		case 'mpg':
		case 'pdf':
		case 'png':
		case 'ppt':
		case 'wav':
		case 'xls':
		case 'zip':
			$imgfile = $filetype.'.svg';
			break;
		default:
			$imgfile = 'single-file.svg';
			break;
			
	}
	
	return $imgfile;
}

function showGridThumbnail($resource_id, $resource_thumbnail, $resource_type, $popup_image, $popup_url,$resource_slug){
	$path = get_stylesheet_directory_uri()."/assets/img/common/grid-view/";
	$filetype = get_main_download_file_type($resource_id);

	if(!empty($resource_thumbnail)){
		switch ($resource_type) {
			case "single-file":
			case "multiple-file":
			case "audio-file":
				echo '<div class="thumb" style="background-image:url('.$resource_thumbnail.')"><img src="'.$path.'grid-view-spacer.png" class="img-responsive" /></div>';
				break;
			case "image-file":
				if(!empty($popup_image)){
					echo '<a href="'.$popup_image.'" data-fancybox class="thumb thumb_image" style="background-image:url('.$resource_thumbnail.')"><img src="'.$path.'grid-view-spacer.png" class="img-responsive" /></a>';
				}else{
					echo '<div class="thumb" style="background-image:url('.$resource_thumbnail.')"><img src="'.$path.'grid-view-spacer.png" class="img-responsive" /></div>';
				}
				break;
			case "video-file":
				if(!empty($popup_url)){
					echo '<a data-fancybox href="'.$popup_url.'" class="thumb thumb_video" style="background-image:url('.$resource_thumbnail.')"><img src="'.$path.'grid-view-spacer.png" class="img-responsive" /></a>';
				}else{
					echo '<div class="thumb" style="background-image:url('.$resource_thumbnail.')"><img src="'.$path.'grid-view-spacer.png" class="img-responsive" /></div>';
				}
				break;
			case "interactive-file":
				if(!empty($popup_url)){
					echo '<a href="'.$popup_url.'" target="_blank" class="thumb thumb_interactive" style="background-image:url('.$resource_thumbnail.')"><img src="'.$path.'grid-view-spacer.png" class="img-responsive" /></a>';
				}else{
					echo '<div class="thumb" style="background-image:url('.$resource_thumbnail.')"><img src="'.$path.'grid-view-spacer.png" class="img-responsive" /></div>';
				}
				break;
			case "article-file":
				echo '<a href="javascript:;" data-fancybox data-src="#'.$resource_slug.'-content" class="thumb thumb_article" style="background-image:url('.$resource_thumbnail.')"><img src="'.$path.'grid-view-spacer.png" class="img-responsive" /></a>';
				break;
		}
	}else{	
		switch ($resource_type) {
			case "single-file":
			case "multiple-file":
				echo '<div class="thumb" style="background-image:url('.$path.$resource_type.'.svg)"><img src="'.$path.'grid-view-spacer.png" class="img-responsive" /></div>';
				break;
			case "image-file":
				if(!empty($popup_image)){
					echo '<a href="'.$popup_image.'" data-fancybox class="thumb" style="background-image:url('.$path.filetype_thumbnail($filetype).')"><img src="'.$path.'grid-view-spacer.png" class="img-responsive" /></a>';
				}else{
					echo '<div class="thumb" style="background-image:url('.$path.filetype_thumbnail($filetype).'"><img src="'.$path.'grid-view-spacer.png" class="img-responsive" /></div>';
				}
				break;
			case "video-file":
				if(!empty($popup_url)){
					echo '<a data-fancybox href="'.$popup_url.'" class="thumb" style="background-image:url('.$path.filetype_thumbnail($filetype).')"><img src="'.$path.'grid-view-spacer.png" class="img-responsive" /></a>';
				}else{
					echo '<div class="thumb" style="background-image:url('.$path.filetype_thumbnail($filetype).')"><img src="'.$path.'grid-view-spacer.png" class="img-responsive" /></div>';
				}
				break;
			case "audio-file":
				echo '<div class="thumb" style="background-image:url('.$path.filetype_thumbnail($filetype).')"><img src="'.$path.'grid-view-spacer.png" class="img-responsive" /></div>';
				break;
			case "interactive-file":
				if(!empty($popup_url)){
					echo '<a href="'.$popup_url.'" target="_blank" class="thumb" style="background-image:url('.$path.filetype_thumbnail($filetype).')"><img src="'.$path.'grid-view-spacer.png" class="img-responsive" /></a>';
				}else{
					echo '<div class="thumb" style="background-image:url('.$path.filetype_thumbnail($filetype).')"><img src="'.$path.'grid-view-spacer.png" class="img-responsive" /></div>';
				}
				break;
			case "article-file":
				echo '<a href="javascript:;" data-fancybox data-src="#'.$resource_slug.'-content" class="thumb" style="background-image:url('.$path.filetype_thumbnail($filetype).')"><img src="'.$path.'grid-view-spacer.png" class="img-responsive" /></a>';
				break;
				
			default:
				echo '<div class="thumb" style="background-image:url('.$path.filetype_thumbnail($filetype).')"><img src="'.$path.'grid-view-spacer.png" class="img-responsive" /></div>';
				break;
		}
	}
}

function showListTitle($resource_id, $resource_type, $popup_image, $popup_url, $resource_slug){
	$resource_display_title = get_field('display_title', $resource_id);
	
	if(empty($resource_display_title)){
		$resource_display_title = get_the_title( $resource_id );
	}

	switch ($resource_type) {
		case "single-file":
		case "multiple-file":
		case "audio-file":
			echo $resource_display_title;
			break;
		case "image-file":
			if(!empty($popup_image)){
				echo '<a href="'.$popup_image.'" data-fancybox>'.$resource_display_title.'</a>';
			}else{
				echo $resource_display_title;
			}
			break;
		case "video-file":
			if(!empty($popup_url)){
				echo '<a data-fancybox href="'.$popup_url.'">'.$resource_display_title.'</a>';
			}else{
				echo $resource_display_title;
			}
			break;
		case "interactive-file":
			if(!empty($popup_url)){
				echo '<a href="'.$popup_url.'" target="_blank">'.$resource_display_title.'</a>';
			}else{
				echo $resource_display_title;
			}
			break;
		case "article-file":
			echo '<a href="javascript:;" data-fancybox data-src="#'.$resource_slug.'-content">'.$resource_display_title.'</a>';
			break;
	}
}

function get_audio_preview($downloads){
	$count = count($downloads);
	$audio_url_array = array();
	$previewer;
	
	if($count > 1){
		foreach($downloads as $download){
			$file_type = $download['file_type'];
			$downloadable_file = $download['downloadable_file']['url'];
			$audio_preview = $download['audio_preview'];
			
			if($audio_preview){
				array_push($audio_url_array,$downloadable_file);
			}
		}
	}else{
		$file_type = $downloads[0]['file_type'];
		$downloadable_file = $downloads[0]['downloadable_file']['url'];
		$audio_preview = $downloads[0]['audio_preview'];
		
		if($audio_preview){			
			array_push($audio_url_array,$downloadable_file);
		}
	}
	
	if(count($audio_url_array) >= 2){
		$previewer .= '<div class="audio_container two_audio">';
	}else if(count($audio_url_array) == 1){
		$previewer .= '<div class="audio_container">';
	}
	
	if(count($audio_url_array) > 0){
		foreach($audio_url_array as $audio_url){
			$previewer .= '<div class="audio_playback" data-source="'.$audio_url.'"></div>';
		}
		$previewer .=  '</div>';
	}
	
	return $previewer;
}

add_action( 'wp_ajax_nopriv_get_resource_pagination', 'get_resource_pagination' );
add_action( 'wp_ajax_get_resource_pagination', 'get_resource_pagination' );
function get_resource_pagination(){
	global $post;
	
	$resource_list_id = $_POST['resource_listID'];
	
	if (isset($_POST['filters'])) {
		$filters = $_POST['filters'];
	}
	
	$filters_arr = explode(',', $filters);	
	$filters_arr = array_values(array_diff( $filters_arr, [0]));
	
	$resources = get_field('resources', $resource_list_id);
	
	// Pagination variables
	$resource_match_count = 0;
	$resources_per_page  = 20; // How many features to display on each page	
	
	if( $resources ):
			
		foreach ($resources as $resource):
			$resource_id = $resource->ID;
			$term_arr = array();
			
			$terms = get_the_terms( $resource_id, 'resource_category' );
			if ($terms) {
				foreach($terms as $term) {
				  array_push($term_arr,$term->term_id);
				} 
			}
			
			$matched = false;
			
			switch(count($filters_arr)){
				case 1:
					if(in_array($filters_arr[0],$term_arr)){
						$matched = true;
					}
					break;
				case 2:
					if(in_array($filters_arr[0],$term_arr) && in_array($filters_arr[1],$term_arr)){
						$matched = true;
					}
					break;
				case 3:
					if(in_array($filters_arr[0],$term_arr) && in_array($filters_arr[1],$term_arr) && in_array($filters_arr[2],$term_arr)){
						$matched = true;
					}
					break;
				default:
					$matched = true;
					break;
			}
			
			if(!$matched){
				continue; 
			}else{
				$resource_match_count++;
			}
			
		endforeach;
	
	endif;
	
	$pages = ceil( $resource_match_count / $resources_per_page ); 
	
	
	if (isset($_POST['page'])) {
		if($_POST['page'] > $pages || $_POST['page'] == 0){
			$page = 1;
		}else{
			$page = $_POST['page'];
		}
	} else {
		$page = 1;
	}
	
	if($pages > 1): 
	
		if($page > 1):
			echo '<button class="btn_gopage_prev"></button>';
		endif;
		
		echo '<select id="pagination-select">';		
		for($i = 1; $i <= $pages; $i++){
			$selected = '';
			if($i == $page){
				$selected = 'selected="selected"';
			}
			echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
		}		
		echo '</select>';
		echo '<span>/'.$pages.'</span>';
	
		if($page < $pages):
			echo '<button class="btn_gopage_next"></button> ';
		endif;
	
	endif;
	
	die();
}

// Hook this function to WordPress' Ajax actions
add_action( 'wp_ajax_nopriv_get_resource_grid', 'get_resource_grid' );
add_action( 'wp_ajax_get_resource_grid', 'get_resource_grid' );
function get_resource_grid(){
	global $post;
	
	if ($post->ID) {
		// On initial page load, just grab the post ID...
		//$page_id = $post->ID;
		$resource_list_id = get_field('resource_list',$post->ID);
	} else {
		// ... but once you're using Ajax, need to get the ID via Ajax
		$resource_list_id = $_POST['resource_listID'];
	}
	
	if (isset($_POST['page'])) {
		// Set $page to data from Ajax, if available
		$page = $_POST['page'];
	} else {
		// ... if not, set default to 1 (for initial page load)
		$page = 1;
	}
	
	if (isset($_POST['filters'])) {
		// Set $page to data from Ajax, if available
		$filters = $_POST['filters'];
	}
	
	//echo $filters;
	
	$filters_arr = explode(',', $filters);	
	$filters_arr = array_values(array_diff( $filters_arr, [0]));
	
	//print_r($filters_arr);
	
	$resources = get_field('resources', $resource_list_id);
	
	//print_r($resources);
	
	// Pagination variables
	$resource_count      = 0;
	$resource_match_count = 0;
	$resources_per_page  = 20; // How many features to display on each page
	$total              = count( $resources );
	//$pages              = ceil( $total / $resources_per_page );
	$min                = ( ( $page * $resources_per_page ) - $resources_per_page ) + 1;
	$max                = ( $min + $resources_per_page ) - 1;
	
	if( $resources ):
		//$i = 1;
		//$resource_list = get_field('resource_list');
		//$resources = get_field('resources', $resource_list[0]->ID);
		
		echo '<div class="resource-container-inner">';
		
		foreach ($resources as $resource):
			$resource_id = $resource->ID;
			$resource_type = get_field('resource_type', $resource_id);
			$resource_display_title = get_field('display_title', $resource_id);
			$resource_thumbnail = get_the_post_thumbnail_url($resource_id,'full');
			$note = get_field('note', $resource_id);
			$resource_popup_image = get_field('resource_popup_image', $resource_id);
			$resource_popup_url = get_field('resource_popup_url', $resource_id);
			$download_count = count(get_field('downloads', $resource_id));
			
			$resource_post = get_post($resource_id); 
			$resource_slug = $resource_post->post_name;
			$term_arr = array();
			
			$terms = get_the_terms( $resource_id, 'resource_category' );
			if ($terms) {
				foreach($terms as $term) {
				  //echo '<p>'.$term->term_id.'</p>';
				  array_push($term_arr,$term->term_id);
				} 
			}
			
			$matched = false;
			
			switch(count($filters_arr)){
				case 1:
					if(in_array($filters_arr[0],$term_arr)){
						$matched = true;
					}
					break;
				case 2:
					if(in_array($filters_arr[0],$term_arr) && in_array($filters_arr[1],$term_arr)){
						$matched = true;
					}
					break;
				case 3:
					if(in_array($filters_arr[0],$term_arr) && in_array($filters_arr[1],$term_arr) && in_array($filters_arr[2],$term_arr)){
						$matched = true;
					}
					break;
				default:
					$matched = true;
					break;
			}
			
			if(!$matched){
				continue; 
			}else{
				$resource_match_count++;
			}
			
			$resource_count++;
			// Ignore this feature if $feature_count is lower than $min
			if($resource_count < $min ) { continue; }
			// Stop loop completely if $feature_count is higher than $max
			if($resource_count > $max) { break; } 
	?>
	
			<div class="col-xs-6 col-sm-3 col-md-3 resource-item">
				<div class="resource-thumbnail">
					<?php
						echo showGridThumbnail($resource_id, $resource_thumbnail, $resource_type, $resource_popup_image['url'], $resource_popup_url, $resource_slug);
						echo get_audio_preview(get_field('downloads', $resource_id));
					?>
				</div>
				<div class="resource-title-wrapper">
					<div class="resource-title"><?=get_the_title( $resource->ID );?></div>
					<?php if(!empty($note)){ ?>
					<div class="resource-note">
						<a class="icon-note" data-fancybox data-src="#<?=$resource_slug.'-note'?>" href="javascript:;"></a>
						<div id="<?=$resource_slug.'-note'?>" class="hidden-content fancybox-content file-download"><?=$note?>	</div>
					</div>
					<?php } ?>
				</div>
				<div class="resource-type">File Downlaod</div>
				<div class="resource-download-wrapper">
					<?php
						if($download_count > 1){ ?>
							<div class="multiple_download">
								<div class="multiple_dl_header">Download (<?=$download_count?>)</div>
								<div class="multiple_dl_content">
									<ul>
									<?php	
									$downloadable_file_arr = array();
									
									if( have_rows('downloads', $resource_id) ){
										while( have_rows('downloads', $resource_id) ): the_row();
											$file_title = get_sub_field('file_title');
											$downloadable_file = get_sub_field('downloadable_file');
											//echo '<li><a href="'.$downloadable_file['url'].'" target="_blank">'.$file_title.'</a></li>';
											
											echo '<li><a href="'.get_template_directory_uri().'/templates/download.php?file='.$downloadable_file['ID'].'&pageid='.$post->ID.'" target="_blank">'.$file_title.'</a></li>';
											
											array_push($downloadable_file_arr, $downloadable_file['url']);
										endwhile;
										
										$downloadable_file_string = implode(',',$downloadable_file_arr);
									}?>
									
									<li><a href="javascript:;" data-file="<?=$downloadable_file_string?>" data-filename="testing123" class="createzip">Download All (<?=$download_count?> files)</a></li>
									</ul>
								</div>
							</div>
					<?php
						}else{
							if( have_rows('downloads', $resource_id) ){
								while( have_rows('downloads', $resource_id) ): the_row();
									$downloadable_file = get_sub_field('downloadable_file');
									//echo '<a href="'.$downloadable_file['url'].'" class="btn_single_download" target="_blank">Download</a>';
									echo '<a href="'.get_template_directory_uri().'/templates/download.php?file='.$downloadable_file['ID'].'&pageid='.$post->ID.'" class="btn_single_download" target="_blank">Download</a>';
								endwhile;
							}
						}
					?>
				</div>
				<?php if($resource_type == 'article-file') {?>
				<div id="<?=$resource_slug.'-content'?>" class="hidden-content fancybox-content article-lightbox">
					<h3><?=get_the_title( $resource->ID );?></h3>
					<div class="article-content">
						<div class="media-container">
							<?php 
							if( have_rows('downloads', $resource_id) ){
								while( have_rows('downloads', $resource_id) ): the_row();
									$file_title = get_sub_field('file_title');
									$downloadable_file = get_sub_field('downloadable_file');
									$file_type = get_sub_field('file_type');
									//echo '<a href="'.$downloadable_file['url'].'" class="media-file '.$file_type.'" target="_blank">'.$file_title.'</a>';
									echo '<a href="'.get_template_directory_uri().'/templates/download.php?file='.$downloadable_file['ID'].'&pageid='.$post->ID.'" class="media-file '.$file_type.'" target="_blank">'.$file_title.'</a>';
								endwhile;
							}									
							?>
						</div>
						<div class="clearfix">
							<?php if(!empty($resource_thumbnail)){ ?>

							<div class="img-container"><img src="<?=$resource_thumbnail?>" class="img-responsive" /></div>
							<?php } ?>
							<div class="content-container">
								<?php 
									$content_post = get_post($resource_id);
									$article_content = $content_post->post_content;
									$article_content = apply_filters('the_content', $article_content);
									echo $article_content;
								?>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
	<?php endforeach;
		
		if($resource_match_count == 0){
			echo '<p>No resources found, please refine your filter.</p>';
		}
	
		echo '</div>'; 
	endif; //end if ($features)
	wp_reset_postdata();
	
	die();
}

function get_all_resource_page(){
	$args = [
		'post_type' => 'page',
		'fields' => 'ids',
		'nopaging' => true,
		'meta_key' => '_wp_page_template',
		'meta_value' => 'template-resource.php',
		'hierarchical' => 0
	];
	
	$all_resources = [];
	
	$all_resources_pages = get_posts( $args );
	foreach ( $all_resources_pages as $resources_page ):
		$temp_arr = [];
		
		if(checkPageAccessRight($resources_page)):
			
			$temp_resource_list = get_field('resource_list', $resources_page);
			$temp_resources = get_field('resources', $temp_resource_list[0]->ID);
			
			if(!empty($temp_resources)):
			
				foreach($temp_resources	as $temp_resource):
				
					$temp_arr['pageid'] = $resources_page;
					
					$temp_arr['resource_id'] = $temp_resource->ID;
					
					array_push($all_resources, $temp_arr);
					
				endforeach;
				
			endif;
		
		endif;
		
	endforeach;
	
	return $all_resources;
}

add_action( 'wp_ajax_nopriv_get_all_resources_grid', 'get_all_resources_grid' );
add_action( 'wp_ajax_get_all_resources_grid', 'get_all_resources_grid' );
function get_all_resources_grid(){
	global $post;
	
	/*if ($post->ID) {
		// On initial page load, just grab the post ID...
		//$page_id = $post->ID;
		$resource_list_id = get_field('resource_list',$post->ID);
	} else {
		// ... but once you're using Ajax, need to get the ID via Ajax
		$resource_list_id = $_POST['resource_listID'];
	}*/
	
	if (isset($_POST['page'])) {
		// Set $page to data from Ajax, if available
		$page = $_POST['page'];
	} else {
		// ... if not, set default to 1 (for initial page load)
		$page = 1;
	}
	
	if (isset($_POST['filters'])) {
		// Set $page to data from Ajax, if available
		$filters = $_POST['filters'];
	}
	
	//echo $filters;
	
	$filters_arr = explode(',', $filters);	
	$filters_arr = array_values(array_diff( $filters_arr, [0]));
	
	//print_r($filters_arr);
	
	//$resources = get_field('resources', $resource_list_id);
	
	$all_resources = get_all_resource_page();
	
	//print_r($all_resources);
	
	// Pagination variables
	$resource_count      = 0;
	$resource_match_count = 0;
	$resources_per_page  = 20; // How many features to display on each page
	$total              = count( $all_resources );
	//$pages              = ceil( $total / $resources_per_page );
	$min                = ( ( $page * $resources_per_page ) - $resources_per_page ) + 1;
	$max                = ( $min + $resources_per_page ) - 1;
	
	if( $all_resources ):
		//$i = 1;
		//$resource_list = get_field('resource_list');
		//$resources = get_field('resources', $resource_list[0]->ID);
		
		echo '<div class="resource-container-inner">';
		
		foreach ($all_resources as $resource):
			$resource_parent = $resource['pageid'];
			$resource_id = $resource['resource_id'];
			
			$resource_type = get_field('resource_type', $resource_id);
			$resource_display_title = get_field('display_title', $resource_id);
			$resource_thumbnail = get_the_post_thumbnail_url($resource_id,'full');
			$note = get_field('note', $resource_id);
			$resource_popup_image = get_field('resource_popup_image', $resource_id);
			$resource_popup_url = get_field('resource_popup_url', $resource_id);
			$download_count = count(get_field('downloads', $resource_id));
			
			$resource_post = get_post($resource_id); 
			$resource_slug = $resource_post->post_name;
			$term_arr = array();
			
			$terms = get_the_terms( $resource_id, 'resource_category' );
			if ($terms) {
				foreach($terms as $term) {
				  //echo '<p>'.$term->term_id.'</p>';
				  array_push($term_arr,$term->term_id);
				} 
			}
			
			$matched = false;
			
			switch(count($filters_arr)){
				case 1:
					if(in_array($filters_arr[0],$term_arr)){
						$matched = true;
					}
					break;
				case 2:
					if(in_array($filters_arr[0],$term_arr) && in_array($filters_arr[1],$term_arr)){
						$matched = true;
					}
					break;
				case 3:
					if(in_array($filters_arr[0],$term_arr) && in_array($filters_arr[1],$term_arr) && in_array($filters_arr[2],$term_arr)){
						$matched = true;
					}
					break;
				default:
					$matched = true;
					break;
			}
			
			if(!$matched){
				continue; 
			}else{
				$resource_match_count++;
			}
			
			$resource_count++;
			// Ignore this feature if $feature_count is lower than $min
			if($resource_count < $min ) { continue; }
			// Stop loop completely if $feature_count is higher than $max
			if($resource_count > $max) { break; } 
	?>
	
			<div class="col-xs-6 col-sm-3 col-md-3 resource-item">
				<div class="resource-thumbnail">
					<?php
						echo showGridThumbnail($resource_id, $resource_thumbnail, $resource_type, $resource_popup_image['url'], $resource_popup_url, $resource_slug);
						echo get_audio_preview(get_field('downloads', $resource_id));
					?>
				</div>
				<div class="resource-title-wrapper">
					<div class="resource-title">
						<?php
							if(empty($resource_display_title)){
								echo get_the_title( $resource_id );
							}else{
								echo $resource_display_title;
							}
						?>
					</div>
					<?php if(!empty($note)){ ?>
					<div class="resource-note">
						<a class="icon-note" data-fancybox data-src="#<?=$resource_slug.'-note'?>" href="javascript:;"></a>
						<div id="<?=$resource_slug.'-note'?>" class="hidden-content fancybox-content file-download"><?=$note?>	</div>
					</div>
					<?php } ?>
				</div>
				<div class="resource-type"><?php echo get_the_title($resource_parent);?></div>
				<div class="resource-download-wrapper">
					<?php
						if($download_count > 1){ ?>
							<div class="multiple_download">
								<div class="multiple_dl_header">Download (<?=$download_count?>)</div>
								<div class="multiple_dl_content">
									<ul>
									<?php	
									$downloadable_file_arr = array();
									
									if( have_rows('downloads', $resource_id) ){
										while( have_rows('downloads', $resource_id) ): the_row();
											$file_title = get_sub_field('file_title');
											$downloadable_file = get_sub_field('downloadable_file');
											//echo '<li><a href="'.$downloadable_file['url'].'" target="_blank">'.$file_title.'</a></li>';
											
											echo '<li><a href="'.get_template_directory_uri().'/templates/download.php?file='.$downloadable_file['ID'].'&pageid='.$resource_parent.'">'.$file_title.'</a></li>';
											
											array_push($downloadable_file_arr, $downloadable_file['url']);
										endwhile;
										
										$downloadable_file_string = implode(',',$downloadable_file_arr);
									}?>
									
									<li><a href="javascript:;" data-file="<?=$downloadable_file_string?>" data-filename="testing123" class="createzip">Download All (<?=$download_count?> files)</a></li>
									</ul>
								</div>
							</div>
					<?php
						}else{
							if( have_rows('downloads', $resource_id) ){
								while( have_rows('downloads', $resource_id) ): the_row();
									$downloadable_file = get_sub_field('downloadable_file');
									//echo '<a href="'.$downloadable_file['url'].'" class="btn_single_download" target="_blank">Download</a>';
									
									echo '<a href="'.get_template_directory_uri().'/templates/download.php?file='.$downloadable_file['ID'].'&pageid='.$resource_parent.'" class="btn_single_download">Download</a>';
								endwhile;
							}
						}
					?>
				</div>
				<?php if($resource_type == 'article-file') {?>
				<div id="<?=$resource_slug.'-content'?>" class="hidden-content fancybox-content article-lightbox">
					<h3><?=get_the_title( $resource->ID );?></h3>
					<div class="article-content">
						<div class="media-container">
							<?php 
							if( have_rows('downloads', $resource_id) ){
								while( have_rows('downloads', $resource_id) ): the_row();
									$file_title = get_sub_field('file_title');
									$downloadable_file = get_sub_field('downloadable_file');
									$file_type = get_sub_field('file_type');
									//echo '<a href="'.$downloadable_file['url'].'" class="media-file '.$file_type.'" target="_blank">'.$file_title.'</a>';
									
									echo '<a href="'.get_template_directory_uri().'/templates/download.php?file='.$downloadable_file['ID'].'&pageid='.$resource_parent.'" class="media-file '.$file_type.'">'.$file_title.'</a>';
								endwhile;
							}									
							?>
						</div>
						<div class="clearfix">
							<?php if(!empty($resource_thumbnail)){ ?>

							<div class="img-container"><img src="<?=$resource_thumbnail?>" class="img-responsive" /></div>
							<?php } ?>
							<div class="content-container">
								<?php 
									$content_post = get_post($resource_id);
									$article_content = $content_post->post_content;
									$article_content = apply_filters('the_content', $article_content);
									echo $article_content;
								?>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
	<?php endforeach;
		
		if($resource_match_count == 0){
			echo '<p>No resources found, please refine your filter.</p>';
		}
	
		echo '</div>'; 
	endif; //end if ($features)
	wp_reset_postdata();
	
	die();
}

// Hook this function to WordPress' Ajax actions
add_action( 'wp_ajax_nopriv_get_resource_list', 'get_resource_list' );
add_action( 'wp_ajax_get_resource_list', 'get_resource_list' );
function get_resource_list(){
	global $post;
	
	if ($post->ID) {
		// On initial page load, just grab the post ID...
		//$page_id = $post->ID;
		$resource_list_id = get_field('resource_list',$post->ID);
	} else {
		// ... but once you're using Ajax, need to get the ID via Ajax
		$resource_list_id = $_POST['resource_listID'];
	}
	
	if (isset($_POST['page'])) {
		// Set $page to data from Ajax, if available
		$page = $_POST['page'];
	} else {
		// ... if not, set default to 1 (for initial page load)
		$page = 1;
	}
	
	if (isset($_POST['filters'])) {
		// Set $page to data from Ajax, if available
		$filters = $_POST['filters'];
	}
	
	//echo $filters;
	
	$filters_arr = explode(',', $filters);	
	$filters_arr = array_values(array_diff( $filters_arr, [0]));
	
	$resources = get_field('resources', $resource_list_id);
	
	//print_r($resources);
	
	// Pagination variables
	$resource_count      = 0;
	$resource_match_count = 0;
	$resources_per_page  = 20; // How many features to display on each page
	$total              = count( $resources );
	//$pages              = ceil( $total / $resources_per_page );
	$min                = ( ( $page * $resources_per_page ) - $resources_per_page ) + 1;
	$max                = ( $min + $resources_per_page ) - 1;
	
	if( $resources ):
		//$i = 1;
		//$resource_list = get_field('resource_list');
		//$resources = get_field('resources', $resource_list[0]->ID);
		
		echo '<div class="resource-container-inner">';
		
		foreach ($resources as $resource):
			$resource_id = $resource->ID;
			$resource_type = get_field('resource_type', $resource_id);
			$resource_thumbnail = get_the_post_thumbnail_url($resource_id,'full');
			$note = get_field('note', $resource_id);
			$resource_popup_image = get_field('resource_popup_image', $resource_id);
			$resource_popup_url = get_field('resource_popup_url', $resource_id);
			$download_count = count(get_field('downloads', $resource_id));
			
			$resource_post = get_post($resource_id); 
			$resource_slug = $resource_post->post_name;
			$term_arr = array();
			
			$terms = get_the_terms( $resource_id, 'resource_category' );
			if ($terms) {
				foreach($terms as $term) {
				  //echo '<p>'.$term->term_id.'</p>';
				  array_push($term_arr,$term->term_id);
				} 
			}
			
			$matched = false;
			
			switch(count($filters_arr)){
				case 1:
					if(in_array($filters_arr[0],$term_arr)){
						$matched = true;
					}
					break;
				case 2:
					if(in_array($filters_arr[0],$term_arr) && in_array($filters_arr[1],$term_arr)){
						$matched = true;
					}
					break;
				case 3:
					if(in_array($filters_arr[0],$term_arr) && in_array($filters_arr[1],$term_arr) && in_array($filters_arr[2],$term_arr)){
						$matched = true;
					}
					break;
				default:
					$matched = true;
					break;
			}
			
			if(!$matched){
				continue; 
			}else{
				$resource_match_count++;
			}
			
			$resource_count++;
			// Ignore this feature if $feature_count is lower than $min
			if($resource_count < $min) { continue; }
			// Stop loop completely if $feature_count is higher than $max
			if($resource_count > $max) { break; } 
	?>
	
			<div class="resource-item <?=$resource_type?> clearfix">
				<div class="resource-title-wrapper col-xs-9 col-sm-10 col-md-5">
					<div class="clearfix">
						<table cellpadding="0" cellspacing="0" border="0" width="90%">
							<tr>
								<td class="title">
									<div class="resource-title-div">
										<div class="resource-title">
											<?php echo showListTitle($resource_id, $resource_type, $resource_popup_image['url'], $resource_popup_url, $resource_slug);?>
										</div>
										<div class="resource-type"><?=$resource_type?></div>
									</div>
								</td>
								<td class="audio">
									<?php echo get_audio_preview(get_field('downloads', $resource_id));?>
								</td>
							</tr>
						</table>
						<?php if(!empty($note)){ ?>
						<div class="resource-note">
							<a class="icon-note" data-fancybox data-src="#<?=$resource_slug.'-note'?>" href="javascript:;"></a>
							<div id="<?=$resource_slug.'-note'?>" class="hidden-content fancybox-content file-download"><?=$note?>	</div>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class="col-xs-3 col-sm-2 col-md-7 file-download-wrapper no-padding">
					<?php if($download_count > 1): ?>
					<div class="hidden-xs hidden-sm">
						<?php 
						if( have_rows('downloads', $resource_id) ){
							while( have_rows('downloads', $resource_id) ): the_row();
								$file_title = get_sub_field('file_title');
								$downloadable_file = get_sub_field('downloadable_file');
								$file_type = get_sub_field('file_type');
								//echo '<a href="'.$downloadable_file['url'].'" class="media-file '.$file_type.'" target="_blank">'.$file_title.'</a>';
								echo '<a href="'.get_template_directory_uri().'/templates/download.php?file='.$downloadable_file['ID'].'&pageid='.$post->ID.'" class="media-file '.$file_type.' target="_blank"">'.$file_title.'</a>';
							endwhile;
						}
						?>
						<!--<a href="#" class="media-file all">All</a>-->
					</div>
					
					<div class="hidden-md hidden-lg">
						<div class="mobile_download_wrapper">
							<select class="mobile_download">
								<?php 
								if( have_rows('downloads', $resource_id) ){
									while( have_rows('downloads', $resource_id) ): the_row();
										$file_title = get_sub_field('file_title');
										$downloadable_file = get_sub_field('downloadable_file');
										$file_type = get_sub_field('file_type');
										//echo '<a href="'.$downloadable_file['url'].'" class="media-file '.$file_type.'" target="_blank">'.$file_title.'</a>';
										//echo '<option val="'.$downloadable_file['url'].'">'.$file_title.'</option>';
										echo '<option val="'.get_template_directory_uri().'/templates/download.php?file='.$downloadable_file['ID'].'&pageid='.$post->ID.'">'.$file_title.'</option>';
									endwhile;
								}
								?>
								<!--<option>Download All</option>-->
							</select>
							<div class="download_text">Download</div>
						</div>
					</div>
					<?php else:
						if( have_rows('downloads', $resource_id) ):
							while( have_rows('downloads', $resource_id) ): the_row();
								$downloadable_file = get_sub_field('downloadable_file'); 
								$file_type = get_sub_field('file_type');
								echo '<div class="hidden-xs hidden-sm">';
								//echo '<a href="'.$downloadable_file['url'].'" class="media-file '.$file_type.'" target="_blank">'.$file_title.'</a>'; 
								echo '<a href="'.get_template_directory_uri().'/templates/download.php?file='.$downloadable_file['ID'].'&pageid='.$post->ID.'" class="media-file '.$file_type.'" target="_blank">'.$file_title.'</a>';
								echo '</div>';
								
								echo '<div class="hidden-md hidden-lg">';
								//echo '<a href="'.$downloadable_file['url'].'" class="media-file all" target="_blank">Download</a>';; 
								echo '<a href="'.get_template_directory_uri().'/templates/download.php?file='.$downloadable_file['ID'].'&pageid='.$post->ID.'" class="media-file all" target="_blank">Download</a>';
								echo '</div>'; 
					 
					 		endwhile;
					 endif; ?>
					<?php endif; ?>
				</div>
				
				<?php if($resource_type == 'article-file') {?>
				<div id="<?=$resource_slug.'-content'?>" class="hidden-content fancybox-content article-lightbox">
					<h3><?=get_the_title( $resource->ID );?></h3>
					<div class="article-content">
						<div class="media-container">
							<?php 
							if( have_rows('downloads', $resource_id) ){
								while( have_rows('downloads', $resource_id) ): the_row();
									$file_title = get_sub_field('file_title');
									$downloadable_file = get_sub_field('downloadable_file');
									$file_type = get_sub_field('file_type');
									echo '<a href="'.$downloadable_file['url'].'" class="media-file '.$file_type.'" target="_blank">'.$file_title.'</a>';
								endwhile;
							}									
							?>
						</div>
						<div class="clearfix">
							<?php if(!empty($resource_thumbnail)){ ?>
							<div class="img-container"><img src="<?=$resource_thumbnail?>" class="img-responsive" /></div>
							<?php } ?>
							<div class="content-container">
								<?php 
									$content_post = get_post($resource_id);
									$article_content = $content_post->post_content;
									$article_content = apply_filters('the_content', $article_content);
									echo $article_content;
								?>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
	<?php endforeach;
			
		if($resource_match_count == 0){
			echo '<p>No resources found, please refine your filter.</p>';
		}
	
		echo '</div>'; 
	endif; //end if ($features)
	wp_reset_postdata();
	
	die();
}

add_action( 'wp_ajax_nopriv_get_all_resources_list', 'get_all_resources_list' );
add_action( 'wp_ajax_get_all_resources_list', 'get_all_resources_list' );
function get_all_resources_list(){
	global $post;
	
	if ($post->ID) {
		// On initial page load, just grab the post ID...
		//$page_id = $post->ID;
		$resource_list_id = get_field('resource_list',$post->ID);
	} else {
		// ... but once you're using Ajax, need to get the ID via Ajax
		$resource_list_id = $_POST['resource_listID'];
	}
	
	if (isset($_POST['page'])) {
		// Set $page to data from Ajax, if available
		$page = $_POST['page'];
	} else {
		// ... if not, set default to 1 (for initial page load)
		$page = 1;
	}
	
	if (isset($_POST['filters'])) {
		// Set $page to data from Ajax, if available
		$filters = $_POST['filters'];
	}
	
	//echo $filters;
	
	$filters_arr = explode(',', $filters);	
	$filters_arr = array_values(array_diff( $filters_arr, [0]));
	
	//$resources = get_field('resources', $resource_list_id);
	
	$all_resources = get_all_resource_page();
	
	//print_r($resources);
	
	// Pagination variables
	$resource_count      = 0;
	$resource_match_count = 0;
	$resources_per_page  = 20; // How many features to display on each page
	$total              = count( $all_resources );
	//$pages              = ceil( $total / $resources_per_page );
	$min                = ( ( $page * $resources_per_page ) - $resources_per_page ) + 1;
	$max                = ( $min + $resources_per_page ) - 1;
	
	if( $all_resources ):
		//$i = 1;
		//$resource_list = get_field('resource_list');
		//$resources = get_field('resources', $resource_list[0]->ID);
		
		echo '<div class="resource-container-inner">';
		
		foreach ($all_resources as $resource):
			$resource_parent = $resource['pageid'];
			$resource_id = $resource['resource_id'];
			
			$resource_type = get_field('resource_type', $resource_id);
			$resource_thumbnail = get_the_post_thumbnail_url($resource_id,'full');
			$note = get_field('note', $resource_id);
			$resource_popup_image = get_field('resource_popup_image', $resource_id);
			$resource_popup_url = get_field('resource_popup_url', $resource_id);
			$download_count = count(get_field('downloads', $resource_id));
			
			$resource_post = get_post($resource_id); 
			$resource_slug = $resource_post->post_name;
			$term_arr = array();
			
			$terms = get_the_terms( $resource_id, 'resource_category' );
			if ($terms) {
				foreach($terms as $term) {
				  //echo '<p>'.$term->term_id.'</p>';
				  array_push($term_arr,$term->term_id);
				} 
			}
			
			$matched = false;
			
			switch(count($filters_arr)){
				case 1:
					if(in_array($filters_arr[0],$term_arr)){
						$matched = true;
					}
					break;
				case 2:
					if(in_array($filters_arr[0],$term_arr) && in_array($filters_arr[1],$term_arr)){
						$matched = true;
					}
					break;
				case 3:
					if(in_array($filters_arr[0],$term_arr) && in_array($filters_arr[1],$term_arr) && in_array($filters_arr[2],$term_arr)){
						$matched = true;
					}
					break;
				default:
					$matched = true;
					break;
			}
			
			if(!$matched){
				continue; 
			}else{
				$resource_match_count++;
			}
			
			$resource_count++;
			// Ignore this feature if $feature_count is lower than $min
			if($resource_count < $min) { continue; }
			// Stop loop completely if $feature_count is higher than $max
			if($resource_count > $max) { break; } 
	?>
	
			<div class="resource-item <?=$resource_type?> clearfix">
				<div class="resource-title-wrapper col-xs-9 col-sm-10 col-md-5">
					<div class="clearfix">
						<table cellpadding="0" cellspacing="0" border="0" width="90%">
							<tr>
								<td class="title">
									<div class="resource-title-div">
										<div class="resource-title">
											<?php echo showListTitle($resource_id, $resource_type, $resource_popup_image['url'], $resource_popup_url, $resource_slug);?>
										</div>
										<div class="resource-type"><?=$resource_type?></div>
									</div>
								</td>
								<td class="audio">
									<?php echo get_audio_preview(get_field('downloads', $resource_id));?>
								</td>
							</tr>
						</table>
						<?php if(!empty($note)){ ?>
						<div class="resource-note">
							<a class="icon-note" data-fancybox data-src="#<?=$resource_slug.'-note'?>" href="javascript:;"></a>
							<div id="<?=$resource_slug.'-note'?>" class="hidden-content fancybox-content file-download"><?=$note?>	</div>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class="col-xs-3 col-sm-2 col-md-7 file-download-wrapper no-padding">
					<?php if($download_count > 1): ?>
					<div class="hidden-xs hidden-sm">
						<?php 
						if( have_rows('downloads', $resource_id) ){
							while( have_rows('downloads', $resource_id) ): the_row();
								$file_title = get_sub_field('file_title');
								$downloadable_file = get_sub_field('downloadable_file');
								$file_type = get_sub_field('file_type');
								//echo '<a href="'.$downloadable_file['url'].'" class="media-file '.$file_type.'" target="_blank">'.$file_title.'</a>';
								echo '<a href="'.get_template_directory_uri().'/templates/download.php?file='.$downloadable_file['ID'].'&pageid='.$post->ID.'" class="media-file '.$file_type.' target="_blank"">'.$file_title.'</a>';
							endwhile;
						}
						?>
						<!--<a href="#" class="media-file all">All</a>-->
					</div>
					
					<div class="hidden-md hidden-lg">
						<div class="mobile_download_wrapper">
							<select class="mobile_download">
								<?php 
								if( have_rows('downloads', $resource_id) ){
									while( have_rows('downloads', $resource_id) ): the_row();
										$file_title = get_sub_field('file_title');
										$downloadable_file = get_sub_field('downloadable_file');
										$file_type = get_sub_field('file_type');
										//echo '<a href="'.$downloadable_file['url'].'" class="media-file '.$file_type.'" target="_blank">'.$file_title.'</a>';
										//echo '<option val="'.$downloadable_file['url'].'">'.$file_title.'</option>';
										echo '<option val="'.get_template_directory_uri().'/templates/download.php?file='.$downloadable_file['ID'].'&pageid='.$post->ID.'">'.$file_title.'</option>';
									endwhile;
								}
								?>
								<!--<option>Download All</option>-->
							</select>
							<div class="download_text">Download</div>
						</div>
					</div>
					<?php else:
						if( have_rows('downloads', $resource_id) ):
							while( have_rows('downloads', $resource_id) ): the_row();
								$downloadable_file = get_sub_field('downloadable_file'); 
								$file_type = get_sub_field('file_type');
								echo '<div class="hidden-xs hidden-sm">';
								//echo '<a href="'.$downloadable_file['url'].'" class="media-file '.$file_type.'" target="_blank">'.$file_title.'</a>'; 
								echo '<a href="'.get_template_directory_uri().'/templates/download.php?file='.$downloadable_file['ID'].'&pageid='.$post->ID.'" class="media-file '.$file_type.'" target="_blank">'.$file_title.'</a>';
								echo '</div>';
								
								echo '<div class="hidden-md hidden-lg">';
								//echo '<a href="'.$downloadable_file['url'].'" class="media-file all" target="_blank">Download</a>';; 
								echo '<a href="'.get_template_directory_uri().'/templates/download.php?file='.$downloadable_file['ID'].'&pageid='.$post->ID.'" class="media-file all" target="_blank">Download</a>';
								echo '</div>'; 
					 
					 		endwhile;
					 endif; ?>
					<?php endif; ?>
				</div>
				
				<?php if($resource_type == 'article-file') {?>
				<div id="<?=$resource_slug.'-content'?>" class="hidden-content fancybox-content article-lightbox">
					<h3><?=get_the_title( $resource->ID );?></h3>
					<div class="article-content">
						<div class="media-container">
							<?php 
							if( have_rows('downloads', $resource_id) ){
								while( have_rows('downloads', $resource_id) ): the_row();
									$file_title = get_sub_field('file_title');
									$downloadable_file = get_sub_field('downloadable_file');
									$file_type = get_sub_field('file_type');
									echo '<a href="'.$downloadable_file['url'].'" class="media-file '.$file_type.'" target="_blank">'.$file_title.'</a>';
								endwhile;
							}									
							?>
						</div>
						<div class="clearfix">
							<?php if(!empty($resource_thumbnail)){ ?>
							<div class="img-container"><img src="<?=$resource_thumbnail?>" class="img-responsive" /></div>
							<?php } ?>
							<div class="content-container">
								<?php 
									$content_post = get_post($resource_id);
									$article_content = $content_post->post_content;
									$article_content = apply_filters('the_content', $article_content);
									echo $article_content;
								?>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
	<?php endforeach;
			
		if($resource_match_count == 0){
			echo '<p>No resources found, please refine your filter.</p>';
		}
	
		echo '</div>'; 
	endif; //end if ($features)
	wp_reset_postdata();
	
	die();
}


define('ACSGATE',	'http://leap.beta.ilongman.com/acs-web/App/ACSGateway.do?');

function xml2php($file) {



	// Open file connection

	$handle = fopen($file, "rb");

	if (isset($handle) && $handle!=null && $handle!='')  {



		$contents = '';

		while (!feof($handle)) {

		  $contents .= fread($handle, 8192);

		}

	} else {

		echo 'Cannot get data returned from ACSGateway.';

		exit;

	}

	fclose($handle);


	// Start parsing the XML file 

   	$xml_parser = xml_parser_create();

	$contents = ltrim ($contents);

	if (!xml_parse_into_struct($xml_parser, $contents, $arr_vals, $index)) {

		   sprintf("XML error: %s at line %d",

					   xml_error_string(xml_get_error_code($xml_parser)),

					   xml_get_current_line_number($xml_parser));

		$arr_vals = 'Failed parsing XML from ACSGateway' ."\n";

		if (count($arr_val)==0) $arr_vals .= 'XML return from ACSGateway has no value';

  	}

   	xml_parser_free($xml_parser);

	

   	return $arr_vals;

}

function openACS($inMethod, $inAsMethod, $inParameter, $inNode, $inDetailArray, $tempXML) {

	$tgetURL = ACSGATE  . 'method=' . $inMethod . '&asMethod=' . $inAsMethod  . $inParameter ;
	//echo $tgetURL . "\n";

	// Churn XML into php array
	$array = xml2php($tgetURL);

	// tokenize nodes into array

	$inNodePieces = explode("/", $inNode);

	$result = [];

	$j=0;

	for($i = 0; $i < count($array); $i++) {
		// Getting into the desire in node first
		if ( strcasecmp($inNodePieces[count($inNodePieces)-1], $array[$i]['tag']) ==0 && $array[$i]['type']=='open') {

			while ($array[$i+1]['type'] != 'close' && $array[$i+1]['type'] != 'open') {

				$result_inner[$array[$i+1]['tag']] = $array[$i+1]['value'];

				$result[$j] = $result_inner;

				$i++;

			}

			$j++;

		}

	}
	return $result;
}

function acsGetAccessRight($inLoginId){

	$method = 'getAccessRights';

	$asmethod = 'getByUser';

	$inputparameter = '&loginId='. $inLoginId . '&applicationId=438';

	$node = 'AccessRights/Access';

	$result = openACS($method, $asmethod, $inputparameter, $node, '','' );

	return $result;
}

function standardizePageAccess($arr){
	$newArr = array();

	foreach($arr as $a):
	
		$temp_arr['ROLEID'] = $a['ROLEID'];
		
		$temp_arr['SERVICECODE'] = $a['SERVICECODE']->post_title;
		
		array_push($newArr, $temp_arr);
		
	endforeach;
	
	return $newArr;
}

function checkPageAccessRight($page_id, $dir = false){

	$redirection = (!$dir) ? false : true;
	
	//get acf field - access_service_code_with_role
	$access_service_roles = get_field('access_service_code_with_role', $page_id);
	
	if(!empty($access_service_roles)){ //not empty, check access right
	
		$page_access_arr = standardizePageAccess($access_service_roles);
		
		foreach($_SESSION['accessRight'] as $accessRight){
		
			foreach($page_access_arr as $page_access){
			
				if($page_access['SERVICECODE'] == $accessRight['SERVICECODE'] && $page_access['ROLEID'] == $accessRight['ROLEID']){
				
					return true;
				}else{				
				
					continue;
					
				}
			}
		}
		
		$permission_page_id = 291;		
		$no_permission_url = get_permalink($permission_page_id);
		if($redirection):?>
		
		<script>
			var url = '<?=$no_permission_url?>';
			
			location.replace(url);
		</script>
		
		<?php
		
		endif;
		return false;
	}else{
		return true;
	}
}

function initAccessRightChecking($inLoginId){
	$current_post_id = get_the_ID();

	if(!isset($_SESSION['accessRight'])){ //session NOT EXIST
		
		$result = acsGetAccessRight($inLoginId);
		
		if(!empty($result)){
		
			$_SESSION['accessRight'] = $result;
			
		}
		
		checkPageAccessRight($current_post_id, true);
		
	}else{ //session EXIST
	
		checkPageAccessRight($current_post_id, true);
		
	}
}

function wp_get_exclude_menu($current_menu) {
 
    $array_menu = wp_get_nav_menu_items($current_menu);
    $menu = array();
		
	foreach ($array_menu as $m) {
	
		$access_service_roles = get_field('access_service_code_with_role', $m->object_id);
		
		if(!empty($access_service_roles)){ //not empty, check access right
		
			$page_access_arr = standardizePageAccess($access_service_roles);
			$matched_servicecode = 0;
			foreach($_SESSION['accessRight'] as $accessRight){
				
				foreach($page_access_arr as $page_access){
					
					if($page_access['SERVICECODE'] == $accessRight['SERVICECODE'] && $page_access['ROLEID'] == $accessRight['ROLEID']){
						$matched_servicecode++;
						
						//echo $matched_servicecode;
					}
				}
				
			}
			//echo $matched_servicecode;
			if($matched_servicecode < 1){
				if (!in_array($m->object_id, $menu)) {
					array_push($menu, $m->object_id);	
				}
			}
		}
    }
	
	return $menu;
}