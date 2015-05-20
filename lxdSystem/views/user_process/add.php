<!-- main container -->
<div class="content">

    <div id="pad-wrapper" class="new-user">
        <div class="row header">
            <div class="col-md-12">
                <h3>为个人添加工序</h3>
            </div>
        </div>

        <div class="row form-wrapper">
            <!-- left column -->
            <div class="col-md-12">
                <div class="container">
                    <form class="new_user_form">
                        <div class="col-lg-8">
                            <label>部门名称:</label>
                            <div class="ui-select" style="width:250px;">
                            <select name="dept_id" id="dept_id">
                                    <option value="">--请选择部门--</option>
                                    <?php foreach ($dept_list as $k => $v):?>
                                        <option value="<?php echo $v['id']?>"><?php echo str_repeat('　　',$v['level']-1).$v['dept_name'];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <label style="margin-top:10px;">员工名称:</label>
                            <div class="ui-select" style="width:250px; margin-top:10px;">
                                <select name="user_id" id="user_id">
                                    <option value="">--请选择员工--</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 field-box" style="margin-top:10px;">
                            <label>添加工序数量:</label>

                            <div class="col-md-10 copy_process_div">
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
                                <textarea class="form-control" placeholder="描述信息（选填）" rows="4" name="desc" style="width:250px;"></textarea>
                            </div>
                        </div>

                        <div class="col-md-11 field-box actions" style="width:400px;">
                            <input type="button" class="btn-glow primary" value="完成创建" id="add_btn">
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
        if (isSuccess()) {
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
        }
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
                        html += '<span>工序名称:  '+msg.data[i].process_name+'</span><input type="hidden" name="process_id['+orderid+'][]" value="'+msg.data[i].id+'">';
                        html += '<span>工序数量:  <input type="text" class="small form-control" placeholder="0" style="height:24px;width:80px;margin-top:0;" onkeyup="value=value.replace(/[^\\d]/g,\'\')" name="process_num['+orderid+'][]"></span>';
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
            $('div.copy_process_div').append(F.order_div.clone());
            //第一个订单不能删除
            $('span.del_process_div').each(function(index, item) {
                if (index > 0) {
                    $(item).removeAttr('hidden');
                }
            });
        }
    }

    //添加订单节点
    $('span.copy_process_div').click(function() {
        var flag = true;
        $('select.mySelect').each(function (index, item) {
            if ($(item).children('option[value=""]').length != 0) {
                flag = false;
                return;
            }
        });
        if (flag) {
            F.orderProcess();
        } else {
            alert('还有订单没选呢！');
        }
    });

    //删除订单节点
    $('div.copy_process_div').on('click','span.del_process_div',function(){
        $(this).parent('div.order_list_div').remove();
    });

    //调用该函数，校验成功返回true，不成功返回false
    function isSuccess() {
        var dept = $('#dept_id').children('option:selected').val();
        if (dept == '') {
            alert('请选择部门！');
            return false;
        }
        var user = $('#user_id').children('option:selected').val();
        if (user == '') {
            alert('请选择部门！');
            return false;
        }
        var flag = true;
        //添加工序数量校验
        $('select.mySelect').each(function (index, item) {
            if ($(item).children('option[value=""]').length != 0) {
                flag = false;
                return;
            }
        });
        if (flag) {
            return true;
        } else {
            alert('添加工序数量中有未完成的订单！');
            return false;
        }
    };

</script>