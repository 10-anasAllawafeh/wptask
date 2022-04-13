// When the user clicks on the button, scroll to the top of the document
		function topFunction(){
		  document.body.scrollTop = 0; // For Safari
		  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
		}
	  jQuery(document).ready(function(){
		mybutton = document.getElementById("myBtn");

		// When the user scrolls down 20px from the top of the document, show the button
		window.onscroll = function() {scrollFunction()};

			function scrollFunction() {
			if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
				mybutton.style.display = "block";
			} else {
				mybutton.style.display = "none";
		  }
	  }

});

(function($) {
			"use strict";


var menu_toggle         = $('.logbook-wp-menu-toggle');
var nav_menu            = $('.logbook-wp-main-navigation ul');


/*------------------------------------------------
		MAIN NAVIGATION
------------------------------------------------*/

menu_toggle.click(function(){
	$(this).toggleClass('close-menu');
	nav_menu.slideToggle();
});

$('.logbook-wp-main-navigation .logbook-wp-nav-menu .menu-item-has-children > a').after( $('<button class="dropdown-toggle"><i class="fa fa-arrow-down"></i></button>') );

$('button.dropdown-toggle').click(function() {
	$(this).toggleClass('active');
   $(this).parent().find('.sub-menu').first().slideToggle();
});

$('.logbook-wp-menu-toggle').click(function () {
        $(this).next('.nav-menu').slideToggle();
        totalKeyboardLoop($('.logbook-wp-main-navigation'));
        return false;
    });

    var totalKeyboardLoop = function (elem) {

        var tabbable = elem.find('select, input, textarea, button, a').filter(':visible');

        var firstTabbable = tabbable.first();
        var lastTabbable = tabbable.last();
        /*set focus on first input*/
        firstTabbable.focus();

        /*redirect first shift+tab to last input*/
        firstTabbable.on('keydown', function (e) {
            if ((e.which === 9 && e.shiftKey)) {
                e.preventDefault();
                lastTabbable.focus();
            }
        });

        /* allow escape key to close insiders div */
        elem.on('keyup', function (e) {
            if (e.keyCode === 27) {
                elem.hide();
            }
            ;
        });
    };

})(jQuery);



// Navbar Area sticky

jQuery(window).on('scroll', function() {
	if (jQuery(this).scrollTop() >150){  
		jQuery('.logbook-wp-sticky').addClass("sticky-nav");
	}
	else{
		jQuery('.logbook-wp-sticky').removeClass("sticky-nav");
	}
});

jQuery(document).ready(function() {
	jQuery('.skip-link-menu-end-skip').focus(function(){
		jQuery('.close-menu').focus();
	});
});