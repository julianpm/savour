<?php
/**
 * TEMPLATE NAME: Contact
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

				// HOURS OF OPERATION CTA
				svr_hours_cta();

				// CONTACT FORM
				svr_contact();

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
