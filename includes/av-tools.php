<?php

function av_theme_conversion_tool() {

  echo '<h2>Status:</h2><br>';

        $blog_id = get_current_blog_id();

        //Clear Options Cache to force update//
        wp_cache_delete ( 'alloptions', 'options' );

        //Set Theme to 'AreaVoices'//
        fcc_set_av_theme();

        /* Set Timezone */
        update_option( 'timezone_string', 'America/Chicago' );
        echo '<li>Timezone set to "America/Chicago"</li>';

        //Set Homepage to diplay 'Posts'//
        fcc_set_homepage();

        //Set Posts-Per-Page to 5//
        fcc_set_posts_per_page();

        //Delete Initial Blog Post//
        fcc_delete_first_post();

        //Delete Sample Page//
        fcc_delete_first_page();

        //Insert Default Categories//
        fcc_insert_default_categories();
        echo '<li>Inserted default categories.</li>';

        //Set the Default Post Category//
        fcc_set_default_category();
        echo '<li>Default post category set to "News"</li>';

        //Deactivate Widgets//
        fcc_clear_widgets();
        echo '<li>All widgets set to "Inactive"</li>';

				//Mark Site as Verified//
				add_option( 'av-verified-site', '1' );
				echo '<li>Site marked as "Verified"</li>';

        /* Jetpack Social Sharing Options*/
        fcc_jetpack_set_social_sharing_options();

        /* Jetpack Activation */
        fcc_jetpack_connect();

        /* Activate Jetpack Modules */
        // fcc_activate_modules();

        /* Dismiss Jetpack Admin Nag */
        fcc_jp_dismiss_manage_banner();

        //Clear Options Cache to force update//
        wp_cache_delete ( 'alloptions', 'options' );

        echo '<p><em>Blog Setup/Conversion Complete!</em></p>';

}

function av_theme_conversion_tool_test() {
  echo '<p><em>Blog Setup/Conversion Complete!</em></p>';
}

?>
