<!-- main container -->
<div class="content">

    <div id="pad-wrapper">

        <!-- users table -->
        <div class="table-wrapper users-table section">
            <div class="row head">
                <div class="col-md-12">
                    <h4>薪资列表</h4>
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
                            序号
                        </th>
                        <th class="col-md-1">
                            <span class="line"></span>员工姓名
                        </th>
                        <th class="col-md-1">
                            <span class="line"></span>月份
                        </th>
                        <th class="col-md-1">
                            <span class="line"></span>薪资
                        </th>
                        <th class="col-md-1">
                            <span class="line"></span>创建时间
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
            <td><?php echo $i+1;?></td>
            <td>
            <?php echo $val['username'];?>
            </td>
            <td>
            <?php echo $val['work_month'];?>
            </td>
            <td>
            <?php echo $val['salary'];?>
            </td>
            <td>
            <?php echo date('Y-m-d', $val['create_time'])?>
            </td>

		    <td class="align-right">
		        <ul class="actions" style="...">
		            <a href="<?php echo site_url('user_salary/edit');?>?sign=<?php echo $val['sign']?>" title="编辑"><li class="icon-wrench"></li></a>
		            <a href="<?php echo site_url('user_salary/info');?>?sign=<?php echo $val['sign']?>" title="详情"><li class="last icon-cog"></li></a>
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
        <div class="col-md-11 field-box actions">
            <input type="button" class="btn-glow primary" onclick="window.location.href='<?php echo site_url('user_salary/exportUserSalaryList');?>';" value="导出xls">
        </div>
    </div>
</div>
<!-- end main container -->

