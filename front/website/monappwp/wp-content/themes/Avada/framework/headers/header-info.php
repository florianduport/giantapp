<?php global $smof_data; ?>
<?php if($smof_data['header_number'] || $smof_data['header_email']): ?>
<div class="header-info"><?php echo $smof_data['header_number']; ?><?php if($smof_data['header_number'] && $smof_data['header_email']): ?><span class="sep">|</span><?php endif; ?><a href="mailto:<?php echo $smof_data['header_email']; ?>"><?php echo $smof_data['header_email']; ?></a></div>
<?php endif; ?>
