
<!-- navbar -->
<header class="navbar navbar-inverse" role="banner">
    <div class="navbar-header">
        <button class="navbar-toggle" type="button" data-toggle="collapse" id="menu-toggler">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
<!--        <a class="navbar-brand" href="index.html">鑫达鞋业信息管理系统</a>-->
        <h3 style="color:white; margin: 5px 30px;" ><?php echo $_SET->systemName->value;?></h3>
    </div>
    <ul class="nav navbar-nav pull-right hidden-xs">
<!--        <li class="hidden-xs hidden-sm">-->
<!--            <input class="search" type="text" />-->
<!--        </li>-->
<!--        <li class="notification-dropdown hidden-xs hidden-sm">-->
<!--            <a href="#" class="trigger">-->
<!--                <i class="icon-warning-sign"></i>-->
<!--                <span class="count">8</span>-->
<!--            </a>-->
<!--            <div class="pop-dialog">-->
<!--                <div class="pointer right">-->
<!--                    <div class="arrow"></div>-->
<!--                    <div class="arrow_border"></div>-->
<!--                </div>-->
<!--                <div class="body">-->
<!--                    <a href="#" class="close-icon"><i class="icon-remove-sign"></i></a>-->
<!--                    <div class="notifications">-->
<!--                        <h3>You have 6 new notifications</h3>-->
<!--                        <a href="#" class="item">-->
<!--                            <i class="icon-signin"></i> New user registration-->
<!--                            <span class="time"><i class="icon-time"></i> 13 min.</span>-->
<!--                        </a>-->
<!--                        <a href="#" class="item">-->
<!--                            <i class="icon-signin"></i> New user registration-->
<!--                            <span class="time"><i class="icon-time"></i> 18 min.</span>-->
<!--                        </a>-->
<!--                        <a href="#" class="item">-->
<!--                            <i class="icon-envelope-alt"></i> New message from Alejandra-->
<!--                            <span class="time"><i class="icon-time"></i> 28 min.</span>-->
<!--                        </a>-->
<!--                        <a href="#" class="item">-->
<!--                            <i class="icon-signin"></i> New user registration-->
<!--                            <span class="time"><i class="icon-time"></i> 49 min.</span>-->
<!--                        </a>-->
<!--                        <a href="#" class="item">-->
<!--                            <i class="icon-download-alt"></i> New order placed-->
<!--                            <span class="time"><i class="icon-time"></i> 1 day.</span>-->
<!--                        </a>-->
<!--                        <div class="footer">-->
<!--                            <a href="#" class="logout">View all notifications</a>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </li>-->
        <li class="notification-dropdown hidden-xs hidden-sm">
<!--            <a href="#" class="trigger">-->
<!--                <i class="icon-envelope"></i>-->
<!--            </a>-->
            <div class="pop-dialog">
                <div class="pointer right">
                    <div class="arrow"></div>
                    <div class="arrow_border"></div>
                </div>
                <div class="body">
                    <a href="#" class="close-icon"><i class="icon-remove-sign"></i></a>
                    <div class="messages">
                        <a href="#" class="item">
                            <img src="<?php echo base_url('source/img/contact-img.png');?>" class="display" />
                            <div class="name">Alejandra Galván</div>
                            <div class="msg">
                                There are many variations of available, but the majority have suffered alterations.
                            </div>
                            <span class="time"><i class="icon-time"></i> 13 min.</span>
                        </a>
                        <a href="#" class="item">
                            <img src="<?php echo base_url('source/img/contact-img2.png');?>" class="display" />
                            <div class="name">Alejandra Galván</div>
                            <div class="msg">
                                There are many variations of available, have suffered alterations.
                            </div>
                            <span class="time"><i class="icon-time"></i> 26 min.</span>
                        </a>
                        <a href="#" class="item last">
                            <img src="<?php echo base_url('source/img/contact-img.png');?>" class="display" />
                            <div class="name">Alejandra Galván</div>
                            <div class="msg">
                                There are many variations of available, but the majority have suffered alterations.
                            </div>
                            <span class="time"><i class="icon-time"></i> 48 min.</span>
                        </a>
                        <div class="footer">
                            <a href="#" class="logout">View all messages</a>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle hidden-xs hidden-sm" data-toggle="dropdown">
                账户信息
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
                <li><a href="<?php echo site_url('user/edit');?>?id=<?php echo $this->session->userdata('uid').'&type=info';?>">个人信息</a></li>
                <li><a href="<?php echo site_url('setting/editPwd');?>">密码修改</a></li>
            </ul>
        </li>
        <li class="settings hidden-xs hidden-sm">
            <a href="<?php echo site_url('setting/index');?>" role="button">
                <i class="icon-cog"></i>
            </a>
        </li>
        <li class="settings hidden-xs hidden-sm">
            <a href="<?php echo site_url('login/loginOut');?>" role="button">
                <i class="icon-share-alt"></i>
            </a>
        </li>
    </ul>
</header>
<!-- end navbar -->
<!-- sidebar -->
<div id="sidebar-nav">
    <ul id="dashboard-menu">
        <li>
            <a href="<?php echo site_url('welcome/index');?>">
                <i class="icon-home"></i>
                <span>欢迎</span>
            </a>
        </li>

        <?php foreach($menu as $k=>$v):?>
        <li>
            <a class="dropdown-toggle" href="#">
                <i class="<?php echo $v['style'];?>"></i>
                <span><?php echo $v['desc']?></span>
                <i class="icon-chevron-down"></i>
            </a>
            <?php if(isset($v['submenu']) && !empty($v['submenu'])): ?>
            <ul class="submenu">
                <?php foreach($v['submenu'] as $_k=>$_v):?>
                <li><a href="<?php echo site_url($_k);?>"><?php echo $_v;?></a></li>
                <?php endforeach;?>
            </ul>
            <?php endif;?>
        </li>
        <?php endforeach;?>
    </ul>
</div>
<!-- end sidebar -->