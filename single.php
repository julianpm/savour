<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package savour
 */

get_header(); ?>

	<section id="primary" class="content-area beige section-padding">
		<main id="main" class="site-main" role="main">
			<div class="row">
				<div class="columns small-12">
					
					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', 'single' );

						#the_post_navigation();

					endwhile; // End of the loop.
					?>
					
				</div>
			</div>
		</main><!-- #main -->
	</section><!-- #primary -->

<?php

get_footer();
