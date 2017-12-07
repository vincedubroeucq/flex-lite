<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <blockquote class="post-content">

        <?php if ( has_post_thumbnail() ) : ?>
            <div class="thumbnail-container">
                <?php the_post_thumbnail( 'thumbnail' ); ?>
            </div>
        <?php endif; ?>

        <div class="testimonial-content">
            <?php the_content(); ?>
            <footer>
                <cite><?php the_title(); ?></cite>
            </footer>
        </div>

    </blockquote>

</article>

<hr />