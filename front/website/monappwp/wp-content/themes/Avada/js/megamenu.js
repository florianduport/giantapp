jQuery(document).ready(function($){
    var fusion_megamenu_media_frame;

    $(document).on('click', '.fusion-megamenu-upload-thumbnail', function(e) {
        e.preventDefault();

        var button = $(this);

        if ( fusion_megamenu_media_frame ) {
            fusion_megamenu_media_frame.open();
            return;
        }

        fusion_megamenu_media_frame = wp.media.frames.fusion_megamenu_media_frame = wp.media({

            className: 'media-frame fusion-megamenu-media-frame',
            frame: 'select',
            multiple: false,
            //title: tgm_nmp_media.title,
            library: {
                type: 'image'
            }
            /*button: {
                text:  tgm_nmp_media.button
            }*/
        });

        fusion_megamenu_media_frame.on('select', function(){
            var media_attachment = fusion_megamenu_media_frame.state().get('selection').first().toJSON();

            $(button).closest('.menu-item-settings').find('.edit-menu-item-megamenu-thumbnail').val(media_attachment.url);

            $(button).closest('.menu-item-settings').find('.fusion-megamenu-thumbnail-image').attr('src', media_attachment.url).show();

            $(button).closest('.menu-item-settings').find('.remove-fusion-megamenu-thumbnail').show();
        });

        fusion_megamenu_media_frame.open();
    });
    
    $(document).on('click', '.remove-fusion-megamenu-thumbnail', function(e) {
        e.preventDefault();

        $(this).hide();

        $(this).closest('label').find('input').val('');
        $(this).closest('label').find('img').attr('src', '').hide()
    });
});