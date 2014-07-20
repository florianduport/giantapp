<?php
// Template Name: Contact
get_header(); global $smof_data; ?>
<?php
if( $smof_data['recaptcha_public'] && $smof_data['recaptcha_private'] && !function_exists( 'recaptcha_get_html' ) ) {
	require_once('framework/recaptchalib.php');
}
//If the form is submitted
if(isset($_POST['submit'])) {
	//Check to make sure that the name field is not empty
	if(trim($_POST['contact_name']) == '' || trim($_POST['contact_name']) == 'Name (required)') {
		$hasError = true;
	} else {
		$name = trim($_POST['contact_name']);
	}

	//Subject field is not required
	if(function_exists('stripslashes')) {
		$subject = stripslashes(trim($_POST['url']));
	} else {
		$subject = trim($_POST['url']);
	}

	//Check to make sure sure that a valid email address is submitted
	$pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';

	if(trim($_POST['email']) == '' || trim($_POST['email']) == 'Email (required)')  {
		$hasError = true;
	} else if ( preg_match($pattern, $_POST['email']) === 0 ) {
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	//Check to make sure comments were entered
	if(trim($_POST['msg']) == '' || trim($_POST['msg']) == 'Message') {
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['msg']));
		} else {
			$comments = trim($_POST['msg']);
		}
	}

	if($smof_data['recaptcha_public'] && $smof_data['recaptcha_private']) {
		$resp = recaptcha_check_answer ($smof_data['recaptcha_private'],
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);
		if(!$resp->is_valid) {
			$hasError = true;
		}
	}

	//If there is no error, send the email
	if(!isset($hasError)) {
		$name = wp_filter_kses( $name );
		$email = wp_filter_kses( $email );
		$subject = wp_filter_kses( $subject );
		$comments = wp_filter_kses( $comments );
		
		$emailTo = $smof_data['email_address']; //Put your own email address here
		$body = __('Name:', 'Avada')." $name \n\n";
		$body .= __('Email:', 'Avada')." $email \n\n";
		$body .= __('Subject:', 'Avada')." $subject \n\n";
		$body .= __('Comments:', 'Avada')."\n $comments";
		$headers = 'Reply-To: ' . $name . ' <' . $email . '>' . "\r\n";

		$mail = wp_mail($emailTo, $subject, $body, $headers);

		$emailSent = true;

		if($emailSent == true) {
			$_POST['contact_name'] = '';
			$_POST['email'] = '';
			$_POST['url'] = '';
			$_POST['msg'] = '';
		}
	}
}

$sidebar_exists = true;
if(get_post_meta($post->ID, 'pyre_full_width', true) == 'yes') {
	$content_css = 'width:100%';
	$sidebar_css = 'display:none';
	$sidebar_exists = false;
}
elseif(get_post_meta($post->ID, 'pyre_sidebar_position', true) == 'left') {
	$content_css = 'float:right;';
	$sidebar_css = 'float:left;';
} elseif(get_post_meta($post->ID, 'pyre_sidebar_position', true) == 'right') {
	$content_css = 'float:left;';
	$sidebar_css = 'float:right;';
} elseif(get_post_meta($post->ID, 'pyre_sidebar_position', true) == 'default') {
	if($smof_data['default_sidebar_pos'] == 'Left') {
		$content_css = 'float:right;';
		$sidebar_css = 'float:left;';
	} elseif($smof_data['default_sidebar_pos'] == 'Right') {
		$content_css = 'float:left;';
		$sidebar_css = 'float:right;';
	}
}
?>
	<div id="content" style="<?php echo $content_css; ?>">
		<span class="entry-title" style="display: none;"><?php the_title(); ?></span>
		<span class="vcard" style="display: none;"><span class="fn"><?php the_author_posts_link(); ?></span></span>
		<span class="updated" style="display:none;"><?php the_modified_time( 'c' ); ?></span>
		<?php while(have_posts()): the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post-content">
				<?php the_content(); ?>

				<?php if(isset($hasError)) { //If errors are found ?>
					<div class="alert error"><div class="msg"><?php echo __("Please check if you've filled all the fields with valid information. Thank you.", 'Avada'); ?></div></div>
					<br />
				<?php } ?>

				<?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
					<div class="alert success"><div class="msg"><?php echo __('Thank you', 'Avada'); ?> <strong><?php echo $name;?></strong> <?php echo __('for using my contact form! Your email was successfully sent!', 'Avada'); ?></div></div>
					<br />
				<?php } ?>
			</div>
			<form action="" method="post">

					<div id="comment-input">

						<input type="text" name="contact_name" id="author" value="<?php if(isset($_POST['contact_name']) && !empty($_POST['contact_name'])) { echo wp_filter_kses( $_POST['contact_name'] ); } ?>" placeholder="<?php echo __('Name (required)', 'Avada'); ?>" size="22" tabindex="1" aria-required="true" class="input-name">

						<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']) && !empty($_POST['email'])) { echo wp_filter_kses( $_POST['email'] ); } ?>" placeholder="<?php echo __('Email (required)', 'Avada'); ?>" size="22" tabindex="2" aria-required="true" class="input-email">

						<input type="text" name="url" id="url" value="<?php if(isset($_POST['url']) && !empty($_POST['url'])) { echo wp_filter_kses( $_POST['url'] ); } ?>" placeholder="<?php echo __('Subject', 'Avada'); ?>" size="22" tabindex="3" class="input-website">

					</div>

					<div id="comment-textarea">

						<textarea name="msg" id="comment" cols="39" rows="4" tabindex="4" class="textarea-comment" placeholder="<?php echo __('Message', 'Avada'); ?>"><?php if(isset($_POST['msg']) && !empty($_POST['msg'])) { echo wp_filter_kses( $_POST['msg'] ); } ?></textarea>

					</div>

					<?php if($smof_data['recaptcha_public'] && $smof_data['recaptcha_private']): ?>

					<div id="comment-recaptcha">

					<?php echo recaptcha_get_html($smof_data['recaptcha_public']); ?>

					</div>

					<?php endif; ?>

					<div id="comment-submit-container">

						<p><div><input name="submit" type="submit" id="submit" tabindex="5" value="<?php echo __('Submit Form', 'Avada'); ?>" class="<?php echo sprintf( 'comment-submit btn btn-default button default small fusion-button button-small button-default button-%s button-%s', strtolower( $smof_data['button_shape'] ), strtolower( $smof_data['button_type'] ) ); ?>"></div></p>
					</div>

			</form>
		</div>
		<?php endwhile; ?>
	</div>
	<?php if( $sidebar_exists == true ): ?>
	<?php wp_reset_query(); ?>
	<div id="sidebar" style="<?php echo $sidebar_css; ?>"><?php generated_dynamic_sidebar(); ?></div>
	<?php endif; ?>
<?php get_footer(); ?>