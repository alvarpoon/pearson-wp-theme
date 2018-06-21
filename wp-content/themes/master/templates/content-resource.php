<?php //the_content(); ?>
<?php //wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>
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
			<h1 class="pageTitle"><?=the_title();?></h1>
			<nav aria-label="breadcrumb">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">Home</a></li>
				<li class="breadcrumb-item"><a href="#">Resource</a></li>
				<li class="breadcrumb-item active" aria-current="page">Template Here</li>
			  </ol>
			</nav>
			<div class="page-description">
				<?php 
					$content = apply_filters('the_content', $post->post_content); 
					echo $content;
				?>
			</div>
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
					<a href="/list-view/" class="btn_list">List</a>
					<a href="/grid-view/" class="btn_grid active">Grid</a>
				</div>
			</div>
		</div>
		<div class="resource-container clearfix">
			
		<?php
				$resource_list = get_field('resource_list');
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
					$resource_thumbnail = get_the_post_thumbnail_url($resource_id,'full');
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
					<div class="col-xs-6 col-sm-3 col-md-3 resource-item">
						<div class="resource-thumbnail">
							<?php
								echo showGridThumbnail($resource_thumbnail, $resource_type, $resource_popup_image['url'], $resource_popup_url, $resource_slug);
								echo get_audio_preview(get_field('downloads', $resource_id));
							?>
						</div>
						<div class="resource-title-wrapper">
							<div class="resource-title"><?=get_the_title( $resource->ID );?></div>
							<?php if(!empty($note)){ ?>
							<div class="resource-note">
								<a class="icon-note" data-fancybox data-src="#<?=$resource_slug.'-note'?>" href="javascript:;"></a>
								<div id="<?=$resource_slug.'-note'?>" class="hidden-content fancybox-content file-download"><?=$note?>	</div>
							</div>
							<?php } ?>
						</div>
						<div class="resource-type">File Downlaod</div>
						<div class="resource-download-wrapper">
							<?php
								if($download_count > 1){ ?>
									<div class="multiple_download">
										<div class="multiple_dl_header">Download (<?=$download_count?>)</div>
										<div class="multiple_dl_content">
											<ul>
											<?php	
											$downloadable_file_arr = array();
											
											if( have_rows('downloads', $resource_id) ){
												while( have_rows('downloads', $resource_id) ): the_row();
													$file_title = get_sub_field('file_title');
													$downloadable_file = get_sub_field('downloadable_file');
													echo '<li><a href="'.$downloadable_file['url'].'" target="_blank">'.$file_title.'</a></li>';
													
													array_push($downloadable_file_arr, $downloadable_file['url']);
												endwhile;
												
												$downloadable_file_string = implode(',',$downloadable_file_arr);
											}?>
											
											<li><a href="javascript:;" data-file="<?=$downloadable_file_string?>" data-filename="testing123" class="createzip">Download All (<?=$download_count?> files)</a></li>
											</ul>
										</div>
									</div>
							<?php
								}else{
									if( have_rows('downloads', $resource_id) ){
										while( have_rows('downloads', $resource_id) ): the_row();
											$downloadable_file = get_sub_field('downloadable_file');
											echo '<a href="'.$downloadable_file['url'].'" class="btn_single_download" target="_blank">Download</a>';
										endwhile;
									}
								}
							?>
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
			</div>
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