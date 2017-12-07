<section <?php post_class('page'); ?>>
    <header class="post-header">
        <h2 class="post-title"><?php esc_html_e( 'Nothing Found !', 'flex-lite' ); ?></h2>
    </header>
    
    <?php if (is_search()): ?>
        
        <div class="post-content">
            <p><?php esc_html_e( 'Just try something else.', 'flex-lite' ); ?><p>
            <?php get_search_form(); ?>
        </div>
        
    <?php else : ?>
        
        <div class="post-content">
            <p><?php esc_html_e( 'Looks like you still have to publish something.', 'flex-lite' ); ?><p>
        </div>
    
    <?php endif; ?>
    
    
</section>