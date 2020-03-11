/**
 * 2016-9-23 10:10:39
 */

/**
 * [loadingMsg loading信息修改]
 */
function loadingMsg(msg, hideImg, time) {
    if (msg == undefined) {
        msg = 'loadingMsg error: msg undefined';
        hideImg = true;
        time = 1000;
    }
    msg = msg.replace(/\n/g, "<br>");
    if (hideImg) {
        $('.loading-img').hide();
    } else {
        $('.loading-img').show();
    }
    $('.loading-msg').html(msg);
    $('#loading').show();
    if (!isNaN(time)) {
        hideLoading(time);
    }
}
/**
 * [hideLoading 隐藏loading]
 */
function hideLoading(time) {
    time = parseInt(time);
    if (isNaN(time)) {
        time = 1000;
    }
    setTimeout(function() {
        $('#loading').hide();
        $('.loading-img').show();
    }, time);
}
/**
 * [windowReload 刷新页面]
 */
function windowReload(time, url) {
    time = parseInt(time);
    if (isNaN(time)) {
        time = 1000;
    }
    setTimeout(function() {
        if ($.type(url) === "string") {
            window.location.href = url;
        } else {
            window.location.reload();
        }
    }, time);
}

/**
 * [textareaChange 修改所有textarea高度]
 */
function textareaChange(heightN, obj) {
    if (isNaN(heightN)) {
        heightN = 50;
    }
    if (obj != undefined && $.type(obj) == 'object') {
        obj[0].style.height = heightN + 'px';
        var scrollH = obj.prop('scrollHeight');
        if (scrollH > heightN) {
            obj[0].style.height = scrollH + 'px';
        }
    } else {
        $('textarea').each(function() {
            this.style.height = heightN + 'px';
            var scrollH = $(this).prop('scrollHeight');
            if (scrollH > heightN) {
                this.style.height = scrollH + 'px';
            }
        });
    }
}

/**
 * [checkNumAndFloat 检测正数]
 */
function checkNumAndFloat(number) {
    var regStr = /^\d+(\.\d+)?$/;
    return regStr.test(number);
}
/**
 * [checkZPlus 检测正整数]
 */
function checkZPlus(number) {
    var regStr = /^\d+$/;
    return regStr.test(number);
}
/**
 * [wechatLoadingChange 微信loading提示修改]
 */
function wechatLoadingChange(msg) {
    $('.loading').html(msg);
    $('#loading').show();
}
/**
 * [inArray 判断str是否在数组arr中]
 */
function inArray(str, arr) {
    if ($.type(arr) === "array") {
        for (var idx = 0; idx < arr.length; idx++) {
            if (str === arr[idx]) {
                return idx;
            }
        }
        return -1;
    } else {
        return -1;
    }
}