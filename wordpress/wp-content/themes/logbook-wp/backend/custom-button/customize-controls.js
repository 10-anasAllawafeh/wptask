( function( api ) {

	// Extends our custom "logbookwp" section.
	api.sectionConstructor['logbook-wp'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );