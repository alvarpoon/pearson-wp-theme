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
		<?php
			$main_banners = get_field('main_banner');
			
			foreach($main_banners as $main_banner):
				$banner_link = get_field('banner_link', $main_banner);
				$banner_link_target = get_field('link_target', $main_banner);
				$banner_mobile = get_field('banner_mobile', $main_banner);
				$banner_tablet = get_field('banner_tablet', $main_banner);
				$banner_desktop = get_field('banner_desktop', $main_banner);
				
				echo '<div class="slider-item">';
				echo '<a href="'.$banner_link.'" target="'.$banner_link_target.'"><img src="'.$banner_mobile.'" class="img-responsive visible-xs hidden-sm hidden-md hidden-lg" /></a>';
				echo '<a href="'.$banner_link.'" target="'.$banner_link_target.'"><img src="'.$banner_tablet.'" class="img-responsive hidden-xs visible-sm visible-md hidden-lg" /></a>';
				echo '<a href="'.$banner_link.'" target="'.$banner_link_target.'"><img src="'.$banner_desktop.'" class="img-responsive hidden-xs hidden-sm hidden-md visible-lg" /></a>';
				echo '</div>';
				
			endforeach;
		?>
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
			<?php
				// check if the flexible content field has rows of data
				if( have_rows('side_banner') ):
				
					// loop through the rows of data
					while ( have_rows('side_banner') ) : the_row();
				
						// check current row layout
						if( get_row_layout() == 'image_banner' ):
		
							$image = get_sub_field('image');
							$link = get_sub_field('link');
							$link_target = get_sub_field('link_target');
		
							echo '<div class="banner-item">';
							echo '<a href="'.$link.'" target="'.$link_target.'"><img src="'.$image.'" class="img-responsive" /></a>';
							echo '</div>';
				
						endif;
						
						if( get_row_layout() == 'youtube_video' ):
						
							$image = get_sub_field('image_thumbnail');
							$link = get_sub_field('link');
							$link_target = get_sub_field('link_target');
							
							echo '<div class="banner-item">';
							
							switch($link_target){
								case '_blank':
									echo '<a href="'.$link.'" target="'.$link_target.'"><img src="'.$image.'" class="img-responsive" /></a>';
									break;
								case 'lightbox':
									echo '<a href="'.$link.'" data-fancybox><img src="'.$image.'" class="img-responsive" /></a>';
									break;
							}
							
							echo '</div>';
						
						endif;
				
					endwhile;
					
				endif;
				
			?>
		</div>
	</div>
</div>