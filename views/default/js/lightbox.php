<?php
/**
 * Elgg lightbox
 *
 * Usage
 * Call elgg_load_js('lightbox') and elgg_load_css('lightbox') then
 * apply the class elgg-lightbox to links.
 *
 * Advanced Usage
 * Elgg is distributed with the Colorbox jQuery library. Please go to
 * http://www.jacklmoore.com/colorbox for more information on the options of this lightbox.
 *
 * Overriding
 * In a plugin, override this view and override the registration for the
 * lightbox JavaScript and CSS (@see elgg_views_boot()).
 *
 * @todo add support for passing options: $('#myplugin-lightbox').elgg.ui.lightbox(options);
 */

if (0) { ?><script><?php }
?>

elgg.provide('elgg.ui.lightbox');

/**
 * Lightbox initialization
 */
elgg.ui.lightbox.init = function() {
	$.extend($.colorbox.settings, {
		current: elgg.echo('js:lightbox:current', ['{current}', '{total}']),
		previous: elgg.echo('previous'),
		next: elgg.echo('next'),
		close: elgg.echo('close'),
		xhrError: elgg.echo('error:default'),
		imgError: elgg.echo('error:default'),
		opacity: 0.5,
		maxWidth: '100%',

		// workaround for https://github.com/jackmoore/colorbox/issues/291
		reposition: $(window).height() > 600
	});

	if (typeof $.fancybox === 'undefined') {
		$.fancybox = {
			__noSuchMethod__ : function() {
				elgg.register_error("fancybox lightbox has been replaced by colorbox", 9999999999999);
			}
		};
	}

	$('.elgg-lightbox').colorbox();

	// automatically detect hidden div targets for lightbox (fancybox handled this automatically)
	$('.elgg-lightbox[href^="#"]').colorbox({inline: true});

};

elgg.ui.lightbox.close = function() {
	$.colorbox.close();
};

elgg.register_hook_handler('init', 'system', elgg.ui.lightbox.init);

<?php

$js_path = elgg_get_config('path');
$js_path = "{$js_path}vendors/jquery/colorbox/jquery.colorbox-min.js";
readfile($js_path);
