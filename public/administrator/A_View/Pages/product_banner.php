<div id='content'>

    <form id='main_form' action='<?=$baseurl?>/<?=$params['url']?>/banner/add/<?= isset($params['update']) && is_numeric($params['update']) ? $params['update']."/" : '' ?>' method='post' enctype="multipart/form-data">

        <div class='box'>

            <div class="box_edit box_ck">
                <div class="form_input">
                    <div class="form_input">
                        <label>Upload image(.jpg,.png)</label>
                        <div class="input_group">
                            <div class='_foto_block foto_block forempty'>
                                <img src='<?=$baseurlM?>/assets/images/product/<?=$params['result'][0]['image']?>' />
                                <input type="file" name="image" class="img_file" >
                                <div class='empty_foto'><i class="fa fa-picture-o"></i></div>
                                <div class='full_foto'></div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="real_img" value="<?= isset($params['result'][0]['image']) && $params['result'][0]['image'] != '' ? $params['result'][0]['image'] : ''?>" >
            </div>

            <div class="form_input a_form_butt">
                <div class="input_group clen">
                    <div class="input_img forsave"><i class="fa fa-floppy-o"></i></div>
                    <button class='save' for='main_form'>Save</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    $( function() {
        $( "#datepicker" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
    });
</script>