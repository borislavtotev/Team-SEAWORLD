'use strict';
jQuery(function() {
    jQuery( 'body' ).on( 'click', 'button', function ( e )  {
        var button = jQuery(e.target );
        if (button.is( '.delete-btn' )) {
            e.stopPropagation();
            var albumId = this.dataset.albumid;
            var picId = this.dataset.picid;
            var container = jQuery( e.target.parentNode );
            jQuery.post( './delete-album.php', { albumId:albumId, picId:picId }, function( result ) {
                if (!result) {
                    button.remove();
                    container.animate( { width: 0, opacity: 0, height: 0 }, 1000, function() {
                        jQuery( this ).remove();
                    });
                } else {
                    console.log(result);
                }
            });
        } else if (button.is( '.vote' )) {
            e.stopPropagation();
            var target = button.data( 'target' );
            var targetType = button.data( 'targetType' ) ? true : false;
            var isVoteUp = button.is( '.vote-up' ) ? true : false;
            jQuery.post( './system/vote-system.php', { target: target, isVoteUp: isVoteUp, targetType: targetType }, function( result ) {
                if (!result) {
                    var span = isVoteUp ? button.parent().find( '.up' ) : button.parent().find( '.down' );
                    var val = Number(span.text());
                    span.text( val + 1 );
                } else {
                    console.log(result);
                }
            })
        }
    })
});