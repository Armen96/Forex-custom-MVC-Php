<div id='content'>
    <form id='main_form' action='' method='post' enctype="multipart/form-data">
        <div class='box'>
            <div class='box_header'>
                <h3 class="box-title">Page Content</h3>
                <div class="box-tools">
                    <button type="button" class="minresize_box setsize"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class='box_header'>
                <h3 class="box-title">Foto</h3>
            </div>
            <div class="form_input">
                <div class="form_input">
                    <label>Upload image(.jpg,.png)</label>
                    <div class="input_group">
                        <div class='_foto_block foto_block forempty'>
                            <img src='<?= isset($params['result']['img']) ? $baseurlM."/assets/images/slide/".$params['result']['img'] : '' ?>' />
                            <input type="file" name="image" class="img_file">
                            <?php if(isset($params['result']['img'])){ ?>
                                <input type="hidden" name="upimg" value="<?= $params['result']['img'] ?>">
                            <?php } ?>
                            <div class='empty_foto'><i class="fa fa-picture-o"></i></div>
                            <div class='full_foto'></div>
                        </div>							
                    </div>
                </div>
            </div>
            <div class="form_input">
                <label>Name</label>
                <div class="input_group">
                    <div class="input_img"><i class="fa fa-pencil"></i></div>
                    <input type="text" class="input_text" name='name' placeholder="Name" value='<?= isset($params['result']['name']) ? $params['result']['name'] : '' ?>'>
                </div>
            </div>
            <div class='box_edit box_ck'>
                <textarea name="text" id="text"><?= isset($params['result']['text']) ? $params['result']['text'] : '' ?></textarea>
                <script type="text/javascript">
                    CKEDITOR.replace('text');
                </script>
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