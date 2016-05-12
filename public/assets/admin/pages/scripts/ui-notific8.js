var UINotific8 = function () {

    return {
        //main function to initiate the module
        init: function () {
            
                    $('#notific8_show').click(function(event) {
                        var settings = {
                                theme: 'lime',
                                sticky: false,
                                horizontalEdge: 'right',
                                verticalEdge: 'top'
                            },
                            $button = $(this);
                        
                        if ($.trim($('#notific8_heading').val()) != '') {
                            settings.heading = $.trim($('#notific8_heading').val());
                        }
                        
                        if (!settings.sticky) {
                            settings.life = $('#notific8_life').val();
                        }

                        $.notific8('zindex', 11500);
                        $.notific8($.trim($('#notific8_text').val()), settings);
                        
                        $button.attr('disabled', 'disabled');
                        
                        setTimeout(function() {
                            $button.removeAttr('disabled');
                        }, 1000);

                    });

        }

    };

}();