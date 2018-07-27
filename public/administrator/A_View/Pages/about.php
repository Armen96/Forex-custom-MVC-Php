<div id='content'>
    <form id='main_form' action='<?=$baseurl?>/about/aa/8/' method='post' enctype="multipart/form-data">
        <?php include('A_View/Default/seo.php'); ?>
        <div class='box'>
            <div class='box_header'>
                <h3 class="box-title">Page Content</h3>
                <div class="box-tools">
                    <button type="button" class="minresize_box setsize"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class='box_edit box_ck'>
                <textarea name="text_ru" id="text"><?= isset($params['result']['text_ru']) ? $params['result']['text_ru'] : '' ?></textarea>
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