<?php
$sub = Common::getConfig('menu_sub.jiebankind');
foreach($sub as $row)
{

    $link = "<span class='kinditem' id='tb_".$key."' data-url='".$row['url']."' data-name='".$row['name']."'><s></s>".$row['name']."</span>";
    echo $link;
}

?>
<script>
    $('.kinditem').click(function(){

        var url = $(this).attr('data-url');
        var urlname = $(this).attr('data-name');
        ST.Util.addTab(urlname,url);
    })

</script>
