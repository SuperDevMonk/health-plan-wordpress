<?php
/**
 * The template for displaying Recipes Archive.
 *
 * @package lsx-health-plan
 */

get_header(); ?>

<?php lsx_content_wrap_before(); ?>

<div id="primary" class="content-area <?php echo esc_attr( lsx_main_class() ); ?>">

	<?php lsx_content_before(); ?>

	<main id="main" role="main">

		<?php lsx_content_top(); ?>

		<div class="post-wrapper archive-plan">
			<div class="row">
				<?php if ( have_posts() ) : ?>
					<?php
					while ( have_posts() ) :
						the_post();
						?>
						<div class="col-md-4">
							<div class="content-box box-shadow white-bg">
								<h3 class="recipe-title title-lined"><?php the_title(); ?></h3>
								<?php table_recipe_data(); ?>
								<a href="<?php echo esc_url( get_permalink() ); ?>" class="btn btn-full">View Recipe</a>
							</div>
						</div>
					<?php endwhile; ?>

					<?php else : ?>

					<?php get_template_part( 'partials/content', 'none' ); ?>

				<?php endif; ?>
			</div>
			<?php lsx_paging_nav(); ?>
		</div>
		<?php lsx_content_bottom(); ?>

	</main><!-- #main -->

	<?php lsx_content_after(); ?>

</div><!-- #primary -->

<?php lsx_content_wrap_after(); ?>

<?php get_sidebar(); ?>

<?php
get_footer();
