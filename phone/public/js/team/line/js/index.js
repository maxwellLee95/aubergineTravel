//获取头部banner图
var bottomSwiper="";
var index_page=urlParams.params.page;
var save_page =0;//总页数

//一开始请求数据
// loadingMsg('正在获取房型数据...');
if(index_page==undefined){
    index_page=1;
}
var topSwiper = new Swiper('.swiper-container-top', {
    prevButton:'.swiper-button-prev',
    nextButton:'.swiper-button-next',
})
// 精选产品的html代码拼接
getlistHTML();
function getlistHTML(){
    $.ajax({
        type: 'POST',
        url: '/team/line/getList',
        dataType: 'json',
        data: {page: index_page},
        context: $('body'),
        success: function(listData) {
            hide_loading();
            isGettingPage = false;
            // hideLoading(0);
            // console.log(listData);
            // console.log(listData.errmsg);
            // console.log(listData.data.total_pages);
            if(listData.errcode==0){
                console.log(listData.data);
                index_page++;
                save_page=listData.data.total_pages;
                for(var i in listData.data.items){
                    var count=1;
                    var nameFlag = -1;
                    // console.log(listData.data.items[i]);
                    var productHTML="";
                    for(var o in listData.data.items[i].list){
                        productHTML="";
                        if(nameFlag!=i){
                            productHTML+='<div class="product_title">'+listData.data.items[i].name+'</div>';
                            nameFlag =i;
                        }
                        productHTML+='<a href="'+listData.data.items[i].list[o].url+'" class="product">';
                        productHTML+='<div class="product_banner">';
                        productHTML+='  <div class="product_img">';
                        productHTML+='      <div class="img_shadow"></div>';
                        productHTML+='      <div class="img_photo" style="background: url('+listData.data.items[i].list[o].banner+') no-repeat;background-size:cover;background-position: center;"></div>';
                        productHTML+='      <div class="info_img_text">';
                        productHTML+='      <span>'+listData.data.items[i].list[o].days+'天</span>';
                        productHTML+='      </div>';
                        // }
                        productHTML+='  </div>';
                        productHTML+='  <div class="product_text">';
                        productHTML+='      <p>'+listData.data.items[i].list[o].title+'</p>';
                        productHTML+='      <span class="text1">￥'+listData.data.items[i].list[o].money/100+'/人起</span>';
                        productHTML+='      <span class="text2"><span>'+listData.data.items[i].list[o].place+'</span></span>';
                        productHTML+='  </div>';
                        productHTML+='</div>';
                        productHTML+='<div class="product_info">';
                        for(var j in listData.data.items[i].list[o].highlights){
                            productHTML+='      <div class="product_main">';
                            productHTML+='          <div class="info_text">';
                            productHTML+='              <span class="info_text_title">';
                            productHTML+='                  <div class="point"></div>';
                            productHTML+='                  <span class="info_title">'+listData.data.items[i].list[o].highlights[j].title+'</span>';
                            productHTML+='              </span>';
                            productHTML+='              <span class="info_text_content">'+listData.data.items[i].list[o].highlights[j].highlight+'</span>';
                            productHTML+='          </div>';
                            productHTML+='          <div class="info_img" style="background: url('+listData.data.items[i].list[o].highlights[j].img+') no-repeat;background-size: cover;background-position: center;">';
                            productHTML+='          </div>';
                            productHTML+='          <div class="clear"></div>';
                            productHTML+='      </div>';
                        }
                        productHTML+='</div>'
                        productHTML+='<div class="showmore"><div style="width:90px; margin:0 auto">查看详情<div class="show_icon"></div></div></div>';
                        document.getElementsByClassName("container")[0].innerHTML+=productHTML;
                    }
                }
            }else{
                popLayer({
                    title: '错误',
                    btnsName: '确定',
                    btnsCallback: 'closePopLayer()',
                    content: listData.errmsg,
                })
            }
        },
        error: function() {
            // hideLoading(0);
            hide_loading();
            isGettingPage = false;
            popLayer({
                title: '错误',
                btnsName: '确定',
                btnsCallback: 'closePopLayer()',
                content: 'ajax error',
            })
        }
    });
}
var isGettingPage = false;
var flag=1;//请求最底部二维码 防止多次请求
// 滚动事件监听
window.addEventListener('scroll', onScroll, false);
//乱序数组
function shuffle(a) {
    var len = a.length;
    for (var i = 0; i < len - 1; i++) {
        var index = parseInt(Math.random() * (len - i));
        var temp = a[index];
        a[index] = a[len - i - 1];
        a[len - i - 1] = temp;
    }
}
function onScroll() {
    if(index_page>save_page&&flag==1){
        document.getElementsByClassName("bottom")[0].style.display='block';
        document.getElementsByClassName("business_container")[0].style.display='block';
        flag=0;
        document.getElementsByClassName("bottom")[0].style.display="block"
        //获取底部二维码
        bottomSwiper = new Swiper('.swiper-container-bottom', {
            prevButton:'.swiper-button-prev',
            nextButton:'.swiper-button-next',
        })
        $.ajax({
            type: 'POST',
            url: '/team/line/getListQrcode',
            dataType: 'json',
            data: {},
            context: $('body'),
            success: function(qrcodeData) {
                if(qrcodeData.errcode==0){
                    var qrcodeDataArray = new Array();
                    qrcodeDataArray = qrcodeData.data.qrcodes;
                    // shuffle(qrcodeDataArray);
                    console.log(qrcodeDataArray);
                    var businessHTML=qrcodeData.data.serviceDesc;
                    for(var i in qrcodeDataArray){
                        var qrHTML="";
                        qrHTML+='<div class="leader-info">';
                        qrHTML+='   <div class="leader-info-header-container">';
                        qrHTML+='       <div class="leader-info-header-img" style="background: url('+qrcodeDataArray[i].headImgUrl+') no-repeat;background-size: cover;"></div>';
                        qrHTML+='       <div>';
                        qrHTML+='           <div style="display: flex;">';
                        qrHTML+='               <span style="font-size:18px;margin-right: 1px;">'+qrcodeDataArray[i].name+'</span>';
                        if(qrcodeDataArray[i].sex==1){
                            qrHTML+='               <div class="leader_info_text_sexMan">';
                        }else{
                            qrHTML+='               <div class="leader_info_text_sexWoman">';
                        }
                        qrHTML+='               </div>';
                        qrHTML+='           </div>';
                        qrHTML+='           <p style="font-size: 13px;">团建策划师-'+qrcodeDataArray[i].city+'</p>';
                        qrHTML+='       </div>';
                        qrHTML+='   </div>';
                        qrHTML+='   <div class="qrcode_container">';
                        qrHTML+='       <div class="qrcode_img">';
                        qrHTML+='       <img src="'+qrcodeDataArray[i].qrcode+'" width="67%;" style="padding: 13% 16%;margin-top: 4%;">';
                        qrHTML+='       </div>';
                        qrHTML+='   </div>';
                        qrHTML+='   <div class="leader_info_text">';
                        qrHTML+='       <div style="display: flex;padding:2% 0;align-items: center;">';
                        qrHTML+='           <div class="leader_info_text_tel">';
                        qrHTML+='           </div>';
                        qrHTML+='           <span style="font-size: 12px;">&nbsp;Tel: <a href="tel:'+qrcodeDataArray[i].tel+'" style="color:#333;text-decoration: underline;">'+qrcodeDataArray[i].tel+'</a></span>';
                        qrHTML+='       </div>';
                        qrHTML+='       <div style="display: flex;padding:2% 0;align-items: center;">';
                        qrHTML+='           <div class="leader_info_text_email">';
                        qrHTML+='           </div>';
                        qrHTML+='           <span style="font-size: 12px;">&nbsp;E-mail: '+qrcodeDataArray[i].email+'</span>';
                        qrHTML+='       </div>';
                        qrHTML+='   </div>';
                        qrHTML+='   <div class="leader-info-banner">';
                        qrHTML+='   </div>';
                        qrHTML+='</div>';
                        bottomSwiper.appendSlide('<div class="swiper-slide">'+qrHTML+'</div>');
                    }
                    document.getElementsByClassName("business_container")[0].innerHTML+=businessHTML;
                }else{
                    popLayer({
                        title: '错误',
                        btnsName: '确定',
                        btnsCallback: 'closePopLayer()',
                        content: qrcodeData.errmsg,
                    })
                }
            },
            error:function(){
                popLayer({
                    title: '错误',
                    btnsName: '确定',
                    btnsCallback: 'closePopLayer()',
                    content: 'ajax error',
                })
            },
        })
    }
    if(isGettingPage){
        return false;
    }
    getPageAjax();
}
// setInterval("getPageAjax()",300);
//分页请求
function getPageAjax(){
    if(document.getElementsByClassName("product").length!=0){
        if(document.getElementsByClassName("product")[document.getElementsByClassName("product").length-1].offsetTop<document.documentElement.clientHeight+document.body.scrollTop&&index_page<=save_page){
            isGettingPage = true;
            show_loading();
            getlistHTML();
        }
    }
}
function show_loading(){
    document.getElementById("getLoading").style.display="block";
}
function hide_loading(){
    document.getElementById("getLoading").style.display="none";
}
//滑动的注册表


