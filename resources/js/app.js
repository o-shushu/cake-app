// import './bootstrap';
$(function() {
    $(window).scroll(function(){
        $("#moreLook").on("click", function(e){
            e.stopPropagation();
            $(".lookMoreProducts").show();
        });
        //いいね
        $(".lookMoreProducts").click(function(event){
            event.stopPropagation();
            });
        $(document).on("click", function(){

            $(".lookMoreProducts").hide();
        })
    });
    
//サイズによって、価格は違う
    var defaultPrice = $('select[id="size"]').val();
    $('#price').html('<p>'+defaultPrice+'</p>');
    $('select[id="size"]').change(function() {
        var val1 = $(this).val();  
        $('#price').html('<p>'+val1+'</p>');
    })

});

//商品注文状態
    $('select[id="orderStatus"]').change(function() {
        var $this = $(this);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/cake-app/public/orderStatus',
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
        url: '/cake-app/public/shop/like',
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
        url: '/cake-app/public/cake/like',
        type: 'POST',
        data:{
            'cake_id': $this.data('cake-id')
        }
    }).done(function(data){
        if(data==='liked'){
            console.log('liked');
        }
        if(data==='unliked'){
            console.log('unliked');
        }
        location.reload();
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
        url: '/cake-app/public/user/inputCart',
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
})

$('.shopsInputCart').click(function(e){
    e.preventDefault();
    var $this = $(this);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/cake-app/public/user/shopsInputCart',
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
    })
})
