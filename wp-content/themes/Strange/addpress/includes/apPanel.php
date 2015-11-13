<?php
/* 
 *****************************************
 *               ADDPRESS                *
 *      option panel framework for	 *
 *             UnitedThemes              *
 *****************************************
 *     copyright by Alex Schornberg      *
 *            www.herz-as.net            *
 *         www.unitedthemes.com          *
 *****************************************
 * created with Wordpress V 3.1.2        *
 *****************************************
 */

class apPanel{

    public $panelname, $tab = array(), $error, $acttab, $actsec, $actopt;

    function  __construct($name) {
	if( $this->checkParameter() ){
	    $this->panelname = $name;
	}else{
	    $this->error = TRUE;
    }	}

    public function addTab( $name ){
	if( $this->error !== TRUE ){
	    if( $this->checkParameter() ){
		$this->acttab = $name;
		$this->tab[$this->acttab]->sec = array();
	    }else{
		$this->error = TRUE;
    }   }    }

    public function addSection( $name ){
	if( $this->error !== TRUE ){
	    if( $this->checkParameter() ){
		$this->actsec = $name;
		$this->tab[$this->acttab]->sec[$this->actsec]->opt = array();
	    }else{
		$this->error = TRUE;
    }	}   }

    public function addOption( $name, $attr = array( 'type'=>'text', 'defval'=>'', 'selopt'=>FALSE, 'comp'=>FALSE, 'callback'=>FALSE, 'static'=>FALSE, 'multihead'=>FALSE ) ){

	if( $this->error !== TRUE ){
	    if( $this->checkParameter() ){
		$this->actopt = $name;
		$this->tab[$this->acttab]->sec[$this->actsec]->opt[$this->actopt]->type = $attr['type']?$attr['type']:'text';
		$this->tab[$this->acttab]->sec[$this->actsec]->opt[$this->actopt]->defval = $attr['defval'];		
		$this->tab[$this->acttab]->sec[$this->actsec]->opt[$this->actopt]->selopt = $attr['selopt'];
		$this->tab[$this->acttab]->sec[$this->actsec]->opt[$this->actopt]->comp = $attr['comp'];
		$this->tab[$this->acttab]->sec[$this->actsec]->opt[$this->actopt]->static = $attr['static'];
		$this->tab[$this->acttab]->sec[$this->actsec]->opt[$this->actopt]->upldir = $attr['upldir'];
		$this->tab[$this->acttab]->sec[$this->actsec]->opt[$this->actopt]->addnone = $attr['addnone'];
		$this->tab[$this->acttab]->sec[$this->actsec]->opt[$this->actopt]->multihead = $attr['multihead'];
		if( !get_option( UT_THEME_INITIAL.$this->acttab.'_'.$this->actsec.'_'.$this->actopt ) ) add_option( UT_THEME_INITIAL.$this->acttab.'_'.$this->actsec.'_'.$this->actopt, $attr['defval'] );
    }	}   }

    public function addMultiOption( $name, $attr = array( 'type'=>'text', 'defval'=>'', 'selopt'=>FALSE, 'comp'=>FALSE ) ){
	if( $this->error !== TRUE ){
	    if( $this->checkParameter() ){
		$this->tab[$this->acttab]->sec[$this->actsec]->opt[$this->actopt]->multi[$name]->type = $attr['type']?$attr['type']:'text';
		$this->tab[$this->acttab]->sec[$this->actsec]->opt[$this->actopt]->multi[$name]->defval = $attr['defval'];
		$this->tab[$this->acttab]->sec[$this->actsec]->opt[$this->actopt]->multi[$name]->selopt = $attr['selopt'];
		$this->tab[$this->acttab]->sec[$this->actsec]->opt[$this->actopt]->multi[$name]->comp = $attr['comp'];
		$this->tab[$this->acttab]->sec[$this->actsec]->opt[$this->actopt]->multi[$name]->upldir = $attr['upldir'];
		$this->tab[$this->acttab]->sec[$this->actsec]->opt[$this->actopt]->multi[$name]->addnone = $attr['addnone'];
    }	}   }
    protected function checkParameter(){
	
	return true;
	
	}

