<?php //the_content(); ?>
<?php //wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>
<?php
	//$all_resources = get_all_resource_page();
	
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
			<div class="page-description"><?php 
					$content = apply_filters('the_content', $post->post_content); 
					echo $content;
				?>
			</div>
		</div>
		<div class="filter-wrapper clearfix">	
			<div class="col-md-9 filter-select">
				<?php
					$reference_id = $pageID;

					$filter_dependence = get_field('filter_dependence', $reference_id);
					if(empty($filter_dependence)){
						$filter_dependence = 0;
					}

					$dependence_filter_title = get_field('dependence_filter_title', $reference_id);
				?>
				<script type="text/javascript">						
						
					var filter_dependence = <?=$filter_dependence?>;

					var filter2_title = '<?=$dependence_filter_title?>';

				</script>
				
				<div class="clearfix" id="filter_select_container"></div>
			</div>
			<div class="col-md-3 view-option-wrapper">
				<div class="view-option clearfix">
					<?php 
					$alternative_view = get_field('alternative_view');
						
					if(!empty($alternative_view)):
					?>
					<a href="javascript:;" class="btn_list active"><?=__('List', 'Pearson-master');?></a>
					<a href="<?=$alternative_view?>" class="btn_grid "><?=__('Grid', 'Pearson-master');?></a>
					
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="resource-container clearfix">
			<div class="loading-box"></div>
			<script>
				var currentPageNum = '<?=$page?>';
			</script>
			<div class="resource-container-inner"></div>
		</div>
		<div class="resource-footer">
			<div class="pagination clearfix">
				
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
			<!--<div class="download_all">
				<a href="#" class="btn_single_download">Download All</a>
			</div>-->
		</div>
	</div>
</div>