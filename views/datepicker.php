<script type="text/javascript" charset="utf-8">
	jQuery(document).ready(function(){
		jQuery('.<?php echo $prefix; ?>events-dropdown').change(function( ){
			monthSelect = jQuery('#<?php echo $prefix; ?>events-month');
			yearSelect = jQuery('#<?php echo $prefix; ?>events-year');
			jumpMonth = monthSelect.attr("options")[monthSelect.attr("selectedIndex")].value;
			jumpYear = yearSelect.attr("options")[yearSelect.attr("selectedIndex")].value;
			location.href = '<?php echo trailingslashit( events_get_events_link() ); ?>' + jumpYear + '-' + jumpMonth + '/';	
		});
	});
</script>
<select id='<?php echo $prefix; ?>events-month' name='EventJumpToMonth' class='<?php echo $prefix; ?>events-dropdown'>
	<?php echo $monthOptions; ?>
</select>
<select id='<?php echo $prefix; ?>events-year' name='EventJumpToYear' class='events-dropdown'>
	<?php echo $yearOptions; ?>
</select>
