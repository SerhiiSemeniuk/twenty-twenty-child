jQuery(function ($) {
    // Add image
    let file_frame;
    $(document).on('click', '.image-gallery-add-button', function (event) {
        event.preventDefault();
        let button = $(this);
        let gallery = $(this).parent().find('.image-gallery');
        let item_name = gallery.data('metaboxName')
        // If window is open there is no need to reopen it
        if (file_frame) {
            file_frame.open();
            return;
        }
        // Creating files window
        file_frame = wp.media.frames.file_frame = wp.media({
            title: button.data('uploader-title'),
            button: {
                text: button.data('uploader-button-text'),
            },
            library: {
                type: [ 'image' ]
            },
            multiple: true,
        });
        // Images are chosed
        file_frame.on('select', function () {
            let selection = file_frame.state().get('selection');
            selection.map(function (attachment) {
                attachment = attachment.toJSON();
                $(gallery).append('<li id="image-' + attachment.id + '" class="image-gallery-item"><img src="' + attachment.url + '"><div class="image-gallery-actions"><a class="image-gallery-action-move" href="#"><span class="dashicons dashicons-move"></span></a><a class="image-gallery-action-delete" href="#">&#x2715;</a></div><input type="hidden" name="' + item_name + '[]" value="' + attachment.id + '"></li>');
            });
        });
        // Files window opening
        file_frame.open();
    });
    // Deleting image
    $(document).on('click', '.image-gallery-action-delete', function (event) {
        event.preventDefault();
        $(this).closest('.image-gallery-item').remove();
    });
    // Iamges sorting
    $('.image-gallery').sortable({
        update: function (event, ui) {
            $('.image-gallery-item').each(function (index) {
                $(this).find('input[type="hidden"]').val($(this).attr('id').replace('image-', ''));
            });
        },
    });
});