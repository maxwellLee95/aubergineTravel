<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>{$seoinfo['seotitle']}-{$webname}</title>
    {if $seoinfo['keyword']}
    <meta name="keywords" content="{$seoinfo['keyword']}"/>
    {/if}
    {if $seoinfo['description']}
    <meta name="description" content="{$seoinfo['description']}"/>
    {/if}
    {$GLOBALS['cfg_indexcode']}
    {include "pub/varname"}
    {Common::css("base_index_2.css,index_2.css,extend.css")}
    {Common::js("jquery.min.js,base.js,common.js,fcous.js,slideTabs.js")}

<script>
    $(function(){
        $('.con_list,.car_con_list,.article_con').switchTab({trigger:'hover'});
    })
</script>
</head>

<body>
{request "pub/header"}
  <!--滚动焦点图开始-->
  <div class="focus_img">
    <div id="_banners" class="banners">
        {st:ad action="getad" name="Index2RollingAd" pc="1" return="ad"}
         {loop $ad['aditems'] $v}
          <div class="banner">
            <a href="{$v['adlink']}" target="_blank"><img width="1920" height="420" src="{Common::img($v['adsrc'])}" alt="{$v['adname']}" /></a>
          </div>
         {/loop}
        {/st}

    </div>
    <div id="_focus" class="focus">
        {loop $ad['aditems'] $k}
        <a data-index="{php}echo $n-1;{/php}" href="javascript:void(0);" {if $n==1}class="on"{/if}><span class="bg-b"></span><span class="inner"></span></a>
        {/loop}
    </div>
  </div>
  <!--滚动焦点图结束-->
  
  <div class="top_pz_box">
  	<div class="child ico01">深度旅行线路</div>
  	<div class="child ico02">专业精品小团</div>
  	<div class="child ico03">全程细心指导</div>
  	<div class="child ico04">全面安全保障</div>
  </div>
  <!--品质保证-->
  
  <div class="big">
  	<div class="wm-1200">

    <!--旅游线路开始-->
    {if $channel['line']['isopen']==1}
      <div class="line_trip_box">
      	<div class="trip_tit">{$channel['line']['channelname']}</div>
        <div class="product_box">
        	<div class="sidle_hot">
          	<h3>推荐{$channel['line']['channelname']}</h3>
            <ul>
                {st:line action="query" flag="order" row="3" return="recline"}
                    {loop $recline $l}
                    <li>
                        <s></s>
                        <a href="{$l['url']}" target="_blank"><img class="lazyimg" src="{Common::img($l['litpic'],180,80)}" alt="{$l['title']}" width="180" height="80"></a>
                        <p class="tit"><a href="{$l['url']}" target="_blank">{$l['title']}</a></p>
                        <p class="txt">{$l['sellpoint']}</p>
                        </li>
                    <li>
                    {/loop}
               {/st}

            </ul>
          </div>
          <div class="con_list">
          	<div class="st-tabnav">
                {st:dest action="query" flag="channel_nav" row="6" typeid="1" return="linedest"}
                 {loop $linedest $ld}
                    <span>{$ld['kindname']}</span>
                 {/loop}

                <a class="more" href="{$GLOBALS['cfg_basehost']}/lines/all">更多</a>
            </div>
             {loop $linedest $ld}
              <div class="st-tabcon" style="display: block;">
            	<ul>
                    {st:line action="query" flag="mdd" destid="$ld['id']" row="8" return="linelist" }
                     {php}$k=1;{/php}
                     {loop $linelist $ll}
                        <li {if $k%4==0}class="mr_0"{/if}>
                            <a class="fl" href="{$ll['url']}" target="_blank"><img class="fl lazyimg" src="{Common::img($ll['litpic'],180,110)}" alt="{$ll['title']}" width="180" height="110"></a>
                          <a class="tit" href="{$ll['url']}" target="_blank">{$ll['title']}</a>
                          <span class="price">
                               {if !empty($ll['price'])}
                                  <i class="currency_sy">{Currency_Tool::symbol()}</i><b>{$ll['price']}</b>起
                                  {else}
                                    电询
                               {/if}
                          </span>
                        </li>
                     {php}$k++;{/php}
                    {/loop}
              </ul>
            </div>
             {/loop}

              {st:ad action="getad" name="Index2LineRightAd" pc="1" return="linead"}
              {if !empty($linead)}
                <div class="ad_img">
                    <a href="{$linead['adlink']}" style="margin-bottom:10px;" class="fl clearfix"><img src="{Common::img($linead['adsrc'])}" alt="{$linead['adname']}" width="247" height="400"></a>
                </div>
              {/if}
          </div>
        </div>
      </div>
    {/if}
    <!--旅游线路结束-->

    <!--热门酒店开始-->
    {if $channel['hotel']['isopen']==1}
      <div class="hotel_trip_box">
      	<div class="trip_tit">{$channel['hotel']['channelname']}</div>
        <div class="product_box">
        	<div class="sidle_hot">
          	<h3>推荐{$channel['hotel']['channelname']}</h3>
            <ul>
                {st:hotel action="query" flag="order" row="3" return="rechotel"}
                 {loop $rechotel $h}
                    <li>
                    <s></s>
                    <a href="{$h['url']}" target="_blank"><img class="lazyimg" src="{Common::img($h['litpic'],180,80)}" alt="{$h['title']}" width="180" height="80"></a>
                    <p class="tit"><a href="{$h['url']}" target="_blank">{$h['title']}</a></p>
                    <p class="txt">{$h['sellpoint']}</p>
                    </li>
                 {/loop}
                {/st}


            </ul>
          </div>
          <div class="con_list">
          	<div class="st-tabnav">
                {st:dest action="query" flag="channel_nav" row="6" typeid="2" return="hoteldest"}
                 {loop $hoteldest $hd}
                  <span>{$hd['kindname']}</span>
                 {/loop}
              <a class="more" href="{$GLOBALS['cfg_basehost']}/hotels/all/">更多</a>
            </div>
              {loop $hoteldest $hd}

                  <div class="st-tabcon" style="display: block;">
            	    <ul>
                        {st:hotel action="query" flag="mdd" destid="$hd['id']" row="8" return="hlist"}
                            {php}$hindex=1;{/php}
                            {loop $hlist $h}
                          <li {if $hindex%4==0}class="mr_0"{/if}>
                                <a class="fl" href="{$h['url']}" target="_blank"><img class="fl lazyimg" alt="{$h['title']}" width="180" height="110" src="{Common::img($h['litpic'],180,110)}"></a>
                              <a class="tit" href="{$h['url']}" target="_blank">{$h['title']}</a>
                              <span class="price">
                                  {if !empty($h['price'])}
                                   <i class="currency_sy">{Currency_Tool::symbol()}</i><b>{$h['price']}</b>起
                                  {else}
                                    电询
                                  {/if}
                              </span>
                            </li>
                             {php}$hindex++;{/php}
                            {/loop}
                        {/st}
                    </ul>
            </div>

              {/loop}


              {st:ad action="getad" name="Index2HotelRightAd" pc="1" return="hotelad"}
              {if !empty($hotelad)}
              <div class="ad_img">
                  <a href="{$hotelad['adlink']}" style="margin-bottom:10px;" class="fl clearfix"><img src="{Common::img($hotelad['adsrc'])}" alt="{$hotelad['adname']}" width="247" height="400"></a>
              </div>
              {/if}
          </div>
        </div>
      </div>
    {/if}
    <!--热门酒店结束-->
    
    <!--景点门票开始-->
    {if $channel['spot']['isopen']==1}
      <div class="spot_trip_box">
      	<div class="trip_tit">{$channel['spot']['channelname']}</div>
        <div class="product_box">
        	<div class="sidle_hot">
          	<h3>推荐{$channel['spot']['channelname']}</h3>
            <ul>
                {st:spot action="query" flag="order" row="3" return="recspot"}
                {loop $recspot $s}
                <li>
                    <s></s>
                    <a href="{$s['url']}" target="_blank"><img class="lazyimg" src="{Common::img($s['litpic'],180,80)}" alt="{$s['title']}" width="180" height="80"></a>
                    <p class="tit"><a href="{$s['url']}" target="_blank">{$s['title']}</a></p>
                    <p class="txt">{$s['sellpoint']}</p>
                </li>
                {/loop}
                {/st}
            </ul>
          </div>
          <div class="con_list">
          	<div class="st-tabnav">
                {st:dest action="query" flag="channel_nav" row="6" typeid="5" return="spotdest"}
                {loop $spotdest $sd}
                <span>{$sd['kindname']}</span>
                {/loop}
              <a class="more" href="{$GLOBALS['cfg_basehost']}/spots/all">更多景点</a>
            </div>
              {loop $spotdest $sd}
              <div class="st-tabcon" style="display: block;">
                  <ul>
                      {st:spot action="query" flag="mdd" destid="$sd['id']" row="8" return="slist"}
                      {php}$s=1;{/php}
                      {loop $slist $h}
                      <li {if $s%4==0}class="mr_0"{/if}>
                      <a class="fl" href="{$h['url']}" target="_blank"><img class="fl lazyimg" alt="{$h['title']}" width="180" height="110" src="{Common::img($h['litpic'],180,110)}"></a>
                      <a class="tit" href="{$h['url']}" target="_blank">{$h['title']}</a>
                              <span class="price">
                                  {if !empty($h['price'])}
                                   <i class="currency_sy">{Currency_Tool::symbol()}</i><b>{$h['price']}</b>起
                                  {/if}
                              </span>
                      </li>
                      {php}$s++{/php}
                      {/loop}
                      {/st}
                  </ul>
              </div>
              {/loop}

              {st:ad action="getad" name="Index2SpotRightAd" pc="1" return="spotad"}
              {if !empty($spotad)}
              <div class="ad_img">
                  <a href="{$spotad['adlink']}" style="margin-bottom:10px;" class="fl clearfix"><img src="{Common::img($spotad['adsrc'])}" alt="{$spotad['adname']}" width="247" height="400"></a>
              </div>
              {/if}
          </div>
        </div>
      </div>
    {/if}
    <!--景点门票结束-->

    <!--旅游租车开始-->
    {if $channel['car']['isopen']==1}
      <div class="car_trip_box">
          <div class="trip_tit">{$channel['car']['channelname']}<a class="more" href="{$GLOBALS['cfg_basehost']}/cars/all">更多</a></div>
        <div class="product_box">
        	<div class="car_con_list">

            <div class="st-tabcon" style="display: block;">
            	<ul>
                    {st:car action="query" flag="recommend"  row="5" return="carlist"}
                        {loop $carlist $c}
                        <li {if $n%5==0}class="mr_0"{/if}>
                            <a class="fl" href="{$c['url']}" target="_blank"><img class="fl lazyimg" alt="{$c['title']}" width="180" height="110" src="{Common::img($c['litpic'],180,110)}"></a>
                            <a class="tit" href="{$c['url']}" target="_blank">{$c['title']}</a>
                            <span class="price">
                                {if $c['price']}
                                    <i class="currency_sy">{Currency_Tool::symbol()}</i><b>{$c['price']}</b>
                                {else}
                                   电询
                                {/if}
                            </span>
                        </li>
                        {/loop}
                    {/st}
                

              </ul>
            </div>

          </div>
            {st:ad action="getad" name="Index2CarRightAd" pc="1" return="carad"}
            {if !empty($carad)}
            <div class="ad_img">
                <a href="{$carad['adlink']}" style="margin-bottom:10px;" class="fl clearfix"><img src="{Common::img($carad['adsrc'])}" alt="{$carad['adname']}" width="247" height="400"></a>
            </div>
            {/if}
        </div>
      </div>
    {/if}
    <!--旅游租车结束-->

    <!--团购开始-->
    {if $channel['tuan']['isopen']==1}
      <div class="tuan_trip_box">
      	<div class="trip_tit">{$channel['tuan']['channelname']}<a class="more" href="{$GLOBALS['cfg_basehost']}/tuan/" target="_blank">更多特价</a></div>
        <div class="product_box">
        	<div class="tuan_con_list">
            <div class="st-tabcon">
            	<ul>
                    {st:tuan action="query" flag="new"  row="5" return="tuanlist"}
                     {loop $tuanlist $t}
                     <li {if $n%5==0}class="mr_0"{/if}>
                        <span class="dz_ico"><b>{$t['discount']}折</b>优惠</span>
                        <a class="fl" href="{$t['url']}" target="_blank"><img class="fl lazyimg" alt="{$t['title']}" width="180" height="110" src="{Common::img($t['litpic'],180,110)}"></a>
                        <a class="tit" href="{$t['url']}" target="_blank">{$t['title']}</a>
                        <span class="price">
                                {if $t['price']}
                                    <i class="currency_sy">{Currency_Tool::symbol()}</i><b>{$t['price']}</b>
                                {else}
                                   电询
                                {/if}
                        </span>
                    </li>
                    {/loop}
                   {/st}
              </ul>
            </div>
                {st:ad action="getad" name="Index2TuanRightAd" pc="1" return="tuanad"}
                {if !empty($tuanad)}
                <div class="ad_img">
                    <a href="{$tuanad['adlink']}" style="margin-bottom:10px;" class="fl clearfix"><img src="{Common::img($tuanad['adsrc'])}" alt="{$tuanad['adname']}" width="247" height="400"></a>
                </div>
                {/if}
          </div>
        </div>
      </div>
    {/if}
    <!--团购结束-->

    <!--签证开始-->
    {if $channel['visa']['isopen']==1}
      <div class="visa_trip_box">
      	<div class="trip_tit">{$channel['visa']['channelname']}<a class="more" href="{$GLOBALS['cfg_basehost']}/visa/">更多</a></div>
        <div class="product_box">
        	<div class="visa_con_list">
          	<ul>
                {st:visa action="query" flag="order" row="8" return="visalist"}
                 {loop $visalist $v}
                    <li>
                        <a class="fl" href="{$v['url']}" target="_blank"><img class="fl lazyimg" alt="{$v['title']}" width="92" height="60" src="{Common::img($v['litpic'],92,60)}"></a>
                        <p>
                          <a href="{$v['url']}" target="_blank">{$v['title']}</a>
                          <span>
                              {if $v['price']}
                                    <i class="currency_sy">{Currency_Tool::symbol()}</i><b>{$v['price']}</b>
                                {else}
                                   电询
                                {/if}
                          </span>
                        </p>
                        </li>
                 {/loop}
               {/st}
            </ul>
          </div>
        </div>
      </div>
    {/if}
    <!--签证结束-->

    <!--文章开始-->
    {if $channel['article']['isopen']==1}
      <div class="article_trip_box">
      	<div class="article_con">
      		<div class="trip_tit">
          	<em>{$channel['article']['channelname']}</em>
            <div class="st-tabnav">
                {st:dest action="query" flag="channel_nav" row="6" typeid="4" return="articledest"}
                    {loop $articledest $ad}
                    <span>{$ad['kindname']}</span>
                    {/loop}
                {/st}

            </div>
            <a class="more" href="{$GLOBALS['cfg_basehost']}/raiders/all">更多</a>
          </div>
            {loop $articledest $ad}
                <div class="st-tabcon" style="display: block;">
                <div class="first">
                  <div class="yx-rotaion">
                   {st:article action="query" flag="mdd" destid="$ad['id']" row="9" return="articlelist"}
                    <ul>

                      <li>
                        {if !empty($articlelist[0])}
                        <a target="_blank" href="{$articlelist[0]['url']}"><img class="lazyimg" alt="{$articlelist[0]['title']}" width="380" height="250" src="{Common::img($articlelist[0]['litpic'],380,250)}"></a>
                        {/if}
                      </li>

                    </ul>
                  </div>
                  <p class="tit"><a target="_blank" href="{$articlelist[0]['url']}">{$articlelist[0]['title']}</a></p>
                  <p class="txt">{Common::cutstr_html($articlelist[0]['content'],70)}</p>
                </div>
                <div class="second">
                    <ul>
                     {php}$aindex=1;{/php}
                     {loop $articlelist $arc}
                         {if $aindex>1}
                         <li {if $aindex%2==0} class="mr_0"{/if}>
                            <p class="tit"><a href="{$arc['url']}" target="_blank">{$arc['title']}</a></p>
                          <p class="txt">
                             {Common::cutstr_html($arc['content'],50)}
                          </p>
                        </li>
                         {/if}
                        {php}$aindex++;{/php}
                    {/loop}
                  </ul>
                </div>
            </div>
            {/loop}


        </div>
        
      </div>
    {/if}
    <!--文章结束-->
    
    
    </div>
  </div>
{request "pub/footer"}
{request "pub/flink"}

</body>
</html>
