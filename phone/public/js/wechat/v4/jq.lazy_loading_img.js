// 说明：若使用该延迟加载，请在加载对象添加 data-img 以及 data-type 属性
//       data-img  延迟加载的图片链接
//       data-type 图片显示类型，1为DIV背景铺图，2为IMG铺图

var lazyLoadingImgs = []; //已经load过的图片
$(document).ready(function () {
    $(window).scroll(function () {
        var currentTop = $(window).scrollTop();
        doLazyLoadingImg( currentTop );
    });
});

function doLazyLoadingImg( currentTop ){
    var currentBottom = currentTop + $(window).height();
    var loadingObjs = [];
    //获取出当前滚动屏幕上的所有延迟图片对象
    $(".lazy-img-loading").each(function(index, el) {
        //获取当前对象的滚动TOP，取出当前显示屏幕上的延迟加载对象
        var objTop = $(this).offset().top;
        if( objTop <= currentBottom && objTop >= currentTop ){
            loadingObjs.push( $(this) );
        }
    });
    $.each(loadingObjs, function(index, loadingObj) {
        var img = loadingObj.data('img');
        var type = loadingObj.data('type');
        if( $.inArray(img, lazyLoadingImgs) == -1 ){
            lazyLoadingImgs.push( img );
        }
        var imgObj = new Image();
        imgObj.src = img;
        imgObj.onload = function(){
            //判断图片显示类型，1为DIV背景铺图，2为IMG铺图
            if( type == 1 ){
                loadingObj.css("background-image", "url('"+ imgObj.src +"')");
            }
            if( type == 2 ){
                loadingObj.attr("src", imgObj.src);
            }
        }
    });
}
doLazyLoadingImg($(window).scrollTop()); //加载第一屏的图片