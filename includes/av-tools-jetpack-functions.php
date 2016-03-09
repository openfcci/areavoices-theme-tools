<?php

/* Connect the current blog to Jetpack without the need for additional login auth */
function fcc_jetpack_connect() {
  $original_blog = get_current_blog_id(); // Store Original Blog ID
  $blog_id = $original_blog;
  switch_to_blog( '1' ); // Ensure we are on the main blog

  $current_user = get_current_user_id(); // Store current user ID
  $super_admin = '1';
  if ( $current_user != $super_admin) { wp_set_current_user( $super_admin ); } // Set user ID to SuperAdmin for Jetpack Auth
    $jetpack_network = Jetpack_Network::init();
    $jetpack_network->do_subsiteregister( $blog_id );
  wp_set_current_user($current_user); //return to original user


  switch_to_blog( $original_blog ); // Return to original blog
  echo '<li>Jetpack Subsite Register function complete.</li>';

  $jp_status = get_option('jetpack_activated');
  if ($jp_status == 1 ) { echo '<li>Jetpack Status: The plugin was activated normally.</li>'; }
  elseif ($jp_status == 2 ) { echo '<li>Jetpack Status: The plugin was activated on this site because of a network-wide activation.</li>'; }
  elseif ($jp_status == 3 ) { echo '<li>Jetpack Status: The plugin was auto-installed.</li>'; }
  elseif ($jp_status == 4 ) { echo '<li>Jetpack Status: The plugin was was manually disconnected (but is still installed).</li>'; }
}

/* Set default modules */
function fcc_auto_activate() {
    return array( 'protect', 'after-the-deadline', 'contact-form', 'enhanced-distribution', 'gravatar-hovercards', 'json-api', 'latex', 'notes', 'omnisearch'
    , 'publicize', 'sharedaddy', 'shortcodes', 'shortlinks', 'sitemaps', 'stats', 'subscriptions', 'verification-tools', 'widget-visibility', 'widgets',
    'manage', 'carousel', 'photon', 'related-posts', 'sso', 'comments', 'likes', 'tiled-gallery');
}
add_filter( 'jetpack_get_default_modules', 'fcc_auto_activate' );

/* Allow only certain modules to be activated by non super admins */
function fcc_modules( $modules, $min_version, $max_version ) {
    $return = array();
    $return['protect'] = $modules['protect'];
    $return['after-the-deadline'] = $modules['after-the-deadline'];
    $return['contact-form'] = $modules['contact-form'];
    $return['enhanced-distribution'] = $modules['enhanced-distribution'];
    $return['gravatar-hovercards'] = $modules['gravatar-hovercards'];
    $return['json-api'] = $modules['json-api'];
    $return['latex'] = $modules['latex'];
    $return['notes'] = $modules['notes'];
    $return['omnisearch'] = $modules['omnisearch'];
    $return['publicize'] = $modules['publicize'];
    $return['sharedaddy'] = $modules['sharedaddy'];
    $return['shortcodes'] = $modules['shortcodes'];
    $return['shortlinks'] = $modules['shortlinks'];
    $return['sitemaps'] = $modules['sitemaps'];
    $return['stats'] = $modules['stats'];
    $return['subscriptions'] = $modules['subscriptions'];
    $return['verification-tools'] = $modules['verification-tools'];
    $return['widget-visibility'] = $modules['widget-visibility'];
    $return['widgets'] = $modules['widgets'];
    $return['manage'] = $modules['manage'];
    $return['carousel'] = $modules['carousel'];
    $return['photon'] = $modules['photon'];
    $return['related-posts'] = $modules['related-posts'];
    $return['sso'] = $modules['sso'];
    $return['comments'] = $modules['comments'];
    $return['likes'] = $modules['likes'];
    $return['tiled-gallery'] = $modules['tiled-gallery'];
    return $return;
}
/* If is not super admin */
if(!is_super_admin()){
  add_filter( 'jetpack_get_available_modules', 'fcc_modules', 20, 3 );
}

/* Activate active modules */
// function fcc_activate_modules(){
  // Jetpack::activate_module('protect');
  // Jetpack::activate_module('after-the-deadline');
  // Jetpack::activate_module('contact-form');
  // Jetpack::activate_module('enhanced-distribution');
  // Jetpack::activate_module('gravatar-hovercards');
  // Jetpack::activate_module('json-api');
  // Jetpack::activate_module('latex');
  // Jetpack::activate_module('notes');
  // Jetpack::activate_module('omnisearch');
  // Jetpack::activate_module('publicize');
  // Jetpack::activate_module('sharedaddy');
  // Jetpack::activate_module('shortcodes');
  // Jetpack::activate_module('shortlinks');
  // Jetpack::activate_module('sitemaps');
  // Jetpack::activate_module('stats');
  // Jetpack::activate_module('subscriptions');
  // Jetpack::activate_module('verification-tools');
  // Jetpack::activate_module('widget-visibility');
  // Jetpack::activate_module('widgets');
  // Jetpack::activate_module('manage');
  // Jetpack::activate_module('carousel');
  // Jetpack::activate_module('photon');
  // Jetpack::activate_module('related-posts');
  // Jetpack::activate_module('sso');
  // Jetpack::activate_module('comments');
  // Jetpack::activate_module('likes');
  // Jetpack::activate_module('tiled-gallery');
  // echo '<li>Jetpack default modules activated.</li>';
// }


/*
* Dismiss Jetpack Admin Nag
* TODO: Look into if this is functioning correctly
*/
function fcc_jp_dismiss_manage_banner() {
  if ( !Jetpack_Options::get_option( 'dismissed_manage_banner') ) {
    Jetpack_Options::update_option( 'dismissed_manage_banner', true );
    echo '<li>Jetpack "Manage" Dashboard Banner Dismissed</li>';
  }
}


function fcc_jetpack_set_social_sharing_options() {
  /*
  * Set Jetpack Sharing Services:
  */
   $jp_sharing_services = array(
      'visible' =>
     array (
       0 => 'facebook',
       1 => 'twitter',
       2 => 'google-plus-1',
       3 => 'pinterest',
       4 => 'reddit',
     ),
      'hidden' =>
     array (
       0 => 'email',
       1 => 'linkedin',
       2 => 'tumblr',
       3 => 'pocket',
       4 => 'press-this',
       5 => 'print',
     ),
   );
   update_option( 'sharing-services', $jp_sharing_services );

   /*
   * Set Jetpack Sharing Options:
   */
   $jp_sharing_options = array(
      'global' => (array( 'button_style' => 'icon', 'sharing_label' => false, 'open_links' => 'same',
        'show'=> array( 0 => 'index', 1 => 'post', ),
        'custom' => array(),
     )),
   );
   update_option( 'sharing-options', $jp_sharing_options );
   echo '<li>Jetpack Social Sharing Options Set</li>';

}

?>
