<!-- main container -->
<div class="content">

    <div id="pad-wrapper" class="new-user">
        <div class="row header">
            <div class="col-md-12">
                <h3>新建订单</h3>
            </div>
        </div>

        <div class="row form-wrapper">
            <!-- left column -->
            <div class="col-md-12">
                <div class="container">
                    <form class="new_user_form">
                        <div class="col-md-4 field-box" style="width:800px;">
                            <label style="width:84px;text-align: right; margin-right: 20px;">订单名称:</label>
                            <input class="form-control" type="text" style="width: 422px;" placeholder="订单名称(必填)" name="order_name" />
                            <span class="alert-msg validate_is_null" style="color:red;font-weight:700;" hidden="hidden"><img src="<?php echo base_url('source/img/myimg_deyi.png'); ?>" style="width:20px;" />别忘了填订单名称</span>
                        </div>
                        <div class="col-md-12 field-box" style="width:800px;">
                            <label style="width:84px;text-align: right; margin-right: 20px;">订单委托商:</label>
                            <input class="form-control" type="text" style="width: 422px;" placeholder="订单委托商(必填)" name="order_jiafang"/>
                            <span class="alert-msg validate_is_null" style="color:red;font-weight:700;width:100px;" hidden="hidden"><img src="<?php echo base_url('source/img/myimg_baituo.png'); ?>" style="width:20px;" />填一下委托商吧，以后用得着</span>
                        </div>
                        <div style="width:800px;">
                        <div class="col-md-12 field-box" style="width:330px;">
                            <span style="font-size:13px;font-weight:700;width:84px;text-align: right; margin-right: 20px;">订单产品数量:</span>
                            <input class="form-control" type="text" name="order_num" placeholder="产品数量(必填)" style="width:120px;" onkeyup="value=value.replace(/[^\d]/g,'')"/>
                            <span class="alert-msg validate_is_null" style="color:red;font-weight:700;" hidden="hidden"><img src="<?php echo base_url('source/img/myimg_koubi.png'); ?>" style="width:20px;" />给个数吧</span>
                        </div>
                            <div style="width:330px;float:left;">
                                <span  style="font-size:13px;font-weight:700;width:84px;text-align: right; margin-right: 20px;">订单总金额:</span>
                            <input class="form-control" type="text" name="order_amount" placeholder="金额(元)(必填)" style="width:120px;" onkeyup="value=value.replace(/[^\d\.]/g,'')"/>
                            <span class="alert-msg validate_is_null" style="color:red;font-weight:700;" hidden="hidden"><img src="<?php echo base_url('source/img/myimg_kelian.png'); ?>" style="width:20px;" />给点吧</span>
                            <span class="alert-msg validate_is_num" style="color:red;font-weight:700;" hidden="hidden"><img src="<?php echo base_url('source/img/myimg_liuhan.png'); ?>" style="width:20px;" /></span>
                        </div>
                        </div>
                        <div class="col-md-6 field-box" style="width:800px;">
                            <span style="font-size:13px;font-weight:700;width:84px;text-align: right; margin-right: 20px;">预计开始时间:</span>
                            <input class="form-control input-datepicker validate_start_date" style="width: 120px; color:black;" readonly="readonly" type="text" name="order_start_date" value="<?php echo date('Y-m-d');?>">
                            <span  style="font-size:13px;font-weight:700;width:84px;text-align: right; margin:0 20px 0 75px;">预计完成时间:</span>
                            <input class="form-control input-datepicker validate_end_date" style="width: 120px; color:black;" readonly="readonly" type="text" name="order_end_date" value="<?php echo date('Y-m-d');?>">
                            <span class="alert-msg validate_date" style="color: red;font-weight:700;" hidden="hidden"><img src="<?php echo base_url('source/img/myimg_question.png'); ?>" style="width:20px;" />完成时间比开始时间还要早么？</span>
                        </div>
                        <div class="col-md-4 field-box" style="width:800px;">
                            <label style="width:84px;text-align: right;">相关工序:</label>
                            <div class="col-md-10 copy_process_div">
                                <div class="clone_process_div" style="width:800px;">
                                    <span style="font-size: 14px;margin-right: 20px;">NO.1</span>
                                    <input type="text" class="small form-control" placeholder="工序名称" name="process[process_name][]" style="width:120px;margin-right:5px;">
                                    <input type="text" class="small form-control" placeholder="工序价格(元)" name="process[process_price][]" style="width:90px;margin-right:5px;" onkeyup="value=value.replace(/[^\d\.]/g,'')">
                                    <input type="text" class="small form-control  process_desc" placeholder="工序简介" name="process[process_desc][]" style="width:150px;">
                                    <span style="cursor:pointer;" title="删除工序" class="del_process_div" hidden="hidden"><i class="icon-remove-sign"></i></span>
                                    <span class="alert-msg validate_is_null validate_process" style="color:red;font-weight:700;" hidden="hidden"><img src="<?php echo base_url('source/img/myimg_baituo.png'); ?>" style="width:20px;" />把这个工序先填完吧</span>
                                    <span class="alert-msg validate_is_num" style="color:red;font-weight:700;" hidden="hidden"><img src="<?php echo base_url('source/img/myimg_fadai.png'); ?>" style="width:20px;" />我数学不好，不要骗我</span>

                                </div>
                            </div>
                            <div class="col-md-5" style="text-align: center;margin-top: 10px;margin-right: 21%; float: right;"><span class="label label-success copy_process_div" style="cursor:pointer">增加工序</span></div>
                        </div>
                        <div class="col-md-12 field-box textarea" style="width:800px;">
                            <label style="width:84px;text-align: right;margin-right:20px;">订单说明:</label>
                            <div class="col-md-7">
                                <textarea class="form-control" rows="4" name="order_desc" style="width:422px;" placeholder="订单说明(必填)"></textarea>
                                <span class="alert-msg validate_is_null" style="color:red;font-weight:700;float:right;" hidden="hidden"><img src="<?php echo base_url('source/img/myimg_woshou.png'); ?>" style="width:20px;" />介绍下订单吧，以后订单多了可是会省去不少功夫的!<img src="<?php echo base_url('source/img/gif/11.gif'); ?>" style="margin-top:5px;width:80px;" /></span>
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

    var F = {
        num : 1,
        process_div : $('div.clone_process_div').clone(),
        createProcess : function(){
            F.num++;
            F.process_div.find('span:eq(0)').text('NO.'+ F.num);
            $('div.copy_process_div').append(F.process_div.clone());
            //第一个工序不能删除
            $('span.del_process_div').each(function(index, item) {
                if (index > 0) {
                    $(item).removeAttr('hidden');
                }
            });
        }
    }
    $('#add_btn').click(function(){
        //用订单名称去填冲process_desc
        $('input.process_desc').val($('input[name=order_name]').val());
        var data = $('form.new_user_form').serialize();
        W.ajax({'data':data},'<?php echo site_url('order/add');?>',function(msg) {
            alert(msg.msg);
            if (msg.code == 1) {
                location.href = '<?php echo site_url('order/index');?>';
            }
        });
    });

    //添加工序节点
    $('span.copy_process_div').click(function(){
        var flag = true;
        //判断已有的工序中是否有空的情况
        $('input.small').each(function(index, item) {
            if($(item).val() == '') {
                flag = false;
                validate_process($(item));
            } else {
                if(Number($(item).val()+'' == "NaN")) {
                    flag = false;
                    validate_num($(item));
                }
            }
        });
        if (flag) {
            F.createProcess();
        }
    });

    //删除工序节点
    $('div.copy_process_div').on('click','span.del_process_div',function(){$(this).parent('div.clone_process_div').remove();});

    //校验工序节点
    $('div.copy_process_div').on('blur', 'input.small', function() {
        validate_process($(this));
        validate_num($(this));
    });

    //校验工序为空的情况
    function validate_process(obj) {
        if (obj.val() == '') {
            obj.siblings('span.validate_is_null').removeAttr('hidden');
        } else {
            obj.siblings('span.validate_is_null').attr('hidden', 'hidden');
        }
    };

    //校验每个输入框的值（除工序）-> 空值和数字
    $('.form-control').on('blur', function() {
        if($(this).attr('name')=='order_name'){
            $('input.process_desc').val($(this).val());
        }
        validate_null($(this));
        validate_num($(this));
    });

    //检验是否为数字
    function validate_num(obj) {
        var attr_name = obj.attr('name');
        if (attr_name == 'process[process_name][]') {
            //工序名称是不需要检验是否为数字的
        } else if (attr_name == 'process[process_desc][]') {
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