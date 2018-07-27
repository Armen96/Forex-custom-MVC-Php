    <!doctype html>
    <html lang="en">
    <head>
        <title>Forex</title>
        <link rel="stylesheet" type="text/css" href="<?= $baseurl ?>/assets/css/main.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?= $baseurl ?>/assets/css/style.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?= $baseurl ?>/assets/css/font-awesome.min.css" media="all" />
        <script type="text/javascript"><?php echo "var base = '".$baseurl."';"; ?></script>
        <script src="<?= $baseurl ?>/assets/javascript/jquery.js"></script>
        <script src="<?= $baseurl ?>/assets/javascript/script.js"></script>
        <script src="<?= $baseurl ?>/assets/javascript/a_main.js"></script>
    </head>
    <body>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId      : '967793563355421',
                xfbml      : true,
                version    : 'v2.8'
            });
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <div class="header">
        <?php
        $banner=new \Model\Banner();
        $result=$banner->findByName(array('fild_name'=>'id','fild_val'=>1));
            ?>
            <div class="content spec_head clean">
                <div class="a_logo_a">
                    <div class="a_logo_a_abs">
                        <span class='l_text'>Expert</span><span class='l_text'>Advasiors</span>
                    </div>
                </div>
                <div class="a_flags clean">
                    <div class="flag_a_div">
                        <img class="flag_a_img" data-lang="eng" src="<?=$baseurl?>/assets/images/front/eng.png" alt="eng">
                        <img class="flag_a_img" data-lang="ru" src="<?=$baseurl?>/assets/images/front/ru.jpg" alt="ru">
                    </div>
                </div>
                <div class="banner clean">
                    <div class="in_banner_a"><img class="a_img_banner a_image_banner" src="<?=$baseurl?>/assets/images/product/<?=$result[0]['image']?>" alt="107.png"></div>
                </div>
                <div class="registration_a">
                    <?php if($params['user_in']){ ?>
                        <form action="<?=$baseurl?>/registration/logout/7/" method="POST">
                            <div class="a_reg_div">
                                <div class="div_a_reg">
                                    <p class="a_p_user"><?=$params['user_name']?></p>
                                    <p class="a_p_user"><?=$params['user_mail']?></p>
                                </div>
                                <div class="div_a_reg">
                                    <input class="my_logout" type="submit" value="<?=$params['st_lang']->logout?>">
                                </div>

                            </div>
                        </form>
                    <?php }else{ ?>
                        <form action="<?=$baseurl?>/registration/login/7/" method="POST">
                            <div class="d_r_r">
                                <input class="i_r_r log_put log_but" type="submit" value="<?=$params['st_lang']->login_sign_in?>">
                                <input class="i_r_r log_put" type="password" name="password" placeholder="<?=$params['st_lang']->login_pass?>" required>
                                <input class="i_r_r log_put" type="text" name="mail" placeholder="<?=$params['st_lang']->login_place?>" required>
                                <div class="i_r_r a_face_a"><span class='fb_in' onclick="fblog()"><i class="fa fa-facebook-square" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </form>
                        <div class="d_r_r">
                            <a class="a_reg" href="<?=$baseurl?>/registration/"><?=$params['st_lang']->login_check_in?></a>
                            <span class="a_reg">|</span>
                            <a class="a_reg" href="<?=$baseurl?>/forgotpassword/"><?=$params['st_lang']->login_restore_password?></a>
                        </div>
                    <?php } ?>
                </div>
            </div>

        <div class="header menucolor">
            <div class="content a_color_header">
                <div class="menu">
                    <ul class="ul_menu">
                        <a class="a_menu_a" href="<?=$baseurl?>/about/"><li class="li_menu <?php if($page=='about'){?>li_menu_a<?php }else{}?>">ABOUT</li></a>
                        <a class="a_menu_a" href="<?=$baseurl?>/news/"><li class="li_menu <?php if($page=='news'){?>li_menu_a<?php }else{}?>">NEWS</li></a>
                        <a class="a_menu_a" href="<?=$baseurl?>/advaisors/"><li class="li_menu <?php if($page=='advaisors'){?>li_menu_a<?php }else{}?>">ADVAISORS</li></a>
                        <a class="a_menu_a" href="<?=$baseurl?>/indicators/"><li class="li_menu <?php if($page=='indicators'){?>li_menu_a<?php }else{}?>">INDICATORS</li></a>
                        <a class="a_menu_a" href="<?=$baseurl?>/forexbrokers/"><li class="li_menu <?php if($page=='forex_brokers'){?>li_menu_a<?php }else{}?>">FOREX BROKERS</li></a>
                        <a class="a_menu_a" href="<?=$baseurl?>/daylysignals/"><li class="li_menu <?php if($page=='dayly_signals'){?>li_menu_a<?php }else{}?>">DAYLY SIGNALS</li></a>
                        <a class="a_menu_a" href="<?=$baseurl?>/sporttips/"><li class="li_menu <?php if($page=='sport_tips'){?>li_menu_a<?php }else{}?>">SPORT TIPS</li></a>
                        <a class="a_menu_a" href="<?=$baseurl?>/contacts/"><li class="li_menu <?php if($page=='contacts'){?>li_menu_a<?php }else{}?>">CONTACTS</li></a>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        function fblog(){
            FB.login(function(response) {
                if (response.authResponse) {
                    FB.api('/me', function(response) {
                        FB.api("/"+response.id+"/",{fields: 'first_name,last_name,email'},function (response) {
                            var url = base + "/registration/facebook/v1/";
                            var regurl = base + "/registration/";
                            var body = "fb="+response.id+"";
                            request(url,body,function(){
                                if(this.readyState == 4){
                                    var result = JSON.parse(this.responseText);
                                    console.log(result)
                                    if(result.error){
                                        window.location = result.text;
                                    }else{
                                        window.location = base+"/registration/";

                                    }
                                }
                            });
                        });
                    });
                } else {
                    console.log('User cancelled login or did not fully authorize.');
                }
            }, {
                scope: 'public_profile,email', //user_photos
                return_scopes: true
            });
        }

        function request(url,body,callback){
            console.log(body);
            var oAjaxReq = new XMLHttpRequest();
            oAjaxReq.open("post", url, true);
            oAjaxReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            oAjaxReq.send(body);
            oAjaxReq.onreadystatechange = callback;
        }
    </script>
