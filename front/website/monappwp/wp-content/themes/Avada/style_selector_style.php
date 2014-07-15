	<?php if($smof_data['primary_color']): ?>
	a:hover{
		color:<?php echo $smof_data['primary_color']; ?>;
	}
	#nav ul .current_page_item a, #nav ul .current-menu-item a, #nav ul > .current-menu-parent a,
	.footer-area ul li a:hover,
	.portfolio-tabs li.active a, .faq-tabs li.active a,
	.project-content .project-info .project-info-box a:hover,
	.about-author .title a,
	span.dropcap,.footer-area a:hover,.copyright a:hover,
	#sidebar .widget_categories li a:hover,
	#main .post h2 a:hover,
	#sidebar .widget li a:hover,
	#nav ul a:hover,
	.date-and-formats .format-box i,
	h5.toggle:hover a,
	.tooltip-shortcode,.content-box-percentage,
	.more a:hover:after,.read-more:hover:after,.pagination-prev:hover:before,.pagination-next:hover:after,
	.single-navigation a[rel=prev]:hover:before,.single-navigation a[rel=next]:hover:after,
	#sidebar .widget_nav_menu li a:hover:before,#sidebar .widget_categories li a:hover:before,
	#sidebar .widget .recentcomments:hover:before,#sidebar .widget_recent_entries li a:hover:before,
	#sidebar .widget_archive li a:hover:before,#sidebar .widget_pages li a:hover:before,
	#sidebar .widget_links li a:hover:before,.side-nav .arrow:hover:after,.woocommerce-tabs .tabs a:hover .arrow:after,
	.star-rating:before,.star-rating span:before,.price ins .amount,
	.price > .amount,.woocommerce-pagination .prev:hover:before,.woocommerce-pagination .next:hover:after,
	.woocommerce-tabs .tabs li.active a,.woocommerce-tabs .tabs li.active a .arrow:after,
	#wrapper .cart-checkout a:hover,#wrapper .cart-checkout a:hover:before,
	.widget_shopping_cart_content .total .amount,.widget_layered_nav li a:hover:before,
	.widget_product_categories li a:hover:before,#header .my-account-link-active:after,.woocommerce-side-nav li.active a,.woocommerce-side-nav li.active a:after,.my_account_orders .order-number a,.shop_table .product-subtotal .amount,
	.cart_totals .total .amount,form.checkout .shop_table tfoot .total .amount,#final-order-details .mini-order-details tr:last-child .amount,.rtl .more a:hover:before,.rtl .read-more:hover:before,#header .my-cart-link-active:after,#wrapper #sidebar .current_page_item > a,#wrapper #sidebar .current-menu-item a,#wrapper #sidebar .current_page_item a:before,#wrapper #sidebar .current-menu-item a:before,#wrapper .footer-area .current_page_item a,#wrapper .footer-area .current-menu-item a,#wrapper .footer-area .current_page_item a:before,#wrapper .footer-area .current-menu-item a:before,.side-nav ul > li.current_page_item > a,.side-nav li.current_page_ancestor > a{
		color:<?php echo $smof_data['primary_color']; ?> !important;
	}
	#nav ul .current_page_item a, #nav ul .current-menu-item a, #nav ul > .current-menu-parent a,
	#nav ul ul,#nav li.current-menu-ancestor a,
	.reading-box,
	.portfolio-tabs li.active a, .faq-tabs li.active a,
	.tab-holder .tabs li.active a,
	.post-content blockquote,
	.progress-bar-content,
	.pagination .current,
	.pagination a.inactive:hover,
	#nav ul a:hover,.woocommerce-pagination .current,
	.tagcloud a:hover,#header .my-account-link:hover:after,body #header .my-account-link-active:after{
		border-color:<?php echo $smof_data['primary_color']; ?> !important;
	}
	.side-nav li.current_page_item a{
		border-right-color:<?php echo $smof_data['primary_color']; ?> !important;	
	}
	.rtl .side-nav li.current_page_item a{
		border-left-color:<?php echo $smof_data['primary_color']; ?> !important;	
	}
	.header-v2 .header-social, .header-v3 .header-social, .header-v4 .header-social,.header-v5 .header-social,.header-v2{
		border-top-color:<?php echo $smof_data['primary_color']; ?> !important;	
	}
	h5.toggle.active span.arrow,
	.post-content ul.circle-yes li:before,
	.progress-bar-content,
	.pagination .current,
	.header-v3 .header-social,.header-v4 .header-social,.header-v5 .header-social,
	.date-and-formats .date-box,.table-2 table thead,
	.onsale,.woocommerce-pagination .current,
	.woocommerce .social-share li a:hover i,
	.price_slider_wrapper .ui-slider .ui-slider-range,
	.tagcloud a:hover,.cart-loading,
	ul.arrow li:before{
		background-color:<?php echo $smof_data['primary_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($smof_data['header_bg_color']): ?>
	<?php
	$header_bg_color_hex = avada_hex2rgb($smof_data['header_bg_color']);
	?>
	#header,#small-nav,#header .login-box,#header .cart-contents,#small-nav .login-box,#small-nav .cart-contents{
		background-color:<?php echo $smof_data['header_bg_color']; ?> !important;
	}
	body #header.sticky-header{background:rgba(<?php echo $header_bg_color_hex[0]; ?>, <?php echo $header_bg_color_hex[1]; ?>, <?php echo $header_bg_color_hex[2]; ?>, 0.95) !important;}
	#nav ul a{
		border-color:<?php echo $smof_data['header_bg_color']; ?> !important;	
	}
	<?php endif; ?>

	<?php if($smof_data['content_bg_color']): ?>
	#main,#wrapper{
		background-color:<?php echo $smof_data['content_bg_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($smof_data['footer_bg_color']): ?>
	.footer-area{
		background-color:<?php echo $smof_data['footer_bg_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($smof_data['footer_border_color']): ?>
	.footer-area{
		border-color:<?php echo $smof_data['footer_border_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($smof_data['copyright_bg_color']): ?>
	#footer{
		background-color:<?php echo $smof_data['copyright_bg_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($smof_data['copyright_border_color']): ?>
	#footer{
		border-color:<?php echo $smof_data['copyright_border_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($smof_data['pricing_box_color']): ?>
	.sep-boxed-pricing ul li.title-row{
		background-color:<?php echo $smof_data['pricing_box_color']; ?> !important;
		border-color:<?php echo $smof_data['pricing_box_color']; ?> !important;
	}
	.pricing-row .exact_price, .pricing-row sup{
		color:<?php echo $smof_data['pricing_box_color']; ?> !important;
	}
	<?php endif; ?>
	<?php if($smof_data['image_gradient_top_color'] && $smof_data['image_gradient_bottom_color']): ?>
	<?php
	$imgr_gtop = avada_hex2rgb($smof_data['image_gradient_top_color']);
	$imgr_gbot = avada_hex2rgb($smof_data['image_gradient_bottom_color']);
	if($smof_data['image_rollover_opacity']) {
		$opacity = $smof_data['image_rollover_opacity'];
	} else{
		$opacity = '1';
	}
	$imgr_gtop_string = 'rgba('.$imgr_gtop[0].','.$imgr_gtop[1].','.$imgr_gtop[2].','.$opacity.')';
	$imgr_gbot_string = 'rgba('.$imgr_gbot[0].','.$imgr_gbot[1].','.$imgr_gbot[2].','.$opacity.')';
	?>
	.image .image-extras{
		background-image: linear-gradient(top, <?php echo $imgr_gtop_string; ?> 0%, <?php echo $imgr_gbot_string; ?> 100%);
		background-image: -o-linear-gradient(top, <?php echo $imgr_gtop_string; ?> 0%, <?php echo $imgr_gbot_string; ?> 100%);
		background-image: -moz-linear-gradient(top, <?php echo $imgr_gtop_string; ?> 0%, <?php echo $imgr_gbot_string; ?> 100%);
		background-image: -webkit-linear-gradient(top, <?php echo $imgr_gtop_string; ?> 0%, <?php echo $imgr_gbot_string; ?> 100%);
		background-image: -ms-linear-gradient(top, <?php echo $imgr_gtop_string; ?> 0%, <?php echo $imgr_gbot_string; ?> 100%);

		background-image: -webkit-gradient(
			linear,
			left top,
			left bottom,
			color-stop(0, <?php echo $imgr_gtop_string; ?>),
			color-stop(1, <?php echo $imgr_gbot_string; ?>)
		);

		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $smof_data['image_gradient_top_color']; ?>', endColorstr='<?php echo $smof_data['image_gradient_bottom_color']; ?>');
	}
	.no-cssgradients .image .image-extras{
		background:<?php echo $smof_data['image_gradient_top_color']; ?>;
	}
	<?php endif; ?>
	<?php if($smof_data['button_gradient_top_color'] && $smof_data['button_gradient_bottom_color'] && $smof_data['button_gradient_text_color']): ?>
	#main .portfolio-one .button,
	#main .comment-submit,
	#reviews input#submit,
	.button.default,
	.price_slider_amount button,
	.gform_wrapper .gform_button{
		color: <?php echo $smof_data['button_gradient_text_color']; ?> !important;
		background-image: linear-gradient(top, <?php echo $smof_data['button_gradient_top_color']; ?> 0%, <?php echo $smof_data['button_gradient_bottom_color']; ?> 100%);
		background-image: -o-linear-gradient(top, <?php echo $smof_data['button_gradient_top_color']; ?> 0%, <?php echo $smof_data['button_gradient_bottom_color']; ?> 100%);
		background-image: -moz-linear-gradient(top, <?php echo $smof_data['button_gradient_top_color']; ?> 0%, <?php echo $smof_data['button_gradient_bottom_color']; ?> 100%);
		background-image: -webkit-linear-gradient(top, <?php echo $smof_data['button_gradient_top_color']; ?> 0%, <?php echo $smof_data['button_gradient_bottom_color']; ?> 100%);
		background-image: -ms-linear-gradient(top, <?php echo $smof_data['button_gradient_top_color']; ?> 0%, <?php echo $smof_data['button_gradient_bottom_color']; ?> 100%);

		background-image: -webkit-gradient(
			linear,
			left top,
			left bottom,
			color-stop(0, <?php echo $smof_data['button_gradient_top_color']; ?>),
			color-stop(1, <?php echo $smof_data['button_gradient_bottom_color']; ?>)
		);
		border:1px solid <?php echo $smof_data['button_gradient_bottom_color']; ?>;

		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $smof_data['button_gradient_top_color']; ?>', endColorstr='<?php echo $smof_data['button_gradient_bottom_color']; ?>');
	}
	.no-cssgradients #main .portfolio-one .button,
	.no-cssgradients #main .comment-submit,
	.no-cssgradients #reviews input#submit,
	.no-cssgradients .button.default,
	.no-cssgradients .price_slider_amount button,
	.no-cssgradients .gform_wrapper .gform_button{
		background:<?php echo $smof_data['button_gradient_top_color']; ?>;
	}
	#main .portfolio-one .button:hover,
	#main .comment-submit:hover,
	#reviews input#submit:hover,
	.button.default:hover,
	.price_slider_amount button:hover,
	.gform_wrapper .gform_button:hover{
		color: <?php echo $smof_data['button_gradient_text_color']; ?> !important;
		background-image: linear-gradient(top, <?php echo $smof_data['button_gradient_bottom_color']; ?> 0%, <?php echo $smof_data['button_gradient_top_color']; ?> 100%);
		background-image: -o-linear-gradient(top, <?php echo $smof_data['button_gradient_bottom_color']; ?> 0%, <?php echo $smof_data['button_gradient_top_color']; ?> 100%);
		background-image: -moz-linear-gradient(top, <?php echo $smof_data['button_gradient_bottom_color']; ?> 0%, <?php echo $smof_data['button_gradient_top_color']; ?> 100%);
		background-image: -webkit-linear-gradient(top, <?php echo $smof_data['button_gradient_bottom_color']; ?> 0%, <?php echo $smof_data['button_gradient_top_color']; ?> 100%);
		background-image: -ms-linear-gradient(top, <?php echo $smof_data['button_gradient_bottom_color']; ?> 0%, <?php echo $smof_data['button_gradient_top_color']; ?> 100%);

		background-image: -webkit-gradient(
			linear,
			left top,
			left bottom,
			color-stop(0, <?php echo $smof_data['button_gradient_bottom_color']; ?>),
			color-stop(1, <?php echo $smof_data['button_gradient_top_color']; ?>)
		);
		border:1px solid <?php echo $smof_data['button_gradient_bottom_color']; ?>;

		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $smof_data['button_gradient_bottom_color']; ?>', endColorstr='<?php echo $smof_data['button_gradient_top_color']; ?>');
	}
	.no-cssgradients #main .portfolio-one .button:hover,
	.no-cssgradients #main .comment-submit:hover,
	.no-cssgradients #reviews input#submit:hover,
	.no-cssgradients .button.default,
	.no-cssgradients .price_slider_amount button:hover,
	.no-cssgradients .gform_wrapper .gform_button{
		background:<?php echo $smof_data['button_gradient_bottom_color']; ?>;
	}
	<?php endif; ?>

	<?php if($smof_data['link_color']): ?>
	body a{color:<?php echo $smof_data['link_color']; ?>;}
	.project-content .project-info .project-info-box a,#sidebar .widget li a, #sidebar .widget .recentcomments, #sidebar .widget_categories li, #main .post h2 a,
	.shop_attributes tr th,.image-extras a,.products-slider .price .amount,.my_account_orders thead tr th,.shop_table thead tr th,.cart_totals table th,form.checkout .shop_table tfoot th,form.checkout .payment_methods label,#final-order-details .mini-order-details th,#main .product .product_title{color:<?php echo $smof_data['link_color']; ?> !important;}
	<?php endif; ?>

	<?php if($smof_data['breadcrumbs_text_color']): ?>
	.page-title ul li,.page-title ul li a{color:<?php echo $smof_data['breadcrumbs_text_color']; ?> !important;}
	<?php endif; ?>

	<?php if($smof_data['footer_headings_color']): ?>
	.footer-area h3{color:<?php echo $smof_data['footer_headings_color']; ?> !important;}
	<?php endif; ?>

	<?php if($smof_data['footer_text_color']): ?>
	.footer-area,.footer-area #jtwt,.copyright{color:<?php echo $smof_data['footer_text_color']; ?> !important;}
	<?php endif; ?>

	<?php if($smof_data['footer_link_color']): ?>
	.footer-area a,.copyright a{color:<?php echo $smof_data['footer_link_color']; ?> !important;}
	<?php endif; ?>

	<?php if($smof_data['menu_first_color']): ?>
	#nav ul a,.side-nav li a,#header .cart-content a,#header .cart-content a:hover,#wrapper .header-social .top-menu .cart > a,#wrapper .header-social .top-menu .cart > a > .amount{color:<?php echo $smof_data['menu_first_color']; ?> !important;}
	#header .my-account-link:after{border-color:<?php echo $smof_data['menu_first_color']; ?> !important;}
	<?php endif; ?>

	<?php if($smof_data['menu_hover_first_color']): ?>
	#nav ul li a:hover{color:<?php echo $smof_data['menu_hover_first_color']; ?> !important;border-color:<?php echo $smof_data['menu_hover_first_color']; ?> !important;}
	#nav ul ul{border-color:<?php echo $smof_data['menu_hover_first_color']; ?> !important;}
	<?php endif; ?>


	<?php if($smof_data['menu_sub_bg_color']): ?>
	#nav ul ul{background-color:<?php echo $smof_data['menu_sub_bg_color']; ?>;}
	<?php endif; ?>

	<?php if($smof_data['menu_sub_color']): ?>
	#wrapper #nav ul li ul li a,.side-nav li li a,.side-nav li.current_page_item li a{color:<?php echo $smof_data['menu_sub_color']; ?> !important;}
	<?php endif; ?>

	<?php if($smof_data['es_title_color']): ?>
	.ei-title h2{color:<?php echo $smof_data['es_title_color']; ?> !important;}
	<?php endif; ?>

	<?php if($smof_data['es_caption_color']): ?>
	.ei-title h3{color:<?php echo $smof_data['es_caption_color']; ?> !important;}
	<?php endif; ?>

	<?php if($smof_data['snav_color']): ?>
	#wrapper .header-social *{color:<?php echo $smof_data['snav_color']; ?> !important;}
	<?php endif; ?>

	<?php if($smof_data['sep_color']): ?>
	.sep-single{background-color:<?php echo $smof_data['sep_color']; ?> !important;}
	.sep-double,.sep-dashed,.sep-dotted{border-color:<?php echo $smof_data['sep_color']; ?> !important;}
	.ls-avada, .avada-skin-rev,.clients-carousel .es-carousel li img,h5.toggle a,.progress-bar,
	#small-nav,.portfolio-tabs,.faq-tabs,.single-navigation,.project-content .project-info .project-info-box,
	.post .meta-info,.grid-layout .post,.grid-layout .post .content-sep,
	.grid-layout .post .flexslider,.timeline-layout .post,.timeline-layout .post .content-sep,
	.timeline-layout .post .flexslider,h3.timeline-title,.timeline-arrow,
	.counter-box-wrapper,.table-2 table thead,.table-2 tr td,
	#sidebar .widget li a,#sidebar .widget .recentcomments,#sidebar .widget_categories li,
	.tab-holder,.commentlist .the-comment,
	.side-nav,#wrapper .side-nav li a,.rtl .side-nav,h5.toggle.active + .toggle-content,
	#wrapper .side-nav li.current_page_item li a,.tabs-vertical .tabset,
	.tabs-vertical .tabs-container .tab_content,.page-title-container,.pagination a.inactive,.woocommerce-pagination .page-numbers,.rtl .woocommerce .social-share li{border-color:<?php echo $smof_data['sep_color']; ?>;}
	.side-nav li a,.product_list_widget li,.widget_layered_nav li,.price_slider_wrapper,.tagcloud a,#header .cart-content a,#header .cart-content a:hover,#header .login-box,#header .cart-contents,#small-nav .login-box,#small-nav .cart-contents,#small-nav .cart-content a,#small-nav .cart-content a:hover,
	#customer_login_box,.myaccount_user,.myaccount_user_container span,
	.woocommerce-side-nav li a,.woocommerce-content-box,.woocommerce-content-box h2,.my_account_orders tr,.woocommerce .address h4,.shop_table tr,.cart_totals .total,.chzn-container-single .chzn-single,.chzn-container-single .chzn-single div,.chzn-drop,form.checkout .shop_table tfoot,.input-radio,#final-order-details .mini-order-details tr:last-child,p.order-info,.cart-content a img,.panel.entry-content,.woocommerce-tabs .tabs li a,.woocommerce .social-share,.woocommerce .social-share li,.quantity,.quantity .minus, .quantity .qty,.shop_attributes tr,.woocommerce-success-message{border-color:<?php echo $smof_data['sep_color']; ?> !important;}
	.price_slider_wrapper .ui-widget-content{background-color:<?php echo $smof_data['sep_color']; ?>;}
	<?php endif; ?>

	<?php if($smof_data['qty_bg_color']): ?>
	.quantity .minus,.quantity .plus{background-color:<?php echo $smof_data['qty_bg_color']; ?> !important;}
	<?php endif; ?>

	<?php if($smof_data['qty_bg_hover_color']): ?>
	.quantity .minus:hover,.quantity .plus:hover{background-color:<?php echo $smof_data['qty_bg_hover_color']; ?> !important;}
	<?php endif; ?>

	<?php if($smof_data['form_bg_color']): ?>
	input#s,#comment-input input,#comment-textarea textarea,.comment-form-comment textarea,.input-text,.wpcf7-form .wpcf7-text,.wpcf7-form .wpcf7-quiz,.wpcf7-form .wpcf7-number,.wpcf7-form textarea,.gform_wrapper .gfield input[type=text],.gform_wrapper .gfield textarea{background-color:<?php echo $smof_data['form_bg_color']; ?> !important;}
	<?php endif; ?>

	<?php if($smof_data['form_text_color']): ?>
	input#s,input#s,.placeholder,#comment-input input,#comment-textarea textarea,#comment-input .placeholder,#comment-textarea .placeholder,.comment-form-comment textarea,.input-text..wpcf7-form .wpcf7-text,.wpcf7-form .wpcf7-quiz,.wpcf7-form .wpcf7-number,.wpcf7-form textarea,.gform_wrapper .gfield input[type=text],.gform_wrapper .gfield textarea{color:<?php echo $smof_data['form_text_color']; ?> !important;}
	input#s::webkit-input-placeholder,#comment-input input::-webkit-input-placeholder,#comment-textarea textarea::-webkit-input-placeholder,.comment-form-comment textarea::webkit-input-placeholder,.input-text::webkit-input-placeholder{color:<?php echo $smof_data['form_text_color']; ?> !important;}
	input#s:moz-placeholder,#comment-input input:-moz-placeholder,#comment-textarea textarea:-moz-placeholder,.comment-form-comment textarea:-moz-placeholder,.input-text:-moz-placeholder{color:<?php echo $smof_data['form_text_color']; ?> !important;}
	input#s:-ms-input-placeholder,#comment-input input:-ms-input-placeholder,#comment-textarea textarea:-moz-placeholder,.comment-form-comment textarea:-ms-input-placeholder,.input-text:-ms-input-placeholder{color:<?php echo $smof_data['form_text_color']; ?> !important;}
	<?php endif; ?>

	<?php if($smof_data['form_border_color']): ?>
	input#s,#comment-input input,#comment-textarea textarea,.comment-form-comment textarea,.input-text,.wpcf7-form .wpcf7-text,.wpcf7-form .wpcf7-quiz,.wpcf7-form .wpcf7-number,.wpcf7-form textarea,.gform_wrapper .gfield input[type=text],.gform_wrapper .gfield textarea,.gform_wrapper .gfield_select[multiple=multiple]{border-color:<?php echo $smof_data['form_border_color']; ?> !important;}
	<?php endif; ?>

	<?php if($smof_data['menu_sub_sep_color']): ?>
	#wrapper #nav ul li ul li a{border-bottom:1px solid <?php echo $smof_data['menu_sub_sep_color']; ?> !important;}
	<?php endif; ?>

	<?php if($smof_data['menu_bg_hover_color']): ?>
	#wrapper #nav ul li ul li a:hover, #wrapper #nav ul li ul li.current-menu-item a,#header .cart-content a:hover,#small-nav .cart-content a:hover{background-color:<?php echo $smof_data['menu_bg_hover_color']; ?> !important;}
	<?php endif; ?>

	<?php if($smof_data['header_top_bg_color']): ?>
	#wrapper .header-social{
		background-color:<?php echo $smof_data['header_top_bg_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($smof_data['header_top_first_border_color']): ?>
	#wrapper .header-social .menu > li{
		border-color:<?php echo $smof_data['header_top_first_border_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($smof_data['header_top_sub_bg_color']): ?>
	#wrapper .header-social .menu .sub-menu,#wrapper .header-social .login-box,#wrapper .header-social .cart-contents{
		background-color:<?php echo $smof_data['header_top_sub_bg_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($smof_data['header_top_menu_sub_color']): ?>
	#wrapper .header-social .menu .sub-menu li, #wrapper .header-social .menu .sub-menu li a,#wrapper .header-social .login-box *,#wrapper .header-social .cart-contents *{
		color:<?php echo $smof_data['header_top_menu_sub_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($smof_data['header_top_menu_bg_hover_color']): ?>
	#wrapper .header-social .menu .sub-menu li a:hover{
		background-color:<?php echo $smof_data['header_top_menu_bg_hover_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($smof_data['header_top_menu_sub_hover_color']): ?>
	#wrapper .header-social .menu .sub-menu li a:hover{
		color:<?php echo $smof_data['header_top_menu_sub_hover_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($smof_data['header_top_menu_sub_sep_color']): ?>
	#wrapper .header-social .menu .sub-menu,#wrapper .header-social .menu .sub-menu li,.top-menu .cart-content a,#wrapper .header-social .login-box,#wrapper .header-social .cart-contents{
		border-color:<?php echo $smof_data['header_top_menu_sub_sep_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($smof_data['woo_cart_bg_color']): ?>
	#header .cart-checkout,.top-menu .cart,.top-menu .cart-content a:hover,.top-menu .cart-checkout{
		background-color:<?php echo $smof_data['woo_cart_bg_color']; ?> !important;
	}
	<?php endif; ?>

	<?php if($smof_data['accordian_inactive_color']): ?>
	h5.toggle span.arrow{background-color:<?php echo $smof_data['accordian_inactive_color']; ?>;}
	<?php endif; ?>

	<?php if($smof_data['counter_filled_color']): ?>
	.progress-bar-content{background-color:<?php echo $smof_data['counter_filled_color']; ?> !important;border-color:<?php echo $smof_data['counter_filled_color']; ?> !important;}
	.content-box-percentage{color:<?php echo $smof_data['counter_filled_color']; ?> !important;}
	<?php endif; ?>

	<?php if($smof_data['counter_unfilled_color']): ?>
	.progress-bar{background-color:<?php echo $smof_data['counter_unfilled_color']; ?>;border-color:<?php echo $smof_data['counter_unfilled_color']; ?>;}
	<?php endif; ?>

	<?php if($smof_data['arrow_color']): ?>
	.more a:after,.read-more:after,#sidebar .widget_nav_menu li a:before,#sidebar .widget_categories li a:before,
	#sidebar .widget .recentcomments:before,#sidebar .widget_recent_entries li a:before,
	#sidebar .widget_archive li a:before,#sidebar .widget_pages li a:before,
	#sidebar .widget_links li a:before,.side-nav .arrow:after,.single-navigation a[rel=prev]:before,
	.single-navigation a[rel=next]:after,.pagination-prev:before,
	.pagination-next:after,.woocommerce-pagination .prev:before,.woocommerce-pagination .next:after{color:<?php echo $smof_data['arrow_color']; ?> !important;}
	<?php endif; ?>

	<?php if($smof_data['dates_box_color']): ?>
	.date-and-formats .format-box{background-color:<?php echo $smof_data['dates_box_color']; ?>;}
	<?php endif; ?>

	<?php if($smof_data['carousel_nav_color']): ?>
	.es-nav-prev,.es-nav-next{background-color:<?php echo $smof_data['carousel_nav_color']; ?>;}
	<?php endif; ?>

	<?php if($smof_data['carousel_hover_color']): ?>
	.es-nav-prev:hover,.es-nav-next:hover{background-color:<?php echo $smof_data['carousel_hover_color']; ?>;}
	<?php endif; ?>

	<?php if($smof_data['content_box_bg_color']): ?>
	.content-boxes .col{background-color:<?php echo $smof_data['content_box_bg_color']; ?>;}
	<?php endif; ?>

	<?php if($smof_data['tabs_bg_color'] && $smof_data['tabs_inactive_color']): ?>
	#sidebar .tab-holder,#sidebar .tab-holder .news-list li{border-color:<?php echo $smof_data['tabs_inactive_color']; ?> !important;}
	.pyre_tabs .tabs-container{background-color:<?php echo $smof_data['tabs_bg_color']; ?> !important;}
	body #sidebar .tab-hold .tabs li{border-right:1px solid <?php echo $smof_data['tabs_bg_color']; ?> !important;}
	body #sidebar .tab-hold .tabs li a{background:<?php echo $smof_data['tabs_inactive_color']; ?> !important;border-bottom:0 !important;color:<?php echo $smof_data[body_text_color]; ?> !important;}
	body #sidebar .tab-hold .tabs li a:hover{background:<?php echo $smof_data['tabs_bg_color']; ?> !important;border-bottom:0 !important;}
	body #sidebar .tab-hold .tabs li.active a{background:<?php echo $smof_data['tabs_bg_color']; ?> !important;border-bottom:0 !important;}
	body #sidebar .tab-hold .tabs li.active a{border-top-color:<?php echo $smof_data[primary_color]; ?>!important;}
	<?php endif; ?>

	<?php if($smof_data['social_bg_color']): ?>
	.share-box{background-color:<?php echo $smof_data['social_bg_color']; ?>;}
	<?php endif; ?>

	<?php if($smof_data['timeline_bg_color']): ?>
	.grid-layout .post,.timeline-layout .post{background-color:<?php echo $smof_data['timeline_bg_color']; ?>;} 
	<?php endif; ?>