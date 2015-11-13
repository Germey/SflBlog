<?php

if( $_POST['action'] == 'deletefile' ){
    echo ( @unlink('../../'.$_POST['file']) ) ? 1 : 0;
    die();
}

if ( !empty($_FILES) ) {

    $_dir = $_GET['themeroot'].$_POST['dir'];
    $_FILES['file_upload']['name'] = preg_replace('@[^a-zA-Z0-9\-_\.]@','_', $_FILES['file_upload']['name']);

    //mkdir($_dir), 0755, true);
    if( @move_uploaded_file( $_FILES['file_upload']['tmp_name'], $_dir.'/'.$_FILES['file_upload']['name'] ) ){

	$message = 'Upload done.';
	$status = 1;

	$mime_type = mime_content_type( $_dir.'/'.$_FILES['file_upload']['name'] );
	if( strpos( $mime_type, 'image' ) === 0 )
	    $image = '<img src="'.$_GET['homeurl'].'/wp-content/themes/'.$_GET['template'].''.$_POST['dir'].'/'.$_FILES['file_upload']['name'].'" class="ap-upload-preview" />';
	else
	    $image = '<img src="'.$_GET['homeurl'].'/wp-content/themes/'.$_GET['template'].'/addpress/images/darkicons/icon_webdev.gif" class="ap-fileicon" />';

	$return .= '<option value="'.$_GET['homeurl'].'/wp-content/themes/'.$_GET['template'].''.$_POST['dir'].'/'.$_FILES['file_upload']['name'].'">';
	$return .= str_replace( array('<','>'), array('%(%','%)%'), '<div class="clear file-list-file"><div class="ap-thumb">'.$image.'</div><div class="ap-file-info"><strong>'.$_FILES['file_upload']['name'].'</strong><br />'.$_size[0].'x'.$_size[1].'px</div><span><a href="#" class="delete-file" data-file="'.$_POST['dir'].'/'.$_FILES['file_upload']['name'].'"></a></span></div>' );
	$return .= '</option>';

	$file_li = $return;
	$upload_class = '.ap-upload-dir-'.preg_replace('@[^a-zA-Z0-9\-_]@','-',$_POST['dir']);

    }else{

	$message = 'File could not be uploaded, check the permission of the directory <br />"'.$_dir.'".';
	$status = 0;

    }
    
}else{

    $message = 'No file selected.';
    $status = 0;
    
}
?>
<script language="javascript" type="text/javascript">window.top.window.ap_uploadEnd( <?php echo $status; ?>, '<?php echo $_POST['id']; ?>', '<?php echo $message; ?>', '<?php echo $file_li; ?>', '<?php echo $upload_class; ?>');</script>
