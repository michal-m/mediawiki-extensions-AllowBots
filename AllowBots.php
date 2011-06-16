<?php
if ( ! defined( 'MEDIAWIKI' ) )
	die();

/**#@+
 * @author Michał Musiał <blitz@michalmusial.com>
 * @copyright Copyright © 2011, Michał Musiał
  */

$wgExtensionCredits['parserhook'][] = array(
        'path' => __FILE__,
        'name' => 'Allow Bot Access',
        'author' => 'Michał Musiał',
        'version'=> '0.1'
);

if ( ! isset($wgBotsIPs) ) {
	$wgBotsIPs = array();
}

if (in_array($_SERVER['REMOTE_ADDR'], $wgBotsIPs)) {
	$wgGroupPermissions['*']['read'] = true;
	# disable account creation
	$wgGroupPermissions['*']['createaccount'] = false;
	# disable anonymous editing/creation/talk
	$wgGroupPermissions['*']['edit'] = false;
	$wgGroupPermissions['*']['createpage'] = false;
	$wgGroupPermissions['*']['createtalk'] = false;
	
	# don't display IP header
	$wgShowIPinHeader = false;
	
	# enforce simple skin for crawling
	$wgDefaultSkin = 'simple';
}