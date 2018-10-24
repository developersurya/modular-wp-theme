<?php

function lds_travel_image_size_setup(){

	// Add custom image sizes.
	//add_image_size('quote-author-image', 475, 600, true);
	//add_image_size('featured-media', 600, 300, true);
	//add_image_size('section-background', 1900, 600, true);
	add_image_size('front-grid', 460, 305, true);
	//add_image_size('list-card', 205, 170, true);
	add_image_size('blog-grid', 300, 205, true);
	// add_image_size('article-card', 205, 205, true);
	// add_image_size('related-article', 180, 100, true);
	// add_image_size('grid-box', 270, 310, true);

}
add_action( 'after_setup_theme', 'lds_travel_image_size_setup' );


// Give human-readable names the image sizes.
function lds_travel_custom_size_names( $sizes ) {
	return array_merge( $sizes, array(
		//'header-background' => 'Header Background',
	) );
}
//add_filter( 'image_size_names_choose', 'lds_travel_custom_size_names' );
