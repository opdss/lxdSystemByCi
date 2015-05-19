<!-- main container -->
<div class="content">

    <div id="pad-wrapper">

        <!-- users table -->
        <div class="table-wrapper users-table section">
            <div class="row head">
                <div class="col-md-12">
                    <h4><?php echo $order_info['order_name'];?>-工序</h4>
                </div>
            </div>

            <div class="row filter-block">
                <div class="pull-right" style="margin: 10px;">
                    <span style="margin-right: 12px"><?php echo $order_info['order_name'];?></span>
                    <a class="btn-flat success new-product add_order_pricess" href="javascript:void(0)">添加该订单工序</a>
                </div>
            </div>

            <div class="row">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="col-md-1">
                            <span class="line"></span>工序ID
                        </th>
                        <th class="col-md-1">
                            <span class="line"></span>工序名称
                        </th>
                        <th class="col-md-1">
                            <span class="line"></span>工序价格
                        </th>
                        <th class="col-md-1">
                            <span class="line"></span>工序说明
                        </th>
                        <th class="col-md-1">
                            <span class="line"></span>该订单工序预估成本
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
                                <td><?php echo $val['process_id'];?></td>
                                <td>
                                    <?php echo $val['process_name'];?>
                                </td>
                                <td>
                                    <?php echo $val['process_price'];?>
                                </td>
                                <td>
                                    <?php echo $val['process_desc'];?>
                                </td>
                                <td>
                                    <?php echo round($val['process_price']*$order_info['order_num'],2);?>
                                </td>
                                <td class="align-right" data-id="<?php echo $val['id'];?>">
                                    <ul class="actions" style=" float: left;">
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
                <div id="add_process_div" style="display: none">
                <form>
                    <input type="hidden" name="order_id" value="<?php echo $order_info['id'];?>">
                    <div class="col-md-12 field-box process_box">
                        <div class="col-md-10 copy_process_div">
                            <h4>追加工序-<?php echo $order_info['order_name'];?>：</h4>
                            <div class="clone_process_div" style="padding-left: 40px;margin:2px 0px">
                                <span style="font-size: 14px;margin-right: 20px;">NO.1:</span>
                                    <span>
                                    工序名称:
                                    <input class="small form-control" type="text" name="process[process_name][]" style="width: 120px;display: inline-block">
                                    </span>
                                    <span>
                                    工序价格:
                                    <input class="small form-control" type="text" name="process[process_price][]" style="width: 120px;display: inline-block">
                                    </span>
                                    <span>
                                    工序简介:
                                    <input class="small form-control" type="text" name="process[process_desc][]" value="<?php echo $order_info['order_name'];?>" style="width: 200px;display: inline-block">
                                    </span>
                                    <span class="del_process_div" title="去除" style="cursor: pointer">
                                    <i class="icon-remove-sign"></i>
                                    </span>
                            </div>
                        </div>
                        <div class="col-md-5" style="text-align: center;margin-top: 10px;margin-left: 10px">
                            <span class="label label-success copy_process_div" style="cursor:pointer">+增加</span>
                            <span class="label label-success add_process_btn" style="cursor:pointer">确认完成</span>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!-- end users table -->
    </div>
</div>
<!-- end main container -->

<!-- scripts -->
<script type="text/javascript">
    var F = {
        num : 1,
        process_div : $('div.clone_process_div').clone(),
        createProcess : function(){
            F.num++;
            F.process_div.find('span:eq(0)').text('NO.'+ F.num);
            $('div.copy_process_div').append(F.process_div.clone());
        }
    }
    $('span.copy_process_div').click(function(){F.createProcess();});
    $('div.copy_process_div').on('click','span.del_process_div',function(){$(this).parent('div.clone_process_div').remove();});
    $('a.add_order_pricess').click(function(){
        $('#add_process_div').css('display','block');
        location.href = '#add_process_div';
    });
    $('span.add_process_btn').click(function(){
        var data = $(this).parents('form').serialize();
        W.ajax({'data':data},"<?php echo site_url('order/order_process');?>");
    });
    $('a.delete').click(function(){
        var id = $(this).parents('td').attr('data-id');
        W.del({'id':id},'<?php echo site_url('order/del_order_process');?>');
    });
</script>
