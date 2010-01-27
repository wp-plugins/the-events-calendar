<script type="text/javascript">
jQuery(document).ready(function() {

	function theEventsCalendarHideDonateButton() {
		jQuery('#mainDonateRow').hide();
		jQuery('#secondDonateRow').show();
	}
	
	jQuery('#hideDonateButton').click(function() {
		jQuery.post('/wp-admin/admin-ajax.php', { donateHidden: true, action: 'hideDonate' }, theEventsCalendarHideDonateButton, 'json' );
	});

});
</script>
<style type="text/css">
.form-table form input {border:none;}
<?php if( eventsGetOptionValue('donateHidden', false) ) : ?>
	#mainDonateRow {display: none;}
<?php else : ?>
	#mainDonateRow {background-color: #FCECA9;}
	#secondDonateRow {display: none;}
<?php endif; ?>
#mainDonateRow label {line-height: 30px;}
#submitLabel {display: block;}
#submitLabel input {
	display: block;
	padding: 0;
}
#hideDonateButton {}
#checkBoxLabel {}
.form-table form #secondSubmit {
	background-color: #F9F9F9;
	border-bottom: 1px solid;
	border-left: none;
	border-right: none;
	border-top: none;
	cursor: pointer;
	margin: 0;
	padding: 0;
}

div.snp_settings{
	width:90%;
}
</style>
<div class="snp_settings">
<h2><?php _e('The Events Calendar Settings',$this->pluginDomain); ?></h2>

<h3><?php _e('Need a hand?',$this->pluginDomain); ?></h3>
<p><?php _e('If you\'re stuck on these options, please <a href="http://wordpress.org/extend/plugins/the-events-calendar/">check out the documentation</a>. If you\'re still wondering what\'s going on, be sure to stop by the support <a href="http://wordpress.org/tags/the-events-calendar?forum_id=10">forum</a> and ask for help. The open source community is full of kind folks who are happy to help.',$this->pluginDomain); ?></p>
<table class="form-table">
    <tr id="mainDonateRow">
    	<th scope="row"><?php _e('Donate',$this->pluginDomain); ?></th>
        <td>
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="hosted_button_id" value="10750983">
                <input type="hidden" name="item_name" value="Events Options Panel Main">
                <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                <label id="submitLabel" for="submit">
                	<?php _e('If you find this plugin useful, please consider donating to the producer of it, Shane &#38; Peter, Inc. Thank you!',$this->pluginDomain); ?>
                </label>

                <input id="hideDonateButton" type="checkbox" name="hideDonateButton" value="" />
                <label id="checkBoxLabel" for="hideDonateButton"><?php _e('I have already donated, so please hide this button!',$this->pluginDomain); ?></label>
            </form>
        </td>
    </tr>
    <tr id="secondDonateRow">
        <td>
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="hosted_button_id" value="10751527">
                <input type="hidden" name="item_name" value="Events Options Panel Secondary">
                <input id="secondSubmit" type="submit" value="Donate for this wonderful plugin" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
            </form>
        </td>
    </tr>
</table>

<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                
<?php
if ( function_exists('wp_nonce_field') ) {
	wp_nonce_field('saveEventsCalendarOptions');
}
?>

