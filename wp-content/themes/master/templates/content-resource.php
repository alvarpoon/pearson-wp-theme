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
					<a href="/list-view/" class="btn_list">List</a>
					<a href="/grid-view/" class="btn_grid active">Grid</a>
				</div>
			</div>
		</div>
		<div class="resource-container clearfix">
			<div class="col-xs-6 col-sm-3 col-md-3 resource-item">
				<div class="resource-thumbnail">
					<img src="<?=get_stylesheet_directory_uri()?>/assets/img/common/img-zip.png" class="img-responsive" />
				</div>
				<div class="resource-title-wrapper">
					<div class="resource-title">A multiple sample files for download</div>
					<div class="resource-note">
						<a class="icon-note" data-fancybox data-src="#note-content" href="javascript:;"></a>
						<div id="note-content" class="hidden-content fancybox-content file-download">
							<h3>A single sample file for download</h3>
							<p>Optional description text for the content. The chief executive of a British company at the centre of allegations of electoral interference boasted about using "beautiful Ukrainian grils" to entrap the political opponents of clients. Alexander Nix was filmed saying that Cambridge Analytica would offer bribes to smear opponents</p>
						</div>
					</div>
				</div>
				<div class="resource-type">File Downlaod</div>
				<div class="resource-download-wrapper">
					<a href="#" class="btn_single_download">Download</a>
				</div>
			</div>
			<div class="col-xs-6 col-sm-3 col-md-3 resource-item">
				<div class="resource-thumbnail">
					<img src="<?=get_stylesheet_directory_uri()?>/assets/img/common/multiiple@2x.png" class="img-responsive" />
				</div>
				<div class="resource-title-wrapper">
					<div class="resource-title">A multiple sample files for download</div>
					<div class="resource-note">
						<a class="icon-note" data-fancybox data-src="#note-content" href="javascript:;"></a>
						<div id="note-content" class="hidden-content fancybox-content file-download">
							<h3>A single sample file for download</h3>
							<p>Optional description text for the content. The chief executive of a British company at the centre of allegations of electoral interference boasted about using "beautiful Ukrainian grils" to entrap the political opponents of clients. Alexander Nix was filmed saying that Cambridge Analytica would offer bribes to smear opponents</p>
						</div>
					</div>
				</div>
				<div class="resource-type">File Downlaod</div>
				<div class="resource-download-wrapper">
					<div class="multiple_download">
						<div class="multiple_dl_header">Download (5)</div>
						<div class="multiple_dl_content">
							<ul>
								<li><a href="<?=get_stylesheet_directory_uri()?>/assets/img/common/multiiple@2x.png" target="_blank">long item name here max 2 lines</a></li>
								<li><a href="<?=get_stylesheet_directory_uri()?>/assets/img/common/img_single_image.png" target="_blank">Item 2</a></li>
								<li><a href="<?=get_stylesheet_directory_uri()?>/assets/img/common/surroundTestDTS.dts.wav" target="_blank">Item 3</a></li>
								<li><a href="<?=get_stylesheet_directory_uri()?>/assets/img/common/img_video.png" target="_blank">Item 4</a></li>
								<li><a href="<?=get_stylesheet_directory_uri()?>/assets/img/common/sample.wav" target="_blank">Item 5</a></li>
								<!--<li><a href="javascript:;" data-file="<?=get_stylesheet_directory_uri()?>/assets/img/common/multiiple@2x.png,<?=get_stylesheet_directory_uri()?>/assets/img/common/img_single_image.png,<?=get_stylesheet_directory_uri()?>/assets/img/common/surroundTestDTS.dts.wav,<?=get_stylesheet_directory_uri()?>/assets/img/common/img_video.png" data-filename="testing123" class="createzip">Download All (5 files)</a></li>-->
								<!--<li><a href="javascript:;" data-file="\wp-content\themes\master\assets\img\common\multiiple@2x.png,\wp-content\themes\master\assets\img\common\img_single_image.png,\wp-content\themes\master\assets\img\common\surroundTestDTS.dts.wav,\wp-content\themes\master\assets\img\common\img_video.png" data-filename="testing123" class="createzip">Download All (5 files)</a></li>-->
								<li><a href="javascript:;" data-file="/wp-content/themes/master/assets/img/common/multiiple@2x.png,/wp-content/themes/master/assets/img/common/img_single_image.png,/wp-content/themes/master/assets/img/common/surroundTestDTS.dts.wav,/wp-content/themes/master/assets/img/common/img_video.png,/wp-content/themes/master/assets/img/common/sample.wav" data-filename="testing123" class="createzip">Download All (5 files)</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-sm-3 col-md-3 resource-item">
				<div class="resource-thumbnail">
					<a href="https://source.unsplash.com/Q1Zyjio6pIM/1279x870" data-fancybox>
						<img src="<?=get_stylesheet_directory_uri()?>/assets/img/common/img_single_image.png" class="img-responsive" />
					</a>
				</div>
				<div class="resource-title-wrapper">
					<div class="resource-title"><a href="https://source.unsplash.com/Q1Zyjio6pIM/1279x870" data-fancybox>An single image file</a></div>
					<div class="resource-note">
						<a class="icon-note" data-fancybox data-src="#note-content" href="javascript:;"></a>
						<div id="note-content" class="hidden-content fancybox-content file-download">
							<h3>A single sample file for download</h3>
							<p>Optional description text for the content. The chief executive of a British company at the centre of allegations of electoral interference boasted about using "beautiful Ukrainian grils" to entrap the political opponents of clients. Alexander Nix was filmed saying that Cambridge Analytica would offer bribes to smear opponents</p>
						</div>
					</div>
				</div>
				<div class="resource-type">File Downlaod</div>
				<div class="resource-download-wrapper">
					<a href="#" class="btn_single_download">Download</a>
				</div>
			</div>
			<div class="col-xs-6 col-sm-3 col-md-3 resource-item">
				<div class="resource-thumbnail">
					<a href="https://source.unsplash.com/Q1Zyjio6pIM/1279x870" data-fancybox>
						<img src="<?=get_stylesheet_directory_uri()?>/assets/img/common/img_single_image.png" class="img-responsive" />
					</a>
					<div class="audio_container">
						<div class="audio_playback" data-source="<?=get_stylesheet_directory_uri()?>/assets/img/common/surroundTestDTS.dts.wav"></div>
					</div>
				</div>
				<div class="resource-title-wrapper">
					<div class="resource-title"><a href="https://source.unsplash.com/Q1Zyjio6pIM/1279x870" data-fancybox>A multiple sample files for download</a></div>
					<div class="resource-note">
						<a class="icon-note" data-fancybox data-src="#note-content" href="javascript:;"></a>
						<div id="note-content" class="hidden-content fancybox-content file-download">
							<h3>A single sample file for download</h3>
							<p>Optional description text for the content. The chief executive of a British company at the centre of allegations of electoral interference boasted about using "beautiful Ukrainian grils" to entrap the political opponents of clients. Alexander Nix was filmed saying that Cambridge Analytica would offer bribes to smear opponents</p>
						</div>
					</div>
				</div>
				<div class="resource-type">File Downlaod</div>
				<div class="resource-download-wrapper">
					<a href="#" class="btn_single_download">Download</a>
				</div>
			</div>
			<div class="col-xs-6 col-sm-3 col-md-3 resource-item">
				<div class="resource-thumbnail">
					<a data-fancybox href="https://vimeo.com/191947042">
						<img src="<?=get_stylesheet_directory_uri()?>/assets/img/common/img_video.png" class="img-responsive" />
					</a>
				</div>
				<div class="resource-title-wrapper">
					<div class="resource-title"><a data-fancybox href="https://vimeo.com/191947042">A single video file</a></div>
					<div class="resource-note">
						<a class="icon-note" data-fancybox data-src="#note-content" href="javascript:;"></a>
						<div id="note-content" class="hidden-content fancybox-content file-download">
							<h3>A single sample file for download</h3>
							<p>Optional description text for the content. The chief executive of a British company at the centre of allegations of electoral interference boasted about using "beautiful Ukrainian grils" to entrap the political opponents of clients. Alexander Nix was filmed saying that Cambridge Analytica would offer bribes to smear opponents</p>
						</div>
					</div>
				</div>
				<div class="resource-type">File Downlaod</div>
				<div class="resource-download-wrapper">
					<a href="#" class="btn_single_download">Download</a>
				</div>
			</div>
			<div class="col-xs-6 col-sm-3 col-md-3 resource-item">
				<div class="resource-thumbnail">
					<a data-fancybox href="https://vimeo.com/191947042">
						<img src="<?=get_stylesheet_directory_uri()?>/assets/img/common/img_video.png" class="img-responsive" />
					</a>
				</div>
				<div class="resource-title-wrapper">
					<div class="resource-title"><a data-fancybox href="https://vimeo.com/191947042">A Video File with multiple files for download</a></div>
					<div class="resource-note">
						<a class="icon-note" data-fancybox data-src="#note-content" href="javascript:;"></a>
						<div id="note-content" class="hidden-content fancybox-content file-download">
							<h3>A single sample file for download</h3>
							<p>Optional description text for the content. The chief executive of a British company at the centre of allegations of electoral interference boasted about using "beautiful Ukrainian grils" to entrap the political opponents of clients. Alexander Nix was filmed saying that Cambridge Analytica would offer bribes to smear opponents</p>
						</div>
					</div>
				</div>
				<div class="resource-type">File Downlaod</div>
				<div class="resource-download-wrapper">
					<a href="#" class="btn_single_download">Download</a>
				</div>
			</div>
			<div class="col-xs-6 col-sm-3 col-md-3 resource-item">
				<div class="resource-thumbnail">
					<img src="<?=get_stylesheet_directory_uri()?>/assets/img/common/img_wav.png" class="img-responsive" />
					<div class="audio_container">
						<div class="audio_playback" data-source="<?=get_stylesheet_directory_uri()?>/assets/img/common/sample.wav"></div>
					</div>
				</div>
				<div class="resource-title-wrapper">
					<div class="resource-title">A single Audio file</div>
					<div class="resource-note">
						<a class="icon-note" data-fancybox data-src="#note-content" href="javascript:;"></a>
						<div id="note-content" class="hidden-content fancybox-content file-download">
							<h3>A single sample file for download</h3>
							<p>Optional description text for the content. The chief executive of a British company at the centre of allegations of electoral interference boasted about using "beautiful Ukrainian grils" to entrap the political opponents of clients. Alexander Nix was filmed saying that Cambridge Analytica would offer bribes to smear opponents</p>
						</div>
					</div>
				</div>
				<div class="resource-type">File Downlaod</div>
				<div class="resource-download-wrapper">
					<a href="#" class="btn_single_download">Download</a>
				</div>
			</div>
			<div class="col-xs-6 col-sm-3 col-md-3 resource-item">
				<div class="resource-thumbnail">
					<img src="<?=get_stylesheet_directory_uri()?>/assets/img/common/img_interactive.png" class="img-responsive" />
				</div>
				<div class="resource-title-wrapper">
					<div class="resource-title">A single Interactive File</div>
					<div class="resource-note">
						<a class="icon-note" data-fancybox data-src="#note-content" href="javascript:;"></a>
						<div id="note-content" class="hidden-content fancybox-content file-download">
							<h3>A single sample file for download</h3>
							<p>Optional description text for the content. The chief executive of a British company at the centre of allegations of electoral interference boasted about using "beautiful Ukrainian grils" to entrap the political opponents of clients. Alexander Nix was filmed saying that Cambridge Analytica would offer bribes to smear opponents</p>
						</div>
					</div>
				</div>
				<div class="resource-type">File Downlaod</div>
				<div class="resource-download-wrapper">
					<a href="#" class="btn_single_download">Download</a>
				</div>
			</div>
			<div class="col-xs-6 col-sm-3 col-md-3 resource-item">
				<div class="resource-thumbnail">
					<img src="<?=get_stylesheet_directory_uri()?>/assets/img/common/img_interactive.png" class="img-responsive" />
				</div>
				<div class="resource-title-wrapper">
					<div class="resource-title">An Interactive File with additional files</div>
					<div class="resource-note">
						<a class="icon-note" data-fancybox data-src="#note-content" href="javascript:;"></a>
						<div id="note-content" class="hidden-content fancybox-content file-download">
							<h3>A single sample file for download</h3>
							<p>Optional description text for the content. The chief executive of a British company at the centre of allegations of electoral interference boasted about using "beautiful Ukrainian grils" to entrap the political opponents of clients. Alexander Nix was filmed saying that Cambridge Analytica would offer bribes to smear opponents</p>
						</div>
					</div>
				</div>
				<div class="resource-type">File Downlaod</div>
				<div class="resource-download-wrapper">
					<a href="#" class="btn_single_download">Download</a>
				</div>
			</div>
			<div class="col-xs-6 col-sm-3 col-md-3 resource-item">
				<div class="resource-thumbnail">
					<a href="javascript:;" data-fancybox data-src="#elon-musk-1">
						<img src="<?=get_stylesheet_directory_uri()?>/assets/img/common/img_article.png" class="img-responsive" />
					</a>
				</div>
				<div class="resource-title-wrapper">
					<div class="resource-title">Article with files download and thumbnail</div>
					<div class="resource-note">
						<a class="icon-note" data-fancybox data-src="#note-content" href="javascript:;"></a>
						<div id="note-content" class="hidden-content fancybox-content file-download">
							<h3>A single sample file for download</h3>
							<p>Optional description text for the content. The chief executive of a British company at the centre of allegations of electoral interference boasted about using "beautiful Ukrainian grils" to entrap the political opponents of clients. Alexander Nix was filmed saying that Cambridge Analytica would offer bribes to smear opponents</p>
						</div>
					</div>
				</div>
				<div class="resource-type">File Downlaod</div>
				<div class="resource-download-wrapper">
					<a href="#" class="btn_single_download">Download</a>
				</div>
				<div id="elon-musk-1" class="hidden-content fancybox-content article-lightbox">
					<h3>Article Title</h3>
					<div class="article-content">
						<div class="media-container">
							<a href="#" class="media-file doc">Item 1</a>
							<a href="#" class="media-file pdf">Item 2</a>
							<a href="#" class="media-file mpg">Item 3</a>
							<a href="#" class="media-file ppt">Item 4</a>
							<a href="#" class="media-file zip">Item 5</a>
						</div>
						<div class="clearfix">
							<div class="img-container"><img src="<?=get_stylesheet_directory_uri()?>/assets/img/common/img-elon-musk.png" class="img-responsive" /></div>
							<div class="content-container">
								<p>Dummy descripition. Young motorists could be banned from the road at night if plans for probationary driving licences are approved.</p>
								
								<p>Theresa May said yesterday that the Department for Transport would review the case for a "graduated" licensing system that imposes restrictions on drivers depending on experience. The prime minister's intervention came amid concerns that young motorists are involved in a disproportionately high number of accidents. Figures show that young drivers - those aged 17 to 24 - make up about 7 per cent of licence holders but are involved in more than a quarter of crashes leading to deaths or serious injuries.</p>
								<p>Under the graduated licence system, drivers are required to abide by a series of restrictions during a probationary period - usually one or two years. This...to</p>
								<p>Dummy descripition. Young motorists could be banned from the road at night if plans for probationary driving licences are approved.</p>
								
								<p>Theresa May said yesterday that the Department for Transport would review the case for a "graduated" licensing system that imposes restrictions on drivers depending on experience. The prime minister's intervention came amid concerns that young motorists are involved in a disproportionately high number of accidents. Figures show that young drivers - those aged 17 to 24 - make up about 7 per cent of licence holders but are involved in more than a quarter of crashes leading to deaths or serious injuries.</p>
								<p>Under the graduated licence system, drivers are required to abide by a series of restrictions during a probationary period - usually one or two years. This...to </p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-sm-3 col-md-3 resource-item">
				<div class="resource-thumbnail">
					<a href="javascript:;" data-fancybox data-src="#elon-musk-2" href="javascript:;">
						<img src="<?=get_stylesheet_directory_uri()?>/assets/img/common/img_article.png" class="img-responsive" />
					</a>
				</div>
				<div class="resource-title-wrapper">
					<div class="resource-title">An Article only</div>
					<div class="resource-note">
						<a class="icon-note" data-fancybox data-src="#note-content" href="javascript:;"></a>
						<div id="note-content" class="hidden-content fancybox-content file-download">
							<h3>A single sample file for download</h3>
							<p>Optional description text for the content. The chief executive of a British company at the centre of allegations of electoral interference boasted about using "beautiful Ukrainian grils" to entrap the political opponents of clients. Alexander Nix was filmed saying that Cambridge Analytica would offer bribes to smear opponents</p>
						</div>
					</div>
				</div>
				<div class="resource-type">File Downlaod</div>
				<div class="resource-download-wrapper">
					<a href="#" class="btn_single_download">Download</a>
				</div>
				<div id="elon-musk-2" class="hidden-content fancybox-content article-lightbox">
					<h3>Article Title</h3>
					<div class="article-content">
						<div class="clearfix">
							<div class="img-container"><img src="<?=get_stylesheet_directory_uri()?>/assets/img/common/img-elon-musk.png" class="img-responsive" /></div>
							<div class="content-container">
								<p>Dummy descripition. Young motorists could be banned from the road at night if plans for probationary driving licences are approved.</p>
								
								<p>Theresa May said yesterday that the Department for Transport would review the case for a "graduated" licensing system that imposes restrictions on drivers depending on experience. The prime minister's intervention came amid concerns that young motorists are involved in a disproportionately high number of accidents. Figures show that young drivers - those aged 17 to 24 - make up about 7 per cent of licence holders but are involved in more than a quarter of crashes leading to deaths or serious injuries.</p>
								<p>Under the graduated licence system, drivers are required to abide by a series of restrictions during a probationary period - usually one or two years. This...to</p>
								<p>Dummy descripition. Young motorists could be banned from the road at night if plans for probationary driving licences are approved.</p>
								
								<p>Theresa May said yesterday that the Department for Transport would review the case for a "graduated" licensing system that imposes restrictions on drivers depending on experience. The prime minister's intervention came amid concerns that young motorists are involved in a disproportionately high number of accidents. Figures show that young drivers - those aged 17 to 24 - make up about 7 per cent of licence holders but are involved in more than a quarter of crashes leading to deaths or serious injuries.</p>
								<p>Under the graduated licence system, drivers are required to abide by a series of restrictions during a probationary period - usually one or two years. This...to </p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-sm-3 col-md-3 resource-item">
				<div class="resource-thumbnail">
					<a href="https://source.unsplash.com/Q1Zyjio6pIM/1279x870" data-fancybox>
						<img src="<?=get_stylesheet_directory_uri()?>/assets/img/common/img_wav.png" class="img-responsive" />
					</a>
					<div class="audio_container two_audio">
						<div class="audio_playback" data-source="<?=get_stylesheet_directory_uri()?>/assets/img/common/surroundTestDTS.dts.wav"></div>
						<div class="audio_playback" data-source="<?=get_stylesheet_directory_uri()?>/assets/img/common/sample.wav"></div>
					</div>
				</div>
				<div class="resource-title-wrapper">
					<div class="resource-title"><a href="https://source.unsplash.com/Q1Zyjio6pIM/1279x870" data-fancybox>A multiple sample files for download</a></div>
					<div class="resource-note">
						<a class="icon-note" data-fancybox data-src="#note-content" href="javascript:;"></a>
						<div id="note-content" class="hidden-content fancybox-content file-download">
							<h3>A single sample file for download</h3>
							<p>Optional description text for the content. The chief executive of a British company at the centre of allegations of electoral interference boasted about using "beautiful Ukrainian grils" to entrap the political opponents of clients. Alexander Nix was filmed saying that Cambridge Analytica would offer bribes to smear opponents</p>
						</div>
					</div>
				</div>
				<div class="resource-type">File Downlaod</div>
				<div class="resource-download-wrapper">
					<a href="#" class="btn_single_download">Download</a>
				</div>
			</div>
			<div class="col-xs-6 col-sm-3 col-md-3 resource-item">
				<div class="resource-thumbnail">
					<img src="<?=get_stylesheet_directory_uri()?>/assets/img/common/img-zip.png" class="img-responsive" />
				</div>
				<div class="resource-title-wrapper">
					<div class="resource-title">A multiple sample files for download</div>
					<div class="resource-note">
						<a class="icon-note" data-fancybox data-src="#note-content" href="javascript:;"></a>
						<div id="note-content" class="hidden-content fancybox-content file-download">
							<h3>A single sample file for download</h3>
							<p>Optional description text for the content. The chief executive of a British company at the centre of allegations of electoral interference boasted about using "beautiful Ukrainian grils" to entrap the political opponents of clients. Alexander Nix was filmed saying that Cambridge Analytica would offer bribes to smear opponents</p>
						</div>
					</div>
				</div>
				<div class="resource-type">File Downlaod</div>
				<div class="resource-download-wrapper">
					<a href="#" class="btn_single_download">Download</a>
				</div>
			</div>
			<div class="col-xs-6 col-sm-3 col-md-3 resource-item">
				<div class="resource-thumbnail">
					<img src="<?=get_stylesheet_directory_uri()?>/assets/img/common/img-zip.png" class="img-responsive" />
				</div>
				<div class="resource-title-wrapper">
					<div class="resource-title">A multiple sample files for download</div>
					<div class="resource-note">
						<a class="icon-note" data-fancybox data-src="#note-content" href="javascript:;"></a>
						<div id="note-content" class="hidden-content fancybox-content file-download">
							<h3>A single sample file for download</h3>
							<p>Optional description text for the content. The chief executive of a British company at the centre of allegations of electoral interference boasted about using "beautiful Ukrainian grils" to entrap the political opponents of clients. Alexander Nix was filmed saying that Cambridge Analytica would offer bribes to smear opponents</p>
						</div>
					</div>
				</div>
				<div class="resource-type">File Downlaod</div>
				<div class="resource-download-wrapper">
					<a href="#" class="btn_single_download">Download</a>
				</div>
			</div>
			<div class="col-xs-6 col-sm-3 col-md-3 resource-item">
				<div class="resource-thumbnail">
					<img src="<?=get_stylesheet_directory_uri()?>/assets/img/common/img-zip.png" class="img-responsive" />
				</div>
				<div class="resource-title-wrapper">
					<div class="resource-title">A multiple sample files for download</div>
					<div class="resource-note">
						<a class="icon-note" data-fancybox data-src="#note-content" href="javascript:;"></a>
						<div id="note-content" class="hidden-content fancybox-content file-download">
							<h3>A single sample file for download</h3>
							<p>Optional description text for the content. The chief executive of a British company at the centre of allegations of electoral interference boasted about using "beautiful Ukrainian grils" to entrap the political opponents of clients. Alexander Nix was filmed saying that Cambridge Analytica would offer bribes to smear opponents</p>
						</div>
					</div>
				</div>
				<div class="resource-type">File Downlaod</div>
				<div class="resource-download-wrapper">
					<a href="#" class="btn_single_download">Download</a>
				</div>
			</div>
			<div class="col-xs-6 col-sm-3 col-md-3 resource-item">
				<div class="resource-thumbnail">
					<img src="<?=get_stylesheet_directory_uri()?>/assets/img/common/img-zip.png" class="img-responsive" />
				</div>
				<div class="resource-title-wrapper">
					<div class="resource-title">A multiple sample files for download</div>
					<div class="resource-note">
						<a class="icon-note" data-fancybox data-src="#note-content" href="javascript:;"></a>
						<div id="note-content" class="hidden-content fancybox-content file-download">
							<h3>A single sample file for download</h3>
							<p>Optional description text for the content. The chief executive of a British company at the centre of allegations of electoral interference boasted about using "beautiful Ukrainian grils" to entrap the political opponents of clients. Alexander Nix was filmed saying that Cambridge Analytica would offer bribes to smear opponents</p>
						</div>
					</div>
				</div>
				<div class="resource-type">File Downlaod</div>
				<div class="resource-download-wrapper">
					<a href="#" class="btn_single_download">Download</a>
				</div>
			</div>
			<div class="col-xs-6 col-sm-3 col-md-3 resource-item">
				<div class="resource-thumbnail">
					<img src="<?=get_stylesheet_directory_uri()?>/assets/img/common/img-zip.png" class="img-responsive" />
				</div>
				<div class="resource-title-wrapper">
					<div class="resource-title">A multiple sample files for download</div>
					<div class="resource-note">
						<a class="icon-note" data-fancybox data-src="#note-content" href="javascript:;"></a>
						<div id="note-content" class="hidden-content fancybox-content file-download">
							<h3>A single sample file for download</h3>
							<p>Optional description text for the content. The chief executive of a British company at the centre of allegations of electoral interference boasted about using "beautiful Ukrainian grils" to entrap the political opponents of clients. Alexander Nix was filmed saying that Cambridge Analytica would offer bribes to smear opponents</p>
						</div>
					</div>
				</div>
				<div class="resource-type">File Downlaod</div>
				<div class="resource-download-wrapper">
					<a href="#" class="btn_single_download">Download</a>
				</div>
			</div>
			<div class="col-xs-6 col-sm-3 col-md-3 resource-item">
				<div class="resource-thumbnail">
					<img src="<?=get_stylesheet_directory_uri()?>/assets/img/common/img-zip.png" class="img-responsive" />
				</div>
				<div class="resource-title-wrapper">
					<div class="resource-title">A multiple sample files for download</div>
					<div class="resource-note">
						<a class="icon-note" data-fancybox data-src="#note-content" href="javascript:;"></a>
						<div id="note-content" class="hidden-content fancybox-content file-download">
							<h3>A single sample file for download</h3>
							<p>Optional description text for the content. The chief executive of a British company at the centre of allegations of electoral interference boasted about using "beautiful Ukrainian grils" to entrap the political opponents of clients. Alexander Nix was filmed saying that Cambridge Analytica would offer bribes to smear opponents</p>
						</div>
					</div>
				</div>
				<div class="resource-type">File Downlaod</div>
				<div class="resource-download-wrapper">
					<a href="#" class="btn_single_download">Download</a>
				</div>
			</div>
			<div class="col-xs-6 col-sm-3 col-md-3 resource-item">
				<div class="resource-thumbnail">
					<img src="<?=get_stylesheet_directory_uri()?>/assets/img/common/img-zip.png" class="img-responsive" />
				</div>
				<div class="resource-title-wrapper">
					<div class="resource-title">A multiple sample files for download</div>
					<div class="resource-note">
						<a class="icon-note" data-fancybox data-src="#note-content" href="javascript:;"></a>
						<div id="note-content" class="hidden-content fancybox-content file-download">
							<h3>A single sample file for download</h3>
							<p>Optional description text for the content. The chief executive of a British company at the centre of allegations of electoral interference boasted about using "beautiful Ukrainian grils" to entrap the political opponents of clients. Alexander Nix was filmed saying that Cambridge Analytica would offer bribes to smear opponents</p>
						</div>
					</div>
				</div>
				<div class="resource-type">File Downlaod</div>
				<div class="resource-download-wrapper">
					<a href="#" class="btn_single_download">Download</a>
				</div>
			</div>
			<div class="col-xs-6 col-sm-3 col-md-3 resource-item">
				<div class="resource-thumbnail">
					<img src="<?=get_stylesheet_directory_uri()?>/assets/img/common/img-zip.png" class="img-responsive" />
				</div>
				<div class="resource-title-wrapper">
					<div class="resource-title">A multiple sample files for download</div>
					<div class="resource-note">
						<a class="icon-note" data-fancybox data-src="#note-content" href="javascript:;"></a>
						<div id="note-content" class="hidden-content fancybox-content file-download">
							<h3>A single sample file for download</h3>
							<p>Optional description text for the content. The chief executive of a British company at the centre of allegations of electoral interference boasted about using "beautiful Ukrainian grils" to entrap the political opponents of clients. Alexander Nix was filmed saying that Cambridge Analytica would offer bribes to smear opponents</p>
						</div>
					</div>
				</div>
				<div class="resource-type">File Downlaod</div>
				<div class="resource-download-wrapper">
					<a href="#" class="btn_single_download">Download</a>
				</div>
			</div>
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