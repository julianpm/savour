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
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		// esc_html_x( 'Posted on %s', 'post date', 'svr' ),
		'<p>' . $time_string . '</p>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

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
			printf( '<span class="cat-links">' . esc_html__( 'Posted under %1$s', 'svr' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}
	}

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


/**
 * Display navigation to next/previous post when applicable.
 * CUSTOM SINGLE-POST NAVIGATION
 * TO GO IN TEMPLATE TAGS
 */
function svr_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	if ( ! $next && ! $previous ) {
		return;
	}
	?>

	<nav class="navigation post-navigation" role="navigation">
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', 'Previous Post' );
				next_post_link( '<div class="nav-next">%link</div>', 'Next Post' );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->

	<?php
}


// POST NAVIGATION PAGINATION
if ( ! function_exists( 'pso_pagination_links' ) ) :
/**
 * Creates the pagination links
 */
function svr_pagination_links() {
	$args = array(
	   'prev_text' => '<i class="fa fa-chevron-left" aria-hidden="true"></i> prev page',
	   'next_text' => 'next page <i class="fa fa-chevron-right" aria-hidden="true"></i>',
	);
	echo '<nav class="paginate_navigation">'. paginate_links( $args ) . '</nav>';
}
endif;


// PAGE HEADER
function svr_page_header(){
	$header_subtitle = get_field( 'svr_page_header_subtitle' );
	$header_icon = get_field( 'svr_page_header_icon' );

	if ( has_post_thumbnail() ){ ?>

		<header class="page-header" style="background-image: url( <?php echo ( has_post_thumbnail() ? wp_get_attachment_url( get_post_thumbnail_id() ) : '' ); ?> ); ">
			<div class="row">
				<div class="columns small-12">
					<div class="page-header_content">
						<?php if ( $header_subtitle ){ ?>
							<p class="italic"><?php echo esc_html( $header_subtitle ); ?></p>
						<?php }
						the_content();
						if ( is_front_page() ){ ?>
							<a class="btn" href="#"><?php echo esc_html_e( 'Reserve Your Table', 'svr' ); ?></a>
						<?php } ?>
						<?php if ( $header_icon ){ ?>
							<i class="fa fa-<?php echo esc_html( $header_icon ); ?>" aria-hidden="true"></i>
						<?php }	?>
					</div>
				</div>
			</div>
		</header>

	<?php } else{ ?>

		<header class="page-header-simple section-padding">
			<div class="row">
				<div class="columns small-12">
					<?php if ( $header_subtitle ){ ?>
						<p class="italic"><?php echo esc_html( $header_subtitle ); ?></p>
					<?php } ?>
					<h1><?php the_title(); ?></h1>
					<div class="border"></div>
				</div>
			</div>
		</header>

	<?php }
}


// HOURS OF OPERATION CTA
function svr_hours_cta(){
	if ( function_exists( 'get_field' ) ){
		$hours = get_field( 'svr_hours', 'options' );

		if ( $hours ){ ?>

			<section class="section-padding">
				<div class="row">
					<p class="card-header"><?php echo esc_html_e( 'Hours of Operation', 'svr' ); ?></p>

					<?php foreach ( $hours as $hour ){
						$hours_days = $hour['svr_hours_days']; 
						$hours_times = $hour['svr_hours_times']; ?>

						<div class="columns small-12 large-4">
							<div class="card item">
								<?php if ( $hours_days ){ ?>
									<p class="card-inner-header"><?php echo esc_html( $hours_days ); ?></p>
								<?php }
								if ( $hours_times ){ ?>
									<p><?php echo esc_html( $hours_times ); ?></p>
								<?php } ?>
							</div>
						</div>

					<?php } ?>
					<?php if ( is_page_template( 'templates/contact.php' ) ){
						$contact_visit = get_field( 'svr_contact_visit' );
						$contact_address = get_field( 'svr_contact_address' );
						$contact_email = get_field( 'svr_contact_email' );
						$contact_info = get_field( 'svr_contact_info' ); ?>
						
						<div class="columns small-12 large-6">
							<div class="card item">
								<i class="fa fa-home" aria-hidden="true"></i>
								<?php if ( $contact_visit ){ ?>
									<p class="card-inner-header"><?php echo esc_html( $contact_visit ); ?></p>
								<?php } ?>
								<?php if ( $contact_address ){ ?>
									<?php echo wp_kses_post( $contact_address ); ?>
								<?php } ?>
								<div class="border"></div>
							</div>
						</div>
						<div class="columns small-12 large-6">
							<div class="card item">
								<i class="fa fa-phone" aria-hidden="true"></i>
								<?php if ( $contact_email ){ ?>
									<p class="card-inner-header"><?php echo esc_html( $contact_email ); ?></p>
								<?php } ?>
								<?php if ( $contact_info ){ ?>
									<?php echo wp_kses_post( $contact_info ); ?>
								<?php } ?>
								<div class="border"></div>
							</div>
						</div>

					<?php } ?>

				</div>
			</section>

		<?php }
	}
}


