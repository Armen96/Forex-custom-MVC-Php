<div id='content'>
    <div class="form_input">
        <div class="onoffswitch">
            <input type="checkbox" class="onoffswitch-checkbox" id="myonoffswitch" checked>
            <label class="onoffswitch-label" for="myonoffswitch">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
            </label>
        </div>
    </div>
    <form id='main_form' action='<?=$baseurl?>/<?=$params['url']?>/add/<?= isset($params['update']) && is_numeric($params['update']) ? $params['update']."/" : '' ?>' method='post' enctype="multipart/form-data">
        <?php include('A_View/Default/seo.php'); ?>
        <div class='box'>
            <div class='box_header'>
                <h3 class="box-title">Page Content</h3>
                <div class="box-tools">
                    <button type="button" class="minresize_box setsize"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box_edit box_ck">
            <div class="form_input">
                <label>Categories</label>
                <div class="input_group">
                    <select name="cid">
                        <option value="1" <?php if(isset($params['result']['cid']) && $params['result']['cid']==1){?>selected<?php } ?>>Advaisors</option>
                        <option value="2" <?php if(isset($params['result']['cid']) && $params['result']['cid']==2){?>selected<?php } ?>>Indicators</option>
                        <option value="4" <?php if(isset($params['result']['cid']) && $params['result']['cid']==4){?>selected<?php } ?>>Dayly Signals</option>
                        <option value="5" <?php if(isset($params['result']['cid']) && $params['result']['cid']==5){?>selected<?php } ?>>Sport Tips</option>
                    </select>
                </div>
            </div>

            <div class="box_edit box_ck">
                <div class="form_input">
                    <div class="form_input">
                        <label>Upload image(.jpg,.png)</label>
                        <div class="input_group">
                            <div class='_foto_block foto_block forempty'>
                                <img src='<?=$baseurlM?>/assets/images/product/<?=$params['result']['img']?>' />
                                <input type="file" name="image" class="img_file" >
                                <div class='empty_foto'><i class="fa fa-picture-o"></i></div>
                                <div class='full_foto'></div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="real_img" value="<?= isset($params['result']['img']) && $params['result']['img'] != '' ? $params['result']['img'] : ''?>" >
            </div>

            <div class="box_edit box_ck">
                <div class="form_input forrus">
                    <label>Имя </label>
                    <div class="input_group">
                        <div class="input_img"><i class="fa fa-pencil"></i></div>
                        <input type="text" class="input_text" name='name_ru' placeholder="Имя" value='<?= isset($params['result']['name_ru']) ? $params['result']['name_ru'] : '' ?>'>
                    </div>
                </div>
                <div class="form_input foreng">
                    <label>Name</label>
                    <div class="input_group">
                        <div class="input_img"><i class="fa fa-pencil"></i></div>
                        <input type="text" class="input_text" name='name_eng' placeholder="Name" value='<?= isset($params['result']['name_eng']) ? $params['result']['name_eng'] : '' ?>'>
                    </div>
                </div>

                <div class="form_input form_half_input">
                    <label>Dollar price</label>
                    <div class="input_group">
                        <div class="input_img"><i class="fa fa-pencil"></i></div>
                        <input type="text" class="input_text" name='d_price' placeholder="d_price" value='<?= isset($params['result']['d_price']) ? $params['result']['d_price'] : '' ?>'>
                    </div>
                </div>

                <div class="form_input form_half_input">
                    <label>Euro price</label>
                    <div class="input_group">
                        <div class="input_img"><i class="fa fa-pencil"></i></div>
                        <input type="text" class="input_text" name='e_price' placeholder="e_price" value='<?= isset($params['result']['e_price']) ? $params['result']['e_price'] : '' ?>'>
                    </div>
                </div>

                <div class="form_input form_half_input">
                    <label>Rubli price</label>
                    <div class="input_group">
                        <div class="input_img"><i class="fa fa-pencil"></i></div>
                        <input type="text" class="input_text" name='r_price' placeholder="r_price" value='<?= isset($params['result']['r_price']) ? $params['result']['r_price'] : '' ?>'>
                    </div>
                </div>

                <div class="form_input form_half_input">
                    <label>Discount</label>
                    <div class="input_group">
                        <div class="input_img"><i class="fa fa-pencil"></i></div>
                        <input type="text" class="input_text" name='discount' placeholder="discount" value='<?= isset($params['result']['discount']) ? $params['result']['discount'] : '' ?>'>
                    </div>
                </div>

                <div class="forrus">
                    <textarea name="text_ru" id="text"><?= isset($params['result']['text_ru']) ? $params['result']['text_ru'] : '' ?></textarea>
                    <script type="text/javascript">
                        CKEDITOR.replace('text');
                    </script>
                </div>

                <div class="foreng">
                    <textarea name="text_eng" id="text_a"><?= isset($params['result']['text_eng']) ? $params['result']['text_eng'] : '' ?></textarea>
                    <script type="text/javascript">
                        CKEDITOR.replace('text_a');
                    </script>
                </div>



                <div class="clear"></div>
            </div>
                <br><lable>Buttons</lable><br><br>
            <?php if(isset($params['button'])){ ?>

                <?php foreach($params['button'] as $key =>$value){?>

                    <div class="a_button_left">
                        <textarea name="button[]"><?=$value['text']?></textarea>
                    </div>

                    <?php }

                    if(count($params['button'])<6){
                        for($i=count($params['button']);$i<6;$i++){?>
                            <div class="a_button_left">
                                <textarea name="button[]"></textarea>
                            </div>
                     <?php   }
                    }

            }else{ ?>
                        <div class="a_button_left">
                            <textarea name="button[]"></textarea>
                        </div>
                        <div class="a_button_left">
                            <textarea name="button[]"></textarea>
                        </div>
                        <div class="a_button_left">
                            <textarea name="button[]"></textarea>
                        </div>
                        <div class="a_button_left">
                            <textarea name="button[]"></textarea>
                        </div>
                        <div class="a_button_left">
                            <textarea name="button[]"></textarea>
                        </div>
                        <div class="a_button_left">
                            <textarea name="button[]"></textarea>
                        </div>
            <?php }?>

        </div>




        <div class="form_input a_form_butt">
            <div class="input_group clen">
                <div class="input_img forsave"><i class="fa fa-floppy-o"></i></div>
                <button class='save' for='main_form'>Save</button>
            </div>
        </div>
    </form>
</div>
</div>
<script>
    $( function() {
        $( "#datepicker" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
    });
</script>