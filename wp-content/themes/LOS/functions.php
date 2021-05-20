<?php

function los_register_nav_menu(){
    register_nav_menus( array(
        'primary_menu' => 'Primary Menu',
        'header_menu' => 'Header Menu',
        'footer_menu'  =>'Footer Menu',
    ) );
}
add_action( 'after_setup_theme', 'los_register_nav_menu', 0 );


function create_pages_on_theme_activation_los(){
    
    // Set the title, template, etc
    $new_page_title     = __('Home','home'); // Page's title
    $page_check = get_page_by_title($new_page_title);   // Check if the page already exists
    // Store the above data in an array
    $new_page = array(
        'post_type'     => 'page', 
        'post_title'    => $new_page_title,
        'post_content'  => $new_page_content,
        'post_status'   => 'publish',
        'post_author'   => 1,
        'post_name'     => 'home'
    );
    // If the page doesn't already exist, create it
    if(!isset($page_check->ID)){
        $new_page_id = wp_insert_post($new_page);
        if(!empty($new_page_template)){
            update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
        }
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $new_page_id );
    }
    
    // Set the title, template, etc
    $new_page_title     = __('Spenden','spenden'); // Page's title
    $new_page_template  = 'templates/donate.php';
    $page_check = get_page_by_title($new_page_title);   // Check if the page already exists
    // Store the above data in an array
    $new_page = array(
        'post_type'     => 'page', 
        'post_title'    => $new_page_title,
        'post_content'  => $new_page_content,
        'post_status'   => 'publish',
        'post_author'   => 1,
        'post_name'     => 'spenden'
    );
    // If the page doesn't already exist, create it
    if(!isset($page_check->ID)){
        $new_page_id = wp_insert_post($new_page);
        if(!empty($new_page_template)){
            update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
        }
    }
    
    // Set the title, template, etc
    $new_page_title     = __('Community Agenda','events'); // Page's title
    $new_page_template  = 'templates/events.php';
    $page_check = get_page_by_title($new_page_title);   // Check if the page already exists
    // Store the above data in an array
    $new_page = array(
        'post_type'     => 'page', 
        'post_title'    => $new_page_title,
        'post_content'  => $new_page_content,
        'post_status'   => 'publish',
        'post_author'   => 1,
        'post_name'     => 'events'
    );
    // If the page doesn't already exist, create it
    if(!isset($page_check->ID)){
        $new_page_id = wp_insert_post($new_page);
        if(!empty($new_page_template)){
            update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
        }
    }
}

add_action( 'after_switch_theme', 'create_pages_on_theme_activation_los' );

add_shortcode( 'curryear', 'curryear_func' );
function curryear_func( $atts ) {
    $curryear = date("Y");
    return $curryear;
}


/* LANG SETTINGS */
function los_customize_register( $wp_customize ){
    $wp_customize->add_section(
        'los_lang_settings', 
        array(
            'title'    => __('Language Settings', 'los_lang'),
            'capability' => 'edit_theme_options',
            'description' => 'Change language settings here',
            'priority' => 120,
        )
    );
    $wp_customize->add_setting(
        'los_lang[gen]', 
        array(
            'default'        => 'de',
            'capability'     => 'edit_theme_options',
            'type'           => 'option',
        )
    );
    $wp_customize->add_control(
        'lang_gen', 
        array(
            'label'      => __('Language picker', 'lang_gen'),
            'section'    => 'los_lang_settings',
            'settings'   => 'los_lang[gen]',
            'type'       => 'radio',
            'choices'    => array(
                'de' => 'Deutsch',
                'fr' => 'Français',
                'it' => 'Italiano',
            ),
        )
    );
    
    $wp_customize->add_setting(
        'los_lang[nl_text]', 
        array(
            'default'        => 'Bleib informiert über die LOS, unsere Projkte und Anlässe:',
            'capability'     => 'edit_theme_options',
            'type'           => 'option',
            )
        );
    $wp_customize->add_control(
        'lang_nl_text', 
        array(
            'label'      => __('Newsletter Text', 'lang_nl_text'),
            'section'    => 'los_lang_settings',
            'settings'   => 'los_lang[nl_text]',
            'type'       => 'text'
        )
    );
    
    
    $wp_customize->add_setting(
        'los_lang[footer_upper]', 
        array(
            'default'        => 'Die LOS setzt sich dafür ein, dass frauenliebende Frauen in der Schweiz sichtbar und gleichberechtigt sind. Wir kämpfen für die Ehe für alle, für sicheren Schutz vor Diskriminierung und Repräsentation in den Medien.',
            'capability'     => 'edit_theme_options',
            'type'           => 'option',
            )
        );
    $wp_customize->add_control(
        'lang_footer_upper', 
        array(
            'label'      => __('Footer upper text', 'lang_footer_upper'),
            'section'    => 'los_lang_settings',
            'settings'   => 'los_lang[footer_upper]',
            'type'       => 'textarea'
        )
    );
}

