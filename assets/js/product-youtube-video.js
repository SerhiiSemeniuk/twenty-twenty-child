jQuery(function ($) {

    $(document).on('input', '.youtube-video', function(event) {
        const preview = $(this).parent().find('.youtube-video-preview');
        const video = $(preview).find('iframe');
        const videoId = $(this).val();
        if( !videoId ) {
            if(video.length) {
                $(video).remove();
            }
        } else {
            if(video.length) {
                $(video).attr('src', 'https://www.youtube.com/embed/' + $(this).val());
            } else {
                $(preview).append(
                    '<iframe src="https://www.youtube.com/embed/' + $(this).val() + '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>'
                );
            }
        }
    })
});