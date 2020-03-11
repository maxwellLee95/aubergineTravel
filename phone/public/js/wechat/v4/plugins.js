/**
 * [initDate 转换时间戳为日期]
 * @Author   xhb
 * @DateTime 2017-03-23
 * @param    {[type]}   strtime [description]
 * @return   {[type]}           [description]
 */
String.prototype.initDate = function(){
    var obj = new Date( parseInt( this ) * 1000 );
    var Y = obj.getFullYear();
    var M = obj.getMonth() + 1;
    M = M < 10 ? ("0"+M) : M;
    var D = obj.getDate();
    D = D < 10 ? ("0"+D) : D;
    var h = obj.getHours();
    h = h < 10 ? ("0"+h) : h;
    var m = obj.getMinutes();
    m = m < 10 ? ("0"+m) : m;
    var s = obj.getSeconds();
    s = s < 10 ? ("0"+s) : s;
    var w = obj.getDay();
    var result = {};
    result['Y'] = Y.toString();
    result['M'] = M.toString();
    result['D'] = D.toString();
    result['h'] = h.toString();
    result['m'] = m.toString();
    result['s'] = s.toString();
    result['w'] = w.toString();
    return result;
}

/**
 * [remove 删除数据元素]
 * @Author   xhb
 * @DateTime 2017-03-23
 * @param    {[type]}   val [description]
 * @return   {[type]}       [description]
 */
Array.prototype.remove = function(val) {
    var index = this.indexOf(val);
    if (index > -1) {
        this.splice(index, 1);
    }
};

/**
 * [按钮加载插件]
 * @Author   xhb
 * @DateTime 2017-03-24
 * @param    {[type]}   $ [description]
 * @return   {[type]}     [description]
 */
(function ($) {
    /**
     * 定义一个插件 BtnLoading
     */
    var BtnLoading;
    BtnLoading = (function () {
        //实例化
        function BtnLoading(element, options) {
            //将插件的默认参数及用户定义的参数合并到一个新的obj里
            this.settings = $.extend({}, $.fn.Btnloading.defaults, options);
            //将dom jquery对象赋值给插件，方便后续调用
            this.$element = $(element);
            //初始化调用一下
            this.init();
        }
        //调用
        BtnLoading.prototype.init = function(){
            this.$element.attr('old-fun', this.$element.attr('onclick'));
            this.$element.removeAttr('onclick');
            this.$element.attr('old-html', this.$element.html());
            this.$element.html( '<img src="'+ this.settings.img +'" style="height:16px;">' + this.settings.name );
        };
        BtnLoading.prototype.reset = function(){
            this.$element.removeAttr('data-btnloading');
            this.$element.attr('onclick', this.$element.attr('old-fun'));
            this.$element.html(this.$element.attr('old-html'));
        };
        return BtnLoading;
    })();
    /**
     * 这里是将btnLoading对象 转为jq插件的形式进行调用
     * 定义一个插件 btnloading
     * zepto的data方法与jq的data方法不同
     * 这里的实现方式可参考文章：http://trentrichardson.com/2013/08/20/creating-zepto-btnloadings-from-jquery-btnloadings/
     */
    $.fn.Btnloading = function(options){
        return this.each(function () {
            var $this = $(this),
                instance = $.fn.Btnloading.lookup[$this.data('btnloading')];
            if (!instance) {
                //zepto的data方法只能保存字符串，所以用此方法解决一下
                $.fn.Btnloading.lookup[++$.fn.Btnloading.lookup.i] = new BtnLoading(this,options);
                $this.data('btnloading', $.fn.Btnloading.lookup.i);
                instance = $.fn.Btnloading.lookup[$this.data('btnloading')];
            }
            if (typeof options === 'string') instance[options]();
        })
    };
    $.fn.Btnloading.lookup = {i: 0};
    /**
     * [defaults 插件的默认值]
     * @type {Object} search:搜索
     */
    $.fn.Btnloading.defaults = {
        type: "search",
        name: "正在搜索",
        img: "./images/wechat/loading2.gif"
    };
})(Zepto);

/**
 * [Page 单页对象基本参数获取、设置；可自行添加需要的内容]
 * @Author   xhb
 * @DateTime 2017-03-27
 */
function Page(){
    this.titles = [];
    this.shares = [];
    this.level = 0;
    this.windowWidth = $(window).width();
    this.windowHeight = $(window).height();
    this.pageWidth = $(window).width();
    this.pageHeight = $(window).height() - $(".topBar").height();
}
//level 页面等级； val 标题
Page.prototype.setTitle = function( level, val ){
    var self = this;
    this.titles[ level ] = val;
    this.level = level;
    $("#pageTitle").html( val );
}
Page.prototype.setShare = function( level, title, desc, img, url ){
    this.level = level;
    this.shares[ level ] = {};
    this.shares[ level ]['title'] = title;
    this.shares[ level ]['desc'] = desc;
    this.shares[ level ]['img'] = img;
    this.shares[ level ]['url'] = url;
    this.resetShare();
}
Page.prototype.back = function(){
    var self = this;
    this.level = this.level - 1;
    $.each(this.titles, function(index, title) {
        if( index > self.level ){
            self.titles.remove( title );
        }
    });
    $("#pageTitle").html( this.titles[ this.level ] );
}
Page.prototype.resetShare = function(){
    var share = this.shares[ this.level ];

    wx.onMenuShareTimeline({
        title: share['title'], // 分享标题
        imgUrl: share['img'], // 分享图标
        link: share['url'],
        success: function () {
            // 用户确认分享后执行的回调函数
        },
        cancel: function () {
            // 用户取消分享后执行的回调函数
            // alert("timeline cancel");
        }
    });

    wx.onMenuShareAppMessage({
        title: share['title'], // 分享标题
        desc: share['desc'], // 分享描述
        imgUrl: share['img'], // 分享图标
        type: 'link', // 分享类型,music、video或link，不填默认为link
        dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
        link: share['url'],
        success: function () {
            // 用户确认分享后执行的回调函数
            // alert("message success");
        },
        cancel: function () {
            // 用户取消分享后执行的回调函数
            // alert("message cancel");
        }
    });
}