
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
                        <div class="col-md-12 field-box clone_process_div">
                            <label>工序NO.1:</label>
                            <div class="address-fields">
                                <input class="form-control" type="text" name="process_desc[]" placeholder="工序简介(可以为空)" />
                                <input class="small form-control" type="text" name="process_name[]" placeholder="工序名称" />
                                <input class="small last form-control" type="text" name="process_price[]" placeholder="工序价钱(单位:元)" />
                            </div>
                        </div>
                        <div class="col-md-11 field-box actions">
                            <span><a href="javascript:void(0)" class="cope_prcess_div">继续添加</a></span>
                            <input type="button" class="btn-glow primary" value="全部添加" id="add_btn">
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
<script type="text/javascript">
    var F = {
        num : 1,
        process_div : $('div.clone_process_div').clone(),
        createProcess : function(){
            F.num++;
            F.process_div.find('label:eq(0)').text('工序NO.'+ F.num);
            $('div.actions').before(F.process_div.clone());
        }
    }
    $('a.cope_prcess_div').click(function(){F.createProcess();});
    $('#add_btn').click(function(){
        var data = $('form.new_user_form').serialize();
        W.ajax({'data':data},'<?php echo site_url('process/add');?>',function(msg){
            alert(msg.msg);
            if(msg.code==1){
                location.href = '<?php echo site_url('process/index');?>';
            }
        });
    });
</script>