<?php //the_content(); ?>
<?php //wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>
<?php
	$my_postid = $post->ID;
	
	//echo 'post id: '.$my_postid;
?>
<div class="container-fluid">
	<div class="top-banner-container" style="background-image:url('<?=get_stylesheet_directory_uri()?>/assets/img/home/banner-top.png');">
		<img src="<?=get_stylesheet_directory_uri()?>/assets/img/home/banner-top.png" class="img-responsive hidden-xs hidden-sm hidden-md hidden-lg" />
	</div>
</div>

<div class="container">
	<div class="home-slider">
		<div class="slider-item">
			<img src="<?=get_stylesheet_directory_uri()?>/assets/img/home/slider-banner-300w180h.png" class="img-responsive visible-xs hidden-sm hidden-md hidden-lg" />
			<img src="<?=get_stylesheet_directory_uri()?>/assets/img/home/slider-banner-735w250h.png" class="img-responsive hidden-xs visible-sm visible-md hidden-lg" />
			<img src="<?=get_stylesheet_directory_uri()?>/assets/img/home/slider-banner-1179w250h.png" class="img-responsive hidden-xs hidden-sm hidden-md visible-lg" />
		</div>
		<div class="slider-item">
			<img src="<?=get_stylesheet_directory_uri()?>/assets/img/home/slider-banner-300w180h.png" class="img-responsive visible-xs hidden-sm hidden-md hidden-lg" />
			<img src="<?=get_stylesheet_directory_uri()?>/assets/img/home/slider-banner-735w250h.png" class="img-responsive hidden-xs visible-sm visible-md hidden-lg" />
			<img src="<?=get_stylesheet_directory_uri()?>/assets/img/home/slider-banner-1179w250h.png" class="img-responsive hidden-xs hidden-sm hidden-md visible-lg" />
		</div>
		<div class="slider-item">
			<img src="<?=get_stylesheet_directory_uri()?>/assets/img/home/slider-banner-300w180h.png" class="img-responsive visible-xs hidden-sm hidden-md hidden-lg" />
			<img src="<?=get_stylesheet_directory_uri()?>/assets/img/home/slider-banner-735w250h.png" class="img-responsive hidden-xs visible-sm visible-md hidden-lg" />
			<img src="<?=get_stylesheet_directory_uri()?>/assets/img/home/slider-banner-1179w250h.png" class="img-responsive hidden-xs hidden-sm hidden-md visible-lg" />
		</div>
	</div>
	
	<div class="home-content-wrapper">
		<div class="content-right col-md-12">
			<div class="section-title">What's New</div>
			<div class="scrollable-content-wrapper">
				<div class="scrollable-content">
					<?php
						$args = array(
							'orderby'          => 'date',
							'order'            => 'DESC',
							'post_type'        => 'post',
							'post_status'      => 'publish',
							'suppress_filters' => true
						);
						$postlist = get_posts($args);
						
						//echo count($postlist);
						foreach($postlist as $p):
							$pfx_date = get_the_date( 'jS F,Y', $p->ID );
							$content = $p->post_content;
							$content = apply_filters('the_content', $content);
							$post_content = '';
							
							echo '<div class="news-item">';
							echo '<div class="news-date">'.$pfx_date.'</div>';
							echo '<div class="news-content">';
							echo $content;
							echo '</div>';
							echo '</div>';
						endforeach;
					?>
				</div>
			</div>
		</div>
		<div class="content-left">
			<div class="banner-item"><a href="#"><img src="<?=get_stylesheet_directory_uri()?>/assets/img/home/side-banner-1.png" class="img-responsive" /></a></div>
			<div class="banner-item"><a href="#"><img src="<?=get_stylesheet_directory_uri()?>/assets/img/home/side-banner-2.png" class="img-responsive" /></a></div>
			<div class="banner-item"><a href="#"><img src="<?=get_stylesheet_directory_uri()?>/assets/img/home/side-banner-3.png" class="img-responsive" /></a></div>
			<div class="banner-item"><a href="#"><img src="<?=get_stylesheet_directory_uri()?>/assets/img/home/side-banner-4.png" class="img-responsive" /></a></div>
			<div class="banner-item"><a href="#"><img src="<?=get_stylesheet_directory_uri()?>/assets/img/home/side-banner-5.png" class="img-responsive" /></a></div>
			<div class="banner-item"><a href="#"><img src="<?=get_stylesheet_directory_uri()?>/assets/img/home/side-banner-6.png" class="img-responsive" /></a></div>
		</div>
	</div>
</div>