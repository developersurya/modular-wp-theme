jQuery(function($){
    var successCount = 2; //change it according to condition , if default posts are 5 in tpl then here should be 5 + number od post per click
	$('.lds_travel_loadmore').click(function(){
        var tax_term = $(this).data('term');
		var button = $(this),
		    data = {
			'action': 'loadmore',
            'post_type':lds_travel_loadmore_params.post_type,
            'taxonomy':lds_travel_loadmore_params.taxonomy,
            //'taxonomy_terms':lds_travel_loadmore_params.taxonomy_terms,
            'taxonomy_terms':tax_term,
            'posts_per_page':lds_travel_loadmore_params.posts_per_page,
            'increment':successCount,
        };
        
      
		$.ajax({
			url : lds_travel_loadmore_params.ajaxurl, // AJAX handler
			data : data,
			type : 'POST',
			beforeSend : function ( xhr ) {
				button.text('Loading...'); // change the button text, you can also add a preloader image
			},
			success : function( data ){
               //debugger;
                    if(data){
                        button.text( 'LOAD MORE REVIEWS' ); // insert new posts
                        //lds_travel_loadmore_params.current_page++;
                        $('.ajax-load-more').html(data);
                        var total_posts = parseInt($('#total_posts').text());
                        if ( total_posts <= parseInt(successCount)) {
                            button.text('NO MORE REVIEWS'); 
                    } else {
                        //button.remove(); // if no data, remove the button as well
                    }
                    successCount++;
			    }
            }
        });
	});
});

// jQuery(function($){
// 	var canBeLoaded = true, // this param allows to initiate the AJAX call only if necessary
// 	    bottomOffset = 2000; // the distance (in px) from the page bottom when you want to load more posts
 
// 	$(window).scroll(function(){
// 		var data = {
// 			'action': 'lds_travel_loadmore_ajax_handler',
// 			'query': lds_travel_loadmore_params.posts,
// 			'page' : lds_travel_loadmore_params.current_page
// 		};
// 		if( $(document).scrollTop() > ( $(document).height() - bottomOffset ) && canBeLoaded == true ){
// 			$.ajax({
// 				url : lds_travel_loadmore_params.ajaxurl,
// 				data:data,
// 				type:'POST',
// 				beforeSend: function( xhr ){
// 					// you can also add your own preloader here
// 					// you see, the AJAX call is in process, we shouldn't run it again until complete
// 					canBeLoaded = false; 
// 				},
// 				success:function(data){
// 					if( data ) {
// 						$('#main').find('article:last-of-type').after( data ); // where to insert posts
// 						canBeLoaded = true; // the ajax is completed, now we can run it again
// 						lds_travel_loadmore_params.current_page++;
// 					}
// 				}
// 			});
// 		}
// 	});
// });