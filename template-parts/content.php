<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="post-header">
        <?php the_title( sprintf( '<h2 class="post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
        <p class="post-meta"><?php flex_lite_meta(); ?></p>
    </header>

    <?php if ( has_post_thumbnail() ) : ?>
    <div class="thumbnail-container">
        <?php the_post_thumbnail('large'); ?>
    </div>
    <?php endif; ?>

    <div class="post-content">
        <?php the_content('<span>' . __('Read more', 'flex-lite') . '</span><span data-icon="ei-arrow-right" data-size="s"></span>'); ?>
        <?php wp_link_pages( array(
            'before' => '<div class="post-page-links">' . esc_html__( 'Pages:', 'flex-lite' ),
            'after'  => '</div>',
            'nextpagelink'     => __( 'Next page', 'flex-lite' ),
            'previouspagelink' => __( 'Previous page', 'flex-lite' ),
        )); ?>
        <?php edit_post_link( '<span class="social-icon" data-icon="ei-pencil" data-size="s"></span><span>' . __('Edit', 'flex-lite') . '</span>' ); ?>                 
    </div>

</article>

<hr />