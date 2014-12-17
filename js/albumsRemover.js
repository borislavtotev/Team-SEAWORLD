'use strict';
jQuery(function() {
    jQuery( '#albums-container' ).on( 'click', 'button', function ( e )  {
        e.stopPropagation();
        var albumId = this.dataset.albumid;
        var picId = this.dataset.picid;
        var container = jQuery( e.target.parentNode );
        var button = jQuery(e.target );
        console.log(this.dataset.picId);
        jQuery.post( './delete-album.php', { albumId:albumId, picId:picId }, function( result ) {
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