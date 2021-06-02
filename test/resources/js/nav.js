$(document).ready(function(){
    //usuwanie przedrosta /test/public, sprawdzanie do ktorego nav odnosi sie url
    var href = window.location.pathname;
    var tempPath = '/test/public';
    var stripper = href.trim().replace(tempPath, '');

    //sprawdzanie ktory navItem jest aktualnym url
    var navItem = $(".navItem");


    // navItem.each(function(){
    //     if($(this).val() == stripper){
    //         alert($(this).val());
    //     }
    // })

});