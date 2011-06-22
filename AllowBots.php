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
        'version'=> '0.2'
);

if ( ! isset( $wgBotsIPs ) ) {
	$wgBotsIPs = array();
}

if ( ! isset( $wgBotsCheckUA ) ) {
	$wgBotsCheckUA = false;
}

if ( ! isset( $wgBotsEnforceSkin ) ) {
	$wgBotsEnforceSkin = false;
}

$wgBotsMatchedUA = false;

if ( in_array( $_SERVER['REMOTE_ADDR'], $wgBotsIPs ) ) {
	if ( $wgBotsCheckUA ) {
		$userUA = $_SERVER['HTTP_USER_AGENT'];
		$matchUA = array_search( $_SERVER['REMOTE_ADDR'], $wgBotsIPs );

		if ( strpos( $userUA, $matchUA ) !== false ) {
			$wgBotsMatchedUA = true;
		}
		
		unset( $userUA, $matchUA );
	}

	if ( ! $wgBotsCheckUA || $wgBotsMatchedUA ) {
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
		if ( $wgBotsEnforceSkin ) {
			$wgDefaultSkin = $wgBotsEnforceSkin;
		}
	}
}