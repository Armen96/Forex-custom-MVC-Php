<div id='content'>
    <form id='main_form' action='<?=$baseurl?>/forexbrokers/edit/3/add/' method='post' enctype="multipart/form-data">
        <?php include('A_View/Default/seo.php'); ?>
        <div class='box'>
            <div class='box_header'>
                <h3 class="box-title">Page Content</h3>
                <div class="box-tools">
                    <button type="button" class="minresize_box setsize"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box_edit box_ck">

                <div class="form_input forrus">
                    <label>Image Banner </label>
                    <div class="form_input">
                        <div class="form_input">
                            <label>Upload banner image(.jpg,.png)</label>
                            <div class="input_group">
                                <div class='_foto_block foto_block forempty'>
                                    <img src='<?=$baseurlM?>/assets/images/product/<?=$params['result']['img_b']?>' />
                                    <input type="file" name="img_b" class="img_file" multiple="multiple">
                                    <div class='empty_foto'><i class="fa fa-picture-o"></i></div>
                                    <div class='full_foto'></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="real_img" value="<?= isset($params['result']['img_b']) && $params['result']['img_b'] != '' ? $params['result']['img_b'] : ''?>">
                </div>
                <p>OR</p>
                <div>
                    <lable>Iframe banner</lable>
                    <textarea name="iframe_b" style="width: 400px;height: 150px; display: block;"><?= isset($params['result']['iframe_b']) ? $params['result']['iframe_b'] : '' ?></textarea>
                    <script type="text/javascript">
                        CKEDITOR.replace('text');
                    </script>
                </div>
                <div>
                    <span> Image </span><input style="width:25px; height: 25px;" type="checkbox" name="s_b" value="1" <?php if($params['result']['s_b']==1){?>checked<?php } ?>
                    <br><br>
                </div>
                <div>
                    <textarea name="text_ru" id="text_e"><?= isset($params['result']['text_ru']) ? $params['result']['text_ru'] : '' ?></textarea>
                    <script type="text/javascript">
                        CKEDITOR.replace('text_e');
                    </script>
                </div>
                <div class="clear"></div>
            </div>
            <div class='box'>
                <div class='box_header'>
                    <h3 class="box-title">Foto gallery</h3>
                    <div class="box-tools">
                        <button type="button" class="minresize_box setsize"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box_edit box_ck">
                    <div class="form_input">
                        <div class="form_input">
                            <label>Upload image(.jpg,.png)</label>
                            <div class="input_group">
                                <div class='_foto_block foto_block forempty'>
                                    <img src='' />
                                    <input type="file" name="image[]" class="img_file" multiple="multiple">
                                    <div class='empty_foto'><i class="fa fa-picture-o"></i></div>
                                    <div class='full_foto'></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gallery_foto clen">
                        <?php
                        if(isset($params['result']['images'])){
                            foreach($params['result']['images'] as $val){
                                ?>
                                <div class="gal_img_col">
                                    <div class="delete_foto_galery">
                                        <i class="fa fa-times"></i>
                                    </div>
                                    <img src="<?= $baseurlM ?>/assets/images/event_gallery/<?= $val['img'] ?>">
                                </div>
                            <?php } } ?>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div class="form_input">
            <div class="input_group">
                <div class="input_img forsave"><i class="fa fa-floppy-o"></i></div>
                <button class='save' for='main_form'>Save</button>
            </div>
        </div>
    </form>
</div>