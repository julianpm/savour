<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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

			// WELCOME
			svr_welcome();

			// HOURS OF OPERATION CTA
			svr_hours_cta();

			// MENUS
			svr_home_menus_cta();

			// SUBSCRIBE CTA
			svr_subscribe_cta();

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
