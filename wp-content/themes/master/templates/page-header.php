<?php get_header_banner();?>
<div class="container">
	<div class="page-header">
	  <h1>
		<?php echo roots_title(); ?>
	  </h1>
	</div>
	<div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
		<?php
			/*if(function_exists('bcn_display'))
			{
				bcn_display();
			}*/
			
			if(function_exists('custom_breadcrumbs'))
			{
				custom_breadcrumbs();
			}
		?>
	</div>
</div>
