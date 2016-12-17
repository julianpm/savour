<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="row">
    	<div class="columns small-12">
	        <label class="screen-reader-text" for="s"><?php _x( 'Search for:', 'label' ); ?></label>
	        <input type="text" placeholder="Enter Keyword..." value="<?php echo get_search_query(); ?>" name="s" id="s" />
        </div>
    </div>
</form>