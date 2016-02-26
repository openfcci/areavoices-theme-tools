<?php

/*****************************
* Jetpack Activation & Setup *
*****************************/

/*
* Jetpack Activation:
* Connects Jetpack if not currently active
* Status: CURRENTLY DEPRECATED, see fcc_jetpack_connect()
*/
/*function fcc_jetpack_activate() {
  $jp_active = get_option('jetpack_activated');
  if ( $jp_active != 1 ) {
   if ( $current_user != $super_admin) { wp_set_current_user($super_admin); }
     $jetpack_network = Jetpack_Network::init();
     $jetpack_network->do_subsiteregister($blog_id);
   wp_set_current_user($current_user);
   $jp_status = get_option('jetpack_activated');
   if ($jp_status == 1 ) { echo '<li>Jetpack Status: The plugin was activated normally.</li>'; }
   elseif ($jp_status == 2 ) { echo '<li>Jetpack Status: The plugin was activated on this site because of a network-wide activation.</li>'; }
   elseif ($jp_status == 3 ) { echo '<li>Jetpack Status: The plugin was auto-installed.</li>'; }
   elseif ($jp_status == 4 ) { echo '<li>Jetpack Status: The plugin was was manually disconnected (but is still installed).</li>'; }
  }
}*/

/*
* Set New Blog Jetpack Default Options
* Added 10/15/15
*/
//function fcc_new_site_options( $blog_id, $user_id, $domain, $path, $site_id, $meta ) {
  /* Jetpack Auto-Connect / Subsite Register */
    /*Set Variables*/
    //$super_admin = '1';
    //$current_user = get_current_user_id();
  //Set UserID to SuperAdmin for Jetpack Registration//
  /* if ( $current_user != $super_admin) { wp_set_current_user($super_admin); }
    $jetpack_network = Jetpack_Network::init();
    $jetpack_network->do_subsiteregister($blog_id);
  wp_set_current_user($current_user); //return to original user */


  //Switch to New Blog Site//
  //switch_to_blog( $blog_id );

   //Jetpack Fallback Check//
    /* $jp_active = get_option('jetpack_activated');
    if ( $jp_active != 1 ) {
      if ( $current_user != $super_admin) { wp_set_current_user($super_admin); }
        $jetpack_network = Jetpack_Network::init();
        $jetpack_network->do_subsiteregister($blog_id);
      wp_set_current_user($current_user);
    } */

   //Set Posts-Per-Page//
   //update_option( 'posts_per_page', '5' );

    //Set Theme//
    /*$current_theme = wp_get_theme();
     if ( $current_theme != 'AreaVoices') {
       switch_theme( 'areavoices', 'areavoices' );
     }*/

    // Delete Initial Blog Post //
    //wp_delete_post( 1, 1 );

    // Delete Sample Page //
    //wp_delete_post( 2, 1 );

   /*Dismiss Admin Nag*/
   //Jetpack_Options::update_option( 'dismissed_manage_banner', true );

   //Set Jetpack Sharing Services//
  /* $jp_sharing_services = array(
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
   update_option( 'sharing-services', $jp_sharing_services ); */

   //Set Jetpack Sharing Options//
  /* $jp_sharing_options = array(
      'global' => (array( 'button_style' => 'icon', 'sharing_label' => false, 'open_links' => 'same',
        'show'=> array( 0 => 'index', 1 => 'post', ),
        'custom' => array(),
     )),
   );
   update_option( 'sharing-options', $jp_sharing_options ); */

   //Deactivate Widgets//
   //fcc_clear_widgets();

   //Clear Options Cache to force update//
   //wp_cache_delete ( 'alloptions', 'options' );

  //Return to Source//
  //restore_current_blog();
//}
//add_action( 'wpmu_new_blog', 'fcc_new_site_options', 10); /* 200 for post-Jetpack, 10 for pre-jetpac

?>
