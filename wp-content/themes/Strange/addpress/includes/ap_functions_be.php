<?php

/**********************************************
 * return files in directory for autocomplete *
 **********************************************/
function directoryToArray($directory, $recursive) {
    $array_items = array();
    if ($handle = opendir($directory)) {
	while (false !== ($file = readdir($handle))) {
	    if ($file != "." && $file != "..") {
		if (is_dir($directory. "/" . $file)) {
		    if($recursive) {
			$array_items = array_merge($array_items, directoryToArray($directory. "/" . $file, $recursive));
		    }
		    $file = $directory . "/" . $file;
		    $array_items[] = preg_replace("/\/\//si", "/", $file);
		} else {
		    $file = $directory . "/" . $file;
		    $array_items[] = preg_replace("/\/\//si", "/", $file);
	}   }	}
	closedir($handle);
    }
    return $array_items;
}

/****************************
 * highlight custom widgets *
 ****************************/
add_action('admin_print_styles-widgets.php', 'ap_custom_widget_style');
function ap_custom_widget_style()
{
    echo <<<EOF
<style type="text/css">
div.widget[id*=_ap_] .widget-title {
    color: #2191bf;
}
</style>
EOF;
}

/********************************
 * return installed theme fonts *
 ********************************/
function ap_get_themefonts_array(){
    $themefonts = get_option( UT_THEME_INITIAL.'fonts_manage_font' );
    if( is_array($themefonts) ){
        foreach( $themefonts as $num => $font ){
	    wp_register_style('googlefont'.$num, $font['url']);
	    wp_enqueue_style( 'googlefont'.$num );
	    $theme_fonts[$num] = '%(%span style="font-family:'.$font['name'].';"%)%'.$font['name'].'%(%/span%)%';
	}
    }
    return $theme_fonts;
}

/**************************************
 * return post & portfolio categories *
 **************************************/
function ap_get_categories_array(){
    $categories = get_categories();
    foreach( $categories as $num => $aCategory ){
        $cats[$aCategory->cat_ID] = $aCategory->name;
    }
    $portfolio_categories = get_terms('portfolio_category', array('hide_empty'=>false));
    foreach( $portfolio_categories as $num => $portfolio_category ){
	$args = 'taxonomy=portfolio_category#field=id#terms='.$portfolio_category->term_id;
	$pcats[$args] = $portfolio_category->name;
    }
    foreach( $categories as $num => $aCategory ){
	$args = 'taxonomy=category#field=id#terms='.$aCategory->cat_ID;
        $pcats[$args] = $aCategory->name;
    }
    return $pcats;
}

/*****************************
 * return installed sidebars *
 *****************************/
function ap_get_sidebars_array(){
    $sidebars = (get_option(UT_THEME_INITIAL.'sidebars_manage_sidebar'));
    $_sidebars = array( 'none' =>  __('No Sidebar', UT_THEME_NAME) );
    foreach( $sidebars as $num => $sidebar ){
	$_sidebars[$num] = $sidebar['name'];
    }
    return $_sidebars;
}

/*******************************
 * return footer layouts array *
 *******************************/
function ap_get_footerlayout_array(){
    $footer_layout = array(
	'2_2_2_2_2_2'=>'1 - 1 - 1 - 1 - 1 - 1',
	'4_2_2_2_2'=>'2 - 1 - 1 - 1 - 1',
	'2_4_2_2_2'=>'1 - 2 - 1 - 1 - 1',
	'2_2_4_2_2'=>'1 - 1 - 2 - 1 - 1',
	'2_2_2_4_2'=>'1 - 1 - 1 - 2 - 1',
	'2_2_2_2_4'=>'1 - 1 - 1 - 1 - 2',
	'6_2_2_2'=>'3 - 1 - 1 - 1',
	'2_6_2_2'=>'1 - 3 - 1 - 1',
	'2_2_6_2'=>'1 - 1 - 3 - 1',
	'2_2_2_6'=>'1 - 1 - 1 - 3',
	'8_2_2'=>'4 - 1 - 1',
	'2_8_2'=>'1 - 4 - 1',
	'2_2_8'=>'1 - 1 - 4',
	'6_6'=>'3 - 3',
	'12'=>'6'
    );
    foreach($footer_layout as $key => $val ){
	$columns = explode('_', $key);
	$layout = '';
	foreach($columns as $i => $column ){
	    $layout .= '<div class="ap-footer-brick" style="width: '.($column/2*16).'px;"></div>';
	}
	$layout .= ' <div class="clear"></div>';
	$footer_layout[$key]=str_replace(array('<','>'), array('%(%', '%)%'), $layout);
    }
    return $footer_layout;
}

/*
 * FILE MIME TYPE
 */

    function ap_get_mime_content_type($filename) {

        $mime_types = array(

            'txt' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',

            // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',

            // archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',

            // audio/video
            'mp3' => 'audio/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',

            // adobe
            'pdf' => 'application/pdf',
            'psd' => 'image/vnd.adobe.photoshop',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',

            // ms office
            'doc' => 'application/msword',
            'rtf' => 'application/rtf',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',

            // open office
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        );

        $ext = strtolower(array_pop(explode('.',$filename)));
        if (array_key_exists($ext, $mime_types)) {
            return $mime_types[$ext];
        }
        elseif (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME);
            $mimetype = finfo_file($finfo, $filename);
            finfo_close($finfo);
            return $mimetype;
        }
        else {
            return 'application/octet-stream';
        }
    }

?>
