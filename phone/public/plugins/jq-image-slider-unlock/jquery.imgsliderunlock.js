/**
 * Author: Arron.y
 * Email: yangyun4814@gmail.com
 * Github: https://github.com/ArronYR
 * CreateTime: 2016-03-11
 */

'use strict';

// 滑动条对象
function ImageSliderUnlock(elm, options, success, always) {
    var _self = this;

    var $elm = _self.checkElm(elm) ? $(elm) : $;
    var options = _self.checkObj(options) ? options : new Object();
    var success = _self.checkFn(success) ? success : function() {};
    var always = _self.checkFn(always) ? always : function() {};

    _self.indown = 0;

    _self.pelm = $elm;

    //opts
    _self.opts = $.extend({
        labelTip: "Slide to Unlock",
        successLabelTip: "Success",
        duration: 200,
        swipestart: false,
        min: 0,
        max: $elm.width(),
        index: 0,
        IsOk: false,
        lableIndex: 0,
        imgSliderUnlockTip: '',
        deviation: 4,
        img: '/images/wechat/logo.png',
        unlockimg: '/images/wechat/unlock_tip.png'
    }, options);

    _self.getSuccessLeft();
    _self.addHtml();
    //$elm
    _self.elm = $('#slider');

    //是否开始滑动
    _self.swipestart = _self.opts.swipestart;
    //最小值
    _self.min = _self.opts.min;
    //最大值
    _self.max = _self.opts.max;
    //当前滑动条所处的位置
    _self.index = _self.opts.index;
    //是否滑动成功
    _self.isOk = _self.opts.isOk;
    //鼠标在滑动按钮的位置
    _self.lableIndex = _self.opts.lableIndex;
    //success
    _self.success = success;
    //always
    _self.always = always;
    // init
    _self.init();
}

ImageSliderUnlock.prototype.getSuccessLeft = function(elm) {
    var successLeft = Math.random();
    successLeft = ((successLeft < 0.4) ? (successLeft + 0.5) : successLeft) * 250 - 40;
    this.opts.successLeft = successLeft;
};

// 检测元素是否存在
ImageSliderUnlock.prototype.checkElm = function(elm) {
    if ($(elm).length > 0) {
        return true;
    } else {
        throw "this element does not exist.";
    }
};

// 检测传入参数是否是对象
ImageSliderUnlock.prototype.checkObj = function(obj) {
    if (typeof obj === "object") {
        return true;
    } else {
        throw "the params is not a object.";
    }
};

// 检测传入参数是否是function
ImageSliderUnlock.prototype.checkFn = function(fn) {
    if (typeof fn === "function") {
        return true;
    } else {
        throw "the param is not a function.";
    }
};

//初始化
ImageSliderUnlock.prototype.init = function() {
    var _self = this;
    _self.elm.find("#label")
        .on("mousedown", function(event) {
            var e = event || window.event;
            _self.lableIndex = e.clientX - this.offsetLeft;
            _self.handerIn();
        }).on("mousemove", function(event) {
        _self.handerMove(event);
    }).on("mouseup", function(event) {
        _self.handerOut();
    }).on("touchstart", function(event) {
        var e = event || window.event;
        _self.lableIndex = e.originalEvent.touches[0].pageX - this.offsetLeft;
        _self.handerIn();
    }).on("touchmove", function(event) {
        _self.handerMove(event, "mobile");
    }).on("touchend", function(event) {
        _self.handerOut();
    });
    _self.pelm.find("#slide-img-success")
        .on("mousedown", function(event) {
            var e = event || window.event;
            _self.lableIndex = e.clientX - this.offsetLeft;
            _self.handerIn();
        }).on("mousemove", function(event) {
        _self.handerMove(event);
    }).on("mouseup", function(event) {
        _self.handerOut();
    }).on("touchstart", function(event) {
        var e = event || window.event;
        _self.lableIndex = e.originalEvent.touches[0].pageX - this.offsetLeft;
        _self.handerIn();
    }).on("touchmove", function(event) {
        _self.handerMove(event, "mobile");
    }).on("touchend", function(event) {
        _self.handerOut();
    });
    $(document).on("mousemove", function(event) {
        if (_self.indown == 1 && _self.swipestart) {
            _self.handerMove(event);
        }
    }).on("mouseup", function(event) {
        if (_self.indown == 1) {
            _self.handerOut();
        }
    });
};

