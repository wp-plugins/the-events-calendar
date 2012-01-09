<?php
/*
 Plugin Name: The Events Calendar
 Description: The Events Calendar is a full featured event management system with many views, 3rd party integrations, and premium add-ons. <a href="http://tri.be/wordpress-events-calendar/?ref=tec-plugin">Check out the features</a>
 Version: 2.0.3
 Author: Modern Tribe, Inc.
 Author URI: http://tri.be?ref=tec-plugin
 Text Domain: tribe-events-calendar
 */

require_once( dirname(__FILE__) . '/lib/the-events-calendar.class.php' );

TribeEvents::instance();
