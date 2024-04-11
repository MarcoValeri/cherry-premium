<?php
function cherrypremium_enqueue_block_books_assets() {
    wp_enqueue_script("cherrypremium-blocks", get_template_directory_uri() . "/blocks/cherrypremium-blocks.js", ["wp-blocks", "wp-element", "wp-editor"]);
    wp_enqueue_style("cherrypremium-blocks-style", get_template_directory_uri() . "/blocks/blocks.css", false, "1.1", "all");
}
add_action("enqueue_block_editor_assets", "cherrypremium_enqueue_block_books_assets");