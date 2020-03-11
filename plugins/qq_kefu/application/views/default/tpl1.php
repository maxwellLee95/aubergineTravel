<style>
    .alink{
        border: solid 1px #dadada;
        border-top: none;
        cursor: pointer;
        font-size: 12px;
        font-weight: 700;
        float: left;
        overflow: hidden;
        position: relative;
        text-align: center;
        text-decoration: none;
        width: 92px;
        z-index: 0;padding:3px;
        background-color:#fff
    }
    .linktel{
        background: #fafafa;
        border: solid 1px #dadada;
        border-top: none;
        color: #06c;
        font-size: 12px;
        font-weight: 700;
        overflow: hidden;
        padding: 5px 0;
        text-align: center;
        width: 98px;
    }
    .emstyle{
        color: #f30;
        font-family: Arial;
        font-size: 14px;
        font-weight: 700;
    }

</style>
<div style="width:100px;position:fixed;{$conf['pos']}:{$conf['posh']};top:{$conf['post']};border-top: solid 1px #dadada;
overflow: hidden;text-align:center;z-index:9999">

   {loop $group $g}
     {loop $g['qq'] $q}
    <a  class="alink" target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin={$q['qqnum']}&amp;site=qq&amp;menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:{$q['qqnum']}:42" alt="点击这里给我发消息" title="咨询1"></a>
     {/loop}
   {/loop}
   <p class="linktel">咨询热线<br><em class="emstyle">{$conf['phonenum']}</em></p>
</div>