function chontinh(app_url){
    $(".diachi_tinh").change(function(){
        var _this = $(this);
        $.get(app_url + 'address/get/'+_this.val(), function(tinh){
            _this.closest("div").next().find(".diachi_huyen").html(tinh);
        });
    });
}

function chonhuyen(app_url){
    $(".diachi_huyen").change(function(){
        var _this = $(this);
        $.get(app_url +'address/get/'+_this.val(), function(huyen){
            _this.closest("div").next().find(".diachi_xa").html(huyen);
        });
    });
}