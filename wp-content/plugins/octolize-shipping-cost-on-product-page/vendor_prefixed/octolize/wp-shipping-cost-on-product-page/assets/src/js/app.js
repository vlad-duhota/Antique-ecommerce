( function ( $ ) {
	let calculator_container_class = '.js--scpp-shipping-calculator-container';

	$( 'body' )
		.on(
			'click',
			'.js--scpp-calculator-open-button',
			function () {
				let container = $( this ).closest( calculator_container_class );

				$( '.js--scpp-results-container', container ).hide();
				$( '.js--scpp-calculator-container', container ).addClass( 'active' );

				return false;
			}
		)
		.on(
			'click',
			'.js--scpp-calculate-button',
			function () {
				let container = $( this ).closest( calculator_container_class );

				$.ajax(
					{
						type: "POST",
						url: __jsOctolizeCostOnProductPage.ajax_url,
						data: {
							product_id: $( '[name="product_id"]', container ).val() || $( 'form.cart [name="add-to-cart"]' ).val() || 0,
							variation_id: $( 'form.cart [name="variation_id"]' ).val() || 0,
							quantity: $( '[name="quantity"]', container ).val() || $( 'form.cart [name="quantity"]' ).val() || 1,
							calc_shipping_country: $( '#calc_shipping_country', container ).val() || '',
							calc_shipping_state: $( '#calc_shipping_state', container ).val() || '',
							calc_shipping_postcode: $( '#calc_shipping_postcode', container ).val() || '',
							calc_shipping_city: $( '#calc_shipping_city', container ).val() || '',
						},
						beforeSend: function ( xhr ) {
							$( container ).block( { message: null, overlayCSS: { background: '#fff', opacity: 0.6 } } )
						}
					}
				).done(
					function ( response ) {
						$( container ).unblock();

						$( '.js--scpp-results-container', container ).html( response ).show();

						if ( $( '.js--scpp-calculator-errors-container', container ).length === 0 ) {
							$( '.js--scpp-calculator-container', container ).removeClass( 'active' );
						} else {
							$( '.js--scpp-different-address-container', container ).hide();
						}
					}
				).always(
					function () {
						$( container ).unblock();
					}
				);

				return false;
			}
		);

} )( jQuery );
