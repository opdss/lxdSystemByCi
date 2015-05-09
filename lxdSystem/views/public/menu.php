<!-- sidebar -->
<div id="sidebar-nav">
    <ul id="dashboard-menu">
        <li>
            <a href="index.html">
                <i class="icon-home"></i>
                <span>Home</span>
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
                <li><a href="<?php echo site_url($k.'/'.$_k);?>"><?php echo $_v;?></a></li>
                <?php endforeach;?>
            </ul>
            <?php endif;?>
        </li>
        <?php endforeach;?>
    </ul>
</div>
<!-- end sidebar -->