<div class="content">
    <div class="registration_z">
        <form action="<?=$baseurl?>/forgotpassword/<?=$params['token']?>/" method="post">
            <div class="registration_row_z clean">
                <p class="forgot_pass_p_z"><?=$params['st_lang']->restore_text?></p>
                <p class="forgot_pass_p_z"><?=$params['st_lang']->restore_mail?> <span class="red_z">*</span></p>
            </div>

            <div class="registration_row_z clean">
                <lable>New Password: </lable><br>
                <input  type="text" name="password" class="reg_input_z"  required/>
            </div>

            <div class="registration_row_z clean">
                <lable>Confirm Password: </lable><br>
                <input  type="text" name="re_password" class="reg_input_z"  required/>
            </div>

           
            <div class="registration_row_z registration_btn_div_z clean">
                <button class="registration_btn_z forgot_pass_btn_z" "><?=$params['st_lang']->button_send?></button>
            </div>
        </form>
    </div>
</div>