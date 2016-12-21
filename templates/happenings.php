<?php
/**
 * TEMPLATE NAME: Happenings
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

				// UPCOMING EVENTS
				svr_upcoming_events();

				// the query
				$args = array(
					'posts_per_page'	=> 3,
					'order'				=> 'DESC',
				);

				$recent_posts = new WP_Query( $args ); ?>

				<?php if ( $recent_posts->have_posts() ) : ?>

					<!-- pagination here -->
					<section class="happenings-post-query section-padding">
						<p class="card-header"><?php echo esc_html_e( 'Recent Stories', 'svr' ); ?></p>
						<div class="row journal">

							<!-- the loop -->
							<?php while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); ?>

								<div class="columns small-12 large-4">
									
									<?php get_template_part( 'template-parts/content', get_post_format() ); ?>

								</div>

							<?php endwhile; ?>
							<!-- end of the loop -->

						<!-- pagination here -->
						</div>
						<a class="btn btn_dark" href="<?php echo esc_url( home_url( '/journal' ) ); ?>">
							<?php echo esc_html_e( 'See All Posts', 'svr' ); ?>
						</a>
					</section>

					<?php wp_reset_postdata(); ?>

				<?php endif;

				// SUBSCRIBE CTA
				svr_subscribe_cta();

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
