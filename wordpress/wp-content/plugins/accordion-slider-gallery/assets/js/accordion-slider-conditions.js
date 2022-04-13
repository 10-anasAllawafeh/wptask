wp.AccordionSlider = 'undefined' === typeof( wp.AccordionSlider ) ? {} : wp.AccordionSlider;

var AccordionSliderGalleryConditions = Backbone.Model.extend({

	initialize: function( args ){

		var rows = jQuery('.accordion-slider-settings-container tr[data-container]');
		var tabs = jQuery('.accordion-slider-tabs .accordion-slider-tab');
		this.set( 'rows', rows );
		this.set( 'tabs', tabs );

	},


});