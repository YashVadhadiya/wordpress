jQuery(document).ready(function(){
    var wpc_weather_id = jQuery('.wpc-weather-id'),
        count = '1';
    wpc_weather_id.each(function(){
        var ids = jQuery( '[id="'+this.id+'"]' );
        if( ids.length > 1 && ids[0] == this ){
            wpc_weather_id.length = count;
        }
    });
    for(var i = 0; i < wpc_weather_id.length; i++) {
            jQuery.ajax({
                url : wpcAjax.wpc_url,
                method : 'POST',
                data : {
                    action: 'wpc_get_my_weather',
                    wpc_param : wpc_weather_id[i].attributes['data-id'].value,
                    wpc_param2 : wpc_weather_id[i].attributes['data-map'].value,
                    wpc_param3 : wpc_weather_id[i].attributes['data-detect-geolocation'].value,
                    wpc_param4 : wpc_weather_id[i].attributes['data-manual-geolocation'].value,
                    wpc_param5 : wpc_weather_id[i].attributes['data-wpc-lat'].value,
                    wpc_param6 : wpc_weather_id[i].attributes['data-wpc-lon'].value,
                    wpc_param7 : wpc_weather_id[i].attributes['data-wpc-city-id'].value,
                    wpc_param8 : wpc_weather_id[i].attributes['data-wpc-city-name'].value,
                    wpc_param9 : wpc_weather_id[i].attributes['data-custom-font'].value,
                    wpc_param10 : wpc_weather_id[i].attributes['data-post-id'].value,
                    _ajax_nonce: wpcAjax.wpc_nonce,
                },
                success : function( data ) { 

                    if ( data.success ) {
                        wpc_weather_id.each(function(){
                            jQuery(this).append( data.data.html );
                        });
                    } else {
                        console.log( data.data );
                    }
                },
                beforeSend: function(){
                   jQuery(".wpc-loading-spinner").show();
                   jQuery("#wpc-weather").hide();
                },
                complete: function(){
                   jQuery(".wpc-loading-spinner").hide();
                   jQuery("#wpc-weather").show();
                },
            });

    }

});