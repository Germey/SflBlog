<?php
$shortname = "tool";
$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach ($categories as $category_list ) {
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}
$options = array ( 
array( "name" => $themename." Options",
       "type" => "title"),
//模块
    array( "type" => "close"),
    array( "name" => "Greeysky 选项设置 (首次使用请先点击保存设置)",
           "type" => "section"),
    array( "type" => "open"),
	array(  "name" => "是否显示zuixinAD",
			"desc" => "默认显示",
            "id" => $shortname."_zuixinAD",
            "type" => "select",
            "std" => "Hide",
            "options" => array("Display", "Hide")),			
	array(  "name" => "是否显示INDEX-BOTTOM-AD",
			"desc" => "默认显示",
            "id" => $shortname."_INDEX-BOTTOM-AD",
            "type" => "select",
            "std" => "Hide",
            "options" => array("Display", "Hide")),			
	array(  "name" => "是否suiji-ad1",
			"desc" => "默认显示",
            "id" => $shortname."_suiji-ad1",
            "type" => "select",
            "std" => "Hide",
            "options" => array("Display", "Hide")),
	array(  "name" => "是否suiji-ad",
			"desc" => "默认显示",
            "id" => $shortname."_suiji-ad",
            "type" => "select",
            "std" => "Hide",
            "options" => array("Display", "Hide")),
	array(  "name" => "是否info-box-left",
			"desc" => "默认显示",
            "id" => $shortname."_info-box-left",
            "type" => "select",
            "std" => "Hide",
            "options" => array("Display", "Hide")),
	array(  "name" => "是否显示info-box-right",
			"desc" => "默认关闭",
            "id" => $shortname."_info-box-right",
            "type" => "select",
            "std" => "Hide",
            "options" => array("Hide", "Display")),
 	array(  "name" => "是否显示info-box-center",
			"desc" => "默认关闭",
            "id" => $shortname."_info-box-center",
            "type" => "select",
            "std" => "Hide",
            "options" => array("Hide", "Display")),
	array(  "name" => "是否xiangguang-ad",
			"desc" => "默认显示",
            "id" => $shortname."_xiangguang-ad",
            "type" => "select",
            "std" => "Display",
            "options" => array("Display", "Hide")),
);
function mytheme_add_admin() {
global $themename, $shortname, $options;
if ( $_GET['page'] == basename(__FILE__) ) {
if ( 'save' == $_REQUEST['action'] ) {
		foreach ($options as $value) {
		update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
}
else if( 'reset' == $_REQUEST['action'] ) {
	foreach ($options as $value) {
		delete_option( $value['id'] ); }
	header("Location: admin.php?page=theme_options.php&reset=true");
die;
}
} 
add_theme_page($themename." Options", "Greeysky 选项设置", 'edit_themes', basename(__FILE__), 'mytheme_admin');
}
function mytheme_add_init() {
}
function mytheme_admin() {
 global $themename, $shortname, $options;
$i=0;
 if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' 主题设置已保存</strong></p></div>';
if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' 主题已重新设置</strong></p></div>';
 ?>
<h2><?php echo $themename; ?> 设置</h2>
<style>
#xuanxiang-box {width:90%;height:autopx;text-align:center;background:#fff;border:1px solid #FFAE1E;margin-toP:20px;}
h2 {height:25px;line-height:25px;}
h3 {height:50px;line-height:50px;color:#32b16c;}
.clearfix {clear:both;}
#xsubmit {width:30%;height:50px;margin:0px auto;line-height:50px;text-align:center;}
#xiangxiang {width:30%;text-align:left;margin:20px auto;}
</style>
</style>
<div id="xuanxiang-box">
<div >
<form method="post">
<?php foreach ($options as $value) {
switch ( $value['type'] ) { 
case "open":
?>
<?php
break; 
case 'select':
?>
<div id="xiangxiang">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>	
<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
		<option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>
</select>
	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>
<?php
break; 
case "checkbox":
?>
<div>
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>	
<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div>
<?php break; 
case "section":
$i++;
?>
<div>
<div><h3><?php echo $value['name']; ?></h3><div class="clearfix"></div></div>
<div> 
<?php break; 
}
}
?> 
<input type="hidden" name="action" value="save" />
<input name="save<?php echo $i; ?>" type="submit" id="button-primary" class="button-primary" value="保存设置" />
</form>
<div id="xsubmit">
<form method="post">
<input name="reset" type="submit" id="button-primary" class="button-primary" value="恢复默认" />
<input type="hidden" name="action" value="reset" />
</form>
</div>
 </div> 
<div class="kg"></div>
<?php
}
?>
<?php
add_action('admin_init', 'mytheme_add_init');
add_action('admin_menu', 'mytheme_add_admin');
?>