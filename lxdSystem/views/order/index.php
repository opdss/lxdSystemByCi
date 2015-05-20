<!-- main container -->
<div class="content">

    <div id="pad-wrapper">

        <!-- users table -->
        <div class="table-wrapper users-table section">
            <div class="row head">
                <div class="col-md-12">
                    <h4>订单列表</h4>
                </div>
            </div>

            <div class="row filter-block">
                <div class="pull-right" style="margin: 10px">
                    <input type="text" name="kw" class="search" <?php echo (empty($kw)?'placeholder="搜索..."':"value='{$kw}'");?> onkeydown="if(event.keyCode==13){location.href='<?php echo site_url('order/index')?>?kw='+this.value}" />
                    <a class="btn-flat success new-product" href="<?php echo site_url('order/add')?>">添加订单</a>
                </div>
            </div>

            <div class="row">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="col-md-1">
                            <span class="line"></span>订单编号
                        </th>
                        <th class="col-md-1">
                            <span class="line"></span>订单名称
                        </th>
                        <th class="col-md-1">
                            <span class="line"></span>订单委托商
                        </th>
                        <th class="col-md-1">
                            <span class="line"></span>订单金额
                        </th>
                        <th class="col-md-1">
                            <span class="line"></span>订单预估成本
                        </th>
                        <th class="col-md-1">
                            <span class="line"></span>订单工序数
                        </th>
                        <th class="col-md-1">
                            <span class="line"></span>订单简介
                        </th>
                        <th class="col-md-1">
                            <span class="line"></span>添加时间
                        </th>
                        <th class="col-md-1">
                            <span class="line"></span>预计完成日期
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
				                                <td><?php echo $val['order_no'];?></td>
				                                <td>
		<?php echo $val['order_name'];?>
		</td>
				                                <td>
		<?php echo $val['order_jiafang'];?>
		</td>
				                                <td>
		<?php echo $val['order_amount'];?>
		</td>
                                                <td>
                                                    <?php echo $val['order_mate_amount'];?>
                                                </td>
                                                <td>
                                                    <a class="label label-success copy_process_div" href="<?php echo site_url('order/order_process?order_id=').$val['id'];?>" title="点击查看详细"><?php echo $val['order_process_num'];?></a>
                                                </td>
                                                <td>
                                                    <?php echo $val['order_desc'];?>
                                                </td>
				                                <td>
		<?php echo date('Y-m-d', $val['create_time'])?>
				                                </td>
                                                <td>
                                                    <?php echo $val['order_end_date'];?>
                                                </td>
				                                <td class="align-right" data-id="<?php echo $val['id'];?>">
				                                    <ul class="actions" style=" float: left;">
				                                        <a href="javascript:void(0);" title="编辑" class="edit"><li class="icon-wrench"></li></a>
				                                        <a href="javascript:void(0);" title="删除" class="delete"><li class="last icon-remove"></li></a>
				                                    </ul>
				                                </td>
				                            </tr>
		<?php
		$i++;}
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

<!-- scripts -->
<script type="text/javascript">
    $('a.delete').click(function(){
        var id = $(this).parents('td').attr('data-id');
        W.del({'id':id},'<?php echo site_url('order/del');?>');
    });
    $('a.edit').click(function(){
        var id = $(this).parents('td').attr('data-id');
        location.href = "<?php echo site_url('order/edit');?>?id="+id;
    });
</script>
