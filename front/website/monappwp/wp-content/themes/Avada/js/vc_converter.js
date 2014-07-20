jQuery(document).ready(function() {
	jQuery('<input type="submit" id="vc-converter" name="vc-converter" class="button-primary" value="Convert to Fusion Builder" /><span style="display:none;">Only required for Fusion Builder if you are upgrading from Avada version 3.0.1 or older to 3.1</span>').insertAfter('p.composer-switch').wrap('<div class="vc-converter" />');

	jQuery('input#vc-converter').mouseover(function() {
		jQuery('.vc-converter span').fadeIn();
	}).mouseout(function() {
		jQuery('.vc-converter span').fadeOut();
	})
});