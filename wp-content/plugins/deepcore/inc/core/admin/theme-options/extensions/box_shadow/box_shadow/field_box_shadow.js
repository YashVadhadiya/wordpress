/*
 Field Box Shadow
 */

(function( $ ) {
    'use strict';

    redux.field_objects = redux.field_objects || {};
    redux.field_objects.box_shadow = redux.field_objects.box_shadow || {};

    function hexToRgba(hex, opacity){
            if( typeof opacity == 'defined' && opacity  ){
                if(opacity>1){
                    opacity = '1';
                }
                else if(opacity<1){
                    opacity = '0';
                }
            }
            else if( typeof opacity == 'undefined' || typeof opacity == null || opacity == '' ){
                opacity = '1';
            }

            var c;
            if(/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)){
                c= hex.substring(1).split('');
                if(c.length== 3){
                    c= [c[0], c[0], c[1], c[1], c[2], c[2]];
                }
                c= '0x'+c.join('');
                return 'rgba('+[(c>>16)&255, (c>>8)&255, c&255].join(',')+','+opacity+')';
            }
            throw new Error('Bad Hex');
    }

    function update_box_shadow_preview(){
            var offestX = $('.redux-container-box_shadow .shadow-offsetx-value').val();
            var offestY = $('.redux-container-box_shadow .shadow-offsety-value').val();
            var blur = $('.redux-container-box_shadow .shadow-blur-value').val();
            var spread = $('.redux-container-box_shadow .shadow-spread-value').val();
            var rgba = $('.redux-container-box_shadow .shadow-rgba-value').val();
            var type = $('.redux-container-box_shadow .redux-shadow-type').find(":selected").text();

            if( type === 'Outside' ){
                type = '';
            }
            else if( type === 'Inset' ){
                type = 'inset';
            }
            
            var boxShadow  = type + ' ' + offestX + ' ' + offestY + ' ' + blur + ' ' + spread + ' ' + rgba;
            

            $('.redux-container-box_shadow .shadow-previewer-inner').css({ 
                '-webkit-box-shadow' : boxShadow,
                '-moz-box-shadow' : boxShadow,
                '-o-box-shadow' : boxShadow,
                '-ms-box-shadow' : boxShadow,
                'box-shadow' : boxShadow,
            });
        }

    redux.field_objects.box_shadow.init = function( selector ) {

        if ( !selector ) {
            selector = $( document ).find( '.redux-container-box_shadow:visible' );
        }

        $( selector ).each(
            function() {
                var el = $( this );
                var parent = el;

                if ( !el.hasClass( 'redux-field-container' ) ) {
                    parent = el.parents( '.redux-field-container:first' );
                }
                if ( parent.is( ":hidden" ) ) { // Skip hidden fields
                    return;
                }
                if ( parent.hasClass( 'redux-field-init' ) ) {
                    parent.removeClass( 'redux-field-init' );
                } else {
                    return;
                }

                //Initiate Colorpicker
                el.find( '.redux-color-init' ).wpColorPicker(
                    {
                        change: function( e, ui ) {
                            $( this ).val( ui.color.toString() );
                            redux_change( $( this ) );
                            el.find( '#' + e.target.getAttribute( 'data-id' ) + '-transparency' ).removeAttr( 'checked' );
                            
                            el.find( '.shadow-color .shadow-color-value' ).val( ui.color.toString() ).trigger('change');;

                        },
                        clear: function( e, ui ) {
                            $( this ).val( ui.color.toString() );
                            redux_change( $( this ).parent().find( '.redux-color-init' ) );
                        }
                    }
                );



                // Replace and validate field on change
                el.find( '.redux-color' ).on(
                    'keyup', function() {
                        var value = $( this ).val();
                        var color = colorValidate( this );
                        var id = '#' + $( this ).attr( 'id' );

                        if ( value === "transparent" ) {
                            $( this ).parent().parent().find( '.wp-color-result' ).css(
                                'background-color', 'transparent'
                            );

                            el.find( id + '-transparency' ).attr( 'checked', 'checked' );
                        } else {
                            el.find( id + '-transparency' ).removeAttr( 'checked' );

                            if ( color && color !== $( this ).val() ) {
                                $( this ).val( color );
                            }
                        }
                    }
                );




                // Replace and validate field on blur
                el.find( '.redux-color' ).on(
                    'blur', function() {
                        var value = $( this ).val();
                        var id = '#' + $( this ).attr( 'id' );

                        if ( value === "transparent" ) {
                            $( this ).parent().parent().find( '.wp-color-result' ).css(
                                'background-color', 'transparent'
                            );

                            el.find( id + '-transparency' ).attr( 'checked', 'checked' );
                        } else {
                            if ( colorValidate( this ) === value ) {
                                if ( value.indexOf( "#" ) !== 0 ) {
                                    $( this ).val( $( this ).data( 'oldcolor' ) );
                                }
                            }

                            el.find( id + '-transparency' ).removeAttr( 'checked' );
                        }
                    }
                );




                // Store the old valid color on keydown
                el.find( '.redux-color' ).on(
                    'keydown', function() {
                        $( this ).data( 'oldkeypress', $( this ).val() );
                    }
                );



                //allow only numeric values on shadow input fields
                el.find( ".redux-shadow-input" ).numeric(
                    {
                        allowMinus: true,
                    }
                );

                

                //disable negative value on shadow blur field
                el.find( ".redux-shadow-blur" ).numeric(
                    {
                        allowMinus: false,
                    }
                );



                //Apply select2 on Shadow type and 
                var select2_handle = el.find( '.select2_params' );
                if ( select2_handle.size() > 0 ) {
                    var select2_params = select2_handle.val();

                    select2_params = JSON.parse( select2_params );
                    default_params = $.extend( {}, default_params, select2_params );
                }
                el.find( ".redux-shadow-type, .redux-shadow-units" ).select2( );

                el.find( '.redux-shadow-type' ).bind(
                    'change paste keyup', function() {
                        update_box_shadow_preview();
                    }
                );



                //Update shadow input value fields on value change
                el.find( '.redux-shadow-input' ).bind(
                    'change paste keyup', function() {
                        var units = $( this ).parents( '.redux-field:first' ).find( '.field-units' ).val();
                        if ( $( this ).parents( '.redux-field:first' ).find( '.redux-shadow-units' ).length !== 0 ) {
                            units = $( this ).parents( '.redux-field:first' ).find( '.redux-shadow-units option:selected' ).val();
                        }
                        var value = $( this ).val();
                        if ( typeof units !== 'undefined' && value ) {
                            value += units;
                        }

                        $( '#' + $( this ).attr( 'rel' ) ).val( value );

                        update_box_shadow_preview();
                    }
                );

                

                //Update Shadow input values units on unit change
                el.find( '.redux-shadow-units' ).bind(
                    'change paste keyup', function() {
                        $( this ).parents( '.redux-field:first' ).find( '.redux-shadow-input:not(.redux-shadow-opacity)' ).change();
                    }
                );


                //Update RGBA field on opacity change
                el.find( '.redux-shadow-opacity' ).bind(
                    'change paste keyup', function() {

                        var currentColor = el.find('.shadow-color .shadow-color-value').val();
                        var currentOpacity = el.find('.redux-shadow-opacity').val();
                        var currentRGBA = hexToRgba( currentColor, currentOpacity );
                        el.find('.redux-rgba-value').val(currentRGBA);

                        update_box_shadow_preview();

                    }
                );

                //Update RGBA field on color change
                el.find( '.shadow-color .shadow-color-value' ).bind(
                    'change', function() {
                        
                        var currentColor = el.find('.shadow-color .shadow-color-value').val();
                        var currentOpacity = el.find('.redux-shadow-opacity').val();
                        var currentRGBA = hexToRgba( currentColor, currentOpacity );
                        el.find('.redux-rgba-value').val(currentRGBA);

                        update_box_shadow_preview();

                    }
                );




                            



            }
        );
    };


    

    $( document ).ready(function() {
        //Lets build variabels for previewing the box shadow
        var offestX = $('.redux-container-box_shadow .shadow-offsetx-value').val();
        var offestY = $('.redux-container-box_shadow .shadow-offsety-value').val();
        var blur = $('.redux-container-box_shadow .shadow-blur-value').val();
        var spread = $('.redux-container-box_shadow .shadow-spread-value').val();
        var rgba = $('.redux-container-box_shadow .shadow-rgba-value').val();
        var type = $('.redux-container-box_shadow .redux-shadow-type').find(":selected").text();

        if( type === 'Outside' || type == '' ){
            type = '';
        }
        else if( type === 'Inset' ){
            type = 'inset';
        }
        
        var boxShadow  = type + ' ' + offestX + ' ' + offestY + ' ' + blur + ' ' + spread + ' ' + rgba;
        

        $('.redux-container-box_shadow .shadow-previewer-inner').css({ 
            '-webkit-box-shadow' : boxShadow,
            '-moz-box-shadow' : boxShadow,
            '-o-box-shadow' : boxShadow,
            '-ms-box-shadow' : boxShadow,
            'box-shadow' : boxShadow,
        });
        
    });

    








})( jQuery );