var hasVideo = false;
var videoUrl ="";
$.ajax({
    type: 'POST',
    url: '/team/line/getindextop',
    dataType: 'json',
    data: {},
    context: $('body'),
    success: function(indexdata) {
        if(indexdata.errcode==0){
            var topBannerHTML="";
            var topCircleHTML="";
            var topIconHtml="";
            for(var i in indexdata.data.banners){
                console.log(indexdata.data.banners[i].data_type);
                if(indexdata.data.banners[i].data_type==2||indexdata.data.banners[i].data_type==3){
                    hasVideo = true;
                    break;
                }
            }
            console.log(hasVideo);
            if(hasVideo){
                console.log(233);
                for(var i in indexdata.data.banners){
                    topBannerHTML="";
                    if(indexdata.data.banners[i].data_type==2){
                        topBannerHTML+='<div class="top_container" style="background-image: url('+indexdata.data.banners[i].img+')"; onclick="startVideo()">';
                        topBannerHTML+='</div>';
                        topBannerHTML+='<video id="media" src="'+indexdata.data.banners[i].url+'"  width="1" class="videoBefore" x5-video-player-type="h5" x5-video-player-fullscreen="true" preload="auto"">';
                        topBannerHTML+='</video>';
                        document.getElementById("header").insertAdjacentHTML('afterBegin',topBannerHTML);
                        break;
                    }
                    if(indexdata.data.banners[i].data_type==3){
                        videoUrl = indexdata.data.banners[i].url;
                        topBannerHTML+='<div class="top_container" style="background-image: url('+indexdata.data.banners[i].img+')"; onclick="startModVideo()">';
                        topBannerHTML+='</div>';
                        // topBannerHTML+='<iframe frameborder="0" width="375" height="291.79" src="'+indexdata.data.banners[i].url+'" allowfullscreen id="media" class="videoBefore" name="media">';
                        // topBannerHTML+='</iframe>';
                        // topBannerHTML+='<div class="detail-con clear mod_video_before" id="mod_video">';
                        // topBannerHTML+='    <div id="mod_player_wrap" class="mod_player_wrap">';
                        // topBannerHTML+='        <div class="mod_inner">';
                        // topBannerHTML+='            <div id="mod_inner" class="mod_player_section center mod_independent">';
                        // topBannerHTML+='                <div>';
                        // topBannerHTML+='                    <div id="mod_player" class="mod_player">';
                        // topBannerHTML+='                    <div id="mod_player_skin">&nbsp;</div>';
                        // topBannerHTML+='                        <script language="javascript" src="http://qzs.qq.com/tencentvideo_v1/js/tvp/tvp.player.js" charset="utf-8"></script>';
                        // topBannerHTML+='                        <script language="javascript">';
                        // topBannerHTML+='                        var video = new tvp.VideoInfo();';
                        // topBannerHTML+='                        video.setVid("b0148kpc044");';
                        // topBannerHTML+='                        var player = new tvp.Player("100%", "100%");';
                        // topBannerHTML+='                        player.setCurVideo(video);';
                        // topBannerHTML+='                        player.addParam("autoplay","0");';
                        // topBannerHTML+='                        player.addParam("wmode","transparent");';
                        // topBannerHTML+='                        player.write("mod_player_skin");';
                        // topBannerHTML+='                        </script>';
                        // topBannerHTML+='                    </div>';
                        // topBannerHTML+='                </div>';
                        // topBannerHTML+='            </div>';
                        // topBannerHTML+='        </div>';
                        // topBannerHTML+='    </div>';
                        // topBannerHTML+='</div>';
                        document.getElementById("header").insertAdjacentHTML('afterBegin',topBannerHTML);
                        break;
                    }
                }

            }else{
                for(var i in indexdata.data.banners){
                    topBannerHTML="";
                    // if(indexdata.data.banners[i].data_type!=2){
                    topBannerHTML+='<a href='+indexdata.data.banners[i].url+' class="top_container" style="background-image: url('+indexdata.data.banners[i].img+');">';
                    topBannerHTML+='</a>';
                    // }
                    // else{
                    // topBannerHTML+='<div class="top_container" data-url="'+indexdata.data.banners[i].url+'" style="background-image: url('+indexdata.data.banners[i].img+')"; onclick="startVideo(this)">';
                    // topBannerHTML+='</div>';
                    // }
                    topSwiper.appendSlide('<div class="swiper-slide">'+topBannerHTML+'</div>');
                }
            }
            for(var j in indexdata.data.features){
                topCircleHTML+= '<span class="top_circle_icon" style="background-image: url('+indexdata.data.features[j].img+');">';
                topCircleHTML+= '</span>';
            }
            for(var k in indexdata.data.navs){
                topIconHtml+='<a class="top_icon" href="'+indexdata.data.navs[k].url+'" style="background-image:url('+indexdata.data.navs[k].img+')">';
                // topIconHtml+='    <div class="top_iconDiv" style="background-image:url('+indexdata.data.navs[k].img+')"></div>';
                // topIconHtml+='    <p class="top_icon_text">'+indexdata.data.navs[k].name+'</p>';
                topIconHtml+='</a>';
            }
            // document.getElementsByClassName("top_circle_list")[0].innerHTML+=topBannerHTML;
            document.getElementsByClassName("top_circle_list")[0].innerHTML+=topCircleHTML;
            document.getElementsByClassName("top_icon_list")[0].innerHTML+=topIconHtml;
        }else{
            popLayer({
                title: '错误',
                btnsName: '确定',
                btnsCallback: 'closePopLayer()',
                content: listData.errmsg,
            })
        }
    },
    error: function(){
        popLayer({
            title: '错误',
            btnsName: '确定',
            btnsCallback: 'closePopLayer()',
            content: 'ajax error',
        })
    }
})



