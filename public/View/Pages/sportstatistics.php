<div class="content">
    <?php //var_dump($params['time'][1][0]['data']);die;?>
    <div class="cantent_a_table">
        <table class="table_a_width">
            <tbody>
                <?php for($i=0;$i<count($params['time']);$i++){?>
                    <thead>
                    <tr class="manth_a_s">
                        <th class="manth_a_th"><?=$params['manth'][$i][0]?> | <?=$params['year'][$i][0]?></th>
                    </tr>
                    <tr class="tr_a_c">
                        <th>Date</th>
                        <th>Home</th>
                        <th>Away</th>
                        <th>Pick</th>
                        <th>Handicap</th>
                        <th>Scope</th>
                        <th>Result</th>
                    </tr>
                    </thead>
                    <?php for($j=0;$j<count($params['time'][$i]);$j++){ ?>

                        <tr class="tr_a_tbody">
                            <td><?=$params['time'][$i][$j]['data']?></td>
                            <td><?=$params['time'][$i][$j]['home']?></td>
                            <td><?=$params['time'][$i][$j]['away']?></td>
                            <td><?=$params['time'][$i][$j]['pick']?></td>
                            <td><?=$params['time'][$i][$j]['handicap']?></td>
                            <td><?=$params['time'][$i][$j]['score']?></td>
                            <td><?=$params['time'][$i][$j]['result']?></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php
/*
 *  <div style="border:1px solid red;"><?php var_dump($params['manth'][$i][0]);?></div>
 * <?php foreach($params['sport'] as $key ){ ?>
                    <tr class="tr_a_tbody">
                        <td><?=$key['data']?></td>
                        <td><?=$key['home']?></td>
                        <td><?=$key['away']?></td>
                        <td><?=$key['pick']?></td>
                        <td><?=$key['handicap']?></td>
                        <td><?=$key['score']?></td>
                        <td><?=$key['result']?></td>
                    </tr>
                <?php } ?>




<?php for($i=0;$i<count($params['sport']);$i++){?>
                <lable><?=$params['sport'][$i][0][0]['data']?></lable><br>
                <?php for($j=0;$j<count($params['sport'][$i]);$j++){ ?>
                    <tr class="tr_a_tbody">
                        <td><?=$params['sport'][$i][$j][0]['data']?></td>
                        <td><?=$params['sport'][$i][$j][0]['home']?></td>
                        <td><?=$params['sport'][$i][$j][0]['away']?></td>
                        <td><?=$params['sport'][$i][$j][0]['pick']?></td>
                        <td><?=$params['sport'][$i][$j][0]['handicap']?></td>
                        <td><?=$params['sport'][$i][$j][0]['score']?></td>
                        <td><?=$params['sport'][$i][$j][0]['result']?></td>
                    </tr>
                <?php } ?>
            <?php } ?>




 *
 * */
?>



