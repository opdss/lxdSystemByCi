<!-- main container -->
<div class="content">

    <div id="pad-wrapper">

        <!-- users table -->
        <div class="table-wrapper users-table section">
            <div class="row head">
                <div class="col-md-12">
                    <h4>角色列表</h4>
                </div>
            </div>

            <div class="row filter-block">
                <div class="pull-right">
                    <input type="text" name="kw" class="search" <?php echo (empty($kw)?'placeholder="搜索..."':"value='{$kw}'");?> onkeydown="if(event.keyCode==13){location.href='<?php echo site_url('role/index')?>?kw='+this.value}" />
                    <a class="btn-flat success new-product" href="<?php echo site_url('role/add')?>">+ 添加用户组</a>
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
                            <span class="line"></span>角色名称
                        </th>
                        <th>
                            <span class="line"></span>角色简介
                        </th>
                        <th class="col-md-2">
                            <span class="line"></span>是否可用
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
                                    <?php echo $val['role_name'];?>
                                </td>
                                <td>
                                    <?php echo $val['role_desc'];?>
                                </td>
                                <td>
                                    <?php if($val['enabled'] == 0){?>
                                        <i class="icon-unlock" title="有效"></i>
                                    <?php }else{?>
                                        <i class="icon-lock" title="禁用"></i>
                                    <?php }?>
                                </td>
                                <td>
                                    <?php echo date('Y-m-d H:i',$val['create_time'])?>
                                </td>
                                <td class="align-right">
                                    <ul class="actions" style="float: left;">
                                        <a href="<?php echo site_url('role/edit');?>?id=<?php echo $val['id'];?>" title="修改"><li class="icon-wrench"></li></a>
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
    //W.ajax({id:3},'<?php echo site_url('role/del');?>');
</script>