    function createPanel(){

	/* js multi item append */
	foreach( $this->tab as $tabname => $tab ){
	    foreach( $tab->sec as $secname => $sec ){
		foreach( $sec->opt as $optname => $opt ){
		    
		    if( $opt->type == 'text' && !empty($opt->comp) && $opt->static==FALSE ){
			$js_comp .= "autocomp['$tabname-$secname-$optname']=";
			$js_comp .= json_encode(explode(',', $opt->comp));
			$js_comp .= ";
		    ";
		    }
		    if( $opt->type == 'multi' && $opt->static==FALSE ){
			$opt_name = $tabname.'_'.$secname.'_'.$optname;
			$js_append .= "append['$tabname-$secname-$optname']='<div class=\"multiitem addeditem\" data-id=\"'+newid+'\"><button type=\"button\" class=\"right delitem\" opt:icon=\"ui-icon-trash\" opt:text=\"false\">Delete Item</button><h4 class=\"toggle title ui-widget-header ui-state-default ui-corner-top\">New Item</h4><div class=\"content ui-widget-content ui-corner-bottom\">";
			foreach( $opt->multi as $multiname => $multi ){
			    $id = "$tabname-$secname-$optname-'+newid+'-$multiname";
			    $name = "data[$opt_name]['+newid+'][$multiname]";

			    if( $multi->type != 'hidden' ){
				$js_append .= "<div class=\"label\"><label for=\"$id\">".htmlspecialchars(constant( 'AP_MT_'.strtoupper($tabname.'_'.$secname.'_'.$optname.'_'.$multiname) ),ENT_QUOTES)."</label></div>";
				$js_append .= "";
				$js_append .= "<div class=\"option\">";
			    }
			    switch( $multi->type ){
				CASE 'select':
				    $js_append .= "<div class=\"selectset\"><select name=\"$name\" id=\"$id\">";
				    foreach( $multi->selopt as $val => $title ){
					$js_append .= "<option".($val==$value?' selected="selected"':'')."  value=\"$val\">".(!empty($title)?$title:constant( 'AP_OO_'.strtoupper($tabname.'_'.$secname.'_'.$optname.'_'.$multiname.'_'.$val) ) )."</option>";
				    }
				    $js_append .= '</select></div>';
				    break;

				CASE 'checkbox':
				    $js_append .= '<div class="checkset">';
				    foreach( $multi->selopt as $val => $title ){
					$js_append .= '<input type="checkbox"'.($val==$multi->defval?' checked="checked"':'').' name="'.$name.'" value="'.$val.'" id="'.$id.'-'.$val.'" /><label for="'.$id.'-'.$val.'"'.($val==$multi->defval?' class="checked"':'').'>'.(!empty($title)?$title:constant( 'AP_OO_'.strtoupper($tabname.'_'.$secname.'_'.$optname.'_'.$multiname.'_'.$val) ) ).'</label>';
				    }
				    $js_append .= '</div>';
				    break;

				CASE 'radio':
				    $js_append .= '<div class="radioset">';
				    foreach( $multi->selopt as $val => $title ){
					$js_append .= '<input type="radio"'.($val==$multi->defval?' checked="checked"':'').' name="'.$name.'" value="'.$val.'" id="'.$id.'-'.$val.'" /><label for="'.$id.'-'.$val.'"'.($val==$multi->defval?' class="checked"':'').'>'.(!empty($title)?$title:constant( 'AP_OO_'.strtoupper($tabname.'_'.$secname.'_'.$optname.'_'.$multiname.'_'.$val) ) ).'</label>';
				    }
				    $js_append .= '</div>';
				    break;

				CASE 'upload':
				    $dir_files = scandir(  get_theme_root().'/'.get_template().''.$multi->upldir );
				    $js_append .= '<div id="'.$id.'-upload" class="upload-wrap"><div class="selectset"><select name="'.$name.'" id="'.$id.'" class="ap-upload-dir-'.preg_replace('@[^a-zA-Z0-9\-_]@','-',$multi->upldir).'">';
				    if( isset($multi->addnone) && !empty($multi->addnone) )
					$js_append .= '<option value="none">%(%div class="ap-thumb"%)%%(%/div%)%%(%div class="ap-file-info"%)%%(%strong%)%'.$multi->addnone.'%(%/strong%)%%(%/div%)%</option>';
				    foreach( $dir_files as $file ) {
					if( $file != '.' && $file != '..' ){
					    $mime_type = ap_get_mime_content_type( get_theme_root().'/'.get_template().''.$optObj->upldir.'/'.$file ).'<br />';
					    if( strpos( $mime_type, 'image' ) === 0 )
						$image = '<img src="'. home_url().'/wp-content/themes/'.get_template().''.$multi->upldir.'/'.$file.'" class="ap-upload-preview" />';
					    else
						$image = '<img src="'.$theme_path.'/addpress/images/darkicons/icon_webdev.gif" class="ap-fileicon" />';
					    $js_append .= '<option'.(home_url().'/wp-content/themes/'.get_template().''.$multi->upldir.'/'.$file==$value?' selected="selected"':'').' value="'. home_url().'/wp-content/themes/'.get_template().''.$multi->upldir.'/'.$file.'">';
					    $js_append .= str_replace( array('<','>'), array('%(%','%)%'), '<div class="clear file-list-file"><div class="ap-thumb">'.$image.'</div><div class="ap-file-info"><strong>'.$file.'</strong></div><span><a href="#" class="delete-file" data-file="'.$multi->upldir.'/'.$file.'"></a></span></div>' );
					    $js_append .= '</option>';
				    }	}
				    $js_append .= '</select></div>';
				    $js_append .= '<span class="upload-button-wrap"><input class="fileupload-file" id="'.$id.'-file" name="file_upload" type="file" data-id="'.$id.'" data-dir="'.$multi->upldir.'" /><button type="button" class="select-file">upload file</button><div class="uploadstatus"></div></span></div>';
				    break;

				CASE 'textarea':
				    $js_append .= "<textarea name=\"$name\" id=\"$id\">".htmlspecialchars($multi->defval,ENT_QUOTES)."</textarea>";
				    break;

				CASE 'color':
				    $js_append .= '<input type="text" name="'.$name.'" id="'.$id.'" value="'.$multi->defval.'" class="color left" maxlength="11" style="width:100px" /><div class="cp" id="'.$id.'-colpick" style="background-color:'.$multi->defval.'"></div><div class="clear"></div>';
				    break;

				CASE 'hidden':
				    $js_append .= "<input type=\"hidden\" name=\"$name\" id=\"$id\" value=\"".htmlspecialchars($multi->defval,ENT_QUOTES)."\" />";
				    break;
				CASE 'text':
				DEFAULT:
				    if( $multi->comp !== FALSE ){
					$js_comp .= "autocomp['$tabname-$secname-$optname-$multiname']=";
					$js_comp .= json_encode(explode(',', $multi->comp));
					$js_comp .= ";
		    ";
				    }
				    $js_append .= "<input type=\"text\" name=\"$name\" id=\"$id\" value=\"".htmlspecialchars($multi->defval,ENT_QUOTES)."\"".(($multi->comp!==FALSE)?' class="autocomplete" data-comp="'.$tabname.'-'.$secname.'-'.$optname.'-'.$multiname.'"':'')." />";
			    }
			    if( $multi->type != 'hidden' )
			    $js_append .= "</div>".( constant( 'AP_MI_'.strtoupper($tabname.'_'.$secname.'_'.$optname.'_'.$multiname) )?"<div class=\"info-arrow\"></div><div class=\"comment ui-state-disabled\">".esc_attr(constant( 'AP_MI_'.strtoupper($tabname.'_'.$secname.'_'.$optname.'_'.$multiname)))."</div>":"" )."<div class=\"clear\"></div><div class=\"break\"></div>";
			}
			$js_append .= "</div><div class=\"clear\"></div>';";
		    }
		}
	    }
	}
	echo "
	<script type='text/javascript'>
	$(function() {
	    $('.delitem').live('click', function(){
		$(this).parent('.multiitem').hide('blind', function(){ $(this).remove() });
	    });
	    var append = [], newid;
	    $('.additem').live('click', function(){
		var item = $(this);
		newid = $( '#multiitems-'+item.attr('id')+' .multiitem:last' ).attr('data-id')||0;
		newid++;
		$js_append
		var newitem = $( append[$(this).attr('id')] ).hide();
		item.before( newitem.show('blind') );
		item.parent().find('.selectset').apFancySelect();
		item.parent().find('.cp, .color').ColorPicker( {
		    color: '#FF0000',
		    onBeforeShow: function(){ elID = this; },
		    onShow: function (colpkr) { $(colpkr).fadeIn(500); return false; },
		    onHide: function (colpkr) { $(colpkr).fadeOut(500); return false; },
		    onChange: function (hsb, hex, rgb) {
			$(elID).parents('.option').find('.cp').css('backgroundColor', '#'+hex);
			$(elID).parents('.option').find('input').val('#'+hex.toUpperCase());
		    }
		}).live('keyup',function(){
		    var e = $(this);
		    if( e.hasClass('color') )
			e.ColorPickerSetColor( e.val().replace('#','') ).parents('.option').find('.cp').css( 'background-color', e.val() );
		});
	    });
	    /*$( 'input.autocomplete' )
		.live( 'focus', function(){
		    var autocomp = [];
		    $js_comp
		    $('input.autocomplete').autocomplete('destroy');
		    $(this).autocomplete({ source: autocomp[$(this).attr('data-comp')], delay: 0 })
	    });*/
	});
	</script>
	";

	echo '
<div id="ap-panel-page-wrap">
    <form action="'.$_SERVER['REQUEST_URI'].'" method="POST" id="ap-'.$this->panelname.'-form" class="ap-panel-form">
	<input type="hidden" name="action" class="" value="save" />
	<div id="ap-'.$this->panelname.'-header" class="ap-panel-header">
	    <div id="ap-infobutton" class="right"></div>
	    <div class="clear"></div>
	    <button type="submit" id="ap-save-changes" class="right">Save Changes</button>
	    <div class="clear"></div>
	</div>';

	/* tab menu */
	echo '
	<div class="ap-panel-tabs" id="ap-'.$this->panelname.'-tabs">
	    <ul>';
	$i=0;
	foreach( $this->tab as $tabname => $tab ){
	    echo '
		<li><a href="#ap-'.$this->panelname.'-'.$tabname.'-content" id="'.$this->panelname.'-'.$tabname.'-tab" class="'.$tab->class.($i>=1?'':' first-child').'">'.constant( 'AP_TT_'.strtoupper($tabname) ).'</a></li>';
	    $i++;
	}
	echo '
	    </ul>';

	/* tab content */
	$i=0;
	foreach( $this->tab as $tabname => $tab ){
	    echo '
	    <div id="ap-'.$this->panelname.'-'.$tabname.'-content" class="'.($i>=1?'':'first-child ').'ap-panel-tabcontent relative hidden '.$tab->class.'">';
	    if( constant( 'AP_TI_'.strtoupper($tabname) ) ){
		echo '
		<div class="info"><span class="left ap-icon ap-icon-info"></span>'.constant( 'AP_TI_'.strtoupper($tabname) ).'</div>';
	    }
	    foreach( $tab->sec as $secname => $sec ){
		echo '
		<div class="ap-section" id="'.$tabname.'-'.$secname.'" class="">
		    <h3 class="title toggle">'.constant( 'AP_ST_'.strtoupper($tabname).'_'.strtoupper($secname) ).'</h3>';
		echo '
		    <div class="content">';
		if( constant( 'AP_SI_'.strtoupper($tabname.'_'.$secname) ) ){
		    echo '
			<div class="info"><span class="left ap-icon ap-icon-info"></span>'.constant( 'AP_SI_'.strtoupper($tabname.'_'.$secname) ).'</div>';
		}
		    foreach( $sec->opt as $optname => $opt ){
			if( $opt->type == 'hidden' ){
			    echo $this->getHtmlInput(array('tab'=>$tabname,'sec'=>$secname,'opt'=>$optname), $opt);
			}else{
			    if( $opt->type != 'multi' ){
				echo '
			<div class="label"><label for="'.$tabname.'-'.$secname.'-'.$optname.'">'.constant( 'AP_OT_'.strtoupper($tabname.'_'.$secname.'_'.$optname) ).'</label></div>
			<div class="option">'.$this->getHtmlInput(array('tab'=>$tabname,'sec'=>$secname,'opt'=>$optname), $opt).'</div>
			'.( constant( 'AP_OI_'.strtoupper($tabname.'_'.$secname.'_'.$optname) )?'<div class="info-arrow"></div><div class="comment ui-state-disabled">'.constant( 'AP_OI_'.strtoupper($tabname.'_'.$secname.'_'.$optname) ).'</div>':'').'
			<div class="clear"></div>
			<div class="break"></div>';
			    }else{
				echo '<div id="multiitems-'.$tabname.'-'.$secname.'-'.$optname.'">';
				echo $this->getHtmlInput(array('tab'=>$tabname,'sec'=>$secname,'opt'=>$optname), $opt);
				echo '</div>';
			    }
			}
		    }
		    echo '
		    </div><!-- /sec-content -->
		</div><!-- /section -->';
	    }
	    echo '	
	    </div><!-- /tab -->';
	    $i++;
	}
	echo '
	</div><!-- /ap-panel -->
	<div class="clear" style="position:relative;"></div>
    </form>
    <form id="upload-form" enctype="multipart/form-data" action="'.home_url().'/wp-content/themes/'.get_template().'/addpress/includes/ap_fileupload.php?themeroot='.get_theme_root().'/'.get_template().'&homeurl='.home_url().'&template='.get_template().'" method="POST" onsubmit="return true;" target="iframe_upload"></form>
    <iframe id="iframe_upload" name="iframe_upload" src="" style="width:0px;height:0px;border:0"></iframe>
<div><div class="clear"></div>
<div id="ap-thumb-preview" class="ap-shadow"></div>
';
    }

