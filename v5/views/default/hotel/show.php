<!doctype html>
<html>
<head>
<meta charset="utf-8">
    <title>{$seoinfo['seotitle']}-{$GLOBALS['cfg_webname']}</title>
    {if $seoinfo['keyword']}
    <meta name="keywords" content="{$seoinfo['keyword']}" />
    {/if}
    {if $seoinfo['description']}
    <meta name="description" content="{$seoinfo['description']}" />
    {/if}
    {include "pub/varname"}
    {Common::css('hotel.css,base.css,extend.css,calendar.css')}
    {Common::js('jquery.min.js,base.js,common.js,SuperSlide.min.js,template.js')}

<script>
	$(function(){
		$(".hpic-slide").slide({mainCell:".bd ul",delayTime:0,trigger:"click"});
	})
</script>
</head>

<body>

{request "pub/header"}

  <div class="big">
  	<div class="wm-1200">
    
    	<div class="st-guide">
            <a href="{$cmsurl}">{$GLOBALS['cfg_indexname']}</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<a href="/hotels/">{$channelname}</a>&gt;&nbsp;&nbsp;
            {loop $predest $dest}
            <a href="/hotels/{$dest['pinyin']}/">{$dest['kindname']}</a>
            {/loop}
        </div><!--面包屑-->
      
      <div class="st-main-page">
      	<div class="st-hotel-show">
        	<div class="hotelshow-tw">
            <div class="focus-slide">
              <div class="imgnav" id="imgnav"> 
                <div id="img">
                    {loop $info['piclist'] $pic}
                     <img src="{Common::img($pic[0],460,325)}" width="460" height="325"/>
                    {/loop}

                  <div id="front" title="上一张"><a href="javaScript:void(0)" class="pngFix"></a></div>
                  <div id="next" title="下一张"><a href="javaScript:void(0)" class="pngFix"></a></div>
                </div>
                <div id="cbtn">
                  <i class="picSildeLeft"><img src="{$GLOBALS['cfg_public_url']}images/picSlideLeft.gif"/></i>
                  <i class="picSildeRight"><img src="{$GLOBALS['cfg_public_url']}images/picSlideRight.gif"/></i>
                  <div id="cSlideUl">
                    <ul>
                        {loop $info['piclist'] $pic}
                            <li><img src="{Common::img($pic[0],460,325)}"/></li>
                        {/loop}
                    </ul>
                  </div>
                </div>         
              
              </div>
            </div>
            <div class="cp-show-msg">
            	<div class="hs-title">
              	<h1>
                    {$info['title']}
                    {loop $info['iconlist'] $icon}
                    <img src="{$icon['litpic']}" />
                    {/loop}
                </h1>
                <p>{$info['address']}</p>
              </div>
              <div class="price">
                  {if !empty($info['price'])}
                    <span><i class="currency_sy">{Currency_Tool::symbol()}</i><b>{$info['price']}</b>起</span>
                  {else}
                    <span>电询</span>
                  {/if}
              </div>
              <div class="sl">
              	<span>销量：{$info['sellnum']}</span><s>|</s><span>满意度：5.0</span><s>|</s><span>推荐：{$info['recommendnum']}</span>
              </div>
              <ul class="msg-ul">
              	<li><em>酒店星级：</em><p>{$info['hotelrank']}</p></li>
                <li><em>开业时间：</em><p>{$info['opentime']}</p></li>
                <li><em>装修时间：</em><p>{$info['decoratetime']}</p></li>
                <li><em>酒店电话：</em><p>{$info['telephone']}</p></li>
                <li class="mb_0"><em>付款方式：</em>
                    <p>
                        {if in_array(1,$paytypeArr)}
                        <img src="{$GLOBALS['cfg_public_url']}images/pay_zfb.gif" />
                        {/if}
                        {if in_array(2,$paytypeArr)}
                        <img src="{$GLOBALS['cfg_public_url']}images/pay_kq.gif" />
                        {/if}
                        {if in_array(3,$paytypeArr)}
                        <img src="{$GLOBALS['cfg_public_url']}images/pay_hc.gif" />
                        {/if}
                        {if in_array(4,$paytypeArr)}
                        <img src="{$GLOBALS['cfg_public_url']}images/pay_yl.gif" />
                        {/if}
                        {if in_array(5,$paytypeArr)}
                        <img src="{$GLOBALS['cfg_public_url']}images/pay_qb.gif" />
                        {/if}
                        {if in_array(7,$paytypeArr)}
                        <img src="{$GLOBALS['cfg_public_url']}images/pay_bb.gif" />
                        {/if}
                        {if in_array(8,$paytypeArr)}
                        <img src="{$GLOBALS['cfg_public_url']}images/pay_wx.gif" />
                        {/if}
                    </p>
                </li>
              </ul>	
            </div>
          </div>
          <div class="hotelshow-con">
          	<div class="tabnav-list">
            	<span class="on">房型</span>
                {st:detailcontent action="get_content" pc="1" typeid="$typeid" productinfo="$info" return="hotelcontent"}
                    {loop $hotelcontent $row}
                    <span>{$row['chinesename']}</span>
                    {/loop}
                {/st}
            	<span>客户评价</span>
            	<span>我要咨询</span>
            </div><!--酒店导航-->
            <div class="tabbox-list">
            	
                <div class="tabcon-list">
                  <div class="roomtype-con">
                	<table width="100%" border="0">
                    <tr class="room-attr">
                      <th width="213" height="40" scope="col"><span class="pl20">房型</span></th>
                      <th width="100" scope="col">床型</th>
                      <th width="100" scope="col">餐标</th>
                      <th width="100" scope="col">宽带</th>
                      <th width="100" scope="col">原价</th>
                      <th width="100" scope="col">优惠价</th>
                      <th width="150" scope="col">&nbsp;</th>
                    </tr>
                    {st:hotel action="suit" row="10" productid="$info['id']" return="roomlist"}
                       {loop $roomlist $room}
                        <tr  data-more="more_{$room['id']}">
                          <td height="40" class="room" style="cursor: pointer"><strong class="type-tit">{$room['title']}</strong>{if !empty($room['piclist'])}<i class="pic-ico"></i>{/if}</td>
                          <td align="center"><span>{$room['roomstyle']}</span></td>
                          <td align="center"><span>{$room['breakfirst']}</span></td>
                          <td align="center"><span>{$room['computer']}</span></td>
                          <td align="center"><span>{if $room['sellprice']}<i class="currency_sy">{Currency_Tool::symbol()}</i>{$room['sellprice']}{/if}</span></td>
                          <td align="center"><span class="yh">{if $room['price']}<i class="currency_sy">{Currency_Tool::symbol()}</i>{$room['price']}{/if}</span></td>
                          <td><a class="booking-btn" href="/hotels/book?suitid={$room['id']}&hotelid={$info['id']}">预订</a></td>
                        </tr>
                        <tr style="display: none">
                            <td height="40" colspan="7">
                            <div class="roomtype-sheshi">
                               {if count($room['piclist'])>0}
                                <div class="images-con">
                                <img class="show-pic" src="{$room['piclist'][0][0]}" />
                                <span class="ck"><em>查看全部{count($room['piclist'])}张图片</em></span>
                                 </div>
                               {/if}
                              <ul class="type-attr">
                                <li>面积：{$room['roomarea']}平方米</li>
                                <li>楼层：{$room['roomfloor']}层</li>
                                <li>房间：{$room['number']}间</li>
                                <li>窗户：{$room['window']}</li>
                                <li>宽带：{$room['computer']}</li>
                              </ul>
                              <div class="pic-fixed-box" style=" display:none">
                                <div class="zoom-images-box">

                                  <div id="hpic-slide" class="hpic-slide">
                                    <div class="bd">
                                        <h3>{$room['title']}</h3>
                                      <ul>
                                       {loop $room['piclist'] $pic}
                                        <li><img src="{Common::img($pic[0],456,330)}" /></li>
                                       {/loop}

                                      </ul>
                                      <a class="prev" href="javascript:void(0)"></a>
                                      <a class="next" href="javascript:void(0)"></a>
                                    </div>
                                    <div class="hd">
                                        <div class="hp-closed"><span></span></div>
                                      <ul>
                                          {loop $room['piclist'] $pic}
                                          <li><img src="{Common::img($pic[0],110,74)}" /></li>
                                          {/loop}

                                      </ul>
                                    </div>

                                  </div>

                                </div>
                              </div>
                            </div>
                          </td>
                        </tr>
                       {/loop}
                    {/st}

                  </table>
                </div>
                </div>
                {loop $hotelcontent $hotel}
            	    <div class="tabcon-list">
              	<div class="list-tit"><strong>{$hotel['chinesename']}</strong></div>
                <div class="list-txt">
                    {$hotel['content']}
                </div>
              </div>
                {/loop}
                {include "pub/comment"}
                {include "pub/ask"}
              
            </div>
          </div>
        </div><!--详情主体-->
        <div class="st-sidebox">
            {st:right action="get" typeid="$typeid" data="$templetdata" pagename="show"}
        </div><!--边栏模块-->
      </div>
    
    </div>
  </div>

{request "pub/footer"}

{request "pub/flink"}
{Common::js('floatmenu/floatmenu.js')}
{Common::js('SuperSlide.min.js,template.js,scorll.img.js')}
{Common::css('/res/js/floatmenu/floatmenu.css',0,0)}
<script type="text/javascript">
$(document).ready(function(){                          



    //展示房型详细信息
    $('.room').click(function(){
        $(this).parent().next().toggle();
    })
    //展示更新房型图片
    $('.ck').click(function(){
        $(this).parents('.roomtype-sheshi').first().find('.pic-fixed-box').show();
    })
    //关闭图层显示
    $(".hp-closed").click(function(){
        $(this).parents(".pic-fixed-box").first().hide();
    })
    //内容切换
    $.floatMenu({
        menuContain : '.tabnav-list',
        tabItem : 'span',
        chooseClass : 'on',
        contentContain : '.tabbox-list',
        itemClass : '.tabcon-list'});

	
});
</script>
</body>
</html>
