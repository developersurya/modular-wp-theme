<?php

	function lds_travel_module($file, $once = false ) {
		if ( $once == true ) {
			require_once get_stylesheet_directory() . '/modules/' . $file;
		} else {
			include get_stylesheet_directory() . '/modules/' . $file;
		}
	}