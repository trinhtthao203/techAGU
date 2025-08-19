function addFiles(){
    $(".addFiles").click(function(){
        var f = $(this).attr("name"); $("#"+f).click();
    });
}

function dinhkem_button(){
    $("#dinhkem-button").change(function(){
        $("#updateminhchungForm").submit();
    });
}
function updateFiles(){
    $(".updateFiles").click(function(){
        var f = $(this).attr("name"); $("#"+f).click();
        var id = $(this).attr("data-id");
        $("#id_minhchung").val(id);
    });
}


function dinh_kem_button(path, path_donvi){
    $("#dinh-kem-button").change(function(){
        upload_files(path, path_donvi);
    });
}

function dinh_kem_button_ndt(path, path_donvi){
    $("#dinh-kem-button").change(function(){
        var mc_1 = $("#id_dm_minhchung_1_md").val();
        var id_nganhdaotao = $("#id_nganhdaotao_md").val();
        if(mc_1 && id_nganhdaotao != ""){
            upload_files(path, path_donvi);
        } else {
            alert("Vui lòng chọn Ngành đào tạo, Tiêu chuẩn/Tiêu chí");
            return false;
        }
    });
}
function upload_files(path, path_donvi){
    //$(".dinhkem_files").change(function() {
      var formData = new FormData($("#dinhkemform")[0]);$("#progressbar").show();
      $.ajax({
        url: path, type: "POST",
        cache: false, contentType: false,
        data: formData, processData:false,
        xhr: function(){
                //upload Progress
                var xhr = $.ajaxSettings.xhr();
                if(xhr.upload) {
                    xhr.upload.addEventListener('progress', function(event) {
                        var percent = 0;
                        var position = event.loaded || event.position;
                        var total = event.total;
                        if (event.lengthComputable) {
                            percent = Math.ceil(position / total * 100);
                        }
                        //update progressbar
                        $(".progress .progress-bar").css("width", + percent +"%");
                        $(".progress .progress-bar").text(percent +"%");
                        if(percent == 100){
                            $("#progressbar").fadeOut();
                        }
                    }, true);
                }
                return xhr;
            },
          success: function(datas) {
              if(datas=='Failed'){
                  alert('Lỗi không thể Upload tập tin.');
              } else {
                $("#list_files").prepend(datas);DonViAutoComplete(path_donvi);delete_file();update_file();
                $('.draggable-element').arrangeable();
              }
          },
          cache: false, contentType: false, processData: false
        }).fail(function() {
            alert('Lỗi không thể Upload tập tin.');
        });
    //});
}

function delete_file(){
    var link_delete; var _this;
    $(".delete_file").click(function(){
        link_delete = $(this).attr("href"); _this = $(this);
        $.ajax({
            url: link_delete,
            type: "GET",
            success: function(datas) {
                _this.parents("div.items").fadeOut("slow", function(){
                    $(this).remove();
                });
            }
        }).fail(function() {
            //alert('Không thể xoá.');
             _this.parents("div.items").fadeOut("slow", function(){
                $(this).remove();
            });
        });
    });
}

function add_minhchung(){
    $("#add_minhchung").click(function(){
        $("#id").val("");
        $("#ma").val("");
        $("#ten").val("");
        $("#sohieu").val("");
        $("#donvibanhanh").val("");
        $("#thutu").val(0);
         toggleSwitch("#group", false);
        $("#list_files").html("");
        $('.draggable-element').arrangeable();
        $(".minhchungcon").show();
    });
}
function add_minhchungcon(path_donvi){
    $("#add_minhchungcon").click(function(){
        var html = $("#minhchungcon_html").html();
        $("#list_files").prepend(html);
        var ma = $("#ma").val();$(".file_ma").val(ma);
        delete_file();update_file();file_ma();
        DonViAutoComplete(path_donvi);
        $('.draggable-element').arrangeable();
    });
}

function file_ma(){
    $("#ma").keyup(function(){
        var ma = $(this).val();$(".file_ma").val(ma);
    });
}

var button_update;
function update_file(){
    $(".update_file").click(function(){
        button_update = $(this);
        $("#update-file-button").click();$("#Update").prop("disabled", true);
    });
}

