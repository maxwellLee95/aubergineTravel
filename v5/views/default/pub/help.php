<div class="st-help">
    <div class="wm-1200">

        <div class="help-lsit">
            {st:help action="kind" row="5"}
                {loop $data $row}
                    <dl>
                        <dt><a href="{$row['url']}" rel="nofollow">{$row['title']}</a></dt>
                        <dd>
                            {st:help action="article" row="3" kindid="$row['id']" return="list"}
                              {loop $list $r}
                                <a href="{$r['url']}" rel="nofollow">{$r['title']}</a>
                              {/loop}
                            {/st}

                        </dd>
                    </dl>
                {/loop}
            {/st}

            <div class="st-wechat">
                {if $GLOBALS['cfg_weixin_logo']}
                  <img class="fl" src="{$GLOBALS['cfg_weixin_logo']}" width="94" height="94" />
                  <span>微信扫一扫，<br />优惠多多！</span>
                {/if}
            </div>
        </div>

    </div>
</div><!--帮助 扫码-->