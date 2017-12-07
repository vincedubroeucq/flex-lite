<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <header class="post-header">    
        <?php the_title( sprintf( '<h2 class="post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
        <p class="post-meta"><?php flex_lite_project_meta(); ?></p>
    </header>

    <div class="post-content">

        <?php if ( has_post_thumbnail() ) : ?>
            <div class="thumbnail-container">
                <?php the_post_thumbnail( 'large' ); ?>
            </div>
        <?php endif; ?>

        <div class="project-content">
            <?php the_content(); ?>
        </div>
    </div>

</article>

<hr />