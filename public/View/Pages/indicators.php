<div class="content">
    <div class="forex_content_z">
        <div class="forex_title_z clean">
            <h2 class="forex_h2_z">Indicators</h2>
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
        <div class="adviser_content_row_z clean">
            <?=strip_tags($params['menu'][0]["text_".$params['lezu'].""])?>
        </div>
        <?php

        for ($i=0;$i<count($params['result']);$i++){

            ?>
        <div class="adviser_content_row_z clean">
            <div class="adv_columns_z adv_img_div_z">
                <div class="a_about_img_fix">
                    <img class="a_about_img_image" src="../../assets/images/product/<?=$params['result'][$i]['img']?>" alt="img107">
                </div>
            </div>
            <div class="adv_columns_z adv_text_div_z clean">
                <div class="forex_title_z clean">
                    <h2 class="forex_h2_z"><?=$params['result'][$i]["name_".$params['lezu'].""]?></h2>
                </div>
                <div class="adv_text_z clean">
                    <p class="forex_p_z adv_text_p_z"><?=strip_tags($params['result'][$i]["text_".$params['lezu'].""])?>
                        <a href="<?=$baseurl?>/indicators/<?=$params['result'][$i]['id']?>/" class="more_link_z"><?=$params['st_lang']->more?> ...</a>
                    </p>
                </div>
            </div>
            <div class="adv_columns_z adv_buy_div_z">
                <div class="adv_buy_currency_z">
                    <ul class="adv_buy_curr_ul_z">
                        <li class="adv_buy_curr_li_z"><?=$params['st_lang']->usd?>: </li>
                        <li class="adv_buy_curr_li_z"><?=$params['result'][$i]['d_price']?></li>
                        <li class="adv_buy_curr_li_z"><i class="fa fa-usd" aria-hidden="true"></i></li>
                    </ul>
                    <ul class="adv_buy_curr_ul_z">
                        <li class="adv_buy_curr_li_z"><?=$params['st_lang']->eur?>: </li>
                        <li class="adv_buy_curr_li_z"><?=$params['result'][$i]['e_price']?></li>
                        <li class="adv_buy_curr_li_z"><i class="fa fa-eur" aria-hidden="true"></i></li>
                    </ul>
                    <ul class="adv_buy_curr_ul_z">
                        <li class="adv_buy_curr_li_z"><?=$params['st_lang']->rub?>: </li>
                        <li class="adv_buy_curr_li_z"><?=$params['result'][$i]['r_price']?></li>
                        <li class="adv_buy_curr_li_z"><i class="fa fa-rub" aria-hidden="true"></i></li>
                    </ul>
                </div>
                <?php if(isset($params['result'][$i]['discount']) && $params['result'][$i]['discount']!=0){
                    $params['result'][$i]['d_price']=($params['result'][$i]['d_price'])-($params['result'][$i]['d_price'])*($params['result'][$i]['discount'])/100;
                    $params['result'][$i]['e_price']=$params['result'][$i]['e_price']-($params['result'][$i]['e_price']*$params['result'][$i]['discount'])/100;
                    $params['result'][$i]['r_price']=$params['result'][$i]['r_price']-($params['result'][$i]['r_price']*$params['result'][$i]['discount'])/100;
                    ?>
                    <div class="adv_buy_currency_z">
                        <ul class="adv_buy_curr_ul_z">
                            <li class="adv_buy_curr_li_z"><?=$params['st_lang']->usd?>: </li>
                            <li class="adv_buy_curr_li_z"><?=$params['result'][$i]['d_price']?></li>
                            <li class="adv_buy_curr_li_z"><i class="fa fa-usd" aria-hidden="true"></i></li>
                        </ul>
                        <ul class="adv_buy_curr_ul_z">
                            <li class="adv_buy_curr_li_z"><?=$params['st_lang']->eur?>: </li>
                            <li class="adv_buy_curr_li_z"><?=$params['result'][$i]['e_price']?></li>
                            <li class="adv_buy_curr_li_z"><i class="fa fa-eur" aria-hidden="true"></i></li>
                        </ul>
                        <ul class="adv_buy_curr_ul_z">
                            <li class="adv_buy_curr_li_z"><?=$params['st_lang']->rub?>: </li>
                            <li class="adv_buy_curr_li_z"><?=$params['result'][$i]['r_price']?></li>
                            <li class="adv_buy_curr_li_z"><i class="fa fa-rub" aria-hidden="true"></i></li>
                        </ul>
                    </div>
                <?php } ?>

                <div class="adv_buy_btn_div_z">
                    <button class="adv_buy_btn_z" type="submit"><?=$params['st_lang']->buy?></button>
                    <span class="tooltiptext"><a class="a_a_href" href="<?=$baseurl?>/registration/"><?=$params['st_lang']->signup?></a></span>
                </div>
            </div>
        </div>

            <div class="ghgh">
                <div class="content clean">
                    <div class="bank_a_iframe_a clean">
                        <div class="a_x_close a_x_closes"><i class="fa fa-times" aria-hidden="true"></i></div>
                        <div class="tooltipiframe clean">
                            <?php foreach($params['result'][$i]['button'] as $val){?>
                                <div class='my_pay_button'>
                                    <?=$val['text']?>
                                </div>
                            <?php } ?>
                        </div>
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
                        <a class="pagination_a_text_a" href="<?=$baseurl?>/indicators/page/<?=$i?>/"><?=$i?></a>
                    </div>
                <?php }   ?>
            </div>
        </div>
    </div>
</div>
<?php if($params['user_in']){?>
    <script>
        $(document).ready(function(){
            $(".adv_buy_btn_z").click(function(){
                $(this).parent().parent().parent().next().slideDown(150);
            })
            $(".a_x_closes").click(function(){
                $(this).parent().parent().parent().slideUp(100);
            })
        })
    </script>
<?php }else{?>
    <script>
        $(document).ready(function(){
            $(".adv_buy_btn_z").click(function(){
                $(this).next().css('visibility','visible');
            })
        })
    </script>
<?php }?>