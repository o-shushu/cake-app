$(function() {
    setInterval(function() {
        $('.headerImg > img:first')
        .fadeOut(1000)
        .next()
        .fadeIn(1000)
        .end()
        .appendTo('.headerImg');
    }, 3000);

    var counta = 0;
    $("#sidebtn").click(function(){
        counta++;
        if(counta % 2 !== 0){
            $(".side-menu").css("display", "block");
        }else{
            $(".side-menu").css("display", "none"); 
        }
    });
});


