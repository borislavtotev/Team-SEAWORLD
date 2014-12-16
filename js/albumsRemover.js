'use strict';
jQuery(function() {
    jQuery( '#albums-container' ).on( 'click', 'button', function ( e )  {
        e.stopPropagation();
        var albumId = this.dataset.albumid;
        var container = jQuery( e.target.parentNode );
        var button = jQuery(e.target );
        jQuery.post( './delete-album.php', { albumId:albumId }, function( result ) {
            if (!result) {
                button.remove();
                container.animate( { width: 0, opacity: 0 }, 1000, function() {
                    jQuery( this ).remove();
                });
            } else {
                console.log(result);
            }
        });
    })
});