add_action( 'customize_register', 'los_customize_register' );


/* SCRIPTS AND STYLES */
function add_theme_scripts() {
    wp_enqueue_style( 'remixicon', "https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" );
    wp_enqueue_style( 'style', get_stylesheet_uri() );
    wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js', array ( 'jquery' ), 1.1, true);
    wp_enqueue_script( 'style', get_template_directory_uri() . '/js/style.js', array ( 'jquery' ), 1.1, false);
    wp_enqueue_script( 'ajax-forms', get_template_directory_uri() . '/js/elements/ajax-forms.js', array ( 'jquery' ), 1.1, true);
    wp_enqueue_script( 'hyphens1', get_template_directory_uri() . '/js/hyphenopoly.app.js', array ( 'jquery' ), 1.1, false);
    wp_enqueue_script( 'hyphens2', get_template_directory_uri() . '/vendor/hyphenopoly/Hyphenopoly_Loader.js', array ( 'jquery' ), 1.1, false);
}
add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );


add_theme_support( 'post-thumbnails' );
add_theme_support( 'title-tag' );


function getMonth($i, $lang) {
    if ($lang == "de") {
        if ($i == 1) {
            $name = "Januar";
        } else if ($i == 2) {
            $name = "Februar";
        } else if ($i == 3) {
            $name = "März";
        } else if ($i == 4) {
            $name = "April";
        } else if ($i == 5) {
            $name = "Mai";
        } else if ($i == 6) {
            $name = "Juni";
        } else if ($i == 7) {
            $name = "Juli";
        } else if ($i == 8) {
            $name = "August";
        } else if ($i == 9) {
            $name = "September";
        } else if ($i == 10) {
            $name = "Oktober";
        } else if ($i == 11) {
            $name = "November";
        } else if ($i == 12) {
            $name = "Dezember";
        }
    }

    return($name);
}


function createLosTables() {

    require_once( __DIR__ . '/../../../wp-admin/includes/upgrade.php' );

    global $wpdb;

    $query = $wpdb->prepare( 'SHOW TABLES LIKE %s', "pn27_activists" );

    if ( $wpdb->get_var( $query ) === "pn27_activists" ) {
        
    } else {
        $sql_activists = "CREATE TABLE IF NOT EXISTS `pn27_activists` (
            `activist_ID` int(11) NOT NULL AUTO_INCREMENT,
            `activist_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
            `activist_UUID` varchar(100) NOT NULL,
            `activist_support_type` varchar(255) NOT NULL,
            `activist_support_type_other` text NOT NULL,
            `activist_places` varchar(255) NOT NULL,
            `activist_fname` varchar(100) NOT NULL,
            `activist_lname` varchar(100) NOT NULL,
            `activist_email` varchar(100) NOT NULL,
            `activist_phone` int(100) NOT NULL,
            PRIMARY KEY activist_ID (activist_ID),
            UNIQUE KEY activist_UUID (activist_UUID)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
            
        $sql_members = "CREATE TABLE IF NOT EXISTS `pn27_members` (
            `member_ID` int(11) NOT NULL AUTO_INCREMENT,
            `mamber_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
            `member_UUID` varchar(100) NOT NULL,
            `member_type` varchar(50) NOT NULL,
            `member_anrede` int(11) NOT NULL,
            `member_orga` varchar(255) NOT NULL,
            `member_fname` varchar(100) NOT NULL,
            `member_lname` varchar(100) NOT NULL,
            `member_email` varchar(100) NOT NULL,
            `member_fname2` varchar(100) NOT NULL,
            `member_lname2` varchar(100) NOT NULL,
            `member_email2` varchar(100) NOT NULL,
            `member_street` varchar(255) NOT NULL,
            `member_plz` varchar(10) NOT NULL,
            `member_amount` varchar(100) NOT NULL,
            `member_lang` varchar(4) NOT NULL,
            `member_phone` varchar(100) NOT NULL,
            `member_year` int(11) NOT NULL,
            `member_notes` varchar(255) NOT NULL,
            PRIMARY KEY member_ID (member_ID),
            UNIQUE KEY member_UUID (member_UUID)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    
        dbDelta( $sql_activists );
        dbDelta( $sql_members );
    }

}

add_action('after_switch_theme', 'createLosTables');



	
require_once get_template_directory() . '/lib/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'los_register_required_plugins' );

function los_register_required_plugins() {
	$plugins = array( 

        array(
            'name' => 'Advanced Custom Fields: Image Aspect Ratio Crop',
            'slug' => 'acf-image-aspect-ratio-crop',
            'source'    => __DIR__ . '/lib/acf-image-aspect-ratio-crop.zip',
            'required' => true,
            'force_activation' => false,
            'force_deactivation' => true
        ),
        
        array(
            'name' => 'Classic Editor',
            'slug' => 'classic-editor',
            'source'    => __DIR__ . '/lib/classic-editor.zip',
            'required' => true,
            'force_activation' => false,
            'force_deactivation' => true
        ),
        
        array(
            'name' => 'Custom Post Type UI',
            'slug' => 'custom-post-type-ui',
            'source'    => __DIR__ . '/lib/custom-post-type-ui.zip',
            'required' => true,
            'force_activation' => false,
            'force_deactivation' => true
        ),
        
        array(
            'name' => 'Favicon by RealFaviconGenerator',
            'slug' => 'favicon-by-realfavicongenerator',
            'source'    => __DIR__ . '/lib/favicon-by-realfavicongenerator.zip',
            'required' => true,
            'force_activation' => false,
            'force_deactivation' => true
        ),
        
        array(
            'name' => 'Require Featured Image',
            'slug' => 'require-featured-image',
            'source'    => __DIR__ . '/lib/require-featured-image.zip',
            'required' => true,
            'force_activation' => false,
            'force_deactivation' => true
        ),
        
        array(
            'name' => 'The SEO Framework',
            'slug' => 'autodescription',
            'source'    => __DIR__ . '/lib/autodescription.zip',
            'required' => true,
            'force_activation' => false,
            'force_deactivation' => true
        ),

    );

    $config = array(
        'id'           => 'tgm_act',               // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
    );

    
    tgmpa( $plugins, $config );
}

require_once(__DIR__ . '/lib/post-types.php');

add_action( 'init', 'los_register_posttypes' );

// Define path and URL to the ACF plugin.
define( 'MY_ACF_PATH', get_stylesheet_directory() . '/lib/acf/' );
define( 'MY_ACF_URL', get_stylesheet_directory_uri() . '/lib/acf/' );

// Include the ACF plugin.
include_once( MY_ACF_PATH . 'acf.php' );

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'my_acf_settings_url');
function my_acf_settings_url( $url ) {
    return MY_ACF_URL;
}

add_filter('acf/settings/save_json', 'set_acf_json_save_folder');
function set_acf_json_save_folder( $path ) {
    $path = MY_ACF_PATH . '/acf-json';
    return $path;
}
add_filter('acf/settings/load_json', 'add_acf_json_load_folder');
function add_acf_json_load_folder( $paths ) {
    unset($paths[0]);
    $paths[] = MY_ACF_PATH . '/acf-json';;
    return $paths;
}

// (Optional) Hide the ACF admin menu item.
add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
function my_acf_settings_show_admin( $show_admin ) {
    return false;
}
?>