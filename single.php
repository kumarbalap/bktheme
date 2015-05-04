<?php
/**
 * The template for displaying all single posts.
 *
 * @package bktheme
 */

get_header(); ?>
<div class="row">
		<div class="columns large-8 medium-8 small-12">

				<div id="primary" class="content-area">
					<main id="main" class="site-main" role="main">

					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'template-parts/content', 'single' ); ?>

						<?php the_post_navigation(); ?>

						<?php
							// If comments are open or we have at least one comment, load up the comment template
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
						?>

					<?php endwhile; // end of the loop. ?>

					</main><!-- #main -->
				</div><!-- #primary -->

		</div>
		<div class="columns large-4 medium-4">
				<?php get_sidebar(); ?>
		</div>		
</div>

<div class="row">
		<div class="columns large-12">
				<?php get_footer(); ?>
		</div>
</div>
