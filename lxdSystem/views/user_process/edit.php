<!-- main container -->
<div class="content">

    <div id="pad-wrapper" class="new-user">
        <div class="row header">
            <div class="col-md-12">
                <h3>修改员工单道工序</h3>
            </div>
        </div>

        <div class="row form-wrapper">
            <!-- left column -->
            <div class="col-md-12">
                <div class="container">
                    <form class="new_user_form">
                        <div class="col-md-4 field-box">
                            <label>姓名:</label>
                            <span><?php echo $user_process_info['truename'];?></span>
                        </div>
                        <div class="col-md-12 field-box">
                            <label>月份:</label>
                            <span><?php echo $user_process_info['work_month'];?></span>
                        </div>
                        <div class="col-md-12 field-box">
                            <label>所属订单:</label>
                            <span><?php echo $user_process_info['order_name'];?></span>
                        </div>
                        <div class="col-md-12 field-box">
                            <label>工序详情:</label>
                            <div class="user_process_div">
                                <span>工序名称:  <?php echo $user_process_info['process_name'];?></span>
                                <span>工序价格:  <?php echo $user_process_info['process_price'];?></span>
                                <span>工序数量:  <input type="text" class="small form-control" name="process_num" value="<?php echo $user_process_info['process_num'];?>"/></span>
                            </div>
                        </div>

                        <div class="col-md-12 field-box textarea">
                            <label>描述信息:</label>
                            <div class="col-md-7">
                                <textarea class="form-control" rows="4"  name="desc"><?php echo $user_process_info['desc']?></textarea>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $user_process_info['id'];?>">
                        <div class="col-md-11 field-box actions">
                            <input type="button" class="btn-glow primary" value="完成更新" id="add_btn">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- end main container -->
<style>
    .user_process_div span{
        margin-right: 30px;;
    }
</style>
<script>

    $('#add_btn').click(function(){
        var data = $('form.new_user_form').serialize();
        W.ajax({'data':data},'<?php echo site_url('user_process/edit');?>',function(msg) {
            alert(msg.msg);
            if (msg.code == 1) {
                location.href = '<?php echo site_url('user_process/index');?>';
            }
        });
    });


</script>