function upload_json(input, fileID, path){
    var formData = new FormData($("#updateFile")[0]);
    $.ajax({
        url: path, type: "POST",
        cache: false, contentType: false,
        data: formData, processData:false,
        success: function(data) {
            if(data=='Failed'){
                alert('Lỗi không thể Upload hình ảnh.');
            } else {
                var json = $.parseJSON(data);
                button_update.nextAll(".file_aliasname").val(json.aliasname);
                button_update.nextAll(".file_filename").val(json.filename);
                button_update.nextAll(".file_size").val(json.filesize);
                button_update.nextAll(".file_type").val(json.filetype);
                button_update.closest(".items").find(".delete_file").attr("href", json.delete_path);
                $.toast({
                    heading:"Thông báo",
                    text:"Upload thành công",
                    loaderBg:"#3b98b5",icon:"info", hideAfter:3e3,stack:1,position:"top-right"
                });
                $("#Update").prop("disabled", false);
            }
        },
    }).fail(function() {
        alert('Lỗi không thể Upload hình ảnh.');
    });
}

function change_botieuchuan(path){
    $("#botieuchuan").change(function(){
        var val = $(this).val();
        var get_path = path + "/" + val;
        if(val == ""){
            $(".nganhdaotao_botc").show();
        } else {
            $.getJSON(get_path, function(json){
                if(json.nganhdaotao == 1){
                    $(".nganhdaotao_botc").show();
                } else {
                    $("#id_nganhdaotao").val("");$("#id_nganhdaotao").select2();
                    $(".nganhdaotao_botc").hide();
                }
            });
        }
    });
}
function DonViAutoComplete(path){
    $(".donvibanhanh").autocomplete({
        serviceUrl: path,
        dataType: 'json',
        paramName: 'search',
        type: "GET",
        onSelect: function (suggestion) {
            $(this).val(suggestion.data);
        }
    });
}

function edit_minhchung(path_donvi){
    $(".edit_minhchung").click(function(){
        var _link = $(this).attr("href");
        $.getJSON(_link, function(json){
            $("#id").val(json._id);
            $("#id_nganhdaotao_update").val(json.id_nganhdaotao);
            $("#ma").val(json.ma);
            $("#ten").val(json.ten);
            $("#sohieu").val(json.sohieu);
            $("#donvibanhanh").val(json.donvibanhanh);
            $("#thutu").val(json.thutu);
            if(json.group == 1){
                toggleSwitch("#group", true);
                $(".minhchungcon").hide();
            } else {
                toggleSwitch("#group", false);
                $(".minhchungcon").show();
            }
            $("#list_files").html(json.list_files);update_file();
            DonViAutoComplete(path_donvi);delete_file();$('.draggable-element').arrangeable();
        });
    });
}
function toggle_group(){
    $("#group").change(function(){
        var _this = $(this);
        if(_this.is(":checked")){
            $(".minhchungcon").hide();
        } else {
            $(".minhchungcon").show();
        }
    });
}

function toggleSwitch(switch_elem, on) {
    if (on){ // turn it on
        if ($(switch_elem)[0].checked){ // it already is so do
            // nothing
        }else{
            $(switch_elem).trigger('click').attr("checked", "checked"); // it was off, turn it on
        }
    }else{ // turn it off
        if ($(switch_elem)[0].checked){ // it's already on so
            $(switch_elem).trigger('click').removeAttr("checked"); // turn it off
        }else{ // otherwise
            // nothing, already off
        }
    }
}
function chitietminhchung(){
    $(".chitietminhchung").click(function(){
        var _link = $(this).attr("href");
        $.get(_link, function(html){
            $("#ChiTietMinhChung").html(html);view_pdf();image_popup();
        });
    });
}

function image_popup(){
    $(".image-popup").magnificPopup({type:'image'});
}

function view_pdf(){
    $(".view_pdf").click(function(){
        var pdf_path = $(this).attr("href");
        $.get(pdf_path, function(v){
            $("#XemMinhChungList").html(v);
        });
    });
}

function botieuchuan_change(path, botc, id){
    $("#botieuchuan").change(function(){
        var v = $(this).val();
        $.get(path + "?botc="+v+"&id="+id, function(html){
            $("#id_tieuchuan").html(html);
        });
    });
    if(botc){
        $.get(path + "?botc="+botc+"&id="+id, function(html){
            $("#id_tieuchuan").html(html);
            $("#id_tieuchi").html('<option value="">Chọn Tiêu chí</option>');
        });
    }
}

function tieuchuan_change(path, id_parent, id){
    $("#id_tieuchuan").change(function(){
        var v = $(this).val();
        $.get(path + "?id_parent="+v+"&id="+id, function(html){
            $("#id_tieuchi").html(html);
        });
    });
    if(id_parent){
        $.get(path + "?id_parent="+id_parent+"&id="+id, function(html){
            $("#id_tieuchi").html(html);
        });
    }
}
