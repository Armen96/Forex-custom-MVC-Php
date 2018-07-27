<div class="content">
    <div class="adviser_content_z clean">
        <div class="adviser_content_row_z clean">

            <div class="adv_columns_z adv_img_div_z a_asd">

                <div class="a_about_img_fix">
                    <img class="a_about_img_image" src="../../assets/images/product/<?=$params['result'][0]['img']?>" alt="img107">
                </div>

                <div class="registration_row_z registration_btn_div_z a_buy_items clean">
                    <button class="buy_item_btn_z" type="submit"><?=$params['st_lang']->buy?></button>
                    <span class="tooltiptext"><a class="a_a_href" href="<?=$baseurl?>/registration/"><?=$params['st_lang']->signup?></a></span>
                </div>

            </div>
            <div class="adv_columns_z clean a_asd a_left_ssa">
                <div class="forex_title_z clean">
                    <h2 class="forex_h2_z"><?=$params['result'][0]["name_".$params['lezu'].""]?></h2>
                </div>
                <div class="adv_more_text_z clean">
                    <p class="forex_p_z adv_more_text_p_z"><?=strip_tags($params['result'][0]["text_".$params['lezu'].""])?>
                    </p>
                </div>
            </div>
            <div class="adv_columns_z clean a_asd a_left_ssb">
                <div class="a_a_asd">
                    <div class="adv_buy_currency_z">
                        <ul class="adv_buy_curr_ul_z">
                            <li class="adv_buy_curr_li_z"><?=$params['st_lang']->usd?>: </li>
                            <li class="adv_buy_curr_li_z"><?=$params['result'][0]['d_price']?></li>
                            <li class="adv_buy_curr_li_z"><i class="fa fa-usd" aria-hidden="true"></i></li>
                        </ul>
                        <ul class="adv_buy_curr_ul_z">
                            <li class="adv_buy_curr_li_z"><?=$params['st_lang']->eur?>: </li>
                            <li class="adv_buy_curr_li_z"><?=$params['result'][0]['e_price']?></li>
                            <li class="adv_buy_curr_li_z"><i class="fa fa-eur" aria-hidden="true"></i></li>
                        </ul>
                        <ul class="adv_buy_curr_ul_z">
                            <li class="adv_buy_curr_li_z"><?=$params['st_lang']->rub?>: </li>
                            <li class="adv_buy_curr_li_z"><?=$params['result'][0]['r_price']?></li>
                            <li class="adv_buy_curr_li_z"><i class="fa fa-rub" aria-hidden="true"></i></li>
                        </ul>
                    </div>
                    <?php if(isset($params['result'][0]['discount']) && $params['result'][0]['discount']!=0){
                        $params['result'][0]['d_price']=($params['result'][0]['d_price'])-($params['result'][0]['d_price'])*($params['result'][0]['discount'])/100;
                        $params['result'][0]['e_price']=$params['result'][0]['e_price']-($params['result'][0]['e_price']*$params['result'][0]['discount'])/100;
                        $params['result'][0]['r_price']=$params['result'][0]['r_price']-($params['result'][0]['r_price']*$params['result'][0]['discount'])/100;
                        ?>
                        <div class="adv_buy_currency_z">
                            <ul class="adv_buy_curr_ul_z">
                                <li class="adv_buy_curr_li_z"><?=$params['st_lang']->usd?>: </li>
                                <li class="adv_buy_curr_li_z"><?=$params['result'][0]['d_price']?></li>
                                <li class="adv_buy_curr_li_z"><i class="fa fa-usd" aria-hidden="true"></i></li>
                            </ul>
                            <ul class="adv_buy_curr_ul_z">
                                <li class="adv_buy_curr_li_z"><?=$params['st_lang']->eur?>: </li>
                                <li class="adv_buy_curr_li_z"><?=$params['result'][0]['e_price']?></li>
                                <li class="adv_buy_curr_li_z"><i class="fa fa-eur" aria-hidden="true"></i></li>
                            </ul>
                            <ul class="adv_buy_curr_ul_z">
                                <li class="adv_buy_curr_li_z"><?=$params['st_lang']->rub?>: </li>
                                <li class="adv_buy_curr_li_z"><?=$params['result'][0]['r_price']?></li>
                                <li class="adv_buy_curr_li_z"><i class="fa fa-rub" aria-hidden="true"></i></li>
                            </ul>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

    </div>

    <div class="ghgh">
        <div class="content clean">
            <div class="bank_a_iframe_a clean">
                <div class="a_x_close a_x_closes"><i class="fa fa-times" aria-hidden="true"></i></div>
                <div class="tooltipiframe">
                    <?php foreach($params['result'][0]['button'] as $val){?>
                        <div class='my_pay_button'>
                            <?=$val['text']?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>


</div>
<?php if($params['user_in']){?>
    <script>
        $(document).ready(function(){
            $(".buy_item_btn_z").click(function(){
                $(this).parent().parent().parent().parent().next().slideDown(100);
            })
            $(".a_x_closes").click(function(){
                $(this).parent().parent().parent().slideUp(100);
            })
        })

    </script>
<?php }else{?>
    <script>
        $(document).ready(function(){
            $(".buy_item_btn_z").click(function(){
                $(this).next().css('visibility','visible');
            })
        })
    </script>
<?php }?>

