$('document').ready(function() {
    $('.status').hide(200);
    let cache = true;

    $('.deux').click(function() {
        if (cache === true){
            $('.status')
                .fadeIn(300)
                .css("z-index", "0")
            $('.deux').css("z-index", "1")
            cache = false;
        }
        else {
            $('.status')
                .fadeOut(300)
                .css("Z-Index", "1");
            $('.deux').css("z-index", "0")
            cache = true;
        }
    })
})