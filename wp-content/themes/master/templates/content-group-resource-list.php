<?php //the_content(); ?>
<?php //wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>
<?php
	$resource_lists = get_field('resource_list');
	
	get_header_banner();
?>

<script>
	var pageID = '<?php echo get_the_ID(); ?>';
</script>

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
			<div class="page-description"><?php 
					$content = apply_filters('the_content', $post->post_content); 
					echo $content;
				?>
			</div>
		</div>
		<div class="filter-wrapper clearfix">	
			<div class="col-md-9 filter-select">
				<div class="clearfix">
					<div class="filter-item">
						<?php
							$filter_title_1 = get_field('filter_title_1');
							$filter_1 = get_field('filter_1');
							$filer_1_count = is_array( $filter_1 ) ? count( $filter_1 ) : 0;
							if($filer_1_count > 0 && !empty($filter_title_1)):
							
							echo '<select id="filter_1" class="resource_filtering">';
							echo '<option value="0">'.$filter_title_1.'</option>';
								foreach($filter_1 as $f1):
									$term = get_term_by('id', $f1, 'resource_category');
									$name = $term->name;
									
									echo '<option value="'.$f1.'">'.$name.'</option>';
								endforeach;	
								
							echo '</select>';
							
							endif;
						?>
					</div>
					<div class="filter-item">
						<?php 
							$filter_title_2 = get_field('filter_title_2');
							$filter_2 = get_field('filter_2');
							$filter_2_count = is_array( $filter_2 ) ? count( $filter_2 ) : 0;
							if($filter_2_count > 0 && !empty($filter_title_2)):
							
							echo '<select id="filter_2" class="resource_filtering">';
							echo '<option value="0">'.$filter_title_2.'</option>';
								foreach($filter_2 as $f2):
									$term = get_term_by('id', $f2, 'resource_category');
									$name = $term->name;
									
									echo '<option value="'.$f2.'">'.$name.'</option>';
								endforeach;	
								
							echo '</select>';
							
							endif;
						?>
					</div>
					<div class="filter-item">
						<?php 
							$filter_title_3 = get_field('filter_title_3');
							$filter_3 = get_field('filter_3');
							$filter_3_count = is_array( $filter_3 ) ? count( $filter_3 ) : 0;
							if($filter_3_count > 0 && !empty($filter_title_3)):
							
							echo '<select id="filter_3" class="resource_filtering">';
							echo '<option value="0">'.$filter_title_3.'</option>';
								foreach($filter_3 as $f3):
									$term = get_term_by('id', $f3, 'resource_category');
									$name = $term->name;
									
									echo '<option value="'.$f3.'">'.$name.'</option>';
								endforeach;	
								
							echo '</select>';
							
							endif;
						?>
					</div>
				</div>
			</div>
			<div class="col-md-3 view-option-wrapper">
				<div class="view-option clearfix">
					<?php 
					$alternative_view = get_field('alternative_view');
						
					if(!empty($alternative_view)):
					?>
					<a href="javascript:;" class="btn_list active"><?=__('List', 'Pearson-master');?></a>
					<a href="<?=$alternative_view?>" class="btn_grid"><?=__('Grid', 'Pearson-master');?></a>
					
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="loading-box"></div>
		<div class="group-resource-container">
		
		<?php
			foreach($resource_lists as $resource_list):
			
				echo '<div class="resource-container clearfix">';
							
				echo '<div class="group-title">'.get_the_title($resource_list->ID).'</div>';
				
				echo '<div class="clearfix resource-header">';
					echo '<div class="col-xs-9 col-sm-10 col-md-5 no-padding">'.__('Items', 'Pearson-master').'</div>';
					echo '<div class="col-xs-3 col-sm-2 col-md-7 no-padding">'.__('Download', 'Pearson-master').'</div>';
				echo '</div>';
				
				$resources = get_field('resources', $resource_list->ID);
				
				echo '<div class="resource-container-inner">';
			
				foreach ($resources as $resource):
					$resource_id = $resource->ID;
					$resource_type = get_field('resource_type', $resource_id);
					$note = get_field('note', $resource_id);
					$resource_popup_image = get_field('resource_popup_image', $resource_id);
					$resource_popup_url = get_field('resource_popup_url', $resource_id);
					$downloads = get_field('downloads', $resource_id);
					//$download_count = is_array( $downloads ) ? count( $downloads ) : 0;
					$download_count = getDownload_count($resource_id);
					
					$resource_post = get_post($resource_id); 
					$resource_slug = $resource_post->post_name; ?>
					
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
											<!--<div class="resource-type"><? //=$resource_type?></div>-->
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
							$downloadable_file_arr = array();
							
							if( have_rows('downloads', $resource_id) ){
								while( have_rows('downloads', $resource_id) ): the_row();
									$file_title = get_sub_field('file_title');
									$downloadable_file = get_sub_field('downloadable_file');
									$file_type = get_sub_field('file_type');
									$file_extension = strtolower(substr(strrchr($downloadable_file['url'],"."),1));
									$preview_only = get_sub_field('preview_only');
									
									//echo '<a href="'.$downloadable_file['url'].'" class="media-file '.$file_type.'" target="_blank">'.$file_title.'</a>';
									if(!$preview_only){
										switch($file_type){
											case 'image':
											case 'video':
												echo '<a href="'.get_template_directory_uri().'/templates/download.php?file='.$downloadable_file['ID'].'&pageid='.$post->ID.'" class="media-file '.$file_extension.'" target="_blank" title="'.$file_title.'">'.$file_title.'</a>';		
												break;
											default:
												echo '<a href="'.get_template_directory_uri().'/templates/download.php?file='.$downloadable_file['ID'].'&pageid='.$post->ID.'" class="media-file '.$file_type.'" target="_blank" title="'.$file_title.'">'.$file_title.'</a>';
												break;
										}
										array_push($downloadable_file_arr, $downloadable_file['url']);
									}
									
									unset($file_title);
									unset($downloadable_file);
									unset($file_type);
									unset($file_extension);
									unset($preview_only);
								endwhile;
								
								$downloadable_file_string = implode(',',$downloadable_file_arr);
								
								echo '<a href="javascript:;" data-file="'.$downloadable_file_string.'" data-filename="download" class="media-file all createzip">'.__('Download All', 'Pearson-master').'</a>';
								
								unset($downloadable_file_arr);
								unset($downloadable_file_string);
							}
							?>
						</div>
						
						<div class="hidden-md hidden-lg">
							<div class="mobile_download_wrapper">
								
									<?php 
									if( have_rows('downloads', $resource_id) ){
									
										echo '<select class="mobile_download">';
										
										while( have_rows('downloads', $resource_id) ): the_row();
											$file_title = get_sub_field('file_title');
											$downloadable_file = get_sub_field('downloadable_file');
											$file_type = get_sub_field('file_type');
											$preview_only = get_sub_field('preview_only');
											if(!$preview_only){
												//echo '<a href="'.$downloadable_file['url'].'" class="media-file '.$file_type.'" target="_blank">'.$file_title.'</a>';
												echo '<option value="'.get_template_directory_uri().'/templates/download.php?file='.$downloadable_file['ID'].'&pageid='.$post->ID.'">'.$file_title.'</option>';
											}
											
											unset($file_title);
											unset($downloadable_file);
											unset($file_type);
											unset($preview_only);
										endwhile;
										
										echo '</select>';
										echo '<div class="download_text">'.__('Download', 'Pearson-master').'</div>';
									}
									?>
									<!--<option>Download All</option>-->
								
								
							</div>
						</div>
						<?php else:
							if( have_rows('downloads', $resource_id) ):
								while( have_rows('downloads', $resource_id) ): the_row();
									$file_title = get_sub_field('file_title');
									$downloadable_file = get_sub_field('downloadable_file'); 
									$file_type = get_sub_field('file_type');
									$file_extension = strtolower(substr(strrchr($downloadable_file['url'],"."),1));
									$preview_only = get_sub_field('preview_only');
									if(!$preview_only){
										echo '<div class="hidden-xs hidden-sm">';
									
										switch($file_type){
											case 'image':
											case 'video':
												echo '<a href="'.get_template_directory_uri().'/templates/download.php?file='.$downloadable_file['ID'].'&pageid='.$post->ID.'" class="media-file '.$file_extension.'" target="_blank" title="'.$file_title.'">'.$file_title.'</a>';		
												break;
											default:
												echo '<a href="'.get_template_directory_uri().'/templates/download.php?file='.$downloadable_file['ID'].'&pageid='.$post->ID.'" class="media-file '.$file_type.'" target="_blank" title="'.$file_title.'">'.$file_title.'</a>';
												break;
										}									
										echo '</div>';
										
										echo '<div class="hidden-md hidden-lg">';
										//echo '<a href="'.$downloadable_file['url'].'" class="media-file all" target="_blank">Download</a>';
										echo '<a href="'.get_template_directory_uri().'/templates/download.php?file='.$downloadable_file['ID'].'&pageid='.$post->ID.'" class="media-file all" target="_blank">'.__('Download', 'Pearson-master').'</a>';
										echo '</div>'; 
									}
									
									unset($file_title);
									unset($downloadable_file);
									unset($file_type);
									unset($file_extension);
									unset($preview_only);
						 
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
											$file_extension = strtolower(substr(strrchr($downloadable_file['url'],"."),1));
											$preview_only = get_sub_field('preview_only');
											if(!$preview_only){
												switch($file_type){
													case 'image':
													case 'video':
														echo '<a href="'.get_template_directory_uri().'/templates/download.php?file='.$downloadable_file['ID'].'&pageid='.$post->ID.'" class="media-file '.$file_extension.'" target="_blank" title="'.$file_title.'">'.$file_title.'</a>';		
														break;
													default:
														echo '<a href="'.get_template_directory_uri().'/templates/download.php?file='.$downloadable_file['ID'].'&pageid='.$post->ID.'" class="media-file '.$file_type.'" target="_blank" title="'.$file_title.'">'.$file_title.'</a>';
														break;
												}
											}
											
											unset($file_title);
											unset($downloadable_file);
											unset($file_type);
											unset($file_extension);
											unset($preview_only);
										endwhile;
									}									
									?>
								</div>
								<div class="clearfix">
									<?php //if(!empty($resource_thumbnail)){ ?>
										<!--<div class="img-container"><img src="<? //=$resource_thumbnail?>" class="img-responsive" /></div>-->
										<?php //} ?>
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
			echo '</div>';
			
		echo '</div>';
		
		echo '<div class="resource-footer">';
			
		echo '<div class="download_all">';
		
		$download_all = get_field('download_all',$resource_list->ID);
		
		
		if(!empty($download_all)):
			echo '<a href="'.get_template_directory_uri().'/templates/download.php?file='.$download_all['ID'].'&pageid='.$post->ID.'" class="btn_single_download" target="_blank">'.__('Download All').'</a>';
		endif;

		echo '</div>';
		
		echo '</div>';
			
		endforeach;
		?>
		</div>
	</div>
</div>