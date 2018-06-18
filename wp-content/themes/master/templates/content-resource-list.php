<?php //the_content(); ?>
<?php //wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>

<div class="top-banner-container">
	<img src="<?=get_stylesheet_directory_uri()?>/assets/img/home/banner-top.png" class="img-responsive" />
</div>
<div class="container">
	<div class="page-content-wrapper">
		<div class="page-general-info">
			<h1 class="pageTitle">Template Here</h1>
			<nav aria-label="breadcrumb">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">Home</a></li>
				<li class="breadcrumb-item"><a href="#">Resource</a></li>
				<li class="breadcrumb-item active" aria-current="page">Template Here</li>
			  </ol>
			</nav>
			<div class="page-description">Optional text for the content. The chief executive of a British company at the centre of allegations of electoral interference boasted about using "beautiful Ukrainian girls" to entrap the political opponents of clients. Alexander Nix was filmed saying that Cambridge Analytica would offer bribes to smear opponents </div>
		</div>
		<div class="filter-wrapper clearfix">	
			<div class="col-md-9 filter-select">
				<div class="clearfix">
					<div class="filter-item">
						<select>
							<option>All Books</option>
							<option>Books 1</option>
							<option>Books 2</option>
							<option>Books 3</option>
						</select>
					</div>
					<div class="filter-item">
						<select>
							<option>All Chapters</option>
							<option>Chapters 1</option>
							<option>Chapters 2</option>
							<option>Chapters 3</option>
						</select>
					</div>
					<div class="filter-item">
						<select>
							<option>3rd Filter (Optional)</option>
							<option>Filter 1</option>
							<option>Filter 2</option>
							<option>Filter 3</option>
						</select>
					</div>
				</div>
			</div>
			<div class="col-md-3 view-option-wrapper">
				<div class="view-option clearfix">
					<a href="/list-view/" class="btn_list active">List</a>
					<a href="/grid-view/" class="btn_grid">Grid</a>
				</div>
			</div>
		</div>
		<div class="resource-container clearfix">
			<div class="clearfix resource-header">
				<div class="col-xs-9 col-sm-10 col-md-5 no-padding">Items</div>
				<div class="col-xs-3 col-sm-2 col-md-7 no-padding">Download</div>
			</div>
			<?php
				$resource_list = get_field('resource_list');
				$resources = get_field('resources', $resource_list[0]->ID);
				
				foreach ($resources as $resource):
					$resource_id = $resource->ID;
					$resource_type = get_field('resource_type', $resource_id);
					//$resource_thumbnail = get_the_post_thumbnail_url($resource_id,'full');
					$note = get_field('note', $resource_id);
					$resource_popup_image = get_field('resource_popup_image', $resource_id);
					$resource_popup_url = get_field('resource_popup_url', $resource_id);
					$download_count = count(get_field('downloads', $resource_id));
					
					$resource_post = get_post($resource_id); 
					$resource_slug = $resource_post->post_name;
					
					//echo $download_count > 1;
			?>
			
			<div class="resource-item <?=$resource_type?> clearfix">
				<div class="resource-title-wrapper col-xs-9 col-sm-10 col-md-5">
					<div class="clearfix">
						<table cellpadding="0" cellspacing="0" border="0" width="90%">
							<tr>
								<td class="title">
									<div class="resource-title-div">
										<div class="resource-title">
											<? //=get_the_title( $resource->ID );?>
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
								echo '<a href="'.$downloadable_file['url'].'" class="media-file '.$file_type.'" target="_blank">'.$file_title.'</a>';
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
										echo '<option val="'.$downloadable_file['url'].'">'.$file_title.'</option>';
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
								echo '<a href="'.$downloadable_file['url'].'" class="media-file '.$file_type.'" target="_blank">'.$file_title.'</a>'; 
								echo '</div>';
								
								echo '<div class="hidden-md hidden-lg">';
								echo '<a href="'.$downloadable_file['url'].'" class="media-file all" target="_blank">Download</a>';; 
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
			
			<?php endforeach; ?>
			
			
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
				<select>
					<option>1</option>
					<option>2</option>
					<option>3</option>
				</select>
				<span>/32</span>
				<button class="btn_gopage"></button>
			</div>
			<div class="download_all">
				<a href="#" class="btn_single_download">Download All</a>
			</div>
		</div>
	</div>
</div>