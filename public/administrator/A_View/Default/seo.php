<div class='box'>
    <div class='box_header'>
        <h3 class="box-title">SEO instrument</h3>
        <div class="box-tools">
            <button type="button" class="minresize_box setsize"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class='box_edit box_ck'>
        <div class="form_input foreng">
            <div class="form_input">
                <label>Heading (title)</label>
                <div class="input_group">
                    <div class="input_img"><i class="fa fa-external-link"></i></div>
                    <input type="text" class="input_text" name='seo_title_eng' placeholder="Seo title" value='<?= isset($params['result']['seo_title_eng']) ? $params['result']['seo_title_eng'] : '' ?>' >
                </div>
            </div>
            <div class="form_input">
                <label>Description (description)</label>
                <div class="input_group">
                    <div class="input_img"><i class="fa fa-external-link"></i></div>
                    <input type="text" class="input_text" name='seo_desc_eng' placeholder="Seo description" value="<?= isset($params['result']['seo_desc_eng']) ? $params['result']['seo_desc_eng'] : '' ?>">
                </div>
            </div>
            <div class="form_input">
                <label>Keywords (Keywords)</label>
                <div class="input_group">
                    <div class="input_img"><i class="fa fa-external-link"></i></div>
                    <input type="text" class="input_text" name='seo_key_eng' placeholder="Seo keywords" value='<?= isset($params['result']['seo_key_eng']) ? $params['result']['seo_key_eng'] : '' ?>'>
                </div>
            </div>
        </div>
        <div class="form_input forrus">
            <div class="form_input">
                <label>Заголовок (title)</label>
                <div class="input_group">
                    <div class="input_img"><i class="fa fa-external-link"></i></div>
                    <input type="text" class="input_text" name='seo_title_ru' placeholder="Seo title" value='<?= isset($params['result']['seo_title_ru']) ? $params['result']['seo_title_ru'] : '' ?>' >
                </div>
            </div>
            <div class="form_input">
                <label>Описание (description)</label>
                <div class="input_group">
                    <div class="input_img"><i class="fa fa-external-link"></i></div>
                    <input type="text" class="input_text" name='seo_desc_ru' placeholder="Seo description" value="<?= isset($params['result']['seo_desc_ru']) ? $params['result']['seo_desc_ru'] : '' ?>">
                </div>
            </div>
            <div class="form_input">
                <label>Ключевые слова (Keywords)</label>
                <div class="input_group">
                    <div class="input_img"><i class="fa fa-external-link"></i></div>
                    <input type="text" class="input_text" name='seo_key_ru' placeholder="Seo keywords" value='<?= isset($params['result']['seo_key_ru']) ? $params['result']['seo_key_ru'] : '' ?>'>
                </div>
            </div>
        </div>
    </div>
</div>