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
							<nav class="social-nav">
								<?php
								$facebook = get_field( 'svr_facebook_link', 'options');
								$pinterest = get_field( 'svr_pinterest_link', 'options');
								$twitter = get_field( 'svr_twitter_link', 'options');
								$instagram = get_field( 'svr_instagram_link', 'options'); ?>
								<ul>
									<?php if ( $facebook ){ ?>
										<li>
											<a href="<?php echo esc_url( $facebook ); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
										</li>
									<?php }
									if ( $pinterest ){ ?>
										<li>
											<a href="<?php echo esc_url( $pinterest ); ?>"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>
										</li>
									<?php }
									if ( $twitter ){ ?>
										<li>
											<a href="<?php echo esc_url( $twitter ); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
										</li>
									<?php }
									if ( $instagram ){ ?>
										<li>
											<a href="<?php echo esc_url( $instagram ); ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a>
										</li>
									<?php } ?>
									<li>
										<a href="#">lets.eat@savour.com</a>
									</li>
								</ul>
							</nav>
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
