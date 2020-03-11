var intervalTimes = [];
$.fn.extend({
    //启动计时器
    setTimeInterval:function( options ){
        var element = $(this);
        var stopDate = options.stopTime;
        var minTime = options.minTime;
        var showType = options.showType;
        if( showType == undefined ){
            showType = 1;
        }
        var speedTime = "";
        //配置默认项
        if( options.minTime == undefined ){
            minTime = "secs";
        }
        //指定调用时间，按照最小显示时间规定
        if( minTime == "secs" ){
            speedTime = 1000;
        }else if( minTime == "msec" ){
            speedTime = 100;
        }else if( minTime == "min" ){
            speedTime = 60000;
        }
        //将时间转换为时间戳
        //IOS上Date对象不能直接传入时间字符串，会变成无效时间
        var stopArr = stopDate.split(/[- : \/]/);
        var stopDateObj = new Date(stopArr[0], stopArr[1]-1, stopArr[2], stopArr[3], stopArr[4], stopArr[5]);
        var stopTime = Date.parse( stopDateObj );
        var currentTime = Date.parse( new Date() ); //当前时间戳
        var surplusTime = stopTime - currentTime; //剩余时间戳
        var timeInterval = setInterval( function(){
            if( surplusTime > 0 ){
                surplusTime -= speedTime;
                if( showType == 1 ){
                    var changeHtml = element.changeSurplusTime( surplusTime, element, minTime );
                    element.html( changeHtml );
                }else{
                    if( options.eachCallBack != undefined ){
                        var surplusTimeObj = element.getSurplusTimeInfo( surplusTime );
                        options.eachCallBack( surplusTimeObj, element, minTime );
                    }
                }
            }else{
                clearInterval( timeInterval );
                if( options.overTimeCallBack != undefined ){
                    options.overTimeCallBack(element);
                }
            }
        }, speedTime );
        intervalTimes.push( timeInterval );
    },
    //修改倒计时值
    changeSurplusTime:function( parseIntTime, element, minTime ){
        if( element == undefined ){
            element = $(this);
        }
        var surplusTimeObj = element.getSurplusTimeInfo( parseIntTime );
        //赋显示值，先判断有几位小数，循环拼接输出HTML并输出
        //天数
        var dayStr = surplusTimeObj['day'].toString();
        var dayHtml = '';
        dayHtml += '<span class="time-day">';
        for( var i=0; i<dayStr.length; i++ ){
            dayHtml += '<span class="time-num">'+ dayStr[i] +'</span>';
        }
        dayHtml += '<span class="time-font">天</span>';
        dayHtml += '</span>';
        //小时
        var hourStr = surplusTimeObj['hour'].toString();
        var hourHtml = '';
        hourHtml += '<span class="time-hour">';
        if( hourStr.length == 1 ){
            hourHtml += '<span class="time-num">0</span>';
        }
        for( var i=0; i<hourStr.length; i++ ){
            hourHtml += '<span class="time-num">'+ hourStr[i] +'</span>';
        }
        hourHtml += '<span class="time-font">小时</span>';
        hourHtml += '</span>';
        //分钟
        var minuteStr = surplusTimeObj['minute'].toString();
        var minuteHtml = '';
        minuteHtml += '<span class="time-minute">';
        if( minuteStr.length == 1 ){
            minuteHtml += '<span class="time-num">0</span>';
        }
        for( var i=0; i<minuteStr.length; i++ ){
            minuteHtml += '<span class="time-num">'+ minuteStr[i] +'</span>';
        }
        minuteHtml += '<span class="time-font">分</span>';
        minuteHtml += '</span>';
        if( minTime == "secs" || minTime == "msec" ){
            //秒数
            var secondStr = surplusTimeObj['second'].toString();
            var secondHtml = '';
            secondHtml += '<span class="time-minute">';
            if( secondStr.length == 1 ){
                secondHtml += '<span class="time-num">0</span>';
            }
            for( var i=0; i<secondStr.length; i++ ){
                secondHtml += '<span class="time-num">'+ secondStr[i] +'</span>';
            }
            if( minTime == "msec" ){
                //毫秒
                var millisecond = surplusTimeObj['millisecond'].toString();
                secondHtml += '<span class="mini-point">.</span>';
                secondHtml += '<span class="mini-time">'+ millisecond +'</span>';
            }
            secondHtml += '<span class="time-font">秒</span>';
            secondHtml += '</span>';
        }

        //输入最终拼接的HTML
        var resultHtml = '';
        if( surplusTimeObj['day'] > 0 ){
            resultHtml += dayHtml + hourHtml + minuteHtml;
        }else{
            resultHtml += hourHtml + minuteHtml;
        }
        if( minTime == "secs" || minTime == "msec" ){
            resultHtml += secondHtml;
            if( minTime == "msec" ){

            }
        }
        return resultHtml;
    },
    //获取剩余天数、小时、分钟以及秒数
    getSurplusTimeInfo:function( parseIntTime ){
        var newParseIntTime = parseIntTime / 1000;
        var returnObj = {};
        returnObj['day']         = Math.floor(newParseIntTime / (60 * 60 * 24));
        returnObj['hour']        = Math.floor(newParseIntTime / (3600)) - (returnObj['day'] * 24);
        returnObj['minute']      = Math.floor(newParseIntTime / (60)) - (returnObj['day'] * 24 * 60) - (returnObj['hour'] * 60);
        returnObj['second']      = Math.floor(newParseIntTime) - (returnObj['day'] * 24 * 60 * 60) - (returnObj['hour'] * 60 * 60) - (returnObj['minute'] * 60);
        returnObj['millisecond'] = ( Math.floor(parseIntTime) - (returnObj['day'] * 24 * 60 * 60 * 1000) - (returnObj['hour'] * 60 * 60 * 1000) - (returnObj['minute'] * 60 * 1000) - (returnObj['second'] * 1000) ) / 100;
        return returnObj;
    }
});