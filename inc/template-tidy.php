<?php
/**
 * Cherry Premium remove wordpress junk
 *
 *
 * @package WordPress
 * @since 1.0.0
 */

/**
* Tidy up Wordpress default outputs *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** 
*/
add_filter( 'emoji_svg_url', '__return_false' ); // REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);// REMOVE WP EMOJI
remove_action('wp_print_styles', 'print_emoji_styles');// REMOVE WP EMOJI

remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); // index link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0); // remove the shortlink
remove_action( 'wp_head', 'rest_output_link_wp_head');
remove_action( 'wp_head', 'wp_oembed_add_discovery_links');

function cherrypremium_deregister_scripts(){
  wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'cherrypremium_deregister_scripts' );

// /** stop WP adding it's dirty inline-css blocks */


add_action( 'wp_enqueue_scripts', function() : void {
    // Dequeue the styles added by theme.json file
    wp_dequeue_style('global-styles');
    wp_dequeue_style('block-styles');
});


remove_action( 'wp_footer', 'the_block_template_skip_link' );
remove_action( 'wp_footer', 'wp_enqueue_global_styles', 1 );
remove_filter( 'render_block', 'wp_render_layout_support_flag', 10, 2 );
remove_filter( 'render_block', 'wp_render_elements_support', 10, 2 );
remove_filter( 'pre_render_block', 'wp_render_elements_support_styles', 10, 2 );

add_action('wp_footer', function () {
    wp_dequeue_style('core-block-supports');
});

if(!is_admin()){
    function remove_block_css() {
        wp_dequeue_style('wp-block-library');
        wp_dequeue_style('wp-block-library-theme');
    }
    add_filter('use_block_editor_for_post_type', '__return_false', 10);
    add_action('wp_enqueue_scripts', 'remove_block_css', 100 );
    function prefix_remove_core_block_styles() {
        global $wp_styles;

        foreach ( $wp_styles->queue as $key => $handle ) {
            if ( strpos( $handle, 'wp-block-' ) === 0 ) {
                wp_dequeue_style( $handle );
            }
        }
    }
    add_action( 'wp_enqueue_scripts', 'prefix_remove_core_block_styles' );
    remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
    remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
}

function my_theme_remove_interactivity_js() {
    wp_dequeue_script( 'interactivity-handle' ); // Replace 'interactivity-handle' with the actual handle used for interactivity.js
}
add_action( 'wp_enqueue_scripts', 'my_theme_remove_interactivity_js', 100 );