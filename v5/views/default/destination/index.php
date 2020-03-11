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
    {Common::css('dest.css,base.css,extend.css')}
    {Common::js('jquery.min.js,base.js,common.js,slideTabs.js')}

<script>
	$(function(){
		$('.st-tabdest').switchTab()
	})
</script>
</head>
<body>

  {request "pub/header"}
  <div class="dest-home-top">
    <img class="dest-pic" src="{$GLOBALS['cfg_public_url']}images/dest-page-banner.jpg" />
    <div class="dset-searchBox">
      <div class="searchCon">
        <input type="text" class="dest-text destname" placeholder="我要去..." />
        <input type="button" class="dest-btn" />
      </div>
      <div class="hot-city">
        {st:dest action="query" flag="hot" row="5"}
          {loop $data $row}
           <a href="{$GLOBALS['cfg_basehost']}/{$row['pinyin']}/" >{$row['kindname']}</a>
          {/loop}
        {/st}
      </div>
    </div>
  </div><!-- 目的地首页搜索 -->
  <div class="big">
  	<div class="wm-1200">

    	<div class="st-main-page">
				
		<div class="hot-dest-advimg">
        	<h3>热门目的地</h3>
          <div class="adv-conlist">

              {st:dest action="query" flag="order" row="9"}
                {loop $data $row}
          	    <a class="pic0{$n}" href="{$GLOBALS['cfg_basehost']}/{$row['pinyin']}/" target="_blank"><img src="{Common::img($row['litpic'])}" alt="{$row['kindname']}" /><span class="bt"><strong>{$row['kindname']}</strong></span></a>
                {/loop}


          </div>
        </div><!-- 目的地照片墙 -->
        
        <div class="whole-destlist">
        	<h3>全部目的地</h3>
          <div class="st-tabdest">
          	<div class="st-tabnav">
              {st:dest action="query" flag="top" row="10" return="destlist"}
                {loop $destlist $dest}
                 <span>{$dest['kindname']}</span>
                {/loop}
            </div>
            {loop $destlist $d}

                <div class="st-tabcon">
                    {st:dest action="query" flag="next" pid="$d['id']" return="secondmdd"}
                    {loop $secondmdd $sd}
            	<dl>
              	<dt><a href="{$GLOBALS['cfg_basehost']}/{$sd['pinyin']}/">{$sd['kindname']}</a></dt>
                <dd>
                    {st:dest action="query" flag="next" pid="$sd['id']" return="thirdmdd"}
                     {loop $thirdmdd $nd}
                	  <a href="{$GLOBALS['cfg_basehost']}/{$nd['pinyin']}/">{$nd['kindname']}</a>
                     {/loop}
                    {/st}

                </dd>
              </dl>
                    {/loop}
            </div>

            {/loop}
          </div>
        </div>
        
      </div>
    	
    </div>
  </div>
  
  {request "pub/footer"}
  {include "pub/flink"}
  {Common::js('result/result.js',0)}

  <link type="text/css" href="{$GLOBALS['cfg_public_url']}js/result/result.css" rel="stylesheet" />
  <script>
      $(function(){
          $('.destname').Result({url:SITEURL+'destination/ajax_dest_by_pinyin',extraParams:{typeid:0}});

          //搜索进目的地
          $(".dest-btn").click(function(){
              var destname = $(".destname").val();
              if(destname==''){

                    $(".destname").focus();
              }else{
                  var url = SITEURL+'destination/search?destname='+encodeURIComponent(destname);
                  location.href= url;
              }
          })

      })
  </script>
</body>
</html>
