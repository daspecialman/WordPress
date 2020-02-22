/* global jQuery:false */
/* global BUZZSTONE_STORAGE:false */

jQuery( document ).ready(
	function() {
		"use strict";
		setTimeout( function() {
			jQuery('.editor-block-list__layout').addClass('scheme_' + BUZZSTONE_STORAGE['color_scheme']);
		}, 100 );
	}
);

