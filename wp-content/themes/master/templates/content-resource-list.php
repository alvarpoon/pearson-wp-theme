<?php //the_content(); ?>
<?php //wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>

<div class="top-banner-container">
	<img src="<?=get_stylesheet_directory_uri()?>/assets/img/home/banner-top.png" class="img-responsive" />
</div>

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
				<a href="#" class="btn_list active">List</a>
				<a href="#" class="btn_grid">Grid</a>
			</div>
		</div>
	</div>
	<div class="resource-container clearfix">
		<div class="clearfix resource-header">
			<div class="col-xs-9 col-sm-10 col-md-5 no-padding">Items</div>
			<div class="col-xs-3 col-sm-2 col-md-7 no-padding">Download</div>
		</div>
		<div class="resource-item single-file">
			<div class="resource-title-wrapper col-xs-9 col-sm-10 col-md-5">
				<div class="clearfix">
					<table cellpadding="0" cellspacing="0" border="0" width="90%">
						<tr>
							<td>
								<div class="resource-title-div">
									<div class="resource-title">A multiple sample files for download</div>
									<div class="resource-category">Category name</div>
								</div>
							</td>
							<td>
								<a href="#" style="display:inline-block; width:100px; height:28px;">listen</a>
								<a href="#" style="display:inline-block; width:100px; height:28px;">listen</a>
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
				<a href="#">Download</a>
				<a href="#">Download</a>
				<a href="#">Download</a>
				<a href="#">Download</a>
				<a href="#">Download</a>
				<a href="#" class="all">Download</a>
			</div>
		</div>
	</div>
</div>