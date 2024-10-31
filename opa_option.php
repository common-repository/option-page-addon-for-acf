<?php
/*
Plugin Name: Option Page Addon For ACF
Plugin URI: https://www.blog.mufaddal.me
Description: Option page addon for ACF.
Version: 1.0
Author: Murtuza Makda(Idrish)
Author URI: https://www.upwork.com/freelancers/~018f06972fe4607ad0
Text Domain: acf
License: GPL v3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$acf_active = false;

function acf_plugins_loaded_callback() {
    $active_plugins = get_option( 'active_plugins' );
    $is_wc_active   = in_array( 'advanced-custom-fields/acf.php', $active_plugins, true );

    if ( current_user_can( 'activate_plugins' ) && false === $is_wc_active ) {
        $acf_active = false;
        add_action( 'admin_notices', 'acf_admin_notices_callback' );
    } else {
        acf_load_complete();
        add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'acf_plugin_actions_callback' );
    }
}

function acf_load_complete(){

require plugin_dir_path( __FILE__ ) . 'admin/options-page.php';

require plugin_dir_path( __FILE__ ) . 'admin/admin-options-page.php';

require plugin_dir_path( __FILE__ ) . 'admin/class-acf-location-options-page.php';

add_filter('acf/location/rule_types', 'acf_location_rules_types');

function acf_location_rules_types( $choices ) {
    
    $choices['Forms']['options_page'] = 'Options Page';

    return $choices;
    
}

add_filter('acf/location/rule_operators', 'acf_location_rules_operators');

function acf_location_rules_operators( $choices ) {
    
    $choices['=='] = 'is equal to';
    $choices['!='] = 'is not equal to';

    return $choices;
    
}

}

add_action( 'plugins_loaded', 'acf_plugins_loaded_callback' );

function acf_admin_notices_callback() {
    $this_plugin_data = get_plugin_data( __FILE__ );
    $this_plugin      = $this_plugin_data['Name'];
    $wc_plugin        = 'Advanced Custom Fields';
    ?>
    <div class="error">
        <p>
            <?php
            /* translators: 1: %s: strong tag open, 2: %s: strong tag close, 3: %s: this plugin, 4: %s: Advanced Custom Fields plugin, 5: anchor tag for Advanced Custom Fields plugin, 6: anchor tag close */
            echo wp_kses_post( sprintf( __( '%1$s%3$s%2$s is ineffective as it requires %1$s%4$s%2$s to be installed and active. Click %5$shere%6$s to install or activate it.', 'easy-reservations' ), '<strong>', '</strong>', esc_html( $this_plugin ), esc_html( $wc_plugin ), '<a target="_blank" href="' . admin_url( 'plugin-install.php?s=Advanced%20Custom%20Fields&tab=search&type=term' ) . '">', '</a>' ) );
            ?>
        </p>
    </div>
    <?php
}

function acf_plugin_actions_callback( $links ) {
    $this_plugin_links = array(
        '<a title="' . __( 'Docs', 'acf' ) . '" class="thickbox" href="#TB_inline?&width=600&height=550&inlineId=option-page-addon-for-acf-docs-popup">' . __( 'Docs', 'acf' ) . '</a>',
        '<a title="' . __( 'Support', 'acf' ) . '" href="' . esc_url('https://www.upwork.com/freelancers/~018f06972fe4607ad0') . '">' . __( 'Support', 'acf' ) . '</a>',
    );

    add_thickbox();
    ?>
    <style>
        .sidenav {
            height: 100%;
            width: 300px;
            position: fixed;
            z-index: 1;
            overflow-x: hidden;
        }

        .content {
            margin-left: 40%;
            padding-left: 20px;
        }
    </style>
    <div id="option-page-addon-for-acf-docs-popup" style="display:none;">
        <div class="sidenav">
            <h2>Please Check My Other Plugins</h2>
            <img src="https://s.w.org/plugins/geopattern-icon/web-cam.svg" style="width:150px;height: 150px;">
            <h3><b>web-cam</b></h3>
            <h3>This is the only plugin which can access user's camera</h3>
            <h3>use case of this plugin</h3>
            <ul>
                <li>Authentication</li>
                <li>Verification</li>
                <li>Image capture</li>
                <li>Feedback Form</li>
                <li>Client Review Image</li>
                <li>Product Image</li>
            </ul>
            <br>
            <a href="https://wordpress.org/plugins/web-cam/" style="padding:10px 15px; color: white;background-color: #0073aa;">Download</a>
        </div>

        <div class="content">
            <h2>How to Add Option Pages in Your Site</h2>
            How to add Custom page Option using this plugin.<br>
            ------------------------------------------------<br>
            <code>
            if( function_exists('acf_add_options_page') ) {<br>
                
                &nbsp;&nbsp;acf_add_options_page(array(<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;'page_title'    => 'Theme General Settings',<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;'menu_title'    => 'Theme Settings',<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;'menu_slug'     => 'theme-general-settings',<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;'capability'    => 'edit_posts',<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;'redirect'      => false<br>
                &nbsp;&nbsp;));<br>
                &nbsp;&nbsp;acf_add_options_sub_page(array(<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;'page_title'    => 'Theme Header Settings',<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;'menu_title'    => 'Header',<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;'parent_slug'   => 'theme-general-settings',<br>
                ));<br>
                &nbsp;&nbsp;acf_add_options_sub_page(array(<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;'page_title'    => 'Theme Footer Settings',<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;'menu_title'    => 'Footer',<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;'parent_slug'   => 'theme-general-settings',<br>
                &nbsp;&nbsp;));<br>
            }<br>
        </code>
            Copy this Code & Paste in your child theme's function.php fle.
            or <br><b>you can follow official documentation of ACF.</b>
            <a href="https://www.advancedcustomfields.com/resources/options-page/" target="_blank">https://www.advancedcustomfields.com/resources/options-page/</a>
        </div>
    </div>
    <?php
    return array_merge( $this_plugin_links, $links );
}

