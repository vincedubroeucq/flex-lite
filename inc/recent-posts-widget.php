<?php 
/**
 * Adds the Flex Recent Posts Widget.
 */
class Flex_Recent_Posts extends WP_Widget {

	function __construct() {
		parent::__construct(
			'flex_lite_recent_posts_widget', 								// Base ID
			esc_html__( 'Flex-Lite Recent Posts Widget', 'flex-lite' ),     // Name
			array(
				'classname'	=> 'recent-posts-widget', 
				'description' => esc_html__( 'Displays some of your most recent posts in your sidebar or other widgetized area.', 'flex-lite' ),
				'customize_selective_refresh' => true,
			)                                                               // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		switch( (int) $instance['num_posts'] ) {
			case '2':
				$container_class = 'two-posts';
				break;
			case '3':
				$container_class = 'three-posts';
				break;
			case '4':
				$container_class = 'four-posts';
				break;
		}		

		echo $args['before_widget'];
		
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . esc_html( apply_filters( 'widget_title', $instance['title'] ) ) . $args['after_title'];
		}

		// Setup our posts query
        $query = new WP_Query( 
            array( 
                'posts_per_page' => absint( $instance['num_posts'] ),
            ) 
        );

        if ( $query->have_posts() ) : ?>

		<div class="recent-posts <?php echo esc_attr( $container_class ); ?>">
		
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<article class="recent-post">
					
					<header class="recent-post-header">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<h3 class="recent-post-title"><?php the_title(); ?></h3>
						</a>
						<?php if ( absint( $instance['display_meta'] ) ): ?>
							<p class="post-meta"><?php flex_lite_header_meta(); ?></p>
						<?php endif; ?>
					</header>

					<?php if ( has_post_thumbnail() && absint( $instance['display_thumbnail'] ) ): ?>
						<div class="thumbnail-container">
							<?php the_post_thumbnail( 'large' ); ?>
						</div>
					<?php endif; ?>

					<?php if ( absint( $instance['display_excerpt'] ) ) {
						the_excerpt();
					} ?>
					<a class="button" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php esc_html_e( 'Read-more', 'flex-lite' ); ?></a>
				
				</article>

			<?php endwhile; ?>
		
		</div>

		<?php endif; wp_reset_postdata();

		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$defaults = array( 
			'title'             => '',
			'display_meta'      => 1,
			'display_thumbnail' => 1,
			'display_excerpt'   => 1, 
			'num_posts'			=> 3,
			);

		// Merge defaults arguments with user-submitted settings of the instance
		$instance = wp_parse_args( $instance, $defaults );
		?>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'flex-lite' ); ?></label> 
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
            </p>
			<p>
				<?php esc_html_e( 'Number of posts to display : ', 'flex-lite' ); ?><br>
				<label><input type="radio" name="<?php echo esc_attr( $this->get_field_name( 'num_posts' ) ); ?>" value="2" <?php checked( $instance['num_posts'], '2' ); ?> /><?php esc_html_e( '2', 'flex-lite' );?></label><br>
				<label><input type="radio" name="<?php echo esc_attr( $this->get_field_name( 'num_posts' ) ); ?>" value="3" <?php checked( $instance['num_posts'], '3' ); ?> /><?php esc_html_e( '3', 'flex-lite' );?></label><br>
				<label><input type="radio" name="<?php echo esc_attr( $this->get_field_name( 'num_posts' ) ); ?>" value="4" <?php checked( $instance['num_posts'], '4' ); ?> /><?php esc_html_e( '4', 'flex-lite' );?></label><br>
			</p>
			<p>
				<label>
					<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'display_meta' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'display_meta' ) ); ?>" value="1" <?php checked( $instance['display_meta'], 1, true ); ?> />
					<?php esc_html_e( 'Display Meta Information ?', 'flex-lite' ); ?>
				</label> 
			</p>
			<p>
				<label>
					<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'display_thumbnail' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'display_thumbnail' ) ); ?>" value="1" <?php checked( $instance['display_thumbnail'], 1, true ); ?> />
					<?php esc_html_e( 'Display Thumbnail ?', 'flex-lite' ); ?>
				</label> 
			</p>
			<p>
				<label>
					<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'display_excerpt' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'display_excerpt' ) ); ?>" value="1" <?php checked( $instance['display_excerpt'], 1, true ); ?> />
					<?php esc_html_e( 'Display Excerpt ?', 'flex-lite' ); ?>
				</label> 
			</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = array();
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['num_posts'] = absint( $new_instance['num_posts'] );
		$instance['display_meta'] = absint( $new_instance['display_meta'] );
		$instance['display_thumbnail'] = absint( $new_instance['display_thumbnail'] );
		$instance['display_excerpt'] = absint( $new_instance['display_excerpt'] );
		
		return $instance;
	}

}
register_widget( 'Flex_Recent_Posts' );