    function getHtmlInput( $arrNames, $optObj, $id='', $is_multi=false ){

	$theme_path = get_template_directory_uri();

	$opt_name = $arrNames['tab'].'_'.$arrNames['sec'].'_'.$arrNames['opt'];
	$get_option = get_option( UT_THEME_INITIAL.$opt_name );
	$const = $arrNames['tab'].'_'.$arrNames['sec'].'_'.(isset($arrNames['_opt'])?$arrNames['_opt']:$arrNames['opt']).(isset($arrNames['_multi'])?'_'.$arrNames['_multi']:'');
	$value = !empty($get_option)||is_array($get_option)?$get_option:($is_multi?$optObj->defval:$get_option);
	$id = empty($id) ? $arrNames['tab'].'-'.$arrNames['sec'].'-'.$arrNames['opt'] : $id;
	switch( $optObj->type ){
	    CASE 'select':
		$return .= '
		    <div class="selectset"><select name="data['.$opt_name.']" id="'.$id.'">';
		foreach( $optObj->selopt as $val => $title ){
		    $return .= '<option'.($val==$value?' selected="selected"':'').' value="'.($val).'">'.( !empty($title) ? $title : constant('AP_OO_'.strtoupper($const.'_'.$val)) ).'</option>';
		}
		$return .= '</select></div>';
		break;
		
	    CASE 'checkbox':
		$return .= '<div class="checkset">';
		$i=0;
		foreach( $optObj->selopt as $val => $title ){
		    $return .= '<input type="hidden" name="data['.$opt_name.']['.$i.']" value="" />';
		    $return .= '<input type="checkbox"'.(in_array($val,$value)?' checked="checked"':'').' name="data['.$opt_name.']['.$i.']" value="'.$val.'" id="'.$id.'-'.$val.'" /><label for="'.$arrNames['tab'].'-'.$arrNames['sec'].'-'.$arrNames['opt'].'-'.$val.'">'.stripslashes(( !empty($title) ? $title : constant('AP_OO_'.strtoupper($const.'_'.$val)) )).'</label>';
		    $i++;
		}
		$return .= '</div>';
		break;

	    CASE 'radio':
		$return .= '<div class="radioset">';
		foreach( $optObj->selopt as $val => $title ){
		    $return .= '<input type="radio"'.($val==$value?' checked="checked"':'').' name="data['.$opt_name.']" value="'.$val.'" id="'.$id.'-'.$val.'" /><label for="'.$id.'-'.$val.'">'.stripslashes( !empty($title) ? $title : constant('AP_OO_'.strtoupper($const.'_'.$val)) ).'</label>';
		}
		$return .= '</div>';
		break;

	    CASE 'textarea':
		$return .= '<textarea name="data['.$opt_name.']" id="'.$id.'">'.($value).'</textarea>';
		break;

	    CASE 'color':
		$return .= '<input type="text" name="data['.$opt_name.']" id="'.$id.'" value="'.$value.'" class="color left" maxlength="11" style="width:100px" /><div class="cp" id="'.$id.'-colpick" style="background-color:'.$value.'"></div><div class="clear"></div>';
		break;

	    CASE 'upload':
		$dir_files = scandir( get_theme_root().'/'.get_template().''.$optObj->upldir );
		$return = '
		    <div id="'.$id.'-upload" class="upload-wrap">
			<div class="selectset"><select name="data['.$opt_name.']" id="'.$id.'" class="ap-upload-dir-'.preg_replace('@[^a-zA-Z0-9\-_]@','-',$optObj->upldir).'">';
		if( isset($optObj->addnone) && !empty($optObj->addnone) )
		    $return .= '<option value="none">%(%div class="clear file-list-file"%)%%(%div class="ap-thumb"%)%%(%/div%)%%(%div class="ap-file-info"%)%%(%strong%)%'.$optObj->addnone.'%(%/strong%)%%(%/div%)%%(%/div%)%</option>';
		foreach( $dir_files as $file ) {
		    if( $file != '.' && $file != '..' ){
			$mime_type = ap_get_mime_content_type( get_theme_root().'/'.get_template().''.$optObj->upldir.'/'.$file ).'<br />';
			if( strpos( $mime_type, 'image' ) === 0 )
			    $image = '<img src="'.$theme_path.''.$optObj->upldir.'/'.$file.'" class="ap-upload-preview" />';
			else
			    $image = '<img src="'.$theme_path.'/addpress/images/darkicons/icon_webdev.gif" class="ap-fileicon" />';
			$return .= '
			    <option'.($theme_path.''.$optObj->upldir.'/'.$file==$value?' selected="selected"':'').' value="'. $theme_path.''.$optObj->upldir.'/'.$file.'">';
			$return .= str_replace( array('<','>'), array('%(%','%)%'), '
			    <div class="clear file-list-file">
				<div class="ap-thumb">'.$image.'</div>
				<div class="ap-file-info"><strong>'.$file.'</strong><br />'.$_size[0].'x'.$_size[1].'px</div>
				<span><a href="#" class="delete-file" data-file="'.$optObj->upldir.'/'.$file.'"></a></span>
			    </div>' );
			$return .= '
			    </option>';
		    }
		}
		$return .= '</select></div>';
		$return .= '
		    <span class="upload-button-wrap">
			<input class="fileupload-file" id="'.$id.'-file" name="file_upload" type="file" data-id="'.$id.'" data-dir="'.$optObj->upldir.'" />
			<button type="button" class="select-file" id="'.$id.'-button">upload file</button>
			<div class="uploadstatus"></div>
		    </span>
		    </div>';
		break;

	    CASE 'multi':

		$value = $get_option;
		if( !empty($value) && !is_array($value) )
		    $value = json_decode ($value, TRUE);
		$return .= '<input type="hidden" name="data['.$opt_name.']" value="" />';
		if( !empty($value) ){
		foreach( $value as $num => $opt ){
		    $return .= '
		    <div class="multiitem" data-id="'.$num.'">';
		    if( $optObj->static==FALSE ){ $return .='
			<button type="button" class="right delitem">Delete Item</button>';
		    }
		    $return .= '
			<h4 class="toggle title">'.(isset($optObj->multihead)&&!empty($opt[$optObj->multihead])?$opt[$optObj->multihead]:$num.'. Item').'</h4>
			<div class="content">';
		    foreach( $optObj->multi as $name => $multiOptObj ){
			if( $opt != 'defval' ) $multiOptObj->defval = $opt[$name];
			if( $multiOptObj->type == 'hidden' ){
			    $return .= $this->getHtmlInput(array('tab'=>$arrNames['tab'], 'sec'=>$arrNames['sec'], 'opt'=>$arrNames['opt'].']['.$num.']['.$name, '_opt'=>$arrNames['opt'], '_multi'=>$name), $multiOptObj, $id.'-'.$num.'-'.$name, true);
			}else{
			    $label = ($multiOptObj->type != 'radio') ? ' for="'.$id.'-'.$num.'-'.$name.'-'.$opt[$name].'"' : '';
			    $return .= '
			    <div class="label"><label'.$label.'>'.stripslashes(constant( 'AP_MT_'.strtoupper($arrNames['tab'].'_'.$arrNames['sec'].'_'.$arrNames['opt'].'_'.$name) )).'</label></div>
			    <div class="option">'.$this->getHtmlInput(array('tab'=>$arrNames['tab'], 'sec'=>$arrNames['sec'], 'opt'=>$arrNames['opt'].']['.$num.']['.$name, '_opt'=>$arrNames['opt'], '_multi'=>$name), $multiOptObj, $id.'-'.$num.'-'.$name, true).'</div>
			    '.( constant( 'AP_MI_'.strtoupper($arrNames['tab'].'_'.$arrNames['sec'].'_'.$arrNames['opt'].'_'.$name) ) ?'<div class="info-arrow"></div><div class="comment ui-state-disabled">'.stripslashes( constant( 'AP_MI_'.strtoupper($arrNames['tab'].'_'.$arrNames['sec'].'_'.$arrNames['opt'].'_'.$name) ) ).'</div>':'').'
			    <div class="clear"></div>
			    <div class="break"></div>';
			}
		    }
		    $return .= '
			</div>
		    </div>';
		} }
		if( $optObj->static==FALSE ){
		    $return .= '<button type="button" class="additem" id="'.$arrNames['tab'].'-'.$arrNames['sec'].'-'.$arrNames['opt'].'">Add Item</button>';
		}
		break;
	    CASE 'hidden':
		$return = '<input type="hidden" name="data['.$opt_name.']" value="'.($value).'" id="'.$id.'" />';
		break;
	    CASE 'text':
	    DEFAULT:
		$compname = preg_replace('#\]\[\d+\]\[#i', '-', $arrNames['opt']);
		$return = '<input type="text" name="data['.$opt_name.']" value="'.($value).'" id="'.$id.'"'.(($optObj->comp!==FALSE)?' class="autocomplete" data-comp="'.$arrNames['tab'].'-'.$arrNames['sec'].'-'.$compname.'"':'').' />';
	}
	return $return;
    }
}
?>