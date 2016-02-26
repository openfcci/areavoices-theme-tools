<?php
/*
Plugin Name: AreaVoices Theme Tools
Description: This plugin extends the AreaVoices Theme with additional functions and tools.
Version: 1.16.01.12
Author: FCC Digital / Ryan Veitch
Author http://forumcomm.com/
License: GPLv2
*/

/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
# Admin Menu Setup
# Admin Page
--------------------------------------------------------------*/

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/*--------------------------------------------------------------
# Admin Menu Setup
--------------------------------------------------------------*/
/*
* Admin Menu Setup
*/
function fcc_admin_tools_menu()
{
  if ( is_super_admin() ) { //Add the page for Super Admins only
    add_submenu_page(
      'ms-admin.php',
      'FCC Admin',
      'FCC Admin',
      'manage_options',
      'fcc_admin',
      'fcc_admin_tools_page'
    );
    require plugin_dir_path( __FILE__ ) . '/includes/av-tools.php';
    require plugin_dir_path( __FILE__ ) . '/includes/av-tools-admin-functions.php';
    require plugin_dir_path( __FILE__ ) . '/includes/av-tools-jetpack-functions.php';
  }
}
add_action( 'admin_menu', 'fcc_admin_tools_menu' );

/*--------------------------------------------------------------
# Admin Page
--------------------------------------------------------------*/
/*
* Admin Page
*/
function fcc_admin_tools_page()
{
    global $blog_id, $wpdb, $wp_roles, $wp_rewrite, $current_user, $current_site;

?>
<div class="wrap">
<?php
    switch ( $_GET['action'] ) {
      //---------------------------------------------------//
        default:
?>
			<h2><?php _e( 'FCC Admin Tools' ) ?></h2>
			<h3><?php _e( 'New Blog Setup' ) ?></h3>
			<div class="wrap">
        <form method="post" action="ms-admin.php?page=fcc_admin&action=fccexec">
          <p class="submit">
            <input type="submit" class="button-primary" name="Submit" value="<?php _e( 'Run AreaVoices Theme Blog Setup & Conversion Tool' ) ?>" />
          </p>
        </form>
      </div>
      <div class="wrap">
        <form method="post" action="ms-admin.php?page=fcc_admin&action=jetpackconnect">
          <p class="">
            <input type="submit" class="button-primary" name="Submit" value="<?php _e( 'Connect & Activate Jetpack' ) ?>" />
          </p>
        </form>
      </div>

			<?php
        break;
      //---------------------------------------------------//
        case "fccexec":
          av_theme_conversion_tool();
          //av_theme_conversion_tool_test();
          break;
        case "jetpackconnect":
          fcc_jetpack_connect();
          break;
    }
?>
</div>
<?php
}

?>
