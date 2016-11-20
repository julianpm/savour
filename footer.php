<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package savour
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<div class="top-footer">
				<h2><?php echo esc_html_e( 'savor.', 'svr' ); ?></h2>
				<p><?php echo esc_html_e( '209 East Ninth Street', 'svr' ); ?></p>
				<p><?php echo esc_html_e( 'Nashville, TN 38322', 'svr' ); ?></p>
				<p><?php echo esc_html_e( '+1 443 753 3223', 'svr' ); ?></p>
			</div>
			<div class="bottom-footer-wrapper">
				<div class="row">
					<div class="columns small-12">
						<div class="bottom-footer">
							<p><?php echo esc_html_e( 'Copyright 2016 - Savour', 'svr' ); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
