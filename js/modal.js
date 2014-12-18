'use strict';
$(function(){
    var errorModal = $( '#errorModal'),
        modalHeader = $( '#loginRegisterLabel' ),
        modalForm = $( '#loginRegisterForm' ),
        modalEmail = $( '#emailInputContainer' ),
        modalCheckBox = $( '#rememberMeCheck' ),
        picModal = $( '#picModal' ),
        openImgBtn = $( '#openImg' ),
        modalSubmitBtn = $( '#submitBtn' );

    if (errorModal.length) {
        errorModal.modal( 'show' );
    }

    // Login/Register modal handler
    $( '#loginRegisterModal' ).on('show.bs.modal', function ( event ) {
        var button = $( event.relatedTarget );
        var recipient = button.data( 'modal-type' );
        if (recipient == 'login') {
            modalHeader.text( 'Login' );
            modalForm.attr( 'action', 'login.php' );
            modalEmail.hide();
            modalCheckBox.show();
            modalSubmitBtn.text( 'Login' );
        } else {
            modalHeader.text( 'Register' );
            modalForm.attr( 'action', 'register.php' );
            modalEmail.show();
            modalCheckBox.hide();
            modalSubmitBtn.text( 'Register' );
        }
    });

    if (picModal.length && openImgBtn.length) {
        openImgBtn.on( 'click', function( e ) {
            e.preventDefault();
            picModal.modal( 'show' );
        });
    }
});