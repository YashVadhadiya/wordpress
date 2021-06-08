jQuery(document).ready(function($) {
    var at_document = $(document);
    at_document.on('click','.custom_media_button', function(e){

        // Prevents the default action from occuring.
        e.preventDefault();
        var media_image_upload = $(this);
        var media_title = $(this).data('title');
        var media_button = $(this).data('button');
        var media_input_val = $(this).prev();
        var media_image_url_value = $(this).prev().prev().children('img');
        var media_image_url = $(this).siblings('.img-preview-wrap');

        var meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
            title: media_title,
            button: { text:  media_button },
            library: { type: 'image' }
        });
        // Opens the media library frame.
        meta_image_frame.open();
        // Runs when an image is selected.
        meta_image_frame.on('select', function(){

            // Grabs the attachment selection and creates a JSON representation of the model.
            var media_attachment = meta_image_frame.state().get('selection').first().toJSON();

            // Sends the attachment URL to our custom image input field.
            media_input_val.val(media_attachment.url);
            if( media_image_url_value !== null ){
                media_image_url_value.attr( 'src', media_attachment.url );
                media_image_url.show();
                LATESTVALUE(media_image_upload.closest("p"));
            }
        });
    });

   // Runs when the image button is clicked.
   jQuery('body').on('click','.media-image-remove', function(e){
    $(this).siblings('.img-preview-wrap').hide();
    $(this).prev().prev().val('');
});

   var LATESTVALUE = function (wrapObject) {
    wrapObject.find('[name]').each(function(){
        $(this).trigger('change');
    });
};

   $(document).on('click', '.ct-show-hide', function () {
       if($(this).prop("checked") == true){
          // console.log("clicked");
           $(this).val(1);
       }else{

          // console.log("unclicked");
           $(this).val(0);
       }
   });
    $('.ct-show-hide').each(function() {
        if($(this).val() == 1){

            //console.log("checked");
            $(this).prop("checked");
        }else{

            //console.log("unchecked");
            $(this).prop('checked',false);
        }
    });
});