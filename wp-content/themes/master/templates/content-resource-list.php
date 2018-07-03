<?php //the_content(); ?>
<?php //wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>
<?php
	$resource_list = get_field('resource_list');
?>
<div class="container-fluid">
	<div class="row">
		<div class="top-banner-container" style="background-image:url('<?=get_stylesheet_directory_uri()?>/assets/img/home/banner-top.png');">
			<img src="<?=get_stylesheet_directory_uri()?>/assets/img/home/banner-top.png" class="img-responsive hidden-xs hidden-sm hidden-md hidden-lg" />
		</div>
	</div>
</div>
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
			<nav aria-label="breadcrumb">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">Home</a></li>
				<li class="breadcrumb-item"><a href="#">Resource</a></li>
				<li class="breadcrumb-item active" aria-current="page">Template Here</li>
			  </ol>
			</nav>
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
							$filter_title_1 = get_field('filter_title_1', $resource_list[0]->ID);
							$filter_1 = get_field('filter_1', $resource_list[0]->ID);
							if(count($filter_1) > 0 && !empty($filter_title_1)):
							
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
							$filter_title_2 = get_field('filter_title_2', $resource_list[0]->ID);
							$filter_2 = get_field('filter_2', $resource_list[0]->ID);
							if(count($filter_2) > 0 && !empty($filter_title_2)):
							
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
							$filter_title_3 = get_field('filter_title_3', $resource_list[0]->ID);
							$filter_3 = get_field('filter_3', $resource_list[0]->ID);
							if(count($filter_3) > 0 && !empty($filter_title_3)):
							
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
					?>
					<a href="javascript:;" class="btn_list active">List</a>
					<a href="<?=$alternative_view?>" class="btn_grid">Grid</a>
				</div>
			</div>
		</div>
		<div class="resource-container clearfix">
			<div class="clearfix resource-header">
				<div class="col-xs-9 col-sm-10 col-md-5 no-padding">Items</div>
				<div class="col-xs-3 col-sm-2 col-md-7 no-padding">Download</div>
			</div>
			<?php
				
				$resources = get_field('resources', $resource_list[0]->ID);
				
				$url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				$parts = parse_url($url);
				parse_str($parts['query'], $query);
				$page = $query['page'];
				
				if(empty($page)){
					$page = 1;
				}
				
				$resource_count      = 0;
				$resources_per_page  = 20; // How many features to display on each page
				$total              = count( $resources );
				$pages              = ceil( $total / $resources_per_page );
				$min                = ( ( $page * $resources_per_page ) - $resources_per_page ) + 1;
				$max                = ( $min + $resources_per_page ) - 1;
				
		?>
				
				<script>
					var resource_listID = '<?=$resource_list[0]->ID?>';
					var currentPageNum = '<?=$page?>';
					//console.log('resource_listID: '+resource_listID);
				</script>
				
		<?php
				echo '<div class="resource-container-inner">';
				
				foreach ($resources as $resource):
					$resource_id = $resource->ID;
					$resource_type = get_field('resource_type', $resource_id);
					$note = get_field('note', $resource_id);
					$resource_popup_image = get_field('resource_popup_image', $resource_id);
					$resource_popup_url = get_field('resource_popup_url', $resource_id);
					$download_count = count(get_field('downloads', $resource_id));
					
					$resource_post = get_post($resource_id); 
					$resource_slug = $resource_post->post_name;
					
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
								
								echo '<a href="'.get_template_directory_uri().'/templates/download.php?file='.$downloadable_file['ID'].'&pageid='.$post->ID.'" class="media-file '.$file_type.'">'.$file_title.'</a>';
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
								echo '<a href="'.get_template_directory_uri().'/templates/download.php?file='.$downloadable_file['ID'].'&pageid='.$post->ID.'" class="media-file '.$file_type.'">'.$file_title.'</a>';
								echo '</div>';
								
								echo '<div class="hidden-md hidden-lg">';
								//echo '<a href="'.$downloadable_file['url'].'" class="media-file all" target="_blank">Download</a>';
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
				echo '</div>';
			?>
			
			
			<!--<div class="resource-item single-file clearfix">
				<div class="resource-title-wrapper col-xs-9 col-sm-10 col-md-5">
					<div class="clearfix">
						<table cellpadding="0" cellspacing="0" border="0" width="90%">
							<tr>
								<td class="title">
									<div class="resource-title-div">
										<div class="resource-title">A multiple sample files for download</div>
										<div class="resource-type">Category name</div>
									</div>
								</td>
							</tr>
						</table>
						<div class="resource-note">
							<a class="icon-note" data-fancybox data-src="#note-content" href="javascript:;"></a>
							<div id="note-content" class="hidden-content fancybox-content file-download">
								<h3>A single sample file for download</h3>
								<p>Optional description text for the content. The chief executive of a British company at the centre of allegations of electoral interference boasted about using "beautiful Ukrainian grils" to entrap the political opponents of clients. Alexander Nix was filmed saying that Cambridge Analytica would offer bribes to smear opponents</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-3 col-sm-2 col-md-7 file-download-wrapper no-padding">
					<div class="hidden-xs hidden-sm">
						<a href="#" class="media-file doc">Item 1</a>
					</div>
					<div class="hidden-md hidden-lg">
						<a href="#" class="media-file all">Download</a>
					</div>
				</div>
			</div>
			<div class="resource-item multiple-file clearfix">
				<div class="resource-title-wrapper col-xs-9 col-sm-10 col-md-5">
					<div class="clearfix">
						<table cellpadding="0" cellspacing="0" border="0" width="90%">
							<tr>
								<td class="title">
									<div class="resource-title-div">
										<div class="resource-title">A multiple sample files for download</div>
										<div class="resource-type">Category name</div>
									</div>
								</td>
								<td class="audio">
									<div class="audio_container two_audio">
										<div class="audio_playback" data-source="<?=get_stylesheet_directory_uri()?>/assets/img/common/surroundTestDTS.dts.wav"></div>
										<div class="audio_playback" data-source="<?=get_stylesheet_directory_uri()?>/assets/img/common/sample.wav"></div>
									</div>
								</td>
							</tr>
						</table>
						<div class="resource-note">
							<a class="icon-note" data-fancybox data-src="#note-content" href="javascript:;"></a>
							<div id="note-content" class="hidden-content fancybox-content file-download">
								<h3>A single sample file for download</h3>
								<p>Optional description text for the content. The chief executive of a British company at the centre of allegations of electoral interference boasted about using "beautiful Ukrainian grils" to entrap the political opponents of clients. Alexander Nix was filmed saying that Cambridge Analytica would offer bribes to smear opponents</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-3 col-sm-2 col-md-7 file-download-wrapper no-padding">
					<div class="hidden-xs hidden-sm">
						<a href="#" class="media-file doc">long item name here max 2 line</a>
						<a href="#" class="media-file ppt">Item 2</a>
						<a href="#" class="media-file pdf">Item 3</a>
						<a href="#" class="media-file wav">Item 4</a>
						<a href="#" class="media-file zip">Item 5</a>
						<a href="#" class="media-file all">All</a>
					</div>
					<div class="hidden-md hidden-lg">
						<div class="mobile_download_wrapper">
							<select class="mobile_download">
								<option>Item 1</option>
								<option>Item 2</option>
								<option>Item 3</option>
								<option>Item 4</option>
								<option>Item 5</option>
								<option>Download All</option>
							</select>
							<div class="download_text">Download</div>
						</div>
					</div>
				</div>
			</div>
			<div class="resource-item image-file clearfix">
				<div class="resource-title-wrapper col-xs-9 col-sm-10 col-md-5">
					<div class="clearfix">
						<table cellpadding="0" cellspacing="0" border="0" width="90%">
							<tr>
								<td class="title">
									<div class="resource-title-div">
										<div class="resource-title">An single Image file</div>
										<div class="resource-type">Category name</div>
									</div>
								</td>
								<td class="audio">
									<div class="audio_container two_audio">
										<div class="audio_playback" data-source="<?=get_stylesheet_directory_uri()?>/assets/img/common/surroundTestDTS.dts.wav"></div>
										<div class="audio_playback" data-source="<?=get_stylesheet_directory_uri()?>/assets/img/common/sample.wav"></div>
									</div>
								</td>
							</tr>
						</table>
						<div class="resource-note">
							<a class="icon-note" data-fancybox data-src="#note-content" href="javascript:;"></a>
							<div id="note-content" class="hidden-content fancybox-content file-download">
								<h3>A single sample file for download</h3>
								<p>Optional description text for the content. The chief executive of a British company at the centre of allegations of electoral interference boasted about using "beautiful Ukrainian grils" to entrap the political opponents of clients. Alexander Nix was filmed saying that Cambridge Analytica would offer bribes to smear opponents</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-3 col-sm-2 col-md-7 file-download-wrapper no-padding">
					<div class="hidden-xs hidden-sm">
						<a href="#" class="media-file doc">long item name here max 2 line</a>
						<a href="#" class="media-file ppt">Item 2</a>
						<a href="#" class="media-file pdf">Item 3</a>
						<a href="#" class="media-file wav">Item 4</a>
						<a href="#" class="media-file zip">Item 5</a>
						<a href="#" class="media-file all">All</a>
					</div>
					<div class="hidden-md hidden-lg">
						<div class="mobile_download_wrapper">
							<select class="mobile_download">
								<option>Item 1</option>
								<option>Item 2</option>
								<option>Item 3</option>
								<option>Item 4</option>
								<option>Item 5</option>
								<option>Download All</option>
							</select>
							<div class="download_text">Download</div>
						</div>
					</div>
				</div>
			</div>
			<div class="resource-item image-file clearfix">
				<div class="resource-title-wrapper col-xs-9 col-sm-10 col-md-5">
					<div class="clearfix">
						<table cellpadding="0" cellspacing="0" border="0" width="90%">
							<tr>
								<td class="title">
									<div class="resource-title-div">
										<div class="resource-title">A multiple sample files for download</div>
										<div class="resource-type">Category name</div>
									</div>
								</td>
								<td class="audio">
									<div class="audio_container">
										<div class="audio_playback" data-source="<?=get_stylesheet_directory_uri()?>/assets/img/common/surroundTestDTS.dts.wav"></div>
									</div>
								</td>
							</tr>
						</table>
						<div class="resource-note">
							<a class="icon-note" data-fancybox data-src="#note-content" href="javascript:;"></a>
							<div id="note-content" class="hidden-content fancybox-content file-download">
								<h3>A single sample file for download</h3>
								<p>Optional description text for the content. The chief executive of a British company at the centre of allegations of electoral interference boasted about using "beautiful Ukrainian grils" to entrap the political opponents of clients. Alexander Nix was filmed saying that Cambridge Analytica would offer bribes to smear opponents</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-3 col-sm-2 col-md-7 file-download-wrapper no-padding">
					<div class="hidden-xs hidden-sm">
						<a href="#" class="media-file jpg">Item 1</a>
						<a href="#" class="media-file wav">Item 2</a>
						<a href="#" class="media-file all">All</a>
					</div>
					<div class="hidden-md hidden-lg">
						<div class="mobile_download_wrapper">
							<select class="mobile_download">
								<option>Item 1</option>
								<option>Item 2</option>
								<option>Item 3</option>
								<option>Item 4</option>
								<option>Item 5</option>
								<option>Download All</option>
							</select>
							<div class="download_text">Download</div>
						</div>
					</div>
				</div>
			</div>
			<div class="resource-item video-file clearfix">
				<div class="resource-title-wrapper col-xs-9 col-sm-10 col-md-5">
					<div class="clearfix">
						<table cellpadding="0" cellspacing="0" border="0" width="90%">
							<tr>
								<td class="title">
									<div class="resource-title-div">
										<div class="resource-title">An single Video file</div>
										<div class="resource-type">Category name</div>
									</div>
								</td>
							</tr>
						</table>
						<div class="resource-note">
							<a class="icon-note" data-fancybox data-src="#note-content" href="javascript:;"></a>
							<div id="note-content" class="hidden-content fancybox-content file-download">
								<h3>A single sample file for download</h3>
								<p>Optional description text for the content. The chief executive of a British company at the centre of allegations of electoral interference boasted about using "beautiful Ukrainian grils" to entrap the political opponents of clients. Alexander Nix was filmed saying that Cambridge Analytica would offer bribes to smear opponents</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-3 col-sm-2 col-md-7 file-download-wrapper no-padding">
					<div class="hidden-xs hidden-sm">
						<a href="#" class="media-file mpg">Item 1</a>
					</div>
					<div class="hidden-md hidden-lg">
						<a href="#" class="media-file all">Download</a>
					</div>
				</div>
			</div>
			<div class="resource-item video-file clearfix">
				<div class="resource-title-wrapper col-xs-9 col-sm-10 col-md-5">
					<div class="clearfix">
						<table cellpadding="0" cellspacing="0" border="0" width="90%">
							<tr>
								<td class="title">
									<div class="resource-title-div">
										<div class="resource-title">An Video File with multiple files for download</div>
										<div class="resource-type">Category name</div>
									</div>
								</td>
							</tr>
						</table>
						<div class="resource-note">
							<a class="icon-note" data-fancybox data-src="#note-content" href="javascript:;"></a>
							<div id="note-content" class="hidden-content fancybox-content file-download">
								<h3>A single sample file for download</h3>
								<p>Optional description text for the content. The chief executive of a British company at the centre of allegations of electoral interference boasted about using "beautiful Ukrainian grils" to entrap the political opponents of clients. Alexander Nix was filmed saying that Cambridge Analytica would offer bribes to smear opponents</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-3 col-sm-2 col-md-7 file-download-wrapper no-padding">
					<div class="hidden-xs hidden-sm">
						<a href="#" class="media-file mpg">Item 1</a>
						<a href="#" class="media-file ppt">Item 2</a>
						<a href="#" class="media-file pdf">Item 2</a>
						<a href="#" class="media-file all">All</a>
					</div>
					<div class="hidden-md hidden-lg">
						<div class="mobile_download_wrapper">
							<select class="mobile_download">
								<option>Item 1</option>
								<option>Item 2</option>
								<option>Item 3</option>
								<option>Item 4</option>
								<option>Item 5</option>
								<option>Download All</option>
							</select>
							<div class="download_text">Download</div>
						</div>
					</div>
				</div>
			</div>
			<div class="resource-item audio-file clearfix">
				<div class="resource-title-wrapper col-xs-9 col-sm-10 col-md-5">
					<div class="clearfix">
						<table cellpadding="0" cellspacing="0" border="0" width="90%">
							<tr>
								<td class="title">
									<div class="resource-title-div">
										<div class="resource-title">An single Audio file</div>
										<div class="resource-type">Category name</div>
									</div>
								</td>
								<td class="audio">
									<div class="audio_container">
										<div class="audio_playback" data-source="<?=get_stylesheet_directory_uri()?>/assets/img/common/sample.wav"></div>
									</div>
								</td>
							</tr>
						</table>
						<div class="resource-note">
							<a class="icon-note" data-fancybox data-src="#note-content" href="javascript:;"></a>
							<div id="note-content" class="hidden-content fancybox-content file-download">
								<h3>A single sample file for download</h3>
								<p>Optional description text for the content. The chief executive of a British company at the centre of allegations of electoral interference boasted about using "beautiful Ukrainian grils" to entrap the political opponents of clients. Alexander Nix was filmed saying that Cambridge Analytica would offer bribes to smear opponents</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-3 col-sm-2 col-md-7 file-download-wrapper no-padding">
					<div class="hidden-xs hidden-sm">
						<a href="#" class="media-file wav">Item 1</a>
					</div>
					<div class="hidden-md hidden-lg">
						<a href="#" class="media-file all">Download</a>
					</div>
				</div>
			</div>
			<div class="resource-item audio-file clearfix">
				<div class="resource-title-wrapper col-xs-9 col-sm-10 col-md-5">
					<div class="clearfix">
						<table cellpadding="0" cellspacing="0" border="0" width="90%">
							<tr>
								<td class="title">
									<div class="resource-title-div">
										<div class="resource-title">Max. 2 Audioes Preview</div>
										<div class="resource-type">Category name</div>
									</div>
								</td>
								<td class="audio">
									<div class="audio_container two_audio">
										<div class="audio_playback" data-source="<?=get_stylesheet_directory_uri()?>/assets/img/common/surroundTestDTS.dts.wav"></div>
										<div class="audio_playback" data-source="<?=get_stylesheet_directory_uri()?>/assets/img/common/sample.wav"></div>
									</div>
								</td>
							</tr>
						</table>
						<div class="resource-note">
							<div class="icon-note"></div>
							<div class="note-content"></div>
						</div>
					</div>
				</div>
				<div class="col-xs-3 col-sm-2 col-md-7 file-download-wrapper no-padding">
					<div class="hidden-xs hidden-sm">
						<a href="#" class="media-file wav">Item 1</a>
						<a href="#" class="media-file wav">Item 2</a>
						<a href="#" class="media-file all">All</a>
					</div>
					<div class="hidden-md hidden-lg">
						<div class="mobile_download_wrapper">
							<select class="mobile_download">
								<option>Item 1</option>
								<option>Item 2</option>
								<option>Item 3</option>
								<option>Item 4</option>
								<option>Item 5</option>
								<option>Download All</option>
							</select>
							<div class="download_text">Download</div>
						</div>
					</div>
				</div>
			</div>
			<div class="resource-item interactive-file clearfix">
				<div class="resource-title-wrapper col-xs-9 col-sm-10 col-md-5">
					<div class="clearfix">
						<table cellpadding="0" cellspacing="0" border="0" width="90%">
							<tr>
								<td class="title">
									<div class="resource-title-div">
										<div class="resource-title">A single Interactive File</div>
										<div class="resource-type">Category name</div>
									</div>
								</td>
							</tr>
						</table>
						<div class="resource-note">
							<div class="icon-note"></div>
							<div class="note-content"></div>
						</div>
					</div>
				</div>
				<div class="col-xs-3 col-sm-2 col-md-7 file-download-wrapper no-padding">
					<div class="hidden-xs hidden-sm">
						<a href="#" class="media-file html">Item 1</a>
					</div>
				</div>
			</div>
			<div class="resource-item interactive-file clearfix">
				<div class="resource-title-wrapper col-xs-9 col-sm-10 col-md-5">
					<div class="clearfix">
						<table cellpadding="0" cellspacing="0" border="0" width="90%">
							<tr>
								<td class="title">
									<div class="resource-title-div">
										<div class="resource-title">An Interactive File with addional files</div>
										<div class="resource-type">Category name</div>
									</div>
								</td>
							</tr>
						</table>
						<div class="resource-note">
							<a class="icon-note" data-fancybox data-src="#note-content" href="javascript:;"></a>
							<div id="note-content" class="hidden-content fancybox-content file-download">
								<h3>A single sample file for download</h3>
								<p>Optional description text for the content. The chief executive of a British company at the centre of allegations of electoral interference boasted about using "beautiful Ukrainian grils" to entrap the political opponents of clients. Alexander Nix was filmed saying that Cambridge Analytica would offer bribes to smear opponents</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-3 col-sm-2 col-md-7 file-download-wrapper no-padding">
					<div class="hidden-xs hidden-sm">
						<a href="#" class="media-file html">Item 1</a>
						<a href="#" class="media-file pdf">Item 2</a>
						<a href="#" class="media-file all">All</a>
					</div>
					<div class="hidden-md hidden-lg">
						<div class="mobile_download_wrapper">
							<select class="mobile_download">
								<option>Item 1</option>
								<option>Item 2</option>
								<option>Item 3</option>
								<option>Item 4</option>
								<option>Item 5</option>
								<option>Download All</option>
							</select>
							<div class="download_text">Download</div>
						</div>
					</div>
				</div>
			</div>
			<div class="resource-item article-file clearfix">
				<div class="resource-title-wrapper col-xs-9 col-sm-10 col-md-5">
					<div class="clearfix">
						<table cellpadding="0" cellspacing="0" border="0" width="90%">
							<tr>
								<td class="title">
									<div class="resource-title-div">
										<div class="resource-title">An Article only</div>
										<div class="resource-type">Category name</div>
									</div>
								</td>
							</tr>
						</table>
						<div class="resource-note">
							<a class="icon-note" data-fancybox data-src="#note-content" href="javascript:;"></a>
							<div id="note-content" class="hidden-content fancybox-content file-download">
								<h3>A single sample file for download</h3>
								<p>Optional description text for the content. The chief executive of a British company at the centre of allegations of electoral interference boasted about using "beautiful Ukrainian grils" to entrap the political opponents of clients. Alexander Nix was filmed saying that Cambridge Analytica would offer bribes to smear opponents</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-3 col-sm-2 col-md-7 file-download-wrapper no-padding">
					<div class="hidden-xs hidden-sm">
						<a href="#" class="media-file html">Item 1</a>
					</div>
					<div class="hidden-md hidden-lg">
						<a href="#" class="media-file all">Download</a>
					</div>
				</div>
			</div>
			<div class="resource-item article-file clearfix">
				<div class="resource-title-wrapper col-xs-9 col-sm-10 col-md-5">
					<div class="clearfix">
						<table cellpadding="0" cellspacing="0" border="0" width="90%">
							<tr>
								<td class="title">
									<div class="resource-title-div">
										<div class="resource-title">Article with files download and thumbnail</div>
										<div class="resource-type">Category name</div>
									</div>
								</td>
							</tr>
						</table>
						<div class="resource-note">
							<a class="icon-note" data-fancybox data-src="#note-content" href="javascript:;"></a>
							<div id="note-content" class="hidden-content fancybox-content file-download">
								<h3>A single sample file for download</h3>
								<p>Optional description text for the content. The chief executive of a British company at the centre of allegations of electoral interference boasted about using "beautiful Ukrainian grils" to entrap the political opponents of clients. Alexander Nix was filmed saying that Cambridge Analytica would offer bribes to smear opponents</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-3 col-sm-2 col-md-7 file-download-wrapper no-padding">
					<div class="hidden-xs hidden-sm">
						<a href="#" class="media-file html">Item 1</a>
						<a href="#" class="media-file pdf">Item 2</a>
						<a href="#" class="media-file all">All</a>
					</div>
					<div class="hidden-md hidden-lg">
						<div class="mobile_download_wrapper">
							<select class="mobile_download">
								<option>Item 1</option>
								<option>Item 2</option>
								<option>Item 3</option>
								<option>Item 4</option>
								<option>Item 5</option>
								<option>Download All</option>
							</select>
							<div class="download_text">Download</div>
						</div>
					</div>
				</div>
			</div>-->
		</div>
		<div class="resource-footer">
			<div class="pagination clearfix">
				<select id="pagination-select">
					<?php
					
					for($i = 1; $i <= $pages; $i++){
						echo '<option val='.$i.'>'.$i.'</option>';
					}
					
					?>
				</select>
				<span>/<?=$pages?></span>
				<button class="btn_gopage"></button>
			</div>
			<div class="download_all">
				<a href="#" class="btn_single_download">Download All</a>
			</div>
		</div>
	</div>
</div>