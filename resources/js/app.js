// import './bootstrap';
$(function() {
    let slides = document.querySelectorAll("#slider-wrapper img");//slides.length = 3
    let counter = 0;

    slides.forEach((slide, index) => {
        slide.style.left = `${index * 100}%`;
    });

    const slideImage = () => {
        slides.forEach((slide) => {
        slide.style.transform = `translateX(-${counter * 100}%)`;//translateX()平面上水平重新定位元素
        });
    };

    function moveRight() {
        if (counter < slides.length - 1) {
        counter++;
        slideImage();
        } else if (counter === slides.length - 1) {
        counter = 0;
        slideImage();
        }
    }
    
    function moveLeft() {
        if (counter === 0) {
        counter = slides.length - 1;
        slideImage();
        } else {
        counter--;
        slideImage();
        }
    }
    $(function () {
    //每3秒执行一次
    let interval = setInterval(() => {
        moveRight();
    }, 3000);//setInterval() 方法可按照指定的周期（以毫秒计）来调用函数或计算表达式.
    
    $("#prev").click(() => {
        moveLeft();
    });
    
    $("#next").click(() => {
        moveRight();
    });
    
    $("#slider-wrapper").mouseover(() => {
        clearInterval(interval);
    });
    
    $("#slider-wrapper").mouseleave(function () {
        interval = setInterval(() => {
        moveRight();
        }, 3000);
    });
    });

    $("#moreLook").mouseover(function(){
        $("#moreLook").on("click", function(e){
            e.stopPropagation();
            $(".lookMoreProducts").show();
        });
        //いいね
        $(".lookMoreProducts").click(function(event){
            event.stopPropagation();
            });
        $(document).on("click", function(){
            location.reload();
            $(".lookMoreProducts").hide();
        })
    });
  
//サイズによって、価格は違う
    var defaultPrice = $('select[id="size"]').val();
    $('#price').html('<p>'+defaultPrice+'</p>');
    $('select[id="size"]').change(function() {
        var val1 = $(this).val();  
        $('#price').html('<p>'+val1+'</p>');
    });

//商品注文状態
    $('select[id="orderStatus"]').change(function() {
        var $this = $(this);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/orderStatus',
            type: 'POST',
            data:{
                'order_status': $this.val(),
                'order_id': $this.data('order-id'),
                'shop_id': $this.data('shop-id')
            }
        }).done(function(data){
            console.log('success');
        }).fail(function(data, xhr, err){
            console.log('error');
        })
    });

//店のいいね
    $('.js-like-toggle').click(function(e){
        var $this = $(this);
        e.preventDefault();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/shop/like',
            type: 'POST',
            data:{
                'shop_id': $this.data('shop-id')
            }
        }).done(function(data){
            if(data==='liked'){
                console.log('liked');
            }if(data==='unliked'){
                console.log('unliked');
            }
            location.reload();
        }).fail(function(data, xhr, err){
            console.log('error');
        })
    });

//商品のいいね
    $('.cake-like-toggle').click(function(e){
        var $this = $(this);
        e.preventDefault();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/cake/like',
            type: 'POST',
            data:{
                'cake_id': $this.data('cake-id')
            }
        }).done(function(data){
            if(data.status==='liked'){
                $this.addClass('text-red-500');
                $this.parent().children('.likesCount').text(data.total_likes);
                console.log('liked');
            }
            if(data.status==='unliked'){
                $this.removeClass('text-red-500');
                $this.parent().children('.likesCount').text(data.total_likes);
                console.log('unliked');
            }
            // location.reload();
        }).fail(function(data, xhr, err){
            console.log('error');
        })
    });

//カートに入れる
    $('.cart-input').click(function(e){
        e.preventDefault();
        var $this = $(this);
        var amount = $("#edit_area").text();
        var price = $("#price").text();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/user/inputCart',
            type: 'POST',
            data:{
                'cake_id': $this.data('cake-id'),
                'shop_id': $this.data('shop-id'),
                'amount': amount,
                'price': price
            }
        }).done(function(data){
            if(data==='Success'){
                confirm('カートに入れました。')
            }
            if(data ==='noLogin'){
                confirm('ログインしてください。')
            }
        }).fail(function(data, xhr, err){
        
            console.log('error');
        })
    });

    $('.shopsInputCart').click(function(e){
        e.preventDefault();
        var $this = $(this);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/user/shopsInputCart',
            type: 'POST',
            data:{
                'cake_id': $this.data('cake-id'),
                'shop_id': $this.data('shop-id')
            }
        }).done(function(data){
            if(data==='Success'){
                confirm('カートに入れました。')
            }
            if(data ==='noLogin'){
                confirm('ログインしてください。')
            }
        }).fail(function(data, xhr, err){
        
            console.log('error');
        });
    });

})

