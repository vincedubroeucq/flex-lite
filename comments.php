<?php
/**
 * The template for displaying comments.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Flex-lite
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	if ( have_comments() ) : ?>
    
		<h3 class="comments-title">
			<?php
				printf(
					esc_html( _nx( 'One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'flex-lite' ) ),
					number_format_i18n( get_comments_number() ),
					'<span>' . get_the_title() . '</span>'
				);
			?>
		</h3>


		<ul class="comment-list">
			<?php
				wp_list_comments( array(
					'short_ping' 		=> true,
					'avatar_size'       => 64,
					'format'            => 'html5'
				) );
			?>
		</ul><!-- .comment-list -->


		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h3 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'flex-lite' ); ?></h3>
			<div class="flex-navigation">
				<div class="nav-previous"><?php previous_comments_link('<span data-icon="ei-arrow-left" data-size="s"></span><span>' . esc_html__( 'Older Comments', 'flex-lite' ) . '</span>'); ?></div>
				<div class="nav-next"><?php next_comments_link( '<span>' . esc_html__( 'Newer Comments', 'flex-lite' ) .'</span><span data-icon="ei-arrow-right" data-size="s"></span>' ); ?></div>
			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php
		endif; // Check for comment navigation.

	endif; // Check for have_comments().


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'flex-lite' ); ?></p>
	<?php
	endif;

	comment_form();
	?>

</div><!-- #comments -->
