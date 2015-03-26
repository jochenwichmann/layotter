<?php

 
/**
 * Load translation files
 */
add_action('plugins_loaded', 'layotter_load_i18n');
function layotter_load_i18n() {
    load_plugin_textdomain('layotter', false, basename(__DIR__) . '/languages/');
}


/**
 * Replace TinyMCE with Layotter on Layotter-enabled screens
 */
add_action('admin_head', 'layotter_admin_head');
function layotter_admin_head() {
    if (!Layotter::is_enabled()) {
        return;
    }

    $post_type = get_post_type();

    // remove TinyMCE
    remove_post_type_support($post_type, 'editor');

    // insert layotter
    add_meta_box(
        'layotter_wrapper', // ID
        'Layotter', // title
        'layotter_output_interface', // callback
        $post_type, // post type for which to enable
        'normal', // position
        'high' // priority
    );
}


/**
 * Output backend HTML for Layotter
 *
 * @param $post object Post object as provided by Wordpress
 */
function layotter_output_interface($post) {
    // show a regular textarea with JSON data if debug mode is enabled for the current user role
    // otherwise create a hidden textarea to be synced with Layotter via Javascript

    $current_user = wp_get_current_user();
    $user_roles = $current_user->roles;
    $settings = Layotter_Settings::get_settings('general');
    $debug_mode_enabled = false;

    foreach ($user_roles as $role) {
        if (isset($settings['debug_mode'][$role]) AND $settings['debug_mode'][$role] == '1') {
            $debug_mode_enabled = true;
            break;
        }
    }

    // prepare JSON data for representation in textarea
    // replace
    //      & with &amp;
    //      < with &lt;
    //      > with &gt;
    // as they can break the textarea and/or JSON validity
    $clean_content_for_textarea = str_replace(array('&', '<', '>'), array('&amp;', '&lt;', '&gt;'), $post->post_content);

    if ($debug_mode_enabled) {
        echo '<p>';
        printf(__('Debug mode enabled: Inspect and manually edit the JSON structure generated by Layotter. Use with caution. A faulty structure will break your page layout and content. Go to the <a href="%s">Layotter\'s settings page</a> to disable debug mode.', 'layotter'), admin_url('options-general.php?page=layotter-settings'));
        echo '</p>';
        echo '<textarea id="content" name="content" style="width: 100%; height: 320px;display: block;">' . $clean_content_for_textarea . '</textarea>';
    } else {
        echo '<textarea id="content" name="content" style="width: 1px; height: 1px; position: fixed; top: -999px; left: -999px;">' . $clean_content_for_textarea . '</textarea>';
    }
    
    require_once dirname(__FILE__) . '/views/editor.php';
}


/**
 * Include saved_elements sidebar template in admin footer
 */
add_action('admin_footer-post.php', 'layotter_admin_footer_assets');
add_action('admin_footer-post-new.php', 'layotter_admin_footer_assets');
function layotter_admin_footer_assets() {
    if (Layotter::is_enabled()) {
        require dirname(__FILE__) . '/views/templates.php';
    }
}