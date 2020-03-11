<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>点评-{$webname}</title>
    {Common::css('user.css,base.css,extend.css')}
    {Common::js('jquery.min.js,base.js,common.js,jquery.raty.js')}
<script>
	$(function(){

	})
</script>
</head>

<body>

{request "pub/header"}
  
  <div class="big">
  	<div class="wm-1200">
    
    	<div class="st-guide">
            <a href="{$cmsurl}">首页</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;&nbsp;&nbsp;&gt;&nbsp;&nbsp;点评
      </div><!--面包屑-->
      
      <div class="st-main-page">

          {include "member/left_menu"}
        
        <div class="user-order-box">
          
          <div class="user-order-plbox">
          	<div class="pl-tit">评价商品</div>
            <div class="pl-con">
            	<div class="pic">
                    <a href="{$info['product']['url']}"><img src="{Common::img($info['product']['litpic'])}" alt="{$info['productname']}" /><span>{$info['productname']}</span></a></div>
              <div class="nr">
                <div class="star-box">
                	综合评分：
                  <div id="pl-star" class="pl-star"></div>
                  <div id="pl-hint" class="hint"></div>
                </div>
              	<div class="txt-area"><textarea name="plcontent" id="plcontent" cols="" rows="" placeholder="请填写你对此产品的评论,至少5个汉字"></textarea></div>
                <div class="btn-box"><!--<a class="qx-btn" href="javascript:;">取 消</a>--><a class="fb-btn" href="javascript:;">发 表</a></div>
              </div>
            </div>
          </div>
        </div><!--评论订单-->
      </div>
    </div>
  </div>
<input type="hidden" id="frmcode" value="{$frmcode}"/>
<input type="hidden" id="orderid" value="{$info['id']}"/>
<input type="hidden" id="level" value="0"/>
  
{request "pub/footer"}
{Common::js('layer/layer.js')}
<script>
    $(function(){

        //评分
        $.fn.raty.defaults.path = '/res/images';
        $('#pl-star').raty({
            target    : '#pl-hint',
            targetText: ' ',
            targetKeep: true,
            width     :120,
            hints     : ['很不满意', '不满意', '一般', '满意', '非常满意'],
            click     :function(score, evt){
                $("#level").val(score);
            }
        });


        $('.fb-btn').click(function(){
            var orderid = $("#orderid").val();
            var frmcode = $("#frmcode").val();
            var plcontent = $("#plcontent").val();
            var level = $("#level").val();
            if(level == 0){
                layer.msg("{__('comment_score_empty')}", {
                    icon: 5,
                    time: 1000

                })
                return false;
            }
            if(plcontent.length<5){
                layer.msg("{__('comment_len_failure')}", {
                    icon: 5,
                    time: 1000

                })
                return false;
            }
            $.ajax({
                type:'POST',
                url:SITEURL+'member/order/ajax_save_pinlun',
                data:{
                    orderid:orderid,
                    frmcode:frmcode,
                    plcontent:plcontent,
                    level:level
                },
                dataType:'json',
                success:function(data){
                    if(data.status){
                        layer.msg("{__('comment_success')}", {
                            icon: 6,
                            time: 1000

                        })
                        location.href = "{$GLOBALS['cfg_basehost']}/member/";
                    }else{
                        layer.msg(data.msg, {
                            icon: 5,
                            time: 1000

                        })
                    }
                }
            })

        })
    })
</script>

</body>
</html>
