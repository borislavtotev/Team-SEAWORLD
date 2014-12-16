'use strict';
$( function() {
    var formBody = $( '#filesUpload').find( '.modal-body' ),
        addImagesButton = $( '#add-img-btn'),
        inputTemplate = formBody.find( '.form-group' ).last();

    addImagesButton.on( 'click', function() {
       formBody.append( inputTemplate.clone() );
    });
});