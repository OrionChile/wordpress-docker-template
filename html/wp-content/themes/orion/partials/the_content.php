<div class="entry-content content">
    <?php
    the_content(
        sprintf(
            wp_kses(
                /* translators: %s: Post title. Only visible to screen readers. */
                __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentynineteen'),
                array(
                    'span' => array(
                        'class' => array(),
                    ),
                )
            ),
            get_the_title()
        )
    );
    wp_link_pages(
        array(
            'before' => '<div class="page-links">' . __('Pages:', 'twentynineteen'),
            'after'  => '</div>',
        )
    );
    ?>
</div><!-- .entry-content -->