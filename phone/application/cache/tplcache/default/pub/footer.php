<div class="new-index-nav flex-div">
    <?php require_once ("/data/web/qiezi_travel/phone/taglib/footnav.php");$footnav_tag = new Taglib_Footnav();if (method_exists($footnav_tag, 'nav')) {$data = $footnav_tag->nav(array('action'=>'nav','curnav'=>$curnav,));}?>
        <?php $n=1; if(is_array($data)) { foreach($data as $row) { ?>
        <a class="flex-center <?php if(!empty($row['checked'])) { ?>checked<?php } ?>
" href="<?php echo $row['url'];?>">
            <div style="position:relative;">
                <img src="<?php if(!empty($row['checked'])){ echo $row['check_img']; }else{ echo $row['img'];} ?>" height="20">
                <div style="padding-top:5px;"><?php echo $row['title'];?></div>
            </div>
        </a>
        <?php $n++;}unset($n); } ?>
    
</div>