// $("#top_text_container").on('click',function(){
//     // console.log(233);
//     var videoObj = document.getElementById("video");
//     $("#video").removeClass('videoBefore')
//     videoObj.play();
//     $("#video").addClass('videoAfter')
// })
// $("#top_container").on('click',function(){
//     // console.log(233);
//     var videoObj = document.getElementById("video");
//     $("#video").removeClass('videoBefore')
//     videoObj.play();
//     $("#video").addClass('videoAfter')
// })
// $("#video").on('click',function(){
//     var videoObj = document.getElementById("video");
//     if(videoObj.paused){
//         videoObj.play();
//     }else{
//         videoObj.pause();
//     }
// })
function startVideo(){
    var videoObj = document.getElementById('media');
    // if(videoObj.ended){
    //     console.log(233);
    // }
    var eventTester = function(e){
        // 触发事件时的动作
        videoObj.addEventListener(e,function(){
            console.log(233);
            $(".top_circle_list").removeClass('zIndexToMinus');
        },false);
    }
    var eventTesterPlay = function(e){
        // 触发事件时的动作
        videoObj.addEventListener(e,function(){
            console.log(233);
            $(".top_circle_list").addClass('zIndexToMinus');
        },false);
    }
    var eventTester_3 = function(e){
        // 触发事件时的动作
        videoObj.addEventListener(e,function(){
            document.getElementsByClassName("top_container")[0].style.display="block";
            $("#media").addClass('videoBefore');
            $("#media").removeClass('videoAfter');
            document.getElementsByClassName("top_circle_list")[0].style.marginTop="-6.5%";
        },false);
    }
    eventTester("ended");
    eventTester("pause");
    eventTester_3("ended");
    document.getElementsByClassName("top_container")[0].style.display="none";
    document.getElementsByClassName("top_circle_list")[0].style.marginTop="0.5%";
    $("#media").addClass('videoAfter');
    $("#media").removeClass('videoBefore');
    videoObj.play();
}
function startModVideo(){
    console.log(videoUrl.split("vid=")[1].split("&")[0]);
    var video = new tvp.VideoInfo();
    video.setVid(videoUrl.split("vid=")[1].split("&")[0]);
    var player = new tvp.Player('100%', '100%');
    player.setCurVideo(video);
    // player.addParam("autoplay","0");
    player.addParam("wmode","transparent");
    player.write("mod_player_skin");
    document.getElementById("tenvideo_video_player_0").play();
    document.getElementsByClassName("top_container")[0].style.display="none";
    document.getElementsByClassName("top_circle_list")[0].style.marginTop="0.5%";
    var videoObj = document.getElementById('tenvideo_video_player_0');
    var eventTester = function(e){
        // 触发事件时的动作
        videoObj.addEventListener(e,function(){
            document.getElementsByClassName("top_container")[0].style.display="block";
            $("#mod_video").addClass('mod_video_before');
            $("#mod_video").removeClass('mod_video_after');
            document.getElementsByClassName("top_circle_list")[0].style.marginTop="-6.5%";
        },false);
    }
    eventTester("ended");
    $("#mod_video").addClass('mod_video_after');
    $("#mod_video").removeClass('mod_video_before');
}