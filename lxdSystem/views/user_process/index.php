<!-- main container -->
<div class="content">

    <div id="pad-wrapper">

        <!-- users table -->
        <div class="table-wrapper users-table section">
            <div class="row head">
                <div class="col-md-12">
                    <h4>员工工序列表</h4>
                </div>
            </div>

            <div class="row filter-block">
                <div class="pull-right">
                    <input type="text" name="kw" class="search" <?php echo (empty($kw)?'placeholder="搜索..."':"value='{$kw}'");?>onkeydown="if(event.keyCode==13){location.href='/User/Role/Index?kw='+this.value}" />
                    <a class="btn-flat success new-product" href="/User/Role/Add">+ 添加用户组</a>
                </div>
            </div>

            <div class="row">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="col-md-1">
                            ID
                        </th>
                        <th class="col-md-1">
                            <span class="line"></span>员工姓名
                        </th>
                        <th class="col-md-1">
                            <span class="line"></span>订单名称
                        </th>
                        <th class="col-md-1">
                            <span class="line"></span>工序名称
                        </th>
                        <th class="col-md-1">
                            <span class="line"></span>工序价格
                        </th>
                        <th class="col-md-1">
                            <span class="line"></span>工序数量
                        </th>
                        <th class="col-md-1">
                            <span class="line"></span>添加时间
                        </th>
                        <th class="col-md-1">
                            <span class="line"></span>该道工序总金额
                        </th>
                        <th class="col-md-1">
                            <span class="line"></span>操作
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- row -->
<?php
$i = 0;
if (!empty($list)) {
	foreach ($list as $val) {
?>
                    <tr <?php echo ($i == 0?'class="first"':'');?>>
                        <td><?php echo $val['id'];?></td>
                        <td>
                            <?php echo $val['truename'];?>
                        </td>
                        <td>
                            <?php echo $val['order_name'];?>
                        </td>
                        <td>
                            <?php echo $val['process_name'];?>
                        </td>
                        <td>
                            <?php echo $val['process_price'];?>
                        </td>
                        <td>
                            <?php echo $val['process_num'];?>
                        </td>
                        <td>
                            <?php echo date('Y-m-d', $val['create_time'])?>
                        </td>
                        <td>
                            <?php echo $val['process_num']*$val['process_price']?>
                        </td>
                        <td class="align-right">
                            <ul class="actions" style="...">
                                <a href="<?php echo site_url('user_process/edit').'?id='.$val['id'];?>" title="编辑"><li class="icon-wrench"></li></a>
                            </ul>
                        </td>
                    </tr>
<?php
		$i++;
    }
}
?>
</tbody>
                </table>
                <ul class="pagination pull-right">
<?php echo $page_show;?>
</ul>
            </div>
        </div>
        <!-- end users table -->
    </div>
</div>
<!-- end main container -->
