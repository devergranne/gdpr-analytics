<?php
/**
* Plugin Name: GDPR Analytics
* Plugin URI: https://www.legiscope.com/
* Description: Google Analytics compatible with GDPR (completely anonimyzing data)
* Version: 1.0 
* Author: Legiscope
* Author URI: https://www.legiscope.com
* 
* Note : this is a proof of concept of 100% GDPR compliant Google Analytics integration
*        no personal data is sent back to GA, therefore GDPR does will not apply (art. 2 and art. 4)
*        Check our legal study : https://www.donneespersonnelles.fr 
*
*        Google API implementation :    https://ga-dev-tools.appspot.com/hit-builder/ 
*                                       https://developers.google.com/analytics/devguides/collection/protocol/v1/devguide
*                                       https://developers.google.com/analytics/devguides/collection/protocol/v1/parameters
*/


/**
 * This function will send a request to GA servers with anonymous users's IDs and details about the visit
 */
function gdpr_analytics( ) {

    # Enter your GA CODE HERE
    $data['tid'] = "";

    $ga_url = "https://www.google-analytics.com/collect";

    $data = array();

    # Create an anonymous ID - we double hash with salt, GA won't know who's who
    $salt = hash("sha256", $_SERVER['SERVER_ADDR'] . $_SERVER['SERVER_NAME'] . $_SERVER['DOCUMENT_ROOT']);
    $hash = hash("sha256", $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'] );
    $anon_id = hash("sha256", $salt . $hash);

    # Anonymous UserID
    $data['cid'] = $anon_id;

    # Application
    $data['ds'] = "analytics-gdpr";

    # Hit type
    $data['v'] = "1";

    # Hit type
    $data['t'] = "pageview";

    # Referer
    $data['dr'] = $_SERVER['HTTP_REFERER'];
    
    # User language
    $data['ul'] = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
    
    # Domain Path
    $data['dp'] = $_SERVER['REQUEST_URI'];

    # Create the query
    $request = $ga_url . '?' . http_build_query($data);

    # Send the request
    $response = wp_remote_post( $request );


 }
 
 add_action( 'init', "gdpr_analytics" );
 
