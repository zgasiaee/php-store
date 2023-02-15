$(function () {


    $(".login span").click(function () {
         $( ".login-box" ).slideToggle();
    })

    $('.slider').bxSlider();

    $(".group").click(function () {
    var tab = $(this).parent().attr("data-tab");

       window.location.href = `http://localhost/store/store.php?tab=${tab}#product`;

   })

    $("[data-id ='increase']").click(function () {
        var value=parseInt($(this).prev().val())
        if(value<50){
            $(this).prev().val(value+1)
        }
    })

    $("[data-id ='decrease']").click(function () {
        var value=parseInt($(this).next().val())
        if(value>0){
            $(this).next().val(value-1)
        }

    })

    $(window).scroll(function(){
        var pos = $('.header');
        var shop = $('.header .shop');
        var social = $('.header .info-right');
        var group = $('.header .info-left');
        var isfixed = (pos.css('position') == 'fixed');

        if ($(this).scrollTop() > 300 && !isfixed){
            pos.css({
                'position': 'fixed', 'top': '0px','margin-top':'0px','padding-top':'8px','height':'50px'
            });
            shop.css({
                'display': 'block'
            });
            social.css({
                'display': 'none'
            });
            group.css({
                'width': '1000px'
            });
        }
        if ($(this).scrollTop() < 300 && isfixed){
            pos.css({
                'position': 'absolute', 'top': '0px','margin-top':'60px','padding-top':'23px','height':'70px'
            });
            shop.css({
                'display': 'none'
            });
            social.css({
                'display': 'flex'
            });
            group.css({
                'width': '300px'
            });
        }
    });

    $(".header .shop").click(function () {
        $(".cart-page").slideToggle();
    })


    
})