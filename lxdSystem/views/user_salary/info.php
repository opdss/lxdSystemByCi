<!-- main container -->
<div class="content">

    <div id="pad-wrapper" class="new-user">
        <div class="row header">
            <div class="col-md-12">
                <h3>工资详情单</h3>
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
                            foreach($salary_info as $v):
                                if(is_array($v)){
                            ?>
                            <div class="col-md-10 copy_process_div">
                                <div class="order_list_div">
                                    <span><?php echo $v[0]['order_name'];?></span>
                                    <div class="process_list_div">
                                        <?php

                                                foreach($v as $k=>$process){

                                        ?>
                                        <div class="clone_process_div">
                                            <span style="font-size: 14px;margin-right: 20px;">NO.<?php echo $k+1;?>:</span>
                                            <span>工序名称:  <?php echo $process['process_name'];?></span>
                                            <span>工序数量:  <?php echo $process['process_num'];?></span>
                                            <span>工序价格:  <?php echo $process['process_price'];?></span>
                                            <span>小计:  <?php echo $process['process_price']*$process['process_num'];?></span>
                                        </div>
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

                        </div>

                        <div class="col-md-12 field-box">
                            <label>应发放薪资:</label>
                            <span><?php echo $salary;?></span>
                        </div>

                        <div class="col-md-11 field-box actions">
                            <input type="button" class="btn-glow primary" value="打印详情单" id="add_btn">
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
    .clone_process_div span{
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

    $('#add_btn').click(function(){
        var data = $(this).parents('form').serialize();
        $.ajax({
            'type':'post',
            'url' : '<?php echo site_url('user_process/add');?>',
            'data' : {'data':data},
            'success' : function(msg){
                if(msg.code==1){
                    location.href = '<?php echo site_url('user_process/index');?>';
                }else{
                    alert(msg.msg);
                }
            },
            'dataType' : 'json'
        });
    });

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
                        html += '<span>工序数量:  <input type="text" class="small form-control" name="process_num['+orderid+'][]" value="0"></span>';
                        html += '</div>';
                    }
                    $(obj).next().html(html);

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
            $('div.copy_process_div').append(F.order_div.clone());
        }
    }
    $('span.copy_process_div').click(function(){F.orderProcess();});


</script>