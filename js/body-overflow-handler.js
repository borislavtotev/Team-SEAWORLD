'use strict';
jQuery(function() {
    jQuery( 'body' ).one('webkitAnimationEnd oanimationend msAnimationEnd animationend',
        function( e ) {
            jQuery( 'body' ).removeClass( 'hidden-overflow' );
        });
});