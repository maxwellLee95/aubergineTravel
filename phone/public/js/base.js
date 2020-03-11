/**
 * [windowReload 刷新页面]
 */
function windowReload(time, url) {
    time = parseInt(time);
    if (isNaN(time)) {
        time = 1000;
    }
    setTimeout(function() {
        if ( $.type(url) === "string" ) {
            window.location.href = url;
        } else {
            window.location.reload();
        }
    }, time);
};

function updateUrl(url, key) {
    var url = url || window.location.href;
    var key = (key || 'reloadt') + '=';
    var reg = new RegExp(key + '[0-9]+');
    var timestamp = +new Date();
    if (url.indexOf(key) > -1) { //有时间戳，直接更新
        return url.replace(reg, key + timestamp);
    } else { //没有时间戳，加上时间戳
        if (url.indexOf('\?') > -1) {
            var urlArr = url.split('\?');
            if (urlArr[1]) {
                return urlArr[0] + '?' + key + timestamp + '&' + urlArr[1];
            } else {
                return urlArr[0] + '?' + key + timestamp;
            }
        } else {
            if (url.indexOf('#') > -1) {
                return url.split('#')[0] + '?' + key + timestamp + location.hash;
            } else {
                return url + '?' + key + timestamp;
            }
        }
    }
}