<?php //the_content(); ?>
<?php //wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>

<?php
	$all_resources = get_all_resource_page();
	
	get_header_banner();
	
	$pageID = get_the_ID();
?>
<script>
	var pageID = '<?=$pageID?>';
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
					if(function_exists('custom_breadcrumbs'))
					{
						custom_breadcrumbs();
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
		<div class="filter-wrapper clearfix">	
			<div class="col-md-9 filter-select">
				<div class="clearfix" id="filter_select_container">
					<?php
						$all_cat = get_all_resource_category($pageID,0,'all_resource_grid');
					
						$reference_id = $pageID;
						
						$filter_dependence = get_field('filter_dependence', $reference_id);
						if(empty($filter_dependence)){
							$filter_dependence = 0;
						}
						
						$dependence_filter_title = get_field('dependence_filter_title', $reference_id);
						
						$filter_title_1 = get_field('filter_title_1', $reference_id);
						$filter_1 = get_field('filter_1', $reference_id);
						
						
						$filter_title_2 = get_field('filter_title_2', $reference_id);
						$filter_2 = get_field('filter_2', $reference_id);
						
						
						$filter_title_3 = get_field('filter_title_3', $reference_id);
						$filter_3 = get_field('filter_3', $reference_id);
						
						$filter_1_count = is_array( $filter_1 ) ? count( $filter_1 ) : 0;
						$filter_2_count = is_array( $filter_2 ) ? count( $filter_2 ) : 0;
						$filter_3_count = is_array( $filter_3 ) ? count( $filter_3 ) : 0;
						
					?>
					
					<script type="text/javascript">						
						
						var filter_dependence = <?=$filter_dependence?>;
						
						var filter2_title = '<?=$dependence_filter_title?>';
						
					</script>
					<?php
						if($filter_1_count > 0 && !empty($filter_title_1)):
							echo '<div class="filter-item">';
						
							echo '<select id="filter_1" class="resource_filtering" data-filter="1">';
							
							echo '<option value="0">'.$filter_title_1.'</option>';
								foreach($filter_1 as $f1):
									$term = get_term_by('id', $f1, 'resource_category');
									$name = $term->name;
									if (in_array($f1, $all_cat)) {
										echo '<option value="'.$f1.'">'.$name.'</option>';
									}
								endforeach;		
							echo '</select>';
							
							echo '</div>';
							
						endif;

						echo '<div class="filter-item" id="filter_2_container">';
						if(!$filter_dependence && $filter_2_count > 0 && !empty($filter_title_2)):
						
							echo '<select id="filter_2" class="resource_filtering" data-filter="2">';
							
							echo '<option value="0">'.$filter_title_2.'</option>';
								foreach($filter_2 as $f2):
									$term = get_term_by('id', $f2, 'resource_category');
									$name = $term->name;
									if (in_array($f2, $all_cat)) {
										echo '<option value="'.$f2.'">'.$name.'</option>';
									}
								endforeach;	
							echo '</select>';
							
						endif;
						echo '</div>';
						
						if($filter_3_count > 0 && !empty($filter_title_3)):
						
							echo '<div class="filter-item">';
							
							echo '<select id="filter_3" class="resource_filtering" data-filter="3">';
							echo '<option value="0">'.$filter_title_3.'</option>';
								foreach($filter_3 as $f3):
									$term = get_term_by('id', $f3, 'resource_category');
									$name = $term->name;
									if (in_array($f3, $all_cat)) {
										echo '<option value="'.$f3.'">'.$name.'</option>';
									}
									
								endforeach;	
								
							echo '</select>';
							
							echo '</div>';
						
						endif;
					?>
				</div>
			</div>
			<div class="col-md-3 view-option-wrapper">
				<div class="view-option clearfix">
					<?php 
					$alternative_view = get_field('alternative_view');
						
					if(!empty($alternative_view)):
					?>
					<a href="<?=$alternative_view?>" class="btn_list"><?=__('List', 'Pearson-master');?></a>
					<a href="javascript:;" class="btn_grid active"><?=__('Grid', 'Pearson-master');?></a>
					
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="resource-container clearfix">
			<div class="loading-box"></div>
		<?php
				
				//$resources = get_field('resources', $resource_list[0]->ID); 
				
				/*$url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				$parts = parse_url($url);
				parse_str($parts['query'], $query);
				$page = $query['page'];*/
				
				if(empty($page)){
					$page = 1;
				}
				
				$resource_count      = 0;
				$resources_per_page  = 40; // How many features to display on each page
				$total              = is_array( $all_resources ) ? count( $all_resources ) : 0;
				$pages              = ceil( $total / $resources_per_page );
				$min                = ( ( $page * $resources_per_page ) - $resources_per_page ) + 1;
				$max                = ( $min + $resources_per_page ) - 1;
				
		?>
				
				<script>
					//var resource_listID = '<? //=$resource_list[0]->ID?>';
					var currentPageNum = '<?=$page?>';
					//console.log('resource_listID: '+resource_listID);
				</script>
				
		<?php
				echo '<div class="resource-container-inner">';
				
				$separator_count = 0;
				
					
				foreach ($all_resources as $resource):
					$resource_parent = $resource['pageid'];
					$resource_id = $resource['resource_id'];
					
					$resource_type = get_field('resource_type', $resource_id);
					$resource_display_title = get_field('display_title', $resource_id);
					$resource_thumbnail = get_the_post_thumbnail_url($resource_id,'full');
					$note = get_field('note', $resource_id);
					$resource_popup_image = get_field('resource_popup_image', $resource_id);
					$resource_popup_url = get_field('resource_popup_url', $resource_id);
					$downloads = get_field('downloads', $resource_id);
					//$download_count = is_array( $downloads ) ? count( $downloads ) : 0;
					$download_count = getDownload_count($resource_id);
					
					$resource_post = get_post($resource_id); 
					$resource_slug = $resource_post->post_name;
					
					//$filetype = wp_check_filetype('image.jpg');
					//echo $filetype['ext'];
					
					$resource_count++;
					// Ignore this feature if $feature_count is lower than $min
					if($resource_count < $min) { continue; }
					// Stop loop completely if $feature_count is higher than $max
					if($resource_count > $max) { break; } 
			?>
					<div class="col-xs-6 col-sm-3 col-md-3 resource-item">
						<div class="resource-thumbnail">
							<?php
								//echo '<p>file type: '.get_main_download_file($resource_id).'</p>';
							
								echo showGridThumbnail($resource_id, $resource_thumbnail, $resource_type, $resource_popup_image['url'], $resource_popup_url, $resource_slug);
								echo get_audio_preview(get_field('downloads', $resource_id));
							?>
						</div>
						<div class="resource-title-wrapper">
							<div class="resource-title">
								<?php echo showListTitle($resource_id, $resource_type, $resource_popup_image['url'], $resource_popup_url, $resource_slug);?>
							</div>
							<?php if(!empty($note)){ ?>
							<div class="resource-note">
								<a class="icon-note" data-fancybox data-src="#<?=$resource_slug.'-note'?>" href="javascript:;"></a>
								<div id="<?=$resource_slug.'-note'?>" class="hidden-content fancybox-content file-download"><?=$note?>	</div>
							</div>
							<?php } ?>
						</div>
						<div class="resource-type"><?php echo get_the_title($resource_parent);?></div>
						<div class="resource-download-wrapper clearfix">
							<?php
								if($download_count > 1){ ?>
									<div class="multiple_download hidden-xs hidden-sm">
										<div class="multiple_dl_header"><span><?=__('Download', 'Pearson-master');?> (<?=$download_count?>)</span></div>
										<div class="multiple_dl_content">
											<ul>
											<?php	
											$downloadable_file_arr = array();
											
											if( have_rows('downloads', $resource_id) ){
												while( have_rows('downloads', $resource_id) ): the_row();
													$file_title = get_sub_field('file_title');
													$downloadable_file = get_sub_field('downloadable_file');
													$set_as_main_download_file = get_sub_field('set_as_main_download_file');
													$preview_only = get_sub_field('preview_only');
													
													if(!$preview_only){
														echo '<li><a href="'.get_template_directory_uri().'/templates/download.php?file='.$downloadable_file['ID'].'&pageid='.$resource_parent.'" target="_blank">'.$file_title.'</a></li>';
														
														//echo '<li><a href="'.(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . '://'.$_SERVER['SERVER_NAME'].'?pageaction=filedownload&file='.$downloadable_file['ID'].'&pageid='.$resource_parent.'" target="_blank">'.$file_title.'</a></li>';
														//echo '<li><a href="'.$downloadable_file['url'].'" target="_blank">'.$file_title.'</a></li>';
														
														array_push($downloadable_file_arr, $downloadable_file['url']);
													}
													
													unset($file_title);
													unset($downloadable_file);
													unset($file_type);
													unset($preview_only);
												endwhile;
												
												$downloadable_file_string = implode(',',$downloadable_file_arr);
												
												echo '<li><a href="javascript:;" data-file="'.$downloadable_file_string.'" data-filename="download" class="createzip">'.__('Download All', 'Pearson-master').' ('.$download_count.__(' files', 'Pearson-master').')</a></li>';
												
												unset($downloadable_file_arr);
												unset($downloadable_file_string);
											}?>
											</ul>
										</div>
									</div>
									<?php
									if( current_user_can('manage_options') ):
										$resource_link = get_edit_post_link( $resource_id );
										echo '<a href="'.$resource_link.'" class="btn_resource_edit edit_element">Edit</a>';
									endif;
									?>
								
									<div class="hidden-md hidden-lg">
										<div class="mobile_download_wrapper">
											
												<?php 
												$downloadable_file_arr = array();
												
												if( have_rows('downloads', $resource_id) ){
												
													echo '<select class="mobile_download">';
													echo '<option value="default">Please select</option>';
													while( have_rows('downloads', $resource_id) ): the_row();
														$file_title = get_sub_field('file_title');
														$downloadable_file = get_sub_field('downloadable_file');
														$file_type = get_sub_field('file_type');
														$preview_only = get_sub_field('preview_only');
														if(!$preview_only){
															//echo '<a href="'.$downloadable_file['url'].'" class="media-file '.$file_type.'" target="_blank">'.$file_title.'</a>';
															echo '<option value="'.get_template_directory_uri().'/templates/download.php?file='.$downloadable_file['ID'].'&pageid='.$post->ID.'">'.$file_title.'</option>';
															
															//echo '<option value="'.(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . '://'.$_SERVER['SERVER_NAME'].'?pageaction=filedownload&file='.$downloadable_file['ID'].'&pageid='.$resource_parent.'">'.$file_title.'</option>';
															
															array_push($downloadable_file_arr, $downloadable_file['url']);
														}
														
														unset($file_title);
														unset($downloadable_file);
														unset($file_type);
														unset($preview_only);
													endwhile;
													
													$downloadable_file_string = implode(',',$downloadable_file_arr);
													
													if(sizeof($downloadable_file_arr) > 1){
														echo '<option data-file="'.$downloadable_file_string.'" data-filename="download" value="createzip">'.__('Download All', 'Pearson-master').' ('.$download_count.__(' files', 'Pearson-master').')</option>';
													}
													
													echo '</select>';
													
													echo '<div class="download_text">'.__('Download', 'Pearson-master').' ('.$download_count.')</div>';
													
													unset($downloadable_file_arr);
													unset($downloadable_file_string);
												}
												?>
												<!--<option>Download All</option>-->
										</div>
									</div>
							<?php
								}else{
									if( have_rows('downloads', $resource_id) ){
										while( have_rows('downloads', $resource_id) ): the_row();
											$downloadable_file = get_sub_field('downloadable_file');
											$preview_only = get_sub_field('preview_only');
											if(!$preview_only){
												//echo '<a href="'.$downloadable_file['url'].'" class="btn_single_download" target="_blank">Download</a>';
												echo '<a href="'.get_template_directory_uri().'/templates/download.php?file='.$downloadable_file['ID'].'&pageid='.$resource_parent.'" class="btn_single_download" target="_blank">'.__('Download', 'Pearson-master').'</a>';
												
												//echo '<a href="'.(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . '://'.$_SERVER['SERVER_NAME'].'?pageaction=filedownload&file='.$downloadable_file['ID'].'&pageid='.$resource_parent.'" class="btn_single_download" target="_blank">'.__('Download', 'Pearson-master').'</a>';
											}
											
											//unset($file_title);
											unset($downloadable_file);
											//unset($file_type);
											unset($preview_only);
										endwhile;
									}
									
									if( current_user_can('manage_options') ):
										$resource_link = get_edit_post_link( $resource_id );
										echo '<a href="'.$resource_link.'" class="btn_resource_edit edit_element">Edit</a>';
									endif;
								}
							?>
						</div>
						<?php if($resource_type == 'article-file') {?>
						<div id="<?=$resource_slug.'-content'?>" class="hidden-content fancybox-content article-lightbox">
							<h3><?=$resource_display_title;?></h3>
							<div class="article-content">
								<div class="media-container">
									<?php 
									$downloadable_file_arr = array();
									
									if( have_rows('downloads', $resource_id) ){
										while( have_rows('downloads', $resource_id) ): the_row();
											$file_title = get_sub_field('file_title');
											$downloadable_file = get_sub_field('downloadable_file');
											$file_type = get_sub_field('file_type');
											$file_extension = strtolower(substr(strrchr($downloadable_file['url'],"."),1));
											$preview_only = get_sub_field('preview_only');
											if(!$preview_only){
												echo get_file_thumbnail_listing($file_type, $file_extension, $downloadable_file, $file_title, $resource_parent);
												array_push($downloadable_file_arr, $downloadable_file['url']);
											}
											
											unset($file_title);
											unset($downloadable_file);
											unset($file_type);
											unset($file_extension);
											unset($preview_only);
										endwhile;
										
										$downloadable_file_string = implode(',',$downloadable_file_arr);
								
										if(sizeof($downloadable_file_arr) > 1){
											echo '<a href="javascript:;" data-file="'.$downloadable_file_string.'" data-filename="download" class="media-file all createzip">'.__('Download All', 'Pearson-master').'</a>';
										}
										
										unset($downloadable_file_arr);
										unset($downloadable_file_string);
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
			<?php 
				
					$separator_count++;
					
					if($separator_count%2 == 0 && $separator_count != 0){
						echo '<div class="clearfix hidden-sm hidden-md hidden-lg hidden-xl"></div>';
					}
					
					if($separator_count%4 == 0 && $separator_count != 0){
						echo '<div class="clearfix hidden-xs"></div>';
					}
				
				endforeach; 
				echo '</div>';
			?>
			</div>
		</div>
		<div class="resource-footer">
			<div class="pagination clearfix">
				<!--<button class="btn_gopage_prev"></button>-->
				<select id="pagination-select">
					<?php
					
					for($i = 1; $i <= $pages; $i++){
						echo '<option val='.$i.'>'.$i.'</option>';
					}
					
					?>
				</select>
				<span>/<?=$pages?></span>
				<?php if($pages > 1){
					echo '<button class="btn_gopage_next"></button>';
				} ?>
			</div>
			
			<?php if( current_user_can('manage_options') ): ?>
		
			<div class="clearfix ">
				<div class="page_edit_links_container">
				<?php
		
					$page_link = get_edit_post_link( $pageID );
					echo '<a href="'.$page_link.'" class="edit_element">Edit page</a>';
					
					//$resource_list_link = get_edit_post_link( $resource_list[0]->ID );
					//echo '<a href="'.$resource_list_link.'" class="edit_element">Edit Resource list</a>';
					
					echo '<a href="javascript:;" class="edit_toggle" data-showtext="Show Edit button" data-hidetext="Hide Edit button">Hide Edit button</a>';
				?>
				</div>
			</div>
			
			<?php endif; ?>
		</div>
		
		
	</div>
</div>