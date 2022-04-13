wp.AccordionSlider = 'undefined' === typeof( wp.AccordionSlider ) ? {} : wp.AccordionSlider;
wp.AccordionSlider.modalChildViews = 'undefined' === typeof( wp.AccordionSlider.modalChildViews ) ? [] : wp.AccordionSlider.modalChildViews;
wp.AccordionSlider.previewer = 'undefined' === typeof( wp.AccordionSlider.previewer ) ? {} : wp.AccordionSlider.previewer;
wp.AccordionSlider.modal = 'undefined' === typeof( wp.AccordionSlider.modal ) ? {} : wp.AccordionSlider.modal;
wp.AccordionSlider.items = 'undefined' === typeof( wp.AccordionSlider.items ) ? {} : wp.AccordionSlider.items;
wp.AccordionSlider.upload = 'undefined' === typeof( wp.AccordionSlider.upload ) ? {} : wp.AccordionSlider.upload;

jQuery( document ).ready( function( $ ){

	// Here we will have all gallery's items.
	wp.AccordionSlider.Items = new wp.AccordionSlider.items['collection']();
	
	// Settings related objects.
	wp.AccordionSlider.Settings = new wp.AccordionSlider.settings['model']( AccordionSliderHelper.settings );

	// AccordionSlider conditions
	wp.AccordionSlider.Conditions = new AccordionSliderGalleryConditions();

	// Initiate AccordionSlider Resizer
	if ( 'undefined' == typeof wp.AccordionSlider.Resizer ) {
		wp.AccordionSlider.Resizer = new wp.AccordionSlider.previewer['resizer']();
	}
	
	// Initiate Gallery View
	wp.AccordionSlider.GalleryView = new wp.AccordionSlider.previewer['view']({
		'el' : $( '#accordion-slider-uploader-container' ),
	});

	// AccordionSlider edit item modal.
	wp.AccordionSlider.EditModal = new wp.AccordionSlider.modal['model']({
		'childViews' : wp.AccordionSlider.modalChildViews
	});


	// Here we will add items for the gallery to collection.
	if ( 'undefined' !== typeof AccordionSliderHelper.items ) {
		$.each( AccordionSliderHelper.items, function( index, image ){
			var imageModel = new wp.AccordionSlider.items['model']( image );
		});
	}

	// Initiate AccordionSlider Gallery Upload
	new wp.AccordionSlider.upload['uploadHandler']();  // Comented By DEEPAK

});