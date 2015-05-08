jQuery(document).ready(function($) {
    $('.mcf-color-picker1').hide();
	$('.mcf-color-picker2').hide();
    $('.mcf-color-picker1').farbtastic('#mcf_section_bg_color');
	$('.mcf-color-picker2').farbtastic('#mcf_section_icon_color');

    $('#mcf_section_bg_color').click(function() {
		if(!$('.mcf-color-field1').val()){
			$('.mcf-color-field1').val('#FFFFFF');
		}
        $('.mcf-color-picker1').fadeIn();
    });
	$('#mcf_section_icon_color').click(function() {
		if(!$('.mcf-color-field2').val()){
			$('.mcf-color-field2').val('#FFFFFF')
		}
        $('.mcf-color-picker2').fadeIn();
    });

    $(document).mousedown(function() {
        $('#mcf-colorpicker1').each(function() {
            var display = $(this).css('display');
            if ( display == 'block' )
                $(this).fadeOut();
        });
    });
	
	$(document).mousedown(function() {
        $('#mcf-colorpicker2').each(function() {
            var display = $(this).css('display');
            if ( display == 'block' )
                $(this).fadeOut();
        });
    });
});