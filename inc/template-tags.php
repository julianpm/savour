<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package savour
 */

if ( ! function_exists( 'svr_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function svr_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'svr' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'svr' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'svr_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function svr_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'svr' ) );
		if ( $categories_list && svr_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'svr' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'svr' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'svr' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'svr' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'svr' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function svr_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'svr_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'svr_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so svr_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so svr_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in svr_categorized_blog.
 */
function svr_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'svr_categories' );
}
add_action( 'edit_category', 'svr_category_transient_flusher' );
add_action( 'save_post',     'svr_category_transient_flusher' );


// PAGE HEADER
function svr_page_header(){ 

	if ( has_post_thumbnail() ){ ?>

		<header class="page-header" style="background-image: url( <?php echo ( has_post_thumbnail() ? wp_get_attachment_url( get_post_thumbnail_id() ) : '' ); ?> ); ">
			<div class="row">
				<div class="columns small-12 page-header_content">
					<?php the_content(); ?>
				</div>
				<div class="columns small-12 page-header_link">
					<a class="btn" href="#"><?php echo esc_html_e( 'Reserve Your Table', 'svr' ); ?></a>
				</div>
			</div>
		</header>

	<?php } else{ ?>

		<header class="page-header-simple section-padding">
			<div class="row">
				<div class="columns small-12">
					<p class="italic"><?php echo esc_html_e( "What's for", 'svr' ); ?></p>
					<h1><?php the_title(); ?></h1>
					<div class="border"></div>
					<?php if ( is_page( 'dinner' ) ){ ?>
						<p>lkjasdfljkasdlfkjasdf</p>
					<?php } ?>
				</div>
			</div>
		</header>

	<?php }
}


// SUBSCRIBE CTA
function svr_subscribe(){
	if ( function_exists( 'get_field' ) ){
		$subscribe_header = get_field( 'svr_subscribe_cta_header', 'options');
		$subscribe_text = get_field( 'svr_subscribe_cta_text', 'options');
		$subscribe_link = get_field( 'svr_subscribe_cta_link', 'options');

		if ( $subscribe_link ){ ?>
		
			<section class="darkgrey section-padding cta">
				<div class="row">
					<div class="columns small-12">
						<?php if ( $subscribe_header ){ ?>
							<p><?php echo esc_html( $subscribe_header ); ?></p>
						<?php }
						if ( $subscribe_text ){ ?>
							<h3><?php echo esc_html( $subscribe_text ); ?></h3>
						<?php } ?>
						<div class="cta-link">
							<a class="btn btn_grey" href="<?php echo esc_url( $subscribe_link ); ?>"><?php echo esc_html_e( 'Subscribe' ); ?></a>
						</div>
					</div>
				</div>	
			
			</section>

		<?php }
	}
}


// HOURS OF OPERATION CTA
function svr_hours(){
	if ( function_exists( 'get_field' ) ){
		$hours = get_field( 'svr_front_page_hours', 'options' );

		if ( $hours ){ ?>

			<section class="section-padding">
				<div class="row">
					<div class="columns small-12 card-header">
						<p><?php echo esc_html_e( 'Hours of Operation', 'svr' ); ?></p>
					</div>

					<?php foreach ( $hours as $hour ){
						$hours_days = $hour['svr_front_page_hours_days']; 
						$hours_times = $hour['svr_front_page_hours_times']; ?>

						<div class="columns small-12 large-4">
							<div class="card">
								<?php if ( $hours_days ){ ?>
									<p><?php echo esc_html( $hours_days ); ?></p>
								<?php }
								if ( $hours_times ){ ?>
									<p><?php echo esc_html( $hours_times ); ?></p>
								<?php } ?>
							</div>
						</div>

					<?php } ?>
					<?php if ( is_page_template( 'templates/contact.php' ) ){ ?>
						<div class="columns small-12 large-6">
							<i class="fa fa-home" aria-hidden="true"></i>
						</div>

					<?php } ?>

				</div>
			</section>

		<?php }
	}
}


// FRONT PAGE WELCOME
function svr_welcome(){
	if ( function_exists( 'get_field' ) ){
		$welcome = get_field( 'svr_front_page_welcome_repeater' );

		if ( $welcome ){ ?>

			<section class="beige section-padding welcome">
				<?php
				$welcome_header = get_field( 'svr_front_page_welcome_header' ); ?>
				<div class="row">
					<div class="columns small-12">
						<h2><?php echo esc_html( $welcome_header ); ?></h2>
					</div>

					<?php foreach ( $welcome as $welcome_item ){
						$welcome_info = $welcome_item['svr_front_page_welcome_repeater_info']; ?>
						
						<div class="columns small-12 large-4">
							<p><?php echo esc_html( $welcome_info ); ?></p>
						</div>

					<?php } ?>
					<div class="columns small-12 welcome_link">
						<a class="btn btn_dark" href="#"><?php echo esc_html_e( 'Read Our Mission', 'svr' ); ?></a>
					</div>
				</div>
			</section>

		<?php }
	}
}


// FRONT PAGE MENUS
function svr_menus(){
	if ( function_exists( 'get_field' ) ){
		$menus = get_field( 'svr_front_page_menus' );

		if ( $menus ){ ?>

			<section class="row section-padding">

				<?php foreach ( $menus as $menu ){
					$menu_image = $menu['svr_front_page_menus_image'];
					$menu_title = $menu['svr_front_page_menus_title'];
					$menu_link = $menu['svr_front_page_menus_link']; ?>

					<div class="columns small-12 large-6 box">
						<img src="<?php echo esc_url( $menu_image['url'] ); ?>" alt="<?php echo $menu_image['alt']; ?>">
						<div class="box-inner">
							<?php if ( $menu_title ){ ?>
								<h3><?php echo esc_html( $menu_title ); ?></h3>	
							<?php }
							if ( $menu_link ){ ?>
								<a class="btn" href="<?php echo esc_url( home_url( $menu_link ) ); ?>"><?php echo esc_html_e( 'See Menu', 'svr' ); ?></a>
							<?php } ?>
						</div>
					</div>

				<?php } ?>

			</section>

		<?php }
	}
}