// SUBSCRIBE CTA
function svr_subscribe_cta(){
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
							<a class="btn btn_grey" href="<?php echo esc_url( home_url( '/contact' ) ); ?>">
								<?php echo esc_html_e( 'Subscribe', 'svr' ); ?>
							</a>
						</div>
					</div>
				</div>	
			
			</section>

		<?php }
	}
}


// JOIN US CTA
function svr_join_us_cta(){
	if ( function_exists( 'get_field' ) ){
		$join_us_header = get_field( 'svr_join_us_cta_header', 'options' );
		$join_us_link = get_field( 'svr_join_us_cta_link', 'options' );

		if ( $join_us_link ){ ?>

			<section class="cta cta-flex section-padding darkgrey">
				<div class="row">
					<div class="columns small-12">
						<?php if ( $join_us_header ){ ?>
							<h3><?php echo esc_html( $join_us_header ); ?></h3>	
						<?php } ?>
						<div class="cta-link">
							<a class="btn btn_grey" href="<?php echo esc_html( $join_us_link ); ?>">
								<?php echo esc_html_e( 'Make A Reservation', 'svr' ); ?>
							</a>
						</div>
					</div>
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

					<?php if ( $welcome_header ){ ?>

						<div class="columns small-12">
							<h2><?php echo esc_html( $welcome_header ); ?></h2>
						</div>

					<?php } ?>

					<?php foreach ( $welcome as $welcome_item ){
						$welcome_info = $welcome_item['svr_front_page_welcome_repeater_info']; ?>
						
						<div class="columns small-12 large-4">
							<p><?php echo esc_html( $welcome_info ); ?></p>
						</div>

					<?php } ?>
					<div class="columns small-12 welcome_link">
						<a class="btn btn_dark" href="<?php echo esc_url( home_url( '/about' ) ); ?>"><?php echo esc_html_e( 'Read Our Mission', 'svr' ); ?></a>
					</div>
				</div>
			</section>

		<?php }
	}
}


// FRONT PAGE MENUS
function svr_home_menus_cta(){
	if ( function_exists( 'get_field' ) ){
		$home_menus = get_field( 'svr_front_page_menus' );

		if ( $home_menus ){ ?>

			<section class="beige section-padding" id="our-menus">
				<div class="row">
					<p class="card-header"><?php echo esc_html_e( 'Our Menus', 'svr' ); ?></p>

					<?php foreach ( $home_menus as $home_menu ){
						$home_menu_image = $home_menu['svr_front_page_menus_image'];
						$home_menu_title = $home_menu['svr_front_page_menus_title'];
						$home_menu_link = $home_menu['svr_front_page_menus_link'];

						if ( $home_menu_image ){ ?>

							<div class="columns small-12 medium-6 large-6">
								<div class="box item">
									<img src="<?php echo esc_url( $home_menu_image['url'] ); ?>" alt="<?php echo $home_menu_image['alt']; ?>">
									<div class="box-inner">
										<?php if ( $home_menu_title ){ ?>
											<h3><?php echo esc_html( $home_menu_title ); ?></h3>	
										<?php }
										if ( $home_menu_link ){ ?>
											<a class="btn" href="<?php echo esc_url( home_url( $home_menu_link ) ); ?>"><?php echo esc_html_e( 'See Menu', 'svr' ); ?></a>
										<?php } ?>
									</div>
								</div>
							</div>

						<?php }

					} ?>

				</div>
			</section>

		<?php }
	}
}


