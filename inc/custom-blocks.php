<?php
function cherrypremium_enqueue_block_editor_assets() {
    wp_enqueue_script("cherrypremium-blocks", get_template_directory_uri() . "/blocks/cherrypremium-blocks.js", ["wp-blocks", "wp-element", "wp-editor"]);
}
add_action("enqueue_block_editor_assets", "cherrypremium_enqueue_block_editor_assets");