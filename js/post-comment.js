'use strict';
jQuery(function() {
    var form = jQuery( '#comment-form' );
    var submitButton = jQuery( '#submit-comment-btn' );
    if (form.length && submitButton.length) {
        var template = jQuery( '#comment-template' );
        form.submit(function( e ) {
            e.preventDefault();

            var comment = jQuery( '#inputComment' ).val();
            var picId = jQuery( '#picId' ).val();
            var albumId = jQuery( '#albumId' ).val();
            var obj = { comment: comment, picid: picId, albumid: albumId };
            jQuery.post( './system/add-comment.php', obj, function( result ) {
                var comment = JSON.parse( result );
                if (comment) {
                    var commentElement = template.clone();
                    commentElement.find( 'p').text( comment[ 'content' ] );
                    commentElement.find( 'span.pull-left').text( comment[ 'owner' ] );
                    commentElement.find( 'span.pull-right').text( comment[ 'date' ] );
                    jQuery( 'article.comment-container:last').after( commentElement );
                    commentElement.fadeIn();
                    jQuery( '#inputComment' ).val( '' );
                } else {
                    console.log( result );
                }
            });
        });
    }
});