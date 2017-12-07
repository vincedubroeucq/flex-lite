<?php if ( is_single() ): ?>

    <div class="flex-navigation">
        <?php previous_post_link('%link', '<span data-icon="ei-arrow-left" data-size="s"></span><span>' . __( 'Previous Post', 'flex-lite' ) . '</span>'); ?>
        <?php next_post_link('%link', '<span>' . __( 'Next Post', 'flex-lite') . '</span><span data-icon="ei-arrow-right" data-size="s"></span>'); ?>
    </div>

<?php else : ?>
    <?php if ( get_next_posts_link() ) : ?>
        <div class="flex-navigation">
            <?php next_posts_link('<span data-icon="ei-arrow-left" data-size="s"></span><span>' . __( 'Older Posts', 'flex-lite' )  .'</span>'); ?>
            <?php previous_posts_link('<span>' . __( 'Newer Posts', 'flex-lite' ) . '</span><span data-icon="ei-arrow-right" data-size="s"></span>'  ); ?>
        </div>
    <?php endif; ?>
<?php endif; ?>