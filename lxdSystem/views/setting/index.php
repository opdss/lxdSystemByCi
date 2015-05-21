<div class="content">

    <div id="pad-wrapper" class="new-user">
        <div class="row header">
            <div class="col-md-12">
                <h3>系统设置</h3>
            </div>
        </div>

        <div class="row form-wrapper">
            <!-- left column -->
            <div class="col-md-12">
                <div class="container">
                    <form class="new_user_form">
                        <?php foreach($setting as $k=>$v){?>
                        <div class="col-md-4 field-box" style="width:800px;">
                            <label style="width:84px;text-align: right; margin-right: 20px;"><?php echo $v->name;?>:</label>
                            <input class="form-control" type="text" style="width: 422px;" placeholder="<?php echo $v->name;?>" name="<?php echo $k;?>" value="<?php echo $v->value;?>"/>
                        </div>
                        <?php }?>
                        <div class="col-md-11 field-box actions">
                            <input type="button" class="btn-glow primary" value="确定保存" id="add_btn">
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
        W.ajax({'data':data},'<?php echo site_url('setting/edit');?>',function(msg){
            alert(msg.msg);
            if(msg.code==1){
                location.href='<?php echo site_url('welcome/index');?>';
            }
        });
    });
</script>