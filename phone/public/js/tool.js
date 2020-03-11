/**
 * 转化缩略图为正常图
 *
 * @param url
 */
function tranThumb2Normal(url) {
    if (url.lastIndexOf("_thumb.") < 0) {
        return url;
    }

    return url.replace("_thumb.", ".");
}

function checkUrlHost(url) {
    if (url.indexOf("http://") == 0) {
        return url;
    }

    return "http://www.36hiker.com" + url; // hard code
}

function str2asc(strstr) {
    return ("0" + strstr.charCodeAt(0).toString(16)).slice(-2);
}

function asc2str(ascasc) {
    return String.fromCharCode(ascasc);
}

function urlEncode(str) {
    var ret = "";
    var strSpecial = "!\"#$%&'()*+,/:;<=>?[]^`{|}~%";
    var tt = "";

    for (var i = 0; i < str.length; i++) {
        var chr = str.charAt(i);
        var c = str2asc(chr);
        tt += chr + ":" + c + "n";
        if (parseInt("0x" + c) > 0x7f) {
            ret += "%" + c.slice(0, 2) + "%" + c.slice(-2);
        } else {
            if (chr == " ")
                ret += "+";
            else if (strSpecial.indexOf(chr) != -1)
                ret += "%" + c.toString(16);
            else
                ret += chr;
        }
    }
    return ret;
}

function urlDecode(str) {
    var ret = "";
    for (var i = 0; i < str.length; i++) {
        var chr = str.charAt(i);
        if (chr == "+") {
            ret += " ";
        } else if (chr == "%") {
            var asc = str.substring(i + 1, i + 3);
            if (parseInt("0x" + asc) > 0x7f) {
                ret += asc2str(parseInt("0x" + asc
                    + str.substring(i + 4, i + 6)));
                i += 5;
            } else {
                ret += asc2str(parseInt("0x" + asc));
                i += 2;
            }
        } else {
            ret += chr;
        }
    }
    return ret;
}


/**
 * [remove 删除数据元素]
 * @Author   Jason
 * @DateTime 2015-12-24T15:49:18+0800
 * @param    {[type]}                 val [description]
 * @return   {[type]}                     [description]
 */
Array.prototype.remove = function(val) {
    var index = this.indexOf(val);
    if (index > -1) {
        this.splice(index, 1);
    }
};

/**
 * [scrollTo 页面滚动指定高度]
 * @Author   XieShaoLi
 * @DateTime 2016-07-12
 */
function scrollTo( h, s ){
    if (isNaN(s)) {
        s = 400;
    }
    $("body,html").animate({
        scrollTop:h
    },s);
}