// CONTACT PAGE FORM
function svr_contact(){
	if ( function_exists( 'get_field' ) ){
		$contact_form_header = get_field( 'svr_contact_form_header' );

		if ( $contact_form_header ){ ?>

			<section class="beige section-padding form">
				<div class="row">
					<div class="columns small-12">
						<p class="form-header"><?php echo esc_html( $contact_form_header ); ?></p>
						<?php echo do_shortcode( '[contact-form-7 id="113" title="Contact Form"]' ); ?>
					</div>
				</div>
			</section>

		<?php }

	}
}


// ABOUT PAGE VALUES
function svr_values(){
	if ( function_exists( 'get_field' ) ){
		$values = get_field( 'svr_values' );

		if ( $values ){ ?>

			<section class="section-padding">
				<p class="card-header"><?php echo esc_html_e( 'Our Core Values', 'svr' ); ?></p>
				<div class="row">
					
					<?php foreach ( $values as $value ){
						$value_icon = $value['svr_values_icon'];
						$value_header = $value['svr_values_header'];
						$value_text = $value['svr_values_text']; ?>

						<div class="columns small-12 large-6">
							<div class="card item">
								<?php if ( $value_icon ){ ?>
									<i class="fa fa-<?php echo esc_html( $value_icon ); ?>" aria-hidden="true"></i>
								<?php }
								if ( $value_header ){ ?>
									<p class="card-inner-header"><?php echo esc_html( $value_header ); ?></p>
								<?php }
								if ( $value_text ){
									echo wp_kses_post( $value_text );	
								} ?>
								<div class="border"></div>
							</div>
						</div>

					<?php } ?>

				</div>
			</section>

		<?php }
	}
}


// ABOUT PAGE GALLERY
function svr_gallery(){
	if ( function_exists( 'get_field' ) ){
		$images = get_field( 'svr_gallery' );

		if( $images ){ ?>

		    <section class="gallery">

		        <?php foreach( $images as $image ){ ?>

	                <a href="<?php echo $image['url']; ?>" data-lightbox="gallery-item">
	                     <img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" />
						<i class="fa fa-search-plus" aria-hidden="true"></i>
						<span class="overlay"></span>
	                </a>

		        <?php } ?>

		    </section>

		<?php }
	}
}


// ABOUT PAGE TEAM
function svr_team(){
	if ( function_exists( 'get_field' ) ){
		$team = get_field( 'svr_team' );

		if ( $team ){ ?>

			<section class="beige section-padding">
				<p class="card-header"><?php echo esc_html_e( 'Meet Our Team', 'svr' ); ?></p>
				<div class="row">
					
					<?php foreach ( $team as $team_member ){
						$team_image = $team_member['svr_team_image'];
						$team_name = $team_member['svr_team_name'];
						$team_title = $team_member['svr_team_title'];
						$team_info = $team_member['svr_team_info']; ?>

						<div class="columns small-12 medium-6 large-3">
							<div class="item">
								<?php if ( $team_image ){ ?>
									<img src="<?php echo esc_url( $team_image['url'] ); ?>" alt="<?php echo $team_image['alt']; ?>">
								<?php }
								if ( $team_name && $team_title ){ ?>
									<div class="team-header">
										<p><?php echo esc_html( $team_name ); ?></p>
										<p><?php echo esc_html( $team_title ); ?></p>
									</div>
								<?php } ?>

								<?php $team_social = $team_member['svr_team_social'];

								if ( $team_info || $team_social ){ ?>
									
									<div class="team-info">
										
										<?php foreach ( $team_social as $team_social_item ){
											$team_social_item_icon = $team_social_item['svr_team_social_icon'];
											$team_social_item_link = $team_social_item['svr_team_social_link'];

											if ( $team_social_item_link ){ ?>
												<a href="<?php echo esc_url( $team_social_item_link ); ?>">
													<i class="fa fa-<?php echo esc_html( $team_social_item_icon ); ?>" aria-hidden="true"></i>
												</a>
											<?php }

										}
										echo wp_kses_post( $team_info ); ?>
										<div class="border"></div>

									</div>
									
								<?php } ?>



							</div>
						</div>

					<?php } ?>

				</div>
			</section>

		<?php }
	}
}


// MENU PAGE MENUS
function svr_menus_cta(){
	if ( function_exists( 'get_field' ) ){
		$menus = get_field( 'svr_menu' );

		if ( $menus ){ ?>

			<section class="beige menus">
				
				<?php foreach( $menus as $menu ){
					$menu_image = $menu['svr_menu_image'];
					$menu_title = $menu['svr_menu_title'];
					$menu_link = $menu['svr_menu_link'];

					if ( $menu_image ){ ?>

						<div class="box">
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
				
				<?php } ?>

			</section>

		<?php }

	}
}


// MENU PAGE MEALS AND COURSES
function svr_courses(){
	if ( function_exists( 'get_field' ) ){
		$courses = get_field( 'svr_courses' );

		if ( $courses ){ ?>

			<section class="beige section-padding">
				
				<?php foreach ( $courses as $course ){
					$course_title = $course['svr_course_title']; ?>
					
					<div class="card-wrapper">
						<div class="row">
							<div class="columns small-12">
								<?php if ( $course_title ){ ?>
									<p class="card-header"><?php echo esc_html( $course_title ); ?></p>
								<?php } ?>
							</div>

							<?php
							$meals = $course['svr_course_meal'];

							foreach ( $meals as $meal ){
								$meal_name = $meal['svr_meal_name'];
								$meal_ing = $meal['svr_meal_ingredients'];
								$meal_price = $meal['svr_meal_price']; ?>

								<div class="columns small-12">
									<div class="card">
										<div class="row">
											<div class="columns small-12 large-10">
												<?php if ( $meal_name ){ ?>
													<h3><?php echo esc_html( $meal_name ); ?></h3>
												<?php }
												if ( $meal_ing ){ ?>
													<p><?php echo esc_html( $meal_ing ); ?></p>
												<?php } ?>
											</div>
											<div class="columns small-12 large-2">
												<?php if ( $meal_price ){ ?>
													<h3><?php echo esc_html( $meal_price ); ?></h3>
												<?php } ?>
											</div>
										</div>
									</div>
								</div>	
								
							<?php } ?>
						
						</div>
					</div>

				<?php } ?>

			</section>

		<?php }
	}
}


// MENU PAGE COME SIT CTA
function svr_come_sit_cta(){
	if ( function_exists( 'get_field' ) ){
		$come_sit_header = get_field( 'svr_come_sit_cta_header', 'options');
		$come_sit_text = get_field( 'svr_come_sit_cta_text', 'options');
		$come_sit_link = get_field( 'svr_come_sit_cta_link', 'options');

		if ( $come_sit_link ){ ?>
		
			<section class="darkgrey section-padding cta">
				<div class="row">
					<div class="columns small-12">
						<?php if ( $come_sit_header ){ ?>
							<p><?php echo esc_html( $come_sit_header ); ?></p>
						<?php }
						if ( $come_sit_text ){ ?>
							<h3><?php echo esc_html( $come_sit_text ); ?></h3>
						<?php } ?>
						<div class="cta-link">
							<a class="btn btn_grey" href="<?php echo esc_url( home_url( '/contact' ) ); ?>">
								<?php echo esc_html_e( 'Make A Reservation', 'svr' ); ?>
							</a>
						</div>
					</div>
				</div>	
			
			</section>

		<?php }
	}
}


// HAPPENINGS PAGE UPCOMING EVENTS
function svr_upcoming_events(){
	if ( function_exists( 'get_field' ) ){
		$upcoming_events = get_field( 'svr_upcoming_events' );

		if ( $upcoming_events ){ ?>

			<section class="beige section-padding upcoming-events">
				<div class="row">
					<p class="card-header"><?php echo esc_html_e( 'Upcoming Events', 'svr' ); ?></p>
					
					<?php foreach ( $upcoming_events as $upcoming_event ){
						$upcoming_event_date = $upcoming_event['svr_upcoming_events_date'];
						$upcoming_event_title = $upcoming_event['svr_upcoming_events_title']; ?>

						<div class="columns small-12 large-6">
							<div class="row">
								<?php if ( $upcoming_event_date ){ ?>
									<div class="columns small-12 large-3">
										<h3><?php echo esc_html( $upcoming_event_date ); ?></h3>
									</div>
								<?php } ?>
								<?php if ( $upcoming_event_title ){ ?>
									<div class="columns small-12 large-9">
										<h3><?php echo esc_html( $upcoming_event_title ); ?></h3>
									</div>
								<?php } ?>
							</div>
						</div>

					<?php } ?>

				</div>
			</section>

		<?php }
	}
}