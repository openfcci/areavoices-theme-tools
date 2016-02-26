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
