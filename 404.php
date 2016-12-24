<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package savour
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header-simple section-padding">
					<h1 class="page-title"><?php esc_html_e( '404', 'svr' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content section-padding">
					<div class="row">
						<div class="columns small-12">
							<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'svr' ); ?></p>
						</div>
					</div>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
