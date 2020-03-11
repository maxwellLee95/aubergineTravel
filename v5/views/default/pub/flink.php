<div class="st-link">
    <div class="wm-1200">

        <div class="st-link-list">
            <dl>
                <dt>友情链接：</dt>
                <dd>
                    {st:flink action="query" typeid="$typeid"}
                     {loop $data $row}
                      <a href="{$row['url']}" target="_blank">{$row['title']}</a>
                     {/loop}
                    {/st}
                </dd>
            </dl>
        </div>

    </div>
</div><!--友情链接-->