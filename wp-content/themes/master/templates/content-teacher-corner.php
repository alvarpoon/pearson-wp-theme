<?php get_header_banner(); ?>
<div class="container">
	<div class="page-content-wrapper">
		<div class="page-general-info">
			<?php
				$display_title = get_field('display_title');
				
				if(empty($display_title)){
					$display_title = get_the_title($post->ID);
				}
			?>
			<h1 class="pageTitle"><?=$display_title?></h1>
			<div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
				<?php
					if(function_exists('bcn_display'))
					{
						bcn_display();
					}
				?>
			</div>
			<div class="page-description">
				<?php 
					$content = apply_filters('the_content', $post->post_content); 
					echo $content;
				?>
			</div>
		</div>
		
		<div class="page-content-container row">
			<?php
				
				//$sitemap = get_field('sitemap');
				
				if( have_rows('sitemap') ):
					$count = 0;
					
					
					// loop through the rows of data
					while ( have_rows('sitemap') ) : the_row();
				
						// display a sub field value
						$section_header = get_sub_field('section_header');
						
						$child_links = get_sub_field('child_links');
						
						echo '<div class="list-item col-12 col-md-6 col-lg-4">';
						
						echo '<div class="list-title">'.$section_header.'</div>';
						
						if($child_links){
						
							echo '<ul>';
							
							foreach($child_links as $child_link):
								$child_link_id = $child_link->ID;
							
								echo '<li><a href="'.esc_url( get_permalink( $child_link_id ) ).'">'.get_the_title($child_link_id).'</a></li>';
							
							endforeach;
							
							echo '</ul>';
						
						}
						
						echo '</div>';
						
						$count++;
						
						if($count%2 == 0 && $count != 0){
							echo '<div class="clearfix hidden-xs hidden-sm hidden-lg hidden-xl"></div>';
						}
						
						if($count%3 == 0 && $count != 0){
							echo '<div class="clearfix hidden-xs hidden-sm hidden-md "></div>';
						}
				
					endwhile;				
				
				endif;
			?>
		</div>
	</div>
</div>
