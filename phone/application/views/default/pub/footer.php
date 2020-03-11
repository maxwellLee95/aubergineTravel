<div class="new-index-nav flex-div">
    {st:footnav action="nav" curnav="$curnav"}
        {loop $data $row}
        <a class="flex-center {if !empty($row['checked'])}checked{/if}" href="{$row['url']}">
            <div style="position:relative;">
                <img src="<?php if(!empty($row['checked'])){ echo $row['check_img']; }else{ echo $row['img'];} ?>" height="20">
                <div style="padding-top:5px;">{$row['title']}</div>
            </div>
        </a>
        {/loop}
    {/st}
</div>