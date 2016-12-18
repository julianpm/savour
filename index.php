<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package savour
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>

				<header class="page-header-simple section-padding">
					<p class="italic"><?php echo esc_html_e( 'Read our', 'svr' ); ?></p>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
					<div class="border"></div>
				</header>

			<?php
			endif; ?>

			<div class="row">

				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post(); ?>
					
					<div class="columns small-12 large-4">

						<?php get_template_part( 'template-parts/content', get_post_format() ); ?>

					</div>

				<?php
				endwhile;

				#the_posts_navigation(); ?> 

			</div>
		
		<?php
		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
