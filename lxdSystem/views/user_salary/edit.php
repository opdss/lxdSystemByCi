<!-- main container -->
<div class="content">

    <div id="pad-wrapper" class="new-user">
        <div class="row header">
            <div class="col-md-12">
                <h3>修改员工工序</h3>
            </div>
        </div>

        <div class="row form-wrapper">
            <!-- left column -->
            <div class="col-md-12">
                <div class="container">
                    <form class="new_user_form">
                        <div class="col-md-4 field-box">
                            <label>姓名:</label>
                            <span><?php echo $salary_info['truename'];?></span>
                        </div>
                        <div class="col-md-12 field-box">
                            <label>月份:</label>
                            <span><?php echo $salary_info['work_month'];?></span>
                        </div>
                        <div class="col-md-12 field-box">
                            <label>订单工序详情:</label>
                            <?php
                            $salary = 0;
                            foreach($salary_info as $key=>$v):

                                if(is_array($v)){

                                    echo '<input type="hidden" name="order_id[]" value="'.$key.'"/>';
                            ?>

                            <div class="col-md-10">
                                <div>
                                    <span><?php echo $v[0]['order_name'];?></span>
                                    <div>
                                       <?php

                                                foreach($v as $k=>$process){

                                                    ?>
                                                    <div class="old_process_div">
                                                        <span style="font-size: 14px;margin-right: 20px;">NO.<?php echo $k+1;?>:</span>
                                                        <span>工序名称:  <?php echo $process['process_name'];?></span>
                                                        <span>工序价格:  <?php echo $process['process_price'];?></span>
                                                        <span>工序数量:  <input type="text" class="small form-control" name="process_num[<?php echo $process['order_id'];?>][]" value="<?php echo $process['process_num'];?>"/></span>
                                                    </div>
                                                    <input type="hidden" name="process_id[<?php echo $process['order_id'];?>][]" value="<?php echo $process['order_process_id'];?>">
                                                    <input type="hidden" name="process_price[<?php echo $process['order_id'];?>][]" value="<?php echo $process['process_price'];?>">
                                                    <input type="hidden" name="user_process_id[<?php echo $process['order_id'];?>][]" value="<?php echo $process['id'];?>">
                                                    <?php
                                                    $salary += $process['process_price']*$process['process_num'];
                                                }
                                            ?>
                                    </div>
                                </div>

                            </div>
                           <?php
                                }
                           endforeach;?>
                            <div class="col-md-10 copy_process_div" style="display: none;">
                                <div class="order_list_div">
                                    <div class="ui-select" style="margin-top:2px;margin-right:10px;">
                                        <select class="mySelect" name="order_id[]" onchange="getProcessList(this)">
                                            <option value="">--请选择订单--</option>
                                            <?php foreach ($order_list as $k => $v):?>
                                                <option value="<?php echo $v['id']?>"><?php echo $v['order_name'];?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                    <span style="cursor:pointer;" title="删除" class="del_process_div" style="" hidden="hidden" ><i class="icon-remove-sign"></i></span>
                                    <div class="process_list_div">

                                    </div>
                                </div>

                            </div>
                            <div class="col-md-5" style="text-align: center;margin-top: 10px;text-align:left;"><span class="label label-success copy_process_div" style="cursor:pointer">增加</span></div>

                        </div>

                        <div class="col-md-12 field-box textarea">
                            <label>描述信息:</label>
                            <div class="col-md-7">
                                <textarea class="form-control" rows="4"  name="desc"><?php echo $salary_info['desc']?></textarea>
                            </div>
                        </div>
                        <input type="hidden" name="sign" value="<?php echo $sign;?>"/>
                        <input type="hidden" name="salary" value="<?php echo $salary;?>"/>
                        <input type="hidden" name="user_id" value="<?php echo $salary_info['user_id'];?>"/>
                        <input type="hidden" name="work_month" value="<?php echo $salary_info['work_month'];?>"/>
                        <div class="col-md-11 field-box actions">
                            <input type="button" class="btn-glow primary" value="完成更新" onclick="ajaxSubmit(this,'add_btn');">
                            <input type="button" class="btn-glow primary" value="完成结算" onclick="ajaxSubmit(this,'pay_btn');">

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- end main container -->

