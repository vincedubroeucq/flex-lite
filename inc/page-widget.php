<?php 
/**
 * Adds Flex_Page Widget.
 */
class Flex_Featured_Page extends WP_Widget {

	function __construct() {
		parent::__construct(
			'flex_lite_page_widget', 								// Base ID
			esc_html__( 'Flex-Lite Page Widget', 'flex-lite' ),     // Name
			array(
				'classname'	=> 'page-widget', 
				'description' => esc_html__( 'Feature a page content on your home page or sidebar', 'flex-lite' ),
				'customize_selective_refresh' => true,
			) // Args
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

		// Extract arguments for simpler handling
		extract( $instance );
		extract( $args );

		echo $before_widget;
		
		if ( ! empty( $title ) ) {
			echo $before_title . apply_filters( 'widget_title', $title ) . $after_title;
		}

		$query = new WP_Query(  
			array( 'page_id' => $selected_page, 'post_type' => 'page')
		);

		while ( $query->have_posts() ) : $query->the_post();
		?>
			
			<header class="page-widget-header">
				<?php the_title( '<h3 class="page-widget-title">', '</h3>' ); ?>
			</header>

			<div class="page-widget-content <?php echo esc_attr( $thumbnail_option ); ?>">	
				<?php if ( has_post_thumbnail() && ( ( 'left-thumbnail' == $thumbnail_option ) || ( 'right-thumbnail' == $thumbnail_option ) ) ): ?>
					<div class="thumbnail-container">
						<?php the_post_thumbnail('large'); ?>
					</div>
				<?php endif; ?>

				<div class="page-content <?php echo esc_attr( $content_size . ' ' . $text_style ); ?>">
					<?php the_content('<span>' . __('Read more', 'flex-lite') . '</span><span data-icon="ei-arrow-right" data-size="s"></span>'); ?>
					<?php if( $display_read_more ): ?>					
						<a class="button" href="<?php echo get_the_permalink(); ?>"><?php esc_html_e( 'Read more', 'flex-lite' ); ?></a>
					<?php endif; ?>
				</div>
			</div>

		<?php
		endwhile;
		wp_reset_postdata();

		echo $after_widget;
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
			'selected_page'     => '',
			'thumbnail_option'  => 'left-thumbnail',
			'content_size'      => 'one-half',
			'text_style'        => 'text-left',
			'display_read_more' => '1',
		);

		// Merge defaults arguments with user-submitted settings of the instance
		$instance = wp_parse_args( $instance, $defaults );
		extract( $instance );

		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'flex-lite' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'selected_page' ) ); ?>"><?php esc_html_e( 'Choose a page :', 'flex-lite' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'selected_page' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'selected_page' ) ); ?>" style="display: block; width: 100%;">
				
				<?php
					if ( empty( $selected_page ) ) {
						echo '<option>' . esc_html( 'Choose a page', 'flex-lite' ) . '</option>';
					}

					// Get the list of pages and display an option list.
					$pages = get_posts( array( 'post_type' => 'page' ) );

					foreach ( $pages as $page ) {
						echo '<option value="' . esc_attr( $page->ID ) . '" ' . selected( $selected_page, $page->ID, false ). '">' . esc_html( $page->post_title . ' - ID = ' . $page->ID) . '</option>';
					}
					unset( $page );
				?>

			</select>
		</p>
		<p>
			<?php esc_html_e( 'Thumbnail : ', 'flex-lite' ); ?><br>
			<label><input type="radio" name="<?php echo esc_attr( $this->get_field_name( 'thumbnail_option' ) ); ?>" value="no-thumbnail" <?php checked( $thumbnail_option, 'no-thumbnail' ); ?> /><?php esc_html_e( 'No thumbnail', 'flex-lite' );?></label><br>
			<label><input type="radio" name="<?php echo esc_attr( $this->get_field_name( 'thumbnail_option' ) ); ?>" value="left-thumbnail" <?php checked( $thumbnail_option, 'left-thumbnail' ); ?> /><?php esc_html_e( 'Left thumbnail', 'flex-lite' );?></label><br>
			<label><input type="radio" name="<?php echo esc_attr( $this->get_field_name( 'thumbnail_option' ) ); ?>" value="right-thumbnail" <?php checked( $thumbnail_option, 'right-thumbnail' ); ?> /><?php esc_html_e( 'Right thumbnail', 'flex-lite' );?></label><br>
		</p>
		<p>
			<?php esc_html_e( 'Content size : ', 'flex-lite' ); ?><br>
			<label><input type="radio" name="<?php echo esc_attr( $this->get_field_name( 'content_size' ) ); ?>" value="one-third" <?php checked( $content_size, 'one-third' ); ?> /><?php esc_html_e( 'One third', 'flex-lite' );?></label><br>
			<label><input type="radio" name="<?php echo esc_attr( $this->get_field_name( 'content_size' ) ); ?>" value="one-half" <?php checked( $content_size, 'one-half' ); ?> /><?php esc_html_e( 'One half', 'flex-lite' );?></label><br>
			<label><input type="radio" name="<?php echo esc_attr( $this->get_field_name( 'content_size' ) ); ?>" value="two-thirds" <?php checked( $content_size, 'two-thirds' ); ?> /><?php esc_html_e( 'Two thirds', 'flex-lite' );?></label><br>
		</p>
		<p>
			<?php esc_html_e( 'Text style : ', 'flex-lite' ); ?><br>
			<label><input type="radio" name="<?php echo esc_attr( $this->get_field_name( 'text_style' ) ); ?>" value="text-center" <?php checked( $text_style, 'text-center' ); ?> /><?php esc_html_e( 'Centered', 'flex-lite' );?></label><br>
			<label><input type="radio" name="<?php echo esc_attr( $this->get_field_name( 'text_style' ) ); ?>" value="text-left" <?php checked( $text_style, 'text-left' ); ?> /><?php esc_html_e( 'Left aligned', 'flex-lite' );?></label><br>
			<label><input type="radio" name="<?php echo esc_attr( $this->get_field_name( 'text_style' ) ); ?>" value="text-right" <?php checked( $text_style, 'text-right' ); ?> /><?php esc_html_e( 'Right aligned', 'flex-lite' );?></label><br>
		</p>

		<p>
			<label>
				<input type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'display_read_more' ) ); ?>" value="1" <?php checked( $display_read_more, '1' ); ?> />
				<?php esc_html_e( 'Display \'Read More\' button ? : ', 'flex-lite' );?>
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
		extract( $new_instance );

		$instance = array();
		$instance['title'] = sanitize_text_field( $title );
		$instance['selected_page'] = absint( $selected_page );
		$instance['thumbnail_option'] = $thumbnail_option;
		$instance['content_size'] = $content_size;
		$instance['text_style'] = $text_style;
		$instance['display_read_more'] = absint( $display_read_more );

		return $instance;
	}

}
register_widget( 'Flex_Featured_Page' );