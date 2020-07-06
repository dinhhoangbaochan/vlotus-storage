$(document).ready(function() {


  	let simpleArray = ["Hello", "Xin Chao", "Annhon", "Bonjour"];

    $('.autocomplete').autocomplete({
        source: simpleArray,
    }).focus(function () {
        $(this).data("uiAutocomplete").search($(this).val());
    });


})