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
                                                    <?php echo $val['order_process_num'];?>
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
				                                <td class="align-right">
				                                    <ul class="actions" style=" float: left;">
				                                        <a href="/User/Role/Edit?id=<?php echo $val['id'];?>" title="编辑"><li class="icon-wrench"></li></a>
				                                        <a href="javascript:void(0);" title="删除" onclick="del(<?php echo $val['id'];?>);"><li class="last icon-remove"></li></a>
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
    function del(id){
        if(confirm('确定要删除吗？')){
            $.ajax({
                url: '/User/Role/Del',
                type: "post",
                dataType: 'json',
                timeout: 50000,
                data:{'id':id},
                success: function (rs) {
                    if(rs == 1){
                        window.location.href = window.location.href;
                    }else{
                        alert(rs);
                    }
                },
                error: function(xhr){
                    alert("出现未知错误");
                }
            });
        }
    }
</script>
