function addFiles(){
    $(".addFiles").click(function(){
        var f = $(this).attr("name"); $("#"+f).click();
    });
}

function dinh_kem_button(){
    $("#dinh-kem-button").change(function(){
       $("#BaoCaoForm").submit();
    });
}
