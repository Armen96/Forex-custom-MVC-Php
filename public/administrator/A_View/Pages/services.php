<div id='content'>
    <div id='table_div'>
        <div class='table_head'>
            <h3>Services</h3>
        </div>
        <div class='table_head'>
            <div class="form_input">
                <div class="input_group add_project">
                    <div class="input_img forsave">
                        <i class="fa fa-plus"></i>	
                    </div>
                    <a href='<?= $baseurl ?>/<?= $page ?>/add/' class='save'>Add Service</a>
                </div>
            </div>
        </div>		
        <table>
            <thead>
                <tr>
                    <th class='table_num'>#</th>
                    <th class='table_chek'>
                        <input type="checkbox" class='checkbox_anime' id="all" />
                        <label class='chekbox_label' for="all"></label>
                    </th>
                    <th class='w_10'>Name</th>
                    <th class='w_10'>Categories</th>
                    <th class='table_action last_th'>Action</th>
                </tr>
            </thead>
            <tbody id='main_tbody' data-table='<?= $params['table'] ?>'>
                <?php
                $numbered = 0;
                if (isset($params['result'])) {
                    foreach ($params['result'] as $val) {
                        $numbered++
                        ?>
                        <tr id='m_<?= $val['id'] ?>'>
                            <td>
                                <span><?= $numbered ?></span>
                            </td>
                            <td>
                                <input type="checkbox" class='checkbox_anime sub_chek' id="ch_<?= $val['id'] ?>" data-get='<?= $params['controller'] ?>' data-id="<?= $val['id'] ?>"/>
                                <label class='chekbox_label' for="ch_<?= $val['id'] ?>" ></label>
                            </td>
                            <td>
                                <a href='<?= $baseurl ?>/<?= $params['url'] ?>/add/<?= $val['id'] ?>/'><span><?= $val['name'] ?></span></a>
                            </td>
                            <td>
                                <a href='<?= $baseurl ?>/<?= $params['url'] ?>/add/<?= $val['id'] ?>/'><span><?= $val['c_name'] ?></span></a>
                            </td>
                            <td class='last_td'>
                                <a href='<?= $baseurl ?>/<?= $params['url'] ?>/add/<?= $val['id'] ?>/'><span class='action_td'><i class="fa fa-pencil-square-o"></i></span></a>
                                <span class='action_td action_delete' data-id="<?= $val['id'] ?>" data-get='<?= $params['controller'] ?>'><i class="fa fa-trash-o"></i></span>
                            </td>
                        </tr>
                    <?php }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>