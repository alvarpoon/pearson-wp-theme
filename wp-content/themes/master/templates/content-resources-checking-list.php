<?php //if( current_user_can('administrator') ): 	
	if( current_user_can('manage_options') ){
?>
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
						if ( function_exists('icl_object_id') ) {
							$lang_arr = icl_get_languages('skip_missing=1&orderby=id&order=desc');
							
							if(sizeof($lang_arr) > 1){
								echo '<div class="filter-item">';
									echo '<select id="filter_1" class="resource_filtering">';
										echo '<option value="">All Language</option>';
										foreach( $lang_arr as $lang ){
											//print_r($lang);
											$selected = ($lang['code'] == ICL_LANGUAGE_CODE) ? "selected=selected":"";
										  echo '<option value="'.$lang['url'].'" '.$selected.'>'.$lang['native_name'].'</option>';
										}
									echo '</select>';							
								echo '</div>';
							}
						}
						
						$query_rl = new WP_Query(array(
							'post_type' => 'resourcelist',
							'post_status' => 'publish',
							'posts_per_page' => -1,
							'post_status'      => 'publish',
							'suppress_filters' => false
						));
						
						
						echo '<div class="filter-item">';
						echo '<select id="filter_2" class="resource_filtering">';
						echo '<option value="">All Resource List</option>';
						while ($query_rl->have_posts()) {
							$query_rl->the_post();
							$post_id = get_the_ID();
							$selected = ($_GET['resource_list'] == $post_id) ? "selected=selected":"";
							//Title
							$title = get_the_title();
							echo '<option value="'.$post_id.'" '.$selected.'>'.$title.'</option>';
						}		
						wp_reset_query();
						echo '</select>';							
						echo '</div>';
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="checking-list-wrapper">
	<div class="resource-checking-list table-responsive">
		<table>
			<col width="8%">
			<col width="8%">
			<col width="9.5%">
			<col width="9%">
			<col width="9%">
			<col width="13.6%">
			<col width="13.6%">
			<col width="25%">
			<col width="4.3%">
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
			
				if (isset($_GET['resource_list'])) {
					//echo $_GET['resource_list'];
					$select_resource_list = $_GET['resource_list'];
					$resources = get_field('resources', $select_resource_list);
					
					foreach ($resources as $resource):
						$post_id = $resource->ID;
					
					
						echo '<tr>';
						
						//Title
						$title = get_the_title($post_id);
						echo '<td>'.$title.'</td>';
						
						//Display Title
						$display_title = get_field('display_title', $post_id);
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
						$resource_type = get_field('resource_type', $post_id);
						echo '<td>'.$resource_type.'</td>';
						
						//resource content
						/*$content = get_the_content();
						echo '<td>'.$content.'</td>';*/
						
						//Feature Image
						echo '<td>';
						//echo get_the_post_thumbnail($post_id, 'thumbnail');
						echo '<img width="60" height="60" src="'.get_the_post_thumbnail_url($post_id, 'thumbnail').'" class="attachment-thumbnail size-thumbnail wp-post-image" alt="">';
						echo '</td>';
						
						//resource_popup_image
						$resource_popup_image = get_field('resource_popup_image', $post_id);
						echo '<td><a href="'.$resource_popup_image['url'].'" target="_blank">'.$resource_popup_image['url'].'</a></td>';
						
						//Resource popup url
						$resource_popup_url = get_field('resource_popup_url', $post_id);
						echo '<td><a href="'.$resource_popup_url.'" target="_blank">'.$resource_popup_url.'</a></td>';
						
						//Downloads
						$downloads = get_field('downloads', $post_id);
						echo '<td>';
						if( have_rows('downloads', $post_id) ){
							echo '<table>';
							echo '<col width="18%">';
							echo '<col width="30%">';
							echo '<col width="52%">';
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
						echo '<td><a href="'.$resource_link.'" class="edit_element">Edit</a></td>';
						
						echo '</tr>';
					
					endforeach;
					
				} else {
					$query = new WP_Query(array(
						'post_type' => 'resource',
						'post_status' => 'publish',
						'posts_per_page' => -1,
						'post_status'      => 'publish',
						'suppress_filters' => false
					));
					
					
					while ($query->have_posts()) {
						$query->the_post();
						$post_id = get_the_ID();
						
						echo '<tr>';
						
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
						//the_post_thumbnail('thumbnail');
						echo '<img width="60" height="60" src="'.get_the_post_thumbnail_url($post_id, 'thumbnail').'" class="attachment-thumbnail size-thumbnail wp-post-image" alt="">';
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
							echo '<col width="18%">';
							echo '<col width="30%">';
							echo '<col width="52%">';
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
						echo '<td><a href="'.$resource_link.'" class="edit_element">Edit</a></td>';
						
						echo '</tr>';
					}
					
					wp_reset_query();
					
				}
			?>
		</table>
		<div class="clearfix ">
			<div class="page_edit_links_container">
			<?php
	
				/*$page_link = get_edit_post_link( $pageID );
				echo '<a href="'.$page_link.'" class="edit_element">Edit page</a>';
				
				$resource_list_link = get_edit_post_link( $resource_list[0]->ID );
				echo '<a href="'.$resource_list_link.'" class="edit_element">Edit Resource list</a>';*/
				
				echo '<a href="javascript:;" class="edit_toggle" data-showtext="Show Edit button" data-hidetext="Hide Edit button">Hide Edit button</a>';
			?>
			</div>
		</div>
	</div>
</div>
<?php }else{
	echo '<META HTTP-EQUIV=REFRESH CONTENT="0; '.home_url().'">';
}?>