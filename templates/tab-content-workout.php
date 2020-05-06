<?php
/**
 * Template used to display post content on single pages.
 *
 * @package lsx-health-plan
 */
?>

<?php lsx_entry_before(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php lsx_entry_top(); ?>

	<div class="entry-meta">
		<?php lsx_post_meta_single_bottom(); ?>
	</div><!-- .entry-meta -->

	<div class="entry-content">
		<?php
			wp_link_pages(
				array(
					'before'      => '<div class="lsx-postnav-wrapper"><div class="lsx-postnav">',
					'after'       => '</div></div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				)
			);
		?>
		<div class="single-plan-inner workout-content">
			<div class="single-plan-section-title workout">
				<?php lsx_get_svg_icon( 'work.svg' ); ?>
				<h2 class="title-lined"><?php esc_html_e( 'My Workout', 'lsx-health-plan' ); ?> <span class="blue-title"><?php the_title(); ?></span></h2>
			</div>
			<?php
			if ( lsx_health_plan_has_warmup() ) {
				?>
				<div class="workout-instructions">
					<div class="row">
						<div class="col-md-6">
							<h3><?php esc_html_e( "Don't forget your warm up!", 'lsx-health-plan' ); ?></h3>
							<p><?php esc_html_e( 'Be sure to do the warm-up before every workout session.', 'lsx-health-plan' ); ?></p>
						</div>
						<div class="col-md-6">
							<div class="single-plan-inner-buttons">
								<?php
								$download = \lsx_health_plan\functions\get_option( 'download_page', false );
								if ( ! empty( $download ) ) {
									?>
									<div class="complete-plan-btn">
										<?php
										echo wp_kses_post( do_shortcode( '[download id="' . $download . '"]' ) );
										?>
									</div>
								<?php } ?>
								<div  class="back-plan-btn">
									<a class="btn secondary-btn wrm-up-btn" href="<?php the_permalink(); ?>warm-up/"><?php esc_html_e( 'See Warm-Up', 'lsx-health-plan' ); ?></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
			?>
			<!-- Pre Workout-->
			<?php lsx_workout_snacks( 'pre' ); ?>
			<div class="sets">
				<?php
				$connected_workouts = get_post_meta( get_the_ID(), 'connected_workouts', true );
				if ( empty( $connected_workouts ) ) {
					$options = \lsx_health_plan\functions\get_option( 'all' );
					if ( isset( $options['connected_workouts'] ) && '' !== $options['connected_workouts'] && ! empty( $options['connected_workouts'] ) ) {
						$connected_workouts = $options['connected_workouts'];
						if ( ! array( $connected_workouts ) ) {
							$connected_workouts = array( $connected_workouts );
						}
					}
				}
				$args     = array(
					'orderby'   => 'date',
					'order'     => 'DESC',
					'post_type' => 'workout',
					'post__in'  => $connected_workouts,
				);
				$workouts = new WP_Query( $args );

				if ( $workouts->have_posts() ) {
					while ( $workouts->have_posts() ) {
						$workouts->the_post();
						$i               = 1;
						$section_counter = 6;
						while ( $i <= $section_counter ) {

							$workout_section = 'workout_section_' . ( $i ) . '_title';
							$workout_desc    = 'workout_section_' . ( $i ) . '_description';

							$section_title = get_post_meta( get_the_ID(), $workout_section, true );
							$description   = get_post_meta( get_the_ID(), $workout_desc, true );

							if ( '' === $section_title ) {
								$i++;
								continue;
							}
							?>
							<div class="set-box set content-box">
								<h3 class="set-title"><?php echo esc_html( $section_title ); ?></h3>
								<div class="set-content">
									<p><?php echo wp_kses_post( apply_filters( 'the_content', $description ) ); ?></p>
								</div>
								<?php lsx_health_plan_workout_tab_content( $i ); ?>
							</div>
							<?php
							$i++;
						}
					}
					?>
				<?php } ?>
				<?php wp_reset_postdata(); ?>
			</div>
			<!-- Post Workout-->
			<?php lsx_workout_snacks( 'post' ); ?>
		</div>

	</div><!-- .entry-content -->

	<footer class="footer-meta clearfix">
		<?php if ( has_tag() || class_exists( 'LSX_Sharing' ) || ( function_exists( 'sharing_display' ) || class_exists( 'Jetpack_Likes' ) ) ) : ?>
			<div class="post-tags-wrapper">
				<?php lsx_content_post_tags(); ?>

				<?php
				if ( class_exists( 'LSX_Sharing' ) ) {
					lsx_content_sharing();
				} else {
					if ( function_exists( 'sharing_display' ) ) {
						sharing_display( '', true );
					}

					if ( class_exists( 'Jetpack_Likes' ) ) {
						$custom_likes = new Jetpack_Likes();
						echo wp_kses_post( $custom_likes->post_likes( '' ) );
					}
				}
				?>
		<?php endif ?>
	</footer><!-- .footer-meta -->

	<?php lsx_entry_bottom(); ?>

</article><!-- #post-## -->

<?php
lsx_entry_after();