<style type="text/css">
    .sl{
        width: 353px;
        position: absolute;
        top: 34px;
        left: 170px;
        z-index: 100;
        background-color: #fff;
        border: 1px solid #cccccc;
        display: none;
    }
    .sl .ulist li{
        cursor: pointer;
        line-height: 30px;
        list-style-type: none;
    }
    .clone_process_div span,.old_process_div span{
        margin-left: 30px;
    }

</style>
<script>

    $(function () {
        // datepicker plugin
        $('.input-datepicker').datepicker({format: "yyyy-mm"}).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });
    });

    $("#username").bind('input propertychange', function() {
        var username = $(this).val();
        $.ajax({
            'type':'post',
            'url' : '<?php echo site_url('user_process/getUserInfoByName');?>',
            'data' : {'data':username},
            'success' : function(msg){
                if(msg.code==1){
                    var html='';
                    for (var i = msg.data.length - 1; i >= 0; i--) {
                        html += "<li onclick='userNameHandle(\""+msg.data[i].truename+"\")'>"+msg.data[i].truename+"</li>";
                    };
                    $(".ulist").html(html);
                    $(".sl").show();
                }
            },
            'dataType' : 'json'
        });
    });

    $("#username").blur(function(){
        $(".sl").hide();
    });


    function ajaxSubmit(obj,type){
        var data = $(obj).parents('form').serialize();
        var param = '&type='+type;
        data += param;
        $.ajax({
            'type':'post',
            'url' : '<?php echo site_url('user_salary/edit');?>',
            'data' : {'data':data},
            'success' : function(msg){
                if(msg.code==1){
                    location.href = '<?php echo site_url('user_salary/index');?>';
                }else{
                    alert(msg.msg);
                }
            },
            'dataType' : 'json'
        });
    }

    function userNameHandle(name){
        $("#username").val(name);
        $(".sl").hide();
    }


    function getProcessList(obj){
        var orderid = $(obj).children('option:selected').val();
        $.ajax({
            'type':'post',
            'url' : '<?php echo site_url('user_process/getProcessByOrderId');?>',
            'data' : {'data':orderid},
            'success' : function(msg){
                if(msg.code==1){
                    var html='';
                    for (var i = msg.data.length - 1,j=0; i >= 0; i--,j++) {
                        html += '<div class="clone_process_div">';
                        html += '<span style="font-size: 14px;margin-right: 20px;">NO.'+(j+1)+':</span>';
                        html += '<span>工序名称:  '+msg.data[i].process_name+'</span><input type="hidden" name="process_id['+orderid+'][]" value="'+msg.data[i].order_process_id+'"><input type="hidden" name="process_price['+orderid+'][]" value="'+msg.data[i].process_price+'">';
                        html += '<span>工序价格:  '+msg.data[i].process_price+'</span>';
                        html += '<span>工序数量:  <input type="text" class="small form-control" name="process_num['+orderid+'][]" value="0"></span>';
                        html += '</div>';
                    }
                    $(obj).parent().siblings('div.process_list_div').html(html);
                    $(obj).children('option[value=""]').remove();

                }else{
                    alert(msg.msg);
                }
            },
            'dataType' : 'json'
        });
    }


    $('#dept_id').change(function(){
        var dept_id = $(this).children('option:selected').val();
        $.ajax({
            'type':'post',
            'url' : '<?php echo site_url('user_process/getUserListByDeptId');?>',
            'data' : {'data':dept_id},
            'success' : function(msg){
                if(msg.code==1){
                    var html='<option value="">--请选择--</option>';
                    for (var i = msg.data.length - 1; i >= 0; i--) {
                        html += '<option value="'+msg.data[i].id+'">'+msg.data[i].truename+'</option>';
                    }
                    $("#user_id").html(html);

                }else{
                    alert(msg.msg);
                }
            },
            'dataType' : 'json'
        });

    })

    var F = {
        order_div : $('div.order_list_div').clone(),
        orderProcess : function(){
            var new_div = F.order_div.clone()
            $('div.copy_process_div').append(new_div);
            $('div.copy_process_div').show();

            //第一个订单不能删除
            $('span.del_process_div').each(function(index, item) {
                if (index > 0) {
                    $(item).removeAttr('hidden');
                }
            });

        }
    }

    $('span.copy_process_div').click(function(){
        F.orderProcess();
    });


    //删除订单节点
    $('div.copy_process_div').on('click','span.del_process_div',function(){
        $(this).parent('div.order_list_div').remove();
    });

</script>