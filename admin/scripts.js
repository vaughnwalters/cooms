$(document).ready(function() {

    // to interact with the WYSIWIG
    ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
        console.error( error );
    });


});


