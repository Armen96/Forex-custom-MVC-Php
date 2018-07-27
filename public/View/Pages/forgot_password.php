<div class="content">
    <div class="registration_z">
            <div class="registration_row_z clean">
                <p class="forgot_pass_p_z"><?=$params['st_lang']->restore_text?></p>
                <p class="forgot_pass_p_z"><?=$params['st_lang']->restore_mail?> <span class="red_z">*</span></p>
            </div>
            <div class="registration_row_z clean">
                <input  type="text" name="mail_token" class="reg_input_z" id="mail_token" required/>
            </div>
            <div class="registration_row_z clean">
                <p id="cap_a" class="forgot_pass_p_z">CAPTCHA <span class="red_z">*</span></p>
            </div>
            <div class="registration_row_z registration_btn_div_z clean">
                <button class="registration_btn_z forgot_pass_btn_z" onclick="subForgot()"><?=$params['st_lang']->button_send?></button>
            </div>
    </div>
</div>