jQuery(document).ready(function($){
	"use strict";
	var workio_upload;
	var workio_selector;

	function workio_add_file(event, selector) {

		var upload = $(".uploaded-file"), frame;
		var $el = $(this);
		workio_selector = selector;

		event.preventDefault();

		// If the media frame already exists, reopen it.
		if ( workio_upload ) {
			workio_upload.open();
			return;
		} else {
			// Create the media frame.
			workio_upload = wp.media.frames.workio_upload =  wp.media({
				// Set the title of the modal.
				title: "Select Image",

				// Customize the submit button.
				button: {
					// Set the text of the button.
					text: "Selected",
					// Tell the button not to close the modal, since we're
					// going to refresh the page when the image is selected.
					close: false
				}
			});

			// When an image is selected, run a callback.
			workio_upload.on( 'select', function() {
				// Grab the selected attachment.
				var attachment = workio_upload.state().get('selection').first();

				workio_upload.close();
				workio_selector.find('.upload_image').val(attachment.attributes.url).change();
				if ( attachment.attributes.type == 'image' ) {
					workio_selector.find('.workio_screenshot').empty().hide().prepend('<img src="' + attachment.attributes.url + '">').slideDown('fast');
				}
			});

		}
		// Finally, open the modal.
		workio_upload.open();
	}

	function workio_remove_file(selector) {
		selector.find('.workio_screenshot').slideUp('fast').next().val('').trigger('change');
	}
	
	$('body').on('click', '.workio_upload_image_action .remove-image', function(event) {
		workio_remove_file( $(this).parent().parent() );
	});

	$('body').on('click', '.workio_upload_image_action .add-image', function(event) {
		workio_add_file(event, $(this).parent().parent());
	});

});