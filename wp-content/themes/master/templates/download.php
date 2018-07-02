<?php
/* Don't remove this line. */
require('../../../../wp-blog-header.php');

if(isset($_GET["file"]) && isset($_GET["pageid"])){
    // Get parameters
    $file_id = urldecode($_GET["file"]); // Decode URL-encoded string
	
	$page_id = urldecode($_GET["pageid"]); // Decode URL-encoded string
	
	if(checkPageAccessRight($page_id)){ //check media url when user have page access right
		
		$filepath = wp_get_attachment_url( $file_id );
		
		$destination_path = parse_url($filepath, PHP_URL_PATH);
		
		$destination_path = $_SERVER['DOCUMENT_ROOT'].$destination_path;
		
		// Process download
		if(file_exists($destination_path)) {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($filepath));
			flush(); // Flush system output buffer
			readfile($filepath);
			//
		}
	}else{
		echo '<p>You do not have access right for this file.</p>';
		exit;
	}
}
?>

<html> 
<body>
<script>
	window.open('', '_self', '');
	window.close();
</script>
</body> 
</html> 