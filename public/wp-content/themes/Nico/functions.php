<?php
    add_theme_support( 'menus' );

    if( function_exists('acf_add_options_page') ) {

	    acf_add_options_page();

    }
    // add_filter('body_class', 'mbe_body_class');
    // add_action('wp_head', 'mbe_wp_head');

    //

    define( 'THEME_DIRECTORY', get_stylesheet_directory() );
    define( 'THEME_URI', get_stylesheet_directory_uri() );
    define( 'THEME_LIBS', THEME_URI . '/assets/dist/libs' );
    define( 'THEME_INCLUDE', THEME_DIRECTORY . '/includes' );
    define( 'THEME_IMAGES', THEME_URI . '/assets/dist/images' );
    define( 'THEME_CSS', THEME_URI . '/assets/dist/styles' );
    define( 'THEME_JS', THEME_URI . '/assets/dist/scripts' );

    include THEME_INCLUDE . '/post-types/hardware.php';
    include THEME_INCLUDE . '/post-types/case-studies.php';
    // include THEME_INCLUDE . '/events.php';

    //
    //
    // removing WP garbage from the site
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'start_post_rel_link', 10, 0);
    remove_action('wp_head', 'parent_post_rel_link', 10, 0);
    remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

    function disable_wp_emojicons() {
        // all actions related to emojis
        remove_action( 'admin_print_styles', 'print_emoji_styles' );
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
        remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
        remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

        // filter to remove TinyMCE emojis
        add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
    }
    add_action( 'init', 'disable_wp_emojicons' );

    function disable_emojicons_tinymce( $plugins ) {
        if ( is_array( $plugins ) ) {
            return array_diff( $plugins, array( 'wpemoji' ) );
        } else {
            return array();
        }
    }
    //
    // Enable thumbnails
    add_theme_support( 'post-thumbnails' );
    // add_image_size( 'post-thumb', 150, 100);
    // // add_image_size( 'gallery-grid-large', 540, 540, true);
    // // add_image_size( 'gallery-grid-normal', 270, 270, true);
    // // add_image_size( 'gallery-grid', 185, 185);
    //
    // add SVG support
    function cc_mime_types($mimes) {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    }

    add_filter('upload_mimes', 'cc_mime_types');

    // removing link to media default
    function reg_imagelink_setup() {
        $image_set = get_option( 'image_default_link_type' );

        if ($image_set !== 'none') {
            update_option('image_default_link_type', 'none');
        }
    }
    add_action('admin_init', 'reg_imagelink_setup', 10);
    //
    // Load site scripts
    function site_scripts() {
        wp_deregister_script('jquery');
        wp_deregister_script('jquery-ui-core');
        $pathTojQuery = "https://code.jquery.com/jquery-3.3.1.min.js";
        $pathToScripts = THEME_JS . "/scripts.js";
        $stickyfillJS = THEME_LIBS . "/stickyfill.min.js";
        $bootstrapJS = "https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js";
        $popperJS = "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js";
        $scrollOutJS = "https://unpkg.com/scroll-out/dist/scroll-out.min.js";
        $chartJS = "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js";
        // $cycleJS = THEME_LIBS . "/cycle2/jquery.cycle2.min.js";
        // $plyrJS = "https://cdn.plyr.io/2.0.16/plyr.js";
        // $pathToCycleCarousel = THEME_LIBS . "/cycle2/jquery.cycle2.carousel.min.js";
        // $pathToCycleSwipe = THEME_LIBS . "/cycle/jquery.cycle2.swipe.min.js";
        wp_enqueue_script( 'jquery', $pathTojQuery, array(), '3.3.1', true);
        wp_enqueue_script( 'popper', $popperJS, array('jquery'), '1.14.3', true);
        wp_enqueue_script( 'bootstrap', $bootstrapJS, array('jquery', 'popper'), '4.1.3', true);
        wp_enqueue_script( 'scrollOut', $scrollOutJS, 0, '2.2.3', true);
        wp_enqueue_script( 'chart', $chartJS, 0, '2.7.2', true);
        wp_enqueue_script( 'stickyfill', $stickyfillJS, 0, '2.1.0', true);

        // wp_enqueue_script( 'cycle', $cycleJS, array('jquery') , '1.0', true );
         // wp_enqueue_script( 'plyr', $plyrJS, array('jquery'), '0.0.0', false);
        // wp_enqueue_script( 'cycle-carousel', $pathToCycleCarousel, array('jquery','cycle') , '1.0', false );
        // wp_enqueue_script( 'cycle-swipe', $pathToCycleSwipe, array('jquery','cycle') , '1.0', false );
        wp_enqueue_script( 'site_script', $pathToScripts, array('jquery', 'bootstrap', 'scrollOut', 'chart', 'stickyfill') , '1.0', true );
    }
    add_action( 'wp_enqueue_scripts', 'site_scripts' );

    function blog_favicon() {
        echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_bloginfo('wpurl').'/favicon.ico" />';
    }
    add_action('wp_head', 'blog_favicon');
    //
    // function category_id_class($classes) {
    //     global $post;
    //     // if (!is_search() && !is_404()) :
    //     if( is_single() )
    //         foreach((get_the_category($post->ID)) as $category)
    //             $classes [] = 'cat-' . $category->cat_ID . '-id';
    //             return $classes;
    //     // endif;
    // }
    // add_filter('post_class', 'category_id_class');
    // add_filter('body_class', 'category_id_class');
    //
    function register_my_menus() {
        register_nav_menus(
        array(
            'main-menu' => __( 'Main Menu' ),
            'footer-menu' => __( 'Footer Menu' ),
            'footer-menu-utlity' => __( 'Footer Menu Utility' ) )
        );
    }

    add_action( 'init', 'register_my_menus' );

    function my_mce_buttons_2($buttons) {
        $buttons[] = 'sup';
        $buttons[] = 'sub';

        return $buttons;
    }

    add_filter('mce_buttons_2', 'my_mce_buttons_2');

    function reg_split_my_array($origin, $chunk) {
        $odds = array(); // left
        $evens = array(); // right

        foreach ($origin as $k => $v) {
            if ($k % 2 == 0) {
                $evens[] = $v;
            }
            else {
                $odds[] = $v;
            }
        }

        if ($chunk == 'even') {
            return $evens;
        }

        if ($chunk == 'odd') {
            return $odds;
        }
    }

    function filter_ptags_on_images($content){
        return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
    }

    add_filter('the_content', 'filter_ptags_on_images');
    // // Auto Generate Titles for repertoire.
    // // add_filter('wp_insert_post_data', 'reg_auto_generate_name_title');
    //
    // // function reg_auto_generate_name_title($data) {
    // //     global $post, $wpdb, $error;
    //
    // //     $error = new WP_Error();
    //
    // //     $postTypes = array('');
    //
    // //     if(!in_array($post->post_type, $postTypes)) {
    // //         return $data;
    // //     } else {
    //
    // //         if ($post->post_type == '') {
    // //             $fname = trim($_POST['cuztom']['_team_member_details_first_name']);
    // //             $minitial = str_replace('.', '', trim($_POST['cuztom']['_team_member_details_middle_initial']));
    // //             $lname   = trim($_POST['cuztom']['_team_member_details_last_name']);
    // //             $title   = trim($_POST['cuztom']['_team_member_details_title']);
    //
    // //             $fullslug = $fname . '-' . (!empty($minitial) ? $minitial . '-' : '') . $lname;
    // //             $fullname = $fname . (!empty($minitial) ? ' ' . $minitial . '.' : '') . ' ' . $lname;
    //
    // //             $slug = wp_unique_post_slug(sanitize_title($fullslug), $post->ID, $post->post_status, $post->post_type, $post->post_parent);
    //
    // //             $data['post_title'] = $fullname;
    //
    // //             $data['post_name']  = $slug;
    //
    // //             return $data;
    // //         }
    // //     }
    // // }

    function reg_get_random_string($length, $valid_chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456790")
    {
        $random_string = "";
        $num_valid_chars = strlen($valid_chars);
        for ($i = 0; $i < $length; $i++, $random_string .= $valid_chars[mt_rand(1, $num_valid_chars)-1]);
        return $random_string;
    }

    function reg_clean_title($source) {
        $lowered = strtolower($source);
        $search = array(' ', '-');
        $replace = array('_', '_');
        $modded = str_replace($search, $replace, $lowered);

        return $modded;
    }

    add_action('get_header', 'my_filter_head');

      function my_filter_head() {
        remove_action('wp_head', '_admin_bar_bump_cb');
      }

    // function clear_br($content){
    //     return str_replace("<br />","<br clear='none'/>", $content);
    // }
    // add_filter('the_content', 'clear_br');


    // for image syncing
    add_action('init', 'my_replace_image_urls' );
    function my_replace_image_urls() {
        if ( defined('WP_SITEURL') && defined('LIVE_SITEURL') ) {
            if ( WP_SITEURL != LIVE_SITEURL ){
                add_filter('wp_get_attachment_url', 'my_wp_get_attachment_url', 10, 2 );
            }
        }
    }

    function my_wp_get_attachment_url( $url, $post_id) {
        if ( $file = get_post_meta( $post_id, '_wp_attached_file', true) ) {
            if ( ($uploads = wp_upload_dir()) && false === $uploads['error'] ) {
                if ( file_exists( $uploads['basedir'] .'/'. $file ) ) {
                    return $url;
                }
            }
        }
        return str_replace( WP_SITEURL, LIVE_SITEURL, $url );
    }
?>
