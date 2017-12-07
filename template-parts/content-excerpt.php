<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="post-header">
        <?php the_title( sprintf( '<h2 class="post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
        <p class="post-meta"><?php flex_lite_meta(); ?></p>
        </header>

    <div class="post-content">
        <?php the_excerpt(); ?>
        <?php wp_link_pages( array(
            'before' => '<div class="post-page-links">' . esc_html__( 'Pages:', 'flex-lite' ),
            'after'  => '</div>',
            'nextpagelink'     => __( 'Next page', 'flex-lite' ),
            'previouspagelink' => __( 'Previous page', 'flex-lite' ),
        )); ?>
    </div>
</article>

<hr />