<!-- main container -->
<div class="content">

    <div id="pad-wrapper">

        <!-- users table -->
        <div class="table-wrapper users-table section">
            <div class="row head">
                <div class="col-md-12">
                    <h4>工序列表</h4>
                </div>
            </div>

            <div class="row filter-block">
                <div class="pull-right">
                    <input type="text" name="kw" class="search" <?php echo (empty($kw)?'placeholder="搜索..."':"value='{$kw}'");?>onkeydown="if(event.keyCode==13){location.href='/User/Role/Index?kw='+this.value}" />

                </div>
            </div>

            <div class="row">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="col-md-1">
                            ID
                        </th>
                        <th class="col-md-2">
                            <span class="line"></span>工序名称
                        </th>
                        <th class="col-md-3">
                            <span class="line"></span>工序价格
                        </th>
                        <th>
                            <span class="line"></span>所属订单
                        </th>
                        <th class="col-md-2">
                            <span class="line"></span>添加时间
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
		<?php echo $val['process_name'];?>
		</td>
		            <td>
		<?php echo $val['process_price'];?>
		</td>
		            <td>
		<?php echo $val['order_name'];?>
		</td>
		            <td>
		<?php echo date('Y-m-d H:i', $val['create_time'])?>
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