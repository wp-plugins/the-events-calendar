<?php The_Events_Calendar::loadStylesAndScripts();
include (TEMPLATEPATH.'/header.php'); ?>
	<div id="content" class="event widecolumn">
<?php the_post(); global $post, $spEvents; ?>
		<div id="post-<?php the_ID() ?>" <?php post_class() ?>>
			<span class="back"><a href="<?php echo events_get_gridview_link(); ?>">&laquo; Back to Events</a></span>
			<h2 class="entry-title"><?php the_title() ?></h2>
			<div id="event-meta">
				<dl class="column">
					<dt><?php _e('Start:', $spEvents->pluginDomain) ?></dt> 
						<dd><?php echo the_event_start_date(); ?></dd>
					<?php if (the_event_start_date() !== the_event_end_date() ) { ?>
						<dt><?php _e('End:', $spEvents->pluginDomain) ?></dt>
							<dd><?php echo the_event_end_date();  ?></dd>						
					<?php } ?>

					<dt><?php _e('Cost:', $spEvents->pluginDomain) ?></dt>
						<dd><?php if ( the_event_cost() ) { echo the_event_cost(); } else { echo "&ndash;"; } ?></dd>

				</dl>
				<dl class="column">
					
					<dt><?php _e('Venue:', $spEvents->pluginDomain) ?></dt> 
						<dd><?php echo the_event_venue(); ?></dd>
					<?php if(the_event_address()) : ?>
					
					<dt><?php _e('Address:', $spEvents->pluginDomain) ?><br /><a class="gmap" href="<?php event_google_map_link() ?>" title="Click to view a Google Map" target="_blank">Google Map</a></dt>
						<dd>
						<?php $address = the_event_address();
						$address .= (the_event_city())?  ', ' . the_event_city() : '';
						$address .= (the_event_region()) ? ', ' . the_event_region() : '';
						$address .= (the_event_country()) ? ', ' . the_event_country() : '';
						$address .= (the_event_zip()) ? ', ' . the_event_zip() : '';
						
						$address = str_replace(' ,', ',', $address);
						echo $address;
						
						 ?>
						</dd>
					<?php endif; ?>
				</dl>
			</div>
			<div class="entry-content">
			<?php the_content() ?>
	

				<?php if ( get_post_meta($post->ID, '_EventBriteId', true) && get_post_meta($post->ID, '_EventBriteStatus', true) == 'Live'  && the_event_ticket_count() > 0 ) : // is this registered with eventbrite and live? ?>
					
					<div id="eventbrite-embed"><iframe src="http://www.eventbrite.com/tickets-external?eid=<?php echo get_post_meta($post->ID, '_EventBriteId', true) ?>&amp;ref=etckt" frameborder="0" marginwidth="5" marginheight="5" vspace="0" hspace="0" width="100%" height="207" allowtransparency="true" scrolling="auto"></iframe></div>

				<?php endif; // end eventbrite?>
				
				
			</div>
			<?php edit_post_link('Edit', '<span class="edit-link">', '</span>'); ?>
		</div><!-- .post -->

	</div><!-- #content -->

<?php
include (TEMPLATEPATH.'/footer.php');
?>