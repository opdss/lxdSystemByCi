
<!-- main container -->
<div class="content">

    <div id="pad-wrapper" class="new-user">
        <div class="row header">
            <div class="col-md-12">
                <h3>添加工序</h3>
            </div>
        </div>

        <div class="row form-wrapper">
            <!-- left column -->
            <div class="col-md-12">
                <div class="container">
                    <form class="new_user_form">
                        <div class="col-md-12 field-box clone_process_div" style="width:800px;">
                            <label>工序NO.1</label>
                            <div class="address-fields"">
                                <input class="small form-control" type="text" name="process_name[]" placeholder="工序名称(必填)" style="width:190px;" />
                                <input class="small last form-control" type="text" name="process_price[]" placeholder="工序价钱(单位:元)(必填)" onkeyup="value=value.replace(/[^\d\.]/g,'')" style="width:190px;" />
                                <span style="cursor:pointer; margin-left:20px;" title="删除工序" class="del_process_div" hidden="hidden"><i class="icon-remove-sign"></i></span>
                                <span class="alert-msg validate_is_null validate_process" style="color:red;font-weight:700;" hidden="hidden"><img src="../../source/img/gif/01.gif" style="width:40px;" />把这个工序先填完</span>
                                <span class="alert-msg validate_is_num" style="color:red;font-weight:700;" hidden="hidden"><img src="../../source/img/myimg_fadai.png" style="width:20px;" />写错了吧？？</span>
                                <input class="form-control" type="text" name="process_desc[]" placeholder="工序简介(选填)" style="margin-top: 10px;width:404px;" />
                            </div>
                        </div>
                        <div class="col-md-11 field-box actions">
                            <span><a href="javascript:void(0)" class="cope_prcess_div">继续添加</a></span>
                            <input type="button" class="btn-glow primary" value="全部添加" id="add_btn">
                            <span>OR</span>
                            <input type="reset" value="重置所有工序内容" class="reset">
                        </div>
                    </form>
                </div>


            </div>

        </div>
    </div>
</div>
<!-- end main container -->
<script type="text/javascript">
    var F = {
        num : 1,
        process_div : $('div.clone_process_div').clone(true),
        createProcess : function(){
            F.num++;
            F.process_div.find('label:eq(0)').text('工序NO.'+ F.num);
            $('div.actions').before(F.process_div.clone(true));
            //第一个工序不能删除
            $('span.del_process_div').each(function(index, item) {
                if (index > 0) {
                    $(item).removeAttr('hidden');
                }
            });
        }
    }

    //复制
    $('a.cope_prcess_div').click(function(){
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
    $('form.new_user_form').on('click','span.del_process_div',function(){$(this).parents('div.clone_process_div').remove();});

    //提交
    $('#add_btn').click(function(){
        var data = $('form.new_user_form').serialize();
        var flag = true;//标记是否有验证未通过的
        validate_process($('input.small').first());
        validate_process($('input.small').last());
        if ($('span.alert-msg').each(function(index, item) {
            if ($(item).attr('hidden') != 'hidden') {
                flag = false;
            }
        }));
        if (flag) {
            W.ajax({'data':data},'<?php echo site_url('process/add');?>',function(msg){

                if(msg.code==1){
                    alert('工序添加成功！');
                    location.href = '<?php echo site_url('order/index');?>';
                }
            });
        }
    });

    //校验工序节点
    $('form.new_user_form').on('blur', 'input.small', function() {
        validate_process($(this));
        validate_num($(this));
    });

    //校验工序为空的情况
    function validate_process(obj) {
        if (obj.val()=='') {
            obj.siblings('span.validate_is_null').removeAttr('hidden');
        } else {
            obj.siblings('span.validate_is_null').attr('hidden', 'hidden');
        }
    };

    //检验是否为数字
    function validate_num(obj) {
        var attr_name = obj.attr('name');
        if (attr_name == 'process_name[]') {
        } else {
            if(obj.val() != '' && Number(obj.val())+''=='NaN') {
                obj.siblings('span.validate_is_num').removeAttr('hidden');
            } else {
                obj.siblings('span.validate_is_num').attr('hidden', 'hidden');
            }
        }
    }
</script>