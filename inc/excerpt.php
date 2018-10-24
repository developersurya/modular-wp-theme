<?php

function excerpt($length) {

    global $post;

    $text = get_the_excerpt();

    // Dont cut if too short
    if ( strlen( $text ) < $length + 10 ) return $text;

    // Find next space
    $break_pos = strpos( $text, ' ', $length );

    // Cut String
    $visible = substr($text, 0, $break_pos);

    // Return String
    return balanceTags( $visible ) . '...';

}

//to append search results or any dynamic content. takes 2 arguments - the string you're appending, and length you want to append (default is 8)
function lds_travel_subString($string,$length=8,$append="&hellip;") {
  $string = trim($string);

  if(strlen($string) > $length) {
    $string = trim(substr($string, 0, $length)).'&hellip;';
  }

  return $string;
}


### Give this a string and a integer limit and it will return a string that is limited to that many words. If the string was indeed shortened it will add ... to the end.
function limit_words($str, $limit, $ellipsis = true){
	$excerpt = explode(' ', $str, $limit);
    if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = trim(implode(" ",$excerpt), ",;(&:'\"");
		$excerpt .= ($ellipsis) ? '<em>&hellip;</em>' : '';
    } else {
    	$excerpt = implode(" ",$excerpt);
    }
    return $excerpt;
}
