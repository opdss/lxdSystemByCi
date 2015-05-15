<link media="screen" type="text/css" href="<?php echo base_url('source/css/compiled/new-user.css');?>" rel="stylesheet">
<!-- main container -->
<div class="content">

<div id="pad-wrapper" class="form-page">
    <div class="row header">
        <div class="col-md-12">
            <h3>添加员工工序</h3>
        </div>
    </div>
    <div class="row form-wrapper">
    <!-- left column -->
    <div class="col-md-8 column">
        <form>
            <div class="field-box">
                <label>员工名称:</label>
                <div class="col-md-7">
                    <input class="form-control" type="text" name="user_name" id="username"/>
                </div>
                <div class="sl">
                    <ul class="ulist">

                    </ul>
                </div>
            </div>
            <div class="field-box">
                <label>订单名称:</label>
                <div class="col-md-7">
                <select name="order_id" id="order_id">

                    <option value="">--请选择--</option>
<?php foreach ($list as $k => $v):?>
                    <option value="<?php echo $v['id']?>"><?php echo $v['order_name'];?></option>
<?php endforeach;?>

                </select>
                </div>
            </div>

            <div class="field-box">
                <label>工序名称:</label>
                <div class="col-md-7">
                <select name="process_id" id="process_id">
                        <option value="">--请选择--</option>
                </select>
                </div>
            </div>

            <div class="field-box">
                <label>工序数量:</label>
                <div class="col-md-7">
                    <input class="form-control" type="text" name="process_num"/>
                </div>
            </div>

            <div class="field-box">
                <label>描述信息:</label>
                <div class="col-md-7">
                    <textarea class="form-control" rows="4" name="remark"></textarea>
                </div>
            </div>

            <div class="col-md-8 actions">
                <input type="button" class="btn-glow primary" value="添加" id="add_btn">
            </div>
        </form>
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

    $('#order_id').change(function(){
        var orderid = $(this).children('option:selected').val();
        $.ajax({
            'type':'post',
            'url' : '<?php echo site_url('user_process/getProcessByOrderId');?>',
            'data' : {'data':orderid},
            'success' : function(msg){
                if(msg.code==1){
                    var html='<option value="">--请选择--</option>';
                    for (var i = msg.data.length - 1; i >= 0; i--) {
                        html += '<option value="'+msg.data[i].id+'">'+msg.data[i].process_name+'</option>';
                    };
                    $("#process_id").html(html);

                }else{
                    alert(msg.msg);
                }
            },
            'dataType' : 'json'
        });

    })


</script>