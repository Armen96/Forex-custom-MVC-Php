<!doctype html>
<html>
    <head>
        <title>Forex</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=980">
        <link rel = "stylesheet" type = "text/css" href = "<?= $baseurl ?>/a_assets/css/jquery.ui.timepicker.css">
        <link rel = "stylesheet" type = "text/css" href = "<?= $baseurl ?>/a_assets/css/font-awesome.min.css">
        <link rel = "stylesheet" type = "text/css" href = "<?= $baseurl ?>/a_assets/javascript/choosen/chosen.css">
        <link rel = "stylesheet" type = "text/css" href = "<?= $baseurl ?>/a_assets/css/style.css">
        <link rel = "stylesheet" type = "text/css" href = "<?= $baseurl ?>/a_assets/css/style.css">
        <link rel = "stylesheet" type = "text/css" href = "<?= $baseurl ?>/a_assets/javascript/DataTables/css/jquery.dataTables.min.css">
        <script src = "<?= $baseurl ?>/a_assets/javascript/jquery.js"></script> 
        <script src = "<?= $baseurl ?>/a_assets/javascript/jquery-ui.min.js"></script>
        <script src = "<?= $baseurl ?>/a_assets/javascript/main.js"></script>
        <script src="<?= $baseurl ?>/a_assets/javascript/ckeditor/ckeditor.js"></script>
        <script src="<?= $baseurl ?>/a_assets/javascript/choosen/chosen.jquery.min.js"></script> 
        <script src="<?= $baseurl ?>/a_assets/javascript/DataTables/js/jquery.dataTables.min.js"></script> 
        <script type="text/javascript">
            <?php 
                echo "var base = '".$baseurl."';";
            ?>
        </script>
    </head>
    <body>
        <div class="save_done">
            <div class="my_save_bord"></div>
            <div class="main_save">
                <h4 id='save_not'>Saved</h4>
                <h4 id='update_not'>Update</h4>
            </div>
        </div>
        <header id="main_head">
            <a href="<?= $baseurl ?>/?page=invites" class="logo">
                <span class="logo-lg"><b>Admin</b>KK</span>
            </a>
            <div class='notification'>
                <ul class='main_not_menu'>
                    <li class='dropdown li-not'>
                        <a href="#" class='dropdown-toggle notification-event'>
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-green">0</span>
                        </a>
                        <ul class="dropdown_menu">
                            <li class="header">У вас есть 0 сообщении</li>
                            <li>
                                <div class='slimScrollDiv'>
                                    <ul class='sub_not_menu'>
                                        <?php if(isset($sms)){ foreach ($sms as $val) { ?>
                                            <li>
                                                <a href="?page=prepodovateli-edit&id=<?= $val['prepod'] ?>#my_sms" data-id='<?= $val['id'] ?>' data-table='question_prepodovateli' class='set_show'>
                                                    <div class="pull-left">
                                                        <img src="<?= $baseurl ?>/a_assets/images/user/1.jpg" class="img_circle" alt="User Image">
                                                    </div>
                                                    <h4 class='not_h'>
                                                        <?= $val['name'] ?> <?= $val['fam'] ?> 
                                                          <!--<small><i class="fa fa-clock-o"></i> 5 mins</small>-->
                                                    </h4>
                                                    <p class='not_p'><?= $val['question'] ?> </p>
                                                </a>
                                            </li>
                                        <?php } } ?>
                                    </ul>
                                </div>
                            </li>
                            <li class="footer"><a href="#">Посмотреть все</a></li>
                        </ul>
                    </li>
                    <li class='dropdown li-not'>
                        <a href="#" class='dropdown-toggle notification-event'>
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-orange">4</span>
                        </a>
                        <ul class="dropdown_menu">
                            <li class="header">У вас есть 4 сообщении</li>
                            <li>
                                <div class='slimScrollDiv'>
                                    <ul class='sub_not_menu'>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="<?= $baseurl ?>/a_assets/images/user/1.jpg" class="img_circle" alt="User Image">
                                                </div>
                                                <h4 class='not_h'>
                                                    Support Team
                                                    <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                </h4>
                                                <p class='not_p'>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="footer"><a href="#">Посмотреть все</a></li>
                        </ul>
                    </li>
                    <li class='dropdown li-not'>
                        <a href="#" class='dropdown-toggle notification-event'>
                            <img class='user_not_img' src='<?= $baseurl ?>/a_assets/images/user/1.jpg' alt='' />
                            <span>Kostanyan Karen</span>
                        </a>
                        <ul class="dropdown_menu">
                            <li class="user-header">
                                <img src="<?= $baseurl ?>/a_assets/images/user/1.jpg" class="img-circle" alt="User Image">

                                <p>
                                    Kostanyan Karen - Web Developer
                                    <!--<small>Member since Nov. 2012</small>-->
                                </p>
                            </li>
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="buttin_a">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?= $baseurl ?>/login/logout/" class="buttin_a">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </header>