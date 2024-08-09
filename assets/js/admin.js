jQuery(document).ready(function($) {
    var mediaUploader;

    $('#token_image_button').click(function(e) {
        e.preventDefault();
        if (mediaUploader) {
            mediaUploader.open();
            return;
        }
        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            }, multiple: false });

        mediaUploader.on('select', function() {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#token_image').val(attachment.id);
            $('#token_image_preview').html('<img src="' + attachment.url + '" style="max-width: 100%;" />');
        });

        mediaUploader.open();
    });

    $('.nav-tab').click(function(e) {
        e.preventDefault();
        $('.nav-tab').removeClass('nav-tab-active');
        $(this).addClass('nav-tab-active');

        $('.tab-content').hide();
        var selected_tab = $(this).attr('href');
        $(selected_tab).show();
    });
    
});
