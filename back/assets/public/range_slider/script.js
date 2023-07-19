(function( $ ){
$( document ).ready( function() {
	$( '.input-range').each(function(){
		var value = $(this).attr('data-slider-value');
		var separator = value.indexOf(',');
		if( separator !== -1 ){
			value = value.split(',');
			value.forEach(function(item, i, arr) {
				arr[ i ] = parseFloat( item );
			});
		} else {
			value = parseFloat( value );
		}
        $("#min").val(value[0]);
                  $("#max").val(value[1]);
        // $("#min").val();
		$( this ).slider({
			formatter: function(value) {
				 
				return formatStr(value);
                
			},
			min: parseFloat( $( this ).attr('data-slider-min') ),
			max: parseFloat( $( this ).attr('data-slider-max') ), 
			range: $( this ).attr('data-slider-range'),
			value: value,
			tooltip_split: $( this ).attr('data-slider-tooltip_split'),
			tooltip: $( this ).attr('data-slider-tooltip'),          
		});
        
	});
    
    $( '.input-range1').each(function(){
		var value = $(this).attr('data-slider-value');
		var separator = value.indexOf(',');
	/*	if( separator !== -1 ){
			value = value.split(',');
			value.forEach(function(item, i, arr) {
				arr[ i ] = parseFloat( item );
			});
		} else {*/
			value = parseFloat( value );
		//}
		$( this ).slider({
			formatter: function(value) {
				//console.log(value);
				return value+':00';
			},
			/*min: parseFloat( $( this ).attr('data-slider-min') ),
			max: parseFloat( $( this ).attr('data-slider-max') ), */
		//	range: $( this ).attr('data-slider-range'),
			value: value,
			tooltip_split: $( this ).attr('data-slider-tooltip_split'),
			tooltip: $( this ).attr('data-slider-tooltip')
		});
	});
	
 } );
 function formatStr(str) {
		str = str.toString().replace(/(\.(.*))/g, '');
		var arr = str.split('');
		var str_temp = '';
		if (str.length > 3) {
			for (var i = arr.length - 1, j = 1; i >= 0; i--, j++) {
				str_temp = arr[i] + str_temp;
				if (j % 3 == 0) {
					str_temp = ' ' + str_temp;
				}
			}
			return str_temp;
		} else {
			return str;
		}
	}
} )( jQuery );
