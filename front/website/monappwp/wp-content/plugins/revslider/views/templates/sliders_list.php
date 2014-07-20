
	<table class='wp-list-table widefat fixed unite_table_items'>
		<thead>
			<tr>
				<th width='20px'><?php _e("ID",REVSLIDER_TEXTDOMAIN)?></th>
				<th width='25%'><?php _e("Name",REVSLIDER_TEXTDOMAIN)?></th>
				<?php
				if(!$outputTemplates){
				?>
				<th width='120px'><?php _e("Shortcode",REVSLIDER_TEXTDOMAIN)?> </th>
				<?php }else{
				?><th width='120px'></th><?php
				} ?>
				<th width='100'><?php _e("Source",REVSLIDER_TEXTDOMAIN)?></th>
				<th width='70px'><?php _e("N. Slides",REVSLIDER_TEXTDOMAIN)?></th>						
				<th width='50%'><?php _e("Actions",REVSLIDER_TEXTDOMAIN)?> </th>
			</tr>
		</thead>
		<tbody>
			<?php
			if($outputTemplates)
				$useSliders = $arrSlidersTemplates;
			else
				$useSliders = $arrSliders;
			
			
			foreach($useSliders as $slider):
				try{
					$id = $slider->getID();
					$showTitle = $slider->getShowTitle();
					$title = $slider->getTitle();
					$alias = $slider->getAlias();
					$isFromPosts = $slider->isSlidesFromPosts();
					$strSource = __("Gallery",REVSLIDER_TEXTDOMAIN);
					$preicon = "revicon-picture-1";
					
					if($outputTemplates) $strSource = "Template";
					if ($strSource=="Template") $preicon ="templateicon";
					
					$rowClass = "";					
					if($isFromPosts == true){
						$strSource = __("Posts",REVSLIDER_TEXTDOMAIN);
						$preicon ="revicon-doc";
						$rowClass = "class='row_alt'";
					}
					
					if($outputTemplates){
						$editLink = self::getViewUrl(RevSliderAdmin::VIEW_SLIDER_TEMPLATE,"id=$id");
					}else{
						$editLink = self::getViewUrl(RevSliderAdmin::VIEW_SLIDER,"id=$id");
					}
					$editSlidesLink = self::getViewUrl(RevSliderAdmin::VIEW_SLIDES,"id=$id");
					
					$showTitle = UniteFunctionsRev::getHtmlLink($editLink, $showTitle);
					
					$shortCode = $slider->getShortcode();
					$numSlides = $slider->getNumSlides();
					
					
				}catch(Exception $e){					
					$errorMessage = "ERROR: ".$e->getMessage();
					$strSource = "";
					$numSlides = "";
				}
				
			?>
				<tr <?php echo $rowClass?>>
					<td><?php echo $id?><span id="slider_title_<?php echo $id?>" class="hidden"><?php echo $title?></span></td>								
					<td>
						<?php echo $showTitle?>
						<?php if(!empty($errorMessage)):?>
							<div class='error_message'><?php echo $errorMessage?></div>
						<?php endif?>
					</td>
					<?php
					if(!$outputTemplates){
					?>
					<td><?php echo $shortCode?></td>
					<?php }else{ ?><td></td><?php } ?>
					<td><?php echo "<i class=".$preicon."></i>".$strSource?></td>
					<td><?php echo $numSlides?></td>
					<td>
						<a class="button-primary revgreen" href='<?php echo $editLink ?>' title=""><i class="revicon-cog"></i><?php _e("Settings",REVSLIDER_TEXTDOMAIN)?></a>
						<a class="button-primary revblue" href='<?php echo $editSlidesLink ?>' title=""><i class="revicon-pencil-1"></i><?php _e("Edit Slides",REVSLIDER_TEXTDOMAIN)?></a>
						<a class="button-primary revcarrot export_slider_overview" id="export_slider_<?php echo $id?>" href="javascript:void(0);" title=""><i class="revicon-export"></i><?php _e("Export Slider",REVSLIDER_TEXTDOMAIN)?></a>
						<a class="button-primary revred button_delete_slider"id="button_delete_<?php echo $id?>" href='javascript:void(0)' title="<?php _e("Delete",REVSLIDER_TEXTDOMAIN)?>"><i class="revicon-trash"></i></a>
						<a class="button-primary revyellow button_duplicate_slider" id="button_duplicate_<?php echo $id?>" href='javascript:void(0)' title="<?php _e("Duplicate",REVSLIDER_TEXTDOMAIN)?>"><i class="revicon-picture"></i></a>
						<div id="button_preview_<?php echo $id?>" class="button_slider_preview button-primary revgray" title="<?php _e("Preview",REVSLIDER_TEXTDOMAIN)?>"><i class="revicon-search-1"></i></div>
					</td>
	
				</tr>							
			<?php endforeach;?>
			
		</tbody>		 
	</table>

	<?php require_once self::getPathTemplate("dialog_preview_slider");?>


	