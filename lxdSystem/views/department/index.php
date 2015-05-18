<!-- main container -->
<div class="content">

    <div id="pad-wrapper">

        <!-- users table -->
        <div class="table-wrapper users-table section">
            <div class="row head">
                <div class="col-md-12">
                    <h4>部门列表</h4>
                </div>
            </div>

            <div class="row filter-block">
                <div class="pull-right">
                    <input type="text" name="kw" class="search" <?php echo (empty($kw)?'placeholder="搜索..."':"value='{$kw}'");?> onkeydown="if(event.keyCode==13){location.href='<?php echo site_url('department/index')?>?kw='+this.value}" />
                    <a class="btn-flat success new-product" href="<?php echo site_url('department/add')?>">+ 添加部门</a>
                </div>
            </div>

            <div class="row">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="col-md-1">
                            ID
                        </th>
                        <th class="col-md-3">
                            <span class="line"></span>部门编号
                        </th>
                        <th class="col-md-2">
                            <span class="line"></span>部门名称
                        </th>
                        <th class="col-md-3">
                            <span class="line"></span>部门简介
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
                    if(!empty($list)){
                        foreach($list as $val){
                            ?>
                            <tr <?php echo ($i == 0 ? 'class="first"' : '');?>>
                                <td><?php echo $val['id'];?></td>
                                <td>
                                    <?php echo $val['dept_no'];?>
                                </td>
                                <td>
                                    <?php echo $val['dept_name'];?>
                                </td>
                                <td>
                                    <?php echo $val['dept_desc'];?>
                                </td>
                                <td>
                                    <?php echo date('Y-m-d H:i',$val['create_time'])?>
                                </td>
                                <td class="align-right" data-id="<?php echo $val['id'];?>">
                                    <ul class="actions" style="float: left;">
                                        <a href="javascript:void(0);" title="修改" class="edit"><li class="icon-wrench"></li></a>
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
        W.del({'id':id},'<?php echo site_url('department/del');?>');
    });
    $('a.edit').click(function(){
        var id = $(this).parents('td').attr('data-id');
        location.href = "<?php echo site_url('department/edit');?>?id="+id;
    });
</script>
