$(function() {
    setInterval(function() {
        $('.headerImg > img:first')
        .fadeOut(1000)
        .next()
        .fadeIn(1000)
        .end()
        .appendTo('.headerImg');
    }, 3000);
});


