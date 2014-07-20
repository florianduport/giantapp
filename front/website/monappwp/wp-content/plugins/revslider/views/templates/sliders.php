<?php
	$exampleID = '"slider1"';
    $dir = plugin_dir_path(__FILE__).'../../';
	if(!empty($arrSliders))
		$exampleID = '"'.$arrSliders[0]->getAlias().'"';
		
	$outputTemplates = false;
	$latest_version = get_option('revslider-latest-version', GlobalsRevSlider::SLIDER_REVISION);
   if(version_compare($latest_version, GlobalsRevSlider::SLIDER_REVISION, '>')){
    //neue version existiert
   }else{
    //up to date
   }

	
?>

	<div class='wrap'>
		<div class="clear_both"></div> 

		<div class="title_line">
			<div class="view_title">
				<?php _e("Revolution Sliders",REVSLIDER_TEXTDOMAIN)?>
			</div>
			
			<a href="<?php echo GlobalsRevSlider::LINK_HELP_SLIDERS?>" class="button-secondary float_right mtop_10 mleft_10" target="_blank"><?php _e("Help",REVSLIDER_TEXTDOMAIN)?></a>			
			
			<a id="button_general_settings" class="button-secondary float_right mtop_10"><?php _e("Global Settings",REVSLIDER_TEXTDOMAIN)?></a>
			
		</div>

		<?php if(empty($arrSliders)): ?>
			<?php _e("No Sliders Found",REVSLIDER_TEXTDOMAIN)?>
			<br>
		<?php else:
			 require self::getPathTemplate("sliders_list");	 		
		endif?>
	
		<p>			
			<a class='button-primary revblue' href='<?php echo $addNewLink?>'><?php _e("Create New Slider",REVSLIDER_TEXTDOMAIN)?> </a>
			<a id="button_import_slider" class='button-primary float_right revgreen' href='javascript:void(0)'><?php _e("Import Slider",REVSLIDER_TEXTDOMAIN)?> </a>		
		</p>

		<!-- 
		THE SLIDER TEMPLATES
		-->
		<div style="width:100%;height:17px"></div>
		<div class="title_line"><div class="view_title"><?php _e("Revolution Slider Templates",REVSLIDER_TEXTDOMAIN)?></div></div>
		<?php if(empty($arrSlidersTemplates)){ ?>
			<?php _e("No Template Sliders Found",REVSLIDER_TEXTDOMAIN)?>
			<br>
		<?php }else{
				$outputTemplates = true;
				require self::getPathTemplate("sliders_list");	 		
			}
			?>		
		<p><a class='button-primary revblue' href='<?php echo $addNewTemplateLink?>'><?php _e("Create New Template Slider",REVSLIDER_TEXTDOMAIN)?> </a></p>

		<div style="width:100%;height:50px"></div>

	
		<!-- 
		THE INFO ABOUT EMBEDING OF THE SLIDER 			
		-->
		<div class="title_line"><div class="view_title"><?php _e("How To Use the Slider",REVSLIDER_TEXTDOMAIN)?></div></div>		

		<div style="border:1px solid #e5e5e5; padding:15px 15px 15px 80px; border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;position:relative;overflow:hidden;background:#f1f1f1">		
			<div class="revyellow" style="left:0px;top:0px;position:absolute;height:100%;padding:20px 10px;"><i style="color:#fff;font-size:25px" class="revicon-arrows-ccw"></i></div>
				<p style="margin:5px 0px">
				<?php _e("From the",REVSLIDER_TEXTDOMAIN)?> <b><?php _e("page and/or post editor",REVSLIDER_TEXTDOMAIN)?></b> <?php _e("insert the shortcode from the sliders table",REVSLIDER_TEXTDOMAIN)?></br>				
				</br>
				<?php _e("From the",REVSLIDER_TEXTDOMAIN)?> <b><?php _e("theme html",REVSLIDER_TEXTDOMAIN)?></b> <?php _e("use",REVSLIDER_TEXTDOMAIN)?>: <code>&lt?php putRevSlider( "alias" ) ?&gt</code> <?php _e("example",REVSLIDER_TEXTDOMAIN)?>: <code>&lt?php putRevSlider(<?echo $exampleID?>) ?&gt</code><br>
				<span style="margin-left:20px"><?php _e("For show only on homepage use",REVSLIDER_TEXTDOMAIN)?>: <code>&lt?php putRevSlider(<?echo $exampleID?>,"homepage") ?&gt</code></span></br>
				<span style="margin-left:20px"><?php _e("For show on certain pages use",REVSLIDER_TEXTDOMAIN)?>: <code>&lt?php putRevSlider(<?echo $exampleID?>,"2,10") ?&gt</code></span></br> 
				</br>
				<?php _e("From the",REVSLIDER_TEXTDOMAIN)?> <b><?php _e("widgets panel",REVSLIDER_TEXTDOMAIN)?></b> <?php _e("drag the \"Revolution Slider\" widget to the desired sidebar",REVSLIDER_TEXTDOMAIN)?></br>
				</p>	
		</div>
		
		<div style="width:100%;height:50px"></div>
		<!-- 
		THE CURRENT AND NEXT VERSION		
		-->
		<div class="title_line"><div class="view_title"><?php _e("Version Information",REVSLIDER_TEXTDOMAIN)?></div></div>		
		
		<div style="border:1px solid #e5e5e5; padding:15px 15px 15px 80px; border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;position:relative;overflow:hidden;background:#f1f1f1">		
			<div class="revgray" style="left:0px;top:0px;position:absolute;height:100%;padding:27px 10px;"><i style="color:#fff;font-size:25px" class="revicon-info-circled"></i></div>
			<p style="margin-top:5px; margin-bottom:5px;">
				<?php _e("Installed Version",REVSLIDER_TEXTDOMAIN)?>: <span  class="slidercurrentversion"><?php echo GlobalsRevSlider::SLIDER_REVISION; ?></span><br>
				<?php _e("Latest Available Version",REVSLIDER_TEXTDOMAIN)?>: <span class="slideravailableversion"><?php echo $latest_version; ?></span>
			</p>
		</div>
			
		
		

				
		<!--
		ACTIVATE THIS PRODUCT 
		-->
		<a name="activateplugin"></a>
		<div style="width:100%;height:50px"></div>

		<div class="title_line">
			<div class="view_title"><span style="margin-right:10px"><?php _e("Need Premium Support and Auto Updates ?",REVSLIDER_TEXTDOMAIN) ?></span><a style="vertical-align:middle" class='button-primary revblue' href='#' id="benefitsbutton"><?php _e("Why is this Important ?",REVSLIDER_TEXTDOMAIN)?> </a></div>
		</div>
		
		<div id="benefitscontent" style="margin-top:10px;margin-bottom:10px;display:none;border:1px solid #e5e5e5; padding:15px 15px 15px 80px; border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;position:relative;overflow:hidden;background-color:#fff;">		
			<div class="revblue" style="left:0px;top:0px;position:absolute;height:100%;padding:27px 10px;"><i style="color:#fff;font-size:25px" class="revicon-doc"></i></div>
			<h3> <?php _e("Benefits",REVSLIDER_TEXTDOMAIN)?>:</h3>
			<p>
			<strong><?php _e("Get Premium Support",REVSLIDER_TEXTDOMAIN); ?></strong><?php _e(" - We help you in case of Bugs, installation problems, and Conflicts with other plugins and Themes ",REVSLIDER_TEXTDOMAIN); ?><br>
			<strong><?php _e("Auto Updates",REVSLIDER_TEXTDOMAIN); ?></strong><?php _e(" - Get the latest version of our Plugin.  New Features and Bug Fixes are available regularly !",REVSLIDER_TEXTDOMAIN); ?>
			</p>
		</div>
		
		
		<!-- 
		VALIDATION
		-->
		<div id="tp-validation-box" style="cursor:pointer; border:1px solid #e5e5e5; margin-top:10px;padding:15px 15px 15px 80px; border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;position:relative;overflow:hidden;background:#f1f1f1">		
				<?php self::requireView("system/validation")?>																					
		</div>
		

		<!-- THE UPDATE HISTORY OF SLIDER REVOLUTION -->
		<div style="width:100%;height:50px"></div>	
		
		<div class="title_line">
			<div class="view_title"><span style="margin-right:10px"><?php _e("Update History",REVSLIDER_TEXTDOMAIN) ?></span></div>
		</div>
				
		<div style="border:1px solid #e5e5e5;  height:500px;padding:25px 15px 15px 80px; border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;position:relative;overflow:hidden;background:#f1f1f1">		
			<div class="revpurple" style="left:0px;top:0px;position:absolute;height:100%;padding:27px 10px;"><i style="color:#fff;font-size:27px" class="eg-icon-back-in-time"></i></div>
			<div style="height:485px;overflow:scroll;width:100%;"><?php echo file_get_contents($dir."release_log.html"); ?></div>							
		</div>
	</div>
	
	<!-- Import slider dialog -->
	<div id="dialog_import_slider" title="<?php _e("Import Slider",REVSLIDER_TEXTDOMAIN)?>" class="dialog_import_slider" style="display:none">
		<form action="<?php echo UniteBaseClassRev::$url_ajax?>" enctype="multipart/form-data" method="post">
		    <br>
		    <input type="hidden" name="action" value="revslider_ajax_action">
		    <input type="hidden" name="client_action" value="import_slider_slidersview">
		    <input type="hidden" name="nonce" value="<?php echo wp_create_nonce("revslider_actions"); ?>">
		    <?php _e("Choose the import file",REVSLIDER_TEXTDOMAIN)?>:   
		    <br>
			<input type="file" size="60" name="import_file" class="input_import_slider">
			<br><br>
			<span style="font-weight: 700;"><?php _e("Note: custom styles will be updated if they exist!",REVSLIDER_TEXTDOMAIN)?></span><br><br>
			<table>
				<tr>
					<td><?php _e("Custom Animations:",REVSLIDER_TEXTDOMAIN)?></td>
					<td><input type="radio" name="update_animations" value="true" checked="checked"> <?php _e("overwrite",REVSLIDER_TEXTDOMAIN)?></td>
					<td><input type="radio" name="update_animations" value="false"> <?php _e("append",REVSLIDER_TEXTDOMAIN)?></td>
				</tr>
				<tr>
					<td><?php _e("Static Styles:",REVSLIDER_TEXTDOMAIN)?></td>
					<td><input type="radio" name="update_static_captions" value="true" checked="checked"> <?php _e("overwrite",REVSLIDER_TEXTDOMAIN)?></td>
					<td><input type="radio" name="update_static_captions" value="false"> <?php _e("append",REVSLIDER_TEXTDOMAIN)?></td>
				</tr>
			</table>
			<br><br>
			<input type="submit" class='button-primary' value="<?php _e("Import Slider",REVSLIDER_TEXTDOMAIN)?>">
		</form>		
		
	</div>
	
	<script type="text/javascript">
		jQuery(document).ready(function(){
			RevSliderAdmin.initSlidersListView();
			jQuery('#benefitsbutton').hover(function() {
				jQuery('#benefitscontent').slideDown(200);
			}, function() {
				jQuery('#benefitscontent').slideUp(200);				
			})
			
			jQuery('#tp-validation-box').click(function() {
				jQuery(this).css({cursor:"default"});
				if (jQuery('#rs-validation-wrapper').css('display')=="none") {
					jQuery('#tp-before-validation').hide();
					jQuery('#rs-validation-wrapper').slideDown(200);
				}
			})
		});
	</script>
	