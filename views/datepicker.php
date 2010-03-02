<?php
if( '' == get_option('permalink_structure') ) {
    $link =  trailingslashit( get_bloginfo('url') ) . '?cat=' . $spEvents->eventCategory() . '&eventDisplay=month&eventDate=';
} else {
	$link = get_bloginfo( 'url' ) . '/' . $spEvents->getCategoryBase() . '/' . strtolower( The_Events_Calendar::CATEGORYNAME ) . '/'; 
}
?>
<script type="text/javascript" charset="utf-8">
	jQuery(document).ready(function() {
		jQuery('.<?php echo $prefix; ?>events-dropdown').change(function() {
			location.href = '<?php echo $link; ?>' + jQuery('#<?php echo $prefix; ?>events-year').val() + '-' + jQuery('#<?php echo $prefix; ?>events-month').val();
		});
	});
</script>
<select id='<?php echo $prefix; ?>events-month' name='EventJumpToMonth' class='<?php echo $prefix; ?>events-dropdown'>
	<?php echo $monthOptions; ?>
</select>
<select id='<?php echo $prefix; ?>events-year' name='EventJumpToYear' class='<?php echo $prefix; ?>events-dropdown'>
	<?php echo $yearOptions; ?>
</select>