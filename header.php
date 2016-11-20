<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package savour
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link href="https://fonts.googleapis.com/css?family=Lora:400,400i|Work+Sans:500,700,900" rel="stylesheet">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	
	<header id="masthead" class="site-header" role="banner">
		<div class="top-nav-wrapper">
			<div class="row">
				<div class="columns small-12 top-nav">
					<ul>
						<li>
							<a href="#">
								<i class="fa fa-facebook" aria-hidden="true"></i>
							</a>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-pinterest-p" aria-hidden="true"></i>
							</a>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-twitter" aria-hidden="true"></i>
							</a>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-instagram" aria-hidden="true"></i>
							</a>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-search" aria-hidden="true"></i>
							</a>
						</li>
						<li>
							+1 443 753 3223
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="columns small-12 bottom-nav">
				<div class="site-branding">
					<h2><?php esc_html_e( 'savor.', 'svr' ); ?></h2>
				</div><!-- .site-branding -->

				<nav id="site-navigation" class="main-navigation" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
				</nav><!-- #site-navigation -->
			</div>
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
