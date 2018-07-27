<div id='content'>
    <form id='main_form' action='' method='post' enctype="multipart/form-data">
        <div class='box'>
            <div class='box_header'>
                <h3 class="box-title">Page Content</h3>
                <div class="box-tools">
                    <button type="button" class="minresize_box setsize"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="form_input">
                <label>Categories</label>
                <div class="input_group">
                    <select name="cid">
                        <?php 
                            if(isset($params['categoris'])){
                                foreach($params['categoris'] as $val){
                                if(isset($params['result']['id']) && $params['result']['cid'] == $val['id']){
                                    $selec = "selected";
                                }else{
                                     $selec = "";
                                }        
                        ?>
                            <option value="<?=$val['id']?>" <?=$selec?>><?=$val['name']?></option>
                        <?php 
                            }
                                }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form_input">
                <label>Name</label>
                <div class="input_group">
                    <div class="input_img"><i class="fa fa-pencil"></i></div>
                    <input type="text" class="input_text" name='name' placeholder="Name" value='<?= isset($params['result']['name']) ? $params['result']['name'] : '' ?>'>
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