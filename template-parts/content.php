<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package savour
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'item' ); ?>>
	<a href="<?php echo esc_url( get_permalink() ); ?>">
		<?php the_post_thumbnail(); ?>
	</a>
	<header class="entry-header">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php svr_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_excerpt(); ?>
		<div class="border"></div>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
