<?php
/**
 * TEMPLATE NAME: Menus
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package savour
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				// PAGE HEADER
				svr_page_header();

				// FOOD COURSES
				svr_courses();

				// MENUS CTA
				svr_menus_cta();

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
