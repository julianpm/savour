<?php
/**
 * TEMPLATE NAME: About
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

				// VALUES
				svr_values();

				// OUR TEAM
				svr_team();

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