// 鼠标/手指接触滑动按钮
ImageSliderUnlock.prototype.handerIn = function() {
    var _self = this;
    _self.indown = 1;
    _self.swipestart = true;
    _self.min = 0;
    _self.max = _self.elm.width() - 34;
};

// 鼠标/手指移出
ImageSliderUnlock.prototype.handerOut = function() {
    var _self = this;
    //停止
    _self.indown = 0;
    _self.swipestart = false;
    //_self.move();
    if (_self.index >= (_self.opts.successLeft - _self.opts.deviation) && _self.index <= (_self.opts.successLeft + _self.opts.deviation)) {
        _self.success();
    } else {
        _self.reset();
    }
};

//鼠标/手指移动
ImageSliderUnlock.prototype.handerMove = function(event, type) {
    var _self = this;
    if (_self.swipestart) {
        event.preventDefault();
        var event = event || window.event;
        if (type == "mobile") {
            _self.index = event.originalEvent.touches[0].pageX - _self.lableIndex;
        } else {
            _self.index = event.clientX - _self.lableIndex;
        }
        _self.move();
    }
};

//鼠标/手指移动过程
ImageSliderUnlock.prototype.move = function() {
    var _self = this;
    if ((_self.index + 0) >= _self.max) {
        _self.index = _self.max - 0;
        //停止
        _self.swipestart = false;
        //解锁
        _self.isOk = true;
    }
    if (_self.index < 0) {
        _self.index = _self.min;
        //未解锁
        _self.isOk = false;
    }
    _self.elm.find("#label").css("left", _self.index + "px")
    $("#slide-img-success").css("left", _self.index + "px")
    _self.always();
};

// 重置slide的起点
ImageSliderUnlock.prototype.reset = function(i) {
    var _self = this;

    _self.index = i || 8;
    _self.elm.find("#label").animate({
        left: _self.index
    }, _self.opts.duration);
    $("#slide-img-success").animate({
        left: _self.index
    }, _self.opts.duration);
};

// 更新视图
ImageSliderUnlock.prototype.updateView = function() {
    var _self = this;
};

ImageSliderUnlock.prototype.addHtml = function() {
    var _self = this;
    var html = '<div id="slide-bg"></div><div id="slide-wrapper"><input type="hidden" id="lockable"/><div id="slide-img-div"><img id="slide-img" src="' + _self.opts.img + '"/><div id="slide-img-position"></div><div id="slide-img-success" style="background-image:url(' + _self.opts.img + ')"></div><image id="slide-img-unlocktip" src="' + _self.opts.unlockimg + '"></image></div><div id="slider"><div id="slider-bg"></div><div id="label"><div class="label-circle"></div></div><div id="lableTip">' + _self.opts.labelTip + '</div></div><div id="imgSliderUnlockTip">' + _self.opts.imgSliderUnlockTip + '</div></div>';
    _self.pelm.html(html);
    $('#slide-bg').click(function() {
        _self.hideElm();
    });
};

ImageSliderUnlock.prototype.showElm = function() {
    var _self = this;
    _self.getSuccessLeft();
    _self.reset();
    $('#slide-img-position').css({
        'left': _self.opts.successLeft
    });
    $('#slide-img-success').css({
        'left': 0,
        'backgroundPositionX': (252 - _self.opts.successLeft) + 'px'
    })
    var _self = this;
    _self.pelm.show();
    _self.unlockTip();
};

ImageSliderUnlock.prototype.unlockTip = function() {
    $("#slide-img-unlocktip").show().animate({"left": this.index + "px"}, 0).animate({"left": this.opts.successLeft + "px"}, 1000).delay(100).hide(0);
};

ImageSliderUnlock.prototype.hideElm = function() {
    var _self = this;
    _self.pelm.hide();
    _self.reset(0);
};