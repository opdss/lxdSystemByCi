<div class="content">

    <div id="pad-wrapper" class="new-user">
        <div class="row header">
            <div class="col-md-12">
                <h3>修改密码</h3>
            </div>
        </div>

        <div class="row form-wrapper">
            <!-- left column -->
            <div class="col-md-12">
                <div class="container">
                    <form class="new_user_form">

                        <div class="col-md-4 field-box" style="width:800px;">
                            <label style="width:84px;text-align: right; margin-right: 20px;">原密码:</label>
                            <input class="form-control" type="password" style="width: 422px;" placeholder="原密码" name="old_pwd"/>
                        </div>
                        <div class="col-md-4 field-box" style="width:800px;">
                            <label style="width:84px;text-align: right; margin-right: 20px;">新密码:</label>
                            <input class="form-control" type="password" style="width: 422px;" placeholder="新密码" name="new_pwd"/>
                        </div>
                        <div class="col-md-4 field-box" style="width:800px;">
                            <label style="width:84px;text-align: right; margin-right: 20px;">确认密码:</label>
                            <input class="form-control" type="password" style="width: 422px;" placeholder="确认密码" name="confirm_new_pwd"/>
                        </div>

                        <div class="col-md-11 field-box actions">
                            <input type="button" class="btn-glow primary" value="确定修改" id="add_btn">
                            <span>OR</span>
                            <input type="reset" value="重置所有信息" class="reset">
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    $('#add_btn').click(function(){
        var data = $(this).parents('form').serialize();
        W.ajax({'data':data},'<?php echo site_url('setting/editPwd');?>',function(msg){
            alert("密码修改成功，请重新登录！");
            if(msg.code==1){
                location.href='<?php echo site_url('login/index');?>';
            }
        });
    });
</script>