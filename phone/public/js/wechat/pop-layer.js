var popLayer = function( options, endCallback ){
    //绑定页面不允许滚动
    $('body').bind('touchmove', function (event) {
        event.preventDefault();
    });

    $("#pop-layer").remove(); //移除旧的

    //获取被传递参数的数值长度
    var numargs = arguments.length;
    //判断是否有带options设置参数，有则重置设置
    if( arguments[0] ){
        options.title = arguments[0].title;
        options.content = arguments[0].content;
        options.btnsName = arguments[0].btnsName;
        options.btnsCallback = arguments[0].btnsCallback;
    }else{
        //设置默认值
        options = {
            title: '',
            btnsName: '取消',
            btnsCallback: 'closePopLayer',
            content: '内容为空！',
        }
    }

    //判断需要多少个按钮，分隔成按钮数组
    var buttons = new Array(); //定义数组
    buttons = options.btnsName.split(";"); //字符分割
    var callbacks = new Array(); //定义数组
    callbacks = options.btnsCallback.split(";"); //字符分割

    //添加弹出层HTML
    var addHtml = '<div id="pop-layer">';
    addHtml    +=     '<div id="pop-layer-main">';
    if ( options.title ) {
        addHtml    +=         '<div id="pop-layer-top">';
        addHtml    +=         '<div id="pop-layer-title">' + options.title + '</div>';
        addHtml    +=             '<div id="pop-layer-close">';
        addHtml    +=                 '<button type="button" class="pop-no-style-btn" onclick="closePopLayer()">';
        addHtml    +=                     '<img src="/phone/public/images/wechat/close_pop.png" width="16">';
        addHtml    +=                 '</button>';
        addHtml    +=             '</div>';
        addHtml    +=         '</div>';
    }
    if( options.content != "" ){
        addHtml    +=     '<div id="pop-layer-center">';
        addHtml    +=         options.content;
        addHtml    +=     '</div>';
    }
    if( options.btnsName != "" ){
        addHtml    +=     '<div id="pop-layer-footer">';
        //判断按钮长度，循环输入按钮
        for( var i=0; i<buttons.length; i++ ){
            addHtml += '<button type="button" class="pop-no-style-btn';
            if( buttons.length > 1 && i < buttons.length-1 ){
                addHtml += ' pop-layer-right';
            }
            addHtml += '" onclick="' + callbacks[i] + '">' + buttons[i] + '</button>';
        }
        addHtml    +=     '</div>';
    }
    addHtml    += '</div>';
    $("body").append( addHtml );

    // //样式里默认设置定位到页面看不到，在这里进行高度判断，再显示弹出层
    // $("#pop-layer-main").css( 'top', ( $(window).height() - $("#pop-layer-main").height() ) / 2 - 40 );

    if( endCallback != '' && endCallback != undefined ){
        endCallback();
    }
}

//关闭方法
function closePopLayer(){
    $("#pop-layer").remove();
    //解除绑定页面不允许滚动
    $('body').unbind('touchmove');
}