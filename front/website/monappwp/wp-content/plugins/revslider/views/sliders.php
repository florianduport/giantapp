<?php
	$slider = new RevSlider();
	$arrSliders = $slider->getArrSliders();
	$arrSlidersTemplates = $slider->getArrSliders(true);
	
	$addNewLink = self::getViewUrl(RevSliderAdmin::VIEW_SLIDER);
	$addNewTemplateLink = self::getViewUrl(RevSliderAdmin::VIEW_SLIDER_TEMPLATE);

	
	require self::getPathTemplate("sliders");
	
	
?>


	