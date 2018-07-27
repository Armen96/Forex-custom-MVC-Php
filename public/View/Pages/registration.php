<script src='https://www.google.com/recaptcha/api.js'></script>
<div class="content">
    <form id="form_reg" action="<?=$baseurl?>/registration/aa/" method="POST" onsubmit="return(subForm(this))">
        <h2 class="reg_h2_z"><?=$params['st_lang']->check_in_text?></h2>
        <div class="registration_z">
                <div class="registration_row_z clean">
                    <div class="half_width_z">
                        <label><?=$params['st_lang']->check_in_name?> <span class="red_z">*</span></label>
                    </div>
                    <div class="half_width_z">
                        <input id="user_fname" type="text" class="reg_input_z" value="" required name="name"/>
                    </div>
                </div>
                <div class="registration_row_z clean">
                    <div class="half_width_z">
                        <label><?=$params['st_lang']->check_in_mail?> <span class="red_z">*</span></label>
                    </div>
                    <div class="half_width_z">
                        <input id="user_mail" type="email" class="reg_input_z" required name="mail"/>
                    </div>
                </div>
                <div class="registration_row_z clean">
                    <div class="half_width_z">
                        <label><?=$params['st_lang']->check_in_pass?> <span class="red_z">*</span></label>
                    </div>
                    <div class="half_width_z">
                        <input type="password" class="reg_input_z" name="password" required pattern=".{6,}" title="Six or more characters">
                    </div>
                </div>
                <div class="registration_row_z clean">
                    <div class="half_width_z">
                        <label><?=$params['st_lang']->check_in_repass?> <span class="red_z">*</span></label>
                    </div>
                    <div class="half_width_z">
                        <input type="password" class="reg_input_z" required name="repassword"/>
                    </div>
                </div>
                <div class="registration_row_z clean">
                    <div class="half_width_z">
                        <label><?=$params['st_lang']->check_in_phone?> <span class="red_z">*</span></label>
                    </div>
                    <div class="half_width_z">
                        <input type="text" class="reg_input_z" required name="phone"/>
                        <input id="fbid" type="hidden" name="fb_id">
                    </div>
                </div>
            <div class="registration_row_z clean">
                <div class="fb_tx_i">
                    <label><?=$params['st_lang']->check_in_facebook?> </label>
                </div>
                    <div class="fb_tx_i"><span class='fb_in' onclick="fblogin()"><i class="fa fa-facebook-square" aria-hidden="true"></i></span>
                </div>
            </div>
            <div class="my_capcha">
                <div class="g-recaptcha" data-sitekey="6LeubBcUAAAAAL9Xhl0wzxJvJKNWEJkHt-Rce5sn"></div>
            </div>
            <div class="registration_row_z registration_btn_div_z clean">
                <button class="registration_btn_z" type="submit"><?=$params['st_lang']->check_in_account?></button>
            </div>
        </div>
    </form>
</div>
<script>
    function fblogin(){
        FB.login(function(response) {
            if (response.authResponse) {
                FB.api('/me', function(response) {
                    FB.api("/"+response.id+"/",{fields: 'first_name,last_name,email'},function (response) {
                        var url = base + "/registration/facebook/v1/";
                        var body = "fb="+response.id+"";
                        request(url,body,function(){
                            if(this.readyState == 4){
                                var result = JSON.parse(this.responseText);
                                console.log(result)
                                if(result.error){
                                    window.location = result.text;
                                }else{
                                    $('#user_fname').val(response.first_name);
                                   // $('#user_lname').val(response.last_name);
                                    $('#user_mail').val(response.email);
                                    $('#fbid').val(response.id);
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