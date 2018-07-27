<div id="menu">	
    <div class='user_panel'>
        <div class="pull-left image">
            <img src="<?= $baseurl ?>/a_assets/images/user/1.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p>Alexander Pierce</p>
            <a href="#"><i class="fa fa-circle"></i> Online</a>
        </div>
    </div>
    <ul class='sidebar-menu'>
        <li class='header'>NAVIGATION</li>
        <li class="menuli _click_next <?= $page == 'contact' || $page == 'partners' || $page == 'partners_chenge' || $page == 'tips' || $page == 'tips_chenge' || $page == 'events' || $page == 'events_chenge' || $page == 'about' || $page == 'partners' || $page == 'partners_chenge' ? "active" : "" ?>">
            <i class="fa fa-book"></i> 
            <span>Main pages</span>
            <span class='open_sub_menu pull-right'><i class="fa fa-chevron-down"></i></span>
        </li>
        <ul class='main_sub_menu <?= $page == 'contact' || $page == 'partners' || $page == 'partners_chenge' || $page == 'tips' || $page == 'tips_chenge' || $page == 'events' || $page == 'events_chenge' || $page == 'about' ? "active_sub" : "" ?>'>
            <li class="header">Pages</li>
            <a href='<?= $baseurl ?>/news/7/'>
                <li class='sub_menu <?= $page == 'events' || $page == 'events_chenge' ? "sub_active'" : "" ?>'>
                    <i class="fa fa-circle-o"></i>
                    <span> News</span>
                </li>
            </a>

            <a href='<?= $baseurl ?>/news/7/asd/'>
                <li class='sub_menu <?= $page == 'events' || $page == 'events_chenge' ? "sub_active'" : "" ?>'>
                    <i class="fa fa-circle-o"></i>
                    <span> News Menu</span>
                </li>
            </a>

            <a href='<?= $baseurl ?>/advaisors/1/'>
                <li class='sub_menu <?= $page == 'tips' || $page == 'tips_chenge' ? "sub_active'" : "" ?>'>
                    <i class="fa fa-circle-o"></i>
                    <span> Advaisors</span>
                </li>
            </a>
            <a href='<?= $baseurl ?>/about/8/'>
                <li class='sub_menu <?= $page == 'about' ? "sub_active'" : "" ?>'>
                    <i class="fa fa-circle-o"></i>
                    <span>About</span>
                </li>
            </a>
            <a href='<?= $baseurl ?>/indicators/2/'>
                <li class='sub_menu <?= $page == 'partners' || $page == 'partners_chenge' ? "sub_active'" : "" ?>'>
                    <i class="fa fa-circle-o"></i>
                    <span>Indicators</span>
                </li>
            </a>
            <a href='<?= $baseurl ?>/forexbrokers/3/'>
                <li class='sub_menu <?= $page == 'contact' || $page == 'contact' ? "sub_active'" : "" ?>'>
                    <i class="fa fa-circle-o"></i>
                    <span>Forex Brokers</span>
                </li>
            </a>

            <a href='<?= $baseurl ?>/forexbrokers/3/asd/'>
                <li class='sub_menu <?= $page == 'contact' || $page == 'contact' ? "sub_active'" : "" ?>'>
                    <i class="fa fa-circle-o"></i>
                    <span>Forex Brokers Menu</span>
                </li>
            </a>

            <a href='<?= $baseurl ?>/daylysignals/4/'>
                <li class='sub_menu <?= $page == 'contact' || $page == 'contact' ? "sub_active'" : "" ?>'>
                    <i class="fa fa-circle-o"></i>
                    <span>Dayly Signals</span>
                </li>
            </a>
            <a href='<?= $baseurl ?>/sporttips/5/'>
                <li class='sub_menu <?= $page == 'contact' || $page == 'contact' ? "sub_active'" : "" ?>'>
                    <i class="fa fa-circle-o"></i>
                    <span>Sport Tips</span>
                </li>
            </a>
            <li class="fotter_menu"></li>
        </ul> 
        <li class='header'>Product</li>
        <a href='<?= $baseurl ?>/product/'>
            <li class='sub_menu <?= $page == 'feedback'?>'>
                <i class="fa fa-envelope"></i>
                <span>Product</span>
            </li>
        </a>
        <a href='<?= $baseurl ?>/product/banner/'>
            <li class='sub_menu <?= $page == 'feedback'?>'>
                <i class="fa fa-envelope"></i>
                <span>Banner</span>
            </li>
        </a>

        <a href='<?= $baseurl ?>/sporttips/statistic/4/8/'>
            <li class='sub_menu <?= $page == 'statistic'?>'>
                <i class="fa fa-envelope"></i>
                <span>Statistic</span>
            </li>
        </a>
    </ul>
</div>
