<?php //the_content(); ?>
<?php if( current_user_can('administrator') ): ?>
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
		</div>
		<div class="filter-wrapper clearfix">	
			<div class="filter-select">
				<div class="clearfix">
					<?php
						/*echo '<div class="filter-item">';
						echo '<select id="filter_1" class="resource_filtering" data-filter="1">';
						echo '<option value="0">All Language</option>';
						echo '</select>';							
						echo '</div>';
						
						echo '<div class="filter-item">';
						echo '<select id="filter_1" class="resource_filtering" data-filter="1">';
						echo '<option value="0">All Resource List</option>';
						echo '</select>';							
						echo '</div>';*/
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="checking-list-wrapper">
	<div class="resource-checking-list">
		<table>
			<col width="120">
			<col width="120">
			<col width="140">
			<col width="120">
			<col width="120">
			<col width="200">
			<col width="200">
			<col width="400">
			<col width="50">
			<tr class="border-bottom">
				<th>Title</th>
				<th>Display Title</th>
				<th>Category Slug</th>
				<th>Resource type</th>
				<!--<th>Content</th>-->
				<th>Feature Image</th>
				<th>resource_popup_image</th>
				<th>resource_popup_url</th>
				<th>Downloads</th>
				<!--<th>Note</th>-->
				<th>Edit</th>
			</tr>
			<?php
				//$all_resources = get_all_resource_page();
				$query = new WP_Query(array(
					'post_type' => 'resource',
					'post_status' => 'publish',
					'posts_per_page' => -1
				));
				
				
				while ($query->have_posts()) {
					echo '<tr>';
					
					
				
					$query->the_post();
					$post_id = get_the_ID();
					
					//Title
					$title = get_the_title();
					echo '<td>'.$title.'</td>';
					
					//Display Title
					$display_title = get_field('display_title');
					echo '<td>'.$display_title.'</td>';
					
					//Category Slug
					$categories = get_the_terms( $post_id, 'resource_category');
					echo '<td>';
					foreach($categories as $key => $category){
						if($key < count($categories)-1){
							$comma_text = ', ';
						}else{
							$comma_text = '';
						}
						echo $category->slug.$comma_text;
					}
					echo '</td>';
					
					//Resource type
					$resource_type = get_field('resource_type');
					echo '<td>'.$resource_type.'</td>';
					
					//resource content
					/*$content = get_the_content();
					echo '<td>'.$content.'</td>';*/
					
					//Feature Image
					echo '<td>';
					the_post_thumbnail('thumbnail');
					echo '</td>';
					
					//resource_popup_image
					$resource_popup_image = get_field('resource_popup_image');
					echo '<td><a href="'.$resource_popup_image['url'].'" target="_blank">'.$resource_popup_image['url'].'</a></td>';
					
					//Resource popup url
					$resource_popup_url = get_field('resource_popup_url');
					echo '<td><a href="'.$resource_popup_url.'" target="_blank">'.$resource_popup_url.'</a></td>';
					
					//Downloads
					$downloads = get_field('downloads');
					echo '<td>';
					if( have_rows('downloads', $post_id) ){
						echo '<table>';
						echo '<col width="10%">';
						echo '<col width="30%">';
						echo '<col width="60%">';
						$count = 0;
						while( have_rows('downloads', $post_id) ): the_row();
							$count++;
							$file_title = get_sub_field('file_title');
							$downloadable_file = get_sub_field('downloadable_file');
							$file_type = get_sub_field('file_type');
							$external_link = get_sub_field('external_link');
							$audio_preview = get_sub_field('audio_preview');
							$preview_only = get_sub_field('preview_only');
							$set_as_main_download_file = get_sub_field('set_as_main_download_file');
						
							echo '<tr>';
								echo '<td rowspan="8">File '.$count.'</td>';
							echo '</tr>';
						
							echo '<tr>';
								echo '<td>File title:</td>';								
								echo '<td>'.$file_title.'</td>';
							echo '</tr>';
							
							echo '<tr>';								
								echo '<td>downloadable_file:</td>';								
								echo '<td><a href="'.$downloadable_file['url'].'" target="_blank">'.$downloadable_file['url'].'</a></td>';
							echo '</tr>';
								
							echo '<tr>';								
								echo '<td>file_type:</td>';								
								echo '<td>'.$file_type.'</td>';
							echo '</tr>';
							
							echo '<tr>';								
								echo '<td>external_link:</td>';								
								echo '<td><a href="'.$external_link.'" target="_blank">'.$external_link.'</a></td>';
							echo '</tr>';
							
							echo '<tr>';								
								echo '<td>audio_preview:</td>';								
								echo '<td>'.$audio_preview.'</td>';
							echo '</tr>';
							
							echo '<tr>';								
								echo '<td>preview_only:</td>';								
								echo '<td>'.$preview_only.'</td>';
							echo '</tr>';
							
							echo '<tr>';								
								echo '<td>set_as_main_download_file:</td>';								
								echo '<td>'.$set_as_main_download_file.'</td>';
							echo '</tr>';
							
							unset($file_title);
							unset($downloadable_file);
							unset($file_type);
							unset($preview_only);
							
						endwhile;
						echo '</table>';
					}
					echo '</td>';
					
					//note
					/*$note = get_field('note');
					echo '<td>'.$note.'</td>';*/
					
					$resource_link = get_edit_post_link( $post_id );					
					echo '<td><a href="'.$resource_link.'">Edit</a></td>';
					
					echo '</tr>';
				}
				
				
					
				
				wp_reset_query();
			?>
		</table>
	</div>		
</div>
<?php endif;?>