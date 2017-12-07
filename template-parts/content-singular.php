<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="post-content">
        <?php the_content(); ?>
        <?php wp_link_pages( array(
            'before' => '<div class="post-page-links">' . esc_html__( 'Pages:', 'flex-lite' ),
            'after'  => '</div>',
            'nextpagelink'     => __( 'Next page', 'flex-lite' ),
            'previouspagelink' => __( 'Previous page', 'flex-lite' ),
        )); ?>
        <?php edit_post_link( '<span class="social-icon" data-icon="ei-pencil" data-size="s"></span><span>' . __('Edit', 'flex-lite') . '</span>' ); ?>                 
    </div>
    
</article>