'use strict';
$( function() {
    var uploadForm = $( '#uploadForm' ),
        addImagesButton = $( '#add-img-btn'),
        inputTemplate = uploadForm.find( '.form-group').clone();

    addImagesButton.on( 'click', function() {
       uploadForm.append( inputTemplate.clone() );
    });
});