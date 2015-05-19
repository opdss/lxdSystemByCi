<!-- main container -->
<div class="content">

    <div id="pad-wrapper" class="new-user">
        <div class="row header">
            <div class="col-md-12">
                <h3>新建菜单</h3>
            </div>
        </div>

        <div class="row form-wrapper">
            <!-- left column -->
            <div class="col-md-12">
                <div class="container">
                    <form class="new_user_form">
                        <div class="col-md-4 field-box">
                            <label>订单名称:</label>
                            <input class="form-control" type="text" placeholder="订单名称" name="order_name" />
                        </div>
                        <div class="col-md-12 field-box">
                            <label>订单委托商:</label>
                            <input class="form-control" type="text" placeholder="订单委托商" name="order_jiafang"/>
                        </div>
                        <div class="col-md-12 field-box">
                            <label>订单产品数量:</label>
                            <input class="form-control" type="text" placeholder="订单产品数量" name="order_num"/>
                        </div>
                        <div class="col-md-12 field-box">
                            <label>订单金额:</label>
                            <input class="form-control" type="text" placeholder="订单金额(单位:元)" name="order_amount"/>
                        </div>
                        <div class="col-md-6 field-box">
                            <label>预计开始时间:</label>
                            <input class="form-control input-datepicker" type="text" name="order_start_date" value="<?php echo date('Y-m-d');?>">
                        </div>
                        <div class="col-md-6 field-box">
                            <label>预计完成时间:</label>
                            <input class="form-control input-datepicker" type="text" name="order_end_date" value="">
                        </div>
                        <div class="col-md-4 field-box">
                            <label>订单相关工序:</label>
                            <div class="col-md-10 copy_process_div">
                                <div class="clone_process_div">
                                    <span style="font-size: 14px;margin-right: 20px;">NO.1:</span>
                                    <span>工序名称:  <input type="text" class="small form-control" name="process[process_name][]"></span>
                                    <span>工序价格:  <input type="text" class="small form-control" name="process[process_price][]"><input type="text" class="small form-control  process_desc" name="process[process_desc][]"></span>
                                    <span  class="del_process_div" style="cursor: pointer" title="去除"><i class="icon-remove-sign"></i></span>
                                </div>
                            </div>
                            <div class="col-md-5" style="text-align: center;margin-top: 10px;margin-left: 10px"><span class="label label-success copy_process_div" style="cursor:pointer">增加</span></div>
                        </div>
                        <div class="col-md-12 field-box textarea">
                            <label>订单说明:</label>
                            <div class="col-md-7">
                                <textarea class="form-control" rows="4"  name="order_desc"></textarea>
                            </div>
                        </div>
                        <div class="col-md-11 field-box actions">
                            <input type="button" class="btn-glow primary" value="完成创建" id="add_btn">
                            <span>OR</span>
                            <input type="reset" value="Cancel" class="reset">
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- end main container -->
<script type="text/javascript">
    $(function () {
        // datepicker plugin
        $('.input-datepicker').datepicker({format: "yyyy-mm-dd"}).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });
    });
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
    $('#add_btn').click(function(){
        //用订单名称去填冲process_desc
        $('input.process_desc').val($('input[name=order_name]').val());
        var data = $('form.new_user_form').serialize();
        W.ajax({'data':data},'<?php echo site_url('order/add');?>',function(msg){
            alert(msg.msg);
            if(msg.code==1){
                location.href = '<?php echo site_url('order/index');?>';
            }
        });
    });
</script>