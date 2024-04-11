<?php
/**
* Cherry Premium Theme
* 
* @package Cherry Premium
* @since Cherry Premium 1.0
*/
// Remove generic wordpress stuff that's unnecessary for most sites
require get_template_directory() . '/inc/template-tidy.php';

// Add custom blocks
require get_template_directory() . "/inc/custom-blocks.php";

// Load CSS nad JS files
function cherrypremium_enqueue_script() {
    wp_enqueue_style("style-css", get_template_directory_uri() . "/style.css", false, "1.1", "all");
}
add_action("wp_enqueue_scripts", "cherrypremium_enqueue_script");