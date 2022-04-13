( function() {
	const pubKey = cpsw_admin_stripe_elements.public_key;
	const mode = cpsw_admin_stripe_elements.mode;
	const clientSecret = cpsw_admin_stripe_elements.client_secret;

	if ( '' === clientSecret || '' === pubKey || ( 'live' === mode && ! cpsw_admin_stripe_elements.is_ssl ) ) {
		return;
	}

	const stripe = Stripe( pubKey );

	stripe.confirmSepaDebitPayment( clientSecret, {} ).then( function() {} );
}( jQuery ) );
