<?php
/**
 * Template used to display post content on widgets and archive pages.
 *
 * @package lsx-health-plan
 */
?>

<?php lsx_entry_before(); ?>

<div class="col-xs-12 col-sm-6 col-md-4">
	<article class="lsx-slot box-shadow">
		<span class="recipe-type"><?php echo esc_html( lsx_health_plan_recipe_type() ); ?></span>
		<?php lsx_entry_top(); ?>

		<div class="recipe-feature-img">
			<a href="<?php echo esc_url( get_permalink() ); ?>">
			<?php
			$featured_image = get_the_post_thumbnail();
			if ( ! empty( $featured_image ) && '' !== $featured_image ) {
				the_post_thumbnail( 'lsx-thumbnail-square', array(
					'class' => 'aligncenter',
				) );
			} else {
				?>
				<img src="<?php echo esc_attr( plugin_dir_url( __FILE__ ) . '../assets/images/placeholder.jpg' ); ?>">
				<?php
			}
			?>
			</a>
		</div>
		<div class="content-box white-bg">
			<?php lsx_health_plan_recipe_data(); ?>
			<h3 class="recipe-title"><?php the_title(); ?></h3>
			<a href="<?php echo esc_url( get_permalink() ); ?>" class="btn border-btn"><?php esc_html_e( 'View Recipe', 'lsx-health-plan' ); ?></a>
		</div>
		<?php lsx_entry_bottom(); ?>
	</article>
</div>

<?php
lsx_entry_after();
