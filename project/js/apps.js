$.reload = function(){
    $('html, body').animate({
        scrollTop: 0
    }, 500);
    setTimeout(function(){
        window.location.reload();
    }, 500);
}



$.showNotify = function($title, $text, $style, $position) {
    if($style == "error"){
        $icon = "fa fa-exclamation";
    }else if($style == "warning"){
        $icon = "fa fa-warning";
    }else if($style == "success"){
        $icon = "fa fa-check";
    }else if($style == "info"){
        $icon = "fa fa-question";
    }else{
        $icon = "fa fa-circle-o";
    }
    $.notify({
        title: $title,
        text: $text,
        image: "<i class='"+$icon+"'></i>"
    }, {
        style: 'metro',
        className: $style,
        globalPosition:$position,
        showAnimation: "show",
        showDuration: 0,
        hideDuration: 0,
        autoHideDelay: 8000,
        autoHide: true,
        clickToHide: true
    });
}
$.showConfirm = function($text, $link, $link__class, $link__success){
    $.notify({
        title: 'Esta seguro?',
        text: $text+'<div class="clearfix"></div><br><a href="'+$link+'" data-link__success="'+$link__success+'" class="btn btn-sm btn-default confirm__hidden '+$link__class+'">Si</a> <a class="btn btn-sm btn-danger confirm__hidden">No</a>',
        image: "<i class='fa fa-warning'></i>"
    }, {
        style: 'metro',
        className: "cool",
        showAnimation: "show",
        showDuration: 0,
        hideDuration: 0,
        autoHideDelay: 15000,
        autoHide: true,
        clickToHide: false
    });
}


$.showLoading = function(){
    $('body').css('overflow','hidden');
    $('.popup__loading').addClass('active');
}
$.hiddenLoading = function(){
    $('body').css('overflow','auto');
    $('.popup__loading').removeClass('active');
}


$.modalMessage = function($title, $text, $type, $html){
    swal({
        title: $title,
        text: $text,
        type: $type,
        html: $html
    });
}
$.modalConfirm = function($title, $text, $type, $action){
    swal({
        title: $title,
        text: $text,
        type: $type,
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Estoy seguro!",
        closeOnConfirm: true
    }, $action);
}