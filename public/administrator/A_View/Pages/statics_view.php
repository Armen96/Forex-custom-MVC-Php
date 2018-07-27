<div id='content'>

    <form id='main_form' action='<?=$baseurl?>/sporttips/add/item/1/<?= isset($params['update']) && is_numeric($params['update']) ? $params['update']."/" : '' ?>' method='post' enctype="multipart/form-data">
        <div class='box'>
            <div class='box_header'>
                <h3 class="box-title">Page Content</h3>
                <div class="box-tools">
                    <button type="button" class="minresize_box setsize"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box_edit box_ck">
                <div class="box_edit box_ck">

                    <div class="form_input form_half_input">
                        <label>Date</label>
                        <div class="input_group">
                            <div class="input_img"><i class="fa fa-pencil"></i></div>
                            <input type="date" class="input_text" name='data' required  value='<?= isset($params['result']['data']) ? $params['result']['data'] : '' ?>'>
                        </div>
                    </div>

                    <div class="form_input form_half_input">
                        <label>Home</label>
                        <div class="input_group">
                            <div class="input_img"><i class="fa fa-pencil"></i></div>
                            <input type="text" class="input_text" name='home' placeholder="Home" required value='<?= isset($params['result']['home']) ? $params['result']['home'] : '' ?>'>
                        </div>
                    </div>

                    <div class="form_input form_half_input">
                        <label>Away</label>
                        <div class="input_group">
                            <div class="input_img"><i class="fa fa-pencil"></i></div>
                            <input type="text" class="input_text" name='away' placeholder="Away" required value='<?= isset($params['result']['away']) ? $params['result']['away'] : '' ?>'>
                        </div>
                    </div>

                    <div class="form_input form_half_input">
                        <label>Pick</label>
                        <div class="input_group">
                            <div class="input_img"><i class="fa fa-pencil"></i></div>
                            <input type="text" class="input_text" name='pick' placeholder="Pick" value='<?= isset($params['result']['pick']) ? $params['result']['pick'] : '' ?>'>
                        </div>
                    </div>

                    <div class="form_input form_half_input">
                        <label>Handicap</label>
                        <div class="input_group">
                            <div class="input_img"><i class="fa fa-pencil"></i></div>
                            <input type="text" class="input_text" name='handicap' placeholder="Handicap" value='<?= isset($params['result']['handicap']) ? $params['result']['handicap'] : '' ?>'>
                        </div>
                    </div>

                    <div class="form_input form_half_input">
                        <label>Score</label>
                        <div class="input_group">
                            <div class="input_img"><i class="fa fa-pencil"></i></div>
                            <input type="text" class="input_text" name='score' placeholder="Score" value='<?= isset($params['result']['score']) ? $params['result']['score'] : '' ?>'>
                        </div>
                    </div>

                    <div class="form_input form_half_input">
                        <label>Result</label>
                        <div class="input_group">
                            <div class="input_img"><i class="fa fa-pencil"></i></div>
                            <input type="text" class="input_text" name='result' placeholder="Result" value='<?= isset($params['result']['result']) ? $params['result']['result'] : '' ?>'>
                        </div>
                    </div>

                    <div class="clear"></div>
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