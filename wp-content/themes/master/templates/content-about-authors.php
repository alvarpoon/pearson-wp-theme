<?php //the_content(); ?>
<?php //wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>
<?php
	$my_postid = $post->ID;
	
	$frontpage_id = get_option( 'page_on_front' );
	
	get_header_banner();
?>

<div class="container">	
	<div class="home-content-wrapper">
		<div class="content-right about-authors col-md-12">
			<div class="section-title"><?=get_the_title($post->ID);?></div>
			<div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
				<?php
					if(function_exists('bcn_display'))
					{
						bcn_display();
					}
				?>
			</div>
			<div class="long-content">
				<?php
					if(have_rows('author_content')):
						
						while(have_rows('author_content')):the_row();
						
							if(get_row_layout() == "content_title"):
							
								$title = get_sub_field('title');
							
								echo '<div class="content-title">'.$title.'</div>';
							
							elseif(get_row_layout() == "content_rows"):
							
								if( have_rows('authors') ):
								
									echo '<div class="content-block-div">';
								
									while(have_rows('authors')):the_row();
									
										$image = get_sub_field('image');
										$bios = get_sub_field('bios');
										$bios = apply_filters('the_content', $bios);
										$bios = str_replace(']]>', ']]&gt;', $bios);
										
										echo '<div class="content-block clearfix">';
															
										echo '<div class="col-md-2 img-container"><img src="' . $image['url'] . '" class="img-responsive" /></div>';
										
										echo '<div class="col-md-10">'.$bios.'</div>';
										
										echo '</div>';
									
									endwhile;
									
									echo '</div>';
								
								endif;
								
							endif;
							
							
							
						endwhile;
						
					endif;
				?>
			</div>
		</div>
		<div class="content-left">
			<?php
				// check if the flexible content field has rows of data
				if( have_rows('side_banner', $frontpage_id) ):
				
					// loop through the rows of data
					while ( have_rows('side_banner', $frontpage_id) ) : the_row();
				
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