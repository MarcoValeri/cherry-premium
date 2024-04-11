<main class="wp-block-group">
    <h2>index.php</h2>
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            $pageTitle = get_the_title();
            $pageContent = get_the_content();
            ?>
            <div>
                <div>
                    <?= $pageTitle; ?>
                </div>
                <div>
                    <?= $pageContent; ?>
                </div>
            </div>
            <?php
        }
    }
    ?>
    <div>
	    <!-- wp:post-title  /-->
	    <!-- wp:post-content /-->
    </div>
</main>