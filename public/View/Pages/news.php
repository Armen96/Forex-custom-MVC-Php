<div class="content">
    <div class="forex_content_z">
        <div class="forex_title_z clean">
            <h2 class="forex_h2_z">News</h2>
        </div>
        <div class="forex_div_z">
            <p class="forex_p_z forgot_pass_p_z"><?=strip_tags($params['result'][0]["text_".$params['lezu'].""])?></p>
        </div>
        <div class="forex_banner_div_z">
            <?php
            if ($params['menu'][0]['s_b']==1){
                ?>
                <div class="a_iframe_img">
                    <div class="a_ifram_image">
                        <img class="image_a_iframe" src="<?=$baseurl?>/assets/images/product/<?=$params['menu'][0]['img_b']?>" alt="">
                    </div>
                </div>
            <?php }else{?>
                <div class="a_iframe_img">
                    <div class="image_a_iframe">
                        <?=$params['menu'][0]['iframe_b']?>
                    </div>
                </div>
            <?php }?>
        </div>
    </div>
    <div class="adviser_content_z clean">
        <?php
        for ($i=0;$i<count($params['result']);$i++){
            ?>
            <div class="adviser_content_row_z clean">
                <div class="adv_columns_z adv_img_div_z">
                    <div class="a_about_img_fix">
                        <img class="a_about_img_image" src="<?=$baseurl?>/assets/images/product/<?=$params['result'][$i]['img']?>" alt="img107">
                    </div>
                </div>
                <div class="adv_columns_z adv_text_div_z clean">
                    <div class="forex_title_z clean">
                        <h2 class="forex_h2_z"><?=$params['result'][$i]["name_".$params['lezu'].""]?></h2>
                    </div>
                    <div class="adv_text_z clean">
                        <p class="forex_p_z adv_text_p_z"><?=strip_tags($params['result'][$i]["text_".$params['lezu'].""])?>
                            <a href="<?=$baseurl?>/news/<?=$params['result'][$i]['id']?>/" class="more_link_z"><?=$params['st_lang']->more?> ...</a>
                        </p>
                    </div>
                </div>
            </div>

        <?php } ?>
        <div class="pagination_z">
            <div class="pagination_items_z clean">
                <?php

                for($i=1;$i<=$params['m_count'];$i++){
                    ?>
                    <!--<div class="pagination_item_z" data-num="<?/*=$i+1*/?>"> <?/*=$i+1*/?></div>-->
                    <div class="pagination_item_z">
                        <a class="pagination_a_text_a" href="<?=$baseurl?>/news/page/<?=$i?>/"><?=$i?></a>
                    </div>
                <?php }   ?>
            </div>
        </div>
    </div>
</div>
