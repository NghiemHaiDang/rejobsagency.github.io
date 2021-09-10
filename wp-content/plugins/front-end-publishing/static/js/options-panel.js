jQuery(document).ready(function ($) {
	postboxes.add_postbox_toggles('fep_metaboxes');
	$('.if-js-closed').removeClass('if-js-closed').addClass('closed');

	$(".form-shortcodes-container input[type='text']").click(function () {
		$(this).select();
	});
});