<table class="form-table">
	<tr>
		<th scope="row"><?php _e('Default View for the Events',$this->pluginDomain); ?></th>
        <td>
            <fieldset>
                <legend class="screen-reader-text">
                    <span><?php _e('Default View for the Events',$this->pluginDomain); ?></span>
                </legend>
                <label title='Calendar'>
                    <?php 
                    $viewOptionValue = eventsGetOptionValue('viewOption','month'); 
                    if( $viewOptionValue == 'upcoming' ) {
                        $listViewStatus = 'checked="checked"';
                    } else {
                        $gridViewStatus = 'checked="checked"';
                    }
                    ?>
                    <input type="radio" name="viewOption" value="month" <?php echo $gridViewStatus; ?> /> 
                    <?php _e('Calendar',$this->pluginDomain); ?>
                </label><br />
                <label title='List View'>
                    <input type="radio" name="viewOption" value="upcoming" <?php echo $listViewStatus; ?> /> 
                    <?php _e('Event List',$this->pluginDomain); ?>
                </label><br />
            </fieldset>
        </td>
	</tr>
	<tr>
		<th scope="row"><?php _e('Show Comments',$this->pluginDomain); ?></th>
        <td>
            <fieldset>
                <legend class="screen-reader-text">
                    <span><?php _e('Show Comments',$this->pluginDomain); ?></span>
                </legend>
                <label title='Yes'>
                    <?php 
                    $showCommentValue = eventsGetOptionValue('showComments','no'); 
                    if( $showCommentValue == 'no' ) {
                        $noCommentStatus = 'checked="checked"';
                    } else {
                        $yesCommentStatus = 'checked="checked"';
                    }
                    ?>
                    <input type="radio" name="showComments" value="yes" <?php echo $yesCommentStatus; ?> /> 
                    <?php _e('Yes',$this->pluginDomain); ?>
                </label><br />
                <label title='Yes'>
                    <input type="radio" name="showComments" value="no" <?php echo $noCommentStatus; ?> /> 
                    <?php _e('No',$this->pluginDomain); ?>
                </label><br />
            </fieldset>
        </td>
	</tr>
    <tr>
    <th scope="row"><?php _e('Default Country for Events',$this->pluginDomain); ?></th>
    	<td>
            <select name="defaultCountry" id="defaultCountry">
				<?php 
				$this->constructCountries();
				$defaultCountry = eventsGetOptionValue('defaultCountry');
                foreach ($this->countries as $abbr => $fullname) {
                	print ("<option value=\"$fullname\" ");
                	if ($defaultCountry[1] == $fullname) { 
                		print ('selected="selected" ');
                	}
                	print (">$fullname</option>\n");
                }
                ?>
            </select>
        </td>
    </tr>


		<?php 
		$embedGoogleMapsValue = eventsGetOptionValue('embedGoogleMaps','off');                 
        ?>


	<tr>
		<th scope="row"><?php _e('Embed Google Maps',$this->pluginDomain); ?></th>
        <td>
            <fieldset>
                <legend class="screen-reader-text">
                    <span><?php _e('Embed Google Maps',$this->pluginDomain); ?></span>
                </legend>
                <label title='Yes'>
                    <?php 
                    $embedGoogleMapsValue = eventsGetOptionValue('embedGoogleMaps','off'); 
 					$embedGoogleMapsHeightValue = eventsGetOptionValue('embedGoogleMapsHeight','350'); 
 					$embedGoogleMapsWidthValue = eventsGetOptionValue('embedGoogleMapsWidth','100%'); 
                    if( $embedGoogleMapsValue == 'on' ) {
                        $embedGoogleMapsOnStatus = 'checked="checked"';
                    } else {
                        $embedGoogleMapsOffStatus = 'checked="checked"';
                    }
                    ?>
                    <input type="radio" name="embedGoogleMaps" value="off" <?php echo $embedGoogleMapsOffStatus; ?> onClick="hidestuff('googleEmbedSize');" /> 
                    <?php _e('Off',$this->pluginDomain); ?>
                </label> 
                <label title='List View'>
                    <input type="radio" name="embedGoogleMaps" value="on" <?php echo $embedGoogleMapsOnStatus; ?> onClick="showstuff('googleEmbedSize');" /> 
                    <?php _e('On',$this->pluginDomain); ?>
                </label>
				<span id="googleEmbedSize" name="googleEmbedSize" style="margin-left:20px;" >
					<?php _e('Height',$this->pluginDomain); ?> <input type="text" name="embedGoogleMapsHeight" value="<?php echo $embedGoogleMapsHeightValue ?>" size=4>
					&nbsp;<?php _e('Width',$this->pluginDomain); ?> <input type="text" name="embedGoogleMapsWidth" value="<?php echo $embedGoogleMapsWidthValue ?>" size=4> (number or %)
				</span>
<br />
            </fieldset>
        </td>
	</tr>


    <?php do_action( 'sp_events_options_bottom' ); ?>
	<tr>
    	<td>
    		<input id="saveEventsCalendarOptions" class="button-primary" type="submit" name="saveEventsCalendarOptions" value="Save Changes" />
        </td>
    </tr>
    
</table>

</form>

<script>
function showstuff(boxid){
   document.getElementById(boxid).style.visibility="visible";
}

function hidestuff(boxid){
   document.getElementById(boxid).style.visibility="hidden";
}

<?php if( $embedGoogleMapsValue == 'off' ) { ?>
hidestuff('googleEmbedSize');
<?php }; ?>

</script>

</div>