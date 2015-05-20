<!-- main container -->
<div class="content">

    <div id="pad-wrapper" class="new-user">
        <div class="row header">
            <div class="col-md-12">
                <h3>修改订单</h3>
            </div>
        </div>

        <div class="row form-wrapper">
            <!-- left column -->
            <div class="col-md-12">
                <div class="container">
                    <form class="new_user_form">
                        <input type="hidden" name="order_id" value="<?php echo $order_info['id'];?>"/>
                        <div class="col-md-4 field-box" style="width:800px;">
                            <label style="width:84px;text-align: right; margin-right: 20px;">订单名称:</label>
                            <input class="form-control" type="text" style="width: 422px;" placeholder="订单名称(必填)" name="order_name" value="<?php echo $order_info['order_name'];?>"/>
                            <span class="alert-msg validate_is_null" style="color:red;font-weight:700;" hidden="hidden"><img src="../../source/img/myimg_deyi.png" style="width:20px;" />别忘了填订单名称</span>
                        </div>
                        <div class="col-md-12 field-box" style="width:800px;">
                            <label style="width:84px;text-align: right; margin-right: 20px;">订单委托商:</label>
                            <input class="form-control" type="text" style="width: 422px;" placeholder="订单委托商(必填)" name="order_jiafang" value="<?php echo $order_info['order_jiafang'];?>"/>
                            <span class="alert-msg validate_is_null" style="color:red;font-weight:700;width:100px;" hidden="hidden"><img src="../../source/img/myimg_baituo.png" style="width:20px;" />填一下委托商吧，以后用得着</span>
                        </div>
                        <div style="width:800px;">
                        <div class="col-md-12 field-box" style="width:330px;">
                            <span style="font-size:13px;font-weight:700;width:84px;text-align: right; margin-right: 20px;">订单产品数量:</span>
                            <input class="form-control" type="text" name="order_num" placeholder="产品数量(必填)" style="width:120px;" value="<?php echo $order_info['order_num'];?>" onkeyup="value=value.replace(/[^\d]/g,'')"/>
                            <span class="alert-msg validate_is_null" style="color:red;font-weight:700;" hidden="hidden"><img src="../../source/img/myimg_koubi.png" style="width:20px;" />给个数吧</span>
                        </div>
                            <div style="width:330px;float:left;">
                                <span  style="font-size:13px;font-weight:700;width:84px;text-align: right; margin-right: 20px;">订单总金额:</span>
                            <input class="form-control" type="text" name="order_amount" placeholder="金额(元)(必填)" style="width:120px;" value="<?php echo $order_info['order_amount'];?>" onkeyup="value=value.replace(/[^\d\.]/g,'')"/>
                            <span class="alert-msg validate_is_null" style="color:red;font-weight:700;" hidden="hidden"><img src="../../source/img/myimg_kelian.png" style="width:20px;" />给点吧</span>
                            <span class="alert-msg validate_is_num" style="color:red;font-weight:700;" hidden="hidden"><img src="../../source/img/myimg_liuhan.png" style="width:20px;" /></span>
                        </div>
                        </div>
                        <div class="col-md-6 field-box" style="width:800px;">
                            <span style="font-size:13px;font-weight:700;width:84px;text-align: right; margin-right: 20px;">预计开始时间:</span>
                            <input class="form-control input-datepicker validate_start_date" style="width: 120px; color:black;" readonly="readonly" type="text" name="order_start_date" value="<?php echo $order_info['order_start_date'];?>">
                            <span  style="font-size:13px;font-weight:700;width:84px;text-align: right; margin:0 20px 0 75px;">预计完成时间:</span>
                            <input class="form-control input-datepicker validate_end_date" style="width: 120px; color:black;" readonly="readonly" type="text" name="order_end_date" value="<?php echo $order_info['order_end_date'];?>">
                            <span class="alert-msg validate_date" style="color: red;font-weight:700;" hidden="hidden"><img src="../../source/img/myimg_question.png" style="width:20px;" />完成时间比开始时间还要早么？</span>
                        </div>
                        <div class="col-md-4 field-box" style="width:800px;">
                            <a style="width:84px;text-align: right;" href="<?php echo site_url('order/order_process').'?order_id='.$order_info['id'];?>">订单相关工序修改</a>
                        </div>
                        <div class="col-md-12 field-box textarea" style="width:800px;">
                            <label style="width:84px;text-align: right;margin-right:20px;">订单说明:</label>
                            <div class="col-md-7">
                                <textarea class="form-control" rows="4" name="order_desc" style="width:422px;" placeholder="订单说明(必填)"></textarea>
                                <span class="alert-msg validate_is_null" style="color:red;font-weight:700;float:right;" hidden="hidden"><img src="../../source/img/myimg_woshou.png" style="width:20px;" />介绍下订单吧，以后订单多了可是会省去不少功夫的!<img src="../../source/img/gif/11.gif" style="margin-top:5px;width:80px;" /></span>
                            </div>
                        </div>
                        <div class="col-md-11 field-box actions">
                            <input type="button" class="btn-glow primary" value="完成创建" id="add_btn">
                            <span>OR</span>
                            <input type="reset" value="重置所有信息" class="reset">
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

    // 提交
    $('#add_btn').click(function(){
        var data = $('form.new_user_form').serialize();
        W.ajax({'data':data},'<?php echo site_url('order/add');?>',function(msg){
            //alert(msg.msg);
            if(msg.code==1){
                alert('订单添加成功！');
                location.href = '<?php echo site_url('order/index');?>';
            } else {
                //为空的情况(除工序)
                $('.form-control').each(function(index,item) {
                    validate_null($(item));
                });
                //工序
                $('input.small').each(function(index, item) {
                    validate_process($(item));
                });
            }
        });
    });
    $('#add_btn').click(function(){
        var data = $('form.new_user_form').serialize();
        W.ajax({'data':data},'<?php echo site_url('order/edit');?>',function(msg) {
            alert(msg.msg);
            if (msg.code == 1) {
                location.href = '<?php echo site_url('order/index');?>';
            }
        });
    });



    //检验是否为数字
    function validate_num(obj) {
        var attr_name = obj.attr('name');
        if (attr_name == 'process[process_name][]') {
        } else {
            if(obj.val() != '' && Number(obj.val())+''=='NaN') {
                obj.siblings('span.validate_is_num').removeAttr('hidden');
            } else {
                obj.siblings('span.validate_is_num').attr('hidden', 'hidden');
            }
        }
    }

    //校验空字符串
    function validate_null(obj) {
        //工序的是两个一起判断
        var attr_name = obj.attr('name');
        if (attr_name == 'process[process_name][]' || attr_name == 'process[process_price][]') {
        } else {
            if (obj.val()=='') {
                obj.siblings('span.validate_is_null').removeAttr('hidden');
            } else {
                obj.siblings('span.validate_is_null').attr('hidden', 'hidden');
            }
        }
    }

    //检验时间
    $('.input-datepicker').on('change', function () {
        var attrName = $(this).attr('name');
        if (attrName=='order_start_date' || attrName=='order_end_date') {
            var start_date = $('.validate_start_date').val().replace(/-/g,'');
            var end_date = $('.validate_end_date').val().replace(/-/g,'');

            if(Number(end_date) < Number(start_date)) {
                $(this).siblings('span.validate_date').removeAttr('hidden');
            } else {
                $(this).siblings('span.validate_date').attr('hidden', 'hidden');
            }
        }
    });

</script>