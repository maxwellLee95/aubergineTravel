// 小提示 by xsl 20170909

/**
 * [showNotice 显示提示]
 * @return   string   nitive唯一ID
 * @Modify xsl 20170925 添加type3,移除jq依赖
 * arguments[
 *     '提示信息',
 *     '自动消失时间，<=0 为不自动消失',
 *     '提示类型(1:页面下方20%条形提示;2:右上角20px*20px loading图标提示;3:元素内添加20px*20px loading图标提示)',
 *     '类型3中需要添加loading的元素'
 * ]
 */
function showNotice() {
    if (arguments.length <= 0) {
        return false;
    }
    var ms = 300,
        t1, t2, t3, e,
        longShow = false,
        type = 1,
        elem = document.body,
        uniqueId = 'noticeCache' + (new Date()).getTime();

    if (arguments[1] > 0) {
        ms = arguments[1];
    } else {
        longShow = true;
    }
    if (arguments[2]) {
        type = arguments[2];
    }
    if (arguments[3]) {
        longShow = true;
        ms = 100;
    }
    if (arguments[4]) {
        if (isHtmlElem(arguments[4])) {
            elem = arguments[4];
        } else if (typeof arguments[4] == 'string') {
            elem = document.querySelector(arguments[4]);
        }
    }
    removeNotice(1);
    var h = '<div id="' + uniqueId + '" class="noticeCache" data-type="' + type + '" style="transition: opacity ' + ms + 'ms;-webkit-transition: opacity ' + ms + 'ms;-o-transition: opacity ' + ms + 'ms;opacity:0; ';
    if (type == 1) {
        elem.insertAdjacentHTML('beforeend', h + 'position:fixed;z-index:1000;width:80%;bottom:20%;left:10%;background-color:rgba(0, 0, 0, 0.6);color:#fff;text-align:center;padding:5px 8px;border-radius:5px;">' + arguments[0] + '</div>');
    } else if (type == 2) {
        elem.insertAdjacentHTML('beforeend', h + 'position:fixed;z-index:1000;width:20px;height:20px;top:10px;right:10px;background-color:rgba(0, 0, 0, 0);border-radius:50%;background-image:url(/images/wechat/loading2.gif);background-size:100% 100%;background-repeat:no-repeat;"></div>');
    } else if (type == 3) {
        elem.insertAdjacentHTML('beforeend', h + 'display:block;width:100%;height:20px;background-color:rgba(0, 0, 0, 0);border-radius:50%;background-image:url(/images/wechat/loading2.gif);background-size:20px 20px;background-repeat:no-repeat;background-position:center;"></div>');
    } else {
        elem.insertAdjacentHTML('beforeend', h + 'position:fixed;z-index:1000;width:80%;bottom:20%;left:10%;background-color:rgba(0, 0, 0, 0.6);color:#fff;text-align:center;padding:5px 8px;border-radius:5px;">' + arguments[0] + '</div>');
    }
    e = document.getElementById(uniqueId);
    t1 = setTimeout(function() {
        e.style.opacity = '1';
        clearTimeout(t1);
    }, 40);
    if (!longShow) {
        t2 = setTimeout(function() {
            e.style.opacity = '0';
            clearTimeout(t2);
            t3 = setTimeout(function() {
                e.remove();
                clearTimeout(t3);
            }, (ms + 100));
        }, (ms + 800));
    }
    return uniqueId;
}

/**
 * [removeNotice 移除提示]
 * @Author   XieShaoLi
 * arguments[
 *     '1：立即移除；2：渐隐',
 *     '指定移除ID，默认移除全部',
 * ]
 */
function removeNotice() {
    if (arguments[1]) {
        var e = document.getElementById(arguments[1]);
    } else {
        var e = document.querySelector('.noticeCache');
    }
    if (e) {
        if (arguments[0] == 1) {
            e.remove();
        } else {
            e.style.opacity = '0';
            var t3 = setTimeout(function() {
                e.remove();
                clearTimeout(t3);
            }, 200);
        }
    }
}

function isHtmlElem(elem) {
    var reg = /^\[object HTML\S*$/gi;
    var type = Object.prototype.toString.call(elem);
    if (reg.test(type)) {
        return elem;
    }
    return false;
};