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
                            <label>部门名称:</label>
                            <select name="dept_id" id="dept_id">
                                <option value="">--请选择--</option>
                                <?php foreach ($dept_list as $k => $v):?>
                                    <option value="<?php echo $v['id']?>"><?php echo str_repeat('　　',$v['level']-1).$v['dept_name'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="col-md-12 field-box">
                            <label>员工名称:</label>
                            <select name="user_id" id="user_id">
                                <option value="">--请选择--</option>
                            </select>
                        </div>
                        <div class="col-md-12 field-box">
                            <label>添加订单工序数量:</label>

                            <div class="col-md-10 copy_process_div">
                                <div class="order_list_div">
                                    <select name="order_id[]" onchange="getProcessList(this)">
                                        <option value="">--请选择--</option>
                                        <?php foreach ($order_list as $k => $v):?>
                                            <option value="<?php echo $v['id']?>"><?php echo $v['order_name'];?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <div class="process_list_div">

                                    </div>
                                </div>

                            </div>

                            <div class="col-md-5" style="text-align: center;margin-top: 10px;margin-left: 10px"><span class="label label-success copy_process_div" style="cursor:pointer">增加</span></div>
                        </div>

                        <div class="col-md-12 field-box textarea">
                            <label>描述信息:</label>
                            <div class="col-md-7">
                                <textarea class="form-control" rows="4"  name="desc"></textarea>
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
                        html += '<span>工序名称:  '+msg.data[i].process_name+'</span><input type="hidden" name="process_id['+orderid+'][]" value="'+msg.data[i].id+'">';
                        html += '<span>工序数量:  <input type="text" class="small form-control" name="process_num['+orderid+'][]"></span>';
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