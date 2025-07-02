<?php

/**
 * Converts a string into URL share friendly format
 *
 * @param  string $string String to format
 * @return string         URL sharable string
 */
function format_url_safe_text($string) {
    return htmlspecialchars(urlencode(html_entity_decode($string, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');
}

/**
 * Truncates a string to the nearest word under a given maximum length
 *
 * @param string $string The string which will be truncated
 * @param int $length The length to which to truncate the string
 * @param string $append A string that will be appended to the end of a truncated string
 */
function truncate( $text, $length, $append = '&hellip;' ) {
	if ( strlen($text) <= $length ) {
		return $text;
	}
	
	$last_space = strrpos(substr($text, 0, $length), ' ');
	
	if (!$last_space) {
		$last_space = $length;
	}

	$truncated_text = substr($text, 0, $last_space) . $append;
	
	return $truncated_text;
	
}

function breadcrumbs_from_url() {
	$permalink = get_permalink();
	$parsed_url = str_replace( home_url(), "", $permalink );
	$bc_array = array_values(array_filter(explode('/', $parsed_url)));
	$bc_count = count($bc_array);

	echo '<ul class="hero_breadcrumbs">';

	for( $i = 0; $i < $bc_count; $i++ ) {
		$prev = $bc_array[$i-1];
		$curr = $bc_array[$i];
		$s = ($i != 0) ? '/' : '';

		if($i == ($bc_count - 1)) {
			echo  '<li><a href="'. $parsed_url .'">'. str_replace('-', ' ', $curr) .'</a></li>';
		} else {
			echo  '<li><a href="'. $s . $prev . '/' . $curr .'/">'. str_replace('-', ' ', $curr) .'</a></li>';
		}
	}
	echo '</